<div align="center">

<img src="docs/banner.svg" alt="Sonrisa Perfecta" width="100%">

<a href="https://github.com/tu-usuario/sonrisa_perfecta">
<img src="https://readme-typing-svg.demolab.com?font=Fira+Code&weight=600&size=20&pause=1200&color=22D3EE&center=true&vCenter=true&width=620&lines=Gestiona+pacientes+y+citas;Controla+tratamientos+y+pagos;Reportes+mensuales+listos+para+imprimir;Interfaz+oscura+y+100%25+responsive" alt="Typing SVG">
</a>

<br>

![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-Ready-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)
![Seguridad](https://img.shields.io/badge/CSRF%20%7C%20PDO%20%7C%20Hash-34D399?style=for-the-badge)

[**Instalación**](#-instalación-rápida) &nbsp;•&nbsp;
[**Módulos**](#-módulos) &nbsp;•&nbsp;
[**Seguridad**](#-seguridad) &nbsp;•&nbsp;
[**Soporte**](#-solución-de-problemas) &nbsp;•&nbsp;
[**Roadmap**](#-roadmap)

</div>

<br>

## 🦷 ¿Qué es Sonrisa Perfecta?

Aplicación web en **PHP + MySQL** que centraliza la operación diaria de un consultorio odontológico: pacientes, odontólogos, citas, diagnósticos, tratamientos, servicios y pagos, con autenticación y una interfaz oscura que se adapta a escritorio, tablet y móvil.

<table>
<tr>
<td align="center" width="25%"><h3>10</h3>módulos integrados</td>
<td align="center" width="25%"><h3>4</h3>métodos de pago</td>
<td align="center" width="25%"><h3>5</h3>capas de seguridad</td>
<td align="center" width="25%"><h3>100%</h3>responsive</td>
</tr>
</table>

## 📸 Vista previa

<div align="center">

| Login | Dashboard |
|:---:|:---:|
| <img src="docs/img/login.png" width="420"> | <img src="docs/img/dashboard.png" width="420"> |
| **Pacientes** | **Reportes** |
| <img src="docs/img/pacientes.png" width="420"> | <img src="docs/img/reportes.png" width="420"> |

</div>

> 💡 Guarda tus capturas en `docs/img/`. Para un efecto animado, graba un GIF del sistema y reemplaza una de las imágenes.

## 🚀 Instalación rápida

```text
📦 Requisitos:  XAMPP (Apache + MySQL) · PHP 8.1+ con PDO y pdo_mysql · Navegador actualizado
```

<table>
<tr><td width="60" align="center"><h2>1</h2></td><td><b>Copia el proyecto</b><br>Descomprime <code>sonrisa_perfecta</code> en <code>C:\xampp\htdocs\</code></td></tr>
<tr><td align="center"><h2>2</h2></td><td><b>Inicia los servicios</b><br>Activa <b>Apache</b> y <b>MySQL</b> en el panel de XAMPP.</td></tr>
<tr><td align="center"><h2>3</h2></td><td><b>Importa la base de datos</b><br><code>localhost/phpmyadmin</code> → <i>Importar</i> → <code>database/sonrisa_perfecta.sql</code></td></tr>
<tr><td align="center"><h2>4</h2></td><td><b>Verifica la conexión</b><br>Revisa <code>config/database.php</code></td></tr>
<tr><td align="center"><h2>5</h2></td><td><b>Crea el primer usuario</b><br><code>http://localhost/sonrisa_perfecta/register.php</code></td></tr>
<tr><td align="center"><h2>6</h2></td><td><b>Inicia sesión</b><br><code>http://localhost/sonrisa_perfecta/login.php</code></td></tr>
</table>

<details>
<summary><b>⚙️ Valores de conexión por defecto en XAMPP</b></summary>

<br>

```php
host     = 127.0.0.1
dbname   = sonrisa_perfecta
user     = root
password = (vacía)
```

</details>

## 🧩 Módulos

<table>
<tr>
<td width="33%" valign="top">

### 🧑‍🤝‍🧑 Pacientes
Altas, consulta, edición y eliminación.

### 🩺 Odontólogos
Gestión del equipo profesional.

### 📅 Citas
Agenda y próximas citas en el dashboard.

</td>
<td width="33%" valign="top">

### 📝 Diagnósticos
Registro clínico por paciente.

### 🦷 Tratamientos
Seguimiento de procedimientos.

### 🧾 Servicios
Catálogo de servicios ofrecidos.

</td>
<td width="33%" valign="top">

### 💰 Pagos
💵 Efectivo · 💳 Crédito · 💳 Débito · 📲 Yape

### 📊 Reportes
Ingresos mensuales, atenciones y citas pendientes, con impresión.

### 🔐 Acceso
Login, registro y cierre de sesión.

</td>
</tr>
</table>

✨ **Extras:** búsqueda rápida en todas las tablas · diseño adaptable · reportes imprimibles.

## 🔒 Seguridad

| | Riesgo | Medida aplicada |
|:---:|---|---|
| 🛡️ | Inyección SQL | PDO con consultas preparadas |
| 🔑 | Contraseñas | `password_hash()` y `password_verify()` |
| 🎟️ | CSRF | Token en todos los formularios POST |
| 🧼 | XSS | Escape con `htmlspecialchars()` |
| 🪪 | Sesiones | Regeneración del ID al iniciar sesión |

## 🛠️ Solución de problemas

<details>
<summary><b>Apache no inicia (puerto 80 ocupado)</b></summary>
<br>
Cierra el programa que usa el puerto (Skype, IIS…) o cambia el puerto en <code>httpd.conf</code> y entra por <code>localhost:8080</code>.
</details>

<details>
<summary><b>MySQL no inicia (puerto 3306 ocupado)</b></summary>
<br>
Detén otras instancias de MySQL o cambia el puerto en <code>my.ini</code> y en <code>config/database.php</code>.
</details>

<details>
<summary><b>Error "could not find driver"</b></summary>
<br>
Activa <code>extension=pdo_mysql</code> en <code>php.ini</code> y reinicia Apache.
</details>

<details>
<summary><b>La importación del SQL falla</b></summary>
<br>
Aumenta <code>upload_max_filesize</code> y <code>post_max_size</code>, o importa por consola: <code>mysql -u root &lt; database/sonrisa_perfecta.sql</code>.
</details>

<details>
<summary><b>No puedo eliminar un registro</b></summary>
<br>
Las claves foráneas lo bloquean si hay datos relacionados. Elimina primero los registros dependientes.
</details>

## 🗺️ Roadmap

- [ ] Permisos por rol en cada módulo
- [ ] Auditoría de acciones
- [ ] Copias de seguridad automatizadas
- [ ] Validación de solapamiento de citas
- [ ] Políticas de privacidad y protección de datos
- [ ] Módulo de administración de usuarios

> [!WARNING]
> Proyecto **académico**. No lo uses con datos reales de pacientes sin completar los puntos anteriores.

> [!NOTE]
> El registro público crea usuarios con rol `recepcion`. Para crear un administrador, cambia el rol directamente en phpMyAdmin.

<br>

<div align="center">

**Hecho con 🦷 y ☕ · Proyecto académico**

<sub>Autor: _tu nombre_ · Licencia: _MIT_</sub>

</div>
