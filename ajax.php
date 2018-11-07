<?php

date_default_timezone_set('Asia/Colombo');
require('database.php');

$db = new DB();
require('config.php');

if(isset($_GET['ajaxCapital'])){
	getAjaxCapital($db);
}

if(isset($_GET['getAjaxRoyal'])){
	getAjaxRoyal(db);
}

function getAjaxCapital($db)
{
	$date = $_POST['date'];
	
	
	$result = $db->getAjaxCapital($date);
	if(empty($result))
	{
	    $response = FALSE;
	    echo json_encode($response);
	}
	else{
	    echo json_encode($result);
	}
}

function getAjaxRoyal($db)
{
	error_log("get ajax royal called....");
	$date = $_POST['date'];
	
	$result = $db->getAjaxRoyal($date);
	if(empty($result))
	{
	    $response = FALSE;
	    echo json_encode($response);
	}
	else{
	    echo json_encode($result);
	}
}
?>