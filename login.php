<?php
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/includes/auth.php';
if (!empty($_SESSION['user'])) redirect('index.php');
$flash = $_SESSION['flash'] ?? null; unset($_SESSION['flash']);
?>
<!doctype html><html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Iniciar sesión | Sonrisa Perfecta</title><link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet"><link rel="stylesheet" href="assets/css/style.css"></head>
<body class="auth-page"><div class="auth-glow"></div><section class="auth-card"><a class="brand auth-brand" href="#"><span class="brand-mark">✦</span><span>SONRISA<span class="brand-light"> PERFECTA</span><small>CLÍNICA ODONTOLÓGICA</small></span></a><div class="auth-kicker">BIENVENIDO DE NUEVO</div><h1>Inicia sesión</h1><p class="muted">Ingresa tus credenciales para acceder al sistema.</p>
<?php if($flash):?><div class="alert <?=e($flash['type'])?>"><?=e($flash['message'])?></div><?php endif;?>
<form method="post" action="includes/auth.php" class="form-stack"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><input type="hidden" name="action" value="login"><label>Usuario<input name="username" required autocomplete="username" placeholder="Tu usuario"></label><label>Contraseña<input type="password" name="password" required autocomplete="current-password" placeholder="••••••••"></label><button class="btn btn-primary btn-full">Ingresar al sistema <span>→</span></button></form><div class="auth-foot">¿No tienes una cuenta? <a href="register.php">Regístrate</a></div><div class="auth-note">Acceso protegido · Sonrisa Perfecta</div></section></body></html>
