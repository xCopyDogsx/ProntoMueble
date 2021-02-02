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
			
		}
	}
 ?>