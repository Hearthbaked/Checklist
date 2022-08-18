<?php
require_once 'db.php';

$titel=isset($_POST['titel']) ? $_POST['titel'] : '';
$inhalt=isset($_POST['inhalt']) ? $_POST['inhalt'] : '';

if(empty($titel) || empty($inhalt)) {
  header('Location:index.php');
  exit;
}
$stmt=$db->prepare("insert into aufgaben(titel,inhalt) values(?,?)");
$stmt->bind_param('ss',$titel,$inhalt);
$stmt->execute();

header('Location:index.php');
exit;
?>