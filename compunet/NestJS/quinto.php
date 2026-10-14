<?php
require_once __DIR__ . '/motor.php';

/* ---------------------------------------------------------------
   CUESTIONARIO 5 — Entidades, TypeORM y el CRUD en los services
   --------------------------------------------------------------- */

$SOLUCIONES = [

    /* --- A. brand.entity.ts --- */
    1  => 'Entity',
    2  => 'PrimaryGeneratedColumn',
    3  => 'uuid',
    4  => 'Column',
    5  => 'unique',
    6  => 'OneToMany',
    7  => 'BeforeInsert',
    8  => 'toLowerCase',
    9  => 'replaceAll',
    10 => 'checkSlug',

    /* --- B. car.entity.ts --- */
    11 => 'ManyToOne',
    12 => 'eager',
    13 => 'int',
    14 => 'Brand',
    15 => 'cars',

    /* --- C. user.entity.ts --- */
    16 => 'unique',
    17 => 'nullable',
    18 => 'array',
    19 => 'default',
    20 => 'CURRENT_TIMESTAMP',
    21 => 'timestamp',

    /* --- D. brands.service.ts --- */
    22 => 'InjectRepository',
    23 => 'create',
    24 => 'save',
    25 => 'find',
    26 => 'findOneBy',
    27 => 'null',
    28 => 'NotFoundException',
    29 => 'update',
    30 => 'affected',
    31 => 'delete',
    32 => 'findAll',
    33 => 'await',

    /* --- E. Que devuelve cada metodo del Repository --- */
    34 => ['array', 'arreglo', 'Entity[]', 'lista', 'Brand[]'],
    35 => ['entidad o null', 'Entity | null', 'Brand | null', 'entity | null', 'entidad | null', 'la entidad o null'],
    36 => ['entidad sin guardar', 'una entidad', 'entidad', 'instancia', 'instancia sin guardar', 'entity'],
    37 => ['entidad guardada', 'la entidad', 'entidad', 'entity', 'la entidad con id', 'entidad con id'],
    38 => ['UpdateResult', 'update result'],
    39 => ['DeleteResult', 'delete result'],
    40 => ['EntityNotFoundError', 'entity not found error'],

    /* --- F. Codigos de error de Postgres --- */
    41 => '23505',
    42 => '23503',
    43 => '22P02',

    /* --- G. Flujo de POST /brands --- */
    44 => ['BrandsController', 'brands.controller', 'controller'],
    45 => ['BrandsService', 'brands.service', 'service'],
    46 => 'create',
    47 => 'save',
    48 => 'BeforeInsert',
    49 => 'alfa_romeo',
    50 => 'INSERT',
    51 => '23505',
    52 => 'BadRequestException',

    /* --- H. Lineas completas --- */
    60 => "@Entity()",
    61 => "@PrimaryGeneratedColumn('uuid')",
    62 => "@Column('varchar', {unique: true})",
    63 => "const brand = this.brandRepository.create(createBrandDto);",
    64 => "return await this.brandRepository.save(brand)",
    65 => "const brand: Brand | null = await this.brandRepository.findOneBy({id});",
    66 => "const result = await this.brandRepository.delete(id);",
    67 => "@OneToMany(()=>Car, (car)=>car.brand)",
];

