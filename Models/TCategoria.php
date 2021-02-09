<?php 
require_once("Libraries/Core/Mysql.php");
trait TCategoria{
	private $con;

	public function getCategoriasT(string $categorias){
		$this->con = new Mysql();
		$sql = "SELECT Cat_ID, Cat_Nom, Cat_Des, Cat_Port, Cat_Ruta
				 FROM prod_cat WHERE Cat_Status != 0 AND Cat_ID IN ($categorias)";
		$request = $this->con->select_all($sql);
		if(count($request) > 0){
			for ($c=0; $c < count($request) ; $c++) { 
				$request[$c]['Cat_Port'] = BASE_URL.'/Assets/images/uploads/'.$request[$c]['Cat_Port'];		
			}
		}
		return $request;
	}
}

 ?>