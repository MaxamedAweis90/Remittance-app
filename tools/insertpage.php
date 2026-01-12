<?php
include "conn.php";
include "function.php";
$sql = get_sql($_POST);

// print_r($_FILES);
$ress = $conn->query($sql);
$r = $ress->fetch_array();

$msg = explode("|",$r[0]);
if(trim($msg[0]) == "success"){
$uploadDirectory = "../uploads/";
$target = $uploadDirectory . basename(@$_FILES['txt_image']['name']);
move_uploaded_file(@$_FILES["txt_image"]["tmp_name"], $target);
}
echo $r[0];
// echo $sql;
?>