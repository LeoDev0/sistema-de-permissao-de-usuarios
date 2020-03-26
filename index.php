<?php
session_start();
require_once 'config.php';
include 'classe.usuarios.php';
include 'classe.documentos.php';

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  $id = $_SESSION['id'];

  $usuario = new Usuario($pdo);
  $usuario->setUsuario($id);
  $dados = $usuario->getDados();

  $documentos = new Documentos($pdo);
  $documentos = $documentos->getDocs();
} else {
  header('Location: login.php');
  exit;
}

?>

<h4>Usuário: <?= $dados['email'] ?> </h4>
<a href="logout.php">Sair</a>

<br><br>

<h1>Documentos</h1>

<?php if ($usuario->checkPermissao('ADD')): ?>
<form method="post">
  <input type="text" name="adicionar" placeholder="Nome do documento">
  <button>Adicionar</button>
</form>
<?php endif; ?>

<?php if ($usuario->checkPermissao('SECRET')): ?>
<a href="adm.php">Acessar página de administrador</a>
<?php endif; ?>
<br><br>

<table border="1" width="100%">

  <tr>
    <th>ID</th>
    <th>Arquivo</th>
    <th>Ações</th>
  </tr>
  
  <?php foreach ($documentos as $doc): ?>
  <tr>
    <td><?= $doc['id'] ?></td>
    <td><?= $doc['titulo'] ?>  </td>
    <td>
      <?php if ($usuario->checkPermissao('DELETE')): ?>
      <a href="delete.php?id=<?= $doc['id'] ?>">EXCLUIR</a>
      <?php endif; ?>
      
      <?php if ($usuario->checkPermissao('EDIT')): ?>
      <a href="edit.php?id=<?= $doc['id'] ?>">EDITAR</a>
      <?php endif; ?>
    </td>
  </tr>
  <?php endforeach; ?>

</table>

<?php

if (isset($_POST['adicionar']) && !empty($_POST['adicionar'])) {
  $newDoc = new Documentos($pdo);
  $newDoc->addDoc($_POST['adicionar']);
  header('Location: index.php');
}