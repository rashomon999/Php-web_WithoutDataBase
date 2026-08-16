<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   PARCIAL 4 — Recipe completo (40% de la nota)
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A: recipe.schema.ts (Zod) --- */
    1  => 'zod',
    2  => ['as const', 'const'],
    3  => 'object',
    4  => 'string',
    5  => 'min',
    6  => 'optional',
    7  => ['zEnum', 'enum', 'z.enum'],
    8  => 'number',
    9  => 'positive',
    10 => 'partial',

    /* --- B: recipe.route.ts --- */
    11 => 'Router',
    12 => 'post',
    13 => 'validateSchema',
    14 => 'createRecipeSchema',
    15 => 'create',
    16 => 'get',
    17 => 'findAll',
    18 => ['/:id', ':id'],
    19 => 'validateObjectId',
    20 => 'findById',
    21 => 'put',
    22 => 'updateRecipeSchema',
    23 => 'delete',

    /* --- C: recipe.service.ts --- */
    24 => 'RecipeModel',
    25 => 'create',
    26 => 'find',
    27 => 'findById',
    28 => 'findByIdAndUpdate',
    29 => ['new', 'new: true'],
    30 => 'findByIdAndDelete',
    31 => 'deleteMany',
    32 => ['null', 'NULL'],

    /* --- D: recipe.controller.ts --- */
    33 => 'recipeService',
    34 => 'RecipeInput',
    35 => '201',
    36 => '500',
    37 => 'params',
    38 => ['null', 'NULL'],
    39 => '404',
    40 => 'RecipeUpdate',

    /* --- E: los codigos de cada caso --- */
    41 => '201',
    42 => '400',
    43 => '400',
    44 => '404',
    45 => '401',

    /* --- F: firmas --- */
    46 => 'public async create(req: Request, res: Response) {',
    47 => 'public update(id: string, recipeUpdate: RecipeUpdate): Promise<RecipeDocument | null> {',
    48 => 'public async delete(id: string): Promise<RecipeDocument | null> {',

    /* --- G: lineas completas --- */
    49 => 'recipeRouter.post("/", validateSchema(createRecipeSchema), recipeController.create);',
    50 => 'recipeRouter.get("/:id", validateObjectId(), recipeController.findById);',
    51 => 'recipeRouter.put("/:id", validateObjectId(), validateSchema(updateRecipeSchema), recipeController.update);',
    52 => 'return RecipeModel.findByIdAndUpdate(id, recipeUpdate, { new: true });',
    53 => 'await IngredientModel.deleteMany({ recipeId: id });',
    54 => 'export const updateRecipeSchema = createRecipeSchema.partial();',
];

