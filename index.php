<?php
require_once __DIR__ . '/config/app.php';
require_login();
$page = $_GET['page'] ?? 'dashboard';
$allowed = ['dashboard','patients','dentists','appointments','diagnoses','treatments','services','payments','reports'];
if (!in_array($page, $allowed, true)) $page = 'dashboard';
$labels = ['dashboard'=>'Panel principal','patients'=>'Pacientes','dentists'=>'Odontólogos','appointments'=>'Citas médicas','diagnoses'=>'Diagnósticos','treatments'=>'Tratamientos','services'=>'Servicios','payments'=>'Pagos','reports'=>'Reportes'];
$pageTitle = $labels[$page]; $section = $page;
require __DIR__ . '/includes/header.php';
if ($page === 'dashboard') {
    $pdo = db();
    $stats = [
      ['Pacientes registrados',(int)$pdo->query("SELECT COUNT(*) FROM patients")->fetchColumn(),'♙','blue'],
      ['Odontólogos activos',(int)$pdo->query("SELECT COUNT(*) FROM dentists WHERE active=1")->fetchColumn(),'⚕','violet'],
      ['Citas de hoy',(int)$pdo->query("SELECT COUNT(*) FROM appointments WHERE appointment_date=CURDATE()")->fetchColumn(),'▣','cyan'],
      ['Ingresos del mes',(float)$pdo->query("SELECT COALESCE(SUM(amount),0) FROM payments WHERE status='Pagado' AND MONTH(payment_date)=MONTH(CURDATE()) AND YEAR(payment_date)=YEAR(CURDATE())")->fetchColumn(),'S/','green'],
    ];
    $upcoming = $pdo->query("SELECT a.id,a.appointment_date,a.appointment_time,a.status,p.full_name patient,d.full_name dentist FROM appointments a JOIN patients p ON p.id=a.patient_id JOIN dentists d ON d.id=a.dentist_id WHERE a.appointment_date>=CURDATE() ORDER BY a.appointment_date,a.appointment_time LIMIT 6")->fetchAll();
    $recent = $pdo->query("SELECT p.id,p.full_name,p.phone,p.created_at FROM patients p ORDER BY p.id DESC LIMIT 5")->fetchAll();
?>
<section class="welcome-banner"><div><div class="eyebrow">RESUMEN GENERAL</div><h1>Hola, <?=e(explode(' ',current_user()['name'])[0])?> <span>✦</span></h1><p>Este es el resumen de actividad de tu clínica.</p><a class="btn btn-primary" href="index.php?page=appointments">＋ Programar una cita</a></div><div class="banner-art"><div class="tooth">✧</div><span class="orbit orbit-one"></span><span class="orbit orbit-two"></span></div></section>
<div class="stats-grid"><?php foreach($stats as $s):?><article class="stat-card"><div class="stat-top"><span><?=e($s[0])?></span><span class="stat-icon <?=$s[3]?>"><?=e($s[2])?></span></div><div class="stat-number"><?=str_starts_with($s[0],'Ingresos')?money($s[1]):number_format($s[1])?></div><div class="stat-caption">Actualizado en tiempo real</div></article><?php endforeach;?></div>
<div class="dashboard-grid"><section class="panel"><div class="panel-head"><div><h2>Próximas citas</h2><p>Agenda de atención más cercana</p></div><a href="index.php?page=appointments" class="text-link">Ver agenda →</a></div><?php if(!$upcoming):?><div class="empty-state">No hay citas próximas registradas.</div><?php else:?><div class="table-wrap"><table><thead><tr><th>Paciente</th><th>Odontólogo</th><th>Fecha y hora</th><th>Estado</th></tr></thead><tbody><?php foreach($upcoming as $a):?><tr><td><b><?=e($a['patient'])?></b></td><td><?=e($a['dentist'])?></td><td><?=date('d/m/Y',strtotime($a['appointment_date']))?> · <?=substr($a['appointment_time'],0,5)?></td><td><span class="status"><?=e($a['status'])?></span></td></tr><?php endforeach;?></tbody></table></div><?php endif;?></section>
<section class="panel"><div class="panel-head"><div><h2>Pacientes recientes</h2><p>Últimos registros ingresados</p></div><a href="index.php?page=patients" class="text-link">Ver todos →</a></div><?php if(!$recent):?><div class="empty-state">Aún no hay pacientes.</div><?php else:?><div class="recent-list"><?php foreach($recent as $r):?><div class="recent-item"><span class="avatar avatar-large"><?=e(mb_strtoupper(mb_substr($r['full_name'],0,1)))?></span><div><b><?=e($r['full_name'])?></b><small><?=e($r['phone'] ?: 'Sin teléfono')?></small></div><span class="recent-date"><?=date('d/m',strtotime($r['created_at']))?></span></div><?php endforeach;?></div><?php endif;?></section></div>
<?php
} elseif ($page === 'reports') {
    $pdo=db();
    $month = $pdo->query("SELECT COALESCE(SUM(amount),0) FROM payments WHERE status='Pagado' AND MONTH(payment_date)=MONTH(CURDATE()) AND YEAR(payment_date)=YEAR(CURDATE())")->fetchColumn();
    $visits = $pdo->query("SELECT COUNT(*) FROM appointments WHERE status='Atendida' AND MONTH(appointment_date)=MONTH(CURDATE()) AND YEAR(appointment_date)=YEAR(CURDATE())")->fetchColumn();
    $pending = $pdo->query("SELECT COUNT(*) FROM appointments WHERE status IN ('Pendiente','Confirmada') AND appointment_date>=CURDATE()")->fetchColumn();
    $byMethod=$pdo->query("SELECT method,COUNT(*) operations,SUM(amount) total FROM payments WHERE status='Pagado' AND MONTH(payment_date)=MONTH(CURDATE()) AND YEAR(payment_date)=YEAR(CURDATE()) GROUP BY method")->fetchAll();
?>
<div class="stats-grid"><article class="stat-card"><div class="stat-top">Ingresos del mes</div><div class="stat-number"><?=money((float)$month)?></div><div class="stat-caption">Pagos confirmados</div></article><article class="stat-card"><div class="stat-top">Atenciones realizadas</div><div class="stat-number"><?=number_format((int)$visits)?></div><div class="stat-caption">Durante el mes actual</div></article><article class="stat-card"><div class="stat-top">Citas pendientes</div><div class="stat-number"><?=number_format((int)$pending)?></div><div class="stat-caption">Pendientes o confirmadas</div></article></div>
<section class="panel"><div class="panel-head"><div><h2>Ingresos por método de pago</h2><p>Resumen del mes actual</p></div><button class="btn btn-outline" onclick="window.print()">Imprimir reporte</button></div><div class="table-wrap"><table><thead><tr><th>Método</th><th>Operaciones</th><th>Ingresos</th></tr></thead><tbody><?php foreach($byMethod as $m):?><tr><td><?=e($m['method'])?></td><td><?=e($m['operations'])?></td><td><b><?=money((float)$m['total'])?></b></td></tr><?php endforeach;?><?php if(!$byMethod):?><tr><td colspan="3" class="empty-state">No hay pagos confirmados este mes.</td></tr><?php endif;?></tbody></table></div></section>
<?php
} else {
    require __DIR__ . '/includes/module.php';
}
require __DIR__ . '/includes/footer.php';
