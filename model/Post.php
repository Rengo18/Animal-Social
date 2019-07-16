<?php
class Post extends EntidadBase{
    private $id;
    private $usuario;
    private $titulo;
    private $estado;
    private $adjunto;
    private $palabraClave1;
    private $palabraClave2;
    private $palabraClave3;
    private $imagen1;
    private $imagen2;
    private $imagen3;
    private $visibilidad;
    private $descripcion;
    private $fecha;
    private $fechaAux;

    public function __construct($adapter) {
        $table="post";
        parent::__construct($table, $adapter);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function getAdjunto() {
        return $this->adjunto;
    }

    public function setAdjunto($adjunto) {
        $this->adjunto = $adjunto;
    }

    public function getPalabraClave1() {
        return $this->palabraClave1;
    }

    public function setPalabraClave1($palabraClave1) {
        $this->palabraClave1 = $palabraClave1;
    }
    public function getPalabraClave2() {
        return $this->palabraClave2;
    }

    public function setPalabraClave2($palabraClave2) {
        $this->palabraClave2 = $palabraClave2;
    }
    public function getPalabraClave3() {
        return $this->palabraClave3;
    }

    public function setPalabraClave3($palabraClave3) {
        $this->palabraClave3 = $palabraClave3;
    }
    public function getImagen1() {
        return $this->imagen1;
    }

    public function setImagen1($imagen1) {
        $this->imagen1 = $imagen1;
    }
    public function getImagen2() {
        return $this->imagen2;
    }

    public function setImagen2($imagen2) {
        $this->imagen2 = $imagen2;
    }

    public function getImagen3() {
        return $this->imagen3;
    }

    public function setImagen3($imagen3) {
        $this->imagen3 = $imagen3;
    }
    public function getVisibilidad() {
        return $this->visibilidad;
    }

    public function setVisibilidad($visibilidad) {
        $this->visibilidad = $visibilidad;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    public function getFechaAux() {
        return $this->fechaAux;
    }

    public function setFechaAux($fechaAux) {
        $this->fechaAux = $fechaAux;
    }



    public  function crearPublicacion($numero){
         require_once "Usuario.php";
         
         switch($numero){
             case 1:
                $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`imagen1`, `visibilidad`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado', ".$this->usuario->getId().",'$this->imagen1','$this->visibilidad')";
                 break;
              case 2:
                $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad')";
                 break;
             case 3:
                 $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`adjunto`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->adjunto')";
                break;
              
              case 4:
                 $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`adjunto`, `palabra_clave_1`,`palabra_clave_2`,`palabra_clave_3`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->adjunto','$this->palabraClave1','$this->palabraClave2','$this->palabraClave3')";
                break;
             
              case 5:
                 $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`palabra_clave_1`,`palabra_clave_2`,`palabra_clave_3`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->palabraClave1','$this->palabraClave2','$this->palabraClave3')";
               break;
               case 6:
                 $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`palabra_clave_1`,`palabra_clave_2`,`palabra_clave_3`,`imagen1`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->palabraClave1','$this->palabraClave2','$this->palabraClave3','$this->imagen1')";
                break;
                case 7:
                 $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`palabra_clave_1`,`palabra_clave_2`,`palabra_clave_3`,`imagen1`,`imagen2`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->palabraClave1','$this->palabraClave2','$this->palabraClave3','$this->imagen1','$this->imagen2')";
                break;
                case 8:
                 $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`palabra_clave_1`,`palabra_clave_2`,`palabra_clave_3`,`imagen1`,`imagen2`,`imagen3`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->palabraClave1','$this->palabraClave2','$this->palabraClave3','$this->imagen1','$this->imagen2','$this->imagen3')";
                break;
                case 9:
                 $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`palabra_clave_1`,`palabra_clave_2`,`palabra_clave_3`,`adjunto`,`imagen1`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->palabraClave1','$this->palabraClave2','$this->palabraClave3','$this->adjunto','$this->imagen1')";
                break;
                case 10:
                $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`palabra_clave_1`,`palabra_clave_2`,`palabra_clave_3`,`adjunto`,`imagen1`,`imagen2`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->palabraClave1','$this->palabraClave2','$this->palabraClave3','$this->adjunto','$this->imagen1','$this->imagen2')";
                 break;
                case 11:
                 $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`palabra_clave_1`,`palabra_clave_2`,`palabra_clave_3`,`adjunto`,`imagen1`,`imagen2`,`imagen3`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->palabraClave1','$this->palabraClave2','$this->palabraClave3','$this->adjunto','$this->imagen1','$this->imagen2','$this->imagen3')";
                  break;
                case 12:
                $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`adjunto`,`imagen1`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->adjunto','$this->imagen1')";
                break;
                case 13:
               $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`adjunto`,`imagen1`,`imagen2`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->adjunto','$this->imagen1','$this->imagen2')";
               break;
               case 14:
                $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`visibilidad`,`adjunto`,`imagen1`,`imagen2`,`imagen3`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado',".$this->usuario->getId().",'$this->visibilidad','$this->adjunto','$this->imagen1','$this->imagen2','$this->imagen3')";
               break;
               case 15:
               $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`imagen1`,`imagen2`, `visibilidad`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado', ".$this->usuario->getId().",'$this->imagen1','$this->imagen2','$this->visibilidad')";
               break;
               case 16:
               $query="INSERT INTO `post`(`descripcion`, `fecha`, `titulo`, `estado`,`id_usuario`,`imagen1`,`imagen2`,`imagen3`, `visibilidad`) VALUES ('$this->descripcion','$this->fecha','$this->titulo','$this->estado', ".$this->usuario->getId().",'$this->imagen1','$this->imagen2','$this->imagen3','$this->visibilidad')";
               break;
            }       
            
         $save=$this->db()->query($query);
          
         return $save;


        
         
         
          
    }


     public function obtenerPublicacionesPublicas(){

        $query="SELECT * FROM post p,usuario u WHERE p.id_usuario=u.id_usuario AND visibilidad='publico' ORDER by fecha DESC";
          
        $save=$this->db()->query($query);
          
        return $save;

     }

     public function obtenerPublicacionesSoloAmigos(){
        $query="SELECT * FROM post p,usuario u WHERE p.id_usuario=u.id_usuario AND visibilidad='SoloAmigos' ORDER by fecha DESC";
          
        $save=$this->db()->query($query);
          
        return $save;
     }


     public function buscarPost($numero){

         switch ($numero) {
             case 1:
                $query="SELECT * FROM post p,usuario u WHERE p.id_usuario=u.id_usuario AND titulo LIKE '%$this->titulo%'";
                 break;
             case 2:
                $query="SELECT * FROM  post p,usuario u  WHERE p.id_usuario=u.id_usuario AND titulo LIKE '%$this->titulo%' OR palabra_clave_1 like  '%$this->palabraClave1%' OR palabra_clave_2 LIKE '%$this->palabraClave2%' or palabra_clave_3 LIKE '%$this->palabraClave3%'";
                 break;
             case 3:
                $query="SELECT * FROM  post p,usuario u  WHERE p.id_usuario=u.id_usuario AND titulo like '%$this->titulo%' OR palabra_clave_1 like  '%$this->palabraClave1%' OR palabra_clave_2 LIKE '%$this->palabraClave2%' or palabra_clave_3 LIKE '%$this->palabraClave3%' or fecha BETWEEN '$this->fecha' AND '$this->fechaAux'";
                 break;
             case 4:
                $query="SELECT * FROM  post p,usuario u  WHERE p.id_usuario=u.id_usuario AND titulo like '%$this->titulo%' OR fecha BETWEEN '$this->fecha' AND '$this->fechaAux' ";
                 break;
             case 5:
                $query="SELECT * FROM  post p,usuario u  WHERE p.id_usuario=u.id_usuario AND palabra_clave_1 like  '%$this->palabraClave1%' OR palabra_clave_2 LIKE '%$this->palabraClave2%' OR palabra_clave_3 LIKE '%$this->palabraClave3%' ";
                 break;
             case 6:
                $query="SELECT * FROM  post p,usuario u  WHERE p.id_usuario=u.id_usuario AND palabra_clave_1 like  '%$this->palabraClave1%' OR palabra_clave_2 LIKE '%$this->palabraClave2%' or palabra_clave_3 LIKE '%$this->palabraClave3%' OR fecha BETWEEN '$this->fecha' AND '$this->fechaAux' ";
                 break;
             case 7:
                $query="SELECT * FROM  post p,usuario u  WHERE p.id_usuario=u.id_usuario AND fecha BETWEEN '$this->fecha' AND '$this->fechaAux' ";
                 break;
         }

         $save=$this->db()->query($query);
          
         return $save;

     }

     public function buscarPublicacionesPorId($id){

        $query="SELECT * FROM post p,usuario u WHERE p.id_usuario=u.id_usuario AND p.id_usuario='$id'";
    
        $save=$this->db()->query($query);
              
        return $save;
       }


}