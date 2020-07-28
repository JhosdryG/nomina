<?php 
    include("validateRoute.php"); 
    include("db.php");

    $id_enterprise = $_SESSION['enterprise'];
    $department = $_SESSION['department'];

    $id ="";

    if(isset($_GET['employee'])){
        $id = $_GET['employee'];
        $query = "DELETE FROM employees WHERE id = $id";

        $result = $conn->query($query);

        if($result){
            header("Location: employees.php?employee=" . $department);
        }   

    }else {
        header("Location: employees.php?employee=" . $department);
    }

?>