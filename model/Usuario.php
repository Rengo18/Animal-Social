<?php
class Usuario extends EntidadBase{
    private $id;
    private $id_Aux;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $nickname;
    private $estado;
    private $sexo;
    private $telefono;
    private $fechanacimiento;
    private $fechaalta;
    private $imagenPerfil;
    
    public function __construct($adapter) {
        $table="usuario";
        parent::__construct($table, $adapter);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }
    public function getId_Aux() {
        return $this->id_Aux;
    }

    public function setId_Aux($id_Aux) {
        $this->id_Aux = $id_Aux;
    }
    
    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }
    public function getNickname() {
        return $this->nickname;
    }

    public function setNickname($nickname) {
        $this->nickname = $nickname;
    }
    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    public function getFechaAlta() {
        return $this->fechaalta;
    }

    public function setFechaAlta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }
    public function getFechaNacimiento() {
        return $this->fechanacimiento;
    }

    public function setFechaNacimiento($fechanacimiento) {
        $this->fechanacimiento = $fechanacimiento;
    }
    public function getImagenPerfil() {
        return $this->imagenPerfil;
    }

    public function setImagenPerfil($imagenPerfil) {
        $this->imagenPerfil = $imagenPerfil;
    }



     public function Registrar(){

        $query= "SELECT agregarUsuario('$this->nickname','$this->password','$this->estado','$this->nombre','$this->apellido','$this->sexo','$this->email','$this->telefono','$this->fechanacimiento','$this->fechaalta','$this->imagenPerfil') ";
			
			$save=$this->db()->query($query);
			//$this->db()->error;
            $resultado=$save->fetch_array();
            
          return $resultado;



     }

     public function ValidarUsario($tipo){
         if($tipo=='usuario'){
             $query="SELECT * FROM `usuario` WHERE BINARY nickname LIKE '$this->nickname'";
         }elseif($tipo=="moderador"){
             
            $query="SELECT * FROM `moderador` WHERE BINARY nickname LIKE '$this->nickname'";
         }else{

            $query="SELECT * FROM `administrador` WHERE BINARY nickname LIKE '$this->nickname'";
         }
        

        $save=$this->db()->query($query);
          
         return $save;
     }
    
     public function buscarUsuario($id){


        $query="SELECT * FROM usuario WHERE id_usuario='$id';";

        $save=$this->db()->query($query);
          
        return $save;

     }
    
      public function BuscarUsuarioPorNombre(){

      $query="SELECT * FROM `usuario` WHERE nombre LIKE '%$this->nombre%' or apellido LIKE '%$this->apellido%' ";
      
      $save=$this->db()->query($query);
          
      return $save;


      }


      public function CrearRelacion(){

        $query="CALL CrearRelacion('$this->id','$this->id_Aux','$this->fechaalta','$this->estado' )";

        $save=$this->db()->query($query);
          
        return $save;

      }

    public  function BuscarRelaciones($estado){

         if($estado=='pendiente'){

            $query="SELECT * FROM relacion r,usuario u WHERE r.id_usuario_recibe = '$this->id'  AND r.estado ='pendiente' AND r.id_usuario_solicita=u.id_usuario;";


         }elseif($estado=='aceptada'){

          $query="SELECT * FROM `relacion` WHERE id_usuario_recibe = '$this->id' AND id_usuario_solicita = '$this->id'  AND estado='aceptada'";

         }else{
            
            $query="SELECT * FROM `relacion` WHERE id_usuario_recibe = '$this->id' AND id_usuario_solicita = '$this->id'  AND estado='cancelada'";

         }
         
         $save=$this->db()->query($query);
          
         return $save;

     }

     public function AceptarOCancelarRelacion($estado){
        
        if($estado=='aceptar'){
            $query="UPDATE `relacion` SET estado ='aceptada' WHERE id_usuario_solicita='$this->id_Aux' AND id_usuario_recibe= '$this->id';";
            $save=$this->db()->query($query);
          
            return $save;
        }else{

            $query="UPDATE `relacion` SET estado ='cancelada' WHERE id_usuario_solicita='$this->id_Aux' AND id_usuario_recibe= '$this->id';";
            $save=$this->db()->query($query);
          
            return $save;
        }


     }

    public  function optenerRelacionAceptadaSolicitada(){

     $query="SELECT * FROM `relacion` WHERE id_usuario_solicita='$this->id' AND estado='aceptada';";
     $save=$this->db()->query($query);
          
      return $save;



    }

    public function optenerRelacionAceptadaRecibida(){

        $query="SELECT * FROM `relacion` WHERE id_usuario_recibe='$this->id' AND estado='aceptada';";
        $save=$this->db()->query($query);
             
         return $save;

    }

    public function editarPerfil(){


      $query="UPDATE `usuario` SET `imagen_perfil`='$this->imagenPerfil' WHERE id_usuario='$this->id' ";
      $save=$this->db()->query($query);
             
      return $save;


    }


}
?>