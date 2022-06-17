<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Calculadora cuotas visado</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-6.1.1-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link rel="manifest" href="manifest.webmanifest">

    <!-- <link rel="stylesheet" href="package/css/font-awesome-animation.css"> -->

</head>

<body>
    <script type="text/javascript" src="jquery-3.6.0.js"></script>
    <script type="text/javascript" src="iframe-resizer/js/iframeResizer.min.js"></script>

    <div class="header">
        <div id="div_img_header"> <img src="logo.png" class="img_header"> </div>

        <div id="div_texto_calculadora_header">
            <p>Calculadora de cuotas de visado</p>
        </div>

        <div class="header_links">
            <a href="javascript: history.go(-1)" id="boton_volver_atras"> <i class="fa fa-angle-left fa-lg" id="icono_atras"></i> Volver </a>

        </div>
    </div>

    <script>
        // Scroll header
        var header = document.getElementsByClassName("header")[0];
        var img_header = document.getElementsByClassName("img_header")[0];
        const mediaQuery = window.matchMedia('(max-width: 650px)')

        var div_texto_calculadora_header = document.getElementById("div_texto_calculadora_header");

        function handleTabletChange(e) {
            if (e.matches) { // Comprueba si se aplica la media query
                // console.log('Media Query true!')
                mediaQuery.element.removeEventListener(handleTabletChange);

            } else {
                // console.log('Media Query false!');
                console.log('Media Query false!')


            }
        }

        //  mediaQuery.addEventListener(handleTabletChange);
        //  handleTabletChange(mediaQuery)


        window.addEventListener("scroll", function() {
            scrollFunction();
            });;

        function scrollFunction() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                header.style.height = "50px";
                img_header.style.width = "116px";
                img_header.style.height = "35px";
                div_texto_calculadora_header.style.display = "initial";
 
            } else {
                header.style.height = "100px";
                img_header.style.width = "233px";
                img_header.style.height = "70px";
                div_texto_calculadora_header.style.display = "none";

            }
        }
    </script>


    <div class="div_portada_calculadora">
        <div class="div_breadcrumbs element" id="portada_breadcrumbs">
            <p>Portada > Calculadora de cuota de visado</p>
        </div>
        <div class="div_title element2" id="portada_titulo">
            <p>Calculadora de cuota de visado</p>
        </div>
    </div>

    <!-- Parámetros calculo -->

    <div class="center">
        <form method="get" class="formulario" name="formulario_main" id="formulario_main" action="procesar_form.php" target="my_iframe">
            <div class="select-dropdown">

            </div>

            <div id="div_tipodocumento">

                <select onchange="obtener_opcion_seleccionada()" name="tipoDocumentoProfesional" class="center" id="select_tipo_documento">
                    <option value="Option0" disabled selected>Selecciona el tipo de Documento profesional</option>


                    <!-- Opciones que despliegan el desplegable -->
                    <option value="Proyecto">Proyecto</option>
                    <option value="Anexo">Anexo</option>
                    <option value="Memoria">Memoria</option>
                    <option value="Certificado">Certificado</option>
                    <option value="Registro">Registro</option>
                    <option value="Estudio">Estudio</option>
                    <option value="Direccion_tecnica">Direc. Técnica</option>

                    <!-- Devuelve el valor directamente -->
                    <option value="COPIA_D.T._OTRAS_ADMINISTRACIONES">Copia D.T. otras administraciones</option>
                    <option value="Designacion_coordinador_seguridad">Desiganción coordinador de seguridad</option>
                    <option value="Plano">Plano</option>
                    <option value="Separata">Separata</option>
                    <option value="Copias">Copias</option>
                    <option value="Libro_de_incidencias">Libro de incidencias / libro de ordenes</option>
                    <option value="Ficha_reducida_vehiculo">Ficha Red. vehículo</option>
                    <option value="Acta_de_aprobacion_plan_seguridad">Acta aprobación plan seguridad</option>
                    <option value="Auditoria_energetica">Auditoría energética</option>
                    <option value="C.E.Visado">C.E. Visado</option>
                    <option value="Declaración_tecnico_responsable">Declaración técnico responsable</option>
                    <option value="Dictamen_seguridad">Dictamen seguridad</option>
                    <option value="Plan_autoproteccion_<=1000m2">Plan de autoprotección <=1000 M2</option>
                    <option value="Plan_de_autoproteccion>1000m2">Plan de autoprotección >1000 M2</option>
                    <option value="Revision">Revisión</option>
                    <option value="Informes,tasaciones,valoraciones">Informes / tasaciones / valoraciones</option>

                </select>
            </div>

            <div id="div_nuevos_parametros">

                <select id="proyecto_opcion_seleccionada" name="tipoProyecto" onchange="obtener_opcion_seleccionada_proyecto()" class="center">
                    <option value="Option0" disabled selected hidden>¿Que tipo de proyecto quieres calcular?</option>

                    <option value="Proyecto_instalaciones_actividad">Proyecto instalaciones/actividad</option>
                    <option value="Proyecto_basico_Actuacion_Anteproyecto">Proyecto básico / actuación / anteproyecto</option>
                    <option value="Proyecto_construccion_nave">Construcción nave industrial / Legalizacion</option>
                    <option value="Proyecto_instalacion_BTIndustrial_Publica">Instalacion BT Industrial / Pública concurrencia / Comercial / Oficinas </option>
                    <option value="Proyecto_solo_calificacion_ambiental_actividad">Calificación ambiental solo actividad</option>
                    <option value="Proyecto_cuota_instalaciones_viviendas"> Instalaciones viviendas (BT, Fontanería, ACS, etc) </option>
                    <option value="Sustitucion_maquinaria">Sustitución maquinaria</option>
                    <option value="Proyecto_reforma_vehiculos">Reforma vehículo</option>
                    <option value="Proyectos_grua_por_grua">Proyecto de grúa</option>
                    <option value="Proyectos_cuota_piscina">Instalación piscina</option>
                    <option value="Proyecto_alumbrado_publico">Alumbrado público</option>
                    <option value="Proyecto_demolicion_desmantelamiento">Demolición / Desmantelamiento</option>
                    <option value="Cuota_puntos_recarga">Instalación puntos de recarga</option>
                    <option value="Cuota_garajes">Garajes</option>
                    <option value="Cuota_instalaciones_fotovoltaicas">Instalaciones fotovoltaicas generación</option>
                    <option value="Cuota_instalaciones_fotovoltaicas_autoconsumo">Instalaciones fotovoltaicas autoconsumo</option>
                    <option value="Cuota_instalacion_grupo_presion_electrogeno">Instalación grupo presión / Grupo electrógeno</option>
                    <option value="Cuota_depositos_ppl">Instalaciones depósitos P.P.L </option>
                    <option value="Cuota_depositos_GLP">Instalaciones depósitos G.L.P </option>
                    <option value="Cuota_redes_gas">Instalación redes gas / Redes BT</option>
                    <option value="Cuota_receptoras_gas">Instalaciones receptoras de gas</option>
                    <option value="Cuota_instalaciones_rite">Instalaciones RITE</option>
                    <option value="Cuota_instalaciones_renovacion_aire">Instalaciones renovación de aire</option>
                    <option value="Cuota_redessuministro_redesinfraestructura_redessaneamiento">Instalaciones redes de suministros de agua, infraestructura de telecomunicaciones y saneamiento</option>
                    <option value="Cuota_lineas_BT">Instalación líneas BT </option>
                    <option value="Cuota_lineas_AT">Instalación líneas AT </option>
                    <option value="Cuota_lineas_CT">Instalación líneas CT </option>


                </select>


                <!--
                        <select id="registro_opcion_seleccionada" name="tipoRegistro" class="center">
                            <option value="Option0" disabled selected hidden>¿Que tipo de registro quieres calcular?</option>

                            <option value="Registro">Registro</option>
                            <option value="Registro_calculos">Registro cálculos</option>
                            <option value="Registro_medicion_presupuesto">Registro medición presupuesto</option>
                            <option value="Registro_memoria">Registro memoria</option>
                            <option value="Registro_planos">Registro planos</option>
                            <option value="Registro_varios">Registro varios</option>
                            <option value="Registro_informe_pericial">Registro informe pericial</option>

                        </select> 
                -->

                <select id="certificado_opcion_seleccionada" name="tipoCertificado" class="center">
                    <option value="Option0" disabled selected hidden>¿Que tipo de certificado quieres calcular?</option>

                    <option value="Certificados_general">Certificados en general</option>
                    <option value="Certificados_medicion_acustica">Certificado medición ruidos</option>

                </select>

                <select id="anexo_opcion_seleccionada" name="tipoAnexo" class="center">
                    <option value="Option0" disabled selected hidden>¿Que tipo de anexo quieres calcular?</option>

                    <option value="Anexo_1">Anexo 1º</option>
                    <option value="Anexo_justificativo_reforma_vehiculos">Anexo justificativo reforma vehículo </option>
                    <option value="Anexo_justificativo(resto_proyectos)">Anexo justificativo (resto proyectos) </option>
                    <option value="Anexo_mas_valor">Anexo masvalor</option>
                    <option value="Otros_anexos">Otros anexos</option>

                </select>

                <select id="estudio_opcion_seleccionada" name="tipoEstudio" class="center" onchange="obtener_opcion_seleccionada_estudio()">
                    <option value="Option0" disabled selected hidden>¿Que tipo de estudio calcular?</option>
                    <option value="Estudio_acustico">Estudio acústico</option>
                    <option value="Estudio_basico_seguridad_y_salud">Estudio básico de seguridad y salud</option>
                    <option value="Estudio_seguridad_y_salud">Estudio de seguridad y salud</option>

                    <option value="Estudio_de_detalle">Estudio de detalle</option>
                    <option value="Estudio_impacto_medioambiental">Estudio de impacto medioambiental</option>

                </select>

                <select id="memoria_opcion_seleccionada" name="tipoMemoria" class="center">
                    <option value="Option0" disabled selected hidden>¿Que tipo de memoria calcular?</option>

                    <option value="Memoria_tecnica">Memoria técnica</option>
                    <option value="Memoria_valorada(incorpora_presupuesto)">Memoria valorada (incorpora presupuesto)</option>
                </select>
                <select id="direccion_tecnica_seleccionada" name="tipoDireccionTecnica" onchange="obtener_opcion_seleccionada_direccion_tecnica()" class="center">
                    <option value="Option0" disabled selected hidden>¿Que tipo de dirección técnica quieres calcular</option>
                    <option value="Direccion_tecnica_050">050 Dirección técnica</option>
                    <option value="Direccion_tecnica_070">070 Dirección técnica</option>
                    <option value="Direccion_tecnica_100">100 Dirección técnica</option>
                    <!-- Devuelve valores fijos -->
                    <option value="Direc.Tec.Grua">Direc. Tec. grúa</option>
                    <option value="Direccion_tecnica_reforma_vehiculos">Direc. Téc. Ref. vehículo</option>
                </select>

            </div>

            <!-- checkboxes -->

            <div id="div_proyecto_construccion_nave">

                <!--Superficie construida -->
                <div id="superficie_construida_parametro">
                    <label for="parametro_superficie" id="parametro_superficie_label"><b>1. </b> Indica la superficie contruida en m2</label>
                    <input autocomplete="off" type="number" inputmode="numeric" name="parametro_superficie" id="parametro_superficie_m2construidos_id" min="0">
                    <br>
                </div>



                <div id="div_parametro_presupuesto">
                    <label for="parametro_presupuesto" id="parametro_presupuesto"><b>2. </b> Indica el presupuesto</label>
                    <input autocomplete="off" type="number" inputmode="numeric" name="parametro_presupuesto" min="0">
                </div>



                <div id="parte_Adosada_parrametro">
                    <!--Parte adosada sin cerramientos -->
                    <label for="parte_adosada_sin_cerramientos"> <b>2. </b> Se proyecta alguna parte adosada sin cerramientos (marquesina)</label>
                    <label class="check">
                        <input autocomplete="off" autocomplete="off" type="checkbox" id="parte_adosada_sin_cerramientos" name="parte_adosada_sin_cerramientos" value="parte_adosada_sin_cerramientos" />
                        <div class="box"></div>
                    </label>
                    </label>
                </div>



                <!-- M2 parte adosada sin cerramientos -->
                <div id="div_parte_adosada_sin_cerramientos_M2">
                    <label for="parte_adosada_sin_cerramientos_M2"> - Indica los m2 de la parte adosada</label>
                    <input autocomplete="off" type="number" inputmode="numeric" name="parte_adosada_sin_cerramientos_M2" id="parte_adosada_sin_cerramientos_M2" min="0">
                </div>



                <!-- ¿Se requiere demoler otra edificación ya existente? -->

                <div id="demoler_otra_edificacion_parametro">
                    <label for="demoler_ya_existente"> <b>3. </b> Se requiere demoler otra edificación ya existente</label>
                    <label class="check">
                        <input autocomplete="off" type="checkbox" id="demoler_ya_existente" name="demoler_ya_existente" value="demoler_ya_existente" />
                        <div class="box"></div>
                    </label>
                    </label>

                </div>

                <!-- Se pide el parámetro m3 de residuos sólidos obtenidos -->
                <div id="div_m3_residuos_solidos">
                    <label for="m3_residuos_solidos"> - Indica los m3 de residuos solidos</label>
                    <input autocomplete="off" type="number" inputmode="numeric" name="m3_residuos_solidos" id="m3_residuos_solidos" min="0">
                </div>


                <!--Se disponen de documentos profesionales -->
                <!-- <label for="documentos_profesionales"><b>4. </b>¿Se dispone de documentos profesionales?</label>
                <label class="check">
                    <input autocomplete="off"type="checkbox" id="documentos_profesionales" value="documentos_profesionales" />
                    <div class="box"></div>
                </label>
                </label> -->

                <!-- Se pide el documento profesional -->
                <!--

                     <div id="div_documentos_profesionales">
                        <label for="documentos_profesionales_datos"></label>
                        <input autocomplete="off"type="checkbox" id=" " value=" " />
                    </div> 
            
                -->

            </div>

            <div id="div_alumbrado_publico">

                <label for="pts_alumbrado">
                    <b>1.</b> Indica los puntos
                    <input autocomplete="off" type="number" inputmode="numeric" name="pts_alumbrado" id="parametro_superficie__ptsalumbrado_id" min="0">
                    <br>
                </label>

            </div>

            <div id="div_alumbrado_publico2">
                <!--

                <label for="demoler_ya_existente"> <b>4. </b> Se requiere demoler otra edificación ya existente</label>
                <label class="check">
                    <input autocomplete="off"type="checkbox" id="demoler_ya_existente" name="demoler_ya_existente" value="demoler_ya_existente" />
                
                -->

                <label for="alumbrado_sustitucion" id="alumbrado_sustitucion_label"> <b>2. </b> Es un proyecto de sustitución </label>
                <label class="check" id="alumbrado_sustitucion_checkbox">
                    <input autocomplete="off" type="checkbox" id="alumbrado_sustitucion" name="alumbrado_sustitucion" value="alumbrado_sustitucion" />
                    <div class="box"></div>
                </label>
                </label>
            </div>


            <div id="div_cuota_puntos_recarga">
                <div>
                    <label for="kw_potencia_puntos_recarga">
                        <b> 1. </b> Indica los kw de potencia &nbsp; <input autocomplete="off" type="number" inputmode="numeric" name="kw_potencia_puntos_recarga" id="input_kw_potencia_puntos_recarga" min="0">
                    </label>
                </div>

                <div>
                    <label for="kw_potencia_puntos_recarga">
                        <b> 2. </b> Indica el presupuesto &nbsp; <input autocomplete="off" type="number" inputmode="numeric" name="kw_potencia_presupuesto" id="input_kw_potencia_presupuesto" min="0">
                    </label>
                </div>

            </div>

            <div id="cuota_piscinas">
                <label for="piscina_kw"> 1. Indica los kw de la depuradora</label>
                <input autocomplete="off" type="number" inputmode="numeric" name="piscina_kw" id="piscina_kw" min="0">
            </div>


            <div id="div_parametro_estudio_segysalud">
                <label for="eur"> <b>1. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="eur" id="presupuesto_estudio_segysalud" min="0"></label>
            </div>


            <div id="div_cuota_garaje">
                <label for="m2_cuota_garaje"> <b>1. </b>
                    Indica los m2 construidos <input autocomplete="off" type="number" inputmode="numeric" name="m2_cuota_garaje" id="m2_cuota_garaje" min="0"></label>

                <label for="presupuesto_m2_cuota_garaje"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_m2_cuota_garaje" id="presupuesto_m2_cuota_garaje" min="0"></label>

            </div>


            <div id="div_cantidad_gruas">
                <label for="cantidad_gruas"> <b>1. </b>
                    Indica la cantidad de grúas <input autocomplete="off" type="number" inputmode="numeric" name="cantidad_gruas" id="cantidad_gruas" min="0"></label>


            </div>

            <div id="div_cuota_instalaciones_fotovoltaicas">
                <label for="kw_fotovol"> <b>1. </b>
                    Indica la potencia en kw <input autocomplete="off" type="number" inputmode="numeric" name="kw_fotovol" id="kw_fotovol" min="0"></label>

                <label for="presupuesto_kw_fotovol"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_kw_fotovol" id="presupuesto_kw_fotovol" min="0"></label>

            </div>

            <div id="div_cuota_instalaciones_fotovoltaicas_autoconsumo">
                <label for="kw_fotovol_autoc"> <b>1. </b>
                    Indica la potencia en kw <input autocomplete="off" type="number" inputmode="numeric" name="kw_fotovol_autoc" id="kw_fotovol_autoc" min="0"></label>

                <label for="presupuesto_fotovol_autoc"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_fotovol_autoc" id="presupuesto_fotovol_autoc" min="0"></label>

            </div>

            <div id="div_cuota_instalacione_grupo_presion_electrogeno">
                <label for="kva_grupo_pree"> <b>1. </b>
                    Indica la potencia instalada en Kva/cv &nbsp; <input autocomplete="off" type="number" inputmode="numeric" name="kva_grupo_pree" id="kva_grupo_pree" min="0"></label>


                <label for="presupuesto_kva_grupo_pree"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_kva_grupo_pree" id="presupuesto_kva_grupo_pree" min="0"></label>

            </div>





            <div id="div_cuota_depositos_ppl">
                <label for="l_deposito_ppl"> <b>1. </b>
                    Indica los litros <input autocomplete="off" type="number" inputmode="numeric" name="l_deposito_ppl" id="l_deposito_ppl" min="0"></label>

                <label for="presupuesto_l_deposito_ppl"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_l_deposito_ppl" id="presupuesto_l_deposito_ppl" min="0"></label>

            </div>



            <div id="div_cuota_depositos_GLP">
                <label for="l_deposito_GLP"> <b>1. </b>
                    Indica los litros <input autocomplete="off" type="number" inputmode="numeric" name="l_deposito_GLP" id="l_deposito_GLP" min="0"></label>

                <label for="presupuesto_l_deposito_GLP"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_l_deposito_GLP" id="presupuesto_l_deposito_GLP" min="0"></label>

            </div>


            <div id="div_cuota_redes_gas">
                <label for="met_lin_redes_gas"> <b>1. </b>
                    Indica los metros lineales de la red <input autocomplete="off" type="number" inputmode="numeric" name="met_lin_redes_gas" id="met_lin_redes_gas" min="0"></label>

                <label for="presupuesto_met_lin_redes_gas"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_met_lin_redes_gas" id="presupuesto_met_lin_redes_gas" min="0"></label>

            </div>



            <div id="div_proyecto_instalacion_bt_industrial_publica">
                <label for="kw_instalacion_bt_industrial"> <b>1. </b>
                    Indica los kw <input autocomplete="off" type="number" inputmode="numeric" name="kw_instalacion_bt_industrial" id="kw_instalacion_bt_industrial" min="0"></label>

                <label for="presupuesto_kw_instalacion_bt_industrial"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_kw_instalacion_bt_industrial" id="presupuesto_kw_instalacion_bt_industrial" min="0"></label>

            </div>


            <div id="div_proyecto_solo_calificacion_ambiental">
                <label for="met_s_calificacion_ambiental"> <b>1. </b>
                    Indica los m2 <input autocomplete="off" type="number" inputmode="numeric" name="met_s_calificacion_ambiental" id="met_s_calificacion_ambiental" min="0"></label>

                <label for="presupuesto_met_s_calificacion_ambiental"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_met_s_calificacion_ambiental" id="presupuesto_met_s_calificacion_ambiental" min="0"></label>

            </div>


            <div id="div_proyecto_instalaciones_viviendas">
                <label for="met_p_instalaciones_viviendas"> <b>1. </b>
                    Indica el número de viviendas <input autocomplete="off" type="number" inputmode="numeric" name="met_p_instalaciones_viviendas" id="met_p_instalaciones_viviendas" min="0"></label>

                <label for="presupuesto_met_p_instalaciones_viviendas"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_met_p_instalaciones_viviendas" id="presupuesto_met_p_instalaciones_viviendas" min="0"></label>

            </div>


            <div id="div_cuota_receptoras_gas">
                <label for="cuota_receptoras_gas_kw"> <b>1. </b>
                    Indica los kw de la potencia receptora <input autocomplete="off" type="number" inputmode="numeric" name="cuota_receptoras_gas_kw" id="cuota_receptoras_gas_kw" min="0"></label>

                <label for="Presupuesto_cuota_receptoras_gas_kw"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="Presupuesto_cuota_receptoras_gas_kw" id="Presupuesto_cuota_receptoras_gas_kw" min="0"></label>
            </div>


            <div id="div_cuota_instalaciones_rite">
                <label for="cuota_instalaciones_rite_kw"> <b>1. </b>
                    Indica los kw de potencia del generador o quemador <input autocomplete="off" type="number" inputmode="numeric" name="cuota_instalaciones_rite_kw" id="cuota_instalaciones_rite_kw" min="0"></label>

                <label for="Presupuesto_cuota_instalaciones_rite_kw"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="Presupuesto_cuota_instalaciones_rite_kw" id="Presupuesto_cuota_instalaciones_rite_kw" min="0"></label>

            </div>


            <div id="div_cuota_instalaciones_renovacion_aire">
                <label for="cuota_instalaciones_renovacion_aire"> <b>1. </b>
                    Indica los m3/h <input autocomplete="off" type="number" inputmode="numeric" name="cuota_instalaciones_renovacion_aire" id="cuota_instalaciones_renovacion_aire" min="0"></label>

                <label for="Presupuesto_cuota_instalaciones_renovacion_aire"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="Presupuesto_cuota_instalaciones_renovacion_aire" id="Presupuesto_cuota_instalaciones_renovacion_aire" min="0"></label>

            </div>


            <div id="div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento">
                <label for="cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento"> <b>1. </b>
                    Indica ml de la red <input autocomplete="off" type="number" inputmode="numeric" name="cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento" id="cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento" min="0"></label>

                <label for="Presupuesto_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="Presupuesto_cuota_instalaciones_renovacion_aire" id="Presupuesto_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento" min="0"></label>

            </div>

            <div id="div_proyecto_desmantelamiento">
                <label for="m3_proyecto_desmantelamiento"> <b>1.</b> Indica los m3 de residuos solidos</label>
                <input autocomplete="off" type="number" inputmode="numeric" name="m3_proyecto_desmantelamiento" id="m3_proyecto_desmantelamiento" min="0">

            </div>



            <div id="div_lineas_BT">
                <label for="ml_lineas_bt"> <b>1. </b>
                    Indica los metros lineales <input autocomplete="off" type="number" inputmode="numeric" name="ml_lineas_bt" id="ml_lineas_bt" min="0"></label>

                <label for="presupuesto_ml_lineas_bt"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_ml_lineas_bt" id="presupuesto_ml_lineas_bt" min="0"></label>

            </div>

            <div id="div_lineas_AT">
                <label for="ml_lineas_at"> <b>1. </b>
                    Indica los metros lineales <input autocomplete="off" type="number" inputmode="numeric" name="ml_lineas_at" id="ml_lineas_at" min="0"></label>

                <label for="presupuesto_ml_lineas_at"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_ml_lineas_at" id="presupuesto_ml_lineas_at" min="0"></label>

            </div>

            <div id="div_lineas_CT">
                <label for="ml_lineas_ct"> <b>1. </b>
                    Indica los kva <input autocomplete="off" type="number" inputmode="numeric" name="ml_lineas_ct" id="ml_lineas_ct" min="0"></label>

                <label for="presupuesto_ml_lineas_ct"> <b>2. </b> Indica el presupuesto <input autocomplete="off" type="number" inputmode="numeric" name="presupuesto_ml_lineas_ct" id="presupuesto_ml_lineas_ct" min="0"></label>

            </div>


            <div id="div_proyecto_instalaciones_actividad">
                <div class="div_proyecto_instalaciones_actividad_div1">
                    <label for="m2_proyecto_instalaciones_actividad"> <b> 1. </b> Indica los m2</label>
                    <input autocomplete="off" type="number" inputmode="numeric" name="m2_proyecto_instalaciones_actividad" id="m2_proyecto_instalaciones_actividad" min="0">
                </div>

                <div class="div_proyecto_instalaciones_actividad_div1">
                    <label for="m2_proyecto_instalaciones_actividad_presupuesto"> <b> 2. </b> Indica el presupuesto</label>
                    <input autocomplete="off" type="number" inputmode="numeric" name="m2_proyecto_instalaciones_actividad_presupuesto" id="m2_proyecto_instalaciones_actividad_presupuesto" min="0">
                </div>
            </div>

            <!-- <script>
                function mostrar_pantalla_carga() { //Cuando carga el iframe se llama a esta funcion
                    pantalla_carga.classList.removeClass("hide");

                }
            </script> -->

            <!-- Botones calcular y nuevo calculo -->
            <div class="inputbox radio faa-parent animated-hover ">
                <button type="submit" name="submit" class="btn btn-success" id="boton_calcular" value='submit'>
                    <i class="fa-solid fa-calculator" id="boton_calcular_hover"></i> &nbsp; Calcular
                </button>
            </div>

            <div class="inputbox radio" id="boton_nuevo_calculo">
                <button type="button" name="submit" class="btn btn-success" id="boton_submit" onclick="nuevocalculo()" value=" ">
                    <i class="fa-solid fa-arrows-rotate" id="boton_nuevo_calculo_hover"></i> &nbsp; Nuevo cálculo
                </button>
            </div>
    </div>


    </form>




    <div class='div_error_iframe DISPLAY_NONE' id="div_error_iframe">
        <i class="fa-solid fa-circle-exclamation"></i>
        <p> Error </p>
    </div>




    <div id="loading_screen">
        <i class="fa-solid fa-rotate fa-spin fa-2xl"></i>
    </div>

    <div id="loading_screen2" class="hide">
        <!-- <i class="fa-solid fa-rotate fa-spin fa-2xl"></i> -->
        <i class="fa-solid fa-spinner fa-spin fa-2xl"></i>
    </div>


    <script>
        function hide_loadingscreen2() { //(Esta funcion oculta la pantalla de carga y )
            $('#loading_screen2').addClass('hide');
            $('#div_error_iframe').addClass('DISPLAY_NONE');



        };
    </script>
    <!-- iframe -->

    <iframe name="my_iframe" id="my_iframe" frameborder="0" border="0" cellspacing="0" scrolling="no" style="border-style: none; width: 100%; height: auto;">
    </iframe>

    <div id="div_invisible"></div>


    <!-- css iframe -->

    <style>
        iframe {
            width: 100%;
            min-width: 100%;
            border-style: none;
            height: auto;
            border: 0px;
            margin-bottom: 30px;
        }
    </style>

    <!-- js iframe -->

    <script>
        var iframe = document.getElementById("my_iframe");

        iFrameResize({
            checkOrigin: false,
            log: false,
            sizeHeight: true,
            scrolling: false,
            enablePublicMethods: true,
            heightCalculationMethod: 'max',
            warningTimeout: 1000
        })
    </script>

    <footer>
        <div class="parent_grid_footer">
            <div class="div1_grid_footer">
                <div> 
                <p> © 2022 COGITI Granada - Calculadora creada por Manuel Matas Galeote  </p>  
                </div>

                
                <span class="div1_grid_footer_enlace_documentos"> <a href="PDFs/documentacion-visado-trabajos.pdf"> &nbsp / &nbsp Ver Documentos</a> </span>
                 
            </div>

            <div class="div2_grid_footer">
                <!-- div2 -->
                <a href="PDFs/documentacion-visado-trabajos.pdf">Documentos&nbsp;/&nbsp;</a>

                <a href="https://cogitigranada.com/el-colegio/">El Colegio&nbsp;/&nbsp;</a>
                <a href="https://cogitigranada.com/">Anuncios&nbsp;/&nbsp;</a>
                <a href="https://cogitigranada.com/aviso-legal-y-condiciones-de-uso/">Aviso legal&nbsp;/&nbsp;</a>
                <a href="https://cogitigranada.com/politica-de-privacidad-y-uso-de-cookies/">Privacidad y cookies&nbsp;/&nbsp;</a>
                <a href="https://cogitigranada.com/contactar/">Contactar</a>

            </div>

        </div>
    </footer>

    <script type="text/javascript" src="javascript.js"></script>
    <!-- <script type="text/javascript" src="vanilla-tilt.min.js"></script> -->

    <script>
        document.addEventListener('DOMContentLoaded', function(event) {
            var pantalla_carga = document.getElementById("loading_screen");
            var portada_breadcrumbs = document.getElementById("portada_breadcrumbs")

            var portada_titulo = document.getElementById("portada_titulo");

            // var div_resultado_calculo = document.getElementById('div_resultado_calculo');
            // div_resultado_calculo.style.display = 'flex';  

            // div_resultado_calculo.classList.add('animate__animated');  // Añadir animaciones  
            // div_resultado_calculo.classList.add('animate__zoomIn'); 

            portada_breadcrumbs.classList.add("hide");
            portada_titulo.classList.add("hide");

            setTimeout(function() {

                portada_breadcrumbs.classList.remove("hide");
                portada_titulo.classList.remove("hide");
                //Se ejecuta al medio segundo
                pantalla_carga.classList.add("hide");

                portada_breadcrumbs.classList.add('animate__animated'); // Añadir animaciones
                portada_titulo.classList.add('animate__animated'); // Añadir animaciones

                portada_breadcrumbs.classList.add('animate__lightSpeedInLeft');
                portada_titulo.classList.add('animate__lightSpeedInLeft');


            }, 600);






            // pantalla_carga.style.display("none");

        })
    </script>


</body>

</html>