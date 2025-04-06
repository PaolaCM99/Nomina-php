<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomina 2</title>
    <link rel="shortcut icon" href="https://www.jose-aguilar.com/blog/wp-content/themes/jaconsulting/favicon.ico" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <h3 class="text-light">Nomina</h3>
    </nav>
    <div class="container">

    <h1>Nomina</h1>
    <h2 class="lead">Genera un archivo PDF con los datos de nomina de los empleados</h2>

       
        <div class="row">
            <div id="content" class="col-lg-12">
                <?php
                $nom = $_REQUEST['nomb'];
                $centro = $_REQUEST['centro'];
                $car = $_REQUEST['car'];
                $num = $_REQUEST['num'];
                $suel = $_REQUEST['suel'];
                $diaslab = $_REQUEST['diaslab'];

                $tam = count($nom);
                ?>
                <form action="./pdf.php" method='post'>
                    <table class="table table-success table-striped">
                        <thead>
                            <tr bgcolor="#CCCCCC">
                                <td>Nombre</td>
                                <td>Centro de costos</td>
                                <td>Cargo </td>
                                <td>Número de identificación </td>
                                <td>Sueldo</td>
                                <td>Dias laborados </td>
                                <td>Salario según dias laborados </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < 3; $i++) {
                                $spdl = ((int)$suel[$i] / 30) * (int)$num[$i];
                                echo "<tr bgcolor='#FF9933'>
                                <td><input class='form-control' type='text' name='nomb[]' value=' $nom[$i]' readonly></td>
                                <td>
                                <select class='form-control'name='centro[]'>
                                    <option>Administración</option>
                                    <option>Las Delicias - Villavicencio</option>
                                    <option>Mangos y Naranjos - Tausa</option>
                                </select></td>
                                <td>
                                <select class='form-control'name='car[]'>
                                    <option>Gerente</option>
                                    <option>Subgerente</option>
                                    <option>Coordinador Agro </option>
                                    <option>Asistente varios </option>
                                    <option>Contador</option>
                                    <option>Mayordomo</option>
                                    <option>Auxiliar del mayordomo </option>
                                    <option>Servivios generales </option>
                                    <option>Coordinador administrativa</option>
                                </select></td>
                                <td><input class='form-control' type='number' name='num[]' value='$num[$i]'></td>
                                <td><input class='form-control' type='number' name='suel[]' value='$suel[$i]'></td>
                                <td><input class='form-control' type='number' name='diaslab[]' value='$diaslab[$i]'></td>
                                <td><input class='form-control' type='number' name='spdl[]' value='$spdl' readonly></td>
                                </tr>";
                            }
                            ?>
                            <tr bgcolor="#FF9933" align="center">
                                <td colspan="3"><input class="btn btn-primary" type='submit' value='Generar PDF'>
                                    <input class="btn btn-info" type='reset' value='Reset'>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </form>

                <br />
                <!--<a class="btn btn-primary" href="pdf.php"><i class="fa fa-download"></i> Descargar archivo PDF</a>
-->
            </div>
        </div>      
    </div>
    <footer class="footer bg-dark">
    <div class="container"> 
            <p>Programación web - 2025</p>
            <span>Realizado por:</span>
            <br>
            <ul>
                <li>Juliana</li>
                <li>Paola Castro</li>
            </ul>
        </div> 
    </footer>
</body>

</html>