<?php
require_once 'db.php';
$id=isset($_GET['id']) ? (int)$_GET['id'] : 0;

	$stmt=$db->prepare("select id,titel,inhalt from aufgaben where id=? limit 1");
	$stmt->bind_param('i',$id);
	$stmt->execute();
	$result=$stmt->get_result();
	$aufgabe=$result->fetch_object();	
	$result->free();



if(empty($aufgabe)) {
	header('Location:index.php');
	exit;
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Bearbeitungsformular</title>
</head>
<body>
	<form action="aufgabespeichern.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
		<input type="hidden" name="id" value="<?=$aufgabe->id?>"
		Titel:<br /><input type="text" name="titel" value="<?= htmlentities($aufgabe->titel,ENT_COMPAT) ?>" style="width:100px;" /><br />
		Inhalt:<br/>
		<textarea name="inhalt" style="width:400px;height:200px;"><?= $aufgabe->inhalt ?></textarea><br />
		<button type="submit">Speichern</button></br>
	</form>
</body>
</html>