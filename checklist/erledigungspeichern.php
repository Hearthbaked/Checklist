<?php
require_once 'db.php';
$aufgabe_id=isset($_GET['aufgabe_id']) ? (int)$_GET['aufgabe_id'] : 0;
if(empty($aufgabe_id)) {
	header('Location:index.php');
	exit;
}
if(!isset($_GET['erledigt'])) {
	
	header('Location:index.php');
	exit;
}
$erledigt=$_GET['erledigt']==0 ? 0 : 1;

$stmt=$db->prepare("update aufgaben set erledigt=? where id=? limit 1");
$stmt->bind_param('ii',$erledigt,$aufgabe_id);
$stmt->execute();

header('Location:index.php');
exit;
?>