<?php 
	class Roles extends Controllers{
		public function __construct()
		{
			parent::__construct();
		}

		public function Roles()
		{
			$data['page_id'] = 3;
			$data['page_tag'] = "Roles Usuario";
			$data['page_name'] = "rol_usuario";
			$data['page_title'] = "Roles Usuario <small> Pronto Mueble</small>";
			$this->views->getView($this,"roles",$data);
		}

		public function getRoles()
		{
			$arrData = $this->model->selectRoles();

			for ($i=0; $i < count($arrData); $i++) {

				if($arrData[$i]['Rol_Status'] == 1)
				{
					$arrData[$i]['Rol_Status'] = '<span class="badge badge-success">Activo</span>';
				}else{
					$arrData[$i]['Rol_Status'] = '<span class="badge badge-danger">Inactivo</span>';
				}

				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-secondary btn-sm btnPermisosRol" rl="'.$arrData[$i]['Rol_ID'].'" title="Permisos" onClick="fntPermisos('.$arrData[$i]['Rol_ID'].')"><i class="fas fa-key"></i></button>
				<button class="btn btn-primary btn-sm btnEditRol"rl="'.$arrData[$i]['Rol_ID'].'" title="Editar" onclick="fntEditRol('.$arrData[$i]['Rol_ID'].')"><i class="fas fa-pencil-alt"></i></button>
				<button class="btn btn-danger btn-sm btnDelRol" rl="'.$arrData[$i]['Rol_ID'].'" title="Eliminar" onClick="fntDelRol('.$arrData[$i]['Rol_ID'].')"><i class="far fa-trash-alt"></i></button>
				</div>';
				/*if($_SESSION['permisosMod']['u']){
						$btnView = '<button class="btn btn-secondary btn-sm btnPermisosRol" onClick="fntPermisos('.$arrData[$i]['Rol_ID'].')" title="Permisos"><i class="fas fa-key"></i></button>';
						$btnEdit = '<button class="btn btn-primary btn-sm btnEditRol" onClick="fntEditRol('.$arrData[$i]['Rol_ID'].')" title="Editar"><i class="fas fa-pencil-alt"></i></button>';
				//	}
				//	if($_SESSION['permisosMod']['d']){
						$btnDelete = '<button class="btn btn-danger btn-sm btnDelRol" onClick="fntDelRol('.$arrData[$i]['Rol_ID'].')" title="Eliminar"><i class="far fa-trash-alt"></i></button>
					</div>';
				//	}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';*/
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getRol(int $idrol)
		{
			$intIdrol = intval(strClean($idrol));
			if($intIdrol > 0)
			{
				$arrData = $this->model->selectRol($intIdrol);
				if(empty($arrData))
				{
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setRol(){
			
			$intIdrol = intval($_POST['idRol']);
			$strRol =  strClean($_POST['txtNombre']);
			$strDescipcion = strClean($_POST['txtDescripcion']);
			$intStatus = intval($_POST['listStatus']);

			if($intIdrol == 0)
			{
				//Crear
				$request_rol = $this->model->insertRol($strRol, $strDescipcion,$intStatus);
				$option = 1;
			}else{
				//Actualizar
				$request_rol = $this->model->updateRol($intIdrol, $strRol, $strDescipcion, $intStatus);
				$option = 2;
			}

			if($request_rol > 0 && strcmp($request_rol,"exist") != 0)
			{
				if($option == 1)
				{
					$arrResponse = array('status' => true, 'msg' => 'Datos guardados correctamente.');
				}else{
					$arrResponse = array('status' => true, 'msg' => 'Datos Actualizados correctamente.');
				}
			}else if(strcmp($request_rol,"exist") === 0){
				
				$arrResponse = array('status' => false, 'msg' => '¡Atención! El Rol ya existe.');
			}else{
				$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}

		public function delRol()
		{
			if($_POST){
				$intIdrol = intval($_POST['Rol_ID']);
				$requestDelete = $this->model->deleteRol($intIdrol);
				if($requestDelete == 'ok')
				{
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el Rol');
				}else if($requestDelete == 'exist'){
					$arrResponse = array('status' => false, 'msg' => 'No es posible eliminar un Rol asociado a usuarios.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el Rol.');
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

	}
 ?>