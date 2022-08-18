<?php
require_once 'db.php';
$id=isset($_POST['id']) ? (int)$_POST['id'] : 0;
$titel=isset($_POST['titel']) ? $_POST['titel'] : '';
$inhalt=isset($_POST['inhalt']) ? $_POST['inhalt'] : '';


if(empty($titel) || empty($inhalt)) {
  header('Location:bearbeitungsformular.php');
  exit;
}
$stmt=$db->prepare("update aufgaben set titel=?,inhalt=? where id=? limit 1");
$stmt->bind_param('ssi',$titel,$inhalt,$id);
$stmt->execute();

header('Location:index.php');
exit;
?>