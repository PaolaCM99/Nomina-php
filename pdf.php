<?php ob_start(); ?>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        font-size: 10px;
    }
    h2 {
        color: #333;
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    table, th, td {
        border: 1px solid #CCCCCC;
    }
    th, td {
        font-size: 10px;
        padding: 3px;
        text-align: center;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:nth-child(odd) {
        background-color: #ffffff;
    }
    tr:first-child {
        background-color: #CCCCCC;
        font-weight: bold;
    }
</style>

<h2>INFORMACIÓN GENERAL</h2>

<table>
    <tr>
        <th>Nombre</th>
        <th>Centro de costos</th>
        <th>Cargo</th>
        <th>Número de identificación</th>
        <th>Sueldo</th>
        <th>Días laborados</th>
    </tr>
    <?php
    $nom = $_REQUEST['nomb'];
    $centro = $_REQUEST['centro'];
    $car = $_REQUEST['car'];
    $num = $_REQUEST['num'];
    $suel = $_REQUEST['suel'];
    $diaslab = $_REQUEST['diaslab'];

    $tam = count($nom);
    for ($i = 0; $i < $tam; $i++) {
        echo "<tr>
        <td>$nom[$i]</td>
        <td>$centro[$i]</td>
        <td>$car[$i]</td>
        <td>$num[$i]</td>
        <td>$suel[$i]</td>
        <td>$diaslab[$i]</td>
    </tr>";
    }
    ?>
</table>

<h2>DEVENGADOS</h2>

<table>
    <tr>
        <th>Nombre</th>
        <th>Centro de costos</th>
        <th>Cargo</th>
        <th>Número de identificación</th>
        <th>Sueldo</th>
        <th>Días laborados</th>
    </tr>
    <?php
    for ($i = 0; $i < $tam; $i++) {
        echo "<tr>
        <td>$nom[$i]</td>
        <td>$centro[$i]</td>
        <td>$car[$i]</td>
        <td>$num[$i]</td>
        <td>$suel[$i]</td>
        <td>$diaslab[$i]</td>
    </tr>";
    }
    ?>
</table>

<h2>DEDUCCIONES</h2>

<table>
    <tr>
        <th>Salud</th>
        <th>Pensión</th>
        <th>Fondo de solidaridad</th>
        <th>Monto del Desembolso</th>
        <th>No. De Cuotas a Descontar</th>
        <th>Fecha del Desembolso</th>
        <th>No. De Cuota Pagada</th>
        <th>Cuotas por Descontar</th>
        <th>Nomina en que termina Prestamo</th>
        <th>Valor Cuota</th>
        <th>Saldo al Prestamo</th>
        <th>Total deducciones</th>
    </tr>
    <?php
    for ($i = 0; $i < $tam; $i++) {
        echo "<tr>
        <td>$nom[$i]</td>
        <td>$centro[$i]</td>
        <td>$car[$i]</td>
        <td>$num[$i]</td>
        <td>$suel[$i]</td>
        <td>$diaslab[$i]</td>
        <td>$nom[$i]</td>
        <td>$centro[$i]</td>
        <td>$car[$i]</td>
        <td>$num[$i]</td>
        <td>$suel[$i]</td>
        <td>$diaslab[$i]</td>
    </tr>";
    }
    ?>
</table>

<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new DOMPDF();
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$pdf = $dompdf->output();
$filename = "Nomina.pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>