<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cuestionarios — NestJS</title>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<style>
body{background:#f4f5f7;font-family:-apple-system,Segoe UI,Arial,sans-serif;margin:0;padding:30px 18px 60px;color:#22262b}
.wrap{max-width:960px;margin:0 auto}
h1{font-size:28px;margin:0 0 4px}
.sub{color:#5a636e;margin:0 0 26px;font-size:15px}
.grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px}
.tarjeta{background:#fff;border:1px solid #d8dbe0;border-radius:12px;padding:18px 20px;
         text-decoration:none;color:inherit;display:block;transition:.15s}
.tarjeta:hover{border-color:#c2185b;box-shadow:0 4px 14px rgba(194,24,91,.14);
               text-decoration:none;color:inherit;transform:translateY(-2px)}
.tarjeta .n{font-size:12px;letter-spacing:.08em;text-transform:uppercase;color:#c2185b;font-weight:700}
.tarjeta h2{font-size:18px;margin:4px 0 8px}
.tarjeta p{font-size:14px;color:#5a636e;margin:0 0 10px;line-height:1.55}
.tarjeta .tags{font-size:12px;color:#7a838f;font-family:Consolas,Menlo,monospace}
.tarjeta.final{border-style:dashed;border-color:#c2185b}
.tarjeta.taller .n{color:#1a7f37}
.tarjeta.taller:hover{border-color:#1a7f37;box-shadow:0 4px 14px rgba(26,127,55,.14)}
h2.seccion{font-size:21px;margin:38px 0 6px;padding-top:22px;border-top:1px solid #d8dbe0}
p.seccionsub{color:#5a636e;margin:0 0 18px;font-size:15px}
.volver{display:inline-block;margin-top:28px;color:#2c5aa0;text-decoration:none}
.caja{background:#fff8e1;border-left:4px solid #f0b429;padding:12px 16px;
      border-radius:0 8px 8px 0;font-size:14.5px;margin:0 0 26px}
.mapa{background:#1f2733;color:#cfe3ff;border-radius:10px;padding:16px 20px;margin:0 0 26px;
      font-family:Consolas,Menlo,monospace;font-size:13.5px;line-height:1.85;overflow-x:auto;white-space:pre}
</style>
</head>
<body>
<div class="wrap">

  <h1>&#128218; Cuestionarios — NestJS</h1>
  <p class="sub">Basados en el proyecto <code>icesi-2026b-nestjs</code> (car-dealershop) del profe, hasta la clase del 28 de septiembre:
     marcas, coches, usuarios, JWT, guards y roles.</p>

  <div class="caja">
    <b>Como funciona:</b> igual que los de Express. Escribe la respuesta en los huecos amarillos y marca las opciones.
    <b>Verificar todo</b> pinta de verde lo correcto y de rojo lo incorrecto; <b>Mostrar solucion</b> rellena todo;
    <b>Limpiar</b> empieza de cero. Los huecos <b>azules y punteados</b> son <b>firmas completas</b>.
    Cada cuestionario tiene <b>retos</b> (escribir el archivo entero de memoria, se desbloquean al acertar los huecos de su bloque),
    una seccion <b>"De memoria: la linea completa"</b> y <b>preguntas de comprension</b> con casos borde: "¿que pasa si...?".
    <br><br>
    <b>Orden recomendado:</b> del 1 al 9. El 6 (errores) y el 9 (el detective) son los que mejor te preparan para
    un examen, porque preguntan por situaciones y no solo por sintaxis.
  </div>

  <div class="mapa">Peticion HTTP
   ↓  <span style="color:#7ee2a8">[Guards]</span>       AuthGuard() → JwtStrategy · UserRoleGuard              (cuestionarios 7 y 8)
   ↓  <span style="color:#7ee2a8">[Pipes]</span>        ValidationPipe (DTOs) · ParseUUIDPipe                    (cuestionarios 3 y 4)
   ↓  <span style="color:#7ee2a8">[Controller]</span>   @Get @Post @Patch @Delete · @Param @Body                 (cuestionario 3)
   ↓  <span style="color:#7ee2a8">[Service]</span>      logica de negocio · bcrypt · jwt · lanza excepciones      (cuestionarios 5, 6 y 7)
   ↓  <span style="color:#7ee2a8">[Repository]</span>   TypeORM → entidades → PostgreSQL                          (cuestionario 5)
   ↑  <span style="color:#ffb86c">[Excepciones]</span>  400 401 403 404 409 500 → JSON de error                  (cuestionario 6)

todo conectado por <span style="color:#7ee2a8">@Module</span> (imports / exports / providers) e inyeccion de dependencias   (cuestionario 2)
y arrancado desde main.ts + app.module.ts                                                            (cuestionario 1)</div>

  <h2 class="seccion" style="border-top:0;padding-top:0;margin-top:10px">&#128218; El repo del profe (car-dealershop)</h2>
  <p class="seccionsub">Del 1 al 9, en orden. El 6 (errores) y el 9 (el detective) son los que mejor preparan para un examen.</p>

  <div class="grid">

    <a class="tarjeta" href="index.php">
      <div class="n">Cuestionario 1</div>
      <h2>Panorama y arranque</h2>
      <p><code>main.ts</code>, <code>app.module.ts</code>, ValidationPipe global, TypeORM, Docker, <code>.env</code>, tsconfig y el recorrido hasta que el servidor queda activo.</p>
      <div class="tags">NestFactory · @Module · forRoot · synchronize · listen</div>
    </a>

    <a class="tarjeta" href="segundo.php">
      <div class="n">Cuestionario 2</div>
      <h2>Modulos e inyeccion de dependencias</h2>
      <p>Que conecta con que: <code>providers</code>, <code>imports</code>, <code>exports</code>, <code>forFeature</code>, <code>@Injectable</code>, <code>@InjectRepository</code> y los errores tipicos de DI.</p>
      <div class="tags">exports · forFeature · @InjectRepository · singleton</div>
    </a>

    <a class="tarjeta" href="tercero.php">
      <div class="n">Cuestionario 3</div>
      <h2>Controllers y rutas</h2>
      <p>Decoradores HTTP, <code>@Param</code>/<code>@Body</code>, <code>ParseUUIDPipe</code>, la tabla de rutas de toda la API y el ciclo de vida de una peticion.</p>
      <div class="tags">@Controller · @Get · @Patch · ParseUUIDPipe · 201/200</div>
    </a>

    <a class="tarjeta" href="cuarto.php">
      <div class="n">Cuestionario 4</div>
      <h2>DTOs y validacion</h2>
      <p>class-validator, <code>whitelist</code>, <code>PartialType</code>, <code>@IsOptional</code>, la forma del error 400 y casos borde de entrada.</p>
      <div class="tags">@Length · @IsNumber · PartialType · forbidNonWhitelisted</div>
    </a>

    <a class="tarjeta" href="quinto.php">
      <div class="n">Cuestionario 5</div>
      <h2>Entidades, TypeORM y CRUD</h2>
      <p>Entity, Column, relaciones, <code>eager</code>, <code>@BeforeInsert</code>, todos los metodos del Repository y los codigos de error de Postgres.</p>
      <div class="tags">@Entity · OneToMany · save · update · 23505</div>
    </a>

    <a class="tarjeta" href="sexto.php">
      <div class="n">Cuestionario 6</div>
      <h2>Excepciones y errores</h2>
      <p>Tipos de excepcion, de donde sale cada codigo HTTP, errores de compilacion vs arranque vs peticion, y los errores silenciosos.</p>
      <div class="tags">HttpException · 400/401/403/404/409/500 · try/catch</div>
    </a>

    <a class="tarjeta" href="septimo.php">
      <div class="n">Cuestionario 7</div>
      <h2>Autenticacion con JWT</h2>
      <p>Registro con bcrypt, login, <code>JwtModule.registerAsync</code>, Passport, <code>JwtStrategy</code> y como llega el usuario a <code>request.user</code>.</p>
      <div class="tags">bcrypt · jwtService.sign · PassportStrategy · validate</div>
    </a>

    <a class="tarjeta" href="octavo.php">
      <div class="n">Cuestionario 8</div>
      <h2>Guards, decoradores y roles</h2>
      <p><code>UserRoleGuard</code>, <code>Reflector</code>, <code>SetMetadata</code>, <code>applyDecorators</code>, <code>createParamDecorator</code> y la tabla de las cuatro rutas protegidas.</p>
      <div class="tags">CanActivate · SetMetadata · @Auth · 401 vs 403</div>
    </a>

    <a class="tarjeta final" href="noveno.php">
      <div class="n">Cuestionario 9 · integrador</div>
      <h2>El detective: bugs y casos borde</h2>
      <p>Los bugs reales del codigo del profe (catch vacio, <code>|</code> vs <code>||</code>, hash en las respuestas...) y un examen de "¿que responde la API?".</p>
      <div class="tags">catch vacio · select:false · 3672 · 200 sin cuerpo</div>
    </a>

  </div>

  <h2 class="seccion">&#128296; Taller del hotel (evaluacion de 2 horas)</h2>
  <p class="seccionsub">Sobre <code>taller_hotel_2h_nest_2025B</code>: la API de hoteles con bugs metidos a proposito.
     Los siete bugs, las validaciones, los metodos que faltaban y lo que los tests te estaban diciendo.</p>

  <div class="caja">
    <b>Lo que mas duele del taller:</b> la aplicacion <b>ni siquiera arrancaba</b>
    (<code>@Column({ type: 'timestamp' })</code> no existe en sqlite), un modulo entero no estaba
    importado y daba 404 sin decir nada, y el <code>ValidationPipe</code> estaba importado pero
    nunca registrado, asi que <b>todos</b> los decoradores de <b>todos</b> los DTOs eran adorno.
    Ninguno de los tres lo detecta TypeScript.
  </div>

  <div class="grid">

    <a class="tarjeta taller" href="hotel1.php">
      <div class="n">Taller 1</div>
      <h2>El arranque roto</h2>
      <p><code>main.ts</code>, <code>app.module.ts</code>, el ValidationPipe fantasma, el modulo sin importar y las tres fases donde puede fallar algo.</p>
      <div class="tags">DataTypeNotSupportedError · whitelist · transform · 404 silencioso</div>
    </a>

    <a class="tarjeta taller" href="hotel2.php">
      <div class="n">Taller 2</div>
      <h2>Entidades y relaciones</h2>
      <p>Columnas, lado dueño, donde vive la clave foranea y la diferencia real entre <code>cascade</code> y <code>onDelete</code>.</p>
      <div class="tags">@ManyToOne · @CreateDateColumn · decimal · hotelId</div>
    </a>

    <a class="tarjeta taller" href="hotel3.php">
      <div class="n">Taller 3</div>
      <h2>DTOs y validacion</h2>
      <p>Las 12 validaciones que pedia el enunciado, el problema de las fechas en JSON y donde acaba el DTO y empieza el service.</p>
      <div class="tags">@IsOptional · @Min(0.01) · @Type(() =&gt; Date) · PartialType</div>
    </a>

    <a class="tarjeta taller" href="hotel4.php">
      <div class="n">Taller 4</div>
      <h2>Servicios, repositorio y CRUD</h2>
      <p><code>create</code> vs <code>save</code>, <code>update</code> vs <code>remove</code>, <code>affected</code>, Like/Between/Not y la regla del solape de fechas.</p>
      <div class="tags">affected === 0 · Not('cancelled') · @Optional() · Number()</div>
    </a>

    <a class="tarjeta taller final" href="hotel5.php">
      <div class="n">Taller 5 · integrador</div>
      <h2>Rutas, codigos HTTP y tests</h2>
      <p>El bug del orden de las rutas, la tabla de "¿que responde la API?" y como un <code>jest.fn()</code> sustituye a la base de datos entera.</p>
      <div class="tags">:id se come search · getRepositoryToken · 201/400/404/409</div>
    </a>

  </div>

  <a class="volver" href="../Menu.php">&#8592; Volver a CompuNet</a>

</div>
</body>
</html>
