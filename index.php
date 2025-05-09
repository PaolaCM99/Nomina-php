<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nomina</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        function toggleVacaciones(index) {
            const radios = document.getElementsByName(`vacaciones[${index}]`);
            const diasInput = document.getElementById(`diasVacaciones${index}`);
            radios.forEach(radio => {
                radio.addEventListener('change', () => {
                    if (radio.value === 'si' && radio.checked) {
                        diasInput.style.display = 'block';
                    } else if (radio.value === 'no' && radio.checked) {
                        diasInput.style.display = 'none';
                    }
                });
            });
        }

    function toggleRecargo(index) {
        const radios = document.getElementsByName(`recnoct[${index}]`);
        const horasInput = document.getElementById(`horasRecargo${index}`);
        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                horasInput.style.display = (radio.value === 'si' && radio.checked) ? 'block' : 'none';
            });
        });
    }
    
    function toggleDominical(index) {
        const radios = document.getElementsByName(`dominical[${index}]`);
        const cantidadInput = document.getElementById(`cantDominical${index}`);
        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                cantidadInput.style.display = (radio.value === 'si' && radio.checked) ? 'block' : 'none';
            });
        });
    }
   

    window.onload = () => {
        for (let i = 0; i < 3; i++) {
            toggleVacaciones(i);
            toggleRecargo(i);
            toggleDominical(i);
          
        }
    }
</script>

</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <h3 class="text-light">Nomina</h3>
    </nav>
    <div class="container">
        <h1>Nomina</h1>
        <h2 class="lead">Ingresa los datos de nomina de los empleados</h2>

        <div class="row">
            <div id="content" class="col-lg-12">
                <form action='./index.php' method='post'>
                    <table class="table">
                         <tr>
                            <td style="text-align: left; font-size: 1.25rem;"> ¿Cuantos empleados desea capturar?</td>   
                            <td><input type='number' name='n1' class='form-control' max="30" min="1" style="width: 100%;"></td> 
                            <td><input type='submit' value='Crear' name='env' class="btn btn-info" style="width: 100%;"></td>
                            <td><input type='reset' value='Borrar' class="btn btn-danger" style="width: 100%;"></td> 
                        </tr> 
                    </table>
                </form>
                <hr />
                
                <form action="./rep.php" method='get'>
                    <table class="table table-success table-striped table-responsive">
                        <thead>
                            <tr bgcolor="#CCCCCC">
                                <td>Nombre</td>
                                <td>Centro de costos</td>
                                <td>Cargo </td>
                                <td>N° identificación </td>
                                <td>Sueldo</td>
                                <td>Dias laborados </td>
                                <td>¿Vacaciones?</td>
                                <td>Días de vacaciones</td>
                                <td>N° incapacidades ARL</td>
                                <td>N° incapacidades EPS</td>
                                <td>¿Recargo nocturno?</td>
                                <td>Horas </td>
                                <th>Dominical</td>
                               <td>Cantidad dominicales</td>
                             
                               
                              
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($_POST['env'])){
                            $t = $_REQUEST['n1'];
                            for ($i = 0; $i < $t; $i++) {
                                echo "<tr bgcolor='#FF9933'>
                            <td><input class='form-control' type='text' name='nomb[]'></td>
                            <td>
                            <select class='form-control' name='centro[]'>
                                <option>Administración</option>
                                <option>Las Delicias - Villavicencio</option>
                                <option>Mangos y Naranjos - Tausa</option>
                            </select></td>
                            <td>
                            <select class='form-control' name='car[]'>
                                <option>Gerente</option>
                                <option>Subgerente</option>
                                <option>Coordinador Agro </option>
                                <option>Asistente varios </option>
                                <option>Contador</option>
                                <option>Mayordomo</option>
                                <option>Auxiliar del mayordomo </option>
                                <option>Servivios generales </option>
                                <option>Coordinador administrativa</option>
                            </select>
                            </td>
                            <td><input class='form-control' type='number' name='num[]'></td>
                            <td><input class='form-control' type='number' name='suel[]'></td>
                            <td><input class='form-control' type='number' name='diaslab[]'></td>
                             <td>
                                    <input type='radio' name='vacaciones[$i]' value='si'> Sí<br>
                                    <input type='radio' name='vacaciones[$i]' value='no'> No
                                </td>
                                <td>
                                    <input class='form-control' type='number' name='diasvac[]' id='diasVacaciones$i' style='display:none;' min='0'>  
                             </td>
                             <td><input class='form-control' type='number' name='incap[]'></td> 
                              <td><input class='form-control' type='number' name='inceps[]'></td>
                             <td>
                             
                             <input type='radio' name='recnoct[$i]' value='si' id='recSi$i'> Sí<br>
                              <input type='radio' name='recnoct[$i]' value='no' id='recNo$i'> No
                              </td>
                            <td>
                             <input class='form-control' type='number' name='horasrec[]' id='horasRecargo$i' style='display:none;' min='0'>
                             </td>
                             <td>
                                <input type='radio' name='dominical[$i]' value='si' id='domSi$i'> Sí<br>
                              <input type='radio' name='dominical[$i]' value='no' id='domNo$i'> No
                               </td>
                                 <td>
                                 <input class='form-control' type='number' name='cantdom[]' id='cantDominical$i' style='display:none;' min='0'>
                                    </td>
                        <td>
</td>


                                   


                        </tr>";
                            }
                        }
                            ?>
                            
                        </tbody>
                    </table>
                    <tr bgcolor="#FF9933" align="center">
                                <td colspan="14"><input class="btn btn-primary" type='submit' value='Enviar'>
                                    <input class="btn btn-info" type='reset' value='Reset'>
                                </td>
                            </tr>
                </form>

                <br />

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