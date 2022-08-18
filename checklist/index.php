<?php
require_once 'db.php';
$alleAufgaben=array();
$result=$db->query("select id,titel,inhalt,erledigt from aufgaben;");
while($row=$result->fetch_object()) {
  $alleAufgaben[]=$row;
}
$result->free();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>checkliste</title>
  <script>
  function checkboxgeaendert(aufgabe_id) {
	  let cb=document.getElementById('checkbox_'+aufgabe_id);
	  location.href='erledigungspeichern.php?aufgabe_id='+aufgabe_id+'&erledigt='+(cb.checked ? 1 : 0);
  }
  </script>
</head>
<body>

<table border="1" cellspacing="0" style="border-collapse:collapse;">
  <tr>    
    <th></th>
    <th>Titel</th>
	<th>Inhalt</th>
  </tr> 
  <?php
foreach($alleAufgaben as $a) {
?>
  <tr> 
	<td><input type="checkbox" name="erledigte[]" id="checkbox_<?= $a->id ?>" value="34" <?= $a->erledigt ? 'checked' : '' ?> onchange="checkboxgeaendert(<?= $a->id ?>)" /></td>  
    <td><?= $a->titel ?></td>
    <td><?= nl2br($a->inhalt) ?></td>	
	<td><a href="bearbeitungsformular.php?id=<?= $a->id ?>">Bearbeiten</a></td>
  </tr>
<?php
}
?>
</table><br />
	<form action="aufgabehinzufuegen.php" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
		Titel:<br /><input type="text" name="titel" value="" style="width:100px;" /><br />
		Inhalt:<br/>
		<textarea name="inhalt" style="width:400px;height:200px;"></textarea><br />
		<button type="submit">Hinzufügen</button></br>
	</form>
</body>
</html>