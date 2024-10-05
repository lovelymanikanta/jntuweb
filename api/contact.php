<?php
include_once "crudop/crud.php";
$crud = new Crud();

header('Content-Type: application/x-www-form-urlencoded');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');



if(isset($_POST['action']) && $_POST['action']=='contact')
{
	$name= isset($_POST['name']) && $_POST['name']!='' ? $_POST['name'] :'';
	$email= isset($_POST['email']) && $_POST['email']!='' ? $_POST['email'] :'';
	$subject= isset($_POST['subject']) && $_POST['subject']!='' ? $_POST['subject'] :'';
	$message= isset($_POST['message']) && $_POST['message']!='' ? $_POST['message'] :'';

	

	if($name=='' || $email==''|| $subject=='' || $message=='')
	{
		echo 'empty';
		exit;
	}
	else
	{
		$qry_ins= "insert into contact(name,email,subject,message) values('".$name."','".$email."','".$subject."', '".$message."')";

		$result_set = $crud->execute($qry_ins);

		if(!$result_set)
		{
			echo 'error';
			exit;
		}
		else
		{
			echo 'success';
			exit;
		}
	}
}
?>