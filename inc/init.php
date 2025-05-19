<?
if (!defined('ENGINE')) {
    die("Hack no attempt!");
}
$module = $_GET['site'];

	
	if(true){
		if($module == 'log'){
			$file = 'regLog';

		}elseif($module == 'reg'){
            $file = 'regReg';

        }elseif($module == 'main'){
            $file = 'main';

		}else{
			if(empty($module)) $file = 'regLog';
			else{
				$error = 404;
			}
		}
	}else{
		 
	}
	
	// Подключение выбранного модуля
	include 'inc/'.$file.'.php';