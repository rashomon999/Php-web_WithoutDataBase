<#
=============================================================================
 publicar.ps1  -  publica en InfinityFree solo los archivos que cambiaron

 No compara contra el servidor (InfinityFree corta la conexion cuando le
 pides cientos de listados seguidos). En su lugar guarda una huella local
 de la ultima publicacion en _publicar_estado.txt y compara contra ella,
 igual que hace git con su indice.

 Modos:
   publicar.ps1          lista los cambios y pide confirmacion
   publicar.ps1 /ver     solo lista, no sube nada
   publicar.ps1 /auto    sube sin preguntar
   publicar.ps1 /todo    sube todo el sitio, ignorando la huella
   publicar.ps1 /base    marca el estado actual como publicado, sin subir nada
=============================================================================
#>

param([string]$Modo = "")

$ErrorActionPreference = "Stop"
$raiz = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $raiz

$SEP    = [System.IO.Path]::DirectorySeparatorChar
$ESTADO = Join-Path $raiz "_publicar_estado.txt"
$LOG    = Join-Path $raiz "_publicar.log"

function Escribir($texto, $color = "Gray") { Write-Host $texto -ForegroundColor $color }

Escribir ""
Escribir "===============================================" "Cyan"
Escribir "  Publicar cuestionarios  -  InfinityFree" "Cyan"
Escribir "===============================================" "Cyan"
Escribir ""

# ------------------------------------------------------------------ config --
$cfgPath = Join-Path $raiz "publicar.config"
if (-not (Test-Path $cfgPath)) {
    Escribir "[ERROR] No encuentro publicar.config junto a este script." "Red"
    exit 1
}

$cfg = @{}
foreach ($linea in Get-Content $cfgPath -Encoding UTF8) {
    $l = $linea.Trim()
    if ($l -eq "" -or $l.StartsWith("#")) { continue }
    $i = $l.IndexOf("=")
    if ($i -lt 1) { continue }
    $cfg[$l.Substring(0, $i).Trim()] = $l.Substring($i + 1).Trim()
}

$FTP_HOST = $cfg["FTP_HOST"]; if (-not $FTP_HOST) { $FTP_HOST = "ftpupload.net" }
$FTP_USER = $cfg["FTP_USER"]
$FTP_PASS = $cfg["FTP_PASS"]
$REMOTO   = $cfg["REMOTO"];   if (-not $REMOTO)   { $REMOTO = "/htdocs" }
$BORRAR   = ($cfg["BORRAR_REMOTOS"] -eq "si") -or ($cfg["BORRAR_REMOTOS"] -eq "yes")

if (-not $FTP_USER) { Escribir "[ERROR] Falta FTP_USER en publicar.config" "Red"; exit 1 }
if (-not $FTP_PASS) { Escribir "[ERROR] Falta FTP_PASS en publicar.config" "Red"; exit 1 }

# ------------------------------------------------------------------ winscp --
$winscp = $cfg["WINSCP_PATH"]
if (-not $winscp -or -not (Test-Path $winscp)) {
    $winscp = $null
    $bases = @($env:LOCALAPPDATA, ${env:ProgramFiles}, ${env:ProgramFiles(x86)})
    $sufijos = @("Programs\WinSCP\winscp.com", "WinSCP\winscp.com")
    foreach ($b in $bases) {
        if (-not $b) { continue }
        foreach ($s in $sufijos) {
            $c = Join-Path $b $s
            if (Test-Path $c) { $winscp = $c; break }
        }
        if ($winscp) { break }
    }
    if (-not $winscp) {
        $w = Get-Command winscp.com -ErrorAction SilentlyContinue
        if ($w) { $winscp = $w.Source }
    }
}
if (-not $winscp) {
    Escribir "[ERROR] No encuentro winscp.com." "Red"
    Escribir "        Ponlo a mano en publicar.config -> WINSCP_PATH=" "Red"
    exit 1
}

# --------------------------------------------------- que NO se publica ------
$carpetasFuera = @(
    "node_modules", ".git", ".github", ".idea", "_to_delete", "_paquete_ftp",
    "_subir_a_ftp", "administrador"
)
$archivosFuera = @(
    "publicar.ps1", "publicar.bat", "publicar.config", "_publicar_estado.txt",
    "_publicar.log", "_full_listing.txt", "instalar.php", "instalar_estado.json",
    "libros.sql", "package.json", "package-lock.json", "Dockerfile",
    ".dockerignore", "render.yaml", "DESPLIEGUE.md", "README.md", ".gitignore",
    "Thumbs.db", ".DS_Store"
)
$extensionesFuera = @(".zip", ".log", ".tar", ".gz")

