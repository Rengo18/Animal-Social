<?php

class muroController extends ControladorBase{
    public $conectar;
	public $adapter;
	
    public function __construct() {
        parent::__construct();
		 
        $this->conectar=new Conectar();
        $this->adapter =$this->conectar->conexion();
    }
  
   
        

    public function index(){
     
      Session_Start() ;
    
      if(isset($_SESSION['nombre'])){
        $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
        $imagen_perfil=$_SESSION['imagen-perfil'];
       }else{
        $this->redirect("login","index");
       }
        
        $this->renderViewParam("muro",array(
               "UsuarioNombre"=>$UsuarioNombre,
               "imagen_perfil"=>$imagen_perfil
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

    public function crearPublicacion(){
      
      Session_Start() ;
    
      if(isset($_SESSION['nombre'])){
        $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
        $imagen_perfil=$_SESSION['imagen-perfil'];
       }else{
        $this->redirect("login","index");
       }
        
         $booleanimagen=false;
         $booleanPalabraClave=false;
         $booleanAdjunto=false;
         $palabraclave1=$_POST['palabra1'];
         $palabraclave2=$_POST['palabra2'];
         $palabraclave3=$_POST['palabra3'];
         $adjunto=$_FILES['adjunto']['name'];
         $id_user=$_SESSION['id'];
         $titulo=$_POST['titulo'];
         $descripcion=$_POST['descripcion'];
         $estado=true;
         $visibilidad=$_POST['visibilidad'];
         $rutaimagen1=null;
         $rutaimagen2=null;
         $rutaimagen3=null;
         $rutaArchivo=null;
         $errorimagen=null;
         $errorArchivo=null;
         $errorPalabraClave=null;
         $errorTitulo=null;
         $errorDescripcion=null;
         
         
         
         
         
     if($_FILES['file-img']['name'][0] != null) {
             $booleanimagen=true;
             $sonimagenes=false;
             $patronperimitido="%\.(gif|jpe?g|png)$%i";
            $cantidadImagen =count($_FILES['file-img']['name']);
             switch ($cantidadImagen) {
               case 1:
                //VALIDAMOS SI LA IMAGEN ES VALIDA
                  if(preg_match($patronperimitido, $_FILES['file-img']['name'][0]) == 1){
                     $sonimagenes=true;
                  
                   }
            
              if(!$sonimagenes){
                 
                   $errorimagen='unicamente se suben imagen';

                 } 
                        
                  //VALIDAMOS SI HAY ADJUNTO AL MOMENTO DE SUBIR UNA IMAGEN
                   if($_FILES['adjunto']['name'] != null){
                      $booleanAdjunto=true;
                      $esArchivo=false;
                      $patronperimitido="%\.(zip|txt|rar|ra|xls|pdf|ppt|docx|xlsx)$%i";
                       if(preg_match($patronperimitido, $_FILES['adjunto']['name']) == 1)
                       {
                        $esArchivo=true;
                       }
                     
           
           
                       if(!$esArchivo){
                          $errorArchivo ='Archivo no permitido para subir';
                        } 
                        }   
                       //VALIDAMOS SI AL MOMENTO DE SUBIR 1 IMAGEN HAY PALABRAS CLAVES   
                      if(!empty($_POST['palabraclave'])){
                         $booleanPalabraClave=true;
                         if(empty($palabraclave1)||empty($palabraclave2)||empty($palabraclave3))
                       {
                            $errorPalabraClave='ingrese las 3 palabras claves';  
                         }
                     
                       }

                       if(empty($titulo)){
                         $errorTitulo="*ingrese un titulo";
                     }
                    if(empty($descripcion)){
                         $errorDescripcion="*ingrese una descripcion a la publicacion";
                      }
                 
                 
                

                   if($booleanPalabraClave && $booleanAdjunto){
                              //REDIRECCIONO SEGUN EL CASO DE LA PUBLICACION    
                    if($_FILES['adjunto']['name'] != null &&  $errorArchivo==null && !empty($_POST['palabraclave']) && $errorPalabraClave==null && $errorimagen==null && $errorTitulo==null && $errorDescripcion==null)
                    {    
                      
                       
                           ini_set('date.timezone','America/Argentina/Buenos_Aires');
                           $timestamp = time();
                           $fecha = date("Y-m-d H:i:s ",$timestamp); 
                           $user = new Usuario($this->adapter);
                           $publicacion = new Post($this->adapter);
                       //subimos imgane0
                           $info = new SplFileInfo($_FILES['file-img']['name'][0]);
                           $nombrealeatorio = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
                           $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
                          $carpetadestino ='imagen_publicaciones/';
                           $rutaimagen1=$carpetadestino.$nombrealeatorio;
                           move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);
                           //subimos Archivo
                         $nombreArchivo=$_FILES['adjunto']['name'];
                           $carpetaTemporalArchivo=$_FILES['adjunto']['tmp_name'];
                           $carpetadestino ='Archivos_publicacion/' ;
                           $rutaArchivo= $carpetadestino.$nombreArchivo;
                           move_uploaded_file($carpetaTemporalArchivo,$rutaArchivo);
                     //subimos el resto y seteamos las variables conrrespondiente
                           
                           $user->setId($id_user);
                           $publicacion->setUsuario($user);
                           $publicacion->setTitulo($titulo);
                           $publicacion->setDescripcion($descripcion);
                           $publicacion->setVisibilidad($visibilidad);
                           $publicacion->setFecha($fecha);
                           $publicacion->setEstado($estado);
                           $publicacion->setImagen1($rutaimagen1);
                           $publicacion->setAdjunto($rutaArchivo);
                           $publicacion->setPalabraClave1($palabraclave1);
                           $publicacion->setPalabraClave2($palabraclave2);
                           $publicacion->setPalabraClave3($palabraclave3);
                           $publicacion->crearPublicacion(9);
                          
                         
                           $this->redirect("muro","renderPublicacion");
                           exit;
                          
                           
                     }else{
                        
                         $this->renderViewParam("muro",array(
                           "errorTitulo"=>$errorTitulo,
                           "errorDescripcion"=>$errorDescripcion,
                           "titulo"=>$titulo,
                           "descripcion"=>$descripcion,
                           "palabraclave1"=>$palabraclave1,
                           "palabraclave2"=>$palabraclave2,
                           "palabraclave3"=>$palabraclave3,
                           "errorPalabraClave"=>$errorPalabraClave,
                           "errorArchivo"=>$errorArchivo,
                           "errorimagen"=>$errorimagen,
                           "UsuarioNombre"=>$UsuarioNombre,
                            "imagen_perfil"=>$imagen_perfil
                            
  
                     ));
            
                         
                     }
  

                   }elseif ($booleanAdjunto) {
                    if($_FILES['adjunto']['name'] != null &&  $errorArchivo==null && $errorimagen==null && $errorTitulo==null && $errorDescripcion==null)
                    {
                     ini_set('date.timezone','America/Argentina/Buenos_Aires');
                     $timestamp = time();
                     $fecha = date("Y-m-d H:i:s ",$timestamp); 
                     $user = new Usuario($this->adapter);
                     $publicacion = new Post($this->adapter);
                 //subimos imgane
                     $info = new SplFileInfo($_FILES['file-img']['name'][0]);
                     $nombrealeatorio = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
                     $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
                    $carpetadestino ='imagen_publicaciones/';
                     $rutaimagen1=$carpetadestino.$nombrealeatorio;
                     move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);
                     //subimos Archivo
                   $nombreArchivo=$_FILES['adjunto']['name'];
                     $carpetaTemporalArchivo=$_FILES['adjunto']['tmp_name'];
                     $carpetadestino ='Archivos_publicacion/' ;
                     $rutaArchivo= $carpetadestino.$nombreArchivo;
                     move_uploaded_file($carpetaTemporalArchivo,$rutaArchivo);
                    //subimos el resto y seteamos las variables conrrespondiente
                    $user->setId($id_user);
                    $publicacion->setUsuario($user);
                    $publicacion->setTitulo($titulo);
                    $publicacion->setDescripcion($descripcion);
                    $publicacion->setVisibilidad($visibilidad);
                    $publicacion->setFecha($fecha);
                    $publicacion->setEstado($estado);
                    $publicacion->setImagen1($rutaimagen1);
                    $publicacion->setAdjunto($rutaArchivo);
                    $publicacion->crearPublicacion(12);
  
                    $this->redirect("muro","renderPublicacion");
                    exit;
 
                    }else{
                     $this->renderViewParam("muro",array(
                       "errorTitulo"=>$errorTitulo,
                       "errorDescripcion"=>$errorDescripcion,
                       "titulo"=>$titulo,
                       "descripcion"=>$descripcion,
                       "errorArchivo"=>$errorArchivo,
                       "errorimagen"=>$errorimagen,
                       "UsuarioNombre"=>$UsuarioNombre,
                       "imagen_perfil"=>$imagen_perfil
                     ));
                    }   
                   }elseif ($booleanPalabraClave) {
                   
                   
                    if( !empty($_POST['palabraclave']) && $errorPalabraClave==null && $errorimagen==null && $errorTitulo==null && $errorDescripcion==null)
                    {
                      ini_set('date.timezone','America/Argentina/Buenos_Aires');
                      $timestamp = time();
                      $fecha = date("Y-m-d H:i:s ",$timestamp); 
                      $user = new Usuario($this->adapter);
                      $publicacion = new Post($this->adapter);
                  //subimos imgane
                      $info = new SplFileInfo($_FILES['file-img']['name'][0]);
                      $nombrealeatorio = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
                      $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
                     $carpetadestino ='imagen_publicaciones/';
                      $rutaimagen1=$carpetadestino.$nombrealeatorio;
                      move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);
                      $user->setId($id_user);
                      $publicacion->setUsuario($user);
                      $publicacion->setTitulo($titulo);
                      $publicacion->setDescripcion($descripcion);
                      $publicacion->setVisibilidad($visibilidad);
                      $publicacion->setFecha($fecha);
                      $publicacion->setEstado($estado);
                      $publicacion->setImagen1($rutaimagen1);
                      $publicacion->setPalabraClave1($palabraclave1);
                      $publicacion->setPalabraClave2($palabraclave2);
                      $publicacion->setPalabraClave3($palabraclave3);
                      $publicacion->crearPublicacion(6);

                      $this->redirect("muro","renderPublicacion");
                      exit;

                    }else{
                      $this->renderViewParam("muro",array(
                        "errorTitulo"=>$errorTitulo,
                        "errorDescripcion"=>$errorDescripcion,
                        "titulo"=>$titulo,
                        "descripcion"=>$descripcion,
                        "palabraclave1"=>$palabraclave1,
                        "palabraclave2"=>$palabraclave2,
                        "palabraclave3"=>$palabraclave3,
                        "errorPalabraClave"=>$errorPalabraClave,
                        "errorimagen"=>$errorimagen,
                        "UsuarioNombre"=>$UsuarioNombre,
                        "imagen_perfil"=>$imagen_perfil
                      ));
                     } 
                   }

                  if($errorimagen==null && $errorTitulo==null && $errorDescripcion==null){
                    ini_set('date.timezone','America/Argentina/Buenos_Aires');
                    $timestamp = time();
                    $fecha = date("Y-m-d H:i:s ",$timestamp); 
                    $user = new Usuario($this->adapter);
                    $publicacion = new Post($this->adapter);
                    $info = new SplFileInfo($_FILES['file-img']['name'][0]);
                      $nombrealeatorio = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
                      $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
                     $carpetadestino ='imagen_publicaciones/';
                      $rutaimagen1=$carpetadestino.$nombrealeatorio;
                      move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);
                      $user->setId($id_user);
                      $publicacion->setUsuario($user);
                      $publicacion->setTitulo($titulo);
                      $publicacion->setDescripcion($descripcion);
                      $publicacion->setVisibilidad($visibilidad);
                      $publicacion->setFecha($fecha);
                      $publicacion->setEstado($estado);
                      $publicacion->setImagen1($rutaimagen1);
                      $publicacion->crearPublicacion(1);

                      $this->redirect("muro","renderPublicacion");
                      exit;

                  }else{

                    $this->renderViewParam("muro",array(
                      "errorTitulo"=>$errorTitulo,
                      "errorDescripcion"=>$errorDescripcion,
                      "titulo"=>$titulo,
                      "descripcion"=>$descripcion,
                      "errorimagen"=>$errorimagen,
                      "UsuarioNombre"=>$UsuarioNombre,
                      "imagen_perfil"=>$imagen_perfil
                    ));

                  }








                break;
                  


                        

                  
                    
                     
               
                 
                  
                  
                      
                     



            

                 //BREAK 2 
                 case 2:
             
                 if(preg_match($patronperimitido, $_FILES['file-img']['name'][0]) == 1 &&preg_match($patronperimitido, $_FILES['file-img']['name'][1]) == 1){
                   $sonimagenes=true;
                  
                  }   
                 else{
                   $sonimagenes=false;
                }
    
              
                if(!$sonimagenes){
                 
                  $errorimagen='unicamente se suben imagen';

                } 
                       
                 //VALIDAMOS SI HAY ADJUNTO AL MOMENTO DE SUBIR UNA IMAGEN
                  if($_FILES['adjunto']['name'] != null){
                     $booleanAdjunto=true;
                     $esArchivo=false;
                     $patronperimitido="%\.(zip|txt|rar|ra|xls|pdf|ppt|docx|xlsx)$%i";
                      if(preg_match($patronperimitido, $_FILES['adjunto']['name']) == 1)
                      {
                       $esArchivo=true;
                      }
                    
          
          
                      if(!$esArchivo){
                         $errorArchivo ='Archivo no permitido para subir';
                       } 
                       }   
                      //VALIDAMOS SI AL MOMENTO DE SUBIR 1 IMAGEN HAY PALABRAS CLAVES   
                     if(!empty($_POST['palabraclave'])){
                        $booleanPalabraClave=true;
                        if(empty($palabraclave1)||empty($palabraclave2)||empty($palabraclave3))
                      {
                           $errorPalabraClave='ingrese las 3 palabras claves';  
                        }
                    
                      }

                      if(empty($titulo)){
                        $errorTitulo="*ingrese un titulo";
                    }
                   if(empty($descripcion)){
                        $errorDescripcion="*ingrese una descripcion a la publicacion";
                     }

            if($booleanPalabraClave && $booleanAdjunto){
            //REDIRECCIONO SEGUN EL CASO DE LA PUBLICACION    
            if($_FILES['adjunto']['name'] != null &&  $errorArchivo==null && !empty($_POST['palabraclave']) && $errorPalabraClave==null && $errorimagen==null && $errorTitulo==null && $errorDescripcion==null)
            {    
              
               
                   ini_set('date.timezone','America/Argentina/Buenos_Aires');
                   $timestamp = time();
                   $fecha = date("Y-m-d H:i:s ",$timestamp); 
                   $user = new Usuario($this->adapter);
                   $publicacion = new Post($this->adapter);
               //subimos imagenes
                  $info = new SplFileInfo($_FILES['file-img']['name'][0]);
                  $nombrealeatorioimagen1 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
                  $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
                  $carpetadestino ='imagen_publicaciones/';
                  $rutaimagen1=$carpetadestino.$nombrealeatorioimagen1;
                  move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);

                  $info = new SplFileInfo($_FILES['file-img']['name'][1]);
                  $nombrealeatorioimagen2 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
                  $carpetaTemproalimagen2=$_FILES['file-img']['tmp_name'][1];
                  $carpetadestino ='imagen_publicaciones/';
                  $rutaimagen2=$carpetadestino.$nombrealeatorioimagen2;
                  move_uploaded_file($carpetaTemproalimagen2,$rutaimagen2);
                   //subimos Archivo
                 $nombreArchivo=$_FILES['adjunto']['name'];
                   $carpetaTemporalArchivo=$_FILES['adjunto']['tmp_name'];
                   $carpetadestino ='Archivos_publicacion/' ;
                   $rutaArchivo= $carpetadestino.$nombreArchivo;
                   move_uploaded_file($carpetaTemporalArchivo,$rutaArchivo);
             //subimos el resto y seteamos las variables conrrespondiente
                   
                   $user->setId($id_user);
                   $publicacion->setUsuario($user);
                   $publicacion->setTitulo($titulo);
                   $publicacion->setDescripcion($descripcion);
                   $publicacion->setVisibilidad($visibilidad);
                   $publicacion->setFecha($fecha);
                   $publicacion->setEstado($estado);
                   $publicacion->setImagen1($rutaimagen1);
                   $publicacion->setImagen2($rutaimagen2);
                   $publicacion->setAdjunto($rutaArchivo);
                   $publicacion->setPalabraClave1($palabraclave1);
                   $publicacion->setPalabraClave2($palabraclave2);
                   $publicacion->setPalabraClave3($palabraclave3);
                   $publicacion->crearPublicacion(10);
                  
                 
                   $this->redirect("muro","renderPublicacion");
                   exit;
                    
                   
             }else{
                
                 $this->renderViewParam("muro",array(
                   "errorTitulo"=>$errorTitulo,
                   "errorDescripcion"=>$errorDescripcion,
                   "titulo"=>$titulo,
                   "descripcion"=>$descripcion,
                   "palabraclave1"=>$palabraclave1,
                   "palabraclave2"=>$palabraclave2,
                   "palabraclave3"=>$palabraclave3,
                   "errorPalabraClave"=>$errorPalabraClave,
                   "errorArchivo"=>$errorArchivo,
                   "errorimagen"=>$errorimagen,
                   "UsuarioNombre"=>$UsuarioNombre,
                   "imagen_perfil"=>$imagen_perfil

             ));
    
                 
             }


           }elseif ($booleanAdjunto) {
            if($_FILES['adjunto']['name'] != null &&  $errorArchivo==null && $errorimagen==null && $errorTitulo==null && $errorDescripcion==null)
            {
             ini_set('date.timezone','America/Argentina/Buenos_Aires');
             $timestamp = time();
             $fecha = date("Y-m-d H:i:s ",$timestamp); 
             $user = new Usuario($this->adapter);
             $publicacion = new Post($this->adapter);
         //subimos imgane
             $info = new SplFileInfo($_FILES['file-img']['name'][0]);
             $nombrealeatorioimagen1 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
             $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
            $carpetadestino ='imagen_publicaciones/';
             $rutaimagen1=$carpetadestino.$nombrealeatorioimagen1;
             move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);

             $info = new SplFileInfo($_FILES['file-img']['name'][1]);
             $nombrealeatorioimagen2 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
             $carpetaTemproalimagen2=$_FILES['file-img']['tmp_name'][1];
             $carpetadestino ='imagen_publicaciones/';
             $rutaimagen2=$carpetadestino.$nombrealeatorioimagen2;
             move_uploaded_file($carpetaTemproalimagen2,$rutaimagen2);
             //subimos Archivo
             $nombreArchivo=$_FILES['adjunto']['name'];
             $carpetaTemporalArchivo=$_FILES['adjunto']['tmp_name'];
             $carpetadestino ='Archivos_publicacion/' ;
             $rutaArchivo= $carpetadestino.$nombreArchivo;
             move_uploaded_file($carpetaTemporalArchivo,$rutaArchivo);
            //subimos el resto y seteamos las variables conrrespondiente
            $user->setId($id_user);
            $publicacion->setUsuario($user);
            $publicacion->setTitulo($titulo);
            $publicacion->setDescripcion($descripcion);
            $publicacion->setVisibilidad($visibilidad);
            $publicacion->setFecha($fecha);
            $publicacion->setEstado($estado);
            $publicacion->setImagen1($rutaimagen1);
            $publicacion->setImagen2($rutaimagen2);
            $publicacion->setAdjunto($rutaArchivo);
            $publicacion->crearPublicacion(13);

            $this->redirect("muro","renderPublicacion");
            exit;

            }else{
             $this->renderViewParam("muro",array(
               "errorTitulo"=>$errorTitulo,
               "errorDescripcion"=>$errorDescripcion,
               "titulo"=>$titulo,
               "descripcion"=>$descripcion,
               "errorArchivo"=>$errorArchivo,
               "errorimagen"=>$errorimagen,
               "UsuarioNombre"=>$UsuarioNombre,
               "imagen_perfil"=>$imagen_perfil
             ));
            }   
           }elseif ($booleanPalabraClave) {
           
           
            if( !empty($_POST['palabraclave']) && $errorPalabraClave==null && $errorimagen==null && $errorTitulo==null && $errorDescripcion==null)
            {
              ini_set('date.timezone','America/Argentina/Buenos_Aires');
              $timestamp = time();
              $fecha = date("Y-m-d H:i:s ",$timestamp); 
              $user = new Usuario($this->adapter);
              $publicacion = new Post($this->adapter);
          //subimos imgane
              $info = new SplFileInfo($_FILES['file-img']['name'][0]);
              $nombrealeatorioimagen1 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
              $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
              $carpetadestino ='imagen_publicaciones/';
              $rutaimagen1=$carpetadestino.$nombrealeatorioimagen1;
              move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);

              $info = new SplFileInfo($_FILES['file-img']['name'][1]);
              $nombrealeatorioimagen2 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
              $carpetaTemproalimagen2=$_FILES['file-img']['tmp_name'][1];
              $carpetadestino ='imagen_publicaciones/';
              $rutaimagen2=$carpetadestino.$nombrealeatorioimagen2;
              move_uploaded_file($carpetaTemproalimagen2,$rutaimagen2);

              $user->setId($id_user);
              $publicacion->setUsuario($user);
              $publicacion->setTitulo($titulo);
              $publicacion->setDescripcion($descripcion);
              $publicacion->setVisibilidad($visibilidad);
              $publicacion->setFecha($fecha);
              $publicacion->setEstado($estado);
              $publicacion->setImagen1($rutaimagen1);
              $publicacion->setImagen2($rutaimagen2);
              $publicacion->setPalabraClave1($palabraclave1);
              $publicacion->setPalabraClave2($palabraclave2);
              $publicacion->setPalabraClave3($palabraclave3);
              $publicacion->crearPublicacion(7);

              $this->redirect("muro","renderPublicacion");
              exit;

            }else{
              $this->renderViewParam("muro",array(
                "errorTitulo"=>$errorTitulo,
                "errorDescripcion"=>$errorDescripcion,
                "titulo"=>$titulo,
                "descripcion"=>$descripcion,
                "palabraclave1"=>$palabraclave1,
                "palabraclave2"=>$palabraclave2,
                "palabraclave3"=>$palabraclave3,
                "errorPalabraClave"=>$errorPalabraClave,
                "errorimagen"=>$errorimagen,
                "UsuarioNombre"=>$UsuarioNombre,
                "imagen_perfil"=>$imagen_perfil
              ));
             } 
           }

           if($errorimagen==null && $errorTitulo==null && $errorDescripcion==null){
            ini_set('date.timezone','America/Argentina/Buenos_Aires');
            $timestamp = time();
            $fecha = date("Y-m-d H:i:s ",$timestamp); 
            $user = new Usuario($this->adapter);
            $publicacion = new Post($this->adapter);

            $info = new SplFileInfo($_FILES['file-img']['name'][0]);
            $nombrealeatorioimagen1 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
            $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
            $carpetadestino ='imagen_publicaciones/';
            $rutaimagen1=$carpetadestino.$nombrealeatorioimagen1;
            move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);

            $info = new SplFileInfo($_FILES['file-img']['name'][1]);
            $nombrealeatorioimagen2 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
            $carpetaTemproalimagen2=$_FILES['file-img']['tmp_name'][1];
            $carpetadestino ='imagen_publicaciones/';
            $rutaimagen2=$carpetadestino.$nombrealeatorioimagen2;
            move_uploaded_file($carpetaTemproalimagen2,$rutaimagen2);

              $user->setId($id_user);
              $publicacion->setUsuario($user);
              $publicacion->setTitulo($titulo);
              $publicacion->setDescripcion($descripcion);
              $publicacion->setVisibilidad($visibilidad);
              $publicacion->setFecha($fecha);
              $publicacion->setEstado($estado);
              $publicacion->setImagen1($rutaimagen1);
              $publicacion->setImagen2($rutaimagen2);
              $publicacion->crearPublicacion(15);

              $this->redirect("muro","renderPublicacion");
              exit;

          }else{

            $this->renderViewParam("muro",array(
              "errorTitulo"=>$errorTitulo,
              "errorDescripcion"=>$errorDescripcion,
              "titulo"=>$titulo,
              "descripcion"=>$descripcion,
              "errorimagen"=>$errorimagen,
              "UsuarioNombre"=>$UsuarioNombre,
              "imagen_perfil"=>$imagen_perfil
            ));

          }

                 break;






                 case 3:
              
                   if(preg_match($patronperimitido, $_FILES['file-img']['name'][0]) == 1 &&preg_match($patronperimitido, $_FILES['file-img']['name'][1]) == 1 &&preg_match($patronperimitido, $_FILES['file-img']['name'][2]) == 1){
                     $sonimagenes=true;
                  
                   }   
                 else{
                   $sonimagenes=false;
                }
    
              
    
               
                if(!$sonimagenes){
                 
                  $errorimagen='unicamente se suben imagen';

                } 
                       
                 //VALIDAMOS SI HAY ADJUNTO AL MOMENTO DE SUBIR UNA IMAGEN
                  if($_FILES['adjunto']['name'] != null){
                     $booleanAdjunto=true;
                     $esArchivo=false;
                     $patronperimitido="%\.(zip|txt|rar|ra|xls|pdf|ppt|docx|xlsx)$%i";
                      if(preg_match($patronperimitido, $_FILES['adjunto']['name']) == 1)
                      {
                       $esArchivo=true;
                      }
                    
          
          
                      if(!$esArchivo){
                         $errorArchivo ='Archivo no permitido para subir';
                       } 
                       }   
                      //VALIDAMOS SI AL MOMENTO DE SUBIR 1 IMAGEN HAY PALABRAS CLAVES   
                     if(!empty($_POST['palabraclave'])){
                        $booleanPalabraClave=true;
                        if(empty($palabraclave1)||empty($palabraclave2)||empty($palabraclave3))
                      {
                           $errorPalabraClave='ingrese las 3 palabras claves';  
                        }
                    
                      }

                      if(empty($titulo)){
                        $errorTitulo="*ingrese un titulo";
                    }
                   if(empty($descripcion)){
                        $errorDescripcion="*ingrese una descripcion a la publicacion";
                     }


           if($booleanPalabraClave && $booleanAdjunto){
            //REDIRECCIONO SEGUN EL CASO DE LA PUBLICACION    
            if($_FILES['adjunto']['name'] != null &&  $errorArchivo==null && !empty($_POST['palabraclave']) && $errorPalabraClave==null && $errorimagen==null && $errorTitulo==null && $errorDescripcion==null)
            {    
              
               
                   ini_set('date.timezone','America/Argentina/Buenos_Aires');
                   $timestamp = time();
                   $fecha = date("Y-m-d H:i:s ",$timestamp); 
                   $user = new Usuario($this->adapter);
                   $publicacion = new Post($this->adapter);
               //subimos imagenes
                  $info = new SplFileInfo($_FILES['file-img']['name'][0]);
                  $nombrealeatorioimagen1 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
                  $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
                  $carpetadestino ='imagen_publicaciones/';
                  $rutaimagen1=$carpetadestino.$nombrealeatorioimagen1;
                  move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);

                  $info = new SplFileInfo($_FILES['file-img']['name'][1]);
                  $nombrealeatorioimagen2 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
                  $carpetaTemproalimagen2=$_FILES['file-img']['tmp_name'][1];
                  $carpetadestino ='imagen_publicaciones/';
                  $rutaimagen2=$carpetadestino.$nombrealeatorioimagen2;
                  move_uploaded_file($carpetaTemproalimagen2,$rutaimagen2);

                  $info = new SplFileInfo($_FILES['file-img']['name'][2]);
                  $nombrealeatorioimagen3 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
                  $carpetaTemproalimagen3=$_FILES['file-img']['tmp_name'][2];
                  $carpetadestino ='imagen_publicaciones/';
                  $rutaimagen3=$carpetadestino.$nombrealeatorioimagen3;
                  move_uploaded_file( $carpetaTemproalimagen3,$rutaimagen3);
                   //subimos Archivo
                 $nombreArchivo=$_FILES['adjunto']['name'];
                   $carpetaTemporalArchivo=$_FILES['adjunto']['tmp_name'];
                   $carpetadestino ='Archivos_publicacion/' ;
                   $rutaArchivo= $carpetadestino.$nombreArchivo;
                   move_uploaded_file($carpetaTemporalArchivo,$rutaArchivo);
             //subimos el resto y seteamos las variables conrrespondiente
                   
                   $user->setId($id_user);
                   $publicacion->setUsuario($user);
                   $publicacion->setTitulo($titulo);
                   $publicacion->setDescripcion($descripcion);
                   $publicacion->setVisibilidad($visibilidad);
                   $publicacion->setFecha($fecha);
                   $publicacion->setEstado($estado);
                   $publicacion->setImagen1($rutaimagen1);
                   $publicacion->setImagen2($rutaimagen2);
                   $publicacion->setImagen3($rutaimagen3);
                   $publicacion->setAdjunto($rutaArchivo);
                   $publicacion->setPalabraClave1($palabraclave1);
                   $publicacion->setPalabraClave2($palabraclave2);
                   $publicacion->setPalabraClave3($palabraclave3);
                   $publicacion->crearPublicacion(11);
                  
                 
                   $this->redirect("muro","renderPublicacion");
                   exit;
                   
             }else{
                
                 $this->renderViewParam("muro",array(
                   "errorTitulo"=>$errorTitulo,
                   "errorDescripcion"=>$errorDescripcion,
                   "titulo"=>$titulo,
                   "descripcion"=>$descripcion,
                   "palabraclave1"=>$palabraclave1,
                   "palabraclave2"=>$palabraclave2,
                   "palabraclave3"=>$palabraclave3,
                   "errorPalabraClave"=>$errorPalabraClave,
                   "errorArchivo"=>$errorArchivo,
                   "errorimagen"=>$errorimagen,
                   "UsuarioNombre"=>$UsuarioNombre,
                   "imagen_perfil"=>$imagen_perfil
                    

             ));
    
                 
             }


           }elseif ($booleanAdjunto) {
            if($_FILES['adjunto']['name'] != null &&  $errorArchivo==null && $errorimagen==null && $errorTitulo==null && $errorDescripcion==null)
            {
             ini_set('date.timezone','America/Argentina/Buenos_Aires');
             $timestamp = time();
             $fecha = date("Y-m-d H:i:s ",$timestamp); 
             $user = new Usuario($this->adapter);
             $publicacion = new Post($this->adapter);
         //subimos imgane
             $info = new SplFileInfo($_FILES['file-img']['name'][0]);
             $nombrealeatorioimagen1 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
             $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
            $carpetadestino ='imagen_publicaciones/';
             $rutaimagen1=$carpetadestino.$nombrealeatorioimagen1;
             move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);

             $info = new SplFileInfo($_FILES['file-img']['name'][1]);
             $nombrealeatorioimagen2 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
             $carpetaTemproalimagen2=$_FILES['file-img']['tmp_name'][1];
             $carpetadestino ='imagen_publicaciones/';
             $rutaimagen2=$carpetadestino.$nombrealeatorioimagen2;
             move_uploaded_file( $carpetaTemproalimagen2,$rutaimagen2);

             $info = new SplFileInfo($_FILES['file-img']['name'][2]);
              $nombrealeatorioimagen3 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
              $carpetaTemproalimagen3=$_FILES['file-img']['tmp_name'][2];
              $carpetadestino ='imagen_publicaciones/';
              $rutaimagen3=$carpetadestino.$nombrealeatorioimagen3;
              move_uploaded_file( $carpetaTemproalimagen3,$rutaimagen3);

             //subimos Archivo
             $nombreArchivo=$_FILES['adjunto']['name'];
             $carpetaTemporalArchivo=$_FILES['adjunto']['tmp_name'];
             $carpetadestino ='Archivos_publicacion/' ;
             $rutaArchivo= $carpetadestino.$nombreArchivo;
             move_uploaded_file($carpetaTemporalArchivo,$rutaArchivo);
            //subimos el resto y seteamos las variables conrrespondiente
            $user->setId($id_user);
            $publicacion->setUsuario($user);
            $publicacion->setTitulo($titulo);
            $publicacion->setDescripcion($descripcion);
            $publicacion->setVisibilidad($visibilidad);
            $publicacion->setFecha($fecha);
            $publicacion->setEstado($estado);
            $publicacion->setImagen1($rutaimagen1);
            $publicacion->setImagen2($rutaimagen2);
            $publicacion->setImagen3($rutaimagen3);
            $publicacion->setAdjunto($rutaArchivo);
            $publicacion->crearPublicacion(14);

            $this->redirect("muro","renderPublicacion");
            exit;
            }else{
             $this->renderViewParam("muro",array(
               "errorTitulo"=>$errorTitulo,
               "errorDescripcion"=>$errorDescripcion,
               "titulo"=>$titulo,
               "descripcion"=>$descripcion,
               "errorArchivo"=>$errorArchivo,
               "errorimagen"=>$errorimagen,
               "UsuarioNombre"=>$UsuarioNombre,
               "imagen_perfil"=>$imagen_perfil
             ));
            }   
           }elseif ($booleanPalabraClave) {
           
           
            if( !empty($_POST['palabraclave']) && $errorPalabraClave==null && $errorimagen==null && $errorTitulo==null && $errorDescripcion==null)
            {
              ini_set('date.timezone','America/Argentina/Buenos_Aires');
              $timestamp = time();
              $fecha = date("Y-m-d H:i:s ",$timestamp); 
              $user = new Usuario($this->adapter);
              $publicacion = new Post($this->adapter);
          //subimos imgane
              $info = new SplFileInfo($_FILES['file-img']['name'][0]);
              $nombrealeatorioimagen1 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
              $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
            $carpetadestino ='imagen_publicaciones/';
              $rutaimagen1=$carpetadestino.$nombrealeatorioimagen1;
              move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);

              $info = new SplFileInfo($_FILES['file-img']['name'][1]);
              $nombrealeatorioimagen2 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
              $carpetaTemproalimagen2=$_FILES['file-img']['tmp_name'][1];
              $carpetadestino ='imagen_publicaciones/';
              $rutaimagen2=$carpetadestino.$nombrealeatorioimagen2;
              move_uploaded_file($carpetaTemproalimagen2,$rutaimagen2);

              
              $info = new SplFileInfo($_FILES['file-img']['name'][2]);
              $nombrealeatorioimagen3 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
              $carpetaTemproalimagen3=$_FILES['file-img']['tmp_name'][2];
              $carpetadestino ='imagen_publicaciones/';
              $rutaimagen3=$carpetadestino.$nombrealeatorioimagen3;
              move_uploaded_file( $carpetaTemproalimagen3,$rutaimagen3);


              $user->setId($id_user);
              $publicacion->setUsuario($user);
              $publicacion->setTitulo($titulo);
              $publicacion->setDescripcion($descripcion);
              $publicacion->setVisibilidad($visibilidad);
              $publicacion->setFecha($fecha);
              $publicacion->setEstado($estado);
              $publicacion->setImagen1($rutaimagen1);
              $publicacion->setImagen2($rutaimagen2);
              $publicacion->setImagen3($rutaimagen3);
              $publicacion->setPalabraClave1($palabraclave1);
              $publicacion->setPalabraClave2($palabraclave2);
              $publicacion->setPalabraClave3($palabraclave3);
              $publicacion->crearPublicacion(8);

              $this->redirect("muro","renderPublicacion");
              exit;
            }else{
              $this->renderViewParam("muro",array(
                "errorTitulo"=>$errorTitulo,
                "errorDescripcion"=>$errorDescripcion,
                "titulo"=>$titulo,
                "descripcion"=>$descripcion,
                "palabraclave1"=>$palabraclave1,
                "palabraclave2"=>$palabraclave2,
                "palabraclave3"=>$palabraclave3,
                "errorPalabraClave"=>$errorPalabraClave,
                "errorimagen"=>$errorimagen,
                "UsuarioNombre"=>$UsuarioNombre,
                "imagen_perfil"=>$imagen_perfil
              ));
             } 
           }

           if($errorimagen==null && $errorTitulo==null && $errorDescripcion==null){
            ini_set('date.timezone','America/Argentina/Buenos_Aires');
            $timestamp = time();
            $fecha = date("Y-m-d H:i:s ",$timestamp); 
            $user = new Usuario($this->adapter);
            $publicacion = new Post($this->adapter);

            $info = new SplFileInfo($_FILES['file-img']['name'][0]);
            $nombrealeatorioimagen1 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
            $carpetaTemproalimagen1=$_FILES['file-img']['tmp_name'][0];
            $carpetadestino ='imagen_publicaciones/';
            $rutaimagen1=$carpetadestino.$nombrealeatorioimagen1;
            move_uploaded_file($carpetaTemproalimagen1,$rutaimagen1);

            $info = new SplFileInfo($_FILES['file-img']['name'][1]);
            $nombrealeatorioimagen2 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
            $carpetaTemproalimagen2=$_FILES['file-img']['tmp_name'][1];
            $carpetadestino ='imagen_publicaciones/';
            $rutaimagen2=$carpetadestino.$nombrealeatorioimagen2;
            move_uploaded_file($carpetaTemproalimagen2,$rutaimagen2);

            $info = new SplFileInfo($_FILES['file-img']['name'][2]);
            $nombrealeatorioimagen3 = rand (1,10000).chr(rand(ord('a'), ord('z'))).rand (1,10000).'.'.$info->getExtension();
            $carpetaTemproalimagen3=$_FILES['file-img']['tmp_name'][2];
            $carpetadestino ='imagen_publicaciones/';
            $rutaimagen3=$carpetadestino.$nombrealeatorioimagen3;
            move_uploaded_file( $carpetaTemproalimagen3,$rutaimagen3);

              $user->setId($id_user);
              $publicacion->setUsuario($user);
              $publicacion->setTitulo($titulo);
              $publicacion->setDescripcion($descripcion);
              $publicacion->setVisibilidad($visibilidad);
              $publicacion->setFecha($fecha);
              $publicacion->setEstado($estado);
              $publicacion->setImagen1($rutaimagen1);
              $publicacion->setImagen2($rutaimagen2);
              $publicacion->setImagen3($rutaimagen3);
              $publicacion->crearPublicacion(16);

              $this->redirect("muro","renderPublicacion");
              exit;
          }else{

            $this->renderViewParam("muro",array(
              "errorTitulo"=>$errorTitulo,
              "errorDescripcion"=>$errorDescripcion,
              "titulo"=>$titulo,
              "descripcion"=>$descripcion,
              "errorimagen"=>$errorimagen,
              "UsuarioNombre"=>$UsuarioNombre,
              "imagen_perfil"=>$imagen_perfil
            ));

        }
                 break;
              
        }  
              
        }  
  //VALIDAMOS SI HAY UN ADJUNTO YA SE VALIDO QUE VEA UNA IMAGEN O NO
        if($_FILES['adjunto']['name'] != null){
          $booleanAdjunto=true;
          $esArchivo=false;
          $patronperimitido="%\.(zip|txt|rar|ra|xls|pdf|ppt|docx|xlsx)$%i";
           if(preg_match($patronperimitido, $_FILES['adjunto']['name']) == 1)
           {
            $esArchivo=true;
           }
         


           if(!$esArchivo){
              $errorArchivo ='Archivo no permitido para subir';
            } 


            if(!empty($_POST['palabraclave'])){
              $booleanPalabraClave=true;
              if(empty($palabraclave1)||empty($palabraclave2)||empty($palabraclave3))
            {
                 $errorPalabraClave='ingrese las 3 palabras claves';  
              }
          
            }

            if(empty($titulo)){
              $errorTitulo="*ingrese un titulo";
          }
         if(empty($descripcion)){
              $errorDescripcion="*ingrese una descripcion a la publicacion";
           }
            
           if($booleanPalabraClave){

            if($errorArchivo==null && !empty($_POST['palabraclave']) && $errorPalabraClave==null && $errorTitulo==null && $errorDescripcion==null)
             {
              ini_set('date.timezone','America/Argentina/Buenos_Aires');
              $timestamp = time();
              $fecha = date("Y-m-d H:i:s ",$timestamp); 
              $user = new Usuario($this->adapter);
              $publicacion = new Post($this->adapter);

             $nombreArchivo=$_FILES['adjunto']['name'];
             $carpetaTemporalArchivo=$_FILES['adjunto']['tmp_name'];
             $carpetadestino ='Archivos_publicacion/' ;
             $rutaArchivo= $carpetadestino.$nombreArchivo;
             move_uploaded_file($carpetaTemporalArchivo,$rutaArchivo);
             $user->setId($id_user);
             $publicacion->setUsuario($user);
             $publicacion->setTitulo($titulo);
             $publicacion->setDescripcion($descripcion);
             $publicacion->setVisibilidad($visibilidad);
             $publicacion->setFecha($fecha);
             $publicacion->setEstado($estado);
             $publicacion->setAdjunto($rutaArchivo);
             $publicacion->setPalabraClave1($palabraclave1);
             $publicacion->setPalabraClave2($palabraclave2);
             $publicacion->setPalabraClave3($palabraclave3);
             $publicacion->crearPublicacion(4);

             $this->redirect("muro","renderPublicacion");
             exit;
             }else{

              $this->renderViewParam("muro",array(
                "errorTitulo"=>$errorTitulo,
                "errorDescripcion"=>$errorDescripcion,
                "titulo"=>$titulo,
                "descripcion"=>$descripcion,
                "palabraclave1"=>$palabraclave1,
                "palabraclave2"=>$palabraclave2,
                "palabraclave3"=>$palabraclave3,
                "errorPalabraClave"=>$errorPalabraClave,
                "errorArchivo"=>$errorArchivo,
                "UsuarioNombre"=>$UsuarioNombre,
                "imagen_perfil"=>$imagen_perfil
              ));
  
          } 

           }
          
           if($errorArchivo==null && $errorTitulo==null && $errorDescripcion==null){
            ini_set('date.timezone','America/Argentina/Buenos_Aires');
            $timestamp = time();
            $fecha = date("Y-m-d H:i:s ",$timestamp); 
            $user = new Usuario($this->adapter);
            $publicacion = new Post($this->adapter);

           $nombreArchivo=$_FILES['adjunto']['name'];
           $carpetaTemporalArchivo=$_FILES['adjunto']['tmp_name'];
           $carpetadestino ='Archivos_publicacion/' ;
           $rutaArchivo= $carpetadestino.$nombreArchivo;
           move_uploaded_file($carpetaTemporalArchivo,$rutaArchivo);

           $user->setId($id_user);
           $publicacion->setUsuario($user);
           $publicacion->setTitulo($titulo);
           $publicacion->setDescripcion($descripcion);
           $publicacion->setVisibilidad($visibilidad);
           $publicacion->setFecha($fecha);
           $publicacion->setEstado($estado);
           $publicacion->setAdjunto($rutaArchivo);

           $publicacion->crearPublicacion(3);

           $this->redirect("muro","renderPublicacion");
           exit;
           }else{
            $this->renderViewParam("muro",array(
              "errorTitulo"=>$errorTitulo,
              "errorDescripcion"=>$errorDescripcion,
              "titulo"=>$titulo,
              "descripcion"=>$descripcion,
              "errorArchivo"=>$errorArchivo,
              "UsuarioNombre"=>$UsuarioNombre,
              "imagen_perfil"=>$imagen_perfil
            ));


           }
          
          }

        if(!empty($_POST['palabraclave'])){
          $booleanPalabraClave=true;
            if(empty($palabraclave1)||empty($palabraclave2)||empty($palabraclave3))
            {
               $errorPalabraClave='ingrese las 3 palabras claves';  
            }

            if(empty($titulo)){
              $errorTitulo="*ingrese un titulo";
          }
         if(empty($descripcion)){
              $errorDescripcion="*ingrese una descripcion a la publicacion";
           }
 
        if($errorPalabraClave==null && $errorTitulo==null && $errorDescripcion==null){
          ini_set('date.timezone','America/Argentina/Buenos_Aires');
          $timestamp = time();
          $fecha = date("Y-m-d H:i:s ",$timestamp); 
          $user = new Usuario($this->adapter);
          $publicacion = new Post($this->adapter);
          $user->setId($id_user);
          $publicacion->setUsuario($user);
          $publicacion->setTitulo($titulo);
          $publicacion->setDescripcion($descripcion);
          $publicacion->setVisibilidad($visibilidad);
          $publicacion->setFecha($fecha);
          $publicacion->setEstado($estado);
          $publicacion->setPalabraClave1($palabraclave1);
          $publicacion->setPalabraClave2($palabraclave2);
          $publicacion->setPalabraClave3($palabraclave3);
          $publicacion->crearPublicacion(5);

          $this->redirect("muro","renderPublicacion");
          exit;
        }else{
          $this->renderViewParam("muro",array(
            "errorTitulo"=>$errorTitulo,
            "errorDescripcion"=>$errorDescripcion,
            "titulo"=>$titulo,
            "descripcion"=>$descripcion,
            "palabraclave1"=>$palabraclave1,
            "palabraclave2"=>$palabraclave2,
            "palabraclave3"=>$palabraclave3,
            "errorPalabraClave"=>$errorPalabraClave,
            "UsuarioNombre"=>$UsuarioNombre,
            "imagen_perfil"=>$imagen_perfil
          ));

        }

        
          }
       if(!$booleanAdjunto&&!$booleanimagen&&!$booleanPalabraClave){

       
        if(empty($titulo)){
            $errorTitulo="*ingrese un titulo";
        }
       if(empty($descripcion)){
            $errorDescripcion="*ingrese una descripcion a la publicacion";
         }

      if($errorTitulo==null && $errorDescripcion==null){
         ini_set('date.timezone','America/Argentina/Buenos_Aires');
          $timestamp = time();
          $fecha = date("Y-m-d H:i:s ",$timestamp); 
          $user = new Usuario($this->adapter);
          $publicacion = new Post($this->adapter);                            
         
          $user->setId($id_user);
          $publicacion->setUsuario($user);
          $publicacion->setTitulo($titulo);
          $publicacion->setDescripcion($descripcion);
          $publicacion->setVisibilidad($visibilidad);
          $publicacion->setFecha($fecha);
          $publicacion->setEstado($estado);
          $publicacion->crearPublicacion(2);

          $this->redirect("muro","renderPublicacion");
          exit;

         }else{

            $this->renderViewParam("muro",array(
              "errorTitulo"=>$errorTitulo,
              "errorDescripcion"=>$errorDescripcion,
               "titulo"=>$titulo,
               "descripcion"=>$descripcion,
               "UsuarioNombre"=>$UsuarioNombre,
               "imagen_perfil"=>$imagen_perfil
           ));

        }
      }



          }                
          
           
        
   public function renderPublicacion(){
    Session_Start() ;
    
      if(isset($_SESSION['nombre'])){
        $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
        $imagen_perfil=$_SESSION['imagen-perfil']; 
       }else{
        $this->redirect("login","index");
       }
       $id_usuario=$_SESSION['id'];
       $publicacion = new Post($this->adapter); 
       $comentario =  new Comentario($this->adapter);
       $usuario =new Usuario($this->adapter);
       $usuario->setId($id_usuario);
       $relacionesSolicitadasAll= $usuario->optenerRelacionAceptadaSolicitada();
       $relacionesRecibidasAll=$usuario->optenerRelacionAceptadaRecibida();
       $publicacionesPublicas = $publicacion->obtenerPublicacionesPublicas();
       $publicacionesSoloAmigos=$publicacion->obtenerPublicacionesSoloAmigos();
       $comentarioAll=$comentario->obtenerComentario();
       
       $i=0;
       $w=0;
       $j=0;
       $comentarios=null;
       $relacionesSolicitadas=null;
       $relacionesRecibidas=null;
       $numerofilasRelacionesSolicitadas=$relacionesSolicitadasAll->num_rows;
       $numerosfilasRelacionesRecibidas=$relacionesRecibidasAll->num_rows;
       $numerosfilasComentarios=$comentarioAll->num_rows;
       if($numerosfilasComentarios>0){
        while($row=$comentarioAll->fetch_object()){
          $comentarios[$i]=$row;
          $i++;
       }
       }
       if($numerofilasRelacionesSolicitadas>0){
         while($rowS=$relacionesSolicitadasAll->fetch_object()){
        $relacionesSolicitadas[$w]=$rowS;
        $w++;
       }
       
     }
     if($numerosfilasRelacionesRecibidas>0){
      while($rowR=$relacionesRecibidasAll->fetch_object()){
      $relacionesRecibidas[$j]=$rowR;
      $j++;
     }
     
   }
    
      $this->renderViewParam("muro",array(
        "relacionesSolicitadas"=>$relacionesSolicitadas,
        "relacionesRecibidas"=>$relacionesRecibidas,
        "publicacionesSoloAmigos"=>$publicacionesSoloAmigos,
       "publicacionesPublicas"=>$publicacionesPublicas,
       "comentarios"=>$comentarios,
       "UsuarioNombre"=>$UsuarioNombre,
       "id_usuario"=> $id_usuario,
        "imagen_perfil"=>$imagen_perfil
      ));


   }

