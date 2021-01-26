<?php
class Conexion{
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $db = "prontomueble";
	private $conect;

	public function __construct(){
		$connectionString = "mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
		try{
		    //$this->conect = new PDO($connectionString, $this->user, $this->password,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			//
			$this->conect = new PDO($connectionString, $this->user, $this->password);
			$this->conect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    //echo "conexión exitosa";
		}catch(PDOException $e){
			$this->conect = 'Error de conexión';
		    echo "ERROR: " . $e->getMessage();
		}
	}

	public function conect(){
		return $this->conect;
	}
}

?>