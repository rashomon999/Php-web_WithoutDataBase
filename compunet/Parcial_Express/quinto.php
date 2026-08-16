<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   PARCIAL 5 — Ingredient completo (40% de la nota)
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A: ingredient.schema.ts --- */
    1  => 'string',
    2  => 'recipeId',
    3  => 'positive',
    4  => 'boolean',
    5  => 'omit',
    6  => 'partial',

    /* --- B: ingredient.route.ts --- */
    7  => 'post',
    8  => 'createIngredientSchema',
    9  => ['/recipe/:recipeId', 'recipe/:recipeId'],
    10 => ['recipeId', '"recipeId"'],
    11 => 'findByRecipeId',
    12 => ['/:id', ':id'],
    13 => 'findById',
    14 => 'updateIngredientSchema',
    15 => 'delete',

    /* --- C: por que no chocan --- */
    16 => ['2', 'dos'],
    17 => ['1', 'uno'],
    18 => ['no', 'NO'],

    /* --- D: ingredient.service.ts --- */
    19 => 'RecipeModel',
    20 => ['null', 'NULL'],
    21 => 'ReferenceError',
    22 => 'IngredientModel',
    23 => 'create',
    24 => 'findById',
    25 => 'find',
    26 => ['recipeId', '{ recipeId }'],
    27 => 'findByIdAndUpdate',
    28 => ['new', 'new: true'],
    29 => 'findByIdAndDelete',

    /* --- E: ingredient.controller.ts --- */
    30 => 'ingredientService',
    31 => 'IngredientInput',
    32 => '201',
    33 => 'instanceof',
    34 => '404',
    35 => 'params',
    36 => 'recipeId',
    37 => 'json',
    38 => '500',

    /* --- F: codigos --- */
    39 => '201',
    40 => '404',
    41 => '400',
    42 => '400',
    43 => '200',

    /* --- G: firmas --- */
    44 => 'public async create(ingredientInput: IngredientInput): Promise<IngredientDocument> {',
    45 => 'public findByRecipeId(recipeId: string): Promise<IngredientDocument[]> {',
    46 => 'public async findByRecipeId(req: Request, res: Response) {',

    /* --- H: lineas completas --- */
    47 => 'ingredientRouter.get("/recipe/:recipeId", validateObjectId("recipeId"), ingredientController.findByRecipeId);',
    48 => 'const recipeExists = await RecipeModel.findById(ingredientInput.recipeId);',
    49 => 'throw new ReferenceError(`Recipe with id ${ingredientInput.recipeId} not found`);',
    50 => 'return IngredientModel.find({ recipeId });',
    51 => 'if (error instanceof ReferenceError) {',
    52 => 'export const updateIngredientSchema = createIngredientSchema.omit({ recipeId: true }).partial();',
];

