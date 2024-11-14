# Proyecto de Promociones ✨\u💳

Este proyecto es una aplicación web para mostrar promociones de productos de diferentes tiendas. La aplicación está desarrollada en PHP y utiliza MySQL como base de datos. Está dockerizada para facilitar su despliegue. ⚙️🚀

## Requisitos ⚡️

- Docker 🛠️
- Docker Compose ⚛️

## Instalación 📚

1. Clonar el repositorio: 🗃️

    ```sh
    git clone https://github.com/tu_usuario/tu_repositorio.git
    cd tu_repositorio
    ```

2. Crear un archivo `.env` en la raíz del proyecto con las siguientes variables: ✅

    ```env
    DB_HOST=db
    DB_USER=root
    DB_PASSWORD=tu_contraseña
    DB_NAME=promociones
    ```

3. Construir y levantar los contenedores: 🚀

    ```sh
    docker-compose up --build
    ```

4. Acceder a la aplicación en tu navegador web: 🖥️🔗

    ```
    http://localhost:8080
    ```

## Estructura del Proyecto 📁🔢

- `docker-compose.yml`: Archivo de configuración de Docker Compose. 🛁
- `Dockerfile`: Archivo de configuración de Docker para la aplicación PHP. 📚
- `src/`: Directorio con el código fuente de la aplicación. 💻
    - `index.php`: Archivo principal de la aplicación. ✉️
    - `styles.css`: Archivo de estilos CSS. 👗
- `db/`: Directorio con los scripts SQL para la creación y poblamiento de la base de datos. 🔬

## Uso 🔍🚀

1. La aplicación muestra una lista de productos en promoción. 🛒
2. Puedes filtrar los productos por tienda utilizando el menú lateral. 🔍
3. También puedes buscar productos por nombre utilizando el campo de búsqueda. 🔎

## Personalización ✏️🌟

1. Para cambiar el estilo de la aplicación, modifica el archivo `styles.css` en el directorio `src/`. 🗒
2. Para añadir nuevas funcionalidades, edita el archivo `index.php` en el directorio `src/`. 📁💡

## Despliegue 🚒📊

Para desplegar la aplicación en un entorno de producción, asegúrate de cambiar las variables de entorno en el archivo `.env` y utilizar un volumen persistente para la base de datos. 🛠️🌐

## Licencia 📜®️

Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo `LICENSE` para más información. 📝

---
