<?php 
	
	class DashboardModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
			
		}
		public function getClientes(){
			$sql = "SELECT * FROM estadisiticascliente";
			return $this->select($sql);
		}
		public function getPendientes(){
			$sql = "SELECT * FROM ventaspendientes";
			return $this->select($sql);
		}
		public function getReady(){
			$sql = "SELECT * FROM ventas";
			return $this->select($sql);
		}
			public function getEmpleados(){
			$sql = "SELECT * FROM estadisticasempleados";
			return $this->select($sql);
		}
	}
 ?>