<?php
include("validateRoute.php");
include("db.php");

$created = false;
$error = false;
$errormsg = "";
$insert_id = "";

$id_enterprise = $_SESSION['enterprise'];
$department = $_SESSION['department'];


$id = "";
$row = "";

if (isset($_GET['job'])) {
    $id = $_GET['job'];
    $query = "SELECT * FROM job WHERE id = $id";

    $result = $conn->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
    }
} else {
    header("Location: jobs.php?department=" . $department);
}



if (isset($_POST['add'])) {

    if (
        isset($_POST['name']) &&
        isset($_POST['weekhours']) &&
        isset($_POST['price_hour'])
    ) {
        $name = $_POST['name'];
        $weekhours = $_POST['weekhours'];
        $price_hour = $_POST['price_hour'];



        $query = "UPDATE job set name = '$name', weekhours = $weekhours, price_hour = $price_hour WHERE id = $id;";

        $result = $conn->query($query);

        if ($result) {
            $created = true;
            $query = "SELECT * FROM job WHERE id = $id";

            $result = $conn->query($query);

            if ($result) {
                $row = $result->fetch_assoc();
            }
        } else {
            if (mysqli_errno($conn) == 1062) {
                $errormsg = "YA EXISTE UN CARGO CON ESE NOMBRE";
            } else {
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
    <link rel="stylesheet" href="css/msgportal.min.css">
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
                        <a href="departments.php?enterprise=<?php echo $id_enterprise ?>" class="icon_link"><i class="fas fa-sitemap"></i><span class="icon_text">Departamentos</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="jobs.php?department=<?php echo $department ?>" class="icon_link active building"><i class="fas fa-briefcase active"></i><span class="icon_text active">Cargos</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="employees.php?department=<?php echo $department ?>" class="icon_link"><i class="fas fa-users"></i><span class="icon_text">Empleados</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="concepts.php" class="icon_link"><i class="fas fa-money-check"></i><span class="icon_text">Conceptos De Pago</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="payroll.php" class="icon_link"><i class="fas fa-money-check-alt"></i><span class="icon_text">Nómina</span></a>
                    </div>
                </div>

                <div class="logout_button nav_buttons">
                    <a href="/index.php" class="icon_link"><i class="fas fa-door-open"></i><span class="icon_text">Salir</span></a>
                </div>
            </div>
        </nav>
        <div class="alternative-menu" id="alternative-menu">
            <a href="admin.php" class="menu_link"><i class="fas fa-building"></i><span class="icon_text_alternative">Empresas</span></a>
            <a href="departments.php" class="menu_link"><i class="fas fa-sitemap"></i> <span class="icon_text_alternative">Departamentos</span></a>
            <a href="jobs.php?department=<?php echo $department ?>" class="menu_link"><i class="fas fa-briefcase"></i><span class="icon_text_alternative">Cargos</span></a>
            <a href="employees.php?department=<?php echo $department ?>" class="menu_link "><i class="fas fa-users "></i><span class="icon_text_alternative">Empleados</span></a>
            <a href="concepts.php" class="menu_link"><i class="fas fa-money-check"></i><span class="icon_text_alternative">Conceptos De Pago</span></a>
            <a href="payroll.php" class="menu_link"><i class="fas fa-money-check-alt"></i><span class="icon_text_alternative">Nómina</span></a>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <h2>Editar Cargo</h2>
        </div>
    </header>

    <main class="main">
        <div class="container">

            <form class="form" method="POST" action="editJob.php?job='<?php echo $id ?>'">

                <div class="form_section section_form">
                    <div class="form_group">
                        <label for="" class="form_group_label">
                            Nombre
                        </label>
                        <input id="title" type="text" name="name" value="<?php echo $row['name'] ?>" />
                    </div>
                    <div class="form_group section_form">
                        <label for="" class="form_group_label">
                            Horas Semanales
                        </label>
                        <input id="detailPrice" type="number" name="weekhours" value="<?php echo $row['weekhours'] ?>" />
                    </div>
                    <div class="form_group section_form">
                        <label for="" class="form_group_label">
                            Precio De La Hora
                        </label>
                        <input id="bigPrice" type="number" name="price_hour" value="<?php echo $row['price_hour'] ?>" />
                    </div>
                </div>

                <div class="button_group button_group_update form_section">

                    <input type="submit" name="add" value="Editar" class="button button_add" />
                    <a href="jobs.php?department=<?php echo $department ?>" class="button button_back">Volver</a>
                    <a href="deleteJob.php?job=<?php echo $id ?>" class="button button_delete">Eliminar</a>
                </div>
            </form>
        </div>
    </main>
    <?php
    if ($created) { ?>
        <div class="portal">
            <div class="portal_box">
                <p class="portal_box_title">
                    Cargo modificado satisfactoriamente
                </p>
                <a href="jobs.php?department=<?php echo $department ?>" class="portal_box_btn">Aceptar</a>
            </div>
        </div>
    <?php } else if ($error) { ?>

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
        let btn = document.getElementById("closeportal").addEventListener('click', () => {
            portal.classList.toggle("hide");
        });
    </script>
</body>

</html>