<?php
require_once 'config.php';
include 'classe.usuarios.php';
session_start();

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  header('Location: index.php');
  exit;
}

if (isset($_POST['email']) && !empty($_POST['senha'])) {
  $email = $_POST['email'];
  $senha = md5($_POST['senha']);

  $usuario = new Usuario($pdo);

  if ($usuario->fazerLogin($email, $senha)) {
    header('Location: index.php');
    exit;
    
  } else {
    echo '<script language="javascript">';
    echo 'alert("Credenciais incorretas")';
    echo '</script>';
  }
}

?>

<form method="post">
  <label for="email">Email:</label><br>
  <input type="email" name="email"><br>
  <label for="senha">Senha:</label><br>
  <input type="password" name="senha"><br><br>
  <button>Entrar</button>
</form>