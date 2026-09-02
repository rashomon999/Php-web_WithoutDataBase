#!/usr/bin/env python3
"""
_responsive.py  -  hace que las paginas de dos secciones se vean bien en movil.

Que hace
--------
Busca todas las paginas que usan el diseno de dos columnas (.seccion izquierda /
.seccion derecha), averigua que hojas de estilo usan, y le pega a cada hoja un
bloque @media para pantallas estrechas. A las pocas paginas que no enlazan
ninguna hoja comun se lo mete en un <style> propio.

Por que con !important
----------------------
Cientos de paginas traen su propio <style> en linea con .seccion { width: 50% }.
Como va despues del <link> y tiene la misma especificidad, gana el en linea.
El !important es lo unico que lo vence sin abrir 668 archivos uno por uno.

Es idempotente y auto-reparable: si vuelves a editar una hoja y te cargas el
bloque, vuelve a ejecutar esto y lo repone.

Uso
---
    python _responsive.py            solo informa, no escribe
    python _responsive.py aplicar    escribe los cambios
"""

import os, re, sys, posixpath

EX = {'node_modules', '.git', '.idea', '_to_delete', '_paquete_ftp', '.github'}
MARCA = "/* === responsive movil (anadido automaticamente) === */"

BLOQUE = MARCA + """
@media (max-width: 768px) {
    html, body {
        height: auto !important;
        min-height: 100vh !important;
        max-width: 100% !important;
        overflow-x: hidden !important;
    }

    .form-container {
        display: flex !important;
        flex-direction: column !important;
        gap: 12px !important;
        max-width: 100% !important;
        padding: 12px 10px 10px !important;
    }

    /* Las secciones dejan de ir a media pantalla y se apilan: primero la
       izquierda, debajo la derecha. La altura la manda el contenido, no un
       valor fijo en vh. */
    .seccion {
        width: 100% !important;
        max-width: 100% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        height: auto !important;
        min-height: 0 !important;
        padding: 16px 12px !important;
        box-sizing: border-box !important;
    }
    .seccion.izquierda { order: 1 !important; }
    .seccion.derecha   { order: 2 !important; }

    /* Los huecos de tipo texto van DENTRO de la frase ("DevOps es un ___ a
       ___ entre ___"), asi que NO se les pone ancho completo: cada uno
       ocuparia una linea entera y se ve desproporcionado. Se respeta su
       atributo size y solo se limita para que nunca se salga de pantalla. */
    .seccion input[type="text"],
    input[type="text"] {
        display: inline-block !important;
        width: auto !important;
        max-width: 100% !important;
        min-width: 3.5em !important;
        box-sizing: border-box !important;
        vertical-align: baseline !important;
    }

    /* Estos si ocupan su propia linea */
    .seccion textarea, .seccion select,
    textarea, select {
        width: 100% !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
    }

    .input-container { flex-wrap: wrap !important; }

    .centered-container {
        position: static !important;
        width: auto !important;
        padding: 12px 14px 18px !important;
    }

    .imagen, img { max-width: 100% !important; height: auto !important; }

    /* Las formulas de MathJax se desbordan en pantallas estrechas */
    mjx-container[display="true"] {
        overflow-x: auto !important;
        max-width: 100% !important;
    }
}
"""

re_link = re.compile(r'<link[^>]+href="([^"]*style[^"]*\.css)"', re.I)
re_style_bloque = re.compile(
    r'[ \t]*<style>\s*' + re.escape(MARCA) + r'.*?</style>\n?', re.S | re.I)


def leer(p):
    raw = open(p, 'rb').read()
    try:
        return raw.decode('utf-8')
    except UnicodeDecodeError:
        return raw.decode('latin-1')


def escribir(p, t):
    open(p, 'wb').write(t.encode('utf-8'))


def limpiar_css(t):
    """Quita una version anterior del bloque (esta siempre al final)."""
    i = t.find(MARCA)
    return t[:i].rstrip() if i != -1 else t.rstrip()


def main():
    aplicar = len(sys.argv) > 1 and sys.argv[1].lower() in ('aplicar', 'apply', '-a')

    hojas = set()
    huerfanas = []

    for dp, dn, fn in os.walk('.'):
        dn[:] = [d for d in dn if d not in EX]
        for f in fn:
            if not f.endswith(('.php', '.html')):
                continue
            rel = os.path.relpath(os.path.join(dp, f), '.').replace(os.sep, '/')
            try:
                t = leer(os.path.join(dp, f))
            except OSError:
                continue
            if 'class="seccion' not in t:
                continue
            hrefs = re_link.findall(t)
            if not hrefs:
                huerfanas.append(rel)
                continue
            base = posixpath.dirname(rel)
            for h in hrefs:
                hojas.add(posixpath.normpath(posixpath.join(base, h)))

    hojas = sorted(h for h in hojas if os.path.isfile(h))

    print(f"hojas de estilo en uso : {len(hojas)}")
    print(f"paginas sin hoja comun : {len(huerfanas)}")

    faltan = [h for h in hojas if MARCA not in leer(h)]
    print(f"hojas que NO tienen el bloque ahora mismo: {len(faltan)}")
    for h in faltan[:10]:
        print("    ", h)
    if len(faltan) > 10:
        print(f"     ... y {len(faltan)-10} mas")

    if not aplicar:
        print("\n(modo informe: no se ha escrito nada. Usa 'aplicar' para escribir)")
        return

    n = 0
    for h in hojas:
        t = leer(h)
        nuevo = limpiar_css(t) + "\n\n" + BLOQUE
        if nuevo != t:
            escribir(h, nuevo)
            n += 1
    print(f"hojas actualizadas: {n}")

    m = 0
    for r in huerfanas:
        t = leer(r)
        t2 = re_style_bloque.sub('', t)
        i = t2.lower().rfind('</head>')
        if i == -1:
            print("   sin </head>, saltada:", r)
            continue
        t2 = t2[:i] + "<style>\n" + BLOQUE + "</style>\n" + t2[i:]
        if t2 != t:
            escribir(r, t2)
            m += 1
    print(f"paginas huerfanas actualizadas: {m}")


if __name__ == '__main__':
    main()
