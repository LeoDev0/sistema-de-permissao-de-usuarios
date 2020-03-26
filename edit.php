<?php
session_start();
require_once 'config.php';
include 'classe.usuarios.php';
include 'classe.documentos.php';

$id = $_SESSION['id'];
$idTitulo = $_GET['id'];

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
  $usuario = new Usuario($pdo);
  $usuario->setUsuario($id);
  if ($usuario->checkPermissao('EDIT')) {
    $documento = new Documentos($pdo);
    $tituloAtual = $documento->getSingleDoc($idTitulo)['titulo'];    
  } else {
    header('Location: index.php');
  }
} else {
  header('Location: index.php');
}
?>
<a href="index.php">Voltar</a><br><br>

<form method="post">
  <input type="text" name="editar" placeholder="Nome do documento" value="<?= $tituloAtual ?>">
  <button>Salvar</button>
</form>

<?php

if (isset($_POST['editar']) && !empty($_POST['editar'])) {
  $tituloEditado = $_POST['editar'];
  $editedDoc = new Documentos($pdo);
  $editedDoc->editDoc($tituloEditado, $idTitulo);
}