<?php 
	class Home extends  Controllers{
		public function __construct() {
			parent::__construct();

		}
		public function Home(){
			$data['page_id']=1;
			$data['tag_page'] = "Home";
			$data['page_title'] = "Página principal";
			$data['page_name'] = "home";
			$data['page_content'] = "Página principal de ProntoMueble";
			$this->views->getView($this,"home",$data);		
		}
	}
 ?>