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
				$arrData = $this->model->selectPedidos();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['Prod_Status'] == 1)
					{
						$arrData[$i]['Prod_Status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['Prod_Status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					$arrData[$i]['Prod_Precio'] = SMONEY.' '.formatMoney($arrData[$i]['Prod_Precio']);
					if($_SESSION['permisosMod']['Perm_Vista']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['Prod_ID'].')" title="Ver producto"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['Perm_Act']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['Prod_ID'].')" title="Editar producto"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['Perm_Elim']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['Prod_ID'].')" title="Eliminar producto"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}
}

 ?>