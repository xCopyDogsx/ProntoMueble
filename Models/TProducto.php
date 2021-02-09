<?php 
require_once("Libraries/Core/Mysql.php");
trait TProducto{
	private $con;
	private $strCategoria;
	private $intIdcategoria;
	private $intIdProducto;
	private $strProducto;
	private $cant;
	private $option;
	private $strRuta;
	public function getProductosT(){
		$this->con = new Mysql();
		$sql = "SELECT p.Prod_ID,
						p.Prod_Cod,
						p.Prod_Nom,
						p.Prod_Desc,
						p.Cat_ID,
						c.Cat_Nom as categoria,
						p.Prod_Precio,
						p.Prod_Ruta,
						p.Prod_Stock
				FROM producto p 
				INNER JOIN prod_cat c
				ON p.Cat_ID = c.Cat_ID
				WHERE p.Prod_Status != 0 ORDER BY p.Prod_ID DESC ";
				$request = $this->con->select_all($sql);
				if(count($request) > 0){
					for ($c=0; $c < count($request) ; $c++) { 
						$intIdProducto = $request[$c]['Prod_ID'];
						$sqlImg = "SELECT Img_Nom
								FROM imagen
								WHERE Prod_ID = $intIdProducto";
						$arrImg = $this->con->select_all($sqlImg);
						if(count($arrImg) > 0){
							for ($i=0; $i < count($arrImg); $i++) { 
								$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['Img_Nom'];
							}
						}
						$request[$c]['images'] = $arrImg;
					}
				}
		return $request;
	}

	public function getProductosCategoriaT(int $idcategoria, string $ruta){
		$this->intIdcategoria = $idcategoria;
		$this->strRuta = $ruta;

		$this->con = new Mysql();
		$sql_cat = "SELECT Cat_ID,Cat_Nom FROM prod_cat WHERE Cat_ID = '{$this->intIdcategoria}'";
		$request = $this->con->select($sql_cat);

		if(!empty($request)){
			$this->strCategoria = $request['Cat_Nom'];
			$sql = "SELECT p.Prod_ID,
							p.Prod_Cod,
							p.Prod_Nom,
							p.Prod_Desc,
							p.Cat_ID,
							c.Cat_Nom as categoria,
							p.Prod_Precio,
							p.Prod_Ruta,
							p.Prod_Stock
					FROM producto p 
					INNER JOIN prod_cat c
					ON p.Cat_ID = c.Cat_ID
					WHERE p.Prod_Status != 0 AND p.Cat_ID = $this->intIdcategoria AND c.Cat_Ruta = '{$this->strRuta}' ";
					$request = $this->con->select_all($sql);
					if(count($request) > 0){
						for ($c=0; $c < count($request) ; $c++) { 
							$intIdProducto = $request[$c]['Prod_ID'];
							$sqlImg = "SELECT Img_Nom
									FROM imagen
									WHERE Prod_ID = $intIdProducto";
							$arrImg = $this->con->select_all($sqlImg);
							if(count($arrImg) > 0){
								for ($i=0; $i < count($arrImg); $i++) { 
									$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['Img_Nom'];
								}
							}
							$request[$c]['images'] = $arrImg;
						}
					}
			$request = array('idcategoria' => $this->intIdcategoria,
								'categoria' => $this->strCategoria,
								'productos' => $request
							);

		}
		return $request;
	}

	public function getProductoT(int $idproducto, string $ruta){
		$this->con = new Mysql();
		$this->intIdProducto = $idproducto;
		$this->strRuta = $ruta;
		$sql = "SELECT p.Prod_ID,
						p.Prod_Cod,
						p.Prod_Nom,
						p.Prod_Desc,
						p.Cat_ID,
						c.Cat_Nom as categoria,
						c.Cat_Ruta as ruta_categoria,
						p.Prod_Precio,
						p.Prod_Ruta,
						p.Prod_Stock
				FROM producto p 
				INNER JOIN prod_cat c
				ON p.Cat_ID = c.Cat_ID
				WHERE p.Prod_Status != 0 AND p.Prod_ID = '{$this->intIdProducto}' AND p.Prod_Ruta = '{$this->strRuta}' ";
				$request = $this->con->select($sql);
				if(!empty($request)){
					$intIdProducto = $request['Prod_ID'];
					$sqlImg = "SELECT Img_Nom
							FROM imagen
							WHERE Prod_ID = $intIdProducto";
					$arrImg = $this->con->select_all($sqlImg);
					if(count($arrImg) > 0){
						for ($i=0; $i < count($arrImg); $i++) { 
							$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['Img_Nom'];
						}
					}else{
						$arrImg[0]['url_image'] = media().'/images/uploads/product.png';
					}
					$request['images'] = $arrImg;
				}
		return $request;
	}

	public function getProductosRandom(int $idcategoria, int $cant, string $option){
		$this->intIdcategoria = $idcategoria;
		$this->cant = $cant;
		$this->option = $option;

		if($option == "r"){
			$this->option = " RAND() ";
		}else if($option == "a"){
			$this->option = " Prod_ID ASC ";
		}else{
			$this->option = " Prod_ID DESC ";
		}

		$this->con = new Mysql();
		$sql = "SELECT p.Prod_ID,
						p.Prod_Cod,
						p.Prod_Nom,
						p.Prod_Desc,
						p.Cat_ID,
						c.Cat_Nom as categoria,
						p.Prod_Precio,
						p.Prod_Ruta,
						p.Prod_Stock
				FROM producto p 
				INNER JOIN prod_cat c
				ON p.Cat_ID = c.Cat_ID
				WHERE p.Prod_Status != 0 AND p.Cat_ID = $this->intIdcategoria
				ORDER BY $this->option LIMIT  $this->cant ";
				$request = $this->con->select_all($sql);
				if(count($request) > 0){
					for ($c=0; $c < count($request) ; $c++) { 
						$intIdProducto = $request[$c]['Prod_ID'];
						$sqlImg = "SELECT Img_Nom
								FROM imagen
								WHERE Prod_ID = $intIdProducto";
						$arrImg = $this->con->select_all($sqlImg);
						if(count($arrImg) > 0){
							for ($i=0; $i < count($arrImg); $i++) { 
								$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['Img_Nom'];
							}
						}
						$request[$c]['images'] = $arrImg;
					}
				}
		return $request;
	}	

	public function getProductoIDT(int $idproducto){
		$this->con = new Mysql();
		$this->intIdProducto = $idproducto;
		$sql = "SELECT p.Prod_ID,
						p.Prod_Cod,
						p.Prod_Nom,
						p.Prod_Desc,
						p.Cat_ID,
						c.Cat_Nom as categoria,
						p.Prod_Precio,
						p.Prod_Ruta,
						p.Prod_Stock
				FROM producto p 
				INNER JOIN prod_cat c
				ON p.Cat_ID = c.Cat_ID
				WHERE p.Prod_Status != 0 AND p.Prod_ID = '{$this->intIdProducto}' ";
				$request = $this->con->select($sql);
				if(!empty($request)){
					$intIdProducto = $request['Prod_ID'];
					$sqlImg = "SELECT Img_Nom
							FROM imagen
							WHERE Prod_ID = $intIdProducto";
					$arrImg = $this->con->select_all($sqlImg);
					if(count($arrImg) > 0){
						for ($i=0; $i < count($arrImg); $i++) { 
							$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['Img_Nom'];
						}
					}else{
						$arrImg[0]['url_image'] = media().'/images/uploads/product.png';
					}
					$request['images'] = $arrImg;
				}
		return $request;
	}
}

 ?>