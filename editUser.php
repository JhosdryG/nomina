<?php 
    include("validateRoute.php"); 
    include("db.php");

    $created = false;
    $error = false;
    $errormsg = "";
    $insert_id = "";

    $id = "";
    $row = "";

    if (isset($_GET['user'])) {
        $id = $_GET['user'];
        $query = "SELECT * FROM users WHERE id = $id";
        $result = $conn->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
        }
    }


    if (isset($_POST['add'])) {

        if (
            isset($_POST['name']) && 
             isset($_POST['pass'])
        ) {
            $name = $_POST['name']; 
            $pass = $_POST['pass'];
    
            $query = "UPDATE users set name = '$name', pass = '$pass' WHERE id = $id;";
    
            $result = $conn->query($query);
    
            if ($result) {
                $created = true;
                $query = "SELECT * FROM users WHERE id = $id";
                $result = $conn->query($query);

                if ($result) {
                    $row = $result->fetch_assoc();
                }
            } else {
                if (mysqli_errno($conn) == 1062) {
                    $errormsg = "YA EXISTE UN USUARIO CON ESE NOMBRE";
                } else {
                    $errormsg = "HA OCURRIDO UN ERROR INESPERADO " . mysqli_errno($conn);
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
    <title>Editar Usuario</title>
    <link rel="icon" type="image/png" href="img/icon.png">
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
    <link rel="stylesheet" href="css/msgportal.min.css">



</head>

<body>
    <div class="nav_container">
        <nav class="nav" id="menuNormal">
            <div class="container">
                <div class="main_nav_buttons">
                    <div class="menu_icon nav_buttons" id="menu_button">
                        <i class="fas fa-bars" ></i>
                        <span class="icon_text">Menu</span>
                    </div>
                    
                </div>
                <div class="menu-center">
                    <div class="nav_buttons options">
                        <a href="admin.php" class="icon_link building"><i class="fas fa-building"></i><span class="icon_text">Empresas</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="users.php" class="icon_link building active"><i class="fas fa-user"></i><span class="icon_text active">Usuarios</span></a>
                    </div>
                </div>

                <div class="logout_button nav_buttons">
                    <a href="logout.php" class="icon_link"><i class="fas fa-door-open"></i><span class="icon_text">Salir</span></a>
                    
                </div>
            </div>
        </nav>
        <div class="alternative-menu" id="alternative-menu">
            <a href="admin.php" class="menu_link"><i class="fas fa-building"></i><span class="icon_text_alternative">Empresas</span></a>
            <a href="users.php" class="menu_link"><i class="fas fa-user"></i><span class="icon_text_alternative">Usuarios</span></a>
            <a href="logout.php" class="menu_link"><i class="fas fa-door-open"></i><span class="icon_text_alternative">Salir</span></a>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <h2>Editar Usuario</h2>
        </div>
    </header>

    <main class="main">
        <div class="container">

            <form class="form" method="POST" action="editUser.php?user=<?php echo $id ?>">
               
                <div class="form_section section_form">
                    <div class="form_group">
                        <label for="name" class="form_group_label">
                            Nombre
                        </label>
                        <input id="name" type="text" name="name" value="<?php echo $row['name'] ?>"/>
                    </div>
                    <div class="form_group">
                        <label for="pass" class="form_group_label">
                            Contraseña
                        </label>
                        <input id="pass" type="text" name="pass" value="<?php echo $row['pass'] ?>"/>
                    </div>
                </div>
                
                <div class="button_group button_group_update form_section">
                    <input type="submit" name="add" value="Editar" class="button button_add" />
                    <a href="users.php" class="button button_back">Volver</a>
                    <a href="deleteUser.php?user=<?php echo $id ?>" class="button button_delete">Eliminar</a>
                </div>
            </form>
        </div>
    </main>

    <?php 
        if($created){ ?>
            <div class="portal">
                <div class="portal_box">
                    <p class="portal_box_title">
                        Usuario modificado satisfactoriamente
                    </p>
                    <a href="users.php" class="portal_box_btn">Aceptar</a>
                </div>
            </div>
    <?php }else if($error){ ?>

        <div class="portal" id="errorportal">
                <div class="portal_box">
                    <p class="portal_box_title">
                        <?php echo $errormsg ?>
                    </p>
                    <button id="closeportal" class="portal_box_btn">Aceptar</button>
                </div>
            </div>

    <?php } ?>
    

    <script src="scripts/adminMenu.js"></script>
    <script>
        
        let portal = document.getElementById("errorportal");
        let btn = document.getElementById("closeportal").addEventListener('click',()=>{
            portal.classList.toggle("hide");
        });
    </script>
</body>

</html>