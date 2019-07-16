<?php
class EntidadBase{
    private $table;
    private $db;
    private $conectar;

    public function __construct($table, $adapter) {
        $this->table=(string) $table;
        
        require_once 'Conectar.php';
        $this->conectar=new Conectar();
        $this->db=$this->conectar->conexion();
		 
		$this->conectar = null;
		$this->db = $adapter;
    }
    
    
    public function db(){
        return $this->db;
    }
    
    
    
}
?>
