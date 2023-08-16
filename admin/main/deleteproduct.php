<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("DELETE FROM table_barang WHERE id_barang= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>