<?php 
	
	class PedidosModel extends Mysql
	{
		private $objCategoria;
		public function __construct()
		{
			parent::__construct();
			
		}

		public function selectPedidos($idpersona = NULL){
			$where = "";
			if($idpersona!= NULL){
				$where = "WHERE p.Per_ID = ".$idpersona;
			}
			$sql = "SELECT p.Ped_ID,
						p.Ped_RefCobro,
						p.Ped_IDPayPal,
						DATE_FORMAT(p.Ped_FechPed, '%d/%m/%Y') as fecha,
						p.Ped_Total,
						tp.Pag_Nom,
						tp.Pag_ID,
						p.Ped_Status
					FROM pedido p
					INNER JOIN tipo_pago tp 
					ON p.Pag_ID=tp.Pag_ID $where ";
			$request = $this->select_all($sql);
			return $request;
		}

		public function selectPedido($idpedido,$idpersona=NULL){
					$busqueda = "";
					if($idpersona!=NULL){
						$busqueda=" AND p.Per_ID=".$idpersona;
					}

					$request = array();
		$sql = "SELECT p.Ped_ID,
							p.Ped_RefCobro,
							p.Ped_IDPayPal,
							p.Per_ID,
							DATE_FORMAT(p.Ped_FechPed, '%d/%m/%Y') as fecha,
							p.Ped_CostEnv,
							p.Ped_Total,
							p.Pag_ID,
							t.Pag_ID,
							t.Pag_Nom,
							p.Ped_Dest,
							p.Ped_Status
					FROM pedido as p
					INNER JOIN tipo_pago t
					ON p.Pag_ID = t.Pag_ID
					WHERE p.Ped_ID =  $idpedido".$busqueda;
			$requestPedido = $this->select($sql);
			if(!empty($requestPedido)){
				$idpersona = $requestPedido['Per_ID'];
				$sqlcliente  = "SELECT * FROM persona WHERE Per_ID=$idpersona";
				$requestCliente = $this->select($sqlcliente);	
				$sql_detalle = "SELECT p.Prod_ID,
											p.Prod_Nom as producto,
											d.Det_Precio,
											d.Det_Cant
									FROM det_ped d
									INNER JOIN producto p
									ON d.Prod_ID = p.Prod_ID
									WHERE d.Ped_ID = $idpedido
									";
				$requestProductos = $this->select_all($sql_detalle);
				$request = array('cliente'=>$requestCliente,
									'orden'=>$requestPedido,
									'detalle'=>$requestProductos);	

			}
			return $request;
		}
		public function selectTransPaypal($idtransaccion){
			$objTransaccion = array();
			$sql = "SELECT Ped_DatPayPal FROM pedido WHERE Ped_IDPayPal='{$idtransaccion}'";
			$requestData = $this->select($sql);
			if(!empty($requestData)){
				$objData = json_decode($requestData['Ped_DatPayPal']);
				$urlTransaccion = $objData->purchase_units[0]->payments->captures[0]->links[0]->href;
				$urlOrden = $objData->purchase_units[0]->payments->captures[0]->links[2]->href;
				$objTransaccion = CurlConnectionGet($urlOrden,"application/json",getToken());

			}
			return $objTransaccion;
		}	
	
		public function reembolso($idtransaccion,$observacion){
			$response=false;
			$sql="SELECT Ped_ID,Ped_DatPayPal FROM pedido WHERE Ped_IDPayPal='{$idtransaccion}'	";
			$requestData=$this->select($sql);
			if(!empty($requestData)){
				$objData = json_decode($requestData['Ped_DatPayPal']);
				$urlReembolso = $objData->purchase_units[0]->payments->captures[0]->links[1]->href;
				$objTransaccion = CurlConnectionPost($urlReembolso,"application/json",getToken());
				if(isset($objTransaccion->status) and $objTransaccion->status=="COMPLETED"){
					$idpedido=$requestData['Ped_ID'];
					$idtrans=$objData->id;
					$status=$objTransaccion->status;
					$jsonData=json_encode($objTransaccion);
					$observacion=$observacion;
					$query_insert="INSERT INTO reembolsos(Rem_TransID,Rem_Data,Rem_Obs,Rem_Status,Ped_ID)
									VALUES (?,?,?,?,?)";
								//echo $jsonData;
					$arrData=array(
									$idtrans,
									$jsonData,
                                    $observacion,
									$status,
									$idpedido
								   );
					$request_insert=$this->insert($query_insert,$arrData);
					if($request_insert>0){
						
						$updatePedido = "UPDATE pedido SET Ped_Status=? WHERE Ped_ID=$idpedido";
						$arrPedido=array("Reembolsado");
						$request=$this->update($updatePedido,$arrPedido);
						$response=true;
					}
				}
				return $response;
			}
		}
		public function deletePedido($idpedido){
		$sql1="SELECT Pag_ID FROM pedido WHERE Ped_ID = $idpedido";
		$ejecutar=$this->select($sql1);
		if($ejecutar['Pag_ID']==1){
			$request = "";
		}else{
		$sql = "DELETE FROM pedido WHERE Ped_ID = $idpedido AND Pag_ID!=1 ";
		$arrData = array(0);
		$request = $this->delete($sql,$arrData);
		}
		return $request;
		
		}
	}
 ?>