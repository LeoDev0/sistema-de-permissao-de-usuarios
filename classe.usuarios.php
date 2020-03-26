<?php

class Usuario {

  protected $pdo;
  protected $id;
  protected $permissoes;

  public function __construct($pdo) {
    $this->pdo = $pdo;
  }

  public function fazerLogin($email, $senha) {
    $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':senha', $senha);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      $dados = $sql->fetch();
      $_SESSION['id'] = $dados['id'];
      return true;
    } else {
      return false;
    }
  }

  public function setUsuario($id) {
    $this->id = $id;

    $sql = "SELECT permissoes FROM usuarios WHERE id = :id";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();
    $sql = $sql->fetch();
    return $this->permissoes = explode(',', $sql['permissoes']);
  }
  
  public function getDados() {
    $sql = "SELECT * FROM usuarios WHERE id = :id";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':id', $this->id);
    $sql->execute();
    return $sql->fetch();
  }

  public function checkPermissao($perm) {
    return (in_array($perm, $this->permissoes)) ? true : false;
  }

}

class Admin extends Usuario {

  public function getAllUsers() {
    $sql = "SELECT id, email, permissoes FROM usuarios";
    $sql = $this->pdo->query($sql);

    if ($sql->rowCount() > 0) {
      return $sql->fetchAll();
    }
  }

  // public function editPermissions($id) {

  // }
}