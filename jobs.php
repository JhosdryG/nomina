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
                        <a href="jobs.php" class="icon_link active building"><i class="fas fa-briefcase active"></i><span class="icon_text">Empresas</span></a>
                    </div>
                    <div class="nav_buttons options">
                        <a href="employees.php" class="icon_link"><i class="fas fa-sitemap"></i><span class="icon_text">Cargos</span></a>
                    </div>
                </div>

                <div class="logout_button nav_buttons">
                    <a href="/index.php" class="icon_link"><i class="fas fa-door-open"></i><span class="icon_text">Salir</span></a>
                </div>
            </div>
        </nav>
        <div class="alternative-menu" id="alternative-menu">
            <a href="departments.php" class="menu_link"><i class="fas fa-sitemap"></i> <span class="icon_text_alternative">Cargos</span> </a>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <div class="dpt-name">
                <h2 class="enterprise">Departamento de Informática</h1>
                    <h2 class="department">Cargos</h2>
            </div>
            <a id="addProduct" href="addDepartment.php"><i class="fas fa-plus"></i>  Agregar Cargo</a>
        </div>
    </header>

    <main class="main">
        <!-- <h2>
            Pulsa "Agregar Departamento"
        </h2> -->

        <div class="container">

            <ul class="products_list">
                <a href="jobs.php">
                    <li class="product" onclick="location.href='/admin/product/{{@key}}?{{{../pass}}}={{{../urlHash}}}'">
                        <div class="product_imgbox">

                            <i class="product_imgbox_img fas fa-briefcase"></i>

                        </div>
                        <div class="product_info">
                            <div class="product_info_titlebox">
                                <h3 class="product_info_titlebox_title">
                                    Informática
                                </h3>
                                <div class="product_info_titlebox_price">
                                    2 Cargos
                                </div>
                                <div class="product_info_titlebox_price">
                                    10 Empleados
                                </div>
                            </div>
                        </div>
                    </li>
                </a>
            </ul>

        </div>

    </main>

    <script src="scripts/adminMenu.js"></script>

</body>

</html>