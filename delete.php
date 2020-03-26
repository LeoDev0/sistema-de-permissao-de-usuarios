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
  if ($usuario->checkPermissao('DELETE')) {
    $documento = new Documentos($pdo);
    $documento->delDoc($idTitulo);
  }
}

header('Location: index.php');