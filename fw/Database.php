<?php

class Database {

	private $cn = false;
	private $res;
	private static $instance = false;

	//aplico un patron Singleton -> esto es, generar un constructor privado para que no pueda instanciar un objeto de esta clase. Luego genero una clase estatica getInstance para verificar si la clase ya se encuentra instanciada.  
	private function __construct(){}

	public static function getInstance(){
		//con self me refiero a una variable de mi metodo estático
		//si no existe la instancia, la genero en el momento. con esto me aseguro que solo se pueda realizar 1 sola instancia de una clase
		if(!self::$instance) self::$instance = new Database();
		return self::$instance;

	}

	private function connect(){
		$this->cn = pg_connect("host=ec2-18-203-7-163.eu-west-1.compute.amazonaws.com" . " port=5432" . " dbname=dedj4ur4lq85oa" . " user=bgpyacottnshge" . " password=8af9d771c54c4232576b0690c8db5a9f0fdd23b0494f6acbb826f14bafd480ca");
	}

	public function query($q){
		//si no existe la conexión, la realizo
		if(!$this->cn) $this->connect();

		
		$this->res = pg_query($this->cn, $q);
		if(!$this->res) die(pg_last_error($this->cn) . " -- Consulta: " . $q);
		
	}

	public function numRows(){
		return pg_num_rows($this->res);
	}

	public function fetch(){
		return pg_fetch_assoc($this->res);
	}

	public function fetchAll(){
		$aux = array();
		while($fila = $this->fetch()) $aux[] = $fila;
		return $aux;
	}

	public function escape($str){
		if(!$this->cn) $this->connect();
		return pg_escape_string($this->cn, $str);
	}

	public function escapeWildcards($str){
		$str = str_replace('%', '\%', $str);
		$str = str_replace('_', '\_', $str);
		return $str;
	}
}




?>

