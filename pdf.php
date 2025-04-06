<?php ob_start(); 
?>
<h2>DATOS PERSONALES</h2>
<table width="500px" cellpadding="5px" cellspacing="5px" border="1">
    <tr bgcolor="#CCCCCC">
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Salario</td>
        <td>Salario *2</td>


    </tr>
    <?php
    $nom=$_REQUEST['nomb'];
    $ape=$_REQUEST['apel'];
    $sal=$_REQUEST['sal'];
    $sal2=$_REQUEST['sal2'];
    
    $tam=count($nom);
    for($i=0;$i<$tam;$i++) {
        echo "<tr bgcolor='#FF9933'>
        <td>$nom[$i]</td>
        <td>$ape[$i]</td>
        <td>$sal[$i]</td>
        <td>$sal2[$i]</td>
        
    </tr>";
    }
?>    
    
</table>
<HR>
<h2>DEDUCCIONES</h2>
<table width="500px" cellpadding="5px" cellspacing="5px" border="1">
    <tr bgcolor="#CCCCCC">
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Salario</td>
        <td>Salario *2</td>


    </tr>
    <?php
    $nom=$_REQUEST['nomb'];
    $ape=$_REQUEST['apel'];
    $sal=$_REQUEST['sal'];
    $sal2=$_REQUEST['sal2'];
    
    $tam=count($nom);
    for($i=0;$i<$tam;$i++) {
        echo "<tr bgcolor='#FF9933'>
        <td>$nom[$i]</td>
        <td>$ape[$i]</td>
        <td>$sal[$i]</td>
        <td>$sal2[$i]</td>
        
    </tr>";
    }
?>    
    
</table>

<HR>
<h2>DEDUCCIONES</h2>
<table width="500px" cellpadding="5px" cellspacing="5px" border="1">
    <tr bgcolor="#CCCCCC">
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Salario</td>
        <td>Salario *2</td>


    </tr>
    <?php
    $nom=$_REQUEST['nomb'];
    $ape=$_REQUEST['apel'];
    $sal=$_REQUEST['sal'];
    $sal2=$_REQUEST['sal2'];
    
    $tam=count($nom);
    for($i=0;$i<$tam;$i++) {
        echo "<tr bgcolor='#FF9933'>
        <td>$nom[$i]</td>
        <td>$ape[$i]</td>
        <td>$sal[$i]</td>
        <td>$sal2[$i]</td>
        
    </tr>";
    }
?>    
    
</table>

<HR>
<h2>DEDUCCIONES</h2>
<table width="500px" cellpadding="5px" cellspacing="5px" border="1">
    <tr bgcolor="#CCCCCC">
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Salario</td>
        <td>Salario *2</td>


    </tr>
    <?php
    $nom=$_REQUEST['nomb'];
    $ape=$_REQUEST['apel'];
    $sal=$_REQUEST['sal'];
    $sal2=$_REQUEST['sal2'];
    
    $tam=count($nom);
    for($i=0;$i<$tam;$i++) {
        echo "<tr bgcolor='#FF9933'>
        <td>$nom[$i]</td>
        <td>$ape[$i]</td>
        <td>$sal[$i]</td>
        <td>$sal2[$i]</td>
        
    </tr>";
    }
?>    
    
</table>

<HR>
<h2>DEDUCCIONES</h2>
<table width="500px" cellpadding="5px" cellspacing="5px" border="1">
    <tr bgcolor="#CCCCCC">
        <td>Nombre</td>
        <td>Apellido</td>
        <td>Salario</td>
        <td>Salario *2</td>


    </tr>
    <?php
    $nom=$_REQUEST['nomb'];
    $ape=$_REQUEST['apel'];
    $sal=$_REQUEST['sal'];
    $sal2=$_REQUEST['sal2'];
    
    $tam=count($nom);
    for($i=0;$i<$tam;$i++) {
        echo "<tr bgcolor='#FF9933'>
        <td>$nom[$i]</td>
        <td>$ape[$i]</td>
        <td>$sal[$i]</td>
        <td>$sal2[$i]</td>
        
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
