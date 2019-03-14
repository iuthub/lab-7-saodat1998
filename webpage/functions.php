<?php 
	include_once("config.php");

	function queryMysql($query){
		global $connection;

	    $result = $connection->query($query);
	    if (!$result) 
	    	{
	    		echo $query.'<br>';
	    		die("So`rovda xatolik bor. ".$connection->error);
	    	}
	    
	    return $result;
	}

	function destroySession()
	{
		$_SESSION=array();
		
		if (session_id() != "" || isset($_COOKIE[session_name()]))
			setcookie(session_name(), '', time()-2592000, '/');

		session_destroy();
	}

	function sanitizeString($var)
	{		
		$var = strip_tags($var);
		$var = htmlentities($var, ENT_QUOTES);
		$var = stripslashes($var);
		return mysqli_real_escape_string($GLOBALS['connection'], $var);
	}	

	function strtocode($var){
		return htmlentities($var, ENT_QUOTES);
	}

	function aslString($var){
		return html_entity_decode($var);
	}
	
?>
