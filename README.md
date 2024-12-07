# Sistema de Gestión de Inscripción de Participantes - INCES

## **Objetivo del Sistema**  
El sistema está diseñado para gestionar la inscripción de participantes a los cursos ofrecidos por el **Instituto Nacional de Capacitación y Educación Socialista (INCES)**. También permite la gestión de instructores de los cursos, proporcionando una herramienta eficiente para la administración de la capacitación y formación dentro de la institución.

### **Funcionalidades principales**  
- **Registro de participantes**: Los administradores pueden registrar los datos de los participantes y asignarlos a cursos específicos.  
- **Gestión de cursos**: Crear, modificar y eliminar cursos, asignando instructores y definiendo las características de cada curso.  
- **Gestión de instructores**: Registrar y administrar los datos de los instructores, asignándolos a los cursos que van a dictar.  
- **Autenticación de usuarios**: Incluye un proceso de autenticación basado en roles:  
  - Administradores con acceso completo.  
  - Usuarios comunes con permisos limitados.  

> **Nota**: El sistema utiliza medidas de seguridad como cifrado de contraseñas y validación de datos para garantizar la protección de la información y prevenir ataques comunes.

---

## **Tecnologías Utilizadas**  
- **Lenguaje de Programación**: PHP  
- **Base de Datos**: MySQL  
- **Servidor Web**: XAMPP (Apache, MySQL)  
- **Frontend**: Bootstrap  
- **Arquitectura**: Modelo-Vista-Controlador (MVC)  

---

## **Requisitos del loginController del Sistema**  
El controlador de login fue desarrollado con los siguientes criterios:  
1. **Autenticación segura**: Los usuarios pueden autenticarse correctamente utilizando un nombre de usuario y contraseña.  
2. **Seguridad de contraseñas**: Las contraseñas son encriptadas con el algoritmo `bcrypt`.  
3. **Validación de datos**: Se garantiza la entrada de datos válidos, previniendo inyecciones SQL y otros ataques.  
4. **Gestión de sesiones**: Se maneja de forma segura, incluyendo políticas de expiración.  

---

## **Estructura del Proyecto**  
La estructura básica del repositorio incluye los siguientes archivos y carpetas:

```
/controllers
    loginController.php
    usuarioController.php
/includes
    db.php
    footer.php
    header.php
/models
    Database.php
    Usuario.php
/views
    dashboard.php
    login.php
    usuario/
        editar.php
        listar.php
        registrar.php
config.php
index.php
```

### **Descripción de Archivos y Carpetas**  
- **`/controllers`**: Controladores que gestionan las operaciones del sistema, como la autenticación y la gestión de usuarios.  
- **`/includes`**: Archivos comunes como conexión a la base de datos (db.php), encabezado (header.php) y pie de página (footer.php).  
- **`/models`**: Archivos para la interacción con la base de datos, como las clases `Usuario y Database`  
- **`/views`**: Vistas que presentan las interfaces de usuario: inicio de sesión (login.php), panel de administración (dashboard.php) y vistas relacionadas con la gestión de usuarios.  
- **`config.php`**: Configuraciones generales del sistema.  
- **`index.php`**: Redirige a los usuarios según si están autenticados.

---

## **Instalación y Uso**  

### **Requisitos Previos**  
1. Tener PHP (versión 7.4 o superior) y MySQL instalados.  
2. Instalar XAMPP u otro entorno compatible con PHP y MySQL.  

### **Pasos para la Instalación**  
1. **Clonar el repositorio**:  
   ```bash
   git clone https://github.com/Jose-Sierra082005/inces-login-controller-evaluacion.git
   ```  
2. **Configurar la base de datos**:  
   - Crear una base de datos MySQL llamada `inces_sistema`  
   - Importar el archivo SQL que contiene las tablas necesarias (disponible en el repositorio)  
3. **Configurar el entorno**:  
   - Abrir el archivo `includes/db.php` y actualizar las credenciales de la base de datos 
4. **Iniciar el servidor**:  
   - Usar XAMPP para encender Apache y MySQL.  
   - Acceder al sistema desde `http://localhost/tu-repositorio/`  
5. **Acceder al sistema**:  
   - Iniciar sesión con las credenciales de administrador.  

---

## **Instrucciones de Uso**  
- **Inicio de sesión**: Los usuarios acceden con su nombre de usuario y contraseña, protegidos por `bcrypt`  
- **Gestión de usuarios**: Desde el panel, los administradores pueden agregar, editar y eliminar usuarios.  
- **Gestión de cursos y participantes**: Los administradores pueden registrar participantes en los cursos y asignar instructores.  

---

## **Consideraciones de Seguridad**  
1. **Cifrado de contraseñas**: Utiliza `bcrypt` para proteger contraseñas en la base de datos  
2. **Protección contra inyección SQL**: Todas las consultas emplean sentencias preparadas.  
3. **Gestión de sesiones**: Prevención del secuestro de sesiones y tiempo de expiración configurado.  

---

## **Uso de GitHub**  
- **Ramas**:  
  - Ramas de desarrollo para nuevas características.  
  - Rama `main` para la versión estable  
- **Commits**: Mensajes claros y concisos describen cada cambio realizado.  
- **Pull Requests**: Se usan para fusionar nuevas funcionalidades en la rama principal.  

---

## **Integrantes del Proyecto**  
- **José Fernando Sierra Márquez**.   (V.- 31.149.881)  
- **Peña Bustillos Frank Alejandro**  (V.- 31.437.316)  
- **Andrés Rivero** (V.- 29.939.663)  
- **Jesús Eduardo García Medina**     (V.- 31.196.536)  

--- 

