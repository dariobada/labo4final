<?php

// fw/Model.php

	abstract class Model{

		//un miembro protected se puede consumir desde una subclase pero no desde afuera
		protected $db;

		public function __construct(){
			$this->db = Database::getInstance();

		}
	}











?>