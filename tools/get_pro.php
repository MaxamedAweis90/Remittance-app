<?php
include("conn.php");
extract($_POST);
$sql="call search_sp('$text','$action')";
$ress = $conn->query($sql);
if(@$ress->num_rows == 0){
    echo "<div>Not result found</div>";
    return false;
}
while($row = $ress->fetch_array()){
    ?>

<li class="list-group-item li_pro" id="<?php echo $row[1]?>"><?php echo $row[1]?></li>
<?php
}


?>



<style>
    .list-group-item:hover{
        cursor: pointer;
    }
</style>