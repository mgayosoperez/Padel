<?php

require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/User.php");




class FilesMapper {


	private $db;
	public function __construct($userid) {
		$estructura= "uploads/$userid";
		if(!file_exists ( $estructura )){
			if(!mkdir($estructura, 0777, true)){
		}
		}
		
	}


		public function findFilesById($userid) {

        		$ficheros1  = scandir("$userid");
        		$losfich =	array_filter($ficheros1, "esfich");


        		return $losfich;

    		}

    	public function findDirectoriesById($userid) {

        		$ficheros1  = scandir("$userid");
        		$losdirec = array_filter($ficheros1, "noesfich");

        		return $losdirec;

    		}





	}

	function esfich($var){
			$trozos=explode(".", $var);
			if(array_key_exists("1",$trozos)){
				return $var;
			}
		}
		function noesfich($var){
			$trozos=explode(".", $var);
			if(!array_key_exists("1",$trozos)){
				return $var;
			}
		}
