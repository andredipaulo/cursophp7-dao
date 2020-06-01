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
    #$usuario = new Usuario();
    #$usuario->login("root", "123456");
    #echo $usuario;

    /*
    //Criando um novo usuario
    $aluno = new Usuario();
    //foi para po __constructor
    //$aluno->setDeslogin("aluno");
    //$aluno->setDessenha("aluno");

    $aluno->insert();

    echo $aluno;
    */
    /*
    //Alterar um usuario
    $usuario = new Usuario();
    $usuario->loadById(17);
    $usuario->update("professor", "professor");

    echo $usuario;
    */

    $usuario = new Usuario();
    $usuario->loadById(18);
    $usuario->delete();
    echo $usuario;
