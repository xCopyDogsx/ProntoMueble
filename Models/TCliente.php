<?php 
require_once("Libraries/Core/Mysql.php");
trait TCliente{
	private $con;
	private $intIdUsuario;
	private $strNombre;
	private $strApellido;
	private $intTelefono;
	private $strEmail;
	private $strPassword;
	private $strToken;
	private $intTipoId;
	private $intIdTransaccion;

	public function insertCliente(string $nombre, string $apellido, int $telefono, string $email, string $password, int $tipoid){
		$this->con = new Mysql();
		$this->strNombre = $nombre;
		$this->strApellido = $apellido;
		$this->intTelefono = $telefono;
		$this->strEmail = $email;
		$this->strPassword = $password;
		$this->intTipoId = $tipoid;

		$return = 0;
		$sql = "SELECT * FROM persona WHERE 
				Per_ID = '{$this->strEmail}' ";
		$request = $this->con->select_all($sql);

		if(empty($request))
		{
			$query_insert  = "INSERT INTO persona(Per_Nom,Per_Ape,Per_Tel,Per_Email,Per_Passw,Rol_ID) 
							  VALUES(?,?,?,?,?,?)";
        	$arrData = array($this->strNombre,
    						$this->strApellido,
    						$this->intTelefono,
    						$this->strEmail,
    						$this->strPassword,
    						$this->intTipoId);
        	$request_insert = $this->con->insert($query_insert,$arrData);
        	$return = $request_insert;
		}else{
			$return = "exist";
		}
        return $return;
	}
	public function insertPedido(string $idtransaccionpaypal = NULL, string $datospaypal = NULL, int $personaid, float $costo_envio, string $monto, int $tipopagoid, string $direccionenvio, string $status){
		$this->con = new Mysql();
		$query_insert  = "INSERT INTO pedido(Ped_IDPayPal,Ped_DatPayPal,Per_ID,Ped_CostEnv,Ped_Total,Pag_ID,Ped_Dest,Ped_Status) 
							  VALUES(?,?,?,?,?,?,?,?)";
		$arrData = array($idtransaccionpaypal,
    						$datospaypal,
    						$personaid,
    						$costo_envio,
    						$monto,
    						$tipopagoid,
    						$direccionenvio,
    						$status
    					);
		$request_insert = $this->con->insert($query_insert,$arrData);
	    $return = $request_insert;
	    return $return;
	}
	public function insertDetalle(int $idpedido, int $productoid, float $precio, int $cantidad){
		$this->con = new Mysql();
		$query_insert  = "INSERT INTO det_ped(Ped_ID,Prod_ID,Det_Precio,Det_Cant) 
							  VALUES(?,?,?,?)";
		$arrData = array($idpedido,
    					$productoid,
						$precio,
						$cantidad
					);
		$request_insert = $this->con->insert($query_insert,$arrData);
	    $return = $request_insert;
	    return $return;
	}
	public function getPedido(int $idpedido){
		$this->con = new Mysql();
		$request = array();
		$sql = "SELECT p.Ped_ID,
							p.Ped_RefCobro,
							p.Ped_IDPayPal,
							p.Per_ID,
							p.Ped_FechPed,
							p.Ped_CostEnv,
							p.Ped_Total,
							p.Pag_ID,
							t.Pag_ID,
							p.Ped_Dest,
							p.Ped_Status
					FROM pedido as p
					INNER JOIN tipo_pago t
					ON p.Pag_ID = t.Pag_ID
					WHERE p.Ped_ID =  $idpedido";
		$requestPedido = $this->con->select($sql);
		if(count($requestPedido) > 0){
			$sql_detalle = "SELECT p.Prod_ID,
											p.Prod_Nom as producto,
											d.Det_Precio,
											d.Det_Cant
									FROM det_ped d
									INNER JOIN producto p
									ON d.Prod_ID = p.Prod_ID
									WHERE d.Ped_ID = $idpedido
									";
			$requestProductos = $this->con->select_all($sql_detalle);
			$request = array('orden' => $requestPedido,
							'detalle' => $requestProductos
							);
		}
		return $request;
	}	
	public function insertDetalleTemp(array $pedido){
		$this->intIdUsuario = $pedido['idcliente'];
		$this->intIdTransaccion = $pedido['idtransaccion'];
		$productos = $pedido['productos'];

		$this->con = new Mysql();
		$sql = "SELECT * FROM detalle_temp WHERE 
					Temp_TransID = '{$this->intIdTransaccion}' AND 
					Per_ID = $this->intIdUsuario";
		$request = $this->con->select_all($sql);

		if(empty($request)){
			foreach ($productos as $producto) {
				$query_insert  = "INSERT INTO detalle_temp(Per_ID,Prod_ID,Temp_Precio,Temp_Cant,Temp_TransID) 
								  VALUES(?,?,?,?,?)";

	        	$arrData = array($this->intIdUsuario,
	        					$producto['idproducto'],
	    						$producto['precio'],
	    						$producto['cantidad'],
	    						$this->intIdTransaccion
	    					);
	        	
	        	$request_insert = $this->con->insert($query_insert,$arrData);
			}
		}else{
			$sqlDel = "DELETE FROM detalle_temp WHERE 
				Temp_TransID = '{$this->intIdTransaccion}' AND 
				Per_ID = $this->intIdUsuario";
			$request = $this->con->delete($sqlDel);
			foreach ($productos as $producto) {
				$query_insert  = "INSERT INTO detalle_temp(Per_ID,Prod_ID,Temp_Precio,Temp_Cant,Temp_TransID) 
								  VALUES(?,?,?,?,?)";
	        	$arrData = array($this->intIdUsuario,
	        					$producto['idproducto'],
	    						$producto['precio'],
	    						$producto['cantidad'],
	    						$this->intIdTransaccion
	    					);
	        	$request_insert = $this->con->insert($query_insert,$arrData);
			}
		}
	}
}

 ?>