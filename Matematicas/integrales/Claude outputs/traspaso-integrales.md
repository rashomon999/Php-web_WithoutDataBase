# IntegralesApp — estado y siguientes pasos

Resumen para arrancar un chat nuevo sin perder el hilo. Pégalo entero como primer mensaje.

## Qué es

App Android de práctica de integrales, Kotlin + vistas clásicas (ViewBinding, nada de Compose).
Carpeta: `C:\Users\luisg\Desktop\IntegralesApp_2_intento_redimension`
Paquete y applicationId: `com.integrales`. Nombre de desarrollador en Play: Myshkin.

Hay una segunda app hermana, de derivadas, en `C:\Users\luisg\Desktop\DerivadasApp`, con paquete `com.derivatives.trainer`.

## Cadena de compilación (ya estabilizada, no tocar sin motivo)

Gradle 8.4, Android Gradle Plugin 8.2.2, Kotlin 2.1.0, compileSdk y targetSdk 36, minSdk 24, jvmTarget 11.
`play-services-ads` fijado en **24.0.0**: es la última que el AGP 8.2.2 acepta sin quejarse en `checkReleaseAarMetadata`. Subir el SDK de anuncios exigiría subir antes el AGP.
Kotlin tuvo que subir de 1.9.22 a 2.1.0 porque el SDK de anuncios trae dentro módulos compilados con Kotlin 2.1 que un compilador 1.9 no sabe leer.

Versión actual: `versionCode = 16`, `versionName = "1.0.8"`.

## Cómo está organizado el código

Todo en `app/src/main/java/com/integrales/`, quince archivos Kotlin.

`Quiz.kt` tiene las 96 preguntas, repartidas en cuestionarios (Basics 1, 2, 3, Ln and root, etc.). 52 de ellas tienen desglose paso a paso, definido con entradas `Paso(...)`; quedan 44 sin desglose.
`QuizActivity.kt` es la pantalla de responder, y es con diferencia el archivo más grande y delicado.
`PasoGuiado.kt` convierte un `Paso` en una pregunta respondible. `Algebra.kt` compara respuestas: `iguales()` es estricta y se usa en los pasos intermedios, `equivalentes()` tolera constantes y se usa solo en los `+C`.
`Progreso.kt` guarda en SharedPreferences la racha actual, el récord histórico y el conjunto de ejercicios resueltos.
`Teoria.kt` y `TeoriaActivity.kt` son la sección de teoría con huecos rellenables sobre los teoremas fundamentales del cálculo.
El renderizado matemático es KaTeX 0.18.1, empaquetado offline en `assets/katex/`, dentro de WebViews (`MathView`, `TeoriaView`, `PasosView`).
`Anuncios.kt` concentra toda la lógica de AdMob.

## Anuncios

Intersticial, y solo uno: al terminar un cuestionario, cuando el usuario pulsa "volver al menú". Hay además un suelo de 90 segundos entre anuncios. Nunca al abrir ni al cerrar la app, que es lo que exige la política de AdMob.

En compilaciones de depuración se sirve siempre el bloque de prueba de Google; en release se usa el bloque real. Eso lo decide `BuildConfig.DEBUG` dentro de `Anuncios.kt`.

ID de aplicación de AdMob: `ca-app-pub-6876309532098990~9592418518`. Bloque intersticial: `ca-app-pub-6876309532098990/3711826869`.

## Lo que queda pendiente

En Play Console hay que marcar **"Sí, mi app contiene anuncios"** y guardar. Sin eso, la versión con anuncios no debería llegar a producción.

En AdMob la app sigue en **"Publicación limitada – Debe revisarse"**. La revisión tarda un par de días. Quitar esa limitación del todo requiere verificar `app-ads.txt`, y eso necesita un sitio web propio, que aún no hay.

El AAB firmado ya está construido en `app/release/app-release.aab`, listo para subir.

## Ideas que quedaron en el aire

Escribir el desglose paso a paso de las 44 preguntas que aún no lo tienen.
Guardar un récord por cuestionario, no solo el global.
Borrar `PasosActivity.kt`, que ya no se usa desde ninguna parte.
Llevar a la app de derivadas dos arreglos que ya están en esta: el botón `≠` en la barra de símbolos y el `inputType` que desactiva el autocorrector del teclado.
