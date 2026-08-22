@echo off
setlocal EnableDelayedExpansion
title Publicar cuestionarios en InfinityFree

rem ============================================================================
rem  publicar.bat  -  sube a InfinityFree solo lo que cambio desde la ultima vez
rem
rem  Uso:
rem     doble clic            -> muestra la lista de cambios y pide confirmacion
rem     publicar.bat /auto    -> sube sin preguntar (para dejarlo programado)
rem     publicar.bat /ver     -> solo muestra que cambiaria, no sube nada
rem
rem  La configuracion (usuario y contrasena) va en publicar.config
rem ============================================================================

cd /d "%~dp0"
set "RAIZ=%CD%"

echo.
echo ===============================================
echo   Publicar cuestionarios  -  InfinityFree
echo ===============================================
echo.

rem ---------------------------------------------------------------- config ---
if not exist "publicar.config" (
    echo [ERROR] No encuentro publicar.config en esta carpeta.
    echo         Debe estar junto a este .bat, con tus datos de FTP.
    goto :fin_error
)

set "FTP_HOST="
set "FTP_USER="
set "FTP_PASS="
set "REMOTO="
set "BORRAR_REMOTOS="
set "WINSCP_PATH="

for /f "usebackq eol=# tokens=1,* delims==" %%A in ("publicar.config") do (
    set "clave=%%A"
    set "valor=%%B"
    rem quitar espacios sobrantes alrededor de la clave
    for /f "tokens=* delims= " %%C in ("!clave!") do set "clave=%%C"
    if /i "!clave!"=="FTP_HOST"        set "FTP_HOST=%%B"
    if /i "!clave!"=="FTP_USER"        set "FTP_USER=%%B"
    if /i "!clave!"=="FTP_PASS"        set "FTP_PASS=%%B"
    if /i "!clave!"=="REMOTO"          set "REMOTO=%%B"
    if /i "!clave!"=="BORRAR_REMOTOS"  set "BORRAR_REMOTOS=%%B"
    if /i "!clave!"=="WINSCP_PATH"     set "WINSCP_PATH=%%B"
)

if "%FTP_HOST%"=="" set "FTP_HOST=ftpupload.net"
if "%REMOTO%"==""   set "REMOTO=/htdocs"

if "%FTP_USER%"=="" (
    echo [ERROR] Falta FTP_USER en publicar.config
    goto :fin_error
)
if "%FTP_PASS%"=="" (
    echo [ERROR] Falta FTP_PASS en publicar.config
    echo         Abre ese archivo y pon tu contrasena de FTP.
    goto :fin_error
)

rem ---------------------------------------------------------------- winscp ---
set "WINSCP="
if not "%WINSCP_PATH%"=="" if exist "%WINSCP_PATH%" set "WINSCP=%WINSCP_PATH%"

if "%WINSCP%"=="" (
    for %%P in (
        "%LOCALAPPDATA%\Programs\WinSCP\winscp.com"
        "%ProgramFiles%\WinSCP\winscp.com"
        "%ProgramFiles(x86)%\WinSCP\winscp.com"
    ) do if exist %%P if "!WINSCP!"=="" set "WINSCP=%%~P"
)

if "%WINSCP%"=="" (
    for /f "delims=" %%P in ('where winscp.com 2^>nul') do if "!WINSCP!"=="" set "WINSCP=%%P"
)

if "%WINSCP%"=="" (
    echo [ERROR] No encuentro winscp.com
    echo         Instala WinSCP desde https://winscp.net
    echo         o pon la ruta completa en publicar.config, linea WINSCP_PATH=
    goto :fin_error
)

rem ------------------------------------------------------- que NO se sube ---
rem  Sintaxis de WinSCP: lo que va detras de la barra vertical se excluye.
set "MASCARA=| node_modules/; .git/; .github/; .idea/; _to_delete/; _paquete_ftp/; _subir_a_ftp/; administrador/; *.zip; *.log; *.sql; package.json; package-lock.json; Dockerfile; .dockerignore; render.yaml; DESPLIEGUE.md; README.md; publicar.bat; publicar.config; instalar.php; instalar_estado.json"

rem ------------------------------------------------------------- opciones ---
set "EXTRA="
if /i "%BORRAR_REMOTOS%"=="si" set "EXTRA=-delete"
if /i "%BORRAR_REMOTOS%"=="yes" set "EXTRA=-delete"

set "MODO=%~1"
set "SOLO_VER=0"
set "SIN_PREGUNTAR=0"
if /i "%MODO%"=="/ver"  set "SOLO_VER=1"
if /i "%MODO%"=="/auto" set "SIN_PREGUNTAR=1"

echo   Origen  : %RAIZ%
echo   Destino : %FTP_USER%@%FTP_HOST%  ->  %REMOTO%
if not "%EXTRA%"=="" echo   Aviso   : se BORRARAN del servidor los archivos que ya no existan aqui
echo.

rem --------------------------------------------------------------- listado ---
echo --- Calculando que cambio desde la ultima subida...
echo.

"%WINSCP%" /ini=nul /log="_publicar.log" /loglevel=0 /command ^
  "option batch on" ^
  "option confirm off" ^
  "open ftpes://%FTP_USER%:%FTP_PASS%@%FTP_HOST%/ -certificate=* -timeout=30" ^
  "synchronize remote -preview -criteria=time %EXTRA% -filemask=""%MASCARA%"" ""%RAIZ%"" ""%REMOTO%""" ^
  "exit"

if errorlevel 1 (
    echo.
    echo [ERROR] Fallo al conectar o al comparar. Mira _publicar.log
    goto :fin_error
)

if "%SOLO_VER%"=="1" (
    echo.
    echo Modo /ver: no se ha subido nada.
    goto :fin_ok
)

rem ---------------------------------------------------------- confirmacion ---
if "%SIN_PREGUNTAR%"=="0" (
    echo.
    echo ============================================================
    echo   Revisa la lista de arriba.
    echo   Si ves miles de archivos cuando solo cambiaste unos pocos,
    echo   cancela: suele ser el reloj del PC o la mascara.
    echo ============================================================
    echo.
    set /p "RESP=Subir estos cambios? (s/n): "
    if /i not "!RESP!"=="s" (
        echo.
        echo Cancelado. No se subio nada.
        goto :fin_ok
    )
)

rem ----------------------------------------------------------------- subir ---
echo.
echo --- Subiendo...
echo.

"%WINSCP%" /ini=nul /log="_publicar.log" /loglevel=0 /command ^
  "option batch on" ^
  "option confirm off" ^
  "open ftpes://%FTP_USER%:%FTP_PASS%@%FTP_HOST%/ -certificate=* -timeout=30" ^
  "synchronize remote -criteria=time %EXTRA% -filemask=""%MASCARA%"" ""%RAIZ%"" ""%REMOTO%""" ^
  "exit"

if errorlevel 1 (
    echo.
    echo [ERROR] Algo fallo durante la subida. Detalles en _publicar.log
    goto :fin_error
)

echo.
echo ============================================================
echo   Listo. Los cambios ya estan en linea.
echo   https://questionnaires.rf.gd/
echo ============================================================

:fin_ok
echo.
if "%SIN_PREGUNTAR%"=="0" pause
endlocal
exit /b 0

:fin_error
echo.
if "%SIN_PREGUNTAR%"=="0" pause
endlocal
exit /b 1
