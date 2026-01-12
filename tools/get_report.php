<style>
#Reports_table {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-top: 10px;
}
#Reports_table td, #Reports_table th {
  border: 1px solid #ddd;
  padding: 8px;
}
#Reports_table tr:hover {background-color: #ddd;}
#Reports_table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #696cff !important;
  color: white;
  font-size: 13px;
}
#tbl_exam_update {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

</style>

<?php
$sql=$_POST['sql'];
include("function.php");
get_report($sql);

?>