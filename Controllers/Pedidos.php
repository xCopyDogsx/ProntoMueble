<?php 
class Pedidos extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			session_regenerate_id(true);
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(5);
		}

		public function Pedidos()
		{
			if(empty($_SESSION['permisosMod']['Perm_Vista'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Pedidos";
			$data['page_title'] = "PEDIDOS <small>Pronto Mueble</small>";
			$data['page_name'] = "pedidos";
			$data['page_functions_js'] = "functions_pedidos.js";
			$this->views->getView($this,"pedidos",$data);
		}
		public function getPedidos(){
			if($_SESSION['permisosMod']['Perm_Vista']){
				$idpersona="";
				if($_SESSION['userData']['Rol_Nom']=="Cliente"){
					$idpersona =$_SESSION['userData']['Per_ID'];
				}

				$arrData = $this->model->selectPedidos($idpersona);
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';
					$arrData[$i]['transaccion']=$arrData[$i]['Ped_RefCobro'];
					if($arrData[$i]['Ped_IDPayPal']!=""){
						$arrData[$i]['transaccion']=$arrData[$i]['Ped_IDPayPal'];
					}
					$arrData[$i]['Ped_Total']=SMONEY.formatMoney($arrData[$i]['Ped_Total']);

					if($_SESSION['permisosMod']['Perm_Vista']){
						$btnView = '
						<a title="Ver detalle" href="'.base_url().'/pedidos/orden/'.$arrData[$i]['Ped_ID'].'" target="_blank"
									class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>';
						if($arrData[$i]['Pag_ID']==1){
							$btnView .=' 
							<a title="Ver detalle" href="'.base_url().'/pedidos/transaccion/'.$arrData[$i]['Ped_IDPayPal'].'" target="_blank"
									class="btn btn-info btn-sm"><i class="fa fa-paypal"	aria-hidden="true"></i></a>';
						}else{
							$btnView .=' <button class="btn btn-info btn-sm" disabled=""><i class="fa fa-paypal"	aria-hidden="true"></i></button>';
						}
					}
					if($_SESSION['permisosMod']['Perm_Elim']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Ped_ID'].')" title="Eliminar pedido"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function orden($idpedido){
			if(empty($_SESSION['permisosMod']['Perm_Vista'])){
				header("Location:".base_url().'/dashboard');
			}
			if(!is_numeric($idpedido)){
				header('Location: '.base_url().'/pedidos');
			}else{
			$idpersona="";
			if($_SESSION['userData']['Rol_Nom']=="Cliente"){
					$idpersona =$_SESSION['userData']['Per_ID'];
				}
			$data['page_tag'] = "Pedido - ProntoMueble";
			$data['page_title'] = "PEDIDO <small>Pronto Mueble</small>";
			$data['page_name'] = "pedido";
			$data['arrPedido'] = $this->model->selectPedido($idpedido,$idpersona);
			if(!empty($data['arrPedido'])){
				$this->views->getView($this,"orden",$data);
			}else{
				$this->views->getView($this,"ordenerror",$data);
			}
			}
			
		}

	public function transaccion($transaccion){
			if(empty($_SESSION['permisosMod']['Perm_Vista'])){
				header("Location:".base_url().'/dashboard');
			}
			
			$idpersona="";
			if($_SESSION['userData']['Rol_Nom']=="Cliente"){
					$idpersona =$_SESSION['userData']['Per_ID'];
				}
			$requestTransaccion = $this->model->selectTransPaypal($transaccion);
			$data['page_tag'] = "Detalle transacción - ProntoMueble";
			$data['page_title'] = "Transacción <small>Pronto Mueble</small>";
			$data['page_name'] = "Detalles de la transacción";
			$data['objTransaccion']=$requestTransaccion;
			$data['page_functions_js'] = "functions_pedidos.js";
			$data['arrPedido'] = $this->model->selectPedido(2,$idpersona);
			if(!empty($data['arrPedido'])){
				$this->views->getView($this,"transaccion",$data);
			}else{
				$this->views->getView($this,"ordenerror",$data);
			}
			
		}
public function getTransaccion($transaccion){
			if(empty($_SESSION['permisosMod']['Perm_Vista'])){
				header("Location:".base_url().'/dashboard');
			}
			if($_SESSION['userData']['Rol_Nom']=="Cliente"){
					die();
				}
			if($transaccion==""){
				$arrResponse = array("status"=>false,"msg"=>'Datos incorrectos.');
			}else{
				$transaccion=strClean($transaccion);
				$requestTransaccion=$this->model->selectTransPaypal($transaccion);
				if(empty($requestTransaccion)){
					$arrResponse=array("status"=>false,"msg"=>"Datos no disponibles.");
				}else{
					
					$htmlModal=getFile("Template/Modals/modalReembolso",$requestTransaccion);
					$arrResponse=array("status"=>true,"html"=>$htmlModal);
				}
			}	
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
		}
public function setReembolso(){
	
	if($_POST){
		if(!empty($_SESSION['permisosMod']['Perm_Act'])&&$_SESSION['userData']['Rol_Nom']!="Cliente"){
			$transaccion=strClean($_POST['idtransaccion']);
			$observacion=strClean($_POST['observacion']);
			$requestTransaccion=$this->model->reembolso($transaccion,$observacion);
			if($requestTransaccion){
				$arrResponse=array("status"=>true,"msg"=>"El dinero ha sido reembolsado con éxito.");
			}else{
				$arrResponse=array("status"=>false,"msg"=>"El dinero no ha sido reembolsado con éxito.");
			}
		}else{
			$arrResponse=array("status"=>false,"msg"=>"No se pudo realizar el proceso con exito");
		}
		echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);		
	}
	die();
}
public function delPedido($idpedido){
if($_POST){
			if($_SESSION['permisosMod']['Perm_Elim']){
				$intIdpedido = intval($_POST['idPedido']);
				$requestDelete = $this->model->deletePedido($intIdpedido);
				if($requestDelete)
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el pedido');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el pedido nota: No se pueden eliminar los pedidos pagos por PayPal.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
		}
		die();
}	


}

 ?>