$RETOS = [

'route' => [
    'titulo' => '<code>src/ingredients/ingredient.route.ts</code>',
    'huecos' => [7, 8, 9, 10, 11, 12, 13, 14, 15],
    'codigo' => <<<'EOT'
import express from "express";
import { ingredientController } from "./ingredient.controller";
import { validateSchema, validateObjectId } from "../middlewares";
import { createIngredientSchema, updateIngredientSchema } from "./ingredient.schema";

export const ingredientRouter = express.Router();

ingredientRouter.post("/", validateSchema(createIngredientSchema), ingredientController.create);

ingredientRouter.get("/recipe/:recipeId", validateObjectId("recipeId"), ingredientController.findByRecipeId);

ingredientRouter.get("/:id", validateObjectId(), ingredientController.findById);

ingredientRouter.put("/:id", validateObjectId(), validateSchema(updateIngredientSchema), ingredientController.update);

ingredientRouter.delete("/:id", validateObjectId(), ingredientController.delete);
EOT
],

'service' => [
    'titulo' => '<code>src/ingredients/ingredient.service.ts</code>',
    'huecos' => [19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 44, 45],
    'codigo' => <<<'EOT'
import { IngredientInput, IngredientUpdate } from "./ingredient.interface";
import { IngredientDocument, IngredientModel } from "./ingredient.model";
import { RecipeModel } from "../recipes/recipe.model";

class IngredientService {

    public async create(ingredientInput: IngredientInput): Promise<IngredientDocument> {
        const recipeExists = await RecipeModel.findById(ingredientInput.recipeId);

        if (recipeExists === null) {
            throw new ReferenceError(`Recipe with id ${ingredientInput.recipeId} not found`);
        }

        return IngredientModel.create(ingredientInput);
    }

    public findById(id: string): Promise<IngredientDocument | null> {
        return IngredientModel.findById(id);
    }

    public findByRecipeId(recipeId: string): Promise<IngredientDocument[]> {
        return IngredientModel.find({ recipeId });
    }

    public update(id: string, ingredientUpdate: IngredientUpdate): Promise<IngredientDocument | null> {
        return IngredientModel.findByIdAndUpdate(id, ingredientUpdate, { new: true });
    }

    public delete(id: string): Promise<IngredientDocument | null> {
        return IngredientModel.findByIdAndDelete(id);
    }
}

export const ingredientService = new IngredientService();
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => 'La comprobacion de que la receta existe esta en el <b>service</b>, no en Zod. ¿Por que no puede estar en Zod?',
        'opciones' => [
            'a' => 'Porque Zod no valida strings.',
            'b' => 'Porque Zod solo mira <b>la forma</b> del dato sin salir del proceso: puede comprobar que el recipeId parezca un ObjectId, pero para saber si <b>existe</b> hay que preguntarle a MongoDB, y eso ya es logica de negocio.',
            'c' => 'Porque el schema se ejecuta despues del service.',
            'd' => 'Porque Zod no es asincrono.',
        ],
        'correcta' => 'b',
        'porque'   => 'Es la misma frontera del proyecto del curso: forma en el schema, reglas que necesitan la base de datos en el service.',
    ],
    'm2' => [
        'texto'    => '¿Por que <code>GET /api/ingredient/recipe/:recipeId</code> NO se lo come la ruta <code>GET /api/ingredient/:id</code>?',
        'opciones' => [
            'a' => 'Porque va registrada antes.',
            'b' => 'Porque tienen <b>distinto numero de segmentos</b>: <code>/recipe/:recipeId</code> son dos y <code>/:id</code> es uno. Aunque invirtieras el orden seguiria funcionando.',
            'c' => 'Porque Express prefiere las rutas literales.',
            'd' => 'Porque lleva validateObjectId.',
        ],
        'correcta' => 'b',
        'porque'   => 'Distinto del caso <code>/profile</code> vs <code>/:id</code> del curso, donde ambas eran de un segmento y el orden si era critico. Aun asi, registrarla primero es buena costumbre.',
    ],
    'm3' => [
        'texto'    => 'El service lanza <code>ReferenceError</code> y el controller responde 404. ¿Por que no lanzar directamente la respuesta desde el service?',
        'opciones' => [
            'a' => 'Porque el service no tiene acceso a <code>res</code> — y no debe tenerlo: no sabe que existe HTTP. Su forma de comunicar un problema es lanzar un error; traducirlo a un codigo es trabajo del controller.',
            'b' => 'Porque ReferenceError es mas rapido.',
            'c' => 'Porque Express lo exige.',
            'd' => 'Porque asi se ve mejor en los logs.',
        ],
        'correcta' => 'a',
        'porque'   => 'Es lo que permite reutilizar el service desde un script o desde unas pruebas sin montar Express.',
    ],
    'm4' => [
        'texto'    => 'Crear un ingrediente con un <code>recipeId</code> que no existe: ¿404 o 400?',
        'opciones' => [
            'a' => '400: el dato que mando el cliente no sirve.',
            'b' => 'Las dos lecturas se defienden. Aqui es <b>404</b> porque el recurso referenciado no existe; 400 seria valido si lo lees como "el body no es aceptable". Lo importante es ser consistente y explicarlo.',
            'c' => '422 siempre.',
            'd' => '500.',
        ],
        'correcta' => 'b',
        'porque'   => 'En un parcial, una decision razonada y consistente vale mas que acertar el codigo "oficial". Lo que si esta mal es responder 500.',
    ],
    'm5' => [
        'texto'    => 'El schema de update omite <code>recipeId</code>. Si el cliente lo manda igual en el PUT, ¿que pasa?',
        'opciones' => [
            'a' => 'Zod responde 400 por campo desconocido.',
            'b' => 'Se guarda y el ingrediente cambia de receta.',
            'c' => 'Zod lo <b>descarta</b> al construir el objeto de salida, y como el middleware reasigna <code>req.body</code>, al service nunca le llega: el ingrediente se queda en su receta.',
            'd' => 'Mongoose lo rechaza.',
        ],
        'correcta' => 'c',
        'porque'   => 'Por defecto Zod no falla ante claves de mas: simplemente no las incluye en el resultado. La clave esta en la reasignacion <code>req.body = await schema.parseAsync(req.body)</code>.',
    ],
    'm6' => [
        'texto'    => '<code>IngredientModel.find({ recipeId })</code> con un recipeId que no tiene ingredientes:',
        'opciones' => [
            'a' => 'Devuelve <code>null</code> y hay que responder 404.',
            'b' => 'Lanza un error.',
            'c' => 'Devuelve un <b>array vacio</b>. La respuesta correcta es 200 con <code>[]</code>: preguntar por los ingredientes de una receta sin ingredientes no es un error.',
            'd' => 'Devuelve todos los ingredientes.',
        ],
        'correcta' => 'c',
        'porque'   => 'Cuidado con confundir <code>find</code> (siempre array) con <code>findOne</code>/<code>findById</code> (documento o null). Solo el segundo grupo justifica un 404.',
    ],
    'm7' => [
        'texto'    => 'En <code>find({ recipeId })</code>, el <code>recipeId</code> es un string y en Mongo es un ObjectId. ¿Por que funciona?',
        'opciones' => [
            'a' => 'Porque Mongoose <b>castea</b> el valor segun el tipo declarado en el schema antes de mandar la consulta.',
            'b' => 'Porque MongoDB compara strings con ObjectIds.',
            'c' => 'Porque el middleware lo convirtio.',
            'd' => 'No funciona, es un bug.',
        ],
        'correcta' => 'a',
        'porque'   => 'Ese casteo es tambien el que produce el <code>CastError</code> cuando el string no tiene forma de ObjectId, y por eso existe <code>validateObjectId</code>.',
    ],
    'm8' => [
        'texto'    => 'Si te quedan 20 minutos y Ingredient esta a medias, ¿que haces?',
        'opciones' => [
            'a' => 'Empezar la API key, que vale 20% y son 15 lineas.',
            'b' => 'Terminar los endpoints que ya tengas funcionando, hacer commit con la app <b>arrancando</b>, y solo entonces seguir.',
            'c' => 'Escribir los cinco endpoints de golpe sin probar.',
            'd' => 'Refactorizar Recipe.',
        ],
        'correcta' => 'b',
        'porque'   => 'La nota final del enunciado avisa: si la aplicacion no ejecuta, la nota se ve afectada drasticamente. Un error de compilacion en Ingredient tumba tambien el 40% de Recipe que ya tenias.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Parcial 5 — Ingredient completo', 'La entidad dependiente: referencia a Recipe, FindByProcessId y el otro 40%');
?>

<div class="card">
  <h2>A. <code>src/ingredients/ingredient.schema.ts</code></h2>

<pre><code>import { object, string, number, boolean } from 'zod';

export const createIngredientSchema = object({
    recipeId: <?php hueco(1, 12); ?>({ error: "recipeId is required" }),

    name: string({ error: "Name is required" }).min(1, "Name is required"),

    quantity: number({ error: "quantity is required" })
               .<?php hueco(3, 10); ?>("quantity must be greater than 0"),

    unit: string().optional(),
    optional: <?php hueco(4, 9); ?>().optional(),
    notes: string().optional()
});

export const updateIngredientSchema = createIngredientSchema
                                        .<?php hueco(5, 6); ?>({ recipeId: true })
                                        .<?php hueco(6, 9); ?>();</code></pre>

  <div class="nota">Aqui no hay expresion regular: el schema solo valida <b>la forma base</b> del dato y el tipo. Que ese <code>recipeId</code> realmente exista en MongoDB se comprueba luego en el service, porque eso exige consultar la base de datos.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>src/ingredients/ingredient.route.ts</code></h2>

<pre><code>export const ingredientRouter = express.Router();

ingredientRouter.<?php hueco(7, 6); ?>("/", validateSchema(<?php hueco(8, 24); ?>), ingredientController.create);

ingredientRouter.get("<?php hueco(9, 20); ?>", validateObjectId(<?php hueco(10, 12); ?>), ingredientController.<?php hueco(11, 16); ?>);

ingredientRouter.get("<?php hueco(12, 6); ?>", validateObjectId(), ingredientController.<?php hueco(13, 10); ?>);

ingredientRouter.put("/:id", validateObjectId(), validateSchema(<?php hueco(14, 24); ?>), ingredientController.update);

ingredientRouter.<?php hueco(15, 8); ?>("/:id", validateObjectId(), ingredientController.delete);</code></pre>

  <h3>¿Por que aqui NO hay conflicto de orden?</h3>

  <p>En el curso, <code>/profile</code> tenia que ir antes de <code>/:id</code> o se lo comia.
     Aqui no pasa lo mismo:</p>

<pre><code>/recipe/:recipeId   →  <?php hueco(16, 5); ?> segmentos
/:id                →  <?php hueco(17, 5); ?> segmento</code></pre>

  <p>Como el numero de segmentos es distinto, una ruta <?php hueco(18, 5); ?> puede
     capturar a la otra. Aun asi conviene registrarla primero, por costumbre.</p>

  <p>Fijate tambien en <code>validateObjectId("recipeId")</code>: por eso el middleware recibe
     el <b>nombre</b> del parametro en vez de dar por hecho que se llama <code>id</code>.</p>

  <?php reto('route'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>src/ingredients/ingredient.service.ts</code></h2>

<pre><code>class IngredientService {

<?php firma(44, 76); ?>

        const recipeExists = await <?php hueco(19, 12); ?>.findById(ingredientInput.recipeId);

        if (recipeExists === <?php hueco(20, 6); ?>) {
            throw new <?php hueco(21, 15); ?>(`Recipe with id ${ingredientInput.recipeId} not found`);
        }

        return <?php hueco(22, 16); ?>.<?php hueco(23, 8); ?>(ingredientInput);
    }

    public findById(id: string): Promise&lt;IngredientDocument | null&gt; {
        return IngredientModel.<?php hueco(24, 10); ?>(id);
    }

<?php firma(45, 70); ?>

        return IngredientModel.<?php hueco(25, 6); ?>({ <?php hueco(26, 10); ?> });
    }

    public update(id: string, ingredientUpdate: IngredientUpdate): Promise&lt;IngredientDocument | null&gt; {
        return IngredientModel.<?php hueco(27, 18); ?>(id, ingredientUpdate, { <?php hueco(28, 8); ?>: true });
    }

    public delete(id: string): Promise&lt;IngredientDocument | null&gt; {
        return IngredientModel.<?php hueco(29, 18); ?>(id);
    }
}</code></pre>

  <div class="avisoflujo"><b>La regla de negocio del parcial:</b> no se puede colgar un
     ingrediente de una receta que no existe. MongoDB no comprueba eso solo — el
     <code>ref</code> del modelo es informacion para <code>populate()</code>, no una llave
     foranea. Si no lo compruebas tu, nadie lo hace.</div>

  <?php reto('service'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. <code>src/ingredients/ingredient.controller.ts</code></h2>

<pre><code>public async create(req: Request, res: Response) {
    try {
        const ingredient: IngredientDocument =
            await <?php hueco(30, 18); ?>.create(req.body as <?php hueco(31, 16); ?>);
        res.status(<?php hueco(32, 5); ?>).json(ingredient);
    } catch (error) {
        if (error <?php hueco(33, 11); ?> ReferenceError) {
            res.status(<?php hueco(34, 5); ?>).json({ message: error.message });
            return;
        }
        res.status(500).json(error);
    }
}

<?php firma(46, 50); ?>

    try {
        const recipeId: string = req.<?php hueco(35, 8); ?>.<?php hueco(36, 10); ?> as string || '';
        const ingredients: IngredientDocument[] =
            await ingredientService.findByRecipeId(recipeId);
        res.<?php hueco(37, 6); ?>(ingredients);
    } catch (error) {
        res.status(<?php hueco(38, 5); ?>).json(error);
    }
}</code></pre>

  <div class="nota">Fijate en el <code>return</code> despues del 404 dentro del <code>catch</code>.
     En el proyecto del curso ese <code>return</code> faltaba en <code>create</code> y por eso
     acababa ejecutando tambien el <code>res.status(500)</code>. Aqui esta puesto.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. Que codigo devuelve cada caso</h2>

<pre><code>POST /api/ingredient con body valido y receta existente   →  <?php hueco(39, 5); ?>

POST /api/ingredient con un recipeId que no existe        →  <?php hueco(40, 5); ?>

POST /api/ingredient sin quantity                         →  <?php hueco(41, 5); ?>

POST /api/ingredient con recipeId = "abc"                 →  <?php hueco(42, 5); ?>

GET /api/ingredient/recipe/:id de una receta sin
ingredientes                                              →  <?php hueco(43, 5); ?> con []</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. De memoria: escribe la linea completa</h2>

  <?php linea(47, 'La ruta de <b>FindByProcessId</b> (los ingredientes de una receta), con su guarda:'); ?>
  <?php linea(48, 'En el service: comprobar que la receta existe antes de crear:'); ?>
  <?php linea(49, 'En el service: lanzar el error cuando la receta no existe:'); ?>
  <?php linea(50, 'En el service: buscar todos los ingredientes de una receta:'); ?>
  <?php linea(51, 'En el controller: la condicion que traduce ese error a un 404:'); ?>
  <?php linea(52, 'El schema de update, que ademas impide cambiar de receta:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('cuarto.php', 'Menu.php');
