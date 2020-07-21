<?php 
    include("validateRoute.php"); 
    include("db.php");

    $department = $_SESSION['department'];

    $id ="";

    if(isset($_GET['job'])){
        $id = $_GET['job'];
        $query = "DELETE FROM job WHERE id = $id";

        $result = $conn->query($query);

        if($result){
            header("Location: jobs.php?department=" . $department);
        }   

    }else {
        header("Location: jobs.php?department=" . $department);
    }

?>