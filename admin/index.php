<?php #header("location: appointments.php");
session_start();

$flag = 0;

if(isset($_SESSION['user_type'])){
    if($_SESSION['user_type'] == 3){
        $flag += 1;
    } else {
        $flag = 0;
    }
} else {
    $flag = 0;
}


if($flag>0){
  header("location: appointments.php");   
} else {
  header("location: ../index.php"); 
}
# header("location: appointments.php");  
# 
# 
?>