$RETOS = [

'brandentity' => [
    'titulo' => '<code>brand.entity.ts</code> (la clase completa, sin los imports)',
    'huecos' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    'codigo' => <<<'EOT'
@Entity()
export class Brand {
    @PrimaryGeneratedColumn('uuid')
    id: string;

    @Column('varchar', {unique: true})
    name: string;

    @Column('varchar', {unique: true})
    slug: string;

    @OneToMany(()=>Car, (car)=>car.brand)
    cars: Car[];

    @BeforeInsert()
    checkSlug(): void {
        if (!this.slug)
            this.slug = this.name;
        this.slug = this.slug.toLowerCase().replaceAll(' ','_').replaceAll('"',"");
    }
}
EOT
],

'carentity' => [
    'titulo' => '<code>car.entity.ts</code> (la clase completa, sin los imports)',
    'huecos' => [11, 12, 13, 14, 15],
    'codigo' => <<<'EOT'
@Entity()
export class Car {
    @PrimaryGeneratedColumn('uuid')
    id: string;

    @ManyToOne(()=>Brand, (brand) => brand.cars,{eager: true})
    brand: string;

    @Column('varchar', {unique: true})
    model: string;

    @Column('int')
    year: number;
}
EOT
],

'brandsservice' => [
    'titulo' => '<code>BrandsService</code> (los cinco metodos, con su constructor)',
    'huecos' => [22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33],
    'codigo' => <<<'EOT'
@Injectable()
export class BrandsService {

  constructor(
    @InjectRepository(Brand) private readonly brandRepository: Repository<Brand>
  ){}

  async create(createBrandDto: CreateBrandDto) {
    try {
      const brand = this.brandRepository.create(createBrandDto);
      return await  this.brandRepository.save(brand)
    } catch (error:any) {

      if (error.code==23505){
        throw new BadRequestException('brand already exists')
      }
      throw new InternalServerErrorException('error creating brand');
    }
  }

  findAll() {
    return this.brandRepository.find();
  }

  async findOne(id: string) {
    const brand: Brand | null = await this.brandRepository.findOneBy({id});
    if (brand === null)
      throw new NotFoundException(`brand with id ${id} not found`);
    return brand;
  }

  async update(id: string, updateBrandDto: UpdateBrandDto) {
    const result = await this.brandRepository.update(id, updateBrandDto);
    if(result.affected && result.affected<1)
      throw new NotFoundException(`brand with id ${id} not found`);
    return this.findOne(id);
  }

  async remove(id: string) {
    await this.findOne(id);
    const result = await  this.brandRepository.delete(id);

    if(result.affected && result.affected<1)
      throw new NotFoundException(`brand with id ${id} not found`);
    return this.findAll();
  }
}
EOT
],

];

