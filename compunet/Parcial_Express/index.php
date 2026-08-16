<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   PARCIAL EXPRESS — index.ts del parcial
   Se pregunta por lineas reales del codigo, no por definiciones sueltas.
   --------------------------------------------------------------- */

$SOLUCIONES = [
    1  => 'import express, { Express, Request, Response } from "express";',
    2  => 'import cors from "cors";',
    3  => 'import { db } from "./config/connectionDB";',
    4  => 'import { apiKey } from "./middlewares";',
    5  => 'import { recipeRouter } from "./recipes";',
    6  => 'import { ingredientRouter } from "./ingredients";',
    7  => 'const app: Express = express();',
    8  => 'process.loadEnvFile();',
    9  => 'const port: number = parseInt(process.env.APP_PORT || "3000");',
    10 => 'app.use(cors());',
    11 => 'app.use(express.json());',
    12 => 'app.use(express.urlencoded({ extended: true }));',
    13 => 'app.use("/api", apiKey);',
    14 => 'app.use("/api/recipe", recipeRouter);',
    15 => 'app.use("/api/ingredient", ingredientRouter);',
    16 => 'app.get("/", (req: Request, res: Response) => {',
    17 => 'res.send("API de recetas - Parcial Express");',
    18 => 'db.then(() =>',
    19 => 'app.listen(port, () => {',
    20 => 'console.log(`Server is running on port ${port}`);',
];

$RETOS = [
    'index' => [
        'titulo' => '<code>src/index.ts</code>',
        'huecos' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20],
        'codigo' => <<<'EOT'
import express, { Express, Request, Response } from "express";
import cors from "cors";

import { db } from "./config/connectionDB";
import { apiKey } from "./middlewares";
import { recipeRouter } from "./recipes";
import { ingredientRouter } from "./ingredients";

const app: Express = express();

process.loadEnvFile();

const port: number = parseInt(process.env.APP_PORT || "3000");

app.use(cors());
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

app.use("/api", apiKey);

app.use("/api/recipe", recipeRouter);
app.use("/api/ingredient", ingredientRouter);

app.get("/", (req: Request, res: Response) => {
    res.send("API de recetas - Parcial Express");
});

db.then(() =>
    app.listen(port, () => {
        console.log(`Server is running on port ${port}`);
    })
);
EOT
    ],
];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Qué hace <code>app.use(express.json())</code> en este archivo?',
        'opciones' => [
            'a' => 'Conecta la base de datos.',
            'b' => 'Permite leer el cuerpo JSON de las peticiones entrantes como un objeto JavaScript.',
            'c' => 'Inicia el servidor.',
            'd' => 'Protege solo la ruta <code>/</code>.',
        ],
        'correcta' => 'b',
        'porque'   => 'Ese middleware parsea el cuerpo enviado en JSON para poder acceder a <code>req.body</code> en los controllers.',
    ],
    'm2' => [
        'texto'    => '¿Por qué se monta <code>app.use("/api", apiKey)</code> antes de los routers?',
        'opciones' => [
            'a' => 'Porque Express exige ese orden.',
            'b' => 'Porque protege todas las rutas bajo <code>/api</code> antes de que llegue a las rutas de recetas e ingredientes.',
            'c' => 'Porque <code>apiKey</code> no funciona si va después.',
            'd' => 'Porque es el único lugar donde se puede usar.',
        ],
        'correcta' => 'b',
        'porque'   => 'La seguridad del parcial aplica a todo lo que cuelga de <code>/api</code>, así que se mete antes de los routers.',
    ],
    'm3' => [
        'texto'    => '¿Qué variable de entorno se usa para el puerto y por qué hay un fallback?',
        'opciones' => [
            'a' => '<code>PORT</code>, porque siempre existe.',
            'b' => '<code>APP_PORT</code>, con fallback a <code>3000</code> para que la API arranque aunque no venga definida.',
            'c' => '<code>MONGO_URL</code>, porque la app usa la BD para leer el puerto.',
            'd' => 'No hay ninguna variable, se fija en duro.',
        ],
        'correcta' => 'b',
        'porque'   => 'El proyecto del parcial usa <code>APP_PORT</code> y si no está, cae a <code>3000</code>. Eso hace que el arranque sea más robusto.',
    ],
    'm4' => [
        'texto'    => '¿Qué significa <code>db.then(() => app.listen(...))</code> en este archivo?',
        'opciones' => [
            'a' => 'Que la app se conecta a MongoDB y luego inicia el servidor cuando la conexión termina bien.',
            'b' => 'Que el servidor escucha siempre aunque falle la BD.',
            'c' => 'Que el puerto se abre antes de la validación.',
            'd' => 'Que la API usa <code>db</code> como middleware.',
        ],
        'correcta' => 'a',
        'porque'   => 'La promesa de MongoDB se resuelve antes de arrancar el listener, para evitar aceptar peticiones sin base de datos disponible.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Parcial Express — index.ts', 'Preguntas por línea exacta del archivo de arranque');
