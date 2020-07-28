<?php 
  include("validateRoute.php"); 
  include("db.php");

  $enterprise = $_SESSION['enterprise'];
  $tbody = "";

  if(isset($_POST['add'])){
    if(isset($_POST['initial']) && isset($_POST['final'])){
      $initial = $_POST['initial'];
      $final = $_POST['final'];
      $days = (new DateTime($initial))->diff(new DateTime($final))->days + 1;

      $query = "SELECT * FROM concepts WHERE enterprise_id = $enterprise";
      $result = $conn->query($query);
    
      $conceptsNames = array();
      $conceptspercent = array();
      $conceptsTotals = array();
      $count = 0;

      // Getting concepts and their percents
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          $conceptsNames[] = $row['name'];
          $conceptspercent[] = $row['percent'];
          $conceptsTotals[] = 0;
          $count++;
        }
      }

  
      // Getting employees data and salaries
      $query = "SELECT 
      employees.id as id,
      employees.name as name,
      hiredate,
      dni,
      department.name as department,
      TRUNCATE((weekhours / 7),1) as dayhours, 
      price_hour,
      TRUNCATE(((weekhours / 7) * price_hour),1) as base
      FROM employees 
      INNER JOIN department ON employees.department_id = department.id
      INNER JOIN enterprise ON department.enterprise_id = enterprise.id
      INNER JOIN job ON employees.job_id = job.id WHERE enterprise.id = $enterprise";
    
      $result = $conn->query($query);

      $thead = "<tr><th>N°</th>
      <th>NOMBRE</th>
      <th>IDENTIFICACIÓN</th>
      <th>DEPARTAMENTO</th>
      <th>FECHA DE INGRESO</th>
      <th>COSTO HORA</th>
      <th>HORAS DIARIAS</th>
      <th>SUELDO BASE</th>";

      for ($i=0; $i < $count ; $i++) { 
            $thead .= "<th>".$conceptsNames[$i]."</th>";
      }

      $thead .= "<th>TOTAL CONCEPTOS</th><th>TOTAL</th></tr>";
      
    
      if ($result->num_rows > 0) {
        // output data of each row

        // Totales de los totales
        $baset = 0;
        $percentt = 0;
        $totalt = 0;
        
        while($row = $result->fetch_assoc()) {
          $tr = "<tr><td>".$row['id']."</td>";
          $tr .= "<td>".$row['name']."</td>";
          $tr .= "<td>".$row['dni']."</td>";
          $tr .= "<td>".$row['department']."</td>";
          $tr .= "<td>".$row['hiredate']."</td>";
          $tr .= "<td>".$row['price_hour']."</td>";
          $tr .= "<td>".$row['dayhours']."</td>";
          $base = $row['base'] * $days;
          $tr .= "<td>$base</td>";
          $baset += $base;
          $percent = 0;
          $total = $base;
          for ($i=0; $i < $count ; $i++) {
            $tr .= "<td>". $base * $conceptspercent[$i] ."</td>";
            $percent += $base * $conceptspercent[$i];
            $conceptsTotals[$i] += $base * $conceptspercent[$i];
          }

          $tr .= "<td>$percent</td>";
          $percentt += $percent;
          $total += $percent;
          $totalt += $total;
          $tr .= "<td>$total</td></tr>";

          $tbody .= $tr;
        
        }
        $tbody .= "<td></td>";
        $tbody .= "<td>TOTAL</td>";
        $tbody .= "<td></td>";
        $tbody .= "<td></td>";
        $tbody .= "<td></td>";
        $tbody .= "<td></td>";
        $tbody .= "<td></td>";
        $tbody .= "<td>$baset</td>";
        for ($i=0; $i < $count ; $i++) {
          $tbody .= "<td>". $conceptsTotals[$i] ."</td>";
        }
        $tbody .= "<td>$percentt</td>";
        $tbody .= "<td>$totalt</td>";

        $query = "INSERT INTO regnomina (initial, final, base, concepts, total, id_enterprise)
        VALUES ('$initial', '$final', $baset, $percentt, $totalt, $enterprise)";
        
        if ($conn->query($query)) {
          
        } else {
          echo "Error: " . $query . "<br>" . $conn->error;
        }

      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nómina</title>
    <link rel="icon" type="image/png" href="img/icon.png">
    <link rel="stylesheet" href="css/nomina.css">
</head>
<body>
    <table> 
      <?php 
        echo $thead;
        echo $tbody;
      ?>
    </table>
</body>
</html>