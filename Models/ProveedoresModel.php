<?php 

	class ProveedoresModel extends Mysql
	{
	private $Id;
	private $Nombre; 
	private $Direccion;
	private $Fijo;
	private $Celular;
	private $Contacto; 
	private $Email;
	private $intStatus;
		public function __construct()
		{
			parent::__construct();
		}

		public function selectProveedores(){
			$sql = "SELECT Prov_ID,
					Prov_Nom,
					Prov_Dir,
					Prov_Fijo,
					Prov_Status,
					Prov_Email		
					FROM proveedor 
					WHERE Prov_Status != 0 ";
					$request = $this->select_all($sql);
			return $request;
			}
		public function insertProveedor($nombre,$direccion,$fijo,$celular,$contacto,$email,int $status){
			$this->Nombre = $nombre;
			$this->Direccion = $direccion;
			$this->Fijo = $fijo;
			$this->Celular = $celular;
			$this->Contacto = $contacto;
			$this->Email = $email;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM proveedor WHERE Prov_Nom = '{$this->Nombre}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO proveedor(Prov_Nom,
														Prov_Dir,
														Prov_Fijo,
														Prov_Cel,
														Prov_Contacto,
														Prov_Email,
														Prov_Status) 
								  VALUES(?,?,?,?,?,?,?)";
	        	$arrData = array($this->Nombre,
        						$this->Direccion,
        						$this->Fijo,
        						$this->Celular,
        						$this->Contacto,
        						$this->Email,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}
public function updateProveedor(int $idproveedor,$nombre,$direccion,$fijo,$celular,$contacto,$email, int $status){
			$this->Id=$idproveedor;
			$this->Nombre = $nombre;
			$this->Direccion = $direccion;
			$this->Fijo = $fijo;
			$this->Celular = $celular;
			$this->Contacto = $contacto;
			$this->Email = $email;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM proveedor WHERE Prov_Nom = '{$this->Nombre}' AND Prov_ID != $this->Id ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE proveedor 
						SET 
							Prov_Nom=?,
							Prov_Dir=?,
							Prov_Fijo=?,
							Prov_Cel=?,
							Prov_Contacto=?,
							Prov_Email=?,
							Prov_Status=? 
						WHERE Prov_ID = $this->Id ";
				$arrData = array($this->Nombre,
        						$this->Direccion,
        						$this->Fijo,
        						$this->Celular,
        						$this->Contacto,
        						$this->Email,
        						$this->intStatus);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
			}else{
				$return = "exist";
			}
	        return $return;
		}
		public function selectProveedor(int $idproveedor){
			$this->Id = $idproveedor;
			$sql = "SELECT *
					FROM proveedor 
					WHERE Prov_ID = $this->Id";
			$sql2 = "SELECT Cat_Nom 
                 FROM  prod_cat
		             WHERE Cat_ID IN(SELECT Cat_ID
					        FROM envio 
						       WHERE Env_Cant>0 AND Prov_ID IN (
										SELECT Prov_ID
											FROM proveedor
												WHERE Prov_ID=$this->Id))";
			$sql3 =  "SELECT Env_Cant FROM envio WHERE Prov_ID=$this->Id";
			$request = $this->select($sql);
		    array_push($request,$this->select($sql2));
			array_push($request,$this->select($sql3));
			return $request;
			}
			public function deleteProveedor(int $idproveedor){
			$this->Id= $idproveedor;
			$sql = "DELETE FROM proveedor WHERE Prov_ID = $this->Id ";
			$arrData = array(0);
			$request = $this->delete($sql,$arrData);
			return $request;
		}
     public function insertEnvio($idprov,$cat,$cant){
     		$return = 0;
			$sql = "SELECT * FROM prod_cat WHERE Cat_ID =$cat";
			$request = $this->select_all($sql);
			if(!empty($request)){
						$query_insert  = "INSERT INTO envio (Prov_ID,Cat_ID,Env_Cant) values(?,?,?)";
						$arrData = array($idprov,$cat,$cant);
						$request_insert = $this->insert($query_insert,$arrData);
	        			$return = $request_insert;
			}else{
				$return = "exist";
     	  }
     	return $return;
     	}
     	public function selectEnvio($provId){
     		$return = 0;
			$sql = "SELECT * FROM envio WHERE Prov_ID =$provId";
			$request = $this->select_all($sql);
			if(empty($request)){
     			return 0;
     		}else{
     			return 1;
     		}
     	}
     	public function deleteEnvios(){
     		$sql ="DELETE FROM envio";
     		$request = $this->delete($sql);
     		return $request;
     	}
     	
		}	
		?>