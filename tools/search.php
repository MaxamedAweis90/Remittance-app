<?php 
$sql=$_POST['sql'];
include("conn.php");
$res= $conn->query($sql);

while($row=$res->fetch_array(MYSQLI_NUM)){
	foreach ($row as $key => $value) {
		echo"$value,";
	}
}
?>
