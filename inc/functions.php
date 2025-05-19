<?php
    if(!defined('ENGINE')){
		die("Hack no attempt!");
	}
	

    function dump($var){
        echo "<pre style='position:absolute; top:300px; left:500px; color:white;'>";
			var_dump($var);
		echo "</pre>";
	}
	function isPOST(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') return true;
	}
	function getTemplate($filename, $tempData = []){
		ob_start();
		include 'temp/' . $filename . '.php';
		$r = ob_get_contents();
		ob_end_clean();
	
		return $r;
	}
	function getVar($name){
		return $GLOBALS[$name];
	}
	function varFilter($v){
		global $db;
		return mysqli_real_escape_string($db, $v);
	}

	function relocationToMain(){
		header('Location: /?site=main');
	}
	
	
	function isLog(){
		if($_SESSION['id']==null and $_SESSION['name']==null) return false;
		
		else return true;
	}
	function deReg(){
		$_SESSION['id']=null;
		$_SESSION['name']=null;
	}
	function getUserId(){
		return (int) $_SESSION['id'];
	}
	
?>