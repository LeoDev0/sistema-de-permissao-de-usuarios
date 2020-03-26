<?php

class Documentos {
  private $pdo;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function getDocs() {
    $sql = "SELECT * FROM documentos";
    $sql = $this->pdo->query($sql);
    
    if ($sql->rowCount() > 0) {
      $docs = $sql->fetchAll();
      return $docs;
    }
  }

  public function getSingleDoc($docId) {
    $sql = "SELECT * FROM documentos WHERE id = :docId";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':docId', $docId);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $doc = $sql->fetch();
      return $doc;
    }
  }

  public function addDoc($titulo) {
    $sql = "INSERT INTO documentos (titulo) VALUES (:titulo)";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':titulo', $titulo);
    $sql->execute();
  }

  public function delDoc($idTitulo) {
    $sql = "DELETE FROM documentos WHERE id = :idTitulo";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':idTitulo', $idTitulo);
    $sql->execute();

    header('Location: index.php');
  }

  public function editDoc($novoTitulo, $idTitulo) {
    $sql = "UPDATE documentos SET titulo = :novoTitulo WHERE id = :idTitulo";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':novoTitulo', $novoTitulo);
    $sql->bindValue(':idTitulo', $idTitulo);
    $sql->execute();

    header('Location: index.php');
  }

}