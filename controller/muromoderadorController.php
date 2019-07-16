<?php

class muromoderadorController extends ControladorBase{
    public $conectar;
	public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }



    public function index(){

        Session_Start() ;
    
        if(isset($_SESSION['nickname_MOD'])){
          $UsuarioNick= $_SESSION['nickname_MOD'];
         }else{
          $this->redirect("login","index");
         }

      $this->renderViewParam("moderador",array(

        "UsuarioNick"=>$UsuarioNick

      ));



    }

    public function CerrarSecion(){
        $cerrar=$_POST['cerrar'];
        if(isset($cerrar)){
          Session_Start();
        Session_destroy();

        $this->redirect("login","index");
        }
       

    }
}