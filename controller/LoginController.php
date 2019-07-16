<?php
class LoginController extends ControladorBase{
    public $conectar;
	public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }


    public function index(){
			
        $this->renderView("login");
    }
   

    public function validarLogin(){
     $errorNickName=null; 
     $errorContraseña=null;   
     $nickname = $_POST['nickname'];
     $contraseña = $_POST['contrasena'];
     if(trim($nickname) == false){
          $errorNickName='*ingrese un nickname';
     }
     if(trim($contraseña) == false){
        $errorContraseña='*ingrese una contraseña';
   }

  if(trim($nickname) != false && trim($contraseña) != false){
     
    $user = new Usuario($this->adapter);
    $user->setNickname($nickname);
    


    $filasUsuario=$user->ValidarUsario('usuario');
    $filasModerador=$user->ValidarUsario('moderador');
   
    if($filasUsuario->num_rows>0){
      
        $row=$filasUsuario->fetch_assoc();
        if(password_verify($contraseña,$row['password'])){
            Session_Start();
            $_SESSION['nombre']=$row['nombre'];
            $_SESSION['apellido']=$row['apellido'];
            $_SESSION['id']=$row['id_usuario'];
            $_SESSION['nickname']=$row['nickname'];
            $_SESSION['mail']=$row['mail'];
            $_SESSION['telefono']=$row['telefono'];
            $_SESSION['FechaNacimiento']=$row['FechaNacimiento'];
            $_SESSION['imagen-perfil']=$row['imagen_perfil'];

            $this->redirect("muro","renderPublicacion");
            exit;

        }else{
            $mensaje='*la contraseña o nickname son incorrecto';
            $this->renderViewParam('login',array(
                "mensaje"=>$mensaje
            ));
            exit;
        }
            
        

    }

    if($filasModerador->num_rows>0){

        $rowM=$filasModerador->fetch_assoc();
        if($contraseña===$rowM['password']){
            Session_Start();
            $_SESSION['id-MOD']=$rowM['id_usuario_MOD'];
            $_SESSION['nickname_MOD']=$rowM['nickname'];
            $_SESSION['mail-MOD']=$rowM['email'];

            $this->redirect("muromoderador","index");
            exit;


    }else{
        
        $mensaje='*la contraseña o nickname son incorrecto';
            $this->renderViewParam('login',array(
                "mensaje"=>$mensaje,
                
            ));
            exit;
    }


}
       
     $mensaje='*no se encontro ningun usuario con este nickname';
        $this->renderViewParam('login',array(
            "mensaje"=>$mensaje
        ));



  }else{
    $this->renderViewParam('login',array(
        "errorNickName"=> $errorNickName,
        "errorContraseña"=>$errorContraseña,
        "nickname"=>$nickname
    ));
  }


    }


}
