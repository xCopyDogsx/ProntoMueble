<?php 
	

	const BASE_URL = "http://localhost/ProntoMueble";

	//Zona horaria
	date_default_timezone_set('America/Bogota');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "prontomueble";
	const DB_USER = "root";
	const DB_PASSWORD = "";
	const DB_CHARSET = "utf8";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ",";
	const SPM = ".";

	//Simbolo de moneda
	const SMONEY = '$';
	
	//Datos envio de correo
	const NOMBRE_REMITENTE = "ProntoMueble";
	const EMAIL_REMITENTE = "admin@prontomueble.store";
	const NOMBRE_EMPESA = "ProntoMueble";
	const WEB_EMPRESA = "www.prontomueble.store";

	const CAT_SLIDER = "1,2,3";
	const CAT_BANNER = "4,5,6";

	//Datos para Encriptar / Desencriptar
	const KEY = 'abelosh';
	const METHODENCRIPT = "AES-128-ECB";

	//Envío
	const COSTOENVIO = 15000;
	



	


 ?>