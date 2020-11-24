<?php

class Conexion {
	
	static public function conectar() {
		
		$link = new PDO("mysql:host=localhost;dbname=bdcovid19cnspt","root","3000REIVAJinf1976");

		$link->exec("set names utf8");

		return $link;

	}

	static public function conectarBDFicha() {
		
		$link = new PDO("mysql:host=localhost;dbname=bdfichaepidemiologicacnspt","root","3000REIVAJinf1976");

		$link->exec("set names utf8");

		return $link;

	}

	// HOGAR
	// static public function conectarSQLServer() {
		
	// 	try {
	//         $link = new PDO("sqlsrv:Server=192.168.0.208;Database=BdHistoriasClinicas", "sa", "3000REIVAJinf1976");
	//     }
	//     catch(PDOException $e) {
	//         die("Error connecting to SQL Server: " . $e->getMessage());
	//     }

	// 	$link->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

	// 	return $link;

	// }

	// TRABAJO
	static public function conectarSQLServer() {
		
		try {
	        $link = new PDO("sqlsrv:Server=172.16.0.74;Database=BdHistoriasClinicas", "cimfa_10_salud", "_Iv8?o%dI^maciUG");
	    }
	    catch(PDOException $e) {
	        die("Error connecting to SQL Server: " . $e->getMessage());
	    }

		$link->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		return $link;

	}

}