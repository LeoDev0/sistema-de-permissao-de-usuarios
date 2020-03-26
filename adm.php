<?php
session_start();
require 'config.php';
include 'classe.usuarios.php';

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  $id = $_SESSION['id'];

  $usuario = new Usuario($pdo);
  $usuario->setUsuario($id);
  if ($usuario->checkPermissao('SECRET')) {
    $adm = new Admin($pdo);
    $funcionarios = $adm->getAllUsers();
  } else {
    header('Location: index.php');
    exit;
  }

} else {
  header('Location: index.php');
  exit;
}
?>

<a href="index.php">Voltar</a>

<h1>Funcionários</h1>

<table border="1" width="80%">
  <tr>
    <th>ID</th>
    <th>Email</th>
    <th>Permissões</th>
  </tr>
  <?php foreach ($funcionarios as $funcionario): ?>
  <?php if ($id != $funcionario['id']): ?>  <!-- checa se é o id do próprio admin e omite ele da lista -->
  <tr>
    <td><?= $funcionario['id'] ?></td>
    <td> <?= $funcionario['email'] ?> </td>
    <td> <?= $funcionario['permissoes'] ?> </td>
  </tr>
  <?php endif; ?>
  <?php endforeach; ?>

</table>