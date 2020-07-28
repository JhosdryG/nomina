<?php 
    include("validateRoute.php"); 
    include("db.php");

    $enterprise = $_SESSION['enterprise'];

    $id ="";

    if(isset($_GET['concept'])){
        $id = $_GET['concept'];
        $query = "DELETE FROM concepts WHERE id = $id";

        $result = $conn->query($query);

        if($result){
            header("Location: concepts.php?enterprise=" . $enterprise);
        }   

    }else {
        header("Location: concepts.php?enterprise=" . $enterprise);
    }

?>