<?php
require_once __DIR__ . '/../config/app.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = $_POST['action'] ?? '';
    if ($action === 'login') {
        $username = trim((string)($_POST['username'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        $stmt = db()->prepare("SELECT id, full_name, username, password_hash, role FROM users WHERE username = ? AND active = 1 LIMIT 1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = ['id'=>$user['id'], 'name'=>$user['full_name'], 'username'=>$user['username'], 'role'=>$user['role']];
            flash('success', 'Bienvenido/a, ' . $user['full_name'] . '.');
            redirect('index.php');
        }
        flash('error', 'Usuario o contraseña incorrectos.');
        redirect('login.php');
    }
    if ($action === 'register') {
        $name = trim((string)($_POST['full_name'] ?? ''));
        $username = trim((string)($_POST['username'] ?? ''));
        $password = (string)($_POST['password'] ?? '');
        if ($name === '' || $username === '' || strlen($password) < 8) {
            flash('error', 'Completa los campos. La contraseña debe tener al menos 8 caracteres.');
            redirect('register.php');
        }
        try {
            $stmt = db()->prepare("INSERT INTO users (full_name, username, password_hash, role) VALUES (?, ?, ?, 'recepcion')");
            $stmt->execute([$name, $username, password_hash($password, PASSWORD_DEFAULT)]);
            flash('success', 'Cuenta creada. Ya puedes iniciar sesión.');
            redirect('login.php');
        } catch (PDOException $ex) {
            flash('error', 'No se pudo crear la cuenta. Verifica que el usuario no exista.');
            redirect('register.php');
        }
    }
}
