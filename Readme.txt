Requisitos Previos
•	Tener instalado visual estudio code de lo contrario un video que ayudara a la instalación y configuración adecuada https://www.youtube.com/watch?v=X_Z7d04x9-E 
•	Tener instalado xampp de lo contrario un video que ayudara a la instalación y configuración adecuada https://www.youtube.com/watch?v=IQ22Nme9t0M
•	Navegador web recomendado: en este caso Google Chrome
 
•	Conexión a internet activa.
•	Cuenta de usuario registrada en el sistema (administrador o estudiante).
•	De igual forma de no tener cuenta creada se puede crear una

 
Para comenzar con la descarga e instalación primero se debe ingresar al sitio https://github.com/Felipe-Ismael-Maas-Canul/ProyectoCSAS.git
Una vez ingresado nos aparecerá esta pantalla, en la cual debemos buscar el apartado de “ code” para poder descargar los archivos comprimidos
 
Se puede utilizar dos formas, una de ella copiar directamente el repositorio desde el git, pero en esta ocasión se descargará el archivo zip
 
Una vez que este descargado, se descomprime en el lugar en donde se tendrá la carpeta, para posteriormente abrir para comenzar a utilizar el programa.
 
Una vez ya teniendo descomprimido el archivo, abrimos una ventana de Visual estudio, para abrir la carpeta
 
Una vez estando dentro, ubicaremos las carpetas “Crud” (Nuestro backend) y “src” (Nuestro Frontend).
 
Una vez teniendo ubicados esas carpetas, abrimos una terminar de la cual usaremos para estar ingresando a las carpetas, ya que cada una tiene una función diferente.
 
Vamos a comenzar con el crud, pero primero entramos a la carpeta, después al crud para levantar el servidor  
En este caso, como no esta instalado composer, asi que en la terminar escribimos “composer install” y se comienza a descargar los archivos.
 
Una vez terminado, usamos el comando “php artisan serve” para levantar el servidor.
 
Ya en este punto el servidor esta activo.
Una vez teniendo el servidor en línea, accedemos a la siguiente pagina http://localhost:8012/phpmyadmin/index.php?route=/server/databases
Donde veremos nuestras bases de datos 
 
En este punto buscamos el apartado para crear una nueva base de datos, en nuestro casi se llamara “encuesta”
Antes de hacer la migración de las tablas del Crud a la base de datos se debe hacer un paso extra el cual es el siguiente 
 
En la parte de archivos, ubicando la carpeta Crud, debemos expandir y buscar la capeta “Vendor”, después dentro de esta la capeta de laravel
 
Después expandir la carpeta Laravel, esto para buscar el ultimo apartado que es la de base de datos, y eliminar el archivo que trae dentro, esto para cuando se haga la migración no se creen conflictos
 
Ya una vez eliminado, ay que buscar si no tiene el archivo “.env” en caso de no tenerlo añadimos el siguiente comando copy .env.example .env
Esto nos creara el archivo
 
Una vez creado, nos debemos percarta que este bien configurado
 
En este caso no lo esta, por lo cual nos pasamos a cambiar “sqlite” por “mysql” y quitar los “#”, para que quede de la siguiente manera, asi como cambiar el crud por “en cuesta”
Nota: esta parte de cambio de nombres de bases de datos, es solo para que se tenga mejor control, se puede omitir, y dependiendo el nombre que se ponga aquí se podría crear la base de datos, por ejemplo si tiene “crud” al momento de la migración, se creara una base con ese nombre
 
Una vez teniendo la configuración correcta, nos regresamos a la terminal para hacer la migración con el comando php artisan migrate
 
Lo que pasa a continuación es la migración de las tablas a la base de datos, en este caso llamada encuesta y apareciendo todo en la base de datos
 
Ya con eso tenemos listo sabiendo que ya esta todo relacionado
Ahora pasamos con el apartado del frontend
De la misma forma abriendo una nueva terminar y con los siguientes comandos 
 
Primero nos percatamos que no esta instalado ninguna dependencia, de la cuel escribiremos el comando npm install, para que se instalen
 
Posteriormente el “ng serve” y nos deberá correr el servidor
 
Nos dirigimos al link http://localhost:4200/
Y ya teniendo en cuenta todo eso, nos debería mandar a la pestaña principal
