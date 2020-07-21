<?php 
    include("validateRoute.php"); 
    include("db.php");

    $created = false;
    $error = false;
    $errormsg = "";
    $insert_id = "";

    if(isset($_POST['add'])){
        
        if(
            isset($_POST['name']) && 
            isset($_POST['rif_l']) && 
            isset($_POST['rif_n']) && 
            isset($_POST['dir']) && 
            isset($_POST['phone']) && 
            isset($_POST['risk'])
        ){
            $name = $_POST['name']; 
            $rif_l = $_POST['rif_l']; 
            $rif_n = $_POST['rif_n']; 
            $rif = $rif_l . "-" . $rif_n;
            $dir = $_POST['dir']; 
            $phone = $_POST['phone']; 
            $risk = $_POST['risk'];

            $query = "INSERT INTO enterprise(name, rif, dir, phone, risk ) VALUES ('$name','$rif','$dir','$phone',$risk)";

            $result = $conn->query($query);

            if($result){
                $created = true;
                $insert_id = $conn->insert_id;
            }else{
                if(mysqli_errno($conn) == 1062){
                    $errormsg = "YA EXISTE UNA EMPRESA CON ESE NOMBRE O RIF";
                }else{
                    $errormsg = "HA OCURRIDO UN ERROR INESPERADO";
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
                        <i class="fas fa-bars" ></i>
                        <span class="icon_text">Menu</span>
                    </div>
                    
                </div>
                <div class="nav_buttons options">
                    <a href="admin.php" class="icon_link active building"><i class="fas fa-building active"></i><span class="icon_text active">Empresas</span></a>
                </div>
                <div class="logout_button nav_buttons">
                    <a href="/admin/logout" class="icon_link"><i class="fas fa-door-open"></i><span class="icon_text">Salir</span></a>
                </div>
            </div>
        </nav>
        <div class="alternative-menu" id="alternative-menu">
            <a href="admin.php" class="menu_link"><i class="fas fa-building"></i><span class="icon_text_alternative">Empresas</span></a>
        </div>
    </div>

    <header class="header">
        <div class="container">
            <h2>Editar Empresa</h2>
        </div>
    </header>

    <main class="main">
        <div class="container">

            <form class="form" method="POST" action="addEnterprise.php">
               
                <div class="form_section section_form">
                    <div class="form_group">
                        <label for="" class="form_group_label">
                            Nombre
                        </label>
                        <input id="title" type="text" name="name" value=""/>
                    </div>
                    <div class="form_group">
                        <label for="" class="form_group_label">
                            Dirección
                        </label>
                        <input id="title" type="text" name="dir" value=""/>
                    </div>

                    <div class="form_group section_form">
                        <label for="" class="form_group_label">
                            Rif
                        </label>
                        <div class="rif">
                            <select name="rif_l" id="riesgo">
                                <option value="V">V</option>
                                <option value="E">E</option>
                                <option value="P">P</option>
                                <option value="J">J</option>
                                <option value="G">G</option>
                            </select>
                            <input id="detailPrice" type="number" name="rif_n" value=""/>
                        </div>
                    </div>
                    <div class="form_group">
                        <label for="" class="form_group_label">
                            Teléfono
                        </label>
                        <input id="bigPrice" type="number" name="phone" value=""/>
                    </div>
                    <div class="form_group">
                        <label for="riesgo" class="form_group_label">
                            Porcentaje de riesgo
                        </label>
                        <select name="risk" id="riesgo">
                            <option value="0.09">9%</option>
                            <option value="0.10">10%</option>
                            <option value="0.11">11%</option>
                        </select>
                    </div>
                </div>
                
                <div class="button_group button_group_update form_section">
                    <input type="submit" value="Agregar" class="button button_add" name="add" />
                    <a href="admin.php" class="button button_back">Volver</a>
                    <a href="admin.php" class="button button_delete">Eliminar</a>
                </div>
            </form>
        </div>
    </main>

    <?php 
        if($created){ ?>
            <div class="portal">
                <div class="portal_box">
                    <p class="portal_box_title">
                        Producto creado satisfactoriamente
                    </p>
                    <a href="departments.php?enterprise=<?php echo $insert_id ?>" class="portal_box_btn">Aceptar</a>
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