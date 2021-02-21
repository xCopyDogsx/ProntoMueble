<?php 
class ClientesModel extends Mysql
{
	private $intIdUsuario;
	private $strIdentificacion;
	private $strNombre;
	private $strApellido;
	private $intTelefono;
	private $strEmail;
	private $strPassword;
	private $strToken;
	private $intTipoId;
	private $intStatus;

	public function __construct()
	{
		parent::__construct();
	}	

	public function insertCliente(string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password,int $tipoid){

		$this->strIdentificacion = $identificacion;
		$this->strNombre = $nombre;
		$this->strApellido = $apellido;
		$this->intTelefono = $telefono;
		$this->strEmail = $email;
		$this->strPassword = $password;

		$this->intTipoId = $tipoid;


		$return = 0;
		$sql = "SELECT * FROM persona WHERE 
				Per_Email = '{$this->strEmail}' or Per_Doc = '{$this->strIdentificacion}' ";
		$request = $this->select_all($sql);

		if(empty($request))
		{
			$query_insert  = "INSERT INTO persona(Per_Doc,Per_Nom,Per_Ape,Per_Tel,Per_Email,Per_Passw,Rol_ID) 
							  VALUES(?,?,?,?,?,?,?)";
        	$arrData = array($this->strIdentificacion,
    						$this->strNombre,
    						$this->strApellido,
    						$this->intTelefono,
    						$this->strEmail,
    						$this->strPassword,
    						$this->intTipoId    						
    								);
        	$request_insert = $this->insert($query_insert,$arrData);
        	$return = $request_insert;
		}else{
			$return = "exist";
		}
        return $return;
	}

	public function selectClientes()
	{
		$sql = "SELECT Per_ID,Per_Doc,Per_Nom,Per_Ape,Per_Tel,Per_Email,Per_Status 
				FROM persona 
				WHERE Rol_ID = 7 and Per_Status != 0 ";
		$request = $this->select_all($sql);
		return $request;
	}

	public function selectCliente(int $idpersona){
		$this->intIdUsuario = $idpersona;
		$sql = "SELECT Per_ID,Per_Doc,Per_Nom,Per_Ape,Per_Tel,Per_Email,Per_Status, DATE_FORMAT(Per_FecReg, '%d-%m-%Y') as fechaRegistro
				FROM persona
				WHERE Per_ID = $this->intIdUsuario and Rol_ID = 7";
		$request = $this->select($sql);
		return $request;
	}

	public function updateCliente(int $idUsuario, string $identificacion, string $nombre, string $apellido, int $telefono, string $email, string $password){

		$this->intIdUsuario = $idUsuario;
		$this->strIdentificacion = $identificacion;
		$this->strNombre = $nombre;
		$this->strApellido = $apellido;
		$this->intTelefono = $telefono;
		$this->strEmail = $email;
		$this->strPassword = $password;
		$this->strNit = $nit;
		$this->strNomFiscal = $nomFiscal;
		$this->strDirFiscal = $dirFiscal;

		$sql = "SELECT * FROM persona WHERE (Per_Email = '{$this->strEmail}' AND Per_ID != $this->intIdUsuario)
									  OR (Per_Doc = '{$this->strIdentificacion}' AND Per_ID != $this->intIdUsuario) ";
		$request = $this->select_all($sql);

		if(empty($request))
		{
			if($this->strPassword  != "")
			{
				$sql = "UPDATE persona SET Per_Doc=?, Per_Nom=?, Per_Ape=?, Per_Tel=?, Per_Email=?,Per_Pass=? 
						WHERE Per_ID = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail,
        						$this->strPassword
        								);
			}else{
				$sql = "UPDATE persona SET Per_Doc=?, Per_Nom=?, Per_Ape=?, Per_Tel=?, Per_Email=? 
						WHERE Per_ID = $this->intIdUsuario ";
				$arrData = array($this->strIdentificacion,
        						$this->strNombre,
        						$this->strApellido,
        						$this->intTelefono,
        						$this->strEmail
        							);
			}
			$request = $this->update($sql,$arrData);
		}else{
			$request = "exist";
		}
		return $request;
	}

	public function deleteCliente(int $intIdpersona)
	{
		$this->intIdUsuario = $intIdpersona;
		$sql = "DELETE FROM persona WHERE Per_ID = $this->intIdUsuario ";
		$arrData = array(0);
		$request = $this->delete($sql,$arrData);
		return $request;
	}
}

 ?>