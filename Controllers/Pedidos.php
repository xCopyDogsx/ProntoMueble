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
									class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>

						<button class="btn btn-danger btn-sm" onClick="fntViewDPF('.$arrData[$i]['Ped_ID'].')" title="Generar PDF"><i class="fas fa-file-pdf"></i></button>';
						if($arrData[$i]['Pag_ID']==1){
							$btnView .=' <button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['Ped_ID'].')"
										title="Ver transacción"><i class="fa fa-paypal"	aria-hidden="true"></i></button>';
						}else{
							$btnView .=' <button class="btn btn-info btn-sm" disabled=""><i class="fa fa-paypal"	aria-hidden="true"></i></button>';
						}
					}
					if($_SESSION['permisosMod']['Perm_Act']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Ped_ID'].')" title="Editar pedido"><i class="fas fa-pencil-alt"></i></button>';
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
}

 ?>