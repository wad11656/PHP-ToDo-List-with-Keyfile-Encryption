<?php
include 'db.incl.php';

if(isset($_POST['id'])){
    $value = $_POST['value'];
    $column = $_POST['column'];
    $id = $_POST['id'];
    echo 'hi',$value, $column, $id;
    $sql="UPDATE todos_tbl SET $column = '$value' WHERE todo_id = '$id' LIMIT 1";
    try{
        mysqli_query($db, $sql);
        echo "Update Successful";
    } catch (mysqli_sql_exception $e){
        echo $e->__toString;
    }
}
?>