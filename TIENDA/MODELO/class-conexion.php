<?php 

    class con{
        private $con;
        public function __construct() {
            require_once("../../../../cred.php");
            $this->con = new mysqli("localhost",USU_CON,PSW_CON,"tienda");
        }

        public function getCon() { 
            return $this->con; 
       } 
        
    }

	
?>