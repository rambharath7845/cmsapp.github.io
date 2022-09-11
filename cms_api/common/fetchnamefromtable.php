<?php 
function fetchname($table,$fetchname,$condition,$dbconn)
{
	
	$query = "SELECT $fetchname FROM $table WHERE $condition";
	$exec = $dbconn->connection()->query($query);
	if ($row = mysqli_fetch_assoc($exec)) {

		$fetchname= $row[$fetchname];
	}
	return $fetchname;
}
?>