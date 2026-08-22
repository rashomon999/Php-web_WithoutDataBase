# Publicar los cuestionarios en InfinityFree

El sitio es **PHP sin base de datos**, pero los cuestionarios corrigen las respuestas
en el servidor (`$_POST` + `$respuesta_N`). Necesita un servidor que ejecute PHP:
GitHub Pages, Netlify y Vercel no sirven, ahí la verificación de respuestas se rompe.

InfinityFree es hosting compartido gratuito: **no se duerme nunca**, PHP 8.3, subdominio
con SSL. Sitio: **160 MB, 3.384 archivos**.

---

## Paso 1 — Crear la cuenta

1. <https://www.infinityfree.com> → *Sign Up* (gratis, sin tarjeta).
2. Dentro del panel: *Create Account* → elige un subdominio, por ejemplo
   `cuestionarios.rf.gd`. También puedes conectar un dominio propio si algún día tienes.
3. Cuando el hosting quede activo (tarda unos minutos), entra a **FTP Details** y anota:
   - **FTP Server** — algo como `ftpupload.net`
   - **FTP Username** — algo como `if0_38xxxxxx`
   - **FTP Password**

---

## Paso 2 — Subir el paquete

En tu disco está la carpeta **`C:\xampp\htdocs\php_web\_paquete_ftp`** con 10 archivos:

```
instalar.php
sitio_01.zip  …  sitio_09.zip
```

Son el sitio entero comprimido. **Se sube eso, no los 3.384 archivos sueltos** —
subir archivo por archivo por FTP tarda una eternidad y siempre falla alguno.

