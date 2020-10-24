<?php

// fw/View.php

	abstract class View{


		public function render(){
			//de esta forma, incluyo el nombre de la clase de donde estoy llamado, y así se llama el archivo html (mismo nombre)
			include '../html/'.get_class($this).'.php';
		}

	}





?>