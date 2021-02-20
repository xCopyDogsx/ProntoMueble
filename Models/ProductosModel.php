<?php 

	class ProductosModel extends Mysql
	{
		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;
		private $intCodigo;
		private $intCategoriaId;
		private $intPrecio;
		private $intStock;
		private $intStatus;
		private $strRuta;
		private $strImagen;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectProductos(){
			$sql = "SELECT p.Prod_ID,
							p.Prod_Cod,
							p.Prod_Nom,
							p.Prod_Desc,
							p.Cat_ID,
							c.Cat_Nom as categoria,
							p.Prod_Precio,
							p.Prod_Stock,
							p.Prod_Status 
					FROM producto p 
					INNER JOIN prod_cat c
					ON p.Cat_ID = c.Cat_ID
					WHERE p.Prod_Status != 0 ";
					$request = $this->select_all($sql);
			return $request;
		}	

		public function insertProducto(string $nombre, string $descripcion, int $codigo, int $categoriaid, string $precio, int $stock, string $ruta, int $status){
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intStock = $stock;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE Prod_Cod = '{$this->intCodigo}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO producto(Cat_ID,
														Prod_Cod,
														Prod_Nom,
														Prod_Desc,
														Prod_Precio,
														Prod_Stock,
														Prod_Ruta,
														Prod_Status) 
								  VALUES(?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intCategoriaId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
        						$this->intStock,
        						$this->strRuta,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateProducto(int $idproducto, string $nombre, string $descripcion, int $codigo, int $categoriaid, string $precio, int $stock, string $ruta, int $status){
			$this->intIdProducto = $idproducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intStock = $stock;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE Prod_Cod = '{$this->intCodigo}' AND Prod_ID != $this->intIdProducto ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE producto 
						SET Cat_ID=?,
							Prod_Cod=?,
							Prod_Nom=?,
							Prod_Desc=?,
							Prod_Precio=?,
							Prod_Stock=?,
							Prod_Ruta=?,
							Prod_Status=? 
						WHERE Prod_ID = $this->intIdProducto ";
				$arrData = array($this->intCategoriaId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
        						$this->intStock,
        						$this->strRuta,
        						$this->intStatus);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT p.Prod_ID,
							p.Prod_Cod,
							p.Prod_Nom,
							p.Prod_Desc,
							p.Prod_Precio,
							p.Prod_Stock,
							p.Cat_ID,
							c.Cat_Nom as categoria,
							p.Prod_Status
					FROM producto p
					INNER JOIN prod_cat c
					ON p.Cat_ID = c.Cat_ID
					WHERE Prod_ID = $this->intIdProducto";
			$request = $this->select($sql);
			return $request;

		}

		public function insertImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(Prod_ID,Img_Nom) VALUES(?,?)";
	        $arrData = array($this->intIdProducto,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}

		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT Prod_ID,Img_ID,Img_Nom
					FROM imagen
					WHERE Prod_ID = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE Prod_ID = $this->intIdProducto 
						AND Img_Nom = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "DELETE FROM producto WHERE Prod_ID = $this->intIdProducto ";
			$arrData = array(0);
			$request = $this->delete($sql,$arrData);
			return $request;
		}
	}
 ?>