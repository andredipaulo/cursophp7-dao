<?php
    require_once("config.php");

    #$sql = new Sql();
    #$usuarios = $sql->select(" SELECT * FROM tb_usuarios ");
    #echo json_encode($usuarios);

    #$root = new Usuario();
    #carrega um usuario
    # $root->loadById(3);
    #echo $root;

    #carrega a lista de usuario
    #return Usuario::getList();

    #$search = Usuario::search("");
    #echo json_encode($search);

    //carrega um usuario usando um login e senha
    $usuario = new Usuario();

    $usuario->login("joao", "123456");

    echo $usuario;



