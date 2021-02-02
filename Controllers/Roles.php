<?php 
	class Roles extends  Controllers{
		public function __construct() {
			parent::__construct();

		}
		public function Roles(){
			$data['page_id']=3;
			$data['page_tag'] = "Roles - ProntoMueble";
			$data['page_title'] = "Roles de usuario";
			$data['page_name'] = "Roles de usuario <small>Pronto Mueble</small>";
			$this->views->getView($this,"roles",$data);		
		}
		public function getRoles(){
			$arrData  =  $this->model->selectRoles();
			for($i=0;$i<count($arrData);$i++){
				if($arrData[$i]['status']==1){
					$arrData[$i]['status']='<span class="badge badge-pill badge-success">Activo</span>';
				}else{
					$arrData[$i]['status']='<span class="badge badge-pill badge-danger">Inactivo</span>';
				}
				$arrData[$i]['options'] = '<div class="text-center">
				<button class="btn btn-secondary btn-sm btnPermisosRol" rl="'.$arrData[$i]['idrol'].'" title="Permisos"><i class="fas fa-key"></i></button>
				<button class="btn btn-primary btn-sm btnEditRol" rl="'.$arrData[$i]['idrol'].'" title="Editar"><i class="fas fa-pencil-alt"></i></button>
				<button class="btn btn-danger btn-sm btnDelRol" rl="'.$arrData[$i]['idrol'].'" title="Eliminar"><i class="far fa-trash-alt"></i></button>
				</div>';
			}
			echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			die();
		}
		public function setRol(){
			$strRol=strClean($_POST['txtNombre']);
			$strDescripcion=strClean($_POST['txtDescripcion']);
			$intStatus=intval($_POST['listStatus']);
			$request_rol=$this->model->insertRol($strRol,$strDescripcion,$intStatus);
			if($request_rol>0){
				$arrResponse = array('status'=>true,'msg'=>'Datos guardados correctamente.');
			}else if($request_rol=='exist'){
				$arrResponse = array('status'=>false,'msg'=>'¡Atención el rol ya existe!');
			}else{
				$arrResponse = array('status'=>false,'msg'=>'¡No se pudo guardar! Por favor contacta con 
					el área de sistemas');
			}
			echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			die();
		}
	}
 ?>