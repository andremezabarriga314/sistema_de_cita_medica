<div align="center">

# 🦷 Sonrisa Perfecta

**Sistema de gestión odontológica**

![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?logo=mysql&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-compatible-FB7A24?logo=xampp&logoColor=white)
![Estado](https://img.shields.io/badge/uso-acad%C3%A9mico-blue)

Aplicación web en **PHP + MySQL** con interfaz oscura y responsive,
autenticación de usuarios y operaciones CRUD completas.

[Instalación](#-instalación-en-xampp) ·
[Módulos](#-módulos-incluidos) ·
[Seguridad](#-seguridad-implementada) ·
[Consideraciones](#%EF%B8%8F-consideraciones-importantes)

</div>

---

## ✨ Características principales

- 🔐 Autenticación segura (login, registro y cierre de sesión)
- 📊 Dashboard con indicadores, próximas citas y pacientes recientes
- 🗂️ CRUD completo de las entidades clínicas y administrativas
- 💳 Registro de pagos con múltiples métodos
- 🖨️ Reportes imprimibles
- 📱 Diseño adaptable a escritorio, tablet y móvil

## 📋 Requisitos

| Componente | Versión / Detalle |
|---|---|
| Servidor local | XAMPP (Apache + MySQL) o equivalente |
| PHP | 8.1 o superior, con extensiones `PDO` y `pdo_mysql` |
| Base de datos | MySQL 5.7+ o MariaDB 10.4+ |
| Navegador | Cualquier versión actualizada |

## 🚀 Instalación en XAMPP

**1. Copia el proyecto**
Descomprime la carpeta `sonrisa_perfecta` dentro de `C:\xampp\htdocs\`.

**2. Inicia los servicios**
Abre el *XAMPP Control Panel* y activa **Apache** y **MySQL**.

**3. Importa la base de datos**
1. Entra a `http://localhost/phpmyadmin`.
2. Ve a la pestaña **Importar**.
3. Selecciona `database/sonrisa_perfecta.sql` y ejecuta la importación.

**4. Verifica la conexión**
Revisa `config/database.php`. Los valores predeterminados de XAMPP son:

| Parámetro | Valor |
|---|---|
| Host | `127.0.0.1` |
| Base de datos | `sonrisa_perfecta` |
| Usuario | `root` |
| Contraseña | *(vacía)* |

**5. Crea tu primer usuario**
Abre 👉 `http://localhost/sonrisa_perfecta/register.php`

**6. Inicia sesión**
Ingresa desde 👉 `http://localhost/sonrisa_perfecta/login.php`

## 🧩 Módulos incluidos

| Módulo | Descripción |
|---|---|
| 🔑 **Acceso** | Login, registro de usuarios y cierre de sesión |
| 📈 **Dashboard** | Indicadores, próximas citas y pacientes recientes |
| 🧑‍🤝‍🧑 **Pacientes** | CRUD completo |
| 🩺 **Odontólogos** | CRUD completo |
| 📅 **Citas** | CRUD completo |
| 📝 **Diagnósticos** | CRUD completo |
| 🦷 **Tratamientos** | CRUD completo |
| 🧾 **Servicios** | CRUD completo |
| 💰 **Pagos** | CRUD completo |
| 📑 **Reportes** | Ingresos mensuales, atenciones y citas pendientes |

**Métodos de pago:** 💵 Efectivo · 💳 Tarjeta de crédito · 💳 Tarjeta de débito · 📲 Yape

**Extras:** búsqueda rápida en tablas, diseño adaptable e impresión de reportes.

## 🔒 Seguridad implementada

| Medida | Implementación |
|---|---|
| Inyección SQL | PDO con consultas preparadas |
| Contraseñas | `password_hash()` y `password_verify()` |
| CSRF | Token en todos los formularios POST |
| XSS | Escape de salida con `htmlspecialchars()` |
| Sesiones | Regeneración del ID al iniciar sesión |

## ⚠️ Consideraciones importantes

> [!WARNING]
> Este proyecto es una **base funcional académica**. Antes de usarlo con
> pacientes reales, añade:
> - Control de permisos por rol
> - Auditoría de acciones
> - Copias de seguridad
> - Validación de solapamiento de citas
> - Políticas de privacidad y protección de datos

> [!NOTE]
> **Roles de usuario:** el registro público crea usuarios con rol `recepcion`.
> Para crear administradores, cambia el rol directamente desde phpMyAdmin o
> implementa un módulo de administración de usuarios.

> [!NOTE]
> **Integridad de datos:** la eliminación de registros relacionados puede ser
> bloqueada por las claves foráneas para preservar la información.

---

<div align="center">

Hecho con 🦷 para fines académicos

</div>
