<?php 
    include("validateRoute.php"); 
    include("db.php");

    $enterpriseName = "";

    if(isset($_GET['enterprise'])){
        $_SESSION['enterprise'] = $_GET['enterprise'];
        $id = $_GET['enterprise'];
        $query = "SELECT * FROM department where enterprise_id = $id";
        $result = $conn->query($query);

        $query2 = "SELECT name FROM enterprise where id = $id";
        $result2 = $conn->query($query2);

        if ($result2->num_rows > 0) {
            // output data of each row
            $row = $result2->fetch_assoc();
            $enterpriseName = $row['name'];

        }
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
    <title>Departamentos</title>
    <link rel="icon" type="image/png" href="img/icon.png">
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
                        <a href="departments.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="icon_link active"><i class="fas fa-sitemap active"></i><span class="icon_text active">Departamentos</span></a>
                    </div>
                    <?php 
                if($_SESSION['admin']){?>

                    <div class="nav_buttons options">
                        <a href="concepts.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="icon_link"><i class="fas fa-money-check"></i><span class="icon_text">Conceptos De Pago</span></a>
                    </div>
            <?php } ?>

                    
                    <div class="nav_buttons options">
                        <a href="payroll.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="icon_link"><i class="fas fa-money-check-alt"></i><span class="icon_text">Nómina</span></a>
                    </div>


                    <?php 
                if($_SESSION['admin']){?>

                    <div class="nav_buttons options">
                        <a href="users.php" class="icon_link building"><i class="fas fa-user"></i><span class="icon_text">Usuarios</span></a>
                    </div>
            <?php } ?>


                </div>

                <div class="logout_button nav_buttons">
                    <a href="logout.php" class="icon_link"><i class="fas fa-door-open"></i><span class="icon_text">Salir</span></a>
                </div>
            </div>
        </nav>
        <div class="alternative-menu" id="alternative-menu">
            <a href="admin.php" class="menu_link"><i class="fas fa-building"></i><span class="icon_text_alternative">Empresas</span></a>
            <a href="departments.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="menu_link"><i class="fas fa-sitemap"></i> <span class="icon_text_alternative">Departamentos</span></a>

            <?php 
                if($_SESSION['admin']){?>

                    <a href="concepts.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="menu_link"><i class="fas fa-money-check"></i><span class="icon_text_alternative">Conceptos De Pago</span></a>
            <?php } ?>

            

            <a href="payroll.php?enterprise=<?php echo $_SESSION['enterprise'] ?>" class="menu_link"><i class="fas fa-money-check-alt"></i><span class="icon_text_alternative">Nómina</span></a>

            <?php 
                if($_SESSION['admin']){?>

                <a href="users.php" class="menu_link"><i class="fas fa-user"></i><span class="icon_text_alternative">Usuarios</span></a>
            <?php } ?>
            
            <a href="logout.php" class="menu_link"><i class="fas fa-door-open"></i><span class="icon_text_alternative">Salir</span></a>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <div class="dpt-name">
                <h2 class="enterprise"><?php echo $enterpriseName ?></h1>
                    <h2 class="department">Departamentos</h2>
            </div>
            <?php 
                if($_SESSION['admin']){?>

                    <a id="addProduct" href="addDepartment.php"><i class="fas fa-plus"></i> Agregar Departamento</a>
            <?php } ?>
        </div>
    </header>

    <main class="main">
        <!-- <h2>
            Pulsa "Agregar Departamento"
        </h2> -->

        <div class="container">

            <ul class="products_list">


            <?php 
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) { ?>
                        <li class="product" onclick="location.href='jobs.php?department=<?php echo $row['id'] ?>'">

                        <?php 
                            if($_SESSION['admin']){?>

                            <div class="product_edit_iconbox">
                                <a href="editDepartment.php?department=<?php echo $row['id'] ?>"><i class="product_edit_iconbox_icon fas fa-pen"></i></a>
                            </div>
                        <?php } ?>


                            <div class="product_imgbox">
                            <i class="product_imgbox_img fas fa-sitemap"></i>
                            </div>
                            <div class="product_info">
                                <div class="product_info_titlebox">
                                    <h3 class="product_info_titlebox_title">
                                        <?php echo $row['name'] ?>
                                    </h3>
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