function SeExcluye($rel) {
    $partes = $rel.Split($SEP)
    if ($carpetasFuera -contains $partes[0]) { return $true }
    if ($partes.Length -eq 1 -and ($archivosFuera -contains $partes[0])) { return $true }
    $ext = [System.IO.Path]::GetExtension($rel).ToLower()
    if ($extensionesFuera -contains $ext) { return $true }
    if ($partes[-1] -match '^zi[A-Za-z0-9]{6}$') { return $true }
    return $false
}

# ------------------------------------------------------- inventario local ---
Escribir "--- Revisando archivos locales..." "DarkGray"

$actual = @{}
$prefijo = $raiz.TrimEnd($SEP) + [string]$SEP
foreach ($f in Get-ChildItem -Path $raiz -Recurse -File -Force) {
    $rel = $f.FullName.Substring($prefijo.Length)
    if (SeExcluye $rel) { continue }
    $actual[$rel] = "" + $f.Length + "|" + $f.LastWriteTimeUtc.Ticks
}

Escribir ("    $($actual.Count) archivos publicables") "DarkGray"

# ------------------------------------------------------------- huella ------
$previo = @{}
$hayHuella = Test-Path $ESTADO
if ($hayHuella) {
    foreach ($linea in Get-Content $ESTADO -Encoding UTF8) {
        if ($linea -eq "") { continue }
        $p = $linea.Split([char]9)
        if ($p.Length -ge 2) { $previo[$p[0]] = $p[1] }
    }
}

function GuardarHuella {
    $sb = New-Object System.Text.StringBuilder
    foreach ($k in ($actual.Keys | Sort-Object)) {
        [void]$sb.AppendLine($k + [char]9 + $actual[$k])
    }
    [System.IO.File]::WriteAllText($ESTADO, $sb.ToString(), (New-Object System.Text.UTF8Encoding($false)))
}

# --- /base : dar por publicado lo que hay ahora, sin subir nada -------------
if ($Modo -eq "/base") {
    GuardarHuella
    Escribir ""
    Escribir "Huella guardada: $($actual.Count) archivos marcados como ya publicados." "Green"
    Escribir "A partir de ahora solo se subira lo que cambies." "Green"
    exit 0
}

# ------------------------------------------------------------- comparar ----
$forzarTodo = ($Modo -eq "/todo")

$subir = New-Object System.Collections.ArrayList
$nuevos = 0; $modificados = 0
foreach ($k in $actual.Keys) {
    if ($forzarTodo) { [void]$subir.Add($k); $modificados++; continue }
    if (-not $previo.ContainsKey($k)) { [void]$subir.Add($k); $nuevos++ }
    elseif ($previo[$k] -ne $actual[$k]) { [void]$subir.Add($k); $modificados++ }
}
$borrados = @()
foreach ($k in $previo.Keys) { if (-not $actual.ContainsKey($k)) { $borrados += $k } }

# --- primera vez sin huella ------------------------------------------------
if (-not $hayHuella -and -not $forzarTodo) {
    Escribir ""
    Escribir "No hay huella de publicaciones anteriores (_publicar_estado.txt)." "Yellow"
    Escribir ""
    Escribir "Si el sitio YA esta subido y al dia en el servidor, lo correcto es"
    Escribir "marcar el estado actual como publicado y empezar a contar desde ahi:"
    Escribir ""
    Escribir "    .\publicar.ps1 /base" "Cyan"
    Escribir ""
    Escribir "Si de verdad quieres volver a subir los $($actual.Count) archivos:"
    Escribir ""
    Escribir "    .\publicar.ps1 /todo" "Cyan"
    Escribir ""
    exit 0
}

# ------------------------------------------------------------- informe -----
Escribir ""
Escribir "  Origen  : $raiz"
Escribir "  Destino : $FTP_USER@$FTP_HOST  ->  $REMOTO"
Escribir ""
Escribir "  Nuevos      : $nuevos"
Escribir "  Modificados : $modificados"
Escribir "  Borrados    : $($borrados.Count)"
Escribir ""

if ($subir.Count -eq 0 -and ($borrados.Count -eq 0 -or -not $BORRAR)) {
    Escribir "No hay nada que publicar. Todo esta al dia." "Green"
    if ($borrados.Count -gt 0) {
        Escribir ""
        Escribir "(Hay $($borrados.Count) archivos que borraste en local y siguen en el servidor." "DarkGray"
        Escribir " Pon BORRAR_REMOTOS=si en publicar.config si quieres que se borren.)" "DarkGray"
    }
    exit 0
}

