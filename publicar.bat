@echo off
rem Lanzador de publicar.ps1 para poder hacer doble clic.
rem Todo el trabajo esta en publicar.ps1
cd /d "%~dp0"
powershell -NoProfile -ExecutionPolicy Bypass -File "%~dp0publicar.ps1" %1
if /i not "%~1"=="/auto" pause