public function CrearComentario(){

     
  Session_Start() ;
    
  if(isset($_SESSION['nombre'])){
    $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
    $imagen_perfil=$_SESSION['imagen-perfil']; 
   }else{
    $this->redirect("login","index");
   }
   
   $descripcion=$_POST['comentario'];
   $id_usuario=$_SESSION['id'];
   $id_publicacion=$_POST['idPublicacion'];
   $estado="activo";
   ini_set('date.timezone','America/Argentina/Buenos_Aires');
   $timestamp = time();
   $fecha = date("Y-m-d H:i:s ",$timestamp);
   
   if(empty($descripcion)){
    $this->redirect("muro","renderPublicacion");
  }else{
   
   
   $user = new Usuario($this->adapter);
   $publicacion = new Post($this->adapter);
   $comentario = new Comentario($this->adapter);
   $user->setId($id_usuario);
   $publicacion->setId($id_publicacion);
   $comentario->setUsuario($user);
   $comentario->setPublicacion($publicacion);
   $comentario->setDescripcion($descripcion);
   $comentario->setEstado($estado);
   $comentario->setFecha($fecha);

   
   $comentario->CrearComentario();
   $this->redirect("muro","renderPublicacion");

  }}
  

  public function CrearDenuncia(){
      
    Session_Start() ;
    
      if(isset($_SESSION['nombre'])){
        $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
      
       }else{
        $this->redirect("login","index");
       }

      $tipoDenuncia=$_POST['tipo_denuncia'];
      $Motivo=$_POST['motivo'];
      if(isset($Motivo)){
        if($tipoDenuncia==='comentario'){
          ini_set('date.timezone','America/Argentina/Buenos_Aires');
          $timestamp = time();
          $fecha = date("Y-m-d H:i:s ",$timestamp);
          $estado='activo';
          $id_comentario=$_POST['id_comentario_denunciar'];
          $comentario= new Comentario($this->adapter);
          $user= new Usuario($this->adapter);
          $denuncia=new Denuncia($this->adapter,'comentario');


          $comentario->setId($id_comentario);
          $user->setId($_SESSION['id']);
          $denuncia->setIdDenuncia($comentario);
          $denuncia->setUsuario($user);
          $denuncia->setMotivo($Motivo);
          $denuncia->setEstado($estado);
          $denuncia->setFecha($fecha);

          $denuncia->crearDenunciaComentario();

          $this->redirect("muro","renderPublicacion");
        }else{
          ini_set('date.timezone','America/Argentina/Buenos_Aires');
          $timestamp = time();
          $fecha = date("Y-m-d H:i:s ",$timestamp);
          $estado='activo';
          $id_publicacion=$_POST['id_publicacion_denunciar'];
          $publicacion= new Post($this->adapter);
          $user= new Usuario($this->adapter);
          $denuncia=new Denuncia($this->adapter,'publicacion');

          $publicacion->setId($id_publicacion);
          $user->setId($_SESSION['id']);
          $denuncia->setIdDenuncia($publicacion);
          $denuncia->setUsuario($user);
          $denuncia->setMotivo($Motivo);
          $denuncia->setEstado($estado);
          $denuncia->setFecha($fecha);

          $denuncia->crearDenunciaPost();

          $this->redirect("muro","renderPublicacion");

         
        }

      }else{
        $this->redirect("muro","renderPublicacion");
      }

      
     

  }


  public function buscarPublicacion(){

    Session_Start() ;
    
    if(isset($_SESSION['nombre'])){
      $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
      $imagen_perfil=$_SESSION['imagen-perfil']; 
     }else{
      $this->redirect("login","index");
     }

     $rows=null;
     $publicacionesBuscada=null;

     if(isset($_POST['titulo']) &&  !empty($_POST['buscarpost']) ){

          if(isset($_POST['palabraclave'])){
         
            if(isset($_POST['rangofecha']) && !empty($_POST['diaD']) && !empty($_POST['mesD']) && !empty($_POST['añoD'])&& !empty($_POST['diaH']) && !empty($_POST['mesH']) && !empty($_POST['añoH'])){
            
              $palabraABuscar=$_POST['buscarpost'];
              $fechaDesde=$_POST['añoD'].'-'.$_POST['mesD'].'-'.$_POST['diaD'];
              $fechaHasta=$_POST['añoH'].'-'.$_POST['mesH'].'-'.$_POST['diaH'];
              $publicacion= new Post($this->adapter);
              $comentario =  new Comentario($this->adapter);
              $comentarioAll=$comentario->obtenerComentario();
              $id_usuario= $_SESSION['id'];
              $i=0;
              while($row=$comentarioAll->fetch_object()){
                 $comentarios[$i]=$row;
                 $i++;
              }
              
              $publicacion->setTitulo($palabraABuscar);
              $publicacion->setPalabraClave1($palabraABuscar);
              $publicacion->setPalabraClave2($palabraABuscar);
              $publicacion->setPalabraClave3($palabraABuscar);
              $publicacion->setFecha($fechaDesde);
              $publicacion->setFechaAux($fechaHasta);

              $publicacionesBuscada=$publicacion->buscarPost(3);

              $rows=$publicacionesBuscada->num_rows;

              if($rows>0){
               $this->renderViewParam("muro",array(
                "publicacionesBuscada"=>$publicacionesBuscada,
                "comentarios"=>$comentarios,
                "UsuarioNombre"=>$UsuarioNombre,
                "id_usuario"=> $id_usuario,
                "palabraABuscar" =>$palabraABuscar,
                "rows"=>$rows,
                 "imagen_perfil"=>$imagen_perfil 
               ));
               exit;
              }else{
                $this->redirect("muro","renderPublicacion");
                exit;
              }


            }

            $palabraABuscar=$_POST['buscarpost'];
            $publicacion= new Post($this->adapter);
                $comentario =  new Comentario($this->adapter);
                $comentarioAll=$comentario->obtenerComentario();
                $id_usuario= $_SESSION['id'];
                $i=0;
                while($row=$comentarioAll->fetch_object()){
                   $comentarios[$i]=$row;
                   $i++;
                }
                $publicacion->setTitulo($palabraABuscar);
                $publicacion->setPalabraClave1($palabraABuscar);
                $publicacion->setPalabraClave2($palabraABuscar);
                $publicacion->setPalabraClave3($palabraABuscar);
  
                $publicacionesBuscada=$publicacion->buscarPost(2);
  
                $rows=$publicacionesBuscada->num_rows;
  
                if($rows>0){
                 $this->renderViewParam("muro",array(
                  "publicacionesBuscada"=>$publicacionesBuscada,
                  "comentarios"=>$comentarios,
                  "UsuarioNombre"=>$UsuarioNombre,
                  "id_usuario"=> $id_usuario,
                  "palabraABuscar" =>$palabraABuscar,
                  "rows"=>$rows,
                  "imagen_perfil"=>$imagen_perfil 
                 ));
                 exit;
                }else{
                  $this->redirect("muro","renderPublicacion");
                  exit;
                }

        
          }
          

         $palabraABuscar=$_POST['buscarpost'];
         $publicacion= new Post($this->adapter);
         $comentario =  new Comentario($this->adapter);
         $comentarioAll=$comentario->obtenerComentario();
         $id_usuario= $_SESSION['id'];
         $i=0;
         while($row=$comentarioAll->fetch_object()){
            $comentarios[$i]=$row;
            $i++;
         }
         $publicacion->setTitulo($palabraABuscar);
         
         $publicacionesBuscada=$publicacion->buscarPost(1);

         $rows=$publicacionesBuscada->num_rows;

         if($rows>0){
          $this->renderViewParam("muro",array(
           "publicacionesBuscada"=>$publicacionesBuscada,
           "comentarios"=>$comentarios,
           "UsuarioNombre"=>$UsuarioNombre,
           "id_usuario"=> $id_usuario,
           "imagen_perfil"=>$imagen_perfil 
           
          ));
          exit;
         }else{
           $this->redirect("muro","renderPublicacion");
           exit;
         } 

     }
     if(isset($_POST['palabraclave'])&& !empty($_POST['buscarpost']))
          {
            if(isset($_POST['rangofecha']) && !empty($_POST['diaD']) && !empty($_POST['mesD']) && !empty($_POST['añoD'])&& !empty($_POST['diaH']) && !empty($_POST['mesH']) && !empty($_POST['añoH']))
            {
              $palabraABuscar=$_POST['buscarpost'];
              $fechaDesde=$_POST['añoD'].'-'.$_POST['mesD'].'-'.$_POST['diaD'];
              $fechaHasta=$_POST['añoH'].'-'.$_POST['mesH'].'-'.$_POST['diaH'];
              $publicacion= new Post($this->adapter);
              $comentario =  new Comentario($this->adapter);
              $comentarioAll=$comentario->obtenerComentario();
              $id_usuario= $_SESSION['id'];
              $i=0;
              while($row=$comentarioAll->fetch_object()){
                 $comentarios[$i]=$row;
                 $i++;
              }
              
              $publicacion->setPalabraClave1($palabraABuscar);
              $publicacion->setPalabraClave2($palabraABuscar);
              $publicacion->setPalabraClave3($palabraABuscar);
              $publicacion->setFecha($fechaDesde);
              $publicacion->setFechaAux($fechaHasta);

              $publicacionesBuscada=$publicacion->buscarPost(6);

              $rows=$publicacionesBuscada->num_rows;

              if($rows>0){
               $this->renderViewParam("muro",array(
                "publicacionesBuscada"=>$publicacionesBuscada,
                "comentarios"=>$comentarios,
                "UsuarioNombre"=>$UsuarioNombre,
                "id_usuario"=> $id_usuario,
                "palabraABuscar" =>$palabraABuscar,
                "rows"=>$rows,
                "imagen_perfil"=>$imagen_perfil 
               ));
               exit;
              }else{
                $this->redirect("muro","renderPublicacion");
                exit;
              }


            }

                $palabraABuscar=$_POST['buscarpost'];
                $publicacion= new Post($this->adapter);
                $comentario =  new Comentario($this->adapter);
                $comentarioAll=$comentario->obtenerComentario();
                $id_usuario= $_SESSION['id'];
                $i=0;
                while($row=$comentarioAll->fetch_object()){
                   $comentarios[$i]=$row;
                   $i++;
                }
                
                $publicacion->setPalabraClave1($palabraABuscar);
                $publicacion->setPalabraClave2($palabraABuscar);
                $publicacion->setPalabraClave3($palabraABuscar);
  
                $publicacionesBuscada=$publicacion->buscarPost(5);
  
                $rows=$publicacionesBuscada->num_rows;
  
                if($rows>0){
                 $this->renderViewParam("muro",array(
                  "publicacionesBuscada"=>$publicacionesBuscada,
                  "comentarios"=>$comentarios,
                  "UsuarioNombre"=>$UsuarioNombre,
                  "id_usuario"=> $id_usuario,
                  "palabraABuscar" =>$palabraABuscar,
                  "rows"=>$rows,
                  "imagen_perfil"=>$imagen_perfil 
                 ));
                 exit;
                }else{
                  $this->redirect("muro","renderPublicacion");
                  exit;
                }




         }
   
         if(isset($_POST['rangofecha']) && !empty($_POST['diaD']) && !empty($_POST['mesD']) && !empty($_POST['añoD'])&& !empty($_POST['diaH']) && !empty($_POST['mesH']) && !empty($_POST['añoH']))
         {
           $palabraABuscar=$_POST['buscarpost'];
           $fechaDesde=$_POST['añoD'].'-'.$_POST['mesD'].'-'.$_POST['diaD'];
           $fechaHasta=$_POST['añoH'].'-'.$_POST['mesH'].'-'.$_POST['diaH'];
           $publicacion= new Post($this->adapter);
           $comentario =  new Comentario($this->adapter);
           $comentarioAll=$comentario->obtenerComentario();
           $id_usuario= $_SESSION['id'];
           $i=0;
           while($row=$comentarioAll->fetch_object()){
              $comentarios[$i]=$row;
              $i++;
           }
           
           $publicacion->setFecha($fechaDesde);
           $publicacion->setFechaAux($fechaHasta);

           $publicacionesBuscada=$publicacion->buscarPost(7);

           $rows=$publicacionesBuscada->num_rows;

           if($rows>0){
            $this->renderViewParam("muro",array(
             "publicacionesBuscada"=>$publicacionesBuscada,
             "comentarios"=>$comentarios,
             "UsuarioNombre"=>$UsuarioNombre,
             "id_usuario"=> $id_usuario,
             "palabraABuscar" =>$palabraABuscar,
             "rows"=>$rows,
             "imagen_perfil"=>$imagen_perfil 
              
            ));
            exit;
           }else{
             $this->redirect("muro","renderPublicacion");
             exit;
           }

          }
          
          $this->redirect("muro","renderPublicacion");
          exit;

     }
   


     public function renderUserBusqueda(){
      Session_Start() ;
    
      if(isset($_SESSION['nombre'])){
        $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
        $imagen_perfil=$_SESSION['imagen-perfil'];
       }else{
        $this->redirect("login","index");
       }

      if(!empty($_POST['nombreBuscador'])){
         
        
        $nombre=$_POST['nombreBuscador'];
        $usuario=new Usuario($this->adapter);
        $usuario->setNombre($nombre);
        $usuario->setApellido($nombre);
 
        $rowsUsuarios = $usuario->BuscarUsuarioPorNombre();
        $numerosDeFilas=$rowsUsuarios->num_rows;

        if($numerosDeFilas>0){
          
          $this->renderViewParam("murobusqueda",array(
            
             "rowsUsuarios"=>$rowsUsuarios,
             "UsuarioNombre"=>$UsuarioNombre,
             "imagen_perfil"=>$imagen_perfil
           ));

        }else{
          $mensaje="NO se encontro ningun Usuarios :(";
          $this->renderViewParam("murobusqueda",array(
            "mensaje"=>$mensaje,
            "UsuarioNombre"=>$UsuarioNombre,
            "imagen_perfil"=>$imagen_perfil
           ));

        }



      }else{

        $this->redirect("muro","renderPublicacion");

      }



     }

    public function mostrarRelaciones(){

      Session_Start() ;
    
      if(isset($_SESSION['nombre'])){
        $UsuarioNombre= $_SESSION['nombre']." ".$_SESSION['apellido'];
        $imagen_perfil=$_SESSION['imagen-perfil'];
       }else{
        $this->redirect("login","index");
       }

       $id=$_SESSION['id'];
       $user=new Usuario($this->adapter);
       $user->setId($id);
       $relaciones=$user->BuscarRelaciones('pendiente');

       $row=$relaciones->num_rows;

       if($row>0){

        $this->renderViewParam("murobusqueda",array(
          "relaciones"=>$relaciones,
          "UsuarioNombre"=>$UsuarioNombre,
          "imagen_perfil"=>$imagen_perfil
         ));

       }else{
          $alerta='no tienes Solicitudes :(';
          $this->renderViewParam("murobusqueda",array(
            "alerta"=>$alerta,
            "UsuarioNombre"=>$UsuarioNombre,
            "imagen_perfil"=>$imagen_perfil
           ));


       }


       }


 







    }




    
