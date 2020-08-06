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
$jobs = '';



if (isset($_GET['employee'])) {
    $id = $_GET['employee'];
    $query = "SELECT * FROM employees WHERE id = $id";


    $result = $conn->query($query);
    $currentJob = "";

    if ($result) {
        $row = $result->fetch_assoc();
        $employee = $row;
        $name = $row['name'];
        $name = explode(" ", $name);
        $currentJob = $row['job_id'];
    }

    $query = "SELECT * FROM job WHERE department_id = $department";
    $result = $conn->query($query);


    while ($row = $result->fetch_assoc()) {
        if($currentJob == $row["id"]){
            $jobs .= '<option value="' . $row['id'] . '" selected="selected">' . $row['name'] . '</option>';
        }else{
            $jobs .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }
 }   


} else {
    header("Location: employees.php?department=" . $department);
}


if (isset($_POST['add'])) {

    if (
        isset($_POST['name']) &&
        isset($_POST['last-name']) &&
        isset($_POST['dni']) &&
        isset($_POST['birthdate']) &&
        isset($_POST['hiredate']) &&
        isset($_POST['job']) &&
        isset($_POST['vacation'])
    ) {
        $name = $_POST['name'];
        $last_name = $_POST['last-name'];
        $dni = $_POST['dni'];
        $birthdate = $_POST['birthdate'];
        $hiredate = $_POST['hiredate'];
        $job = $_POST['job'];
        $vacation = $_POST['vacation'];


        $query = "UPDATE employees set name = '$name $last_name', dni = $dni, birthdate = '$birthdate', hiredate = '$hiredate', job_id = '$job', vacation = $vacation WHERE id = $id;";

        $result = $conn->query($query);

        if ($result) {
            $created = true;
            $query = "SELECT * FROM employees where id = $id";
            $result = $conn->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                $name = $row['name'];
                $name = explode(" ", $name);
            }
        } else {
            if (mysqli_errno($conn) == 1062) {
                $errormsg = "YA EXISTE UN EMPLEADO CON ESE NOMBRE";
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
    <title>Editar Empleado</title>
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
                        <a href="departments.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="icon_link"><i class="fas fa-sitemap"></i><span class="icon_text">Departamentos</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="jobs.php?department=<?php echo $_SESSION['department'] ?>" class="icon_link  building"><i class="fas fa-briefcase"></i><span class="icon_text">Cargos</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="employees.php?department=<?php echo $_SESSION['department'] ?>" class="icon_link active"><i class="fas fa-users active"></i><span class="icon_text active">Empleados</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="concepts.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="icon_link"><i class="fas fa-money-check"></i><span class="icon_text">Conceptos De Pago</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="payroll.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="icon_link"><i class="fas fa-money-check-alt"></i><span class="icon_text">Nómina</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="users.php" class="icon_link building"><i class="fas fa-user"></i><span class="icon_text">Usuarios</span></a>
                    </div>
                </div>

                <div class="logout_button nav_buttons">
                    <a href="logout.php" class="icon_link"><i class="fas fa-door-open"></i><span class="icon_text">Salir</span></a>
                </div>
            </div>
        </nav>
        <div class="alternative-menu" id="alternative-menu">
            <a href="admin.php" class="menu_link"><i class="fas fa-building"></i><span class="icon_text_alternative">Empresas</span></a>
            <a href="departments.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="menu_link"><i class="fas fa-sitemap"></i> <span class="icon_text_alternative">Departamentos</span></a>
            <a href="jobs.php?department=<?php echo $_SESSION['department'] ?>" class="menu_link"><i class="fas fa-briefcase"></i><span class="icon_text_alternative">Cargos</span></a>
            <a href="employees.php?department=<?php echo $_SESSION['department'] ?>" class="menu_link "><i class="fas fa-users "></i><span class="icon_text_alternative">Empleados</span></a>
            <a href="concepts.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="menu_link"><i class="fas fa-money-check"></i><span class="icon_text_alternative">Conceptos De Pago</span></a>
            <a href="payroll.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="menu_link"><i class="fas fa-money-check-alt"></i><span class="icon_text_alternative">Nómina</span></a>
            <a href="users.php" class="menu_link"><i class="fas fa-user"></i><span class="icon_text_alternative">Usuarios</span></a>
            <a href="logout.php" class="menu_link"><i class="fas fa-door-open"></i><span class="icon_text_alternative">Salir</span></a>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <h2>Editar Empleado</h2>
        </div>
    </header>

    <main class="main">
        <div class="container">

            <form class="form" method="POST" action="editEmployee.php?employee=<?php echo $id ?>">

                <div class="form_section section_form">
                    <div class="form_group">
                        <label for="name" class="form_group_label">
                            Nombre
                        </label>
                        <input id="name" type="text" name="name" value="<?php echo $name[0] ?>" />
                    </div>
                    <div class="form_group">
                        <label for="last-name" class="form_group_label">
                            Apellido
                        </label>
                        <input id="last-name" type="text" name="last-name" value="<?php echo $name[1] ?>" />
                    </div>
                    <div class="form_group section_form">
                        <label for="dni" class="form_group_label">
                            Identificación
                        </label>
                        <input id="dni" type="number" name="dni" value="<?php echo $employee['dni'] ?>" />
                    </div>
                    <div class="form_group section_form">
                        <label for="birthdate" class="form_group_label">
                            Fecha De Nacimiento
                        </label>
                        <input id="birthdate" type="date" name="birthdate" value="<?php echo $employee['birthdate'] ?>" />
                    </div>
                    <div class="form_group section_form">
                        <label for="hiredate" class="form_group_label">
                            Fecha De Ingreso
                        </label>
                        <input id="hiredate" type="date" name="hiredate" value="<?php echo $employee['hiredate'] ?>" />
                    </div>
                    <div class="form_group section_form">
                        <label for="job" class="form_group_label">
                            Cargo
                        </label>
                        <select name="job" id="job">
                            <?php echo $jobs ?>
                        </select>
                    </div>
                
                    <div class="form_group section_form">
                            <label for="vacation" class="form_group_label">
                                Vacaciones
                            </label>
                            <select name="vacation" id="vacation">
                            <?php
                                if ($employee['vacation'] == "1") {
                                    echo '<option value="1" selected="selected">Sí</option>
                                    <option value="0">No</option>';
                                } elseif ($employee['vacation'] == "0") {
                                    echo '<option value="1">Sí</option>
                                    <option value="0" selected="selected">No</option>';
                                } 
                            ?>
                            </select>
                    </div>
                </div>
                <div class="button_group button_group_update form_section">

                    <input type="submit" name="add" value="Editar" class="button button_add" />
                    <a href="employees.php?department=<?php echo $department ?>" class="button button_back">Volver</a>
                    <a href="deleteEmployee.php?employee=<?php echo $id ?>" class="button button_delete">Eliminar</a>
                </div>
            </form>
        </div>
    </main>
    <?php
    if ($created) { ?>
        <div class="portal">
            <div class="portal_box">
                <p class="portal_box_title">
                    Empleado modificado satisfactoriamente
                </p>
                <a href="employees.php?department=<?php echo $department ?>" class="portal_box_btn">Aceptar</a>
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