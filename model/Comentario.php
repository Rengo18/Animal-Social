<?php
class Comentario extends EntidadBase{
    private $id;
    private $usuario;
    private $publicacion;
    private $descripcion;
    private $estado;
    private $fecha;
    

    public function __construct($adapter) {
        $table="comentario";
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
    public function getPublicacion() {
        return $this->publicacion;
    }

    public function setPublicacion($publicacion) {
        $this->publicacion = $publicacion;
    }
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }


    public function CrearComentario(){
        require_once "Usuario.php";
        require_once "Post.php";

         $query="CALL CrearComentario(".$this->usuario->getId().",".$this->publicacion->getId().",'$this->descripcion','$this->fecha','$this->estado')";


        $save=$this->db()->query($query);
          
         return $save;
    }

    public function obtenerComentario(){
 
         $query="SELECT * FROM comentario c,usuario u WHERE u.id_usuario=c.id_usuario ";
         $save=$this->db()->query($query);
          
        return $save;


    }

}