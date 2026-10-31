<div align="center">

<img src="https://capsule-render.vercel.app/api?type=waving&height=260&color=0:22d3ee,100:6366f1&text=Sonrisa%20Perfecta&fontSize=60&fontColor=ffffff&fontAlignY=38&desc=Sistema%20de%20gesti%C3%B3n%20odontol%C3%B3gica&descAlignY=58&descSize=20&animation=fadeIn" alt="Sonrisa Perfecta" width="100%">

<img src="https://readme-typing-svg.demolab.com?font=Fira+Code&weight=600&size=20&pause=1200&color=22D3EE&center=true&vCenter=true&width=640&lines=Gestiona+pacientes+y+citas;Controla+tratamientos+y+pagos;Reportes+mensuales+listos+para+imprimir;Interfaz+oscura+y+100%25+responsive" alt="Typing SVG">

<br><br>

![PHP](https://img.shields.io/badge/PHP-8.1%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-5.7%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-Ready-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)
![Responsive](https://img.shields.io/badge/Dise%C3%B1o-Responsive-34D399?style=for-the-badge)
![Estado](https://img.shields.io/badge/Uso-Acad%C3%A9mico-6366F1?style=for-the-badge)

<br>

[**Instalación**](#-instalación-rápida) &nbsp;•&nbsp;
[**Módulos**](#-módulos) &nbsp;•&nbsp;
[**Seguridad**](#-seguridad) &nbsp;•&nbsp;
[**Soporte**](#️-solución-de-problemas) &nbsp;•&nbsp;
[**Roadmap**](#️-roadmap)

</div>

<br>

## 🦷 ¿Qué es Sonrisa Perfecta?

Aplicación web en **PHP + MySQL** que centraliza la operación diaria de un consultorio odontológico: pacientes, odontólogos, citas, diagnósticos, tratamientos, servicios y pagos, con autenticación y una interfaz oscura que se adapta a escritorio, tablet y móvil.

<div align="center">

<table>
<tr>
<td align="center" width="25%"><h2>10</h2><sub>MÓDULOS</sub></td>
<td align="center" width="25%"><h2>4</h2><sub>MÉTODOS DE PAGO</sub></td>
<td align="center" width="25%"><h2>5</h2><sub>CAPAS DE SEGURIDAD</sub></td>
<td align="center" width="25%"><h2>100%</h2><sub>RESPONSIVE</sub></td>
</tr>
</table>

</div>

## 🧰 Tecnologías

<div align="center">

<img src="https://skillicons.dev/icons?i=php,mysql,html,css,js,apache&theme=dark" alt="Tecnologías">

</div>

## 📸 Vista previa

<div align="center">

<table>
<tr>
<td align="center"><img src="https://placehold.co/520x300/0d1424/22d3ee?text=Login&font=montserrat" width="100%"><br><b>Inicio de sesión</b></td>
<td align="center"><img src="https://placehold.co/520x300/0d1424/6366f1?text=Dashboard&font=montserrat" width="100%"><br><b>Dashboard</b></td>
</tr>
<tr>
<td align="center"><img src="https://placehold.co/520x300/0d1424/34d399?text=Pacientes&font=montserrat" width="100%"><br><b>Gestión de pacientes</b></td>
<td align="center"><img src="https://placehold.co/520x300/0d1424/22d3ee?text=Reportes&font=montserrat" width="100%"><br><b>Reporte mensual</b></td>
</tr>
</table>

</div>

> 💡 Reemplaza cada `src` por el enlace de tu captura (imgur, postimages, etc.).

## 🚀 Instalación rápida

> 📦 **Requisitos:** XAMPP (Apache + MySQL) · PHP 8.1+ con PDO y `pdo_mysql` · MySQL 5.7+ o MariaDB 10.4+ · Navegador actualizado

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

| Parámetro | Valor |
|---|---|
| Host | `127.0.0.1` |
| Base de datos | `sonrisa_perfecta` |
| Usuario | `root` |
| Contraseña | *(vacía)* |

</details>

## 🧩 Módulos

<table>
<tr>
<td width="33%" valign="top">

### 🧑‍🤝‍🧑 Pacientes
Alta, consulta, edición y eliminación.

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
| 🧼 | XSS | Escape de salida con `htmlspecialchars()` |
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

<img src="https://capsule-render.vercel.app/api?type=waving&height=120&color=0:6366f1,100:22d3ee&section=footer" width="100%">
