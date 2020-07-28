<?php 
    include("validateRoute.php"); 
    include("db.php");

    $created = false;
    $error = false;
    $errormsg = "";
    $insert_id = "";

    $id_enterprise = $_SESSION['enterprise'];
    $department = $_SESSION['department'];

    $jobs = '';

    $query = "SELECT * FROM job WHERE department_id = $department";
    $result = $conn->query($query);



    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        $jobs .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }

      } else {
        header("Location: addJob.php");
      }

    if(isset($_POST['add'])){
        
        if(
            isset($_POST['name']) &&
            isset($_POST['last_name']) &&
            isset($_POST['id']) &&
            isset($_POST['born']) &&
            isset($_POST['start']) &&
            isset($_POST['job']) &&
            isset($_POST['vacation'])
        ){
            $name = $_POST['name']; 
            $last_name = $_POST['last_name']; 
            $id = $_POST['id']; 
            $born = $_POST['born']; 
            $start = $_POST['start']; 
            $job = $_POST['job']; 
            $vacation = $_POST['vacation'];

            $enterprise = $_SESSION['enterprise'];

            $query = "INSERT INTO employees(name, dni, birthdate, hiredate, department_id,job_id,vacation) VALUES ('$name $last_name', $id, '$born', '$start',  $department, $job, $vacation);";

            $result = $conn->query($query);

            if($result){
                $created = true;
            }else{
                if(mysqli_errno($conn) == 1062){
                    $errormsg = "YA EXISTE UN EMPLEADO CON ESA CEDULA";
                }else{
                    $errormsg = "HA OCURRIDO UN ERROR INESPERADO " . mysqli_error($conn);
                }

                $error = true;
            }
        }else{
            header("Location: admin.php");
        }
    }


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Añadir Empleado</title>
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
                        <a href="jobs.php?department=<?php echo $department ?>" class="icon_link  building"><i class="fas fa-briefcase"></i><span class="icon_text">Cargos</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="employees.php?department=<?php echo $department ?>" class="icon_link active"><i class="fas fa-users active"></i><span class="icon_text active">Empleados</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="concepts.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="icon_link"><i class="fas fa-money-check"></i><span class="icon_text">Conceptos De Pago</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="payroll.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="icon_link"><i class="fas fa-money-check-alt"></i><span class="icon_text">Nómina</span></a>
                    </div>
                </div>

                <div class="logout_button nav_buttons">
                    <a href="/index.php" class="icon_link"><i class="fas fa-door-open"></i><span class="icon_text">Salir</span></a>
                </div>
            </div>
        </nav>
        <div class="alternative-menu" id="alternative-menu">
            <a href="admin.php" class="menu_link"><i class="fas fa-building"></i><span class="icon_text_alternative">Empresas</span></a>
            <a href="departments.php" class="menu_link"><i class="fas fa-sitemap"></i> <span class="icon_text_alternative?enterprise=<?php echo $_SESSION['enterprise'] ?>">Departamentos</span></a>
            <a href="jobs.php?department=<?php echo $department ?>" class="menu_link"><i class="fas fa-briefcase"></i><span class="icon_text_alternative">Cargos</span></a>
            <a href="employees.php?department=<?php echo $department ?>" class="menu_link "><i class="fas fa-users "></i><span class="icon_text_alternative">Empleados</span></a>
            <a href="concepts.php" class="menu_link"><i class="fas fa-money-check"></i><span class="icon_text_alternative?enterprise=<?php echo $_SESSION['enterprise'] ?>">Conceptos De Pago</span></a>
            <a href="payroll.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="menu_link"><i class="fas fa-money-check-alt"></i><span class="icon_text_alternative">Nómina</span></a>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <h2>Agregar Empleado</h2>
        </div>
    </header>

    <main class="main">
        <div class="container">

            <form class="form" method="POST" action="addEmployee.php">

                <div class="form_section section_form">
                    <div class="form_group">
                        <label for="name" class="form_group_label">
                            Nombre
                        </label>
                        <input id="name" type="text" name="name" value="" required/>
                    </div>
                    <div class="form_group">
                        <label for="last-name" class="form_group_label">
                            Apellido
                        </label>
                        <input id="last_name" type="text" name="last_name" value="" required/>
                    </div>
                    <div class="form_group section_form">
                        <label for="id" class="form_group_label">
                            Identificación
                        </label>
                        <input id="id" type="number" name="id" value="" required/>
                    </div>
                    <div class="form_group section_form">
                        <label for="born" class="form_group_label">
                            Fecha De Nacimiento
                        </label>
                        <input id="born" type="date" name="born" value="" required/>
                    </div>
                    <div class="form_group section_form">
                        <label for="start" class="form_group_label">
                            Fecha De Ingreso
                        </label>
                        <input id="start" type="date" name="start" value="" required/>
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
                            <option value="1">Sí</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>

                <div class="button_group form_section">

                    <input type="submit" value="Agregar" name="add" class="button button_add" />
                    <a href="employees.php?department=<?php echo $department ?>" class="button button_back">Volver</a>
                </div>
            </form>
        </div>
    </main>
    <script src="scripts/adminMenu.js"></script>
    <?php 
        if($created){ ?>
            <div class="portal">
                <div class="portal_box">
                    <p class="portal_box_title">
                        Empleado creado satisfactoriamente
                    </p>
                    <a href="employees.php?department=<?php echo $department ?>" class="portal_box_btn">Aceptar</a>
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