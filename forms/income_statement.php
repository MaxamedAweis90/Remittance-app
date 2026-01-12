<?php
include("./../tools/function.php");
$sql=$_POST['sql'];
if($sql == "all"){
$s1 = generateIncomeStatement();
echo $s1;
// echo $sql;
}
else{
$r = explode(",",$sql);
$ss = generateIncomeStatementHTML($r[0],$r[1]);

echo $ss;

// echo $r[1];

}


?>