?>

<div class="card">
  <h2>A. Completa estas líneas tal cual aparecen en el archivo real</h2>

  <p>Escribe la línea exacta del código, sin cambiar comillas, mayúsculas ni puntos y comas.</p>

  <?php linea(1, 'Import principal de Express'); ?>
  <?php linea(2, 'CORS para permitir peticiones desde otros origenes'); ?>
  <?php linea(3, 'Conexión a la base de datos'); ?>
  <?php linea(4, 'Middleware de API key'); ?>
  <?php linea(5, 'Router de recetas'); ?>
  <?php linea(6, 'Router de ingredientes'); ?>
  <?php linea(7, 'Creación de la app'); ?>
  <?php linea(8, 'Carga del .env'); ?>
  <?php linea(9, 'Puerto con valor por defecto'); ?>
  <?php linea(10, 'Middleware de CORS'); ?>
  <?php linea(11, 'Parser de JSON'); ?>
  <?php linea(12, 'Parser de formularios URL encoded'); ?>
  <?php linea(13, 'Protección global de /api'); ?>
  <?php linea(14, 'Montaje del router de recetas'); ?>
  <?php linea(15, 'Montaje del router de ingredientes'); ?>
  <?php linea(16, 'Ruta raíz GET /'); ?>
  <?php linea(17, 'Respuesta del root'); ?>
  <?php linea(18, 'Arranque de la conexión a Mongo'); ?>
  <?php linea(19, 'Inicio del listener del servidor'); ?>
  <?php linea(20, 'Log de arranque del servidor'); ?>

  <?php enviar(); ?>
</div>

<div class="card">
  <h2>B. Preguntas de comprensión</h2>
  <?php mc('m1'); ?>
  <?php mc('m2'); ?>
  <?php mc('m3'); ?>
  <?php mc('m4'); ?>
  <?php enviar(); ?>
</div>

<?php reto('index'); ?>

<div class="card">
  <h2>C. Los cuatro comandos del arranque</h2>

  <p>Esto sí vale la pena tenerlo automatizado en la cabeza, porque son los primeros minutos de cualquier parcial:</p>

  <div class="command-list">
    <div class="command-item">
      <span class="command-number">1</span>
      <div class="command-box"><?php hueco(18, 18); ?></div>
      <div class="command-text">Instalar las dependencias</div>
    </div>
    <div class="command-item">
      <span class="command-number">2</span>
      <div class="command-box"><?php hueco(19, 24); ?></div>
      <div class="command-text">Levantar MongoDB en un contenedor</div>
    </div>
    <div class="command-item">
      <span class="command-number">3</span>
      <div class="command-box"><?php hueco(20, 18); ?></div>
      <div class="command-text">Arrancar el servidor con recarga automática</div>
    </div>
    <div class="command-item">
      <span class="command-number">4</span>
      <div class="command-box"><?php hueco(21, 20); ?></div>
      <div class="command-text">Comprobar que TypeScript no tiene errores, <b>sin generar archivos</b></div>
    </div>
    <div class="command-item">
      <span class="command-number">5</span>
      <div class="command-box"><?php hueco(22, 16); ?></div>
      <div class="command-text">Correr las pruebas, si el proyecto las trae</div>
    </div>
  </div>

  <div class="avisoflujo">El punto 4 es el que más tiempo salva: <code>ts-node</code> y
     <code>nodemon</code> solo te avisan del error del archivo que están ejecutando, mientras
     que <code>tsc --noEmit</code> revisa el proyecto entero de una vez.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('Menu.php', 'segundo.php');
