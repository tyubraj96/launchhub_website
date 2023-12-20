<?php

function getBanner()
{
	global $conn;
	$sql = "SELECT * FROM banner WHERE banner_status = 1";
	$result = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($result);
	$rows = array();
	if ($num_rows > 0) {
		while ($row = mysqli_fetch_object($result)) {
			$rows[] = $row;
		}
	}
	return $rows;
}
function getServices()
{
	global $conn;
	$sql = "SELECT * FROM services WHERE service_status = 1 LIMIT 4;";
	$result = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($result);
	$rows =array();
	if($num_rows > 0){
		while($row = mysqli_fetch_object($result)){
			$rows[]=$row;
		}
	}
	return $rows;
}
function getALLservices()
{
	global $conn;
	$sql = "SELECT * FROM services WHERE service_status = 1 ";
	$result = mysqli_query($conn, $sql);
	$num_rows = mysqli_num_rows($result);
	$arr = array();
	if($num_rows > 0){
		while($row = mysqli_fetch_object($result)){
			$arr[] = $row;
		}
	}
	return $arr;
}
?>