 <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">
 <link rel="stylesheet" href="style.css">
 <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> -->
 <!-- <script type="text/javascript" src="vanilla-tilt.min.js"></script> -->




 <?php
    session_start();

    $coeficiente_reductor = null;

    //OCULTAR ERRORES 
    error_reporting(0);

    //MOSTRAR ERRORES
    // error_reporting(E_ALL);
    // ini_set('display_errors', '1');



    require_once "database.php";

    //Presupuesto
    $coeficiente_presupuesto =  0.0035;


    //Direcciones tecnicas
    $direc_tec_050 = false;
    $direc_tec_070 = false;
    $direc_tec_100 = false;

    $mostrarResultado = true;

    $tipo4 = 0;
    $stmt = $conexion->prepare('SELECT * FROM `Tabla1_Cuotas_tipo` WHERE `Tipo_visado` = 4;');
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $tipo4 = $data[0]["Importe"];


    // --------------- Importe del tipo 9: ---------------
    $valor_tipo_9 = 0;
    $stmt = $conexion->prepare('SELECT * FROM `Tabla1_Cuotas_tipo` WHERE `Tipo_visado` = 9;');
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $valor_tipo_9 = $data[0]["Importe"];
    // --------------- Importe del tipo 9 --------------



    /*
 
        ------------------------Pruebas base de datos-------------------
    $accion_nm = "SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = 'Memorias';";
    $consulta_nm = mysqli_query($conexion, $accion_nm);
    $result = mysqli_fetch_assoc($consulta_nm);

    var_dump($result);
    $stmt = $conexion->prepare('SELECT "Importe" FROM Tabla1_Cuotas_tipo WHERE Tipo_visado = ?');
    $stmt->bind_param('s', $e);
    $stmt->execute();

    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        echo ($row);
    }

    */

    //------------------------ fin pruebas ------------------------
    // $accion_nm = "SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = 'Proyectos_grua(por_grua)';";

    $errores = array();

    global $preciofinal;   //Esta variable será el resultado del calculo    
    global $tipo;           //Esta variable guardara el tipo
    global $coeficiente_reductor;   //Esta variable guardará el coeficiente reductor si este existe

    if (!empty($_GET)) {

        unset($_SESSION['preciofinal']); //Se eliminan los datos del calculo anterior
        unset($_SESSION['tipo']);
        unset($_SESSION['coeficiente_reductor']);

        $tipoDocumentoProfesional = $_GET["tipoDocumentoProfesional"];  //Se obtiene el tipo de documento del formulario (Por ejemplo anexo_1)

        //echo("<br> Tipo Documento profesional = ". $tipoDocumentoProfesional. "<br>");

        //Guardar las variables de los segundos desplegables
        if (isset($_GET["tipoProyecto"])) {
            $tipoProyecto = $_GET["tipoProyecto"];
        }
        if (isset($_GET["tipoRegistro"])) {
            $tipoRegistro = $_GET["tipoRegistro"];
        }
        if (isset($_GET["tipoCertificado"])) {
            $tipoCertificado = $_GET["tipoCertificado"];
        }
        if (isset($_GET["tipoAnexo"])) {
            $tipoAnexo = $_GET["tipoAnexo"];
        }
        if (isset($_GET["tipoEstudio"])) {
            $tipoEstudio = $_GET["tipoEstudio"];
        }
        if (isset($_GET["tipoMemoria"])) {
            $tipoMemoria = $_GET["tipoMemoria"];
        }

        if (isset($_GET["tipoDireccionTecnica"])) {
            $tipoDireccionTecnica = $_GET["tipoDireccionTecnica"];
        }

        //var_dump($tipoDocumentoProfesional . "<br>");

        $array_options_tipo0 = array('Anexo_1', 'COPIA_D.T._OTRAS_ADMINISTRACIONES', 'Designacion_coordinador_seguridad', 'Plano', 'Separata');  //Array tipo 0

        /*
    print_r($data);
    echo("<br> Tipo visado: ");
    print($data[0]["Tipo_visado"]);
    echo("<br> Importe: ");
    print($data[0]["Importe"]);
    echo("<br> Documento: ");
    print($data[0]["Documento"]);
    */

        //$preciofinal = $data[0]["Importe"];
        //$tipo = $data[0]["Tipo_visado"];
        //$coeficiente_reductor = $data[0]["Documento"];  Esto da el tipo de documento (por ejemplo Anexo_1 (de la base de datos sql))
        //$coeficiente_reductor = '-';
        //$_SESSION['preciofinal'] = $preciofinal;
        //$_SESSION['tipo'] = $tipo;
        //$_SESSION['coeficiente_reductor'] = $coeficiente_reductor;

        if ($tipoDocumentoProfesional == "Option0") { //Si no se selecciona ninguna opcion (la primera opcion del desplegable)
            echo '<script language="javascript">';
            echo 'if(!alert("Debes seleccionar el tipo de documento profesional")){window.location.reload();}'; //Avisa y recarga la página
            echo '</script>';
        }

        $array_options_tipocalculo = array("Proyecto", "Anexo", "Memoria", "Certificado", "Registro", "Direccion_tecnica");

        /*
    echo("<br>Tipo documento profesional = ". $tipoDocumentoProfesional . "<br> ");
    echo("<br>Array options tipocalculo = ". var_dump($array_options_tipocalculo) . "Fin" );
    var_dump($array_options_tipocalculo);
    */

        if ($tipoDocumentoProfesional == "Direccion_tecnica") {
            // echo ("<br> Es direccion tecnica = " . $tipoDireccionTecnica . "<br>");
            if ($tipoDireccionTecnica == "Direccion_tecnica_reforma_vehiculos") {  //esta no tiene minimo

                $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
                $stmt->bind_param('s', $tipoDireccionTecnica);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $preciofinal = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];

                // echo ("  <br> Precio final = " . $preciofinal);

                $es_direccion_tecnica = true;
            }

            if ($tipoDireccionTecnica == "Direc.Tec.Grua") {

                $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
                $stmt->bind_param('s', $tipoDireccionTecnica);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $preciofinal = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];

                $es_direccion_tecnica = true;
            }

            if ($tipoDireccionTecnica == "Direccion_tecnica_050") {
                // echo ("<br> Es una direccion tecnica 050");
                $direc_tec_050 = true;
                $tipoDocumentoProfesional = "Proyecto";  //Se cambia a proyecto para que pase por el if y haga el cálculo
                // echo("Tipo docuemnto profesional cmbiaadao a proyecto". $tipoDocumentoProfesional);
            } else {
                $direc_tec_050 = false;
            }

            if ($tipoDireccionTecnica == "Direccion_tecnica_070") {
                // echo ("<br> Es una direccion tecnica 070");

                $direc_tec_070 = true;
                $tipoDocumentoProfesional = "Proyecto";
            } else {
                $direc_tec_070 = false;
            }

            if ($tipoDireccionTecnica == "Direccion_tecnica_100") {
                // echo ("<br> Es una direccion tecnica 100");
                $direc_tec_100 = true;
                $tipoDocumentoProfesional = "Proyecto";
            } else {
                $direc_tec_100 = false;
            }
        }

        if ($tipoDocumentoProfesional == "Proyecto") { //Si se selecciona un proyecto o hay una direccion tecnica
            // echo ("Proyecto seleccionado <br>" . "<br> Tipo de proyecto <br>" . $tipoProyecto . "<br>");

            //--------------- Importe del tipo 9: -------------
            $valor_tipo_9 = 0;
            $stmt = $conexion->prepare('SELECT * FROM `Tabla1_Cuotas_tipo` WHERE `Tipo_visado` = 9;');
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
            $valor_tipo_9 = $data[0]["Importe"];
            //--------------- Importe del tipo 9 --------------


            if ($tipoProyecto == "Proyecto_construccion_nave") { //Si se selecciona un proyecto de construccion de nave
                // echo ("<br> Es un proyecto de contruccion de nave. Tipodocumentoprofesional = " . $tipoDocumentoProfesional . " <br> tipo proyecto: " . $tipoProyecto);
                $precio_final_temp = 0;

                $tipo5 = 0;  //Sacar el importe minimo
                $stmt = $conexion->prepare('SELECT * FROM `Tabla1_Cuotas_tipo` WHERE `Tipo_visado` = 5;');
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
                $tipo5 = $data[0]["Importe"];


                $superficie_construida_m2 = $_GET["parametro_superficie"];

                if (isset($_GET["parte_adosada_sin_cerramientos"])) { //Si se ha marcado la casilla de parte adosada sin cerramientos se asignan los dos valores a una variable
                    $checkbox_parte_adosada = $_GET["parte_adosada_sin_cerramientos"];
                    $m2parteadosada = $_GET["parte_adosada_sin_cerramientos_M2"];
                }
                if (isset($_GET["demoler_ya_existente"])) { //Si se ha marcado la casilla de demoler edificacion se asignan los dos valores a una variabl
                    $checkbox_demoler_edificacion_existente = $_GET["demoler_ya_existente"];
                    $m3_residuos_solidos_demolicion = $_GET["m3_residuos_solidos"];
                }
                if (isset($_GET["parametro_presupuesto"])) { //Si se ha puesto presupuesto se guarda en una variable
                    $presupuesto_proyecto_nave_industrial = $_GET["parametro_presupuesto"];
                }


                if (!$checkbox_demoler_edificacion_existente && !$m2parteadosada) { //Si no se marca ninguna casilla   CORRECTO
                    //Sacar importe y tipo que corresponde
                    // echo ("<br> <br> No se ha marcado ninguna de las dos casillas <br> <br>");
                    $stmt = $conexion->prepare('SELECT Tabla3_Edificios_Industriales.m2_construccion_minimo, Tabla3_Edificios_Industriales.m2_construccion_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla3_Edificios_Industriales, Tabla1_Cuotas_tipo WHERE Tabla3_Edificios_Industriales.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla3_Edificios_Industriales.m2_construccion_minimo <= ? and Tabla3_Edificios_Industriales.m2_construccion_maximo >= ?');
                    $stmt->bind_param('ss', $superficie_construida_m2, $superficie_construida_m2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);

                    $precio_final_temp = $data[0]["Importe"];
                    $tipo = $data[0]["Tipo_visado"];
                    $coeficiente_reductor = null;




                    if ($tipo == 0) { //Si es mayor a 5000 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                        $presupuesto_proyecto_nave_industrial = (float) $presupuesto_proyecto_nave_industrial;
                        $presupuesto_proyecto_nave_industrial = $presupuesto_proyecto_nave_industrial * $coeficiente_presupuesto;
                        $precio_final_temp = $presupuesto_proyecto_nave_industrial;

                        // echo ("<br> precio final temp: " . $precio_final_temp);
                        // echo ("<br> : " . $precio_final_temp);


                        if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                            $precio_final_temp = $valor_tipo_9;
                        }
                    }

                    $preciofinal = $precio_final_temp;
                }

                if ($checkbox_demoler_edificacion_existente && $m2parteadosada) {   //Si se marcan ambas casillas              

                    // echo ("Hay demolicion y parte adosada (los dos checkbox) Y SE CAMBIA");

                    $stmt = $conexion->prepare('SELECT Tabla3_Edificios_Industriales.m2_construccion_minimo, Tabla3_Edificios_Industriales.m2_construccion_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla3_Edificios_Industriales, Tabla1_Cuotas_tipo WHERE Tabla3_Edificios_Industriales.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla3_Edificios_Industriales.m2_construccion_minimo <= ? and Tabla3_Edificios_Industriales.m2_construccion_maximo >= ?');
                    $stmt->bind_param('ss', $superficie_construida_m2, $superficie_construida_m2);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);


                    $presupuesto_proyecto_nave_industrial = $data[0]["Importe"];
                    $tipo = $data[0]["Tipo_visado"];




                    if ($tipo == 0) { //Si es mayor a 5000 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                        $presupuesto_proyecto_nave_industrial_TEMP = $presupuesto_proyecto_nave_industrial * $coeficiente_presupuesto;
                        if ($presupuesto_proyecto_nave_industrial_TEMP < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                            $presupuesto_proyecto_nave_industrial = $valor_tipo_9;
                        }
                    }


                    //Ver tipo que correponde y precio sobre la parte adosada sin cerramientos
                    $stmt = $conexion->prepare('SELECT Tabla3_Edificios_Industriales.m2_construccion_minimo, Tabla3_Edificios_Industriales.m2_construccion_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla3_Edificios_Industriales, Tabla1_Cuotas_tipo WHERE Tabla3_Edificios_Industriales.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla3_Edificios_Industriales.m2_construccion_minimo <= ? and Tabla3_Edificios_Industriales.m2_construccion_maximo >= ?');
                    $stmt->bind_param('ss', $m2parteadosada, $m2parteadosada);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);

                    $precio_m2parteadosada = $data[0]["Importe"];
                    $precio_m2parteadosada_cuota_aplicada = $precio_m2parteadosada / 2; //Se aplica la cuota al 50%


                    //Calcular precio que corresponde por la demolicion
                    $m3_residuos_solidos_demolicion_cuota_aplicada = $m3_residuos_solidos_demolicion * 0.12; //0.12 es la cuota que se aplica por cada m3

                    // echo ("<BR> € A PAGAR POR DEMOLICION = " . $m3_residuos_solidos_demolicion_cuota_aplicada);
                    // echo ("<BR> € A PAGAR POR parte adosada = " . $precio_m2parteadosada_cuota_aplicada);
                    // echo ("<BR> € A PAGAR POR SUPERFICIE CONSTRUIDA FIX= " . $presupuesto_proyecto_nave_industrial);



                    //Precio final teniendo en cuenta la superficie construida, la parte adosada y la demolicion
                    $precio_final_temp = $presupuesto_proyecto_nave_industrial + $precio_m2parteadosada_cuota_aplicada + $m3_residuos_solidos_demolicion_cuota_aplicada;
                } else {
                    if ($m2parteadosada) {    //Si solo se marca la casilla 2 (parte adosada sin cerramiento)         
                        //Se aplica la tabla 3
                        //Cuota al 50%
                        // echo ("Solo se marca la casilla 2");

                        // ---------- Ver tipo que correponde y precio sobre la superficie construida ----------
                        $stmt = $conexion->prepare('SELECT Tabla3_Edificios_Industriales.m2_construccion_minimo, Tabla3_Edificios_Industriales.m2_construccion_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla3_Edificios_Industriales, Tabla1_Cuotas_tipo WHERE Tabla3_Edificios_Industriales.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla3_Edificios_Industriales.m2_construccion_minimo <= ? and Tabla3_Edificios_Industriales.m2_construccion_maximo >= ?');
                        $stmt->bind_param('ss', $superficie_construida_m2, $superficie_construida_m2);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $data = $result->fetch_all(MYSQLI_ASSOC);

                        $precio_final_temp = $data[0]["Importe"];
                        $tipo = $data[0]["Tipo_visado"];
                        $coeficiente_reductor = null;


                        if ($tipo == 0) { //Si es mayor a 5000 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                            $presupuesto_proyecto_nave_industrial = (float) $presupuesto_proyecto_nave_industrial;
                            $presupuesto_proyecto_nave_industrial = $presupuesto_proyecto_nave_industrial * $coeficiente_presupuesto;
                            $precio_final_temp = $presupuesto_proyecto_nave_industrial;

                            if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                                $precio_final_temp = $valor_tipo_9;
                            }
                        }

                        $preciofinal = $precio_final_temp;

                        $precio_final_por_construccion = $preciofinal;
                        // echo "<br>Precio por construccion:  ". $precio_final_por_construccion;


                        ////  ----------  Ver tipo que correponde y precio sobre la parte adosada sin cerramientos  ----------  
                        $stmt = $conexion->prepare('SELECT Tabla3_Edificios_Industriales.m2_construccion_minimo, Tabla3_Edificios_Industriales.m2_construccion_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla3_Edificios_Industriales, Tabla1_Cuotas_tipo WHERE Tabla3_Edificios_Industriales.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla3_Edificios_Industriales.m2_construccion_minimo <= ? and Tabla3_Edificios_Industriales.m2_construccion_maximo >= ?');
                        $stmt->bind_param('ss', $m2parteadosada, $m2parteadosada);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $data = $result->fetch_all(MYSQLI_ASSOC);

                        $precio_m2parteadosada = $data[0]["Importe"];
                        // echo "<br>importe que sale por m2 partee adosada:  ". $precio_m2parteadosada;

                        $precio_m2parteadosada_cuota_aplicada = $precio_m2parteadosada / 2; //Se aplica la cuota al 50%   //PRECIO QUE CORRRESPONDE POR PARTE ADOSADA
                        // echo "<br>despues de 50% reduccion :  ". $precio_m2parteadosada_cuota_aplicada;

                        $tipo = $data[0]["Tipo_visado"];

                        $presupuesto_proyecto_nave_industrial = $precio_m2parteadosada_cuota_aplicada;


                        if ($tipo == 0) { //Si el tipo que correponde de superficie construida es 0 (mayor a 5000)
                            $presupuesto_proyecto_nave_industrial = $precio_m2parteadosada_cuota_aplicada * $coeficiente_presupuesto;

                            if ($presupuesto_proyecto_nave_industrial < $precio_m2parteadosada_cuota_aplicada) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                                $presupuesto_proyecto_nave_industrial = $precio_m2parteadosada_cuota_aplicada;
                            }
                        }
                        //Precio final teniendo en cuenta la superficie construida y la parte adosada

                        // echo ("<br> Precio que corresponde por superficie construida antes= " . $precio_superficie_construida);
                        // echo ("<br> Precio que corresponde por parte adosada deespues = " . $precio_m2parteadosada_cuota_aplicada);


                        // echo "<br> Precio por marquesina:  ". $presupuesto_proyecto_nave_industrial;


                        $precio_final_temp = intval($precio_final_por_construccion) + intval($presupuesto_proyecto_nave_industrial);
                    }

                    if ($checkbox_demoler_edificacion_existente) {    //Si solo se marca demoler edificacion
                        // echo ("Solo se marca la casilla de demoler edificacion existente");

                        //Sacar importe y tipo que corresponde
                        $stmt = $conexion->prepare('SELECT Tabla3_Edificios_Industriales.m2_construccion_minimo, Tabla3_Edificios_Industriales.m2_construccion_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla3_Edificios_Industriales, Tabla1_Cuotas_tipo WHERE Tabla3_Edificios_Industriales.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla3_Edificios_Industriales.m2_construccion_minimo <= ? and Tabla3_Edificios_Industriales.m2_construccion_maximo >= ?');
                        $stmt->bind_param('ss', $superficie_construida_m2, $superficie_construida_m2);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $data = $result->fetch_all(MYSQLI_ASSOC);

                        $preciofinal = $data[0]["Importe"];
                        $tipo = $data[0]["Tipo_visado"];
                        $coeficiente_reductor = null;

                        if ($tipo == 0) { //v Si es mayor a 5000 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                            $presupuesto_proyecto_nave_industrial = $_GET["parametro_presupuesto"];

                            $preciofinal = intval($preciofinal);
                            $preciofinal = $presupuesto_proyecto_nave_industrial * $coeficiente_presupuesto;

                            if ($preciofinal < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                                $preciofinal = $valor_tipo_9;
                            }
                            // echo ("Precio final siendo de tipo 0 = " . $preciofinal);
                        }



                        //Calcular precio que corresponde por la demolicion
                        $m3_residuos_solidos_demolicion_cuota_aplicada = 0;
                        $m3_residuos_solidos_demolicion_cuota_aplicada = $m3_residuos_solidos_demolicion * 0.12; //0.12 es la cuota que se aplica por cada m3

                        // echo ("Precio final por demolicion = " . $m3_residuos_solidos_demolicion_cuota_aplicada);
                        if ($preciofinal < 39.60) {
                            $preciofinal = 39.60;
                        }

                        // echo ("<br> Precio final  = " . $preciofinal);
                        // echo ("<br> Precio por demolicion  = " . $m3_residuos_solidos_demolicion_cuota_aplicada);



                        //Precio final teniendo en cuenta la superficie construida y los m3 que se van a demoler
                        $precio_final_temp = $preciofinal + $m3_residuos_solidos_demolicion_cuota_aplicada;
                    }
                }

                $preciofinal = $precio_final_temp;


                if ($preciofinal < $tipo5) { //Si el importe del tipo 5 es mas grande que el resultado se queda con el importe del tipo 5
                    $preciofinal = $tipo5;
                }
            } //v

            if ($tipoProyecto == "Proyecto_basico_Actuacion_Anteproyecto") {
                // echo("Es un tipo de proyecto basico / actuacion / ante");
                $mostrarResultado = false;
                echo "


                <div class='div_proyecto_basico_bb' > 
                <i class='fa-solid fa-circle-info fa-lg '></i>   
                <p>
                <B>Proyecto básico: </B>  <br>
                
                Este incluye la definición necesaria para obtener Licencia Urbanística u otra autorización administrativa, sin definicion constructiva, de manera que obtenida la licencia solicitada se procederá a la redacción del correspondiente proyecto de ejecución. 
                
                <br>   
    
                En base a lo anterior el proyecto básico se valorará al 25% de la cuota que correspondiera.
                </p>
                </div> 


                <div class='div_proyecto_basico_aa ' > 
                <i class='fa-solid fa-circle-info fa-lg'></i>   
                <p> 
                
                
             <b>Proyecto actuación: </b> <br> Dado que el objeto de este tipo de proyecto es obtener la autorización previa mediante la calificación de utilidad pública de la actuación a llevar a cabo y no el de ejecución de las obras e instalaciones, su cuota correponderá al 25% de la calculada para el proyecto de ejecución.              
            </p>
            </div>  
            
            

           


            <div class='div_proyecto_basico_cc' > 
            <i class='fa-solid fa-circle-info fa-lg'></i>   
            <P> 
            <B>Anteproyecto:</B> Es una propuesta de proyecto donde son trazadas o esbozadas las líneas fundamentales que se pretenden desarrollar posteriormente en el proceso de ejecución.
            <br>
            En base a lo anterior el anteproyecto se valorará al 25% de la cuota que correspondiera. 
            </P>
            </div>  


          
     

            <div class='div_proyecto_basico_minimo' > 
            <i class='fa-solid fa-circle-info'></i>

                La cuota mínima para este tipo de proyecto es 39,60€

            </div> 

            <div id='div_invisible2'><br></div>
            ";
            }

            if ($tipoProyecto == "Proyecto_reforma_vehiculos") {
                $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
                $stmt->bind_param('s', $tipoProyecto);
                $stmt->execute();

                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
                $preciofinal = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                // echo ("Precio final = " . $preciofinal);
            }

            if ($tipoProyecto == "Proyecto_instalaciones_actividad") {
                // echo ("Es un tipo de proyecto instalaciones / actividad");
                $m2_instalaciones_actividad = $_GET["m2_proyecto_instalaciones_actividad"];



                $stmt = $conexion->prepare('SELECT Tabla5_Solo_calificacion_ambiental.m2_superficie_minimo, Tabla5_Solo_calificacion_ambiental.m2_superficie_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla5_Solo_calificacion_ambiental, Tabla1_Cuotas_tipo WHERE Tabla5_Solo_calificacion_ambiental.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla5_Solo_calificacion_ambiental.m2_superficie_minimo <= ? and Tabla5_Solo_calificacion_ambiental.m2_superficie_maximo >= ?');
                $stmt->bind_param('ss', $m2_instalaciones_actividad, $m2_instalaciones_actividad);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $preciofinal = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;

                if ($tipo == 0) { //v Si es mayor a 5000 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $presupuesto_proyecto_instalaciones_actividad = $_GET["m2_proyecto_instalaciones_actividad_presupuesto"];

                    $preciofinal = $presupuesto_proyecto_instalaciones_actividad * $coeficiente_presupuesto;

                    if ($preciofinal < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $preciofinal = $valor_tipo_9;
                    }
                    // echo ("Precio final siendo de tipo 0 = " . $preciofinal);
                }
            }

            if ($tipoProyecto == "Proyecto_alumbrado_publico") {

                if (isset($_GET["pts_alumbrado"])) {    //Si se ha marcado la casilla de parte adosada sin cerramientos se asignan los dos valores a una variable
                    $puntos_alumbrado = 0.0;
                    $puntos_alumbrado = $_GET["pts_alumbrado"];

                    $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla14_Alumbrado_publico.Tipo FROM Tabla14_Alumbrado_publico, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla14_Alumbrado_publico.Tipo AND Tabla14_Alumbrado_publico.Puntos_min <= ? and Tabla14_Alumbrado_publico.Puntos_max >= ?;');
                    $stmt->bind_param('ss', $puntos_alumbrado, $puntos_alumbrado);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);

                    $preciofinal = $data[0]["Importe"];
                    $tipo = $data[0]["Tipo_visado"];

                    if (isset($_GET["alumbrado_sustitucion"])) {  //Si se marca la casilla de proyecto de sustitucion
                        // echo ("Al ser proyecto de sustitucion se ha multiplicado por 0.75");
                        $preciofinal = intval($preciofinal) * 0.75;
                    }

                    if ($preciofinal < 39.60) { //Si es menor a 39.60 se queda con ese precio
                        $preciofinal = 39.60;
                    }

                    $coeficiente_presupuesto;

                    if ($tipo == 0) { //Si es mayor a 750 se multiplica por 0.0035
                        // echo ("<br> Precio final antes de presupuesto= " . $puntos_alumbrado);
                        $preciofinal = $puntos_alumbrado * $coeficiente_presupuesto;
                        // echo ("<br> Precio final despues de presupuesto= " . $preciofinal);

                        if ($preciofinal < $valor_tipo_9) { //Si el resultado es menor a 173 se queda con 173 (tipo 9)
                            $preciofinal = $valor_tipo_9;
                        }
                    }
                } else {
                    echo '<script language="javascript">';
                    echo 'if(!alert("Debes indicar los puntos de la instalación")){window.location.reload();}'; //Avisa y recarga la página
                    echo '</script>';
                }
            } //v

            if ($tipoProyecto == "Proyectos_cuota_piscina") {

                $piscina_kw = $_GET["piscina_kw"];

                $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla11_Piscinas.Tipo FROM Tabla11_Piscinas, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla11_Piscinas.Tipo AND Tabla11_Piscinas.kw_minino <= ? and Tabla11_Piscinas.kw_maximo >= ?;');
                $stmt->bind_param('ss', $piscina_kw, $piscina_kw);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $preciofinal = $data[0]["Importe"];

                $tipo = $data[0]["Tipo_visado"];

                if ($tipo == 0) {

                    $euros = intval($preciofinal);

                    //Se obtienen los tipos 
                    // ------- Se busca el precio del tipo 2 -------
                    $tipo_piscina = 2;
                    $stmt = $conexion->prepare('SELECT * FROM Tabla1_Cuotas_tipo WHERE Tipo_visado  = ? ');
                    $stmt->bind_param('s', $tipo_piscina);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    $tipo2 = $data[0]["Importe"];  //Importe que se aplica cada 10kw (EL TIPO 2)

                    //------- Se busca el precio del tipo 5 -------
                    $tipo_5piscina = 5;
                    $stmt = $conexion->prepare('SELECT * FROM Tabla1_Cuotas_tipo WHERE Tipo_visado  = ? ');
                    $stmt->bind_param('s', $tipo_5piscina);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    $tipo5 = $data[0]["Importe"];  //Importe que se aplica a los primeros 10 kw (tipo 5)


                    // echo ("<BR> KW PISCINA ANTES = " . $piscina_kw);
                    // echo ("<BR> Euros ANTES = " . $euros);

                    $contador_anadir_20 = 0; //Contador € que se añaden
                    $piscina_kw = $piscina_kw - 10; //Se restan 10 kw y se añade a la variable que guarda el precio el importe del tipo 5
                    $euros = $euros + $tipo5;

                    // echo ("<BR> Despues de rrestarlee la primera vez = ");

                    // echo ("<BR> KW PISCINA ANTES = " . $piscina_kw);
                    // echo ("<BR> Euros ANTES = " . $euros);

                    while ($piscina_kw >= 1) { //Mientras siga teniendo valor 
                        $euros = $euros + $tipo2;
                        $piscina_kw = $piscina_kw - 10; //Se van restando los 10kw
                    }

                    $preciofinal = $euros; //Se guarda en la variable el precio final
                }


                // if ($preciofinal < 39.60) {
                //     $preciofinal = 39.60;
                // }


                // echo '<script language="javascript">';
                // echo 'if(!alert("Debes indicar los puntos de la instalación")){window.location.reload();}'; //Avisa y recarga la página
                // echo '</script>';
            } //v

            if ($tipoProyecto == "Cuota_puntos_recarga") {

                //Sacar importe tipo 3 y tipo 9
                // Importe del tipo 3 
                $tipo3 = 0;
                $stmt = $conexion->prepare('SELECT * FROM `Tabla1_Cuotas_tipo` WHERE `Tipo_visado` = 3;');
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
                $tipo3 = $data[0]["Importe"];

                //Importe del tipo 9 
                $tipo9 = 0;
                $stmt = $conexion->prepare('SELECT * FROM `Tabla1_Cuotas_tipo` WHERE `Tipo_visado` = 9;');
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
                $tipo9 = $data[0]["Importe"];

                $KW_POTENCIA_PUNTOS_RECARGA = $_GET["kw_potencia_puntos_recarga"];
                $presupuesto_KW_POTENCIA = $_GET["kw_potencia_presupuesto"];

                // echo ("<br> </br>KW POTENCIA RECARGA = " . $KW_POTENCIA_PUNTOS_RECARGA);
                // echo ("<br> Presupuesto POTENCIA RECARGA = " . $presupuesto_KW_POTENCIA);

                //Sacar de la tabla 13 puntos recarga que tipo corresponde
                $stmt = $conexion->prepare('SELECT Tabla13_Puntos_recarga.Kw_min, Tabla13_Puntos_recarga.Kw_max, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla13_Puntos_recarga, Tabla1_Cuotas_tipo WHERE Tabla13_Puntos_recarga.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla13_Puntos_recarga.Kw_min <= ? and Tabla13_Puntos_recarga.Kw_max >= ?');
                $stmt->bind_param('ss', $KW_POTENCIA_PUNTOS_RECARGA, $KW_POTENCIA_PUNTOS_RECARGA);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $tipo_potencia_kw = $data[0]["Tipo_visado"];
                $precio_puntos_recarga = $data[0]["Importe"];

                // echo ("<br> tipo : " . $tipo_potencia_kw . "<br>" . "precio puntos:" . $precio_puntos_recarga);

                if ($precio_puntos_recarga < $tipo3) {
                    $precio_puntos_recarga = $tipo3;
                }

                if ($tipo_potencia_kw == 0) { //Si se sale del tipo 9
                    $precio_puntos_recarga = $presupuesto_KW_POTENCIA * $coeficiente_presupuesto;  //Se multiplica el presupuesto por el coeficiente reductor (0.0035)
                    if ($precio_puntos_recarga < $tipo9) {
                        $precio_puntos_recarga = $tipo9;  //Si el resultado es mas pequeño se queda con el valor del tipo9
                    }

                    // echo ("<br> presupuesto KW_POTENCIA= " . $presupuesto_KW_POTENCIA);
                    // echo ("<br> coeficiente_presupuesto = " . $coeficiente_presupuesto);
                    // echo ("<br> Precio puntos recarga (al ser tipo 0) = " . $precio_puntos_recarga);
                }

                $preciofinal = $precio_puntos_recarga;

                if ($preciofinal < $tipo3) {   //Si el resultado es mas pequeño que el tipo 3 se queda con el tipo 3
                    $preciofinal = $tipo3;
                }
            } //v

            if ($tipoProyecto == "Cuota_garajes") {

                if (isset($_GET["m2_cuota_garaje"])) {
                    $m2garaje = $_GET["m2_cuota_garaje"];
                }


                // echo ("Cuota garajes seleccionadaa");

                $stmt = $conexion->prepare('SELECT Tabla7_Garajes.m2_construidos_minimos, Tabla7_Garajes.m2_construidos_maximos, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla7_Garajes, Tabla1_Cuotas_tipo WHERE Tabla7_Garajes.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla7_Garajes.m2_construidos_minimos <= ? and Tabla7_Garajes.m2_construidos_maximos >= ?');
                $stmt->bind_param('ss', $m2garaje, $m2garaje);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;



                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp =  $_GET["presupuesto_m2_cuota_garaje"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                        // echo ("Era menor asi que se queda con el tipo 9");
                    }
                }
                $preciofinal = $precio_final_temp;
            } //v

            if ($tipoProyecto == "Cuota_instalaciones_fotovoltaicas") {

                if (isset($_GET["kw_fotovol"])) {
                    $kw_fotovol = $_GET["kw_fotovol"];
                }

                $stmt = $conexion->prepare('SELECT Tabla8_Instalaciones_Fotovoltaicas.Kw_minimo, Tabla8_Instalaciones_Fotovoltaicas.Kw_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla8_Instalaciones_Fotovoltaicas, Tabla1_Cuotas_tipo WHERE Tabla8_Instalaciones_Fotovoltaicas.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla8_Instalaciones_Fotovoltaicas.Kw_minimo <= ? and Tabla8_Instalaciones_Fotovoltaicas.Kw_maximo >= ?');
                $stmt->bind_param('ss', $kw_fotovol, $kw_fotovol);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;



                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp =  $_GET["presupuesto_kw_fotovol"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                        // echo ("Era menor asi que se queda con el tipo 9");
                    }
                }
                $preciofinal = $precio_final_temp;
            } //v

            if ($tipoProyecto == "Cuota_instalaciones_fotovoltaicas_autoconsumo") {
                if (isset($_GET["kw_fotovol_autoc"])) {
                    $kw_fotovol_autoc = $_GET["kw_fotovol_autoc"];
                }

                $stmt = $conexion->prepare('SELECT Tabla9_Fotovoltaicas_autoconsumo.Kw_minimo, Tabla9_Fotovoltaicas_autoconsumo.Kw_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla9_Fotovoltaicas_autoconsumo, Tabla1_Cuotas_tipo WHERE Tabla9_Fotovoltaicas_autoconsumo.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla9_Fotovoltaicas_autoconsumo.Kw_minimo <= ? and Tabla9_Fotovoltaicas_autoconsumo.Kw_maximo >= ?');
                $stmt->bind_param('ss', $kw_fotovol_autoc, $kw_fotovol_autoc);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;

                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp =  $_GET["presupuesto_fotovol_autoc"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                    }
                }
                $preciofinal = $precio_final_temp;
            } //v

            if ($tipoProyecto == "Cuota_instalacion_grupo_presion_electrogeno") {

                if (isset($_GET["kva_grupo_pree"])) {
                    $kva_grupo_pree = $_GET["kva_grupo_pree"];
                }


                $stmt = $conexion->prepare('SELECT Tabla10_Instalacion_grupo.kva_minimo, Tabla10_Instalacion_grupo.kva_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla10_Instalacion_grupo, Tabla1_Cuotas_tipo WHERE Tabla10_Instalacion_grupo.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla10_Instalacion_grupo.kva_minimo <= ? and Tabla10_Instalacion_grupo.kva_maximo >= ?');
                $stmt->bind_param('ss', $kva_grupo_pree, $kva_grupo_pree);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;


                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp = $_GET["presupuesto_kva_grupo_pree"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                    }
                }
                $preciofinal = $precio_final_temp;
            } //v

            if ($tipoProyecto == "Cuota_depositos_ppl") {
                if (isset($_GET["l_deposito_ppl"])) {
                    $l_deposito_ppl = $_GET["l_deposito_ppl"];
                }

                $stmt = $conexion->prepare('SELECT Tabla16_Cuota_depositos_PPL.l_min, Tabla16_Cuota_depositos_PPL.l_max, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla16_Cuota_depositos_PPL, Tabla1_Cuotas_tipo WHERE Tabla16_Cuota_depositos_PPL.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla16_Cuota_depositos_PPL.l_min <= ? and Tabla16_Cuota_depositos_PPL.l_max >= ?');
                $stmt->bind_param('ss', $l_deposito_ppl, $l_deposito_ppl);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;


                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp = $_GET["presupuesto_l_deposito_ppl"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                        // echo ("Era menor asi que se queda con el tipo 9");
                    }
                }
                $preciofinal = $precio_final_temp;
            }  //v

            if ($tipoProyecto == "Cuota_depositos_GLP") {
                if (isset($_GET["l_deposito_GLP"])) {
                    $l_deposito_GLP = $_GET["l_deposito_GLP"];
                }

                $stmt = $conexion->prepare('SELECT Tabla17_Cuota_depositos_GLP.l_min, Tabla17_Cuota_depositos_GLP.l_max, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla17_Cuota_depositos_GLP, Tabla1_Cuotas_tipo WHERE Tabla17_Cuota_depositos_GLP.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla17_Cuota_depositos_GLP.l_min <= ? and Tabla17_Cuota_depositos_GLP.l_max >= ?');
                $stmt->bind_param('ss', $l_deposito_GLP, $l_deposito_GLP);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;


                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp = $_GET["presupuesto_l_deposito_GLP"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                        // echo ("Era menor asi que se queda con el tipo 9");
                    }
                }
                $preciofinal = $precio_final_temp;
            }  //v

            if ($tipoProyecto == 'Proyectos_grua_por_grua') {


                $cantidad_gruas = $_GET["cantidad_gruas"];
                $preciofinal = $tipo4 * $cantidad_gruas;

                //Deberia multiplicar 39,6 por la cantidad de gruas que hay

            }

            if ($tipoProyecto == "Cuota_redes_gas") {
                if (isset($_GET["met_lin_redes_gas"])) {
                    $met_lin_redes_gas = $_GET["met_lin_redes_gas"];
                }


                $stmt = $conexion->prepare('SELECT Tabla18_Cuota_Redes_Gas.ml_min, Tabla18_Cuota_Redes_Gas.ml_max, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla18_Cuota_Redes_Gas, Tabla1_Cuotas_tipo WHERE Tabla18_Cuota_Redes_Gas.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla18_Cuota_Redes_Gas.ml_min <= ? and Tabla18_Cuota_Redes_Gas.ml_max >= ?');
                $stmt->bind_param('ss', $met_lin_redes_gas, $met_lin_redes_gas);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;


                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp = $_GET["presupuesto_met_lin_redes_gas"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                    }
                }
                $preciofinal = $precio_final_temp;
            }

            if ($tipoProyecto == "Proyecto_demolicion_desmantelamiento") {

                // $tipo35 = 0;
                // $stmt = $conexion->prepare('SELECT * FROM `Tabla1_Cuotas_tipo` WHERE `Tipo_visado` = 35;');
                // $stmt->execute();
                // $result = $stmt->get_result();
                // $data = $result->fetch_all(MYSQLI_ASSOC);
                // $tipo35 = $data[0]["Importe"];

                // echo "import del tipo35 = ". $tipo35;



                $resultado = 0;

                $m3_proyecto_desmantelamiento = $_GET["m3_proyecto_desmantelamiento"];

                foreach (range(0, $m3_proyecto_desmantelamiento) as $num) {

                    $resultado += 1 * 0.12; //Por cada m3 se multiplica 1 mtro cuadrado por 0.12 y se va sumando
                }

                //que saque por post los m3 de residuos solidos y luego mire el importe, debe ser mayor a 39 y menor a 560 creo
                if ($resultado < 39.60) {
                    $resultado = 39.60;
                }

                if ($resultado > 560) {
                    $resultado = 560;
                }

                $preciofinal = $resultado;
            }

            if ($tipoProyecto == "Proyecto_instalacion_BTIndustrial_Publica") {
                if (isset($_GET["kw_instalacion_bt_industrial"])) {
                    $kw_instalacion_bt_industrial = $_GET["kw_instalacion_bt_industrial"];
                }

                $stmt = $conexion->prepare('SELECT Tabla4_Instalacion_BTIndustrial.kw_potencia_minima, Tabla4_Instalacion_BTIndustrial.kw_potencia_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla4_Instalacion_BTIndustrial, Tabla1_Cuotas_tipo WHERE Tabla4_Instalacion_BTIndustrial.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla4_Instalacion_BTIndustrial.kw_potencia_minima <= ? and Tabla4_Instalacion_BTIndustrial.kw_potencia_maximo >= ?');
                $stmt->bind_param('ss', $kw_instalacion_bt_industrial, $kw_instalacion_bt_industrial);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;

                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)

                    //FALTA QUE CUANDO SEA LEGALIZACION DE ACTIVIDAD TMB SE APLIQUE LA TABLA 5
                    $precio_final_temp = $_GET["presupuesto_kw_instalacion_bt_industrial"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                    }
                }
                $preciofinal = $precio_final_temp;
            }

            if ($tipoProyecto == "Proyecto_solo_calificacion_ambiental_actividad") {

                if (isset($_GET["met_s_calificacion_ambiental"])) {
                    $met_s_calificacion_ambiental = $_GET["met_s_calificacion_ambiental"];
                }

                $stmt = $conexion->prepare('SELECT Tabla5_Solo_calificacion_ambiental.m2_superficie_minimo, Tabla5_Solo_calificacion_ambiental.m2_superficie_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla5_Solo_calificacion_ambiental, Tabla1_Cuotas_tipo WHERE Tabla5_Solo_calificacion_ambiental.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla5_Solo_calificacion_ambiental.m2_superficie_minimo <= ? and Tabla5_Solo_calificacion_ambiental.m2_superficie_maximo >= ?');
                $stmt->bind_param('ss', $met_s_calificacion_ambiental, $met_s_calificacion_ambiental);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;

                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp = $_GET["presupuesto_met_s_calificacion_ambiental"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                    }
                }
                $preciofinal = $precio_final_temp;
            }

            if ($tipoProyecto == "Proyecto_cuota_instalaciones_viviendas") {

                if (isset($_GET["met_p_instalaciones_viviendas"])) {
                    $met_p_instalaciones_viviendas = $_GET["met_p_instalaciones_viviendas"];
                }

                $stmt = $conexion->prepare('SELECT Tabla6_Instalaciones_viviendas.num_viviendas_minimo, Tabla6_Instalaciones_viviendas.num_viviendas_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla6_Instalaciones_viviendas, Tabla1_Cuotas_tipo WHERE Tabla6_Instalaciones_viviendas.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla6_Instalaciones_viviendas.num_viviendas_minimo <= ? and Tabla6_Instalaciones_viviendas.num_viviendas_maximo >= ?');
                $stmt->bind_param('ss', $met_p_instalaciones_viviendas, $met_p_instalaciones_viviendas);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;

                //FALTA APLICAR TABLA COEFICIENTES REDUCTORES


                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp = $_GET["presupuesto_met_p_instalaciones_viviendas"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                    }
                }
                $preciofinal = $precio_final_temp;
            }

            if ($tipoProyecto == "Cuota_receptoras_gas") {

                if (isset($_GET["cuota_receptoras_gas_kw"])) {
                    $cuota_receptoras_gas_kw = $_GET["cuota_receptoras_gas_kw"];
                }

                $stmt = $conexion->prepare('SELECT Tabla21_Cuota_Receptoras_Gas.kw_minimo, Tabla21_Cuota_Receptoras_Gas.kw_maximo, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla21_Cuota_Receptoras_Gas, Tabla1_Cuotas_tipo WHERE Tabla21_Cuota_Receptoras_Gas.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla21_Cuota_Receptoras_Gas.kw_minimo <= ? and Tabla21_Cuota_Receptoras_Gas.kw_maximo >= ?');
                $stmt->bind_param('ss', $cuota_receptoras_gas_kw, $cuota_receptoras_gas_kw);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;


                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp = $_GET["Presupuesto_cuota_receptoras_gas_kw"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                    }
                }
                $preciofinal = $precio_final_temp;
            }

            if ($tipoProyecto == "Cuota_instalaciones_rite") {

                if (isset($_GET["cuota_instalaciones_rite_kw"])) {
                    $cuota_instalaciones_rite_kw = $_GET["cuota_instalaciones_rite_kw"];
                }


                $stmt = $conexion->prepare('SELECT Tabla22_Cuota_instalaciones_Rite.kw_min, Tabla22_Cuota_instalaciones_Rite.kw_max, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla22_Cuota_instalaciones_Rite, Tabla1_Cuotas_tipo WHERE Tabla22_Cuota_instalaciones_Rite.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla22_Cuota_instalaciones_Rite.kw_min <= ? and Tabla22_Cuota_instalaciones_Rite.kw_max >= ?');
                $stmt->bind_param('ss', $cuota_instalaciones_rite_kw, $cuota_instalaciones_rite_kw);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;


                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp = $_GET["Presupuesto_cuota_instalaciones_rite_kw"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                    }
                }
                $preciofinal = $precio_final_temp;
            }

            if ($tipoProyecto == "Cuota_instalaciones_renovacion_aire") {

                if (isset($_GET["cuota_instalaciones_renovacion_aire"])) {
                    $cuota_instalaciones_renovacion_aire = $_GET["cuota_instalaciones_renovacion_aire"];
                }


                $stmt = $conexion->prepare('SELECT Tabla23_Cuota_Instalaciones_RenovacionAire.m3_min, Tabla23_Cuota_Instalaciones_RenovacionAire.m3_max, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla23_Cuota_Instalaciones_RenovacionAire, Tabla1_Cuotas_tipo WHERE Tabla23_Cuota_Instalaciones_RenovacionAire.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla23_Cuota_Instalaciones_RenovacionAire.m3_min <= ? and Tabla23_Cuota_Instalaciones_RenovacionAire.m3_max >= ?');
                $stmt->bind_param('ss', $cuota_instalaciones_renovacion_aire, $cuota_instalaciones_renovacion_aire);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;


                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp = $_GET["Presupuesto_cuota_instalaciones_renovacion_aire"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                    }
                }
                $preciofinal = $precio_final_temp;
            }

            if ($tipoProyecto == "Cuota_redessuministro_redesinfraestructura_redessaneamiento") {

                if (isset($_GET["cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento"])) {
                    $cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento = $_GET["cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento"];
                }

                $stmt = $conexion->prepare('SELECT Tabla19_Cuota_Redes_SuministrosAgua_RedesInfraes_RedesSaneamient.ml_min, Tabla19_Cuota_Redes_SuministrosAgua_RedesInfraes_RedesSaneamient.ml_max, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla19_Cuota_Redes_SuministrosAgua_RedesInfraes_RedesSaneamient, Tabla1_Cuotas_tipo WHERE Tabla19_Cuota_Redes_SuministrosAgua_RedesInfraes_RedesSaneamient.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla19_Cuota_Redes_SuministrosAgua_RedesInfraes_RedesSaneamient.ml_min <= ? and Tabla19_Cuota_Redes_SuministrosAgua_RedesInfraes_RedesSaneamient.ml_max >= ?');
                $stmt->bind_param('ss', $cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento, $cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;


                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp = $_GET["Presupuesto_cuota_instalaciones_renovacion_aire"] * $coeficiente_presupuesto;

                    if ($precio_final_temp < $valor_tipo_9) { //Si el presupuesto calculado es mas pequeño que el importe de la tabla que le corresponde se queda con el importe de la tabla
                        $precio_final_temp = $valor_tipo_9;
                    }
                }
                $preciofinal = $precio_final_temp;
            }

            if ($tipoProyecto == "Sustitucion_maquinaria") {
                $mostrarResultado = false;
                echo "
            <div class='div_sustitucion_maquinaria'> 
            <i class='fa-solid fa-circle-info fa-xl'></i> &nbsp;  
                <p>
                El proyecto de sustitución de maquinaria está pensado fundamentalmente para aquellos proyectos en los que no se realiza la instalación completa si no la sustitución de una máquina. El ejemplo práctico es la sustitución de una caldera de calefacción sin realizar ninguna otra instalación adicional. En casos así se opta por esta denominación del proyecto a los efectos de poder aplicar al mismo una cuota tope más reducida según las tablas de cálculo que le sean de aplicación (tope de cuota 280€). No obstante, el cálculo de la cuota quedará al criterio de la Comisión de Visado a la vista del contenido del proyecto.
                </p>
            </div>  
            
            <div id='div_invisible3'>
            
            </div>
            ";
            }

            if ($tipoProyecto == "Cuota_lineas_BT") {
                // echo ("<br> calculando Cuota_lineas_BT");

                $ml_lineas_bt = $_GET["ml_lineas_bt"];
                $stmt = $conexion->prepare('SELECT Tabla31_cuota_lineas_BT.ml_min, Tabla31_cuota_lineas_BT.ml_max, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla31_cuota_lineas_BT, Tabla1_Cuotas_tipo WHERE Tabla31_cuota_lineas_BT.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla31_cuota_lineas_BT.ml_min <= ? and Tabla31_cuota_lineas_BT.ml_max >= ?');
                $stmt->bind_param('ss', $ml_lineas_bt, $ml_lineas_bt);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;
                // echo ("Tipo = " . $tipo);

                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp2 = $_GET["presupuesto_ml_lineas_bt"] * $coeficiente_presupuesto;

                    if ($precio_final_temp2 < $valor_tipo_9) {    //Si el resultado es menor a 173 se queda con 173 (tipo 9)
                        $precio_final_temp2 = $valor_tipo_9;
                    }
                    $precio_final_temp = $precio_final_temp2;
                }
                $preciofinal = $precio_final_temp;
                // echo ("<br> Precio final : " . $preciofinal);
            } elseif ($tipoProyecto == "Cuota_lineas_AT") {
                // echo ("Cuota_lineas_AT");
                $at_lineas_bt = $_GET["ml_lineas_at"];

                $stmt = $conexion->prepare('SELECT Tabla32_cuota_lineas_AT.ml_min, Tabla32_cuota_lineas_AT.ml_max, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla32_cuota_lineas_AT, Tabla1_Cuotas_tipo WHERE Tabla32_cuota_lineas_AT.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla32_cuota_lineas_AT.ml_min <= ? and Tabla32_cuota_lineas_AT.ml_max >= ?');
                $stmt->bind_param('ss', $at_lineas_bt, $at_lineas_bt);

                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;

                // echo ("Tipo = " . $tipo);

                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp2 = $_GET["presupuesto_ml_lineas_at"] * $coeficiente_presupuesto;
                    if ($precio_final_temp2 < $valor_tipo_9) {    //Si el resultado es menor a 173 se queda con 173 (tipo 9)
                        $precio_final_temp2 = $valor_tipo_9;
                    }
                    $precio_final_temp = $precio_final_temp2;
                }
                $preciofinal = $precio_final_temp;
                // echo ("<br> percio final : " . $preciofinal);
            } elseif ($tipoProyecto == "Cuota_lineas_CT") {
                // echo ("Cuota_lineas_CT");
                $ct_lineas_bt = $_GET["ml_lineas_ct"];

                $stmt = $conexion->prepare('SELECT Tabla33_cuota_lineas_CT.ml_min, Tabla33_cuota_lineas_CT.ml_max, Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe FROM Tabla33_cuota_lineas_CT, Tabla1_Cuotas_tipo WHERE Tabla33_cuota_lineas_CT.Tipo = Tabla1_Cuotas_tipo.Tipo_visado and Tabla33_cuota_lineas_CT.ml_min <= ? and Tabla33_cuota_lineas_CT.ml_max >= ?');
                $stmt->bind_param('ss', $ct_lineas_bt, $ct_lineas_bt);

                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $precio_final_temp = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
                $coeficiente_reductor = null;

                // echo ("Tipo = " . $tipo);

                if ($tipo == 0) { //Si es tipo 0 se calcula el presupuesto ($presupuesto * coeficiente 0.0035)
                    $precio_final_temp2 = $_GET["presupuesto_ml_lineas_ct"] * $coeficiente_presupuesto;

                    if ($precio_final_temp2 < $valor_tipo_9) {    //Si el resultado es menor a 173 se queda con 173 (tipo 9)
                        $precio_final_temp2 = $valor_tipo_9;
                    }
                    $precio_final_temp = $precio_final_temp2;
                }
                $preciofinal = $precio_final_temp;
                // echo ("<br> Precio final : " . $preciofinal);
            }
        } elseif ($tipoDocumentoProfesional == "Anexo") {

            //print("<br> Es anexo = ". $tipoAnexo);
            $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
            $stmt->bind_param('s', $tipoAnexo);
            $stmt->execute();

            $result = $stmt->get_result();

            $data = $result->fetch_all(MYSQLI_ASSOC);


            $preciofinal = $data[0]["Importe"];
            $tipo = $data[0]["Tipo_visado"];
        } elseif ($tipoDocumentoProfesional == "Memoria") {
            // echo ("Memoria seleccionado <br>");

            // print("<br> Es memoria = " . $tipoMemoria);
            $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
            $stmt->bind_param('s', $tipoMemoria);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);

            $preciofinal = $data[0]["Importe"];
            $tipo = $data[0]["Tipo_visado"];
            $coeficiente_reductor = null;
        } elseif ($tipoDocumentoProfesional == "Certificado") {
            //echo ("Certificado seleccionado <br>");
            //print("<br> Es certificado = " . $tipoCertificado);

            $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
            $stmt->bind_param('s', $tipoCertificado);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);

            $preciofinal = $data[0]["Importe"];
            $tipo = $data[0]["Tipo_visado"];
            $coeficiente_reductor = null;
        } elseif ($tipoDocumentoProfesional == "Registro") {

            $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
            $stmt->bind_param('s', $tipoDocumentoProfesional);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);

            $preciofinal = $data[0]["Importe"];
            $tipo = $data[0]["Tipo_visado"];
            $mostrarResultado = false;



            echo "
 

            <div id='div_invisible5'><br></div>
                <div class='div_registro' > 
                    <div><i class='fa-solid fa-circle-info fa-lg'></i>   </div>
                    <div>Mínimo por Registro de parciales de proyecto {$preciofinal} €</div>
                   
                     
                </div>   

                <div style='clear: both; display: block; height: 50px;'></div>

            ";
        } elseif ($tipoDocumentoProfesional == "Estudio") {

            // echo ("Estudio seleccionado <br>"  . $tipoDocumentoProfesional);

            // echo ("<br> Tipo estudio = " .  $tipoEstudio);


            if ($tipoEstudio == "Estudio_basico_seguridad_y_salud") {
                // echo ("<br>Entraa en estudio basico seguridad y salud <br>" . $tipoDocumentoProfesional);

                $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
                $stmt->bind_param('s', $tipoEstudio);
                $stmt->execute();

                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);

                $preciofinal = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
            }

            if ($tipoEstudio == "Estudio_seguridad_y_salud") {
                //Usar tabla 12
                $euros = 0;

                //Estudio basico seguridad y salud 
                $euros = $_GET["eur"];
                // echo ("<br> Euros: " . $euros);

                $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla12_Estudios_seguridad.Tipo FROM Tabla12_Estudios_seguridad, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla12_Estudios_seguridad.Tipo AND Tabla12_Estudios_seguridad.eur_minimo <= ? and Tabla12_Estudios_seguridad.eur_maximo >= ?;');
                $stmt->bind_param('ss', $euros, $euros);
                $stmt->execute();
                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);


                $preciofinal = $data[0]["Importe"];
                // echo ("<br>Precio final = ");
                // echo ($data[0]["Importe"]);
                $tipo = $data[0]["Tipo_visado"];

                if ($tipo == 0) {  //Si es mayor a 150000 euros
                    // echo ("<br> Es un tipo 0, SE TIENE QUE HACER EL calculo");

                    // --------------- Importe del tipo 6: ---------------
                    $stmt = $conexion->prepare('SELECT * FROM `Tabla1_Cuotas_tipo` WHERE `Tipo_visado` = 6;');

                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    $valor_tipo_6;
                    $valor_tipo_6 = $data[0]["Importe"];
                    // echo ($valor_tipo_6);

                    // --------------- Importe del tipo 4: ---------------
                    $stmt = $conexion->prepare('SELECT * FROM `Tabla1_Cuotas_tipo` WHERE `Tipo_visado` = 4;');
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $data = $result->fetch_all(MYSQLI_ASSOC);
                    $importe_por_cada_150000 = $data[0]["Importe"];
                    //   echo ("<br>Importe por cada 150000: <br></br>");
                    // echo ($importe_por_cada_150000);

                    $contador_anadir_150000 = 0;

                    $euros = $euros - 150000;
                    $contador_anadir_150000 = $contador_anadir_150000 + $valor_tipo_6; //Antes de entrar en el while se resta la cuota máxima, y al resto se le suma el importe del tipo 4
                    $vecesenbucle = 0;
                    while ($euros >= 1) { //Mientras siga teniendo valor se ira sumando por cada 150000€ la cuota correspondiente (tipo 4)
                        $contador_anadir_150000 = $contador_anadir_150000 + $importe_por_cada_150000;
                        $euros = $euros - 150000;
                        $vecesenbucle += 1;
                    }

                    $preciofinal = $contador_anadir_150000;

                    // $_SESSION['preciofinal'] = number_format($contador_anadir_150000, 2, ',', '.'); // Se redondea a dos decimales hacia arriba
                    // $_SESSION['tipo'] = $tipo;
                    // $_SESSION['coeficiente_reductor'] = $coeficiente_reductor;
                } else {
                    $_SESSION['preciofinal'] = number_format($preciofinal, 2, ',', '.'); // Se redondea a dos decimales hacia arriba
                    $_SESSION['tipo'] = $tipo;
                    $_SESSION['coeficiente_reductor'] = $coeficiente_reductor;
                }
            }



            if ($tipoEstudio == "Estudio_acustico") {
                // echo ("<br>Entraa en estudio acustico <br>" . $tipoDocumentoProfesional);

                $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
                $stmt->bind_param('s', $tipoEstudio);
                $stmt->execute();

                $result = $stmt->get_result();

                $data = $result->fetch_all(MYSQLI_ASSOC);

                $preciofinal = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
            }

            if ($tipoEstudio == "Estudio_de_detalle") {
                // echo ("<br>Entraa en estudio DETALLE <br>" . $tipoDocumentoProfesional);

                $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
                $stmt->bind_param('s', $tipoEstudio);
                $stmt->execute();

                $result = $stmt->get_result();

                $data = $result->fetch_all(MYSQLI_ASSOC);

                $preciofinal = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
            }

            if ($tipoEstudio == "Estudio_impacto_medioambiental") {

                $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
                $stmt->bind_param('s', $tipoEstudio);
                $stmt->execute();

                $result = $stmt->get_result();

                $data = $result->fetch_all(MYSQLI_ASSOC);

                $preciofinal = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
            }
        } else { //Si no es ninguno de los anteriores lo busca en la tabla de cuota fija

            if ($es_direccion_tecnica == true) {
                // echo ("Es direccion tecnica y no busca de la base de datos de nuevo ");
            } else {
                // echo ("<br> No es ninguno de los anteriores <br>" . $tipoDireccionTecnica);

                $stmt = $conexion->prepare('SELECT Tabla1_Cuotas_tipo.Tipo_visado, Tabla1_Cuotas_tipo.Importe, Tabla2_Trabajos_cuota_fija.Documento FROM Tabla2_Trabajos_cuota_fija, Tabla1_Cuotas_tipo WHERE Tabla1_Cuotas_tipo.Tipo_visado = Tabla2_Trabajos_cuota_fija.Tipo AND Tabla2_Trabajos_cuota_fija.Documento = ?;');
                $stmt->bind_param('s', $tipoDocumentoProfesional);
                $stmt->execute();

                $result = $stmt->get_result();
                $data = $result->fetch_all(MYSQLI_ASSOC);
                $preciofinal = $data[0]["Importe"];
                $tipo = $data[0]["Tipo_visado"];
            }
        }

        $coeficiente_reductor = "-";

        //APLICAR DIRECCIONES TECNICAS  (Si alguna esta a true se calcula teniendo en cuenta el porcentaje)

        // echo("<br> Dirección tecnica 050 = ".var_dump($direc_tec_050));
        // echo("<br> Dirección tecnica 070 = ".var_dump($direc_tec_070));
        // echo("<br> Dirección tecnica 100 = ".var_dump($direc_tec_100));

        if ($direc_tec_050 == true) {
            // echo ("<br> ---ANTES DE APLICA DIRECCION TECNICA 050 = " . number_format($preciofinal, 2, ',', '.'));
            $porcentaje = 50;
            $resultado1 = intval($preciofinal) * $porcentaje;
            $resultado1 = $resultado1 / 100;
            $preciofinal = $resultado1;
        }

        if ($direc_tec_070 == true) {
            // echo ("<br> ---ANTES DE APLICA DIRECCION TECNICA 070 = " . number_format($preciofinal, 2, ',', '.'));
            $porcentaje = 70;
            $resultado1 = intval($preciofinal) * $porcentaje;
            $resultado1 = $resultado1 / 100;
            $preciofinal = $resultado1;
        }

        if ($direc_tec_100 == true) {
            // echo ("<br> ---ANTES DE APLICA DIRECCION TECNICA 100 = " . number_format($preciofinal, 2, ',', '.'));
            $porcentaje = 100;
            $resultado1 = intval($preciofinal) * $porcentaje;
            $resultado1 = $resultado1 / 100;
            $preciofinal = $resultado1;
        }


        if ($preciofinal < 39.60) { //Si el precio final es menor que 39.69
            if ($direc_tec_100 == true || $direc_tec_070 == true  || $direc_tec_050 == true) {
                if ($tipoDireccionTecnica != "Direccion_tecnica_reforma_vehiculos") {
                    $preciofinal = 39.60;  //Si el precio es menor a 39.60 y es alguna direccion tecnica que no sea reforma vehiculos se queda con 39.60
                }
            }
        }


        //Aqui se guarda en la sesion despues del calculo para mostrarlo en la caja de resultados 
        $_SESSION['preciofinal'] = number_format($preciofinal, 2, ',', '.'); // Se redondea a dos decimales hacia arriba
        $_SESSION['tipo'] = $tipo;
        $_SESSION['coeficiente_reductor'] = $coeficiente_reductor;
    }
    /*

    if (in_array($tipoDocumentoProfesional, $array_options_free)) {
        $tipo = "-";
        $coeficiente_reductor = "-";
        $preciofinal = 0;

        echo ('<br>');
        $_SESSION['preciofinal'] = $preciofinal;
        echo ($_SESSION['preciofinal']);
        $_SESSION['tipo'] = $tipo;
        $_SESSION['coeficiente_reductor'] = $coeficiente_reductor;
        //session_write_close();
        //var_dump($_SESSION);
        $contador = 1;
    } elseif (in_array($tipoDocumentoProfesional, $array_options_6e)) {
        $preciofinal = 6;
        $tipo = "-";
        $coeficiente_reductor = "-";

        $_SESSION['preciofinal'] = $preciofinal;
        $_SESSION['tipo'] = $tipo;
        $_SESSION['coeficiente_reductor'] = $coeficiente_reductor;
        //session_write_close();
        //var_dump($_SESSION);

    } 
    
    */


    if (isset($_GET['submit'])) {  //Imprimir el div de resultados cuando se hace el submit de la página


        // <div class='div_1_resultado'>      
        //   <div class='div_resultado_calculo_casilla'>Coeficiente reductor:</div> 
        //   <div class='div_resultado_calculo_casilla  '>{$_SESSION['coeficiente_reductor']} </div>         
        // </div>

        if ($mostrarResultado == true) {
            echo "
            <br>
            <style>
             #div_resultado_calculo {
                visibility: hidden;
             }
            </style>
            <div class='div_resultado_calculo' id='div_resultado_calculo'  data-tilt data-tilt-scale='1.1'   data-tilt-glare data-tilt-max-glare='0.8'  data-shadow='true' > 

                <div class='div_1_resultado'>
                    <div class='div_resultado_calculo_casilla'>Total: </div> 
                    <div class='div_resultado_calculo_casilla  '> <b> {$_SESSION['preciofinal']} &#8364; </b> </div>  

                </div>

                
            </div>  
            
            <div id='div_invisible3'>
            <br> 
            </div>

            <script>
        
                // document.addEventListener('DOMContentLoaded', function(event) {

                var div_resultado_calculo = document.getElementById('div_resultado_calculo');
                div_resultado_calculo.style.display = 'flex';     

                div_resultado_calculo.classList.add('animate__animated');  // Añadir animaciones
                div_resultado_calculo.classList.add('animate__zoomIn'); 

                    // setTimeout(() => {
                    //     div_resultado_calculo.classList.remove('animate__zoomIn');  //Quitar animacion 
                    //   }, 1000); //al segundo para de animarlo

                        
                // })

            </script>
            <style>

             #div_resultado_calculo {
                visibility: initial;
             }
            </style>

            ";
        } else {
            // echo ("<br> no se muestra el resultado!!!");
            echo (" ");
        }

        // echo "
        //  <script>

        // function resizeIframe(obj) {
        //     //Declaring variables
        //     var newheight;
        //     var newwidth;
        //     if (document.getElementById) {
        //         //Calculating new height
        //         newheight = obj.contentWindow.document.body.scrollHeight;
        //         //Calculating new width
        //         newwidth = obj.contentWindow.document.body.scrollWidth;
        //     }
        //     //Assigning calculated height to iframe
        //     obj.height = (newheight) + 'px';
        //     //Assigning calculated width to iframe
        //     obj.width = (newwidth) + 'px';
        //   }


        // //   document.getElementById('div_lineas_BT');
        // //   resizeIframe(document.getelement)
        //   </script>


        // ";  
        //Se calcula de nuevo el tamaño del iframe

        $preciofinal = $tipo =  null;   //Se resetean las varibles despues de mostrarlas

        $direc_tec_050 = false;
        $direc_tec_070 = false;
        $direc_tec_100 = false;
        $mostrarResultado = true;
        $es_direccion_tecnica = false;
    }

    mysqli_close($conexion);
    ?>

 <script type='text/javascript' src='iframe_resizer_content_window.js'></script>


 <?php

    function isMobileDevice()
    {
        return preg_match(
            "/(android|avantgo|blackberry|bolt|boost|cricket|docomo
    |fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i",
            $_SERVER["HTTP_USER_AGENT"]
        );
    }

    if (isMobileDevice()) {   //Si es un  telefono se evita la carga del script del efecto tilt del div resultado.
        // echo "Mobile Browser Detected";
        echo " ";
    } else {  //Esto carga el efecto de tilt del div del resultado si se detecta que esta navegando en pc
        echo "<script type='text/javascript' src='vanilla-tilt.min.js'></script>";
    }




    ?>