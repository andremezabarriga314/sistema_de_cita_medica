<?php
$pageTitle = $pageTitle ?? 'Panel principal';
$section = $section ?? 'dashboard';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?> | Sonrisa Perfecta</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="app-shell">
<aside class="sidebar" id="sidebar">
  <a class="brand" href="index.php"><span class="brand-mark">✦</span><span>SONRISA<span class="brand-light"> PERFECTA</span><small>CLÍNICA ODONTOLÓGICA</small></span></a>
  <div class="side-label">MENÚ PRINCIPAL</div>
  <nav class="side-nav">
    <a class="<?=nav_active('dashboard',$section)?>" href="index.php"><span>▦</span> Dashboard</a>
    <a class="<?=nav_active('patients',$section)?>" href="index.php?page=patients"><span>♙</span> Pacientes</a>
    <a class="<?=nav_active('dentists',$section)?>" href="index.php?page=dentists"><span>⚕</span> Odontólogos</a>
    <a class="<?=nav_active('appointments',$section)?>" href="index.php?page=appointments"><span>▣</span> Citas médicas</a>
    <a class="<?=nav_active('diagnoses',$section)?>" href="index.php?page=diagnoses"><span>⌕</span> Diagnósticos</a>
    <a class="<?=nav_active('treatments',$section)?>" href="index.php?page=treatments"><span>✚</span> Tratamientos</a>
    <a class="<?=nav_active('services',$section)?>" href="index.php?page=services"><span>◇</span> Servicios</a>
    <a class="<?=nav_active('payments',$section)?>" href="index.php?page=payments"><span>＄</span> Pagos</a>
  </nav>
  <div class="side-label side-label-bottom">ANÁLISIS</div>
  <nav class="side-nav"><a class="<?=nav_active('reports',$section)?>" href="index.php?page=reports"><span>▤</span> Reportes</a></nav>
  <div class="sidebar-bottom"><div class="online-dot"></div><span>Sistema operativo</span><a href="logout.php" title="Cerrar sesión">↗</a></div>
</aside>
<main class="main-area">
<header class="topbar">
  <div class="topbar-left"><button class="menu-toggle" onclick="document.getElementById('sidebar').classList.toggle('open')">☰</button><div><div class="eyebrow">CLÍNICA / <?=e(strtoupper($pageTitle))?></div><div class="topbar-title"><?=e($pageTitle)?></div></div></div>
  <div class="top-actions"><span class="today"><?=date('d/m/Y')?></span><div class="user-chip"><span class="avatar"><?=e(mb_strtoupper(mb_substr(current_user()['name'] ?? 'U',0,1)))?></span><span><b><?=e(current_user()['name'] ?? 'Usuario')?></b><small><?=e(ucfirst(current_user()['role'] ?? ''))?></small></span></div><a class="logout-link" href="logout.php" title="Cerrar sesión">⏻</a></div>
</header>
<div class="content">
<?php if ($flash): ?><div class="alert <?=e($flash['type'])?>"><?=e($flash['message'])?></div><?php endif; ?>
