<?php
$modules = [
'patients'=>['table'=>'patients','title'=>'Pacientes','singular'=>'paciente','fields'=>[
'full_name'=>['Nombre completo','text',true],'document'=>['DNI / documento','text',false],'birth_date'=>['Fecha de nacimiento','date',false],'gender'=>['Género','select',['Masculino','Femenino','Otro']],'phone'=>['Teléfono','text',false],'email'=>['Correo electrónico','email',false],'address'=>['Dirección','text',false],'notes'=>['Observaciones','textarea',false]]],
'dentists'=>['table'=>'dentists','title'=>'Odontólogos','singular'=>'odontólogo','fields'=>[
'full_name'=>['Nombre completo','text',true],'document'=>['DNI / documento','text',false],'specialty'=>['Especialidad','text',true],'phone'=>['Teléfono','text',false],'email'=>['Correo electrónico','email',false],'license_number'=>['N.º de colegiatura','text',false],'active'=>['Estado','select',['1'=>'Activo','0'=>'Inactivo']]]],
'services'=>['table'=>'services','title'=>'Servicios odontológicos','singular'=>'servicio','fields'=>[
'name'=>['Nombre del servicio','text',true],'description'=>['Descripción','textarea',false],'price'=>['Precio (S/)','number',true],'duration_minutes'=>['Duración (minutos)','number',true],'active'=>['Estado','select',['1'=>'Activo','0'=>'Inactivo']]]],
'appointments'=>['table'=>'appointments','title'=>'Citas médicas','singular'=>'cita','fields'=>[
'patient_id'=>['Paciente','lookup_patients',true],'dentist_id'=>['Odontólogo','lookup_dentists',true],'service_id'=>['Servicio','lookup_services',false],'appointment_date'=>['Fecha','date',true],'appointment_time'=>['Hora','time',true],'status'=>['Estado','select',['Pendiente','Confirmada','Atendida','Cancelada']],'reason'=>['Motivo de consulta','textarea',false]]],
'diagnoses'=>['table'=>'diagnoses','title'=>'Diagnósticos','singular'=>'diagnóstico','fields'=>[
'patient_id'=>['Paciente','lookup_patients',true],'dentist_id'=>['Odontólogo','lookup_dentists',true],'appointment_id'=>['Cita relacionada','lookup_appointments',false],'diagnosis_date'=>['Fecha','date',true],'description'=>['Diagnóstico','textarea',true],'observations'=>['Observaciones','textarea',false]]],
'treatments'=>['table'=>'treatments','title'=>'Tratamientos','singular'=>'tratamiento','fields'=>[
'patient_id'=>['Paciente','lookup_patients',true],'dentist_id'=>['Odontólogo','lookup_dentists',true],'service_id'=>['Servicio','lookup_services',false],'diagnosis_id'=>['Diagnóstico relacionado','lookup_diagnoses',false],'treatment_date'=>['Fecha','date',true],'description'=>['Detalle del tratamiento','textarea',true],'cost'=>['Costo (S/)','number',true],'status'=>['Estado','select',['Planificado','En proceso','Completado','Cancelado']]]],
'payments'=>['table'=>'payments','title'=>'Pagos','singular'=>'pago','fields'=>[
'patient_id'=>['Paciente','lookup_patients',true],'appointment_id'=>['Cita relacionada','lookup_appointments',false],'payment_date'=>['Fecha de pago','date',true],'amount'=>['Monto (S/)','number',true],'method'=>['Método de pago','select',['Efectivo','Tarjeta de crédito','Tarjeta de débito','Yape']],'status'=>['Estado','select',['Pagado','Pendiente','Anulado']],'reference'=>['N.º de operación / referencia','text',false]]]
];
$cfg=$modules[$page]; $table=$cfg['table']; $editId=(int)($_GET['edit']??0); $editing=null;
if ($editId) { $st=db()->prepare("SELECT * FROM `$table` WHERE id=?");$st->execute([$editId]);$editing=$st->fetch(); }
$lookups = [
'lookup_patients'=>['patients','full_name'],'lookup_dentists'=>['dentists','full_name'],'lookup_services'=>['services','name'],'lookup_appointments'=>['appointments','id'],'lookup_diagnoses'=>['diagnoses','id']
];
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['module_action'])) {
    verify_csrf(); $action=$_POST['module_action']; $id=(int)($_POST['id']??0);
    if ($action==='delete') {
        $st=db()->prepare("DELETE FROM `$table` WHERE id=?");$st->execute([$id]);flash('success','Registro eliminado correctamente.');redirect("index.php?page=$page");
    }
    $columns=[];$values=[];
    foreach($cfg['fields'] as $key=>$field) {
        $val=$_POST[$key]??null;
        if ($val==='') $val=null;
        if ($key==='active') $val=($val==='Activo' || $val==='1') ? 1 : 0;
        if ($field[1]==='number' && $val!==null) $val=(float)$val;
        if ($field[2]===true && ($val===null || $val==='')) { flash('error','Completa los campos obligatorios.');redirect("index.php?page=$page".($id?"&edit=$id":'')); }
        $columns[]=$key;$values[]=$val;
    }
    if ($id) {
        $sets=implode(',',array_map(fn($c)=>"`$c`=?", $columns));
        $values[]=$id;$st=db()->prepare("UPDATE `$table` SET $sets WHERE id=?");$st->execute($values);
        flash('success','Registro actualizado correctamente.');
    } else {
        $cols=implode(',',array_map(fn($c)=>"`$c`",$columns));$marks=implode(',',array_fill(0,count($columns),'?'));
        $st=db()->prepare("INSERT INTO `$table` ($cols) VALUES ($marks)");$st->execute($values);
        flash('success','Registro creado correctamente.');
    }
    redirect("index.php?page=$page");
}
$rows=db()->query("SELECT * FROM `$table` ORDER BY id DESC LIMIT 200")->fetchAll();
$display = [
'patients'=>['full_name'=>'Nombre','document'=>'Documento','phone'=>'Teléfono','email'=>'Correo','created_at'=>'Registro'],
'dentists'=>['full_name'=>'Nombre','specialty'=>'Especialidad','phone'=>'Teléfono','license_number'=>'Colegiatura','active'=>'Estado'],
'services'=>['name'=>'Servicio','price'=>'Precio','duration_minutes'=>'Duración','active'=>'Estado'],
'appointments'=>['patient_id'=>'Paciente','dentist_id'=>'Odontólogo','appointment_date'=>'Fecha','appointment_time'=>'Hora','status'=>'Estado'],
'diagnoses'=>['patient_id'=>'Paciente','dentist_id'=>'Odontólogo','diagnosis_date'=>'Fecha','description'=>'Diagnóstico'],
'treatments'=>['patient_id'=>'Paciente','dentist_id'=>'Odontólogo','treatment_date'=>'Fecha','cost'=>'Costo','status'=>'Estado'],
'payments'=>['patient_id'=>'Paciente','payment_date'=>'Fecha','amount'=>'Monto','method'=>'Método','status'=>'Estado']
][$page];
$relationTables=['patient_id'=>['patients','full_name'],'dentist_id'=>['dentists','full_name']];
function display_value(string $key,mixed $value,array $relations): string {
    if (isset($relations[$key]) && $value) { [$t,$c]=$relations[$key];$s=db()->prepare("SELECT `$c` FROM `$t` WHERE id=?");$s->execute([$value]);return e($s->fetchColumn() ?: '—');}
    if (in_array($key,['price','cost','amount'],true)) return e(money((float)$value));
    if ($key==='active') return (int)$value===1?'Activo':'Inactivo';
    if ($key==='appointment_time') return e(substr((string)$value,0,5));
    if (in_array($key,['appointment_date','diagnosis_date','treatment_date','payment_date','created_at'],true) && $value) return e(date('d/m/Y',strtotime((string)$value)));
    return e($value);
}
?>
<div class="module-toolbar"><div><div class="eyebrow">GESTIÓN DE INFORMACIÓN</div><h1><?=e($cfg['title'])?></h1><p>Administra y mantén actualizada la información de la clínica.</p></div><button class="btn btn-primary" onclick="document.getElementById('record-form').scrollIntoView({behavior:'smooth'})">＋ Nuevo <?=e($cfg['singular'])?></button></div>
<div class="module-layout"><section class="panel table-panel"><div class="panel-head"><div><h2>Listado de registros</h2><p><?=count($rows)?> registros · Máximo 200 visibles</p></div><input class="search-input" placeholder="Buscar en la tabla..." data-table-search></div><div class="table-wrap"><table class="data-table"><thead><tr><?php foreach($display as $label):?><th><?=e($label)?></th><?php endforeach;?><th>Acciones</th></tr></thead><tbody><?php foreach($rows as $row):?><tr><?php foreach($display as $key=>$label):?><td><?=display_value($key,$row[$key]??null,$relationTables)?></td><?php endforeach;?><td class="actions"><a class="action-edit" href="index.php?page=<?=$page?>&edit=<?=$row['id']?>">Editar</a><form method="post" onsubmit="return confirm('¿Eliminar este registro?')"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><input type="hidden" name="module_action" value="delete"><input type="hidden" name="id" value="<?=$row['id']?>"><button class="action-delete">Eliminar</button></form></td></tr><?php endforeach;?><?php if(!$rows):?><tr><td colspan="<?=count($display)+1?>" class="empty-state">No hay registros todavía. Utiliza el formulario para agregar el primero.</td></tr><?php endif;?></tbody></table></div></section>
<section class="panel form-panel" id="record-form"><div class="panel-head"><div><h2><?=$editing?'Editar':'Nuevo'?> <?=e($cfg['singular'])?></h2><p>Los campos con * son obligatorios</p></div></div><form method="post" class="form-grid"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><input type="hidden" name="module_action" value="save"><input type="hidden" name="id" value="<?=e($editing['id']??0)?>">
<?php foreach($cfg['fields'] as $key=>$field):[$label,$type,$required]=$field;$value=$editing[$key]??'';if($key==='active' && $editing) $value=((int)$value===1?'Activo':'Inactivo');$wide=in_array($type,['textarea'],true)?'wide':'';?>
<label class="<?=$wide?>"><?=e($label)?><?=$required?' *':''?>
<?php if($type==='textarea'):?><textarea name="<?=e($key)?>" <?=$required?'required':''?> rows="3"><?=e($value)?></textarea>
<?php elseif($type==='select'):?><select name="<?=e($key)?>" <?=$required?'required':''?>><option value="">Seleccionar...</option><?php foreach($field[2] as $v=>$text):if(is_int($v)){$v=$text;}?><option value="<?=e($v)?>" <?=((string)$value===(string)$v)?'selected':''?>><?=e($text)?></option><?php endforeach;?></select>
<?php elseif(isset($lookups[$type])):?><?php [$lt,$lc]=$lookups[$type];$opts=db()->query("SELECT id,`$lc` label FROM `$lt` ORDER BY id DESC")->fetchAll();?><select name="<?=e($key)?>" <?=$required?'required':''?>><option value="">Seleccionar...</option><?php foreach($opts as $o):?><option value="<?=$o['id']?>" <?=((string)$value===(string)$o['id'])?'selected':''?>><?=e($lt==='appointments'?'Cita #'.$o['id']:($lt==='diagnoses'?'Diagnóstico #'.$o['id']:$o['label']))?></option><?php endforeach;?></select>
<?php else:?><input type="<?=e($type)?>" name="<?=e($key)?>" value="<?=e($value)?>" <?=$required?'required':''?> <?=$type==='number'?'min="0" step="0.01"':''?>>
<?php endif;?></label><?php endforeach;?>
<div class="form-actions wide"><button class="btn btn-primary"><?=$editing?'Guardar cambios':'Guardar registro'?></button><?php if($editing):?><a class="btn btn-outline" href="index.php?page=<?=$page?>">Cancelar</a><?php endif;?></div></form></section></div>
