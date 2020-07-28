<?php 
    include("validateRoute.php"); 
    include("db.php");

    $enterprise = $_SESSION['enterprise'];

    $id ="";

    if(isset($_GET['department'])){
        $id = $_GET['department'];
        $query = "DELETE FROM department WHERE id = $id";

        $result = $conn->query($query);

        if($result){
            header("Location: departments.php?department=" . $enterprise);
        }   

    }else {
        header("Location: departments.php?department=" . $enterprise);
    }

?>