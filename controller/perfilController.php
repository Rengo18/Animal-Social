<?php
class perfilController extends ControladorBase{
    public $conectar;
	public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }

		//Listar todos los Usuarios	
		public function index(){
            
            Session_Start() ;
    
            if(isset($_SESSION['nombre'])){
              $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
              $imagen_perfil=$_SESSION['imagen-perfil'];
             }else{
              $this->redirect("login","index");
             }
            
             $id=$_SESSION['id'];
             $mensaje=null;
             $user=new Usuario($this->adapter);
             $publicaciones=new Post($this->adapter);
             $comentario=new Comentario($this->adapter);
             $comentarioAll =$comentario->obtenerComentario();
             $i=0;
             while($row=$comentarioAll->fetch_object()){
                $comentarios[$i]=$row;
                $i++;
             }
             $rowP=$publicaciones->buscarPublicacionesPorId($id);
             $rowU=$user->buscarUsuario($id);
             
             $numeroDePublicaciones=$rowP->num_rows;
             if($numeroDePublicaciones==0){
                 $mensaje="veo que no tienes publicaciones :( <br> ve a tu muro y publica!!";
             }

             $usuarioObtenido=$rowU->fetch_object();
             $this->renderViewParam("perfil",array(
                "usuarioObtenido"=>$usuarioObtenido,
                 "rowP"=>$rowP,
                 "comentarios"=>$comentarios,
                 "mensaje"=>$mensaje,
                  "id"=>$id,
                   "UsuarioNombre"=>$UsuarioNombre,
                   "imagen_perfil"=>$imagen_perfil
               ));

			
        
        }
    
    public function  renderPerfilUser(){

        Session_Start() ;
    
        if(isset($_SESSION['nombre'])){
          $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
          $imagen_perfil=$_SESSION['imagen-perfil'];
         }else{
          $this->redirect("login","index");
         }

         $id=$_SESSION['id'];
         $id_usuario=$_POST['id_usuario'];
         $mensaje=null;
         $user=new Usuario($this->adapter);
         $publicaciones=new Post($this->adapter);
         $comentario=new Comentario($this->adapter);
         $comentarioAll =$comentario->obtenerComentario();
         $i=0;
         while($row=$comentarioAll->fetch_object()){
            $comentarios[$i]=$row;
            $i++;
         }
         $rowP=$publicaciones->buscarPublicacionesPorId($id_usuario);
         $rowU=$user->buscarUsuario($id_usuario);
         
         $numeroDePublicaciones=$rowP->num_rows;
         if($numeroDePublicaciones==0){
             $mensaje="el Usuario no tiene publicaciones :( ";
         }

         $usuarioObtenido=$rowU->fetch_object();
         $this->renderViewParam("perfil",array(
            "usuarioObtenido"=>$usuarioObtenido,
             "rowP"=>$rowP,
             "comentarios"=>$comentarios,
             "mensaje"=>$mensaje,
              "id"=>$id,
              "UsuarioNombre"=>$UsuarioNombre,
              "imagen_perfil"=>$imagen_perfil
           ));

    }
    
    public function CrarRelacion(){

        Session_Start() ;
    
        if(isset($_SESSION['nombre'])){
          $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
          $imagen_perfil=$_SESSION['imagen-perfil'];
         }else{
          $this->redirect("login","index");
         }

         $id_solicita=$_SESSION['id'];
         $id_recibe=$_POST['id_solicitud'];
         ini_set('date.timezone','America/Argentina/Buenos_Aires');
		 $timestamp = time();
         $fecha= date("Y-m-d H:i:s ",$timestamp); 
         $estado= 'pendiente';
         $usuario=new Usuario($this->adapter);
         $usuario->setId($id_solicita);
         $usuario->setId_Aux($id_recibe);
         $usuario->setFechaAlta($fecha);
         $usuario->setEstado($estado);

         $usuario->CrearRelacion();
         
         $this->redirect("perfil","index");


    }

    public function AceptarOCancelarRelacion(){
        Session_Start() ;
    
        if(isset($_SESSION['nombre'])){
          $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
          $imagen_perfil=$_SESSION['imagen-perfil'];
         }else{
          $this->redirect("login","index");
         }
  if(isset($_POST['Aceptar'])){ 
       $id_recibe=$_SESSION['id'];
       $id_socitia=$_POST['id_usuario_solicita'];
       $user=new Usuario($this->adapter);
       $user->setId($id_recibe);
       $user->setId_Aux($id_socitia);
       $user->AceptarOCancelarRelacion('aceptar');
    
       $this->redirect("muro","mostrarRelaciones");

     }else{
        $id_recibe=$_SESSION['id'];
        $id_socitia=$_POST['id_usuario_solicita'];
        $user=new Usuario($this->adapter);
        $user->setId($id_recibe);
        $user->setId_Aux($id_socitia);
        $user->AceptarOCancelarRelacion('cancelar');
     
        $this->redirect("muro","mostrarRelaciones");

     }

    



    }


    public function renderEditarPerfil(){
        Session_Start() ;
    
        if(isset($_SESSION['nombre'])){
          $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
          $imagen_perfil=$_SESSION['imagen-perfil'];
         }else{
          $this->redirect("login","index");
         }
       
          $id_user=$_SESSION['id'];
          $user=new Usuario($this->adapter);
          $elusuario=$user->buscarUsuario($id_user);



         $this->renderViewParam("editarperfil",array(
            "UsuarioNombre"=>$UsuarioNombre,
             "imagen_perfil"=>$imagen_perfil,
             "elusuario"=>$elusuario
         ));

     

    }


    public function EditarPerfil(){

        Session_Start() ;
    
        if(isset($_SESSION['nombre'])){
          $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
          $imagen_perfil=$_SESSION['imagen-perfil'];
         }else{
          $this->redirect("login","index");
         }
         $id_user=$_SESSION['id'];
            $user=new Usuario($this->adapter);
            $elusuario=$user->buscarUsuario($id_user);
            
         $id_user=$_SESSION['id'];
         $errorimagen='';
         $errortelefono='';
         $errorfecha='';
         $imagenesPermitidas="%\.(gif|jpe?g|png)$%i";
    
        if($_FILES['foto-perfil']['name'] != null){
          if(preg_match($imagenesPermitidas, $_FILES['foto-perfil']['name']) == 1)
          {
   
            
  
            $info = new SplFileInfo( $_FILES['foto-perfil']['name']);
            $nombrealeatorio = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
            $carpetaTemporal= $_FILES['foto-perfil']['tmp_name'];
            $carpetadestino ='imagen-perfil/';
            $rutaimagen=$carpetadestino.$nombrealeatorio;
            move_uploaded_file($carpetaTemporal,$rutaimagen);
            $user=new Usuario($this->adapter);
            $user->setId($id_user);
            $user->setImagenPerfil($rutaimagen);
            $user->editarPerfil();
            $_SESSION['imagen-perfil']=$rutaimagen;
            $this->redirect("perfil","index");

            


          }else{

            $errorimagen='*ingrese una imagen';
            $this->renderViewParam("editarperfil",array(
                "UsuarioNombre"=>$UsuarioNombre,
                 "imagen_perfil"=>$imagen_perfil,
                 "elusuario"=>$elusuario,
                 "errorimagen"=>$errorimagen
             ));

          }
            
        }


    }
}