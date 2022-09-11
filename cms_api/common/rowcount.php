<?php
function tablerowcount($tablename,$condition,$dbconn)
{
	$query_row = "SELECT * FROM $tablename WHERE $condition";
	$exec_query = $dbconn->connection()->query($query_row);
	$rowcounted = mysqli_num_rows($exec_query);
	return $rowcounted;
}
