<?php
include 'db.incl.php';

if(isset($_POST['id'])){
    // Define prepared statement
    $column = $_POST['column'];
    if($sql = $db->prepare("UPDATE todos_tbl SET $column = ? WHERE todo_id = ? LIMIT 1")){
        $sql->bind_param('si', $value, $id);

        // Set variables
        $value = $_POST['value'];
        $id = $_POST['id'];

        // Execute prepared statement
        try{
            $sql->execute();
            echo "Update Successful";
        }
        catch (mysqli_sql_exception $e){
            echo $e->__toString;
        }
    } else {
        var_dump($db->error);
    }
}
?>