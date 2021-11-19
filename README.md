# dssd-unlp-2021-grupo11-monitoreo-service

# Comenzando 🚀

_Sigue las siguientes instrucciones para clonar este repositorio en tu máquina local_

### Pre-requisitos 📋

- docker-compose
https://docs.docker.com/compose/install/

- Haber clonado e instalado el docker-compose provisto por el grupo, siguiendo la guía de instalación provista https://github.com/juliancasaburi/dssd-unlp-2021-grupo11-laradock

### Instalación 🔧

_Sigue las siguientes instrucciones para clonar el repositorio_

_1. Posicionese sobre el directorio dssd-unlp-2021-grupo11-laradock_
```
cd ./dssd-unlp-2021-grupo11-laradock
```

_2. Posicionese sobre el directorio_

```
cd dssd-unlp-2021-grupo11-monitoreo-service
```

_3. Configure el repositorio_

```
sudo chmod -R 777 storage bootstrap/cache
```

_4. Configure las variables de entorno_

Configure las variables en el archivo ` .env`

### En el primer inicio del servicio, deberá instalar las dependencias y realizar algunas actividades de configuración

Luego de iniciar el docker-compose provisto, deberá ejecutar los siguientes comandos

```
cd ./dssd-unlp-2021-grupo11-laradock/laradock
sudo docker-compose exec workspace /bin/bash
cd dssd-unlp-2021-grupo11-monitoreo-service
composer install
php artisan key:generate
php artisan jwt:secret
php artisan migrate
```

# Accediendo a la api
La api puede accederse en http://localhost:83

# Endpoints - Documentación
La documentación generada por OpenAPI/Swagger, puede ser accedida en http://localhost:83/api/docs
