<?php 
    include("validateRoute.php"); 
    include("db.php");

    $departmentName = "";
    $id_enterprise = "";
    $id = "";
    if(isset($_GET['department'])){

        $_SESSION['department'] = $_GET['department'];
        $id = $_GET['department'];
        $id_enterprise = $_SESSION['enterprise'];
        $query = "SELECT *, job.name as job FROM employees INNER JOIN job ON employees.job_id = job.id where employees.department_id = $id";
        $result = $conn->query($query);

    }else{
        header("Location: admin.php");
    }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
    <!-- {{!-- Google fonts Roboto --}} -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- {{!-- Font Awesome CDN --}} -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/solid.css" integrity="sha384-fZFUEa75TqnWs6kJuLABg1hDDArGv1sOKyoqc7RubztZ1lvSU7BS+rc5mwf1Is5a" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/fontawesome.css" integrity="sha384-syoT0d9IcMjfxtHzbJUlNIuL19vD9XQAdOzftC+llPALVSZdxUpVXE0niLOiw/mn" crossorigin="anonymous">
    <!-- {{!-- My Styles --}} -->
    <link rel="stylesheet" href="css/admin.min.css">
    <link rel="stylesheet" href="css/products.min.css">
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
                        <a href="jobs.php?department=<?php echo $id ?>" class="icon_link  building"><i class="fas fa-briefcase"></i><span class="icon_text">Cargos</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="employees.php?department=<?php echo $id ?>" class="icon_link active"><i class="fas fa-users active"></i><span class="icon_text active">Empleados</span></a>
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
            <a href="jobs.php?department=<?php echo $id ?>" class="menu_link"><i class="fas fa-briefcase"></i><span class="icon_text_alternative">Cargos</span></a>
            <a href="employees.php?department=<?php echo $id ?>" class="menu_link "><i class="fas fa-users "></i><span class="icon_text_alternative">Empleados</span></a>
            <a href="concepts.php" class="menu_link"><i class="fas fa-money-check"></i><span class="icon_text_alternative">Conceptos De Pago</span></a>
            <a href="payroll.php" class="menu_link"><i class="fas fa-money-check-alt"></i><span class="icon_text_alternative">Nómina</span></a>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <div class="dpt-name">
                <h2 class="enterprise">Departamento de Informática</h1>
                    <h2 class="department">Empleados</h2>
            </div>
            <a id="addProduct" href="addEmployee.php"><i class="fas fa-plus"></i> Agregar Empleado</a>
        </div>
    </header>

    <main class="main">
        <!-- <h2>
            Pulsa "Agregar Empleado"
        </h2> -->

        <div class="container">

            <ul class="products_list">

            <?php 
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) { ?>
                        <li class="product" onclick="location.href='editEmployee.php?employee=<?php echo $row['id'] ?>'">
                            <div class="product_imgbox">
                            <i class="product_imgbox_img fas fa-users"></i>
                            </div>
                            <div class="product_info">
                                <div class="product_info_titlebox">
                                    <h3 class="product_info_titlebox_title">
                                        <?php echo $row['name'] ?>
                                    </h3>
                                    <div class="product_info_titlebox_price">
                                        V-<?php echo $row['dni'] ?>
                                    </div>
                                    <div class="product_info_titlebox_price">
                                    Ingresó <?php echo $row['hiredate'] ?>
                                    </div>
                                    <div class="product_info_titlebox_price">
                                    <?php echo $row['hiredate'] ?>
                                    </div>
                                    <div class="product_info_titlebox_price">
                                    <?php echo $row['job'] ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    
                    <?php }
                    echo "</ul>";
                } else {
                    echo "</ul>";
                    echo "<h2>No se han encontrado resultados</h2>";
                } ?>
            

        </div>

    </main>

    <script src="scripts/adminMenu.js"></script>

</body>

</html>