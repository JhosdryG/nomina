<?php 
    include("validateRoute.php"); 
    include("db.php");

    $user = $_SESSION['user'];

    $id ="";

    if(isset($_GET['user'])){
        $id = $_GET['user'];
        $query = "DELETE FROM users WHERE id = $id";

        $result = $conn->query($query);

        if($result){
            header("Location: users.php");
        }   

    }else {
        header("Location: users.php");
    }

?>