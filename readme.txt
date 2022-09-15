Archivos con conexiones a bases de datos

    PHP/API Manager/db.php (EndPoints)

    PHP/API/db.php (DBSISMED)

    PHP/WEBAPP/ewcfg.php (DBSISMED)

    PHP/WEBAPP/bd/connection.php (DBSISMED)

    PHP/WEBAPP/valida_pge.php (DBSISMED)

Importante antes de correr y construir el apk
Se necesita tener instalado

    Java 8 -> https://www.java.com/es/download/ie_manual.jsp

    Open JDK -> x64 JDK 8 -> https://adoptium.net/es/temurin/releases

    Gradle 6.5 -> https://gradle.org/releases/

    Android Studio -> https://developer.android.com/studio

Antes de correr el app

Se deben configurar las variables de entorno

    Agregar la ruta de la carpeta bin del Open JDK a la variable de entorno PATH

    Agregar la ruta de la carpeta bin del Open JDK como variable de entorno JAVA_HOME

    Agregar la ruta de la carpeta bin del Gradle a la variable de entorno PATH

    Agregar la ruta de la carpeta tools dentro de la carpeta que aloja los SDK de Adnroid a la variable de entorno PATH

    Agregar la ruta de la carpeta platform-tools dentro de la carpeta que aloja los SDK de Adnroid a la variable de entorno PATH

    Agregar la ruta de la carpeta que aloja los SDK de Adnroid como variable de entorno ANDROID_HOME

Después de esto reiniciar el equipo
Instalar los paquetes necesarios para correr la app

npm install

npm install @ionic/cli @angular/cli cordova
Para correr la app usar el siguiente comando

ionic serve
Para construir el apk de la app usar el siguiente comando

ionic cordova build android