<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   PARCIAL 3 — La API_KEY, el arranque y los middlewares
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A: apiKey.middleware.ts --- */
    1  => ['x-api-key', 'x_api_key'],
    2  => '20',
    3  => 'header',
    4  => 'API_KEY_HEADER',
    5  => '401',
    6  => ['return', 'return;'],
    7  => 'length',
    8  => 'API_KEY_MIN_LENGTH',
    9  => ['API_KEY', 'process.env.API_KEY'],
    10 => 'received',
    11 => 'next',

    /* --- B: donde se monta --- */
    12 => ['/api', 'api'],
    13 => ['no', 'NO'],
    14 => ['401', '403'],

    /* --- C: index.ts --- */
    15 => 'cors',
    16 => 'json',
    17 => 'urlencoded',
    18 => 'apiKey',
    19 => ['/api/recipe', 'api/recipe'],
    20 => 'recipeRouter',
    21 => ['/api/ingredient', 'api/ingredient'],
    22 => 'ingredientRouter',

    /* --- D: connectionDB.ts --- */
    23 => 'express',
    24 => 'loadEnvFile',
    25 => 'APP_PORT',
    26 => 'db',
    27 => 'listen',
    28 => 'MONGO_URI',
    29 => 'connect',

    /* --- E: validate.middleware.ts --- */
    30 => 'ZodType',
    31 => 'NextFunction',
    32 => 'parseAsync',
    33 => ['req.body', 'body'],
    34 => 'next',
    35 => '400',

    /* --- F: objectId.middleware.ts --- */
    36 => 'isValidObjectId',
    37 => 'params',
    38 => '400',
    39 => ['CastError', 'cast error'],
    40 => '500',

    /* --- G: firmas --- */
    41 => 'export const apiKey = (req: Request, res: Response, next: NextFunction) => {',
    42 => 'export const validateSchema = (schema: ZodType) => {',
    43 => 'export const validateObjectId = (param: string = "id") => {',

    /* --- H: lineas completas --- */
    44 => 'const received: string | undefined = req.header(API_KEY_HEADER);',
    45 => 'if (received.length < API_KEY_MIN_LENGTH) {',
    46 => 'const expected: string = process.env.API_KEY || "";',
    47 => 'app.use("/api", apiKey);',
    48 => 'req.body = await schema.parseAsync(req.body);',
    49 => 'const value: string = req.params[param] as string || "";',
    50 => 'export const db = mongoose.connect(connectionString)',
];

$RETOS = [

'apikey' => [
    'titulo' => '<code>src/middlewares/apiKey.middleware.ts</code>',
    'huecos' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 41],
    'codigo' => <<<'EOT'
import { NextFunction, Request, Response } from "express";

export const API_KEY_HEADER = "x-api-key";
export const API_KEY_MIN_LENGTH = 20;

export const apiKey = (req: Request, res: Response, next: NextFunction) => {
    const received: string | undefined = req.header(API_KEY_HEADER);

    if (!received) {
        res.status(401).json({ message: "API key is required" });
        return;
    }

    if (received.length < API_KEY_MIN_LENGTH) {
        res.status(401).json({
            message: `API key must be at least ${API_KEY_MIN_LENGTH} characters long`
        });
        return;
    }

    const expected: string = process.env.API_KEY || "";

    if (expected === "" || received !== expected) {
        res.status(401).json({ message: "Invalid API key" });
        return;
    }

    next();
};
EOT
],

