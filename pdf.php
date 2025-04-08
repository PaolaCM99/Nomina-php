<?php ob_start();
?>
<h2>DATOS PERSONALES</h2>

<table width="80vw" border="1">
    <tr bgcolor="#CCCCCC">
        <td>Nombre</td>
        <td>Centro de costos</td>
        <td>Cargo </td>
        <td>Número de identificación </td>
        <td>Sueldo</td>
        <td>Dias laborados </td>
        <td>Salario según dias laborados </td>
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
        echo "<tr bgcolor='#CCCCCC'>
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
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf = $dompdf->output();
$filename = "nomina.pdf";
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>