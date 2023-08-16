<?php
	include('../connect.php');
	$id=$_GET['id'];
	$result = $db->prepare("DELETE FROM table_pembelian WHERE invoice= :memid");
	$result->bindParam(':memid', $id);
	$result->execute();
?>