$muestra = 40
$i = 0
foreach ($k in ($subir | Sort-Object)) {
    if ($i -lt $muestra) { Escribir ("   + " + $k) "White" }
    $i++
}
if ($subir.Count -gt $muestra) { Escribir ("   ... y " + ($subir.Count - $muestra) + " mas") "DarkGray" }

if ($BORRAR -and $borrados.Count -gt 0) {
    Escribir ""
    foreach ($k in ($borrados | Select-Object -First 20)) { Escribir ("   - " + $k) "DarkYellow" }
    if ($borrados.Count -gt 20) { Escribir ("   ... y " + ($borrados.Count - 20) + " mas") "DarkGray" }
}

if ($Modo -eq "/ver") {
    Escribir ""
    Escribir "Modo /ver: no se ha subido nada." "Yellow"
    exit 0
}

if ($Modo -ne "/auto") {
    Escribir ""
    $r = Read-Host "Publicar estos cambios? (s/n)"
    if ($r -ne "s" -and $r -ne "S") {
        Escribir "Cancelado. No se subio nada." "Yellow"
        exit 0
    }
}

# --------------------------------------------------- guion para WinSCP -----
$usr = [uri]::EscapeDataString($FTP_USER)
$passEnc = [uri]::EscapeDataString($FTP_PASS)

$dirs = New-Object System.Collections.Generic.HashSet[string]
foreach ($k in $subir) {
    $d = Split-Path $k -Parent
    while ($d -and $d -ne "") {
        [void]$dirs.Add($d)
        $d = Split-Path $d -Parent
    }
}

$g = New-Object System.Text.StringBuilder
# "abort" ANTES de conectar: si el servidor no responde queremos rendirnos a la
# primera. Con "continue" WinSCP reintenta la conexion en bucle, y machacar el
# FTP de InfinityFree es justo lo que dispara sus bloqueos temporales de IP.
[void]$g.AppendLine("option batch abort")
[void]$g.AppendLine("option confirm off")
[void]$g.AppendLine("option transfer binary")
[void]$g.AppendLine("option reconnecttime off")
[void]$g.AppendLine("open ftpes://${usr}:${passEnc}@${FTP_HOST}/ -certificate=* -timeout=30")
[void]$g.AppendLine("option batch continue")

foreach ($d in ($dirs | Sort-Object { $_.Split($SEP).Length })) {
    $rd = $REMOTO + "/" + ($d -replace [regex]::Escape([string]$SEP), "/")
    [void]$g.AppendLine('mkdir "' + $rd + '"')
}

[void]$g.AppendLine("option batch abort")

foreach ($k in ($subir | Sort-Object)) {
    $rutaLocal  = Join-Path $raiz $k
    $rutaRemota = $REMOTO + "/" + ($k -replace [regex]::Escape([string]$SEP), "/")
    [void]$g.AppendLine('put -nopermissions "' + $rutaLocal + '" "' + $rutaRemota + '"')
}

if ($BORRAR -and $borrados.Count -gt 0) {
    [void]$g.AppendLine("option batch continue")
    foreach ($k in $borrados) {
        $rutaRemota = $REMOTO + "/" + ($k -replace [regex]::Escape([string]$SEP), "/")
        [void]$g.AppendLine('rm "' + $rutaRemota + '"')
    }
}

[void]$g.AppendLine("close")
[void]$g.AppendLine("exit")

$temp = $env:TEMP
if (-not $temp) { $temp = [System.IO.Path]::GetTempPath() }
$guion = Join-Path $temp ("publicar_" + [System.Guid]::NewGuid().ToString("N") + ".txt")
[System.IO.File]::WriteAllText($guion, $g.ToString(), (New-Object System.Text.UTF8Encoding($true)))

# ------------------------------------------------------------- ejecutar ----
Escribir ""
Escribir "--- Subiendo $($subir.Count) archivos..." "DarkGray"
Escribir ""

try {
    & $winscp "/ini=nul" "/log=$LOG" "/loglevel=0" "/script=$guion"
    $codigo = $LASTEXITCODE
}
finally {
    Remove-Item $guion -Force -ErrorAction SilentlyContinue
}

Escribir ""
if ($codigo -eq 0) {
    GuardarHuella
    Escribir "============================================================" "Green"
    Escribir "  Listo. $($subir.Count) archivos publicados." "Green"
    Escribir "  https://questionnaires.rf.gd/" "Green"
    Escribir "============================================================" "Green"
    exit 0
} else {
    Escribir "[ERROR] WinSCP termino con codigo $codigo." "Red"
    Escribir "        No se ha actualizado la huella, asi que al volver a" "Red"
    Escribir "        ejecutar reintentara los mismos archivos." "Red"
    Escribir "        Detalle en: $LOG" "Red"
    exit 1
}
