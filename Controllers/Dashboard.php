<?php 
	class Dashboard extends  Controllers{
		public function __construct() {
			parent::__construct();

		}
		public function dashboard(){
			$data['page_id']=2;
			$data['page_tag'] = "Panel Administrativo - ProntoMueble";
			$data['page_title'] = "Panel Administrativo - ProntoMueble";
			$data['page_name'] = "Panel administratvo";
			$this->views->getView($this,"dashboard",$data);		
		}
	}
 ?>