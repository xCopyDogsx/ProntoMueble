<?php 
	
	class PedidosModel extends Mysql
	{
		private $objCategoria;
		public function __construct()
		{
			parent::__construct();
			
		}

		public function selectPedidos(){
			$sql = "SELECT p.Ped_ID,
						p.Ped_RefCobro,
						p.Ped_IDPayPal,
						DATE_FORMAT(p.Ped_FechPed, '%d/%m/%Y') as fecha,
						p.Ped_Total,
						tp.Pag_Nom,
						tp.Pag_ID,
						p.Ped_Status
					FROM pedido p
					INNER JOIN tipo_pago tp 
					ON p.Pag_ID=tp.Pag_ID";
		}	
	}
 ?>