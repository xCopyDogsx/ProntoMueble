<?php 
	

	const BASE_URL = "https://www.prontomueble.store";

	//Zona horaria
	date_default_timezone_set('America/Bogota');

	//Datos de conexión a Base de Datos
	const DB_HOST = "localhost";
	const DB_NAME = "u925028044_prontomueble";
	const DB_USER = "u925028044_brian";
	const DB_PASSWORD = "BdA2021PrSr";
	const DB_CHARSET = "utf8";

	//Deliminadores decimal y millar Ej. 24,1989.00
	const SPD = ",";
	const SPM = ".";

	//Simbolo de moneda
	const SMONEY = "$";
	const CURRENCY = "USD";
	const ID_CLIENTE="AbhtFoCdzF7_RkgYoOh1sn74yc6EH-IdaNXKut2NSb0tTgIx_rhWGAueQM0rTK5QdH1Ntyfj_4shKZS9";
	const URL_PAYPAL="https://api-m.sandbox.paypal.com";
	const SECRET = "EKUDqlPEQM3OSxX0bslhhozpiI9lSflOYSnlK9h9LllF9BcncH0t4FUN0RKlWX1efTbko4aECf18hDrx";
	//Datos envio de correo
	const NOMBRE_REMITENTE = "ProntoMueble";
	const EMAIL_REMITENTE = "admin@prontomueble.store";
	const NOMBRE_EMPESA = "ProntoMueble";
	const NOMBRE_EMPRESA = "ProntoMueble";
	const WEB_EMPRESA = "www.prontomueble.store";
	const TELEMPRESA = "123456";
	const DIRECCION = "Calle 13#17-54 Bogotá,Colombia";
	const EMAIL_EMPRESA = "admin@prontomueble.store";
	const EMAIL_PEDIDOS = "admin@prontomueble.store";	
	const CAT_SLIDER = "1,2,3";
	const CAT_BANNER = "4,5,6";

	//Datos para Encriptar / Desencriptar
	const KEY = '@?DeCrIpTMeThis2021!';
	const METHODENCRIPT = "AES-128-ECB";

	//Envío
	const COSTOENVIO = 15000;
	



	


 ?>