$MULTIPLE = [
    'm1' => [
        'texto'    => '¿Que es una <b>entidad</b> (<code>@Entity()</code>) en TypeORM?',
        'opciones' => [
            'a' => 'Una clase cuyos campos decorados con <code>@Column</code> describen <b>una tabla</b>; cada instancia es una <b>fila</b>.',
            'b' => 'Un servicio que hace consultas SQL.',
            'c' => 'Un DTO que valida el body.',
            'd' => 'Un archivo de configuracion de Postgres.',
        ],
        'correcta' => 'a',
        'porque'   => 'Con <code>synchronize: true</code>, al arrancar TypeORM lee estas clases y crea las tablas <code>brand</code>, <code>car</code> y <code>user</code>. Es el enfoque <i>code first</i>: el codigo manda y la BD se adapta.',
    ],
    'm2' => [
        'texto'    => '¿Por que <code>Brand</code> tiene <code>@OneToMany</code> y <code>Car</code> tiene <code>@ManyToOne</code>? ¿Cual de los dos lados crea la <b>columna</b> de la clave foranea?',
        'opciones' => [
            'a' => 'Ambos lados crean una columna.',
            'b' => 'Ninguno: Postgres la infiere.',
            'c' => 'El lado <code>@OneToMany</code> (<code>Brand.cars</code>): una marca guarda la lista de coches.',
            'd' => 'El lado <code>@ManyToOne</code> (<code>Car.brand</code>): la tabla <code>car</code> tiene una columna con el id de su marca. El <code>@OneToMany</code> es solo la vista inversa, sin columna propia.',
        ],
        'correcta' => 'd',
        'porque'   => 'Muchos coches → una marca. La clave foranea siempre vive en el lado "muchos". <code>Brand.cars</code> no es una columna: se rellena con un JOIN si se pide.',
    ],
    'm3' => [
        'texto'    => '¿Que hace <code>{eager: true}</code> en <code>@ManyToOne(() =&gt; Brand, ..., {eager: true})</code>?',
        'opciones' => [
            'a' => 'Que cada vez que buscas un <code>Car</code> con <code>find*</code>, TypeORM <b>carga tambien su <code>Brand</code></b> automaticamente (hace el JOIN por ti).',
            'b' => 'Que la marca se crea sola si no existe.',
            'c' => 'Que el coche se guarda mas rapido.',
            'd' => 'Que el <code>brand</code> es opcional.',
        ],
        'correcta' => 'a',
        'porque'   => 'Sin <code>eager</code> tendrias que pedirlo con <code>find({relations: {brand: true}})</code>. Asi, <code>GET /cars</code> devuelve cada coche con el objeto <code>brand</code> completo dentro.',
    ],
    'm4' => [
        'texto'    => '<code>this.brandRepository.create(dto)</code>: ¿inserta en la base de datos?',
        'opciones' => [
            'a' => 'Si, devuelve la fila insertada.',
            'b' => 'Si, pero sin esperar.',
            'c' => 'No: solo <b>construye una instancia</b> de <code>Brand</code> en memoria a partir del objeto. El INSERT lo hace <code>save</code>.',
            'd' => 'Depende del <code>synchronize</code>.',
        ],
        'correcta' => 'c',
        'porque'   => 'Es un error clasico creer que <code>create</code> guarda. Es como <code>new Brand()</code> + copiar campos. Necesitas <code>save(brand)</code> para persistir y para que se disparen hooks como <code>@BeforeInsert</code>.',
    ],
    'm5' => [
        'texto'    => 'En <code>BrandsService.create</code> el profe escribe <code>return await this.brandRepository.save(brand)</code>. ¿Por que el <code>await</code> ahi dentro es <b>necesario</b> y no un capricho?',
        'opciones' => [
            'a' => 'Porque <code>save</code> no devuelve una Promise.',
            'b' => 'No es necesario, es lo mismo con o sin <code>await</code>.',
            'c' => 'Porque sin <code>await</code> el <code>catch</code> no se enteraria del error: <code>return promesa</code> dentro de un <code>try</code> sale del bloque <b>antes</b> de que la Promise falle, y el rechazo escapa del <code>catch</code>.',
            'd' => 'Para que sea mas rapido.',
        ],
        'correcta' => 'c',
        'porque'   => 'Con <code>await</code> dentro del <code>try</code>, el rechazo se convierte en excepcion <b>dentro</b> del bloque y el <code>catch</code> puede traducir el error 23505 a <code>BadRequestException</code>. Sin el, el error de Postgres llegaria crudo (500).',
    ],
    'm6' => [
        'texto'    => 'Postgres lanza el error de <b>unique_violation</b> con <code>error.code = \'23505\'</code> (un <b>string</b>). El profe compara con <code>error.code==23505</code> (un numero, con <code>==</code>). ¿Funciona?',
        'opciones' => [
            'a' => 'No: <code>"23505"</code> nunca es igual a <code>23505</code>.',
            'b' => 'Si, porque <code>==</code> hace coercion y <code>"23505" == 23505</code> es <code>true</code>. Con <code>===</code> <b>no</b> funcionaria.',
            'c' => 'Solo en produccion.',
            'd' => 'Da error de sintaxis.',
        ],
        'correcta' => 'b',
        'porque'   => 'La forma limpia seria <code>error.code === \'23505\'</code>. Que funcione es un accidente de la comparacion laxa.',
    ],
    'm7' => [
        'texto'    => 'Creas una marca con el mismo <code>name</code> dos veces. ¿Que capa detecta el duplicado y como sale en la API?',
        'opciones' => [
            'a' => 'El <code>ValidationPipe</code>, con un 400.',
            'b' => 'Nadie: se crean dos marcas iguales.',
            'c' => 'El controller.',
            'd' => 'La <b>base de datos</b> (la restriccion <code>unique: true</code>) lanza el error 23505; el <code>catch</code> del service lo traduce a <code>BadRequestException(\'brand already exists\')</code> → 400.',
        ],
        'correcta' => 'd',
        'porque'   => 'El DTO no puede saber si ya existe: eso exige consultar la BD. La restriccion <code>unique</code> es la <b>red de seguridad final</b>, incluso ante dos peticiones simultaneas.',
    ],
    'm8' => [
        'texto'    => '<code>POST /brands {"name":"Alfa Romeo"}</code> (sin slug). ¿Que slug se guarda y quien lo calcula?',
        'opciones' => [
            'a' => '<code>null</code>, porque no se envio.',
            'b' => '<code>"alfa_romeo"</code>: el hook <code>@BeforeInsert() checkSlug()</code> de la entidad copia <code>name</code>, lo pasa a minusculas y cambia espacios por <code>_</code>.',
            'c' => '<code>"Alfa Romeo"</code> tal cual.',
            'd' => 'El ValidationPipe lo genera.',
        ],
        'correcta' => 'b',
        'porque'   => 'Los hooks de entidad (<code>@BeforeInsert</code>, <code>@BeforeUpdate</code>...) corren en <code>save()</code> sobre la entidad. Ojo: <code>repository.update(id, dto)</code> <b>no</b> los ejecuta, asi que si cambias el <code>name</code> por PATCH el slug NO se recalcula.',
    ],
    'm9' => [
        'texto'    => '¿Que devuelve <code>brandRepository.findOneBy({id})</code> cuando <b>no</b> hay fila con ese id?',
        'opciones' => [
            'a' => 'Lanza <code>EntityNotFoundError</code>.',
            'b' => '<code>undefined</code>.',
            'c' => '<code>null</code>. Por eso el service comprueba <code>if (brand === null)</code> y lanza <code>NotFoundException</code> (404) el mismo.',
            'd' => 'Un arreglo vacio.',
        ],
        'correcta' => 'c',
        'porque'   => '<code>find()</code> devuelve <code>[]</code> si no hay nada; <code>findOneBy</code> devuelve <code>null</code>; <code>findOneByOrFail</code> (no usado aqui) lanzaria <code>EntityNotFoundError</code>. Tres comportamientos distintos que conviene distinguir.',
    ],
    'm10' => [
        'texto'    => '<code>brandRepository.update(id, dto)</code> con un <code>id</code> inexistente. ¿Que devuelve?',
        'opciones' => [
            'a' => 'Lanza excepcion.',
            'b' => '<code>null</code>.',
            'c' => 'Un <code>UpdateResult</code> con <code>affected: 0</code>; no lanza nada por si mismo.',
            'd' => '<code>false</code>.',
        ],
        'correcta' => 'c',
        'porque'   => 'Un UPDATE que no encuentra filas no es un error de SQL: simplemente afecta 0 filas. Detectar el 404 es trabajo del codigo (mirando <code>affected</code> o consultando antes).',
    ],
    'm11' => [
        'texto'    => 'En <code>update</code> el profe escribe <code>if(result.affected &amp;&amp; result.affected&lt;1) throw new NotFoundException(...)</code>. Con <code>affected = 0</code>, ¿se lanza esa excepcion?',
        'opciones' => [
            'a' => 'Si: 0 es menor que 1.',
            'b' => '<b>No</b>: <code>0</code> es "falsy", asi que <code>result.affected &amp;&amp; ...</code> ya es falso y el <code>if</code> nunca entra. El 404 sale despues, por casualidad, cuando <code>this.findOne(id)</code> no encuentra la marca.',
            'c' => 'Depende de la version de Nest.',
            'd' => 'Si, pero como 400.',
        ],
        'correcta' => 'b',
        'porque'   => 'La condicion correcta seria <code>if (result.affected === 0)</code> (o <code>!result.affected</code>). Como esta escrita es <b>codigo muerto</b>. El endpoint acaba respondiendo 404 igualmente, por la llamada final a <code>findOne</code>.',
    ],
    'm12' => [
        'texto'    => '¿Por que <code>remove</code> hace <code>await this.findOne(id)</code> <b>antes</b> de <code>delete(id)</code>?',
        'opciones' => [
            'a' => 'Porque <code>delete</code> necesita la entidad completa.',
            'b' => 'Para que si el id no existe se lance el 404 antes de intentar borrar, y luego responder con la lista actualizada.',
            'c' => 'Para bloquear la fila.',
            'd' => 'Es un error, sobra.',
        ],
        'correcta' => 'b',
        'porque'   => 'El patron "comprobar existencia con <code>findOne</code>, luego actuar" garantiza 404 correcto. Ademas este <code>remove</code> devuelve <code>this.findAll()</code>: la <b>lista restante</b>, no la fila borrada.',
    ],
    'm13' => [
        'texto'    => '¿Que es <code>@Column(\'varchar\', {array: true, default: [\'user\']})</code> en <code>User.roles</code>?',
        'opciones' => [
            'a' => 'Una columna de texto normal cuyo valor es la palabra "user".',
            'b' => 'Una columna que guarda <b>un arreglo</b> de textos (tipo <code>varchar[]</code> de Postgres), y cada usuario nuevo empieza con <code>[\'user\']</code>.',
            'c' => 'Una relacion con otra tabla.',
            'd' => 'Una columna que se calcula sola.',
        ],
        'correcta' => 'b',
        'porque'   => 'Postgres soporta columnas array de forma nativa. Ojo: en la entidad esta tipado como <code>roles: string</code> aunque en realidad es <code>string[]</code> (ver cuestionario de bugs).',
    ],
    'm14' => [
        'texto'    => '¿Que hace <code>@PrimaryGeneratedColumn(\'uuid\')</code> frente a <code>@PrimaryGeneratedColumn()</code> a secas?',
        'opciones' => [
            'a' => 'Nada distinto.',
            'b' => 'Con <code>\'uuid\'</code> el id es un texto UUID aleatorio generado por la BD/TypeORM (<code>3f2c8f0a-...</code>); a secas seria un entero autoincremental (1, 2, 3...).',
            'c' => 'El uuid es mas lento pero unico.',
            'd' => 'Con uuid el id no puede repetirse entre tablas.',
        ],
        'correcta' => 'b',
        'porque'   => 'Por eso los controllers usan <code>ParseUUIDPipe</code> y no <code>ParseIntPipe</code>: si el id fuera entero, el pipe adecuado seria el otro.',
    ],
];

