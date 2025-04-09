<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomina 2</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
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
                $vacaciones = isset($_GET['vacaciones']) ? $_GET['vacaciones'] : [];
                $diasvac = isset($_GET['diasvac']) ? $_GET['diasvac'] : [];
                $incap = isset($_GET['incap']) ? $_GET['incap'] : [];
                $recnoct = isset($_REQUEST['recnoct']) ? $_REQUEST['recnoct'] : []; 
                $horasRec = isset($_REQUEST['horasrec']) ? $_REQUEST['horasrec'] : [];
                $dominicales = isset($_REQUEST['cantdom']) ? $_REQUEST['cantdom'] : [];
                $incap_eps = isset($_REQUEST['inceps']) ? $_REQUEST['inceps'] : [];
                $tam = count($nom);
                ?>

                <form action="./pdf.php" method='post'>
                    <div class="text-right py-3" >
                        <input class="btn btn-primary" type='submit' value='Generar PDF' style='width: 200px;'>
                    </div>
                    <table class="table table-success table-striped table-responsive">
                        <thead>
                            <tr bgcolor="#CCCCCC">
                                <th>N.</th>
                                <th>Nombre</th>
                                <th>Centro de costos</th>
                                <th>Cargo</th>
                                <th>Número de identificación</th>
                                <th>Sueldo</th>
                                <th>Días laborados</th>
                                <th>Salario según días laborados</th>
                                <th>¿Vacaciones?</th>
                                <th>Días de vacaciones</th>
                                <th>Salario Proporcional</th>
                                <th>Subsidio de transporte</th>
                                <th>incapacidades arl</th>
                                <th>Días Incapacidad EPS</th>
                                <th>Pago Incapacidad EPS</th>
                                <th>Recargo Nocturno</th>
                                <th>Dominicales </th>
                                <th>Aux. Alimentación No Prestacional </th>
                                <th>Devengado Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $subsidio_transporte_mensual = 200000;

                            for ($i = 0; $i < $tam; $i++) {
                                $diasIncapacidadEPS = isset($incap_eps[$i]) ? (float)$incap_eps[$i] : 0;
                                $spdl = ((float)$suel[$i] / 30) * (float)$diaslab[$i];
                                
                                $esta_de_vacaciones = (!empty($vacaciones) && isset($vacaciones[$i]) && $vacaciones[$i] === 'si');
                                $dias_vacaciones = (isset($diasvac[$i]) && is_numeric($diasvac[$i])) ? (float)$diasvac[$i] : 0;

                                $vacdis = $esta_de_vacaciones
                                    ? number_format(((float)$suel[$i] / 30) * $dias_vacaciones, 0, '', '')
                                    : number_format(0, 3, '', '');

                                $subsidio = 0;
                                if ((float)$suel[$i] <= 2600000) {
                                    $subsidio = number_format(($subsidio_transporte_mensual / 30) * (int)$diaslab[$i], 0, '', '');
                                }

                                $arl_incapacidades = 0;
                                if (isset($_REQUEST['incap']) && is_array($_REQUEST['incap'])) {
                              $incap_valor = isset($_REQUEST['incap'][$i]) ? (float)$_REQUEST['incap'][$i] : 0;
                              $arl_incapacidades = ((float)$suel[$i] / 30) * $incap_valor;
                               }
                               $valorIncapacidadEPS = 0;
                               if ($diasIncapacidadEPS > 0) {
                             $sueldoDiario = $suel[$i] / 30;
                              $valorIncapacidadEPS = round($sueldoDiario * 0.6667 * $diasIncapacidadEPS);
}
                        
                               $valor_hora = ((float)$suel[$i] / 30) / 8;
                              $horas_recargo = isset($horasRec[$i]) ? (float)$horasRec[$i] : 0;
                             $valor_recargo_nocturno = $valor_hora * $horas_recargo * 1.35;
                           
                             $valor_dia = (float)$suel[$i] / 30;
                                $domingos_trabajados = isset($dominicales[$i]) ? (float)$dominicales[$i] : 0;
                                $valor_dominical = $valor_dia * $domingos_trabajados * 1.75;

                             $aux_alimentacion_no_prestacional = 0;
                            if ((float)$suel[$i] > 0 && (float)$suel[$i] >= 2600000) {
                         $aux_propuesto = 7000 * (int)$diaslab[$i];
                         $limite_aux = 0.3 * (float)$suel[$i]; 

                        if ($aux_propuesto <= $limite_aux) {
                     $aux_alimentacion_no_prestacional = $aux_propuesto;
                    } else {
                      $aux_alimentacion_no_prestacional = $limite_aux;
    }
    $devengado_total = $spdl + $vacdis + $subsidio + $arl_incapacidades + $valorIncapacidadEPS + $valor_recargo_nocturno + $valor_dominical + $aux_alimentacion_no_prestacional;

}

                                echo "<tr bgcolor='#FF9933'>
                                <td>$i</td>
                                    <td><input class='form-control' type='text' name='nomb[]' value='{$nom[$i]}' readonly></td>
                                    <td>
                                        <select class='form-control' name='centro[]'>
                                            <option" . ($centro[$i] == 'Administración' ? " selected" : "") . ">Administración</option>
                                            <option" . ($centro[$i] == 'Las Delicias - Villavicencio' ? " selected" : "") . ">Las Delicias - Villavicencio</option>
                                            <option" . ($centro[$i] == 'Mangos y Naranjos - Tausa' ? " selected" : "") . ">Mangos y Naranjos - Tausa</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class='form-control' name='car[]'>
                                            <option" . ($car[$i] == 'Gerente' ? " selected" : "") . ">Gerente</option>
                                            <option" . ($car[$i] == 'Subgerente' ? " selected" : "") . ">Subgerente</option>
                                            <option" . ($car[$i] == 'Coordinador Agro' ? " selected" : "") . ">Coordinador Agro</option>
                                            <option" . ($car[$i] == 'Asistente varios' ? " selected" : "") . ">Asistente varios</option>
                                            <option" . ($car[$i] == 'Contador' ? " selected" : "") . ">Contador</option>
                                            <option" . ($car[$i] == 'Mayordomo' ? " selected" : "") . ">Mayordomo</option>
                                            <option" . ($car[$i] == 'Auxiliar del mayordomo' ? " selected" : "") . ">Auxiliar del mayordomo</option>
                                            <option" . ($car[$i] == 'Servivios generales' ? " selected" : "") . ">Servivios generales</option>
                                            <option" . ($car[$i] == 'Coordinador administrativa' ? " selected" : "") . ">Coordinador administrativa</option>
                                        </select>
                                    </td>
                                    <td><input class='form-control' type='number' name='num[]' value='{$num[$i]}' readonly></td>
                                    <td><input class='form-control' type='number' name='suel[]' value='{$suel[$i]}' readonly></td>
                                    <td><input class='form-control' type='number' name='diaslab[]' value='{$diaslab[$i]}' readonly></td>
                                    <td><input class='form-control' type='number' name='spdl[]' value='" . number_format($spdl, 0, '', '') . "' readonly></td>
                                    <td><input class='form-control' name='vacaciones[]' value='" . ($esta_de_vacaciones ? 'si' : 'no') . "' readonly></td>
                                    <td><input class='form-control' name='diasvac[]' value='{$dias_vacaciones}' readonly></td>
                                    <td><input class='form-control' name='salvac[]' value='{$vacdis}' readonly></td>
                                    <td><input class='form-control' name='subsidio[]' value='" . $subsidio . "' readonly></td>
                                    <td><input class='form-control' name='incaparl[]' value='" . number_format($arl_incapacidades, 0, '', '') . "' readonly></td>
                                    <td><input class='form-control' type='number' step='0.1' name='inceps[]' value='{$diasIncapacidadEPS}' readonly></td>
                                    <td><input class='form-control' name='valinceps[]' value='" . number_format($valorIncapacidadEPS, 0, '', '') . "' readonly></td>
                                    <td> <input class='form-control' name='recnoct[]' value='" . number_format($valor_recargo_nocturno, 0, '', '') . "' readonly></td>
                                    <td><input class='form-control' type='number' name='valor_dominical[]' value='" . number_format($valor_dominical, 0, '', '') . "' readonly></td>
                                    <td><input class='form-control' type='text' name='auxalimentacion[]' value='" . number_format($aux_alimentacion_no_prestacional, 0, '', '') . "' readonly></td>
                                    <td><input class='form-control' type='text' name='devengado[]' value='" . number_format($devengado_total, 0, '', '') . "' readonly>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                    <h3>Deducciones</h3>
                    <table class="table table-striped table-sm table-info table-responsive">
                        <thead bgcolor="#CCCCCC">
                            <tr>  
                                <tr class="table-bordered">
                                    <th colspan="3" style="text-align: center;">Deducciones nominales</th>
                                    <th colspan="9" style="text-align: center;">Deducciones por prestamos</th>
                                </tr>
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
                                <th bgcolor='#FF99'>Total a pagar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            function calcularAportes($salario) {
                                $salud = (float)$salario * 0.04;    // 4% Salud
                                $pension = $salario * 0.04;  // 4% Pensión
                                $fsp = 0;                    // Fondo de Solidaridad Pensional
                            
                                // SMLMV para 2025
                                $smlmv = 1430000;
                                $limiteFSP = 4 * $smlmv;
                            
                                if ($salario >= $limiteFSP) {
                                    if ($salario >= 4 * $smlmv && $salario < 16 * $smlmv) {
                                        $fsp = $salario * 0.01; // 1%
                                    } elseif ($salario >= 16 * $smlmv && $salario < 17 * $smlmv) {
                                        $fsp = $salario * 0.012;
                                    } elseif ($salario >= 17 * $smlmv && $salario < 18 * $smlmv) {
                                        $fsp = $salario * 0.014;
                                    } elseif ($salario >= 18 * $smlmv && $salario < 19 * $smlmv) {
                                        $fsp = $salario * 0.016;
                                    } elseif ($salario >= 19 * $smlmv && $salario < 20 * $smlmv) {
                                        $fsp = $salario * 0.018;
                                    } elseif ($salario >= 20 * $smlmv) {
                                        $fsp = $salario * 0.02;
                                    }
                                }
                            
                                return [
                                    'salario' => $salario,
                                    'salud' => $salud,
                                    'pension' => $pension,
                                    'fsp' => $fsp,
                                    'total_descuentos' => $salud + $pension + $fsp,
                                    'salario_neto' => $salario - ($salud + $pension + $fsp),
                                ];
                            }

                            for ($i = 0; $i < $tam; $i++) {
                                $resultado = calcularAportes((float)$suel[$i]);
                                if (!function_exists('valorConFormato')) {
                                    function valorConFormato($resultado) {
                                        return number_format($resultado, 0, ',', '.');
                                    }
                                }
                            
                            echo "<tr>
                             <td style='width: auto;'>$ " . valorConFormato($resultado['salud']) . "</td>
                             <td style='width: auto;'>$ " . valorConFormato($resultado['pension']) . "</td>
                             <td style='width: auto;'>$ " . valorConFormato($resultado['fsp']) . "</td>
                             <td style='width: auto;'>$ " . valorConFormato($resultado['salud']) . "</td>
                             <td style='width: auto;'> - </td>
                             <td style='width: auto;'> - </td>
                             <td style='width: auto;'> - </td>
                             <td style='width: auto;'> - </td>
                             <td style='width: auto;'> - </td>
                             <td style='width: auto;'>$ " . valorConFormato($resultado['salud']) . "</td>
                             <td style='width: auto;'>$ " . valorConFormato($resultado['salud']) . "</td>
                             <td style='width: auto;'>$ " . valorConFormato($resultado['total_descuentos']) . "</td>
                            <td style='width: auto;' bgcolor='#FF99'>$ " . valorConFormato($resultado['salario_neto']) . "</td>
                            </tr>
                             ";}
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <footer class="text-light bg-dark py-4 mt-5 footer">
        <div class="container text-center">
            <p class="mb-2">Programación Web - 2025</p>
            <span class="d-block mb-3">Realizado por:</span>
            <ul class="list-unstyled">
                <li>Juliana Martinez</li>
                <li>Paola Castro</li>
            </ul>
            <small>&copy; 2025 Todos los derechos reservados</small>
        </div>
    </footer>
</body>

</html>