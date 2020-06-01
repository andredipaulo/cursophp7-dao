<?php

class Usuario{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public  function getIdusuario(){
        return $this->idusuario;
    }

    public  function setIdusuario($value){
        $this->idusuario = $value;
    }

    public  function getDeslogin(){
        return $this->deslogin;
    }

    public  function setDeslogin($value){
        $this->deslogin = $value;
    }

    public  function getDessenha(){
        return $this->dessenha;
    }

    public  function setDessenha($value){
        $this->dessenha = $value;
    }

    public  function getDtcadastro(){
        return $this->dtcadastro;
    }

    public  function setDtcadastro($value){
        $this->dtcadastro = $value;
    }

    public function loadById($id){

        $sql = new Sql();

        $resultado = $sql ->select(" select * from tb_usuarios where idusuario=:id", array(
            ":id"=>$id
        ));

        if (isset($resultado)){

            //$row = $resultado[0];

            $this->setData($resultado[0]);

        }
    }
    // Método mágico
    public function __toString()
    {
        // TODO: Implement __toString() method.
        return json_encode( array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
        ));
    }

    public static function getList(){

        $sql = new Sql();
        return $sql->select("select * from tb_usuarios order by deslogin");

    }

    public static function search($login){

        $sql = new Sql();

        return $sql->select(" select * from tb_usuarios where deslogin like :search order by deslogin", array(
            ':search'=>"%".$login."%",
        ));
    }

    public function login($login, $password){

        $sql = new Sql();

        $results = $sql->select(" select * from tb_usuarios where deslogin =:login and dessenha=:password", array(
            ':login'=>$login,
            ':password'=>$password
        ));

        if(count($results)>0){
            /*
            $row = $results[0];

            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new Datetime ($row['dtcadastro']));
            */

            $this->setData($results[0]);

        }else{
            throw new Exception("Login e/ou senha invalidos");
        }


    }

    public function setData($data){

        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new Datetime ($data['dtcadastro']));

    }

    public function insert(){

        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:login, :password)", array(
            ':login'=>$this->getDeslogin(),
            ':password'=>$this->getDessenha()
        ));

        if(count($results)>0){
            $this->setData($results[0]);
        }


    }

    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();
        $sql->query("update tb_usuarios set deslogin=:login, dessenha=:password where idusuario=:id", array(
           ':login'=>$this->getDeslogin(),
           ':password'=>$this->getDessenha(),
           ':id'=>$this->getIdusuario()
        ));
    }

    public function delete(){
        $sql = new Sql();
        $sql->query(" delete from tb_usuarios where idusuario=:id", array(
           ':id'=>$this->getIdusuario()
        ));

        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDtcadastro(new DateTime());

    }

    public function __construct($login="", $password="") {
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }
}