iniciar($SOLUCIONES, $MULTIPLE, $RETOS);
cabecera('Cuestionario 5 — Entidades y TypeORM', 'Entity, Column, relaciones, Repository, CRUD y errores de Postgres');
?>

<div class="card">
  <h2>A. <code>brand.entity.ts</code> — una tabla en forma de clase</h2>

<pre><code>@<?php hueco(1, 7); ?>()
export class Brand {
    @<?php hueco(2, 23); ?>('<?php hueco(3, 5); ?>')
    id: string;

    @<?php hueco(4, 7); ?>('varchar', {<?php hueco(5, 7); ?>: true})
    name: string;

    @Column('varchar', {unique: true})
    slug: string;

    @<?php hueco(6, 10); ?>(()=&gt;Car, (car)=&gt;car.brand)
    <?php hueco(15, 5); ?>: Car[];

    @<?php hueco(7, 12); ?>()
    <?php hueco(10, 10); ?>(): void {
        if (!this.slug)
            this.slug = this.name;
        this.slug = this.slug.<?php hueco(8, 11); ?>().<?php hueco(9, 10); ?>(' ','_').replaceAll('"',"");
    }
}</code></pre>

  <div class="avisoflujo"><b>Lectura:</b> "una marca tiene id UUID, un nombre unico, un slug unico y una lista de coches;
     antes de insertarla, si no trae slug, se lo genera a partir del nombre".</div>

  <?php reto('brandentity'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>B. <code>car.entity.ts</code> — el lado "muchos" de la relacion</h2>

<pre><code>@Entity()
export class Car {
    @PrimaryGeneratedColumn('uuid')
    id: string;

    @<?php hueco(11, 9); ?>(()=&gt;<?php hueco(14, 5); ?>, (brand) =&gt; brand.cars,{<?php hueco(12, 5); ?>: true})
    brand: string;

    @Column('varchar', {unique: true})
    model: string;

    @Column('<?php hueco(13, 3); ?>')
    year: number;
}</code></pre>

  <div class="nota">Ojo a <code>model</code> con <code>unique: true</code>: dos marcas distintas no pueden tener un
     modelo con el mismo nombre. Es una decision (discutible) del profe: el 23505 al crear coches viene de aqui.</div>

  <?php reto('carentity'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>C. <code>user.entity.ts</code> — opciones de columna</h2>

<pre><code>@Column({<?php hueco(16, 7); ?>: true})
email: string;

@Column({<?php hueco(17, 8); ?>: true})
phone: string;

@Column('varchar', {<?php hueco(18, 5); ?>: true, <?php hueco(19, 7); ?>:['user']})
roles: string;

@Column({type: '<?php hueco(21, 9); ?>', default: () =&gt; '<?php hueco(20, 17); ?>'})
createAt: Date;</code></pre>

  <div class="nota"><code>nullable: true</code> permite <code>NULL</code> en la BD (por eso <code>phone</code> es opcional en el DTO).
     <code>default: () =&gt; 'CURRENT_TIMESTAMP'</code> se escribe como <b>funcion</b> para que el valor lo evalue <b>Postgres</b>
     al insertar; si pusieras un string normal, se guardaria ese texto literal.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>D. <code>brands.service.ts</code> — el CRUD con Repository</h2>

<pre><code>constructor(
  @<?php hueco(22, 16); ?>(Brand) private readonly brandRepository: Repository&lt;Brand&gt;
){}

async create(createBrandDto: CreateBrandDto) {
  try {
    const brand = this.brandRepository.<?php hueco(23, 7); ?>(createBrandDto);
    return <?php hueco(33, 6); ?> this.brandRepository.<?php hueco(24, 5); ?>(brand)
  } catch (error:any) {
    if (error.code==23505){ throw new BadRequestException('brand already exists') }
    throw new InternalServerErrorException('error creating brand');
  }
}

<?php hueco(32, 8); ?>() {
  return this.brandRepository.<?php hueco(25, 5); ?>();
}

async findOne(id: string) {
  const brand: Brand | <?php hueco(27, 5); ?> = await this.brandRepository.<?php hueco(26, 10); ?>({id});
  if (brand === null)
    throw new <?php hueco(28, 18); ?>(`brand with id ${id} not found`);
  return brand;
}

async update(id: string, updateBrandDto: UpdateBrandDto) {
  const result = await this.brandRepository.<?php hueco(29, 7); ?>(id, updateBrandDto);
  if(result.<?php hueco(30, 9); ?> &amp;&amp; result.affected&lt;1)
    throw new NotFoundException(`brand with id ${id} not found`);
  return this.findOne(id);
}

async remove(id: string) {
  await this.findOne(id);
  const result = await this.brandRepository.<?php hueco(31, 7); ?>(id);
  ...
  return this.findAll();
}</code></pre>

  <?php reto('brandsservice'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>E. ¿Que devuelve cada metodo del Repository?</h2>
  <p>Es la tabla que mas se confunde. Escribe el tipo de lo que devuelve cada uno (en una expresion corta):</p>

<pre><code>repository.find()                     →  <?php hueco(34, 20); ?>       (puede ser vacio: [])

repository.findOneBy({id})            →  <?php hueco(35, 20); ?>

repository.create(dto)                →  <?php hueco(36, 20); ?>       (NO toca la BD)

repository.save(entity)               →  <?php hueco(37, 20); ?>       (INSERT o UPDATE; ya trae su id)

repository.update(id, dto)            →  <?php hueco(38, 20); ?>       (trae la propiedad affected)

repository.delete(id)                 →  <?php hueco(39, 20); ?>       (tambien trae affected)

repository.findOneByOrFail({id})      →  lanza <?php hueco(40, 22); ?> si no existe   (no se usa en el repo)</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>F. Codigos de error de Postgres</h2>

<pre><code>catch (error:any) {
    if (error.code == <?php hueco(41, 6); ?>){       // unique_violation: ya existe (name/slug/model repetido)
        throw new BadRequestException('brand already exists')
    }
    ...
}

23503  →  foreign_key_violation     (apuntar a una fila que no existe)  → el hueco vale: <?php hueco(42, 6); ?>
22P02  →  invalid_text_representation  (ej. un id que no es uuid llegando a Postgres) → el hueco vale: <?php hueco(43, 6); ?></code></pre>

  <div class="nota">El <code>ParseUUIDPipe</code> existe justamente para <b>no</b> dejar que un id mal formado llegue a
     Postgres: sin el pipe, <code>GET /cars/123</code> acabaria en un error <code>22P02</code> → <b>500</b>.</div>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>G. Recorrido de <code>POST /brands</code> con <code>{"name": "Alfa Romeo"}</code></h2>

<pre class="flujo"><code>CLIENTE   POST /brands   {"name":"Alfa Romeo"}
  ↓
ValidationPipe  (CreateBrandDto: name de 3 a 20 → OK)
  ↓
<?php hueco(44, 16); ?>.create(dto)
  ↓
<?php hueco(45, 13); ?>.<?php hueco(46, 6); ?>(dto)
  ↓
brandRepository.create(dto)     →  instancia Brand en memoria (sin id, sin slug)
  ↓
brandRepository.<?php hueco(47, 4); ?>(brand)
  ↓
hook @<?php hueco(48, 12); ?> checkSlug()   →  slug = "<?php hueco(49, 10); ?>"
  ↓
<?php hueco(50, 6); ?> INTO brand ...   →  Postgres genera el uuid y devuelve la fila
  ↓
201 Created  +  {"id":"3f2c...","name":"Alfa Romeo","slug":"alfa_romeo"}

Si el nombre ya existia:
   Postgres error <?php hueco(51, 6); ?>  →  el catch lanza <?php hueco(52, 19); ?>  →  400</code></pre>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>H. De memoria: la linea completa</h2>

  <?php linea(60, 'Decorador que convierte una clase en una tabla:'); ?>
  <?php linea(61, 'Clave primaria de tipo UUID autogenerado (decorador solo, en una linea):'); ?>
  <?php linea(62, 'Columna varchar con restriccion de valor unico (decorador solo):'); ?>
  <?php linea(67, 'Decorador de <code>Brand</code> que dice "una marca tiene muchos coches" y como se llama la propiedad inversa:'); ?>
  <?php linea(63, 'En <code>create</code>: construir la entidad a partir del DTO (con <code>const brand =</code>):'); ?>
  <?php linea(64, 'En <code>create</code>: guardarla y devolver el resultado esperando la Promise (sin <code>;</code> final, o con el, da igual):'); ?>
  <?php linea(65, 'En <code>findOne</code>: buscar por id, tipando el resultado como <code>Brand | null</code>:'); ?>
  <?php linea(66, 'En <code>remove</code>: borrar la fila y guardar el resultado:'); ?>

  <?php enviar(); ?>
</div>


<div class="card">
  <h2>I. Preguntas de comprension</h2>
  <?php mc('m1'); mc('m2'); mc('m3'); mc('m4'); mc('m5'); mc('m6'); mc('m7'); mc('m8'); mc('m9'); mc('m10'); mc('m11'); mc('m12'); mc('m13'); mc('m14'); ?>
  <?php enviar('Verificar'); ?>
</div>

<?php
pie('cuarto.php', 'sexto.php');
