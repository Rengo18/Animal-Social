<?php
class Denuncia extends EntidadBase{
    private $id;
    private $id_denuncia;
    private $usuario;
    private $motivo;
    private $estado;
    private $fecha;
    private $moderador;
    private $fechaModeracion;
    

    public function __construct($adapter,$tipoDenuncia) {
        if($tipoDenuncia=='publicacion'){
            $table="denuncia_post";
        }else{
            $table="denuncia_comentario";
        }
        
        parent::__construct($table, $adapter);
    }


    public function getIdDenuncia() {
        return $this->id_denuncia;
    }

    public function setIdDenuncia($id_denuncia) {
        $this->id_denuncia = $id_denuncia;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    public function getMotivo() {
        return $this->motivo;
    }

    public function setMotivo($motivo) {
        $this->motivo = $motivo;
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
    public function getModerador() {
        return $this->moderador;
    }

    public function setModerador($moderador) {
        $this->moderador = $moderador;
    }public function getFechaModeracion() {
        return $this->fechaModeracion;
    }

    public function setFechaModeracion($fechaModeracion) {
        $this->fechaModeracion = $fechaModeracion;
    }


public function crearDenunciaPost(){
    require_once "Post.php";


    $query="CALL CrearDenunciaPost(".$this->id_denuncia->getId().",".$this->usuario->getId().",'$this->fecha','$this->motivo','$this->estado')";

    $save=$this->db()->query($query);
          
    return $save;

}


public function crearDenunciaComentario(){
    require_once "Comentario.php";


    $query="CALL CrearDenunciaComentario(".$this->id_denuncia->getId().",".$this->usuario->getId().",'$this->fecha','$this->motivo','$this->estado')";

    $save=$this->db()->query($query);
          
    return $save;

}


}