<?php
class RegistrarUsuarioController extends ControladorBase{
    public $conectar;
	public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

		//Listar todos los Usuarios	
		public function index(){
			
			$this->renderView("registrar");
		}

		
    //Procesa los datos del formulario de inserción
		public function registrarUsuario(){
			
			
			$nombre=$_POST['nombre'];
			$apellido=$_POST['apellido'];
			$nickName=$_POST['nikname'];
			$fechaNacimiento=null;
			$email=$_POST['email'];
			$contraseña=$_POST['contrasena'];
			$contraseñavalidacion=$_POST['repitecontrasena'];
			$telefono=$_POST['telefono'];
			$sexo=null;
			$errorNombre=null;
			$errorApellido=null;
			$errorNikname=null;
			$errorFechaNacimiento=null;
			$errorEmail=null;
			$errorContraseña=null;
			$errorContraseñaRepetida=null;
			$erroContraseñaValidada=null;
			$errorTelefono=null;
			$errorSexo=null;
			$errorUsuario=null;
			
     
		if(trim($nombre)==false || strlen($nombre)>15 ||  !preg_match("/^[a-z ñ.áéíóúäëïöü\'-]*$/",$nombre))
		{
			 $errorNombre='*complete el nombre correctamente';
		}
		if(trim($apellido)==false || strlen($apellido)>15 ||  !preg_match("/^[a-zA-Z]+$/",$apellido))
		{
			$errorApellido='*complete el apellido correctamente';
			 
		}	
		
		if(trim($nickName) == false || strlen($nickName)>15)
		{
		  $errorNikname='*nickname incorrecto';
		  
		}
		if(!empty($_POST['dia']) && !empty($_POST['mes']) && !empty($_POST['año']))
		{
			$fechaNacimiento = $_POST['año'].'-'.$_POST['mes'].'-'.$_POST['dia'];
			
		}else{
			$errorFechaNacimiento ='*ingresa la fecha de nacimiento'; 
		}
		if(false === filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			
			$errorEmail='*ingrese un email Correcto';
		}
		if(trim($contraseña) == false)
		{
			$errorContraseña = '*ingresa una contraseña';;
		}
		if(trim($contraseñavalidacion)==false)
		{
				   
			$errorContraseñaRepetida='*ingresa nuevamente la contraseña';
			
		}
		if($contraseña==$contraseñavalidacion)
		{
				$validacion=true;
		}else{
			$erroContraseñaValidada='*las contraseñas no son iguales';
			$validacion=false;
		}	
		if(trim($telefono)== false || strlen($telefono)>12 || !preg_match("/^[0-9]+$/", $telefono))
		{
		  $errorTelefono='*ingrese un numero de telefono correcto';
		}
		if(!empty($_POST['sexo'])){
			
			$sexo=$_POST['sexo'];
			
			
		}else{
			$errorSexo='*ingrese su genero';
		}

  if(trim($nombre) != false && trim($apellido) != false &&trim($nickName) != false &&trim($fechaNacimiento) != false &&trim($email) != false &&trim($contraseña) != false &&trim($telefono) != false && trim($sexo) != false&& trim($contraseñavalidacion) != false&&$validacion){
	     ini_set('date.timezone','America/Argentina/Buenos_Aires');
		 $timestamp = time();
         $hoy = date("Y-m-d H:i:s ",$timestamp);  
		  $user = new Usuario($this->adapter);
		  $rutaimagenperfil='imagen-perfil/predeterminada.png';
		  $user->setImagenPerfil($rutaimagenperfil);
		  $user->setNombre($nombre);
		  $user->setApellido($apellido);
		  $user->setEmail($email);
		   $password=password_hash($contraseña, PASSWORD_BCRYPT, $option=[
			'cost' => 10
			]);
		  $user->setPassword($password);
		  $user->setSexo($sexo);
		  $user->setNickname($nickName);
		  $user->setEstado(true);
		  $user->setTelefono($telefono);
		  $user->setFechaAlta($hoy);
		  $user->setFechaNacimiento($fechaNacimiento);
		  $user->setEstado(true);
		  $agregado=$user->Registrar();

		  if($agregado[0]==1){
			$this->redirect("login","index");
		  }else{
			  $errorUsuario ='*ya existe una cuenta con este nickname o email';
			  $this->renderViewParam('registrar',array(
				  "errorUsuario"=> $errorUsuario
			  ));

		  }
		
		 

	
  }else{
	
$this->renderViewParam('registrar',array(
	"errorNombre"=> $errorNombre,
	"errorApellido"=>$errorApellido,
	"errorNikname"=>$errorNikname,
	"errorFechaNacimiento"=>$errorFechaNacimiento,
	"errorEmail"=>$errorEmail,
	"errorContraseña"=>$errorContraseña,
	"erroContraseñaValidada"=>$erroContraseñaValidada,
	"errorContraseñaRepetida"=>$errorContraseñaRepetida,
	"errorTelefono"=>$errorTelefono,
	"errorSexo"=>$errorSexo,
	"nombre"=>$nombre,
	"apellido"=>$apellido,
	"nickName"=>$nickName,
	"email"=>$email,
	"sexo"=>$sexo,
	"telefono"=>$telefono
	));
	
}
   

}

		 
		 


 
          
			
			
		


		

	 

}
?>