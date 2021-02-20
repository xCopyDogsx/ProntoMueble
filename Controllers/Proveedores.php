<?php 
	class Proveedores extends Controllers{
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
			getPermisos(7);
		}
		public function Proveedores()
		{
			if(empty($_SESSION['permisosMod']['Perm_Vista'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Proveedores";
			$data['page_title'] = "PROVEEDORES <small>Pronto Mueble</small>";
			$data['page_name'] = "proveedores";
			$data['page_functions_js'] = "functions_proveedores.js";
			$this->views->getView($this,"proveedores",$data);
				}
			
		public function getProveedores()
	{
		if($_SESSION['permisosMod']['Perm_Vista']){
			$arrData = $this->model->selectProveedores();
			for ($i=0; $i < count($arrData); $i++) {
				$btnView = '';
				$btnEdit = '';
				$btnDelete = '';
				if($arrData[$i]['Prov_Status'] == 1)
					{
						$arrData[$i]['Prov_Status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['Prov_Status'] = '<span class="badge badge-danger">Inactivo</span>';
					}
				if($_SESSION['permisosMod']['Perm_Vista']){
					$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['Prov_ID'].')" title="Ver proveedor"><i class="far fa-eye"></i></button>';
				}
				if($_SESSION['permisosMod']['Perm_Act']){
					$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Prov_ID'].')" title="Editar proveedor"><i class="fas fa-pencil-alt"></i></button>';
						if($this->verificarEnvio($arrData[$i]['Prov_ID'])==1){
					$btnEdit.=' <button class="btn btn-warning  btn-sm" onClick="fntEditEnv(this,'.$arrData[$i]['Prov_ID'].')" title="Editar envio"><i class="fas fa-paper-plane"></i></button> ';
						}else{
						$btnEdit.=' <button class="btn btn-warning  btn-sm" title="Editar envio" disabled><i class="fas fa-paper-plane"></i></button> ';
						}			
					
				}
				if($_SESSION['permisosMod']['Perm_Elim']){	
					$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Prov_ID'].')" title="Eliminar proveedor"><i class="far fa-trash-alt"></i></button>';
					$btnDelete .='  <button class="btn btn-danger btn-sm" onClick="fntDelEnvioE('.$arrData[$i]['Prov_ID'].')" title="Reiniciar envio"><i class="fas fa-cart-arrow-down"></i></button>';
				}
				$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
		}
		die();
	}
public function setProveedor(){
			if($_POST){
				if(empty($_POST['txtNombre']) || empty($_POST['txtDireccion']) || empty($_POST['txtFijo']) || empty($_POST['txtCelular']) || empty($_POST['listStatus'])||empty($_POST['txtContacto'])||empty($_POST['txtEmail']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					
					$idProv = intval($_POST['idProveedor']);
					$strNombre = strClean($_POST['txtNombre']);
					$strDireccion = strClean($_POST['txtDireccion']);
					$strFijo = strClean($_POST['txtFijo']);
					$strCelular= strClean($_POST['txtCelular']);
					$strContacto = strClean($_POST['txtContacto']);
					$strEmail = ($_POST['txtEmail']);
					$intStatus = intval($_POST['listStatus']);
					$request_producto = "";

					if($idProv == 0)
					{
						$option = 1;
						if($_SESSION['permisosMod']['Perm_Crear']){
							$request_proveedor = $this->model->insertProveedor($strNombre, 
																		$strDireccion, 
																		$strFijo, 
																		$strCelular,
																		$strContacto, 
																		$strEmail, 
																		$intStatus );
						}
					}else{
						$option = 2;
						if($_SESSION['permisosMod']['Perm_Act']){
							$request_proveedor = $this->model->updateProveedor($idProv,
																		$strNombre,
																		$strDireccion, 
																		$strFijo, 
																		$strCelular,
																		$strContacto, 
																		$strEmail,
																		$intStatus);
						}
					}
					if($request_proveedor > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'idProv' => $request_proveedor, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'idProv' => $idProv, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_proveedor == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un proveedor con estos datos.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

public function getProveedor($idproveedor){
			if($_SESSION['permisosMod']['Perm_Vista']){
				$idproveedor = intval($idproveedor);
				if($idproveedor > 0){
					$arrData = $this->model->selectProveedor($idproveedor);
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
public function delProveedor(){
			if($_POST){
				if($_SESSION['permisosMod']['Perm_Elim']){
					$idprov = intval($_POST['idProveedor']);
					$requestDelete = $this->model->deleteProveedor($idprov);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el proveedor');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el proveedor.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
public function setEnvio(){
	$request_proveedor="";
	$arrResponse="";
	if($_POST){

	  if(empty($_POST['txtIdpro'])||empty($_POST['txtCantidadx'])||empty($_POST['xdCategoria'])){
	  		$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
         dep($_POST);
	  		}else{
	  			if($_SESSION['permisosMod']['Perm_Crear']){
	  				$idProv = intval($_POST['txtIdpro']);
					$cantidad = intval($_POST['txtCantidadx']);
					$categoria = intval($_POST['xdCategoria']);
					$request_proveedor = $this->model->insertEnvio($idProv,$categoria,$cantidad);
						if($request_proveedor=='exist'){
							$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos, puede que dicha categoria no exista.');
						}else{
							$arrResponse = array('status' => true, 'idProv' => $request_proveedor, 'msg' => 'Datos guardados correctamente.');
						}
						
	  			}else{
	  				$arrResponse = array("status" => false, "msg" => 'Permisos insuficientes.');
	  			}

	  		}
	  	if($request_proveedor > 0 )
					{
						if($request_proveedor == 1){
							$arrResponse = array('status' => true, 'idProv' => $request_proveedor, 'msg' => 'Datos guardados correctamente.');
						}
					}else if($request_proveedor == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible almacenar los datos, puede que dicha categoria no exista.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
	 				 }
		die();
		}
public function verificarEnvio($provId){
	$arrResponse = 1;
	if($_SESSION['permisosMod']['Perm_Vista']){
				$idproveedor = intval($provId);
				if($idproveedor > 0){
					$arrData = $this->model->selectEnvio($idproveedor);
					if(empty($arrData)){
						$arrResponse = 1;
					}else{
						$arrResponse = 0;
					}
					return $arrResponse;
				}
			}
			die();
}
public function delEnvios(){
	if($_SESSION['permisosMod']['Perm_Elim']&&$_SESSION['userData']['Rol_Nom']=="Administrador"){	
		$arrData = $this->model->deleteEnvios();
		if(empty($arrData)){
						$arrResponse = 1;
					}else{
						$arrResponse = 0;
					}
					return $arrResponse;
		}
			die();
		}
	}	
		?>