$RETOS = [

'schema' => [
    'titulo' => '<code>src/recipes/recipe.schema.ts</code>',
    'huecos' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    'codigo' => <<<'EOT'
import { object, string, number, enum as zEnum } from 'zod';

export const DIFFICULTIES = ["easy", "medium", "hard"] as const;

export const createRecipeSchema = object({
    name: string({ error: "Name is required" })
           .min(1, "Name is required"),
    description: string().optional(),
    difficulty: zEnum(DIFFICULTIES, { error: "Difficulty must be easy, medium or hard" }).optional(),
    preparationTimeMinutes: number({ error: "preparationTimeMinutes must be a number" })
                             .int().positive().optional(),
    servings: number({ error: "servings must be a number" })
               .int().positive().optional()
});

export const updateRecipeSchema = createRecipeSchema.partial();
EOT
],

'route' => [
    'titulo' => '<code>src/recipes/recipe.route.ts</code>',
    'huecos' => [11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
    'codigo' => <<<'EOT'
import express from "express";
import { recipeController } from "./recipe.controller";
import { validateSchema, validateObjectId } from "../middlewares";
import { createRecipeSchema, updateRecipeSchema } from "./recipe.schema";

export const recipeRouter = express.Router();

recipeRouter.post("/", validateSchema(createRecipeSchema), recipeController.create);

recipeRouter.get("/", recipeController.findAll);

recipeRouter.get("/:id", validateObjectId(), recipeController.findById);

recipeRouter.put("/:id", validateObjectId(), validateSchema(updateRecipeSchema), recipeController.update);

recipeRouter.delete("/:id", validateObjectId(), recipeController.delete);
EOT
],

'service' => [
    'titulo' => '<code>src/recipes/recipe.service.ts</code>',
    'huecos' => [24, 25, 26, 27, 28, 29, 30, 31, 32, 47, 48],
    'codigo' => <<<'EOT'
import { RecipeInput, RecipeUpdate } from "./recipe.interface";
import { RecipeDocument, RecipeModel } from "./recipe.model";
import { IngredientModel } from "../ingredients/ingredient.model";

class RecipeService {

    public create(recipeInput: RecipeInput): Promise<RecipeDocument> {
        return RecipeModel.create(recipeInput);
    }

    public findAll(): Promise<RecipeDocument[]> {
        return RecipeModel.find();
    }

    public findById(id: string): Promise<RecipeDocument | null> {
        return RecipeModel.findById(id);
    }

    public update(id: string, recipeUpdate: RecipeUpdate): Promise<RecipeDocument | null> {
        return RecipeModel.findByIdAndUpdate(id, recipeUpdate, { new: true });
    }

    public async delete(id: string): Promise<RecipeDocument | null> {
        const deleted: RecipeDocument | null = await RecipeModel.findByIdAndDelete(id);

        if (deleted !== null) {
            await IngredientModel.deleteMany({ recipeId: id });
        }

        return deleted;
    }
}

export const recipeService = new RecipeService();
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'Sin <code>{ new: true }</code> en <code>findByIdAndUpdate</code>, ¿que recibe el cliente en un PUT?',
        'opciones' => [
            'a' => 'Un 404.',
            'b' => 'El documento <b>anterior</b> a la actualizacion. El cambio si se guarda, pero la respuesta parece decir que no paso nada.',
            'c' => 'El documento actualizado igual.',
            'd' => 'Un error de Mongoose.',
        ],
        'correcta' => 'b',
        'porque'   => 'Es de los errores mas faciles de cometer y mas faciles de detectar en Postman: actualizas, ves el valor viejo, y crees que el PUT no funciona.',
    ],
    'm2' => [
        'texto'    => '<code>updateRecipeSchema = createRecipeSchema.partial()</code>. ¿Que consigue?',
        'opciones' => [
            'a' => 'Que el update valide exactamente igual que el create.',
            'b' => 'Que <b>todos</b> los campos pasen a ser opcionales, de modo que un PUT pueda mandar solo <code>servings</code> sin que Zod exija <code>name</code>.',
            'c' => 'Que solo se pueda actualizar la mitad de los campos.',
            'd' => 'Que se ignore la validacion.',
        ],
        'correcta' => 'b',
        'porque'   => 'Un PUT estricto exigiria el recurso entero; aqui se acepta parcial, que es lo que la coleccion de Postman envia y lo mas comodo. Lo importante es que las <b>reglas</b> (tipos, enum, positivos) se siguen aplicando a lo que si venga.',
    ],
    'm3' => [
        'texto'    => 'En la ruta del PUT hay <b>tres</b> middlewares antes del controller. ¿En que orden se ejecutan y por que ese orden?',
        'opciones' => [
            'a' => 'Da igual el orden.',
            'b' => 'apiKey &rarr; validateObjectId &rarr; validateSchema: primero se comprueba quien eres, luego que la URL tenga sentido, y solo entonces se gasta trabajo en validar el cuerpo.',
            'c' => 'validateSchema primero, porque el body es lo importante.',
            'd' => 'El controller primero.',
        ],
        'correcta' => 'b',
        'porque'   => 'De lo mas barato y mas general a lo mas especifico. Validar un body enorme para luego descubrir que el id estaba mal formado es trabajo tirado.',
    ],
    'm4' => [
        'texto'    => 'El borrado en cascada esta en el <b>service</b>, no en el controller. ¿Por que ahi?',
        'opciones' => [
            'a' => 'Porque el controller no puede usar await.',
            'b' => 'Porque "al borrar una receta desaparecen sus ingredientes" es una <b>regla de negocio</b>: el controller solo traduce HTTP, y quien decide que implica borrar es el service.',
            'c' => 'Porque el controller no importa IngredientModel.',
            'd' => 'Por rendimiento.',
        ],
        'correcta' => 'b',
        'porque'   => 'Ademas asi la regla se aplica siempre, aunque manaña borres una receta desde un script o desde otro endpoint.',
    ],
    'm5' => [
        'texto'    => 'El enunciado no pide el borrado en cascada. ¿Que pasa si no lo haces?',
        'opciones' => [
            'a' => 'MongoDB borra los ingredientes solo, por el <code>ref</code>.',
            'b' => 'Nada, es imposible que ocurra.',
            'c' => 'Quedan ingredientes <b>huerfanos</b>: documentos con un <code>recipeId</code> que ya no apunta a nada, y <code>GET /api/ingredient/recipe/:id</code> seguiria devolviendolos.',
            'd' => 'Falla el DELETE.',
        ],
        'correcta' => 'c',
        'porque'   => 'MongoDB no tiene integridad referencial: el <code>ref</code> es solo informacion para <code>populate()</code>. Si no lo limpias tu, nadie lo hace.',
    ],
    'm6' => [
        'texto'    => '¿Por que <code>create</code> del service no lleva <code>async</code> y <code>delete</code> si?',
        'opciones' => [
            'a' => 'Por descuido.',
            'b' => 'Porque <code>create</code> solo <b>devuelve</b> la promesa de Mongoose sin tocarla, mientras que <code>delete</code> necesita <code>await</code> del primer resultado para decidir si borra los ingredientes.',
            'c' => 'Porque delete es mas lento.',
            'd' => 'Porque create no devuelve nada.',
        ],
        'correcta' => 'b',
        'porque'   => 'Si no hay que esperar nada dentro de la funcion, devolver la promesa tal cual es equivalente y mas corto. <code>async</code> solo hace falta cuando usas <code>await</code>.',
    ],
    'm7' => [
        'texto'    => 'Llega <code>POST /api/recipe</code> con <code>{"name": "Arepa", "difficulty": "extrema"}</code>. ¿Que responde y quien decide?',
        'opciones' => [
            'a' => '<b>400</b>, y lo decide Zod en el middleware: la peticion ni siquiera llega al controller.',
            'b' => '500, porque el enum de Mongoose falla al guardar.',
            'c' => '201, el enum solo es informativo.',
            'd' => '422.',
        ],
        'correcta' => 'a',
        'porque'   => 'Si quitaras la validacion de Zod, el enum de Mongoose si lo rechazaria, pero como <code>ValidationError</code> dentro del <code>catch</code>, y saldria como 500.',
    ],
    'm8' => [
        'texto'    => '<code>findAll</code> devuelve <code>res.json(recipes)</code> con un array vacio si no hay recetas. ¿Deberia ser 404?',
        'opciones' => [
            'a' => 'Si, no hay nada que devolver.',
            'b' => 'No: la <b>coleccion existe</b>, simplemente esta vacia. <code>200</code> con <code>[]</code> es la respuesta correcta. El 404 es para un recurso concreto que no existe.',
            'c' => 'Deberia ser 204.',
            'd' => 'Deberia ser 400.',
        ],
        'correcta' => 'b',
        'porque'   => 'Un 404 en una lista obliga al cliente a tratar "vacio" como un error. Distinto es <code>GET /api/recipe/:id</code>, donde ese id concreto si puede no existir.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Parcial 4 — Recipe completo', 'Schema de Zod, rutas, service y controller: el 40% de la nota');
?>

<div class="card">
  <h2>A. <code>src/recipes/recipe.schema.ts</code> — la validacion con Zod</h2>

<pre><code>import { object, string, number, enum as zEnum } from '<?php hueco(1, 6); ?>';

export const DIFFICULTIES = ["easy", "medium", "hard"] <?php hueco(2, 10); ?>;

export const createRecipeSchema = <?php hueco(3, 8); ?>({
    name: <?php hueco(4, 8); ?>({ error: "Name is required" })
            .<?php hueco(5, 5); ?>(1, "Name is required"),

    description: string().<?php hueco(6, 10); ?>(),

    difficulty: <?php hueco(7, 7); ?>(DIFFICULTIES, { error: "..." }).optional(),

    preparationTimeMinutes: <?php hueco(8, 8); ?>({ error: "..." })
                                .int().<?php hueco(9, 10); ?>().optional(),

    servings: number({ error: "..." }).int().positive().optional()
});

export const updateRecipeSchema = createRecipeSchema.<?php hueco(10, 9); ?>();</code></pre>

  <h3>Comparalo con el <code>user.schema.ts</code> del curso</h3>

  <p>Es el <b>mismo</b> esqueleto que ya estudiaste. Lo unico que no habias visto es
     <code>zEnum</code>, porque el <code>User</code> del curso no tenia ningun campo con enum:</p>

<pre><code>CURSO — user.schema.ts                      PARCIAL — recipe.schema.ts

import {object, string, email}              import {object, string, number,
       from 'zod';                                 enum as zEnum} from 'zod';        ← lo unico nuevo

object({                                    object({
   name: string({error: "..."}),               name: string({error: "..."})
                                                       .min(1, "..."),
   email: email({error: "..."}),               description: string().optional(),

   password: string({error: "..."})            difficulty: zEnum([...]).optional(),  ← lo unico nuevo
             .min(8, "...")                    servings: number().int()
                                                         .positive().optional()
});                                         });</code></pre>

  <div class="nota"><b>Por que <code>enum as zEnum</code> y no <code>enum</code> a secas.</b>
     <code>enum</code> es palabra reservada en TypeScript, asi que
     <code>import { enum } from 'zod'</code> <b>no compila</b>
     (<code>error TS1003: Identifier expected</code>). Hay que renombrarla al importar.
     <br><br>
     El otro estilo, <code>import { z } from 'zod'</code> y luego <code>z.enum(...)</code>, no
     tiene ese problema. Son <b>exactamente</b> las mismas funciones —
     <code>z.object === object</code> devuelve <code>true</code> — solo cambia como las traes.
     Aqui se usa el estilo del curso para que todo lo que repasas se vea igual, pero en los
     huecos se aceptan las dos formas.</div>

  <div class="nota"><code>as const</code> congela el array para que TypeScript lo lea como
     los tres literales exactos y no como <code>string[]</code>. Asi <code>zEnum</code> puede
     derivar el tipo <code>"easy" | "medium" | "hard"</code>.</div>

  <?php reto('schema'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>src/recipes/recipe.route.ts</code></h2>

<pre><code>import express from "express";
import { recipeController } from "./recipe.controller";
import { validateSchema, validateObjectId } from "../middlewares";
import { createRecipeSchema, updateRecipeSchema } from "./recipe.schema";

export const recipeRouter = express.<?php hueco(11, 8); ?>();

recipeRouter.<?php hueco(12, 6); ?>("/", <?php hueco(13, 15); ?>(<?php hueco(14, 20); ?>), recipeController.<?php hueco(15, 8); ?>);

recipeRouter.<?php hueco(16, 5); ?>("/", recipeController.<?php hueco(17, 9); ?>);

recipeRouter.get("<?php hueco(18, 6); ?>", <?php hueco(19, 17); ?>(), recipeController.<?php hueco(20, 9); ?>);

recipeRouter.<?php hueco(21, 5); ?>("/:id", validateObjectId(), validateSchema(<?php hueco(22, 20); ?>), recipeController.update);

recipeRouter.<?php hueco(23, 8); ?>("/:id", validateObjectId(), recipeController.delete);</code></pre>

  <div class="avisoflujo">Aqui no hay conflicto de orden entre <code>/</code> y <code>/:id</code>
     porque el numero de segmentos es distinto. El caso peligroso del curso
     (<code>/profile</code> antes de <code>/:id</code>) aparece en el siguiente cuestionario,
     con los ingredientes.</div>

  <?php reto('route'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>src/recipes/recipe.service.ts</code></h2>

<pre><code>class RecipeService {

    public create(recipeInput: RecipeInput): Promise&lt;RecipeDocument&gt; {
        return <?php hueco(24, 12); ?>.<?php hueco(25, 8); ?>(recipeInput);
    }

    public findAll(): Promise&lt;RecipeDocument[]&gt; {
        return RecipeModel.<?php hueco(26, 6); ?>();
    }

    public findById(id: string): Promise&lt;RecipeDocument | null&gt; {
        return RecipeModel.<?php hueco(27, 10); ?>(id);
    }

<?php firma(47, 84); ?>

        return RecipeModel.<?php hueco(28, 18); ?>(id, recipeUpdate, { <?php hueco(29, 10); ?>: true });
    }

<?php firma(48, 56); ?>

        const deleted: RecipeDocument | null = await RecipeModel.<?php hueco(30, 18); ?>(id);

        if (deleted !== <?php hueco(32, 6); ?>) {
            await IngredientModel.<?php hueco(31, 12); ?>({ recipeId: id });
        }

        return deleted;
    }
}</code></pre>

  <div class="nota"><b>El detalle que mas se falla:</b> sin <code>{ new: true }</code>,
     <code>findByIdAndUpdate</code> devuelve el documento <b>viejo</b>. El cambio se guarda,
     pero la respuesta hace pensar que el PUT no sirvio.</div>

  <?php reto('service'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. <code>src/recipes/recipe.controller.ts</code></h2>

<pre><code><?php firma(46, 50); ?>

        try {
            const recipe: RecipeDocument = await <?php hueco(33, 13); ?>.create(req.body as <?php hueco(34, 12); ?>);
            res.status(<?php hueco(35, 5); ?>).json(recipe);
        } catch (error) {
            res.status(<?php hueco(36, 5); ?>).json(error);
        }
    }

    public async findById(req: Request, res: Response) {
        try {
            const id: string = req.<?php hueco(37, 8); ?>.id as string || '';
            const recipe: RecipeDocument | null = await recipeService.findById(id);

            if (recipe === <?php hueco(38, 6); ?>) {
                res.status(<?php hueco(39, 5); ?>).json({ message: `Recipe with id ${id} not found` });
                return;
            }

            res.json(recipe);
        } catch (error) {
            res.status(500).json(error);
        }
    }

    public async update(req: Request, res: Response) {
        // ...
        const recipe = await recipeService.update(id, req.body as <?php hueco(40, 13); ?>);
        // ...
    }</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Que codigo devuelve cada caso</h2>

<pre><code>POST /api/recipe con body valido                    →  <?php hueco(41, 5); ?>

POST /api/recipe sin name                           →  <?php hueco(42, 5); ?>

GET /api/recipe/abc  (id mal formado)               →  <?php hueco(43, 5); ?>

GET /api/recipe/68f0...  (id valido, no existe)     →  <?php hueco(44, 5); ?>

GET /api/recipe sin el header de la API key         →  <?php hueco(45, 5); ?>

GET /api/recipe sin recetas en la base              →  200 con []</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. De memoria: escribe la linea completa</h2>

  <?php linea(49, 'La ruta de <b>crear</b> receta, con su validacion:'); ?>
  <?php linea(50, 'La ruta de <b>buscar por id</b>, con la guarda del ObjectId:'); ?>
  <?php linea(51, 'La ruta de <b>actualizar</b>, con sus dos guardas:'); ?>
  <?php linea(52, 'En el service: el update que devuelve el documento <b>ya actualizado</b>:'); ?>
  <?php linea(53, 'En el service: el borrado en <b>cascada</b> de los ingredientes:'); ?>
  <?php linea(54, 'El schema de update derivado del de create:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('tercero.php', 'quinto.php');
