<?php 

	class Dashboard extends Controllers{
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
			if($_SESSION['userData']['Rol_Nom']=='Cliente'){
				header('Location: '.base_url());	
			}
			getPermisos(1);
		}

		public function dashboard()
		{
			$data['page_id'] = 2;
			$data['page_tag'] = "Dashboard - ProntoMueble";
			$data['page_title'] = "Dashboard - ProntoMueble";
			$data['page_name'] = "dashboard";
			$data['clientes']=$this->model->getClientes();
			$data['pendientes']=$this->model->getPendientes();
			$data['ready']=$this->model->getReady();
			$data['emp']=$this->model->getEmpleados();
			$data['page_functions_js'] = "functions_dashboard.js";
			$this->views->getView($this,"dashboard",$data);
		}

	}
 ?>