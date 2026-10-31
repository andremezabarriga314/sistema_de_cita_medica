# Sonrisa Perfecta

Sistema de gestión odontológica desarrollado con PHP y MySQL. Permite administrar pacientes, odontólogos, citas, diagnósticos, tratamientos, servicios y pagos desde una interfaz oscura y adaptable a distintos dispositivos.

![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?logo=mysql&logoColor=white)
![Estado](https://img.shields.io/badge/estado-proyecto%20acad%C3%A9mico-lightgrey)

## Contenido

1. [Descripción general](#descripción-general)
2. [Capturas de pantalla](#capturas-de-pantalla)
3. [Tecnologías](#tecnologías)
4. [Requisitos](#requisitos)
5. [Instalación](#instalación)
6. [Estructura del proyecto](#estructura-del-proyecto)
7. [Módulos](#módulos)
8. [Seguridad](#seguridad)
9. [Solución de problemas](#solución-de-problemas)
10. [Limitaciones y hoja de ruta](#limitaciones-y-hoja-de-ruta)
11. [Licencia y autoría](#licencia-y-autoría)

## Descripción general

Sonrisa Perfecta centraliza la operación diaria de un consultorio odontológico:

- Registro y consulta de pacientes y su historial.
- Programación de citas con odontólogos.
- Registro de diagnósticos, tratamientos y servicios ofrecidos.
- Control de pagos con distintos métodos.
- Reporte mensual de ingresos, atenciones y citas pendientes.

## Capturas de pantalla

| Inicio de sesión | Dashboard |
|---|---|
| ![Login](docs/img/login.png) | ![Dashboard](docs/img/dashboard.png) |

| Gestión de pacientes | Reporte mensual |
|---|---|
| ![Pacientes](docs/img/pacientes.png) | ![Reportes](docs/img/reportes.png) |

> Guarda tus capturas en `docs/img/` con esos nombres, o ajusta las rutas.

## Tecnologías

| Capa | Tecnología |
|---|---|
| Backend | PHP 8.1+ con PDO |
| Base de datos | MySQL 5.7+ / MariaDB 10.4+ |
| Frontend | HTML5, CSS3 y JavaScript (tema oscuro, diseño responsive) |
| Servidor local | Apache (XAMPP) |

## Requisitos

- XAMPP (Apache + MySQL) o un entorno equivalente.
- PHP 8.1 o superior con las extensiones `PDO` y `pdo_mysql` habilitadas.
- MySQL 5.7+ o MariaDB 10.4+.
- Navegador actualizado (Chrome, Edge, Firefox o Safari).

## Instalación

### 1. Copiar el proyecto

Descomprime la carpeta `sonrisa_perfecta` en el directorio público de Apache:

```
C:\xampp\htdocs\sonrisa_perfecta
```

### 2. Iniciar los servicios

Abre el Panel de Control de XAMPP y activa **Apache** y **MySQL**.

### 3. Importar la base de datos

1. Abre `http://localhost/phpmyadmin`.
2. Ve a la pestaña **Importar**.
3. Selecciona el archivo `database/sonrisa_perfecta.sql` y pulsa **Importar**.

### 4. Configurar la conexión

Revisa `config/database.php`. Los valores por defecto de XAMPP son:

```php
host     = 127.0.0.1
dbname   = sonrisa_perfecta
user     = root
password = (vacía)
```

### 5. Crear el primer usuario

Entra a `http://localhost/sonrisa_perfecta/register.php` y registra una cuenta.

### 6. Iniciar sesión

Accede desde `http://localhost/sonrisa_perfecta/login.php`.

## Estructura del proyecto

```
sonrisa_perfecta/
├── config/
│   └── database.php        # Conexión PDO
├── database/
│   └── sonrisa_perfecta.sql
├── docs/
│   └── img/                # Capturas para este README
├── login.php
├── register.php
└── README.md
```

> Ajusta este árbol para que refleje las carpetas reales del proyecto (módulos, assets, includes, etc.).

## Módulos

| Módulo | Funciones |
|---|---|
| Acceso | Inicio de sesión, registro y cierre de sesión |
| Dashboard | Indicadores, próximas citas y pacientes recientes |
| Pacientes | Alta, consulta, edición y eliminación |
| Odontólogos | Alta, consulta, edición y eliminación |
| Citas | Alta, consulta, edición y eliminación |
| Diagnósticos | Alta, consulta, edición y eliminación |
| Tratamientos | Alta, consulta, edición y eliminación |
| Servicios | Alta, consulta, edición y eliminación |
| Pagos | Registro por efectivo, tarjeta de crédito, tarjeta de débito o Yape |
| Reportes | Ingresos mensuales, atenciones y citas pendientes, con opción de imprimir |

Todas las tablas incluyen búsqueda rápida.

## Seguridad

| Riesgo | Medida aplicada |
|---|---|
| Inyección SQL | Consultas preparadas con PDO |
| Almacenamiento de contraseñas | `password_hash()` y `password_verify()` |
| CSRF | Token en todos los formularios POST |
| XSS | Escape de salida con `htmlspecialchars()` |
| Secuestro de sesión | Regeneración del ID de sesión al iniciar sesión |

## Solución de problemas

**Apache no inicia (puerto 80 ocupado).**
Otro programa (Skype, IIS, etc.) está usando el puerto. Ciérralo o cambia el puerto en `httpd.conf`, y accede con `http://localhost:8080/sonrisa_perfecta/`.

**MySQL no inicia (puerto 3306 ocupado).**
Es probable que haya otra instancia de MySQL en ejecución. Deténla o cambia el puerto en `my.ini` y en `config/database.php`.

**Error "could not find driver".**
Activa `extension=pdo_mysql` en `php.ini` y reinicia Apache.

**Error de conexión a la base de datos.**
Comprueba que MySQL esté activo, que la base `sonrisa_perfecta` exista y que las credenciales de `config/database.php` sean correctas.

**La importación del SQL falla o se corta.**
Aumenta `upload_max_filesize` y `post_max_size` en `php.ini`, o importa el archivo desde la consola con `mysql -u root < database/sonrisa_perfecta.sql`.

**No puedo eliminar un registro.**
Las claves foráneas lo impiden si existen datos relacionados (por ejemplo, un paciente con citas). Elimina primero los registros dependientes.

## Limitaciones y hoja de ruta

Este proyecto es una base funcional con fines académicos y **no debe usarse con datos reales de pacientes** sin completar, como mínimo:

- [ ] Permisos por rol en cada módulo.
- [ ] Registro de auditoría de acciones.
- [ ] Copias de seguridad automatizadas.
- [ ] Validación de solapamiento de citas.
- [ ] Política de privacidad y cumplimiento de la normativa de protección de datos personales.
- [ ] Módulo de administración de usuarios.

**Sobre los roles:** el registro público crea usuarios con rol `recepcion`. Para crear un administrador, cambia el rol directamente en phpMyAdmin (tabla de usuarios) hasta que exista un módulo de gestión.

## Licencia y autoría

- **Autor:** _tu nombre_
- **Institución / curso:** _opcional_
- **Licencia:** _MIT, o indica la que corresponda_