1. Instala [FileZilla](https://filezilla-project.org/download.php?type=client).
2. Arriba, en la barra rápida, pon los datos del Paso 1 y dale a *Conexión rápida*.
3. En el panel derecho (servidor) entra en la carpeta **`htdocs`**.
4. En el panel izquierdo (tu PC) ve a `C:\xampp\htdocs\php_web\_paquete_ftp`.
5. Selecciona los 10 archivos y arrástralos a `htdocs`.

Son 161 MB en 10 archivos: unos pocos minutos, según tu subida.

---

## Paso 3 — Descomprimir en el servidor

Abre en el navegador:

```
https://TU-SUBDOMINIO/instalar.php
```

Sale una barra de progreso que se refresca sola. Va sacando los 3.384 archivos en
tandas para no chocar con el límite de tiempo de PHP. Cuando termine dice **Listo**.

Si se queda parado, recarga la página: retoma donde iba, no repite trabajo.

---

## Paso 4 — Limpiar y activar SSL

1. Por FTP, **borra de `htdocs`**: `instalar.php`, `instalar_estado.json` y los
   nueve `sitio_*.zip`. Ya no sirven de nada y ocupan 161 MB.
2. En el panel de InfinityFree: *Free SSL Certificates* → emite el certificado del
   subdominio (tarda unos minutos en propagarse).
3. Entra a `https://TU-SUBDOMINIO/` y comprueba: portada → **Materias** → una materia
   → un cuestionario → responde y dale a verificar.

Ya está público. Cualquiera con el link entra, a cualquier hora.

---

## Cómo actualizar el sitio más adelante

Para cambios pequeños (un cuestionario nuevo, un archivo corregido) no hace falta
repetir todo: conéctate por FileZilla y arrastra **solo los archivos cambiados** a la
misma ruta dentro de `htdocs`. FileZilla te pregunta si sobrescribir; di que sí.

---

## Lo que se arregló para que funcione fuera de XAMPP

Windows no distingue mayúsculas de minúsculas en los nombres de archivo; **Linux sí**.
Un enlace a `ingesoft/Menu.php` funciona en tu XAMPP pero da 404 en cualquier hosting.
Se corrigieron 16 enlaces de ese tipo:

| Archivo | Antes | Ahora |
|---|---|---|
| `datos_libros.php` | `ingesoft/Menu.php` | `ingeSoft/Menu.php` |
| `Estadistica/4semestre/Menu.php` | `.\Cuestionario\index.php` | `.\cuestionario\index.php` |
| `Matematicas/Menu.php` | `.\Kolman\Menu.php` | `.\kolman\Menu.php` |
| `Matematicas/Menu.php` | `.\libro\comienzo.php` | `.\libro\Comienzo.php` |
| `Matematicas/libro/Octavo.php` | `octavo.css`, `./octavo.php` | `Octavo.css`, `./Octavo.php` |
| `Matematicas/libro/Septimo.php` | `octavo.php` | `Octavo.php` |
| `SistemaDatos/.../ER_MER_cuestionario/index.php` | `img/personal.png` | `img/PERSONAL.png` |
| `Superficies/inicio/segundo.php` | `img/Z_0.png` | `img/z_0.png` |
| `compunet/Spring/Menu.php` | `.\Introduccion_2\...` | `.\introduccion_2\...` |
| `discretas/Discretas_3/Turing/index.php` | `img/guia_447.png` | `img/GUIA_447.png` |
| `discretas/Rosen/Rosen_5/Menu.php` | `.\Cuestionario_1\...` | `.\cuestionario_1\...` |
| `ingeSoft/SWEBOK/Patrones/DistProcessing/tercero.php` | `cuarto.php` | `Cuarto.php` |
| `ingeSoft/Sommerville/Part1/cuestionario_1/index.php` | `img/iso.png` | `img/ISO.png` |
| `scala/conceptos/Menu.php` | `./Codigo/index.php` | `./codigo/index.php` |

También se renombró `compunet/CRUD/index.PHP` → `index.php` (la extensión en mayúscula
no siempre la ejecuta Apache en Linux).

Archivos nuevos en la raíz del proyecto:

- **`.htaccess`** — índice por defecto, sin listados de carpetas, UTF-8, caché de
  imágenes, compresión, bloqueo de `.git`, `libros.sql` y `node_modules`, y
  `mod_speling` como red de seguridad para enlaces con mayúsculas mal puestas.
  **Va incluido en los zips**, no lo borres.
- **`.gitignore`** — estaba guardado en UTF-16, así que **git lo ignoraba por completo**
  y `node_modules` se podía colar en los commits. Reescrito en UTF-8.
- **`Dockerfile`**, **`.dockerignore`**, **`render.yaml`** — por si algún día quieres la
  otra ruta (Render, despliegue con `git push`). No se suben a InfinityFree.

Lo que **no** viaja al servidor: `node_modules`, `.git`, `.github`, `.idea`,
`administrador` (es el panel de la versión con base de datos, sin MySQL da error 500),
`libros.sql`, `package.json`, `package-lock.json` y los archivos de Docker/Render.

---

## Cosas que ya estaban rotas (no las toqué)

Comprobación automática: 935 archivos, 4.843 enlaces internos revisados.

- **338 enlaces apuntan a archivos que no existen.** No es culpa del despliegue,
  ya fallan en tu XAMPP. Los patrones más repetidos:
  - `Estadistica/4semestre/*/index.php` busca las imágenes en `../../img/`
    (= `Estadistica/img/`), pero están en el `img/` de la raíz. Le falta un nivel:
    debería ser `../../../img/`.
  - Muchos `segundo.php` / `tercero.php` enlazados desde menús pero nunca creados
    (`Estadistica/4semestre/Hipotesis/`, `Ingles/Theprestige/`, `Ingles/WillHunting/`,
    `Matematicas/Marsden/capitulo_5/cilindricas/`, entre otros).
- **`musica/F#M.php` es inalcanzable por URL**: el `#` corta la dirección en el
  navegador. Hoy no está enlazado desde ningún sitio, así que no rompe nada; si lo
  quieres accesible, renómbralo (`FsostenidoM.php`).
- **Imágenes con espacios y tildes** en `img/` (`Captura de pantalla ....png`,
  `Autoevaluación ....docx`). Van dentro de los zips, así que los nombres llegan
  intactos — este era justo uno de los riesgos de subirlas sueltas por FTP.

---

## Verificación hecha

- `php -l` sobre los **934 archivos PHP** con PHP 8.4: **0 errores de sintaxis**.
- Servidor PHP levantado y **los 934 archivos pedidos por HTTP**: todos responden 200,
  salvo `administrador/` (necesita MySQL, por eso queda excluido) y `musica/F#M.php`.
- POST real a `arquitecturaComputadores/cuestionario_2/index.php`: marca *correcto* /
  *incorrecto* bien, y el botón «mostrar solución» también.
- POST al motor de APO (`APO/Lectura_1/index.php`): responde correctamente.
- Sin *warnings*, *deprecated* ni errores de PHP en el log.
- Los 9 zips: **integridad OK**, 3.384 entradas, sin duplicados, `.htaccess` dentro,
  y ni rastro de `node_modules`, `.git` ni `administrador`.
- `instalar.php` probado de verdad contra un servidor PHP: extrae y el resultado es
  **byte a byte idéntico** al original.
