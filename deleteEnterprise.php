<?php 
    include("validateRoute.php"); 
    include("db.php");

    $enterprise = $_SESSION['enterprise'];

    $id ="";

    if(isset($_GET['enterprise'])){
        $id = $_GET['enterprise'];
        $query = "DELETE FROM enterprise WHERE id = $id";

        $result = $conn->query($query);

        if($result){
            header("Location: admin.php");
        }   

    }else {
        header("Location: admin.php");
    }

?>