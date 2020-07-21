<?php include("db.php"); 
session_start();

if(isset($_SESSION["logged"])){

    if($_SESSION["logged"]) header("Location: admin.php");
}

$error = null;

if(isset($_POST["login"])){
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $query = "SELECT *  FROM users WHERE users.name = '$user' AND users.pass = '$pass'";

    $userExist = $conn->query($query) or die('Error: ' . mysqli_error($conn));
    $userExist = $userExist -> num_rows > 0;

    if($userExist){
        $_SESSION["logged"] = true;
        header("Location: admin.php");
    }else{
        $_SESSION["logged"] = false;
        $error = "Clave o contraseña invalida.";
    }
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | login</title>
    <!-- {{!-- Google fonts Roboto --}} -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- {{!-- Font Awesome CDN --}} -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/solid.css" integrity="sha384-fZFUEa75TqnWs6kJuLABg1hDDArGv1sOKyoqc7RubztZ1lvSU7BS+rc5mwf1Is5a" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/fontawesome.css" integrity="sha384-syoT0d9IcMjfxtHzbJUlNIuL19vD9XQAdOzftC+llPALVSZdxUpVXE0niLOiw/mn" crossorigin="anonymous">
    <!-- {{!-- My Styles --}} -->
    <link rel="stylesheet" type="text/css" href="css/admin_login.min.css">
</head>
<body>
    <div class="container">

        <div class="form_box">

            <div class="welcome_box">
                <h2 class="title">Bienvenido</h2>
                <i class="fas fa-lock lock_icon"></i>
                <p class="para">Inicia sesión y administra empresas, departamentos, cargos y empleados</p>
            </div>

            <form action="index.php" method="POST" class="form_login">

                <label class="form_title">Iniciar sesión</label>

                <input type="text" name="user" id="username" placeholder="Ingrese usuario..." />

                <input type="password" name="pass" id="password" placeholder="Ingrese contraseña..."/>
                
                <input type="submit" value="Ingresar" name="login"/>
                <button>Recuperar</button>

                <?php 
                    if($error){
                        echo "<span class='log_error'>$error</span>";
                    }
                ?>
            </form>

        </div>

    </div>

</body>
</html>