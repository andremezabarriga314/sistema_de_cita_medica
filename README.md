# Sonrisa Perfecta — Sistema de gestión odontológica

Aplicación web PHP + MySQL con interfaz oscura responsive, autenticación y operaciones CRUD.

## Requisitos
- XAMPP (Apache + MySQL) o equivalente.
- PHP 8.1 o superior (extensiones PDO y pdo_mysql).
- MySQL 5.7+ o MariaDB 10.4+.
- Navegador actualizado.

## Instalación en XAMPP
1. Descomprime la carpeta `sonrisa_perfecta` dentro de `C:\xampp\htdocs\`.
2. Abre XAMPP Control Panel e inicia **Apache** y **MySQL**.
3. Entra a `http://localhost/phpmyadmin`.
4. Selecciona **Importar**, elige `database/sonrisa_perfecta.sql` y ejecuta la importación.
5. Verifica los datos de conexión en `config/database.php`. En XAMPP normalmente son:
   - Host: `127.0.0.1`
   - Base de datos: `sonrisa_perfecta`
   - Usuario: `root`
   - Contraseña: vacía (instalación local predeterminada).
6. Abre `http://localhost/sonrisa_perfecta/register.php` y crea el primer usuario.
7. Inicia sesión desde `http://localhost/sonrisa_perfecta/login.php`.

## Módulos incluidos
- Login, registro de usuarios y cierre de sesión.
- Dashboard con indicadores, próximas citas y pacientes recientes.
- CRUD de pacientes, odontólogos, citas, diagnósticos, tratamientos, servicios y pagos.
- Reporte mensual de ingresos, atenciones y citas pendientes.
- Métodos de pago: efectivo, tarjeta de crédito, tarjeta de débito y Yape.
- Búsqueda rápida en las tablas, diseño adaptable e impresión de reportes.

## Seguridad implementada
- PDO con consultas preparadas para operaciones que reciben datos.
- Contraseñas almacenadas con `password_hash()` y verificadas con `password_verify()`.
- Token CSRF en formularios POST.
- Escape HTML con `htmlspecialchars()`.
- Regeneración de ID de sesión al iniciar sesión.

## Consideraciones
- La aplicación es una base funcional académica. Antes de usarla con pacientes reales, añade controles de permisos por rol, auditoría, copias de seguridad, validación de solapamiento de citas y políticas de privacidad.
- El registro público crea usuarios con rol `recepcion`. Para crear administradores, cambia el rol directamente desde phpMyAdmin o implementa un módulo de administración de usuarios.
- La eliminación de registros relacionados puede ser bloqueada por las claves foráneas para preservar la integridad de la información.
