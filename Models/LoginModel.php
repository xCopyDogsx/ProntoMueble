<?php 

	class LoginModel extends Mysql
	{
		private $intIdUsuario;
		private $strUsuario;
		private $strPassword;
		private $strToken;

		public function __construct()
		{
			parent::__construct();
		}	

		public function loginUser(string $usuario, string $password)
		{
			$this->strUsuario = $usuario;
			$this->strPassword = $password;
			$sql = "SELECT Per_ID,Per_Status FROM persona WHERE 
					Per_Email = '$this->strUsuario' and 
					Per_Passw = '$this->strPassword' and 
					Per_Status != 0 ";
			$request = $this->select($sql);
			return $request;
		}

		public function sessionLogin(int $iduser){
			$this->intIdUsuario = $iduser;
			//BUSCAR ROLES 
			$sql = "SELECT p.Per_ID,
							p.Per_Doc,
							p.Per_Nom,
							p.Per_Ape,
							p.Per_Tel,
							p.Per_Email,
							r.Rol_ID,r.Rol_Nom,
							p.Per_Status 
					FROM persona p
					INNER JOIN rol r
					ON p.Rol_ID = r.Rol_ID
					WHERE p.Per_ID = $this->intIdUsuario";
			$request = $this->select($sql);
			$_SESSION['userData'] = $request;
			return $request;
		}

		public function getUserEmail(string $strEmail){
			$this->strUsuario = $strEmail;
			$sql = "SELECT Per_ID,Per_Nom,Per_Ape,Per_Status FROM persona WHERE 
					Per_Email = '$this->strUsuario' and  
					Per_Status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function setTokenUser(int $idpersona, string $token){
			$this->intIdUsuario = $idpersona;
			$this->strToken = $token;
			$sql = "UPDATE persona SET Per_Toke = ? WHERE Per_ID = $this->intIdUsuario ";
			$arrData = array($this->strToken);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function getUsuario(string $email, string $token){
			$this->strUsuario = $email;
			$this->strToken = $token;
			$sql = "SELECT Per_ID FROM persona WHERE 
					Per_Email = '$this->strUsuario' and 
					Per_Toke = '$this->strToken' and 					
					Per_Status = 1 ";
			$request = $this->select($sql);
			return $request;
		}

		public function insertPassword(int $idPersona, string $password){
			$this->intIdUsuario = $idPersona;
			$this->strPassword = $password;
			$sql = "UPDATE persona SET Per_Passw = ?, Per_Toke = ? WHERE Per_ID = $this->intIdUsuario ";
			$arrData = array($this->strPassword,"");
			$request = $this->update($sql,$arrData);
			return $request;
		}
	}
 ?>