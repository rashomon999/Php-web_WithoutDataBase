<?php
// No form logic needed — display-only page
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patrones de Concurrencia</title>
    <link rel="stylesheet" href="../../../../css/bootstrap.min.css">

<style>
    /* ── Base — igual que style_2_0.css del proyecto ─── */
    body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        max-width: 100%;
        background-color: #d8d8d8;
        font-family: 'Segoe UI', Arial, sans-serif;
        font-size: 14px;
        color: #222;
    }

    .form-container {
        display: flex;
        min-height: 100vh;
    }

    /* ── Secciones — mismos colores que el proyecto ──── */
    .seccion {
        width: calc(50% - 7.5px);
        padding: 20px;
        box-sizing: border-box;
    }

    .seccion.izquierda {
        background-color: #e0e0e0;
    }

    .seccion.derecha {
        margin-left: 15px;
        background-color: #f0f0f0;
    }

    /* ── Encabezado de sección ────────────────────── */
    .seccion h3 {
        font-size: 15px;
        font-weight: 700;
        color: #333;
        margin: 0 0 16px 0;
        padding-bottom: 8px;
        border-bottom: 2px solid #bbb;
        letter-spacing: 0.01em;
    }

    /* ── Tabla principal ─────────────────────────── */
    .tabla-wrapper {
        width: 100%;
        overflow-x: auto; /* scroll solo si la ventana es muy pequeña */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        background: #fafafa;
        border-radius: 6px;
        overflow: hidden;
        box-shadow: 0 1px 4px rgba(0,0,0,.10);
        table-layout: auto;
    }

    /* ── Encabezado de tabla ──────────────────────── */
    thead tr {
        background-color: #9e9e9e;
    }

    th {
        padding: 10px 10px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #fff;
        border: 1px solid #888;
        white-space: nowrap;
    }

    /* ── Filas del cuerpo ─────────────────────────── */
    tbody tr {
        border-bottom: 1px solid #ddd;
        transition: background 0.15s;
    }

    tbody tr:nth-child(odd)  { background: #f5f5f5; }
    tbody tr:nth-child(even) { background: #ebebeb; }
    tbody tr:hover            { background: #d6e4f7; }

    td {
        padding: 9px 10px;
        vertical-align: top;
        border: 1px solid #ccc;
        line-height: 1.5;
        color: #333;
    }

    /* ── Primera columna: nombre del patrón ───────── */
    td:first-child {
        font-weight: 700;
        white-space: nowrap;
        color: #111;
        border-left: 4px solid #9e9e9e;
    }

    tbody tr:nth-child(1) td:first-child { border-left-color: #607d8b; }
    tbody tr:nth-child(2) td:first-child { border-left-color: #78909c; }
    tbody tr:nth-child(3) td:first-child { border-left-color: #546e7a; }
    tbody tr:nth-child(4) td:first-child { border-left-color: #455a64; }
    tbody tr:nth-child(5) td:first-child { border-left-color: #37474f; }

    /* ── Pills / etiquetas ────────────────────────── */
    .pill {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }
    .pill-si   { background: #c8e6c9; color: #2e7d32; border: 1px solid #a5d6a7; }
    .pill-no   { background: #eeeeee; color: #616161; border: 1px solid #bdbdbd; }
    .pill-cond { background: #fff9c4; color: #7b6f00; border: 1px solid #f9e08b; }
    .pill-sync { background: #e3f2fd; color: #1565c0; border: 1px solid #90caf9; }
    .pill-async{ background: #fce4ec; color: #880e4f; border: 1px solid #f48fb1; }
    .pill-both { background: #f3e5f5; color: #6a1b9a; border: 1px solid #ce93d8; }

    /* ── Botón de navegación ──────────────────────── */
    .centered-container {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: fixed;
        bottom: 0;
        width: 100%;
        padding: 14px 20px;
        background-color: #f8f9fa;
        border-top: 1px solid #ccc;
        gap: 12px;
        z-index: 100;
    }

    .centered-container a {
        padding: 8px 24px;
        font-size: 14px;
        font-weight: 600;
        border-radius: 4px;
        text-decoration: none;
    }

    /* ── Espacio para que el botón fijo no tape contenido */
    .page-bottom-spacer {
        height: 70px;
    }
</style>
<style>
/* === responsive movil (anadido automaticamente) === */
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
</style>
</head>
<body>

<div class="form-container">

    <!-- SECCIÓN IZQUIERDA: tabla completa -->
    <div class="seccion izquierda">
        <h3>Comparación General de Patrones de Concurrencia</h3>

        <div class="tabla-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Patrón</th>
                    <th>Problema Principal</th>
                    <th>Idea Central</th>
                    <th>Qué Administra</th>
                    <th>Tipo de Tareas</th>
                    <th>Dependencias</th>
                    <th>Tareas Dinámicas</th>
                    <th>Sincrónico / Asincrónico</th>
                    <th>Ejemplo Típico</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Thread Pool</td>
                    <td>Muchos threads consumen demasiados recursos</td>
                    <td>Reutilizar threads</td>
                    <td>Threads y workers</td>
                    <td>Tareas ya existentes</td>
                    <td>Idealmente independientes</td>
                    <td><span class="pill pill-no">No necesariamente</span></td>
                    <td><span class="pill pill-both">Ambos</span></td>
                    <td>Servidor web reutilizando hilos</td>
                </tr>
                <tr>
                    <td>Master-Worker</td>
                    <td>Dividir trabajo entre procesadores</td>
                    <td>Repartir tareas</td>
                    <td>Tareas y workers</td>
                    <td>Tareas independientes</td>
                    <td>No deben depender unas de otras</td>
                    <td><span class="pill pill-cond">Sí, controladas</span></td>
                    <td><span class="pill pill-sync">Síncrono</span></td>
                    <td>Procesamiento masivo de imágenes</td>
                </tr>
                <tr>
                    <td>Separable Dependencies</td>
                    <td>Existen dependencias entre tareas</td>
                    <td>Eliminar o aislar dependencias</td>
                    <td>Datos compartidos y tareas</td>
                    <td>Semi-independientes</td>
                    <td>Sí existen, pero se separan</td>
                    <td><span class="pill pill-no">Generalmente no</span></td>
                    <td><span class="pill pill-sync">Síncrono</span></td>
                    <td>Conteo paralelo con copias locales</td>
                </tr>
                <tr>
                    <td>Fork / Join</td>
                    <td>Las tareas aparecen dinámicamente</td>
                    <td>Dividir recursivamente y combinar</td>
                    <td>Subtareas recursivas</td>
                    <td>Independientes tras el fork</td>
                    <td>Relaciones padre-hijo</td>
                    <td><span class="pill pill-si">Sí, constantemente</span></td>
                    <td><span class="pill pill-sync">Síncrono jerárquico</span></td>
                    <td>MergeSort y QuickSort paralelos</td>
                </tr>
                <tr>
                    <td>Producer-Consumer</td>
                    <td>Productores y consumidores a ritmos distintos</td>
                    <td>Coordinar producción y consumo</td>
                    <td>Cola compartida</td>
                    <td>Tareas asíncronas</td>
                    <td>No necesariamente relacionadas</td>
                    <td><span class="pill pill-si">Sí, continuamente</span></td>
                    <td><span class="pill pill-async">Muy asíncrono</span></td>
                    <td>Cola de pedidos o mensajes</td>
                </tr>
            </tbody>
        </table>
        </div>
    </div>

    <!-- SECCIÓN DERECHA: espacio libre para contenido adicional -->
    <div class="seccion derecha">
        <!-- contenido adicional aquí -->
    </div>

</div>

<div class="page-bottom-spacer"></div>

<div class="centered-container">
    <a class="btn btn-secondary" href="index.php">← Anterior</a>
    <a class="btn btn-primary" href="tercero.php">Siguiente</a>
</div>

</body>
</html>