<?php 
	class Permisos extends  Controllers{
		public function __construct() {
			parent::__construct();
		}
		public function getPermisos(int $idrol){
			$rolid=intval($idrol);
			if($rolid>0){
				$arrModulos = $this->model->selectModulos();
				$arrPermisosRol = $this->model->selectPermisosRol($rolid);
				$arrPermisos = array('Perm_Vista'=>0,'Perm_Crear'=>0,'Perm_Act'=>0,'Perm_Elim'=>0);
				$arrPermisoRol = array('Rol_ID'=>$rolid);
				if(empty($arrPermisosRol)){
					for($i=0;$i<count($arrModulos);$i++){
							$arrModulo[$i]['permisos']=$arrPermisos;
						}
					}else{
						for($i=0;$i<count($arrModulos);$i++){
							$arrPermisos = array('Perm_Vista'=>$arrPermisosRol[$i]['Perm_Vista'],
										'Perm_Crear'=>$arrPermisosRol[$i]['Perm_Crear'],
										'Perm_Act'=>$arrPermisosRol[$i]['Perm_Act'],
										'Perm_Elim'=>$arrPermisosRol[$i]['Perm_Elim']
											);
						if($arrModulos[$i]['Mod_ID']==$arrPermisosRol[$i]['Mod_ID']){
									$arrModulos[$i]['permisos']=$arrPermisos;
									}
						}
						
					}
				$arrPermisoRol['modulos']=$arrModulos;
					
				$html=getModal("modalPermiso",$arrPermisoRol);
			}
			die();
		}
	}
 ?>