'appts' => [
    'titulo' => '<code>src/index.ts</code>',
    'huecos' => [15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27],
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

'validate' => [
    'titulo' => 'los dos middlewares genericos (<code>validateSchema</code> y <code>validateObjectId</code>)',
    'huecos' => [30, 31, 32, 33, 34, 35, 36, 37, 38, 42, 43],
    'codigo' => <<<'EOT'
import { NextFunction, Request, Response } from "express";
import { isValidObjectId } from "mongoose";
import { ZodType } from "zod";

export const validateSchema = (schema: ZodType) => {
    return async (req: Request, res: Response, next: NextFunction) => {
        try {
            req.body = await schema.parseAsync(req.body);
            next();
        } catch (error) {
            res.status(400).json(error);
        }
    };
};

export const validateObjectId = (param: string = "id") => {
    return (req: Request, res: Response, next: NextFunction) => {
        const value: string = req.params[param] as string || "";

        if (!isValidObjectId(value)) {
            res.status(400).json({ message: `${param} is not a valid ObjectId` });
            return;
        }

        next();
    };
};
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '<code>app.use("/api", apiKey)</code> se escribe <b>antes</b> de montar los routers. ¿Que pasaria si lo pones despues?',
        'opciones' => [
            'a' => 'Nada, Express ordena los middlewares solo.',
            'b' => 'Las rutas ya montadas responderian <b>sin pedir la key</b>: Express recorre la cadena en el orden en que la registraste, y el router responde antes de llegar al middleware.',
            'c' => 'Express lanza un error al arrancar.',
            'd' => 'Solo afectaria a los POST.',
        ],
        'correcta' => 'b',
        'porque'   => 'Es el mismo principio del orden de rutas: registrar es construir una cadena, y el primero que responde corta el paso.',
    ],
    'm2' => [
        'texto'    => '¿Por que <code>GET /</code> no pide la API key?',
        'opciones' => [
            'a' => 'Porque los GET estan exentos.',
            'b' => 'Porque el middleware se monto con el prefijo <code>/api</code>, y <code>/</code> no empieza por ahi. Es intencional: sirve como comprobacion de que el servidor esta vivo.',
            'c' => 'Porque no tiene router.',
            'd' => 'Es un bug.',
        ],
        'correcta' => 'b',
        'porque'   => 'Si quisieras protegerlo todo pondrias <code>app.use(apiKey)</code> sin prefijo, pero entonces te quedas sin health check.',
    ],
    'm3' => [
        'texto'    => 'El enunciado dice "si MINIMO 20 CARACTERES no es especificada como custom header, debe rechazar". ¿Que hay que comprobar?',
        'opciones' => [
            'a' => 'Solo que el header exista.',
            'b' => 'Solo que tenga 20 caracteres.',
            'c' => 'Las dos cosas, y ademas que coincida con la del <code>.env</code>: una key de 25 caracteres inventada no deberia abrir la API.',
            'd' => 'Que el header se llame exactamente <code>API_KEY</code>.',
        ],
        'correcta' => 'c',
        'porque'   => 'La frase esta mal redactada. La lectura defendible es: header presente + longitud minima + valor correcto. Comprobar solo la longitud dejaria la API abierta a cualquiera.',
    ],
    'm4' => [
        'texto'    => 'Todo el arranque vive en <code>index.ts</code>, igual que en el proyecto del curso. ¿Que consecuencia tiene si manaña quisieras probarlo con Jest?',
        'opciones' => [
            'a' => 'Ninguna, los tests pueden importar <code>index.ts</code> sin mas.',
            'b' => 'Que importarlo desde un test <b>arrancaria el servidor de verdad</b>: se ejecutaria el <code>listen</code> y la conexion a Mongo. Por eso los tests de este proyecto montan su propia app con los mismos routers.',
            'c' => 'Que Jest no puede probar aplicaciones de Express.',
            'd' => 'Que hay que borrar el <code>db.then</code>.',
        ],
        'correcta' => 'b',
        'porque'   => 'Importar un modulo <b>ejecuta</b> su codigo de arriba abajo. Quien quiera evitarlo separa la creacion de la app del <code>listen</code>, o lo envuelve en <code>if (require.main === module)</code>. Para el parcial no hace falta: un solo archivo es lo que pide la convencion del curso.',
    ],
    'm5' => [
        'texto'    => 'Sin <code>validateObjectId</code>, ¿que devuelve <code>GET /api/recipe/abc</code>?',
        'opciones' => [
            'a' => '404, porque no existe.',
            'b' => '400 automatico de Express.',
            'c' => '<b>500</b>: Mongoose no puede convertir "abc" a ObjectId, lanza un <code>CastError</code>, y el <code>catch</code> del controller responde 500 aunque el error sea del cliente.',
            'd' => '200 con null.',
        ],
        'correcta' => 'c',
        'porque'   => 'Un 500 dice "me rompi yo". Aqui el que se equivoco fue el cliente, asi que corresponde 400. Es un detalle que suma en la nota.',
    ],
    'm6' => [
        'texto'    => '<code>req.body = await schema.parseAsync(req.body)</code> — ¿que aporta la reasignacion respecto a solo validar?',
        'opciones' => [
            'a' => 'Nada, es cosmetico.',
            'b' => 'Que las capas de abajo reciben el objeto que <b>devuelve Zod</b>, ya limpio: los campos que no estan en el schema se descartan. Por eso un <code>recipeId</code> colado en el update del ingrediente no llega al service.',
            'c' => 'Que se valida dos veces.',
            'd' => 'Que Zod guarda en Mongo.',
        ],
        'correcta' => 'b',
        'porque'   => 'Sin la reasignacion, <code>req.body</code> sigue siendo el objeto crudo del cliente, con todo lo que haya metido de mas.',
    ],
    'm7' => [
        'texto'    => '<code>validateObjectId(param: string = "id")</code> recibe el nombre del parametro. ¿Para que?',
        'opciones' => [
            'a' => 'Para poder reutilizarlo en <code>/api/ingredient/recipe/:recipeId</code>, donde el parametro no se llama <code>id</code>.',
            'b' => 'Para el mensaje de error unicamente.',
            'c' => 'Para elegir el modelo.',
            'd' => 'No sirve para nada, siempre es "id".',
        ],
        'correcta' => 'a',
        'porque'   => 'Es el mismo patron de <code>validateSchema</code>: una funcion que recibe una configuracion y devuelve el middleware ya configurado.',
    ],
    'm8' => [
        'texto'    => 'La API key se lee con <code>process.env.API_KEY</code> dentro del middleware, y si esta vacia se rechaza todo. ¿Es buena idea?',
        'opciones' => [
            'a' => 'No, deberia dejar pasar si no hay key configurada.',
            'b' => 'Si: <b>fallar cerrado</b>. Si olvidaste poner <code>API_KEY</code> en el <code>.env</code>, la API queda bloqueada en vez de quedar abierta al mundo.',
            'c' => 'Da igual.',
            'd' => 'Es un error, hay que lanzar una excepcion al arrancar.',
        ],
        'correcta' => 'b',
        'porque'   => 'Ante una configuracion incompleta, la opcion segura es denegar. Avisar al arrancar tambien es valido, pero nunca abrir.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Parcial 3 — API_KEY, arranque y middlewares', 'El 20% de la nota, mas el esqueleto que sostiene todo lo demas');
?>

<div class="card">
  <h2>A. <code>src/middlewares/apiKey.middleware.ts</code></h2>

<pre><code>import { NextFunction, Request, Response } from "express";

export const API_KEY_HEADER = "<?php hueco(1, 11); ?>";
export const API_KEY_MIN_LENGTH = <?php hueco(2, 4); ?>;

<?php firma(41, 66); ?>

    const <?php hueco(10, 10); ?>: string | undefined = req.<?php hueco(3, 8); ?>(<?php hueco(4, 16); ?>);

    if (!received) {
        res.status(<?php hueco(5, 5); ?>).json({ message: "API key is required" });
        // sin la siguiente linea la funcion seguiria ejecutandose
        <?php hueco(6, 8); ?>;
    }

    if (received.<?php hueco(7, 8); ?> &lt; <?php hueco(8, 20); ?>) {
        res.status(401).json({
            message: `API key must be at least ${API_KEY_MIN_LENGTH} characters long`
        });
        return;
    }

    const expected: string = process.env.<?php hueco(9, 10); ?> || "";

    if (expected === "" || received !== expected) {
        res.status(401).json({ message: "Invalid API key" });
        return;
    }

    <?php hueco(11, 6); ?>();
};</code></pre>

  <div class="nota"><b>Tres comprobaciones, no una.</b> El enunciado esta mal redactado
     ("si MINIMO 20 CARACTERES no es especificada como custom header"). La lectura defendible
     es: que el header <b>venga</b>, que tenga <b>al menos 20 caracteres</b>, y que
     <b>coincida</b> con la del <code>.env</code>. Comprobar solo la longitud dejaria la API
     abierta a cualquiera que mande 20 letras al azar.</div>

  <?php reto('apikey'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. Donde se monta y a que afecta</h2>

  <p>El middleware se monta con un prefijo, no sobre toda la app:</p>

<pre><code>app.use("<?php hueco(12, 7); ?>", apiKey);</code></pre>

  <p>Eso significa que <code>GET /</code> <?php hueco(13, 5); ?> pide la key
     (queda fuera del prefijo y sirve para comprobar que el servidor esta vivo), y que todo lo
     que cuelgue de ahi si la pide.</p>

  <p>El codigo con el que se rechaza es <?php hueco(14, 6); ?>.</p>

  <div class="avisoflujo"><b>El orden manda.</b> Esta linea va <b>antes</b> de montar los
     routers. Si la pones despues, los routers responden primero y la API queda sin proteger.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>src/index.ts</code> — el punto de entrada, entero</h2>

  <p>Mismo esqueleto que el <code>index.ts</code> del curso: importar, crear la app, cargar el
     <code>.env</code>, registrar middlewares, montar routers, y esperar a Mongo para escuchar.</p>

<pre><code>import express, { Express, Request, Response } from "express";
import cors from "cors";

import { db } from "./config/connectionDB";
import { apiKey } from "./middlewares";
import { recipeRouter } from "./recipes";
import { ingredientRouter } from "./ingredients";

const app: Express = <?php hueco(23, 9); ?>();

process.<?php hueco(24, 12); ?>();

const port: number = parseInt(process.env.<?php hueco(25, 10); ?> || "3000");

app.use(<?php hueco(15, 6); ?>());
app.use(express.<?php hueco(16, 6); ?>());
app.use(express.<?php hueco(17, 11); ?>({ extended: true }));

app.use("/api", <?php hueco(18, 8); ?>);

app.use("<?php hueco(19, 14); ?>", <?php hueco(20, 13); ?>);
app.use("<?php hueco(21, 17); ?>", <?php hueco(22, 16); ?>);

app.get("/", (req: Request, res: Response) =&gt; {
    res.send("API de recetas - Parcial Express");
});

<?php hueco(26, 4); ?>.then(() =&gt;
    app.<?php hueco(27, 8); ?>(port, () =&gt; {
        console.log(`Server is running on port ${port}`);
    })
);</code></pre>

  <?php reto('appts'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. <code>src/config/connectionDB.ts</code></h2>

<pre><code>import mongoose from "mongoose";

process.loadEnvFile();

const connectionString: string = process.env.<?php hueco(28, 11); ?> || "";

export const db = mongoose.<?php hueco(29, 9); ?>(connectionString)
    .then(() =&gt; console.log("Connected to MongoDB"))
    .catch((error) =&gt; console.error(error));</code></pre>

  <div class="nota">Dos nombres que cambian respecto al proyecto del curso: aqui la variable
     del puerto es <code>APP_PORT</code> (no <code>PORT</code>) y la de Mongo es
     <code>MONGO_URI</code> (no <code>MONGO_URL</code>). Si te equivocas, el servidor arranca
     en el puerto por defecto y la conexion falla en silencio.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. <code>validate.middleware.ts</code> — el mismo patron del curso, con Zod</h2>

<pre><code>import { NextFunction, Request, Response } from "express";
import { <?php hueco(30, 10); ?> } from "zod";

<?php firma(42, 46); ?>

    return async (req: Request, res: Response, next: <?php hueco(31, 14); ?>) =&gt; {
        try {
            req.body = await schema.<?php hueco(32, 12); ?>(<?php hueco(33, 10); ?>);
            <?php hueco(34, 6); ?>();
        } catch (error) {
            res.status(<?php hueco(35, 5); ?>).json(error);
        }
    };
};</code></pre>

  <div class="avisoflujo">La diferencia con el del curso: aqui se <b>reasigna</b>
     <code>req.body</code> con lo que devuelve Zod. Asi los campos que no estan en el schema
     se descartan y las capas de abajo reciben el objeto ya limpio.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. <code>objectId.middleware.ts</code> — el que evita los 500 tontos</h2>

<pre><code>import { NextFunction, Request, Response } from "express";
import { <?php hueco(36, 16); ?> } from "mongoose";

<?php firma(43, 52); ?>

    return (req: Request, res: Response, next: NextFunction) =&gt; {
        const value: string = req.<?php hueco(37, 8); ?>[param] as string || "";

        if (!isValidObjectId(value)) {
            res.status(<?php hueco(38, 5); ?>).json({ message: `${param} is not a valid ObjectId` });
            return;
        }

        next();
    };
};</code></pre>

  <p>Sin esto, una peticion a <code>/api/recipe/abc</code> hace que Mongoose lance un
     <?php hueco(39, 12); ?> y el <code>catch</code> del controller acabe respondiendo
     <?php hueco(40, 5); ?>, aunque el error sea del cliente.</p>

  <?php reto('validate'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. De memoria: escribe la linea completa</h2>

  <?php linea(44, 'Leer la API key del header (linea completa, con el tipo):'); ?>
  <?php linea(45, 'La condicion que comprueba la <b>longitud minima</b> de la key:'); ?>
  <?php linea(46, 'Leer del entorno la key esperada, con "" por defecto:'); ?>
  <?php linea(47, 'Proteger con la key todo lo que cuelgue de <code>/api</code>:'); ?>
  <?php linea(48, 'Validar el body con Zod y dejar en <code>req.body</code> el objeto ya limpio:'); ?>
  <?php linea(49, 'Sacar del <code>req</code> el parametro cuyo nombre recibio el middleware:'); ?>
  <?php linea(50, 'La primera linea de la conexion exportada de Mongoose:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('segundo.php', 'cuarto.php');
