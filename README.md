# 🌐 PauloSanchez App - Prueba Técnica

¡Bienvenido al repositorio de la prueba técnica de **PauloSanchez App**! 🚀 
Este proyecto está diseñado para demostrar habilidades en el desarrollo de aplicaciones web full-stack, 
utilizando **Laravel** en el backend y **Vue** en el frontend, con autenticación JWT 
y un diseño responsivo basado en **Bootstrap**.

---

## 📋 Tabla de Contenidos

- [⚙️ Características Técnicas](#⚙️-características-técnicas)
- [📂 Clonar el Proyecto](#📂-clonar-el-proyecto)
- [🛠️ Instalación](#🛠️-instalación)
  - [1. Dependencias](#1-dependencias)
  - [2. Configuración de Variables de Entorno](#2-configuración-de-variables-de-entorno)
  - [3. Generación de Clave de Cifrado](#3-generación-de-clave-de-cifrado)
  - [4. Migraciones y Seeds](#4-migraciones-y-seeds)
- [🚀 Ejecución del Proyecto](#🚀-ejecución-del-proyecto)
- [🔗 Rutas Importantes](#🔗-rutas-importantes)
- [💬 Contribuciones](#💬-contribuciones)

---

## ⚙️ Características Técnicas

Este proyecto emplea las siguientes tecnologías y herramientas:

- **Backend**: Laravel 11.9, PHP 8.2 🐘
- **Base de Datos**: MariaDB (o cualquier gestor compatible con Laravel) 🛢️
- **Frontend**: Vue 3, Vite ⚡, Inertia, Bootstrap 🎨
- **Gestión de Paquetes**: Composer 📦, npm 📦

> **Requisitos previos**: Asegúrate de tener instalados **Composer**, **npm** 
y **MariaDB** (o un gestor de base de datos compatible).

---

## 📂 Clonar el Proyecto

1. Clona el repositorio en tu máquina local:
   ```bash
   git clone https://github.com/paulosandev/PauloSanchez.git
   ```

2. Accede a la carpeta del proyecto:
   ```bash
   cd PauloSanchez
   ```

## 🛠️ Instalación

### 1. Dependencias

Para configurar el entorno, instala las dependencias de Laravel y Vue:

- Laravel:
  ```bash
  composer install
  ```

- Vue:
  ```bash
  npm install
  ```

### 2. Configuración de Variables de Entorno

1. Duplica el archivo `.env.example.local` y nómbralo `.env`:
   ```bash
   cp .env.example.local .env
   ```

2. Configura las variables de conexión de la base de datos en el 
archivo `.env`. Se recomienda utilizar el nombre `testPauloSanchez` para la base de datos.

### 3. Generación de Clave de Cifrado

Genera la clave de cifrado de la aplicación:
```bash
php artisan key:generate
```

### 4. Migraciones y Seeds

Ejecuta las migraciones para configurar las tablas de la base de datos y los seeds para generar datos de prueba:
```bash
php artisan migrate
php artisan db:seed
```

---

## 🚀 Ejecución del Proyecto

Para iniciar el entorno de desarrollo:

1. En una terminal, ejecuta el servidor de desarrollo de Vue:
   ```bash
   npm run dev
   ```

2. En otra terminal, ejecuta el servidor de Laravel:
   ```bash
   php artisan serve
   ```

3. Una vez en ejecución, abre tu navegador y dirígete a la dirección configurada (por defecto, [http://127.0.0.1:8000/](http://127.0.0.1:8000/) o [http://localhost:8000/](http://localhost:8000/)) para probar la aplicación. 🎉

---

## 🔗 Rutas Importantes

- **Registro**: [http://127.0.0.1:8000/register](http://127.0.0.1:8000/register) - Para registrar un nuevo usuario 📝
- **Login**: [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login) - Para autenticarse en la aplicación 🔑
- **Dashboard**: [http://127.0.0.1:8000/dashboard](http://127.0.0.1:8000/dashboard) - Página accesible solo para usuarios autenticados 🔒

  ## 👤 Usuarios generados:
- email: francisco.mora@burben.mx password: Admin1234?
- email: andrei.zaragoza@burben.mx password: Admin1234?

---

## 💬 Contribuciones

¡Gracias por probar esta aplicación! Tu retroalimentación es clave para seguir mejorando. 😊
