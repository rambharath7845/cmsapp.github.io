<?php  
function idgeneration($primary,$table,$str,$dbconn)
{
	$query_select = "SELECT $primary FROM $table ORDER BY $primary Desc";
	$exec_query = $dbconn->connection()->query($query_select);
	$res = mysqli_fetch_assoc($exec_query);
	$snocode = $res[$primary]+1;
	if ($snocode<10){ $snocode="00".$snocode; } elseif ($snocode<100 && $snocode>=10) { $snocode="0".$snocode; }  else{ $snocode=$snocode; }
	$genid = $str.($snocode);
	return $genid;
}

function idgeneration_withoutstr($table,$where,$dbconn)
{
	$query_select = "SELECT COUNT(*) AS TotalRow FROM $table WHERE $where";
	$exec_query = $dbconn->connection()->query($query_select);
	$res = mysqli_fetch_assoc($exec_query);
	$snocode = $res['TotalRow']+1;
	$genid = $snocode;
	return $genid;
}
?>