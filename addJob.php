<?php 
    include("validateRoute.php"); 
    include("db.php");

    $created = false;
    $error = false;
    $errormsg = "";
    $insert_id = "";

    if(isset($_POST['add'])){
        
        if(isset($_POST['name'])){
            $name = $_POST['name']; 
            $enterprise = $_SESSION['enterprise'];

            $query = "INSERT INTO department(name,enterprise_id) VALUES ('$name',$enterprise);";

            $result = $conn->query($query);

            if($result){
                $created = true;
                $insert_id = $conn->insert_id;
            }else{
                if(mysqli_errno($conn) == 1062){
                    $errormsg = "YA EXISTE UN DEPARTAMENTO CON ESE NOMBRE";
                }else{
                    $errormsg = "HA OCURRIDO UN ERROR INESPERADO " . mysqli_error($conn);
                }

                $error = true;
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <!-- {{!-- Firebase scripts --}} -->
    <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.0/firebase-storage.js"></script>
    <!-- {{!-- Google fonts Roboto --}} -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- {{!-- Font Awesome CDN --}} -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/solid.css" integrity="sha384-fZFUEa75TqnWs6kJuLABg1hDDArGv1sOKyoqc7RubztZ1lvSU7BS+rc5mwf1Is5a" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/fontawesome.css" integrity="sha384-syoT0d9IcMjfxtHzbJUlNIuL19vD9XQAdOzftC+llPALVSZdxUpVXE0niLOiw/mn" crossorigin="anonymous">
    <!-- {{!-- Sweet Alert CDN --}} -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <!-- {{!-- My Styles --}} -->
    <link rel="stylesheet" href="css/admin.min.css">
    <link rel="stylesheet" href="css/add_product.min.css">

    </body>
</head>

<body>
    <div class="nav_container">
        <nav class="nav" id="menuNormal">
            <div class="container">
                <div class="main_nav_buttons">
                    <div class="menu_icon nav_buttons" id="menu_button">
                        <i class="fas fa-bars"></i>
                        <span class="icon_text">Menu</span>
                    </div>

                </div>

                <div class="menu-center">
                    <div class="nav_buttons options">
                        <a href="admin.php" class="icon_link building"><i class="fas fa-building"></i><span class="icon_text">Empresas</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="departments.php" class="icon_link"><i class="fas fa-sitemap"></i><span class="icon_text">Departamentos</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="jobs.php" class="icon_link active building"><i class="fas fa-briefcase active"></i><span class="icon_text">Cargos</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="employees.php" class="icon_link"><i class="fas fa-users"></i><span class="icon_text">Empleados</span></a>
                    </div>
                </div>

                <div class="logout_button nav_buttons">
                    <a href="index.php" class="icon_link"><i class="fas fa-door-open"></i><span class="icon_text">Salir</span></a>
                </div>
            </div>
        </nav>
        <div class="alternative-menu" id="alternative-menu">
            <a href="admin.php" class="menu_link"><i class="fas fa-building"></i><span class="icon_text_alternative">Empresas</span></a>
            <a href="departments.php" class="menu_link"><i class="fas fa-sitemap"></i> <span class="icon_text_alternative">Departamentos</span></a>
            <a href="jobs.php" class="menu_link"><i class="fas fa-briefcase"></i><span class="icon_text_alternative">Cargos</span></a>
            <a href="employees.php" class="menu_link "><i class="fas fa-users "></i><span class="icon_text_alternative">Empleados</span></a>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <h2>Agregar Cargo</h2>
        </div>
    </header>

    <main class="main">
        <div class="container">

            <form class="form">

                <div class="form_section section_form">
                    <div class="form_group">
                        <label for="" class="form_group_label">
                            Nombre
                        </label>
                        <input id="title" type="text" name="title" value="" />
                    </div>
                    <div class="form_group section_form">
                        <label for="" class="form_group_label">
                            Horas Semanales
                        </label>
                        <input id="detailPrice" type="number" name="detailPrice" value="" />
                    </div>
                    <div class="form_group section_form">
                        <label for="" class="form_group_label">
                            Precio De La Hora
                        </label>
                        <input id="bigPrice" type="number" name="bigPrice" value="" />
                    </div>
                </div>

                <div class="button_group form_section">

                    <input type="button" onclick="onSubmit" value="Agregar" class="button button_add" />
                    <a href="jobs.php" class="button button_back">Volver</a>
                </div>
            </form>
        </div>
    </main>
    <script src="scripts/adminMenu.js"></script>
</body>

</html>