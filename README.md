Se decidio que mejor la version sin db se va a actualizar continuamente como una rama de la version con db 

http://questionnaires.rf.gd/index.php


Automatizado:
C:\xampp\htdocs\php_web\publicar.bat /ver     ← mira qué cambió, no sube
C:\xampp\htdocs\php_web\publicar.bat          ← sube, preguntando antes
C:\xampp\htdocs\php_web\publicar.bat /auto    ← sube sin preguntar

-----
La aplicación — PHP 8 puro, sin framework y sin base de datos. Los cuestionarios corrigen en el servidor con $_POST; las respuestas correctas viven en el PHP, no en el HTML.

El hosting — InfinityFree, hosting compartido gratuito: Apache + PHP 8.3, subdominio questionnaires.rf.gd con SSL. Se eligió porque no duerme el servicio, a diferencia del plan gratis de Render.

La subida inicial — FTP sobre TLS explícito (FTPS) contra ftpupload.net, con WinSCP. Como InfinityFree rechaza archivos de más de 10 MB, los 160 MB se empaquetaron en 21 zips de ~8 MB más un instalar.php que los descomprime en el servidor con ZipArchive, por tandas y de forma reanudable.

Las actualizaciones — publicar.bat → publicar.ps1 (PowerShell) invocando winscp.com en modo script. No compara contra el servidor: guarda una huella local de tamaño y fecha de cada archivo publicado y sube solo lo que cambió, igual que el índice de git. Fue necesario porque comparar los 3.400 archivos por FTP hacía que InfinityFree bloqueara la IP.

La configuración — un .htaccess de Apache: índice por defecto, sin listados de carpetas, UTF-8, compresión, caché de imágenes a 30 días y de CSS/JS a 5 minutos, y mod_speling como red de seguridad para enlaces con mayúsculas mal puestas.