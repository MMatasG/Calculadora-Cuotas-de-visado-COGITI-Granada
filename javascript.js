var iframe = document.getElementById("my_iframe");
var div_nuevosparametros = document.getElementById("div_nuevos_parametros");
var div_parte_adosada_sin_cerramientos_M2 = document.getElementById("div_parte_adosada_sin_cerramientos_M2");
var div_m3_residuos_solidos = document.getElementById("div_m3_residuos_solidos");
var div_documentos_profesionales = document.getElementById("div_documentos_profesionales");
var div_parametro_pts = document.getElementById("div_pts_alumbrado");
var input_m2parteadosada = document.getElementById("parte_adosada_sin_cerramientos_M2");
var input_m3residuosolido = document.getElementById("m3_residuos_solidos");
var div_cuota_piscina = document.getElementById("cuota_piscinas");
var boton_calcular = document.getElementById("boton_calcular");
var div_proyecto_construccion_nave = document.getElementById("div_proyecto_construccion_nave");
var div_parametro_presupuesto = document.getElementById("div_parametro_presupuesto");
var div_alumbrado_publico = document.getElementById("div_alumbrado_publico");
var div_alumbrado_publico2 = document.getElementById("div_alumbrado_publico2");
var div_cuota_garaje = document.getElementById("div_cuota_garaje");
var div_cuota_instalaciones_fotovoltaicas = document.getElementById("div_cuota_instalaciones_fotovoltaicas");
var div_cuota_instalaciones_fotovoltaicas_autoconsumo = document.getElementById("div_cuota_instalaciones_fotovoltaicas_autoconsumo");
var div_cuota_instalacione_grupo_presion_electrogeno = document.getElementById("div_cuota_instalacione_grupo_presion_electrogeno");
var div_cuota_depositos_ppl = document.getElementById("div_cuota_depositos_ppl");
var div_cuota_depositos_GLP = document.getElementById("div_cuota_depositos_GLP");
var div_cuota_redes_gas = document.getElementById("div_cuota_redes_gas");
var div_proyecto_instalacion_bt_industrial_publica = document.getElementById("div_proyecto_instalacion_bt_industrial_publica");
var div_proyecto_solo_calificacion_ambiental = document.getElementById("div_proyecto_solo_calificacion_ambiental");
var div_proyecto_instalaciones_viviendas = document.getElementById("div_proyecto_instalaciones_viviendas");
var div_cuota_receptoras_gas = document.getElementById("div_cuota_receptoras_gas");
var div_cuota_instalaciones_rite = document.getElementById("div_cuota_instalaciones_rite");
var div_cuota_instalaciones_renovacion_aire = document.getElementById("div_cuota_instalaciones_renovacion_aire");
var div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento = document.getElementById("div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento");
var div_proyecto_desmantelamiento = document.getElementById("div_proyecto_desmantelamiento");
var div_cuota_puntos_recarga = document.getElementById("div_cuota_puntos_recarga");
var cuota_piscinas = document.getElementById("cuota_piscinas");
var div_proyecto_instalaciones_actividad = document.getElementById("div_proyecto_instalaciones_actividad");
var div_cantidad_gruas = document.getElementById("div_cantidad_gruas");
var div_lineas_BT = document.getElementById("div_lineas_BT");
var div_lineas_AT = document.getElementById("div_lineas_AT");
var div_lineas_CT = document.getElementById("div_lineas_CT");
var proyecto_opcion_seleccionada = document.getElementById("proyecto_opcion_seleccionada");
var certificado_opcion_seleccionada = document.getElementById("certificado_opcion_seleccionada");
var anexo_opcion_seleccionada = document.getElementById("anexo_opcion_seleccionada");
var memoria_opcion_seleccionada = document.getElementById("memoria_opcion_seleccionada");
var estudio_opcion_seleccionada = document.getElementById("estudio_opcion_seleccionada");
var direccion_tecnica_seleccionada = document.getElementById("direccion_tecnica_seleccionada");
var div_parametro_estudio_segysalud = document.getElementById("div_parametro_estudio_segysalud");



function smoothScroll() {
  d = document.getElementById("proyecto_opcion_seleccionada").value;


  //Si es alguno de estos no se hace el scroll
  if (d == "Proyecto_basico_Actuacion_Anteproyecto") {
    return;
  }
  if (d == "Sustitucion_maquinaria") {
    return;
  }


  setTimeout(function () {
    document.getElementById('div_invisible').scrollIntoView({  //Hace scroll al div invisible que hay ocupando el esapacio del iframe
      behavior: 'smooth'
    });
  }, 600);

}



// var label_eur = document.getElementById("label_eur");
//  var label_alumbrado_sustitucion = document.getElementById("label_alumbrado_sustitucion");

function nuevocalculo() {
  document.getElementById('formulario_main').reset();
  window.location = window.location.href;

}



//Tamaño iframe automatico
// function resizeIframe() {
//   iframe.style.height = iframe.contentWindow.document.documentElement.scrollHeight + 'px';
// }

// function resizeIframe(obj) {
//    var newheight;
//   var newwidth;
//   if (document.getElementById) {
//        newheight = obj.contentWindow.document.body.scrollHeight;
//        newwidth = obj.contentWindow.document.body.scrollWidth;
//   }
//    obj.height = (newheight) + "px";
//    obj.width = (newwidth) + "px";
// }

// document.addEventListener("DOMContentLoaded", function (event) {   //Para que al pulsar nuevo calculo mantenga la posicion
//   var scrollpos = localStorage.getItem('scrollpos');
//   if (scrollpos) document.getElementsByClassName('center')[0].scrollIntoView();
// });

boton_calcular.setAttribute("disabled", "disabled");





function obtener_opcion_seleccionada() {
  /* boton_calcular.disabled= false; */
  d = document.getElementById("select_tipo_documento").value;

  if (d != "Option0") {
    boton_calcular.removeAttribute("disabled");

  }

  if (d == "Option0") {
    boton_calcular.setAttribute("disabled", "disabled");

  }


  // console.log(d);
  if (d != "Proyecto") {
    //Si no es proyecto se ocultan todos los divs de proyecto

    div_alumbrado_publico.style.display = "none";
    div_alumbrado_publico2.style.display = "none";
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_cantidad_gruas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";

  }

  // if (d != "Certificado") {

  // }

  // if (d != "Anexo") {

  // }

  // if (d != "Estudio") {

  // }



  if (d == "Proyecto") {
    proyecto_opcion_seleccionada.style.display = "initial";
    /*Para ocultar los demas */
    //registro_opcion_seleccionada.style.display = "none";
    certificado_opcion_seleccionada.style.display = "none";
    anexo_opcion_seleccionada.style.display = "none";
    estudio_opcion_seleccionada.style.display = "none";
    memoria_opcion_seleccionada.style.display = "none";

    // boton_calcular.setAttribute("disabled", "disabled");


  } else if (d == "Certificado") {
    certificado_opcion_seleccionada.style.display = "initial";

    /*Para ocultar los demas */
    proyecto_opcion_seleccionada.style.display = "none";
    //registro_opcion_seleccionada.style.display = "none";
    anexo_opcion_seleccionada.style.display = "none";
    estudio_opcion_seleccionada.style.display = "none";
    memoria_opcion_seleccionada.style.display = "none";


  } else if (d == "Anexo") {
    anexo_opcion_seleccionada.style.display = "initial";

    /*Para ocultar los demas */
    proyecto_opcion_seleccionada.style.display = "none";
    //registro_opcion_seleccionada.style.display = "none";
    certificado_opcion_seleccionada.style.display = "none";
    estudio_opcion_seleccionada.style.display = "none";
    memoria_opcion_seleccionada.style.display = "none";

  }

  else if (d == "Estudio") {
    estudio_opcion_seleccionada.style.display = "initial";

    /*Para ocultar los demas */
    proyecto_opcion_seleccionada.style.display = "none";
    /* registro_opcion_seleccionada.style.display = "none"; */
    certificado_opcion_seleccionada.style.display = "none";
    anexo_opcion_seleccionada.style.display = "none";
    memoria_opcion_seleccionada.style.display = "none";

  }

  else if (d == "Memoria") {
    memoria_opcion_seleccionada.style.display = "initial";

    /*Para ocultar los demas */
    proyecto_opcion_seleccionada.style.display = "none";
    //registro_opcion_seleccionada.style.display = "none";
    certificado_opcion_seleccionada.style.display = "none";
    anexo_opcion_seleccionada.style.display = "none";
    estudio_opcion_seleccionada.style.display = "none";
    /* memoria_opcion_seleccionada.style.display = "none"; */

  }


  else if (d == "Direccion_tecnica") {
    direccion_tecnica_seleccionada.style.display = "initial"

    /*Para ocultar las demas */
    memoria_opcion_seleccionada.style.display = "none";
    proyecto_opcion_seleccionada.style.display = "none";
    //registro_opcion_seleccionada.style.display = "none";
    certificado_opcion_seleccionada.style.display = "none";
    anexo_opcion_seleccionada.style.display = "none";
    estudio_opcion_seleccionada.style.display = "none";
  }

  if (d != "Direccion_tecnica") {
    direccion_tecnica_seleccionada.style.display = "none";
  }

  if (d != "Proyecto") {
    proyecto_opcion_seleccionada.style.display = "none";
  }

  if (d != "Estudio") {
    estudio_opcion_seleccionada.style.display = "none";
  }

  if (d != "Memoria") {
    memoria_opcion_seleccionada.style.display = "none";
  }

  if (d != "Certificado") {
    certificado_opcion_seleccionada.style.display = "none";
  }

  if (d != "Anexo") {
    anexo_opcion_seleccionada.style.display = "none";
  }


  // else {  /*  Oculta los  demas si no se selecciona ninguno de los anteriores*/
  //   memoria_opcion_seleccionada.style.display = "none";
  //   proyecto_opcion_seleccionada.style.display = "none";
  //   certificado_opcion_seleccionada.style.display = "none";
  //   anexo_opcion_seleccionada.style.display = "none";
  //   estudio_opcion_seleccionada.style.display = "none";

  // }

}




// var div_parametro_presupuesto = document.getElementById("div_parametro_presupuesto");

// function updateValue(e) {  //Funcion correcta
//   if (e.target.value > 5000) {
//     div_parametro_presupuesto.style.display = "flex";
//     console.log(e.target.value);

//   }
// }

function obtener_opcion_seleccionada_proyecto() {
  d = document.getElementById("proyecto_opcion_seleccionada").value;


  if (d == "Proyecto_construccion_nave") {
    div_proyecto_construccion_nave.style.display = "flex";
    div_parametro_presupuesto.style.display = "flex";

    document.getElementById("parametro_superficie_m2construidos_id").setAttribute("required", "");  //Hacer parametro requerido

    //------------------------------   Ocultar los demas   ------------------------------

    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }


  if (d != "Proyecto_construccion_nave") {
    document.getElementById("parametro_superficie_m2construidos_id").removeAttribute('required');    //Hacer parametro no requerido

  }





  if (d == "Proyecto_instalaciones_actividad") {

    div_proyecto_instalaciones_actividad.style.display = "flex";

    document.getElementById("m2_proyecto_instalaciones_actividad").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("m2_proyecto_instalaciones_actividad_presupuesto").setAttribute("required", "");  //Hacer parametro requerido

    div_alumbrado_publico.style.display = "none";
    div_alumbrado_publico2.style.display = "none";
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";

  }

  if (d != "Proyecto_instalaciones_actividad") {
    div_proyecto_instalaciones_actividad.style.display = "none";

    document.getElementById("m2_proyecto_instalaciones_actividad").removeAttribute("required"); //Hacer parametro no requerido
    document.getElementById("m2_proyecto_instalaciones_actividad_presupuesto").removeAttribute("required");


  }



  if (d == "Proyecto_basico_Actuacion_Anteproyecto") {
    div_alumbrado_publico.style.display = "none";
    div_alumbrado_publico2.style.display = "none";
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }


  if (d == "Proyecto_alumbrado_publico") {
    div_alumbrado_publico.style.display = "flex";
    div_alumbrado_publico2.style.display = "flex";

    document.getElementById("parametro_superficie__ptsalumbrado_id").setAttribute("required", "");  //Hacer parametro requerido



    //------------------------------   Ocultar los demas   ------------------------------

    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";

    div_cantidad_gruas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";




  }

  if (d != "Proyecto_alumbrado_publico") {
    document.getElementById("parametro_superficie__ptsalumbrado_id").removeAttribute("required");    //Hacer parametro no requerido

  }



  if (d == "Proyecto_reforma_vehiculos" || d == "Sustitucion_maquinaria") {

    div_alumbrado_publico.style.display = "none";
    div_alumbrado_publico2.style.display = "none";
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_cantidad_gruas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";




  }

  if (d == "Proyectos_grua_por_grua") {
    div_cantidad_gruas.style.display = "flex";

    document.getElementById("cantidad_gruas").setAttribute("required", "");  //Hacer parametro requerido

    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';

    div_cuota_puntos_recarga.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }

  if (d != "Proyectos_grua_por_grua") {
    document.getElementById("cantidad_gruas").removeAttribute("required");    //Hacer parametro no requerido



  }

  if (d == "Proyecto_construccion_nave") {
    div_proyecto_construccion_nave.style.display = "flex";
    //------------------------------   Ocultar los demas   ------------------------------
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";

  }

  if (d == "Cuota_puntos_recarga") {

    div_cuota_puntos_recarga.style.display = "flex";

    //------------------------------   Ocultar los demas   ------------------------------

    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";



  }

  if (d == "Proyectos_cuota_piscina") {
    cuota_piscinas.style.display = "flex";

    document.getElementById("piscina_kw").setAttribute("required", "");  //Hacer parametro requerido

    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }

  if (d != "Proyectos_cuota_piscina") {
    document.getElementById("piscina_kw").removeAttribute("required");    //Hacer parametro no requerido

  }

  if (d == "Cuota_puntos_recarga") {
    div_cuota_puntos_recarga.style.display = "flex";


    document.getElementById("input_kw_potencia_puntos_recarga").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("input_kw_potencia_presupuesto").setAttribute("required", "");


    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";




  }

  if (d != "Cuota_puntos_recarga") {

    document.getElementById("input_kw_potencia_puntos_recarga").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("input_kw_potencia_presupuesto").removeAttribute("required");    //Hacer parametro no requerido


  }

  if (d == "Cuota_garajes") {
    div_cuota_garaje.style.display = "flex";

    document.getElementById("m2_cuota_garaje").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_m2_cuota_garaje").setAttribute("required", "");


    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }

  if (d != "Cuota_garajes") {
    document.getElementById("m2_cuota_garaje").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_m2_cuota_garaje").removeAttribute("required");

  }

  if (d == "Cuota_instalaciones_fotovoltaicas") {
    div_cuota_instalaciones_fotovoltaicas.style.display = "flex";

    document.getElementById("kw_fotovol").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_kw_fotovol").setAttribute("required", "");


    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }

  if (d != "Cuota_instalaciones_fotovoltaicas") {
    document.getElementById("kw_fotovol").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_kw_fotovol").removeAttribute("required");
  }

  if (d == "Cuota_instalaciones_fotovoltaicas_autoconsumo") {
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "flex";

    document.getElementById("kw_fotovol_autoc").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_fotovol_autoc").setAttribute("required", "");

    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }

  if (d != "Cuota_instalaciones_fotovoltaicas_autoconsumo") {
    document.getElementById("kw_fotovol_autoc").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_fotovol_autoc").removeAttribute("required");
  }

  if (d == "Cuota_instalacion_grupo_presion_electrogeno") {
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "flex";

    document.getElementById("kva_grupo_pree").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_kva_grupo_pree").setAttribute("required", "");

    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";

    div_proyecto_instalaciones_actividad.style.display = "none";


  }

  if (d != "Cuota_instalacion_grupo_presion_electrogeno") {
    document.getElementById("kva_grupo_pree").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_kva_grupo_pree").removeAttribute("required");
  }

  if (d == "Cuota_depositos_ppl") {
    div_cuota_depositos_ppl.style.display = "flex";

    document.getElementById("l_deposito_ppl").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_l_deposito_ppl").setAttribute("required", "");

    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }

  if (d != "Cuota_depositos_ppl") {
    document.getElementById("l_deposito_ppl").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_l_deposito_ppl").removeAttribute("required");
  }

  if (d == "Cuota_depositos_GLP") {
    div_cuota_depositos_GLP.style.display = "flex";


    document.getElementById("l_deposito_GLP").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_l_deposito_GLP").setAttribute("required", "");


    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";



  }

  if (d != "Cuota_depositos_GLP") {
    document.getElementById("l_deposito_GLP").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_l_deposito_GLP").removeAttribute("required");
  }



  if (d == "Cuota_redes_gas") {
    div_cuota_redes_gas.style.display = "flex";

    document.getElementById("met_lin_redes_gas").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_met_lin_redes_gas").setAttribute("required", "");


    //------------------------------   Ocultar los demas   ------------------------------

    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";



  }

  if (d != "Cuota_redes_gas") {
    document.getElementById("met_lin_redes_gas").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_met_lin_redes_gas").removeAttribute("required");
  }

  if (d == "Proyecto_instalacion_BTIndustrial_Publica") {
    div_proyecto_instalacion_bt_industrial_publica.style.display = "flex";

    document.getElementById("kw_instalacion_bt_industrial").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_kw_instalacion_bt_industrial").setAttribute("required", "");


    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";



  }

  if (d != "Proyecto_instalacion_BTIndustrial_Publica") {

    document.getElementById("kw_instalacion_bt_industrial").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_kw_instalacion_bt_industrial").removeAttribute("required");

  }

  if (d == "Proyecto_solo_calificacion_ambiental_actividad") {
    div_proyecto_solo_calificacion_ambiental.style.display = "flex";

    document.getElementById("met_s_calificacion_ambiental").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_met_s_calificacion_ambiental").setAttribute("required", "");

    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }
  if (d != "Proyecto_solo_calificacion_ambiental_actividad") {

    document.getElementById("met_s_calificacion_ambiental").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_met_s_calificacion_ambiental").removeAttribute("required");

  }

  if (d == "Proyecto_cuota_instalaciones_viviendas") {
    div_proyecto_instalaciones_viviendas.style.display = "flex";

    document.getElementById("met_p_instalaciones_viviendas").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_met_p_instalaciones_viviendas").setAttribute("required", "");


    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";



  }
  if (d != "Proyecto_cuota_instalaciones_viviendas") {
    document.getElementById("met_p_instalaciones_viviendas").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_met_p_instalaciones_viviendas").removeAttribute("required");

  }

  if (d == "Proyecto_demolicion_desmantelamiento") {
    div_proyecto_desmantelamiento.style.display = "flex";
    document.getElementById("m3_proyecto_desmantelamiento").setAttribute("required", "");  //Hacer parametro requerido


    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }
  if (d != "Proyecto_demolicion_desmantelamiento") {

    document.getElementById("m3_proyecto_desmantelamiento").removeAttribute("required");    //Hacer parametro no requerido


  }

  if (d == "Cuota_receptoras_gas") {
    div_cuota_receptoras_gas.style.display = "flex";

    document.getElementById("cuota_receptoras_gas_kw").setAttribute("required", "");  //Hacer parametro requerido

    document.getElementById("Presupuesto_cuota_receptoras_gas_kw").setAttribute("required", "");



    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }
  if (d != "Cuota_receptoras_gas") {
    document.getElementById("cuota_receptoras_gas_kw").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("Presupuesto_cuota_receptoras_gas_kw").removeAttribute("required");


  }

  if (d == "Cuota_instalaciones_rite") {
    div_cuota_instalaciones_rite.style.display = "flex";

    document.getElementById("cuota_instalaciones_rite_kw").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("Presupuesto_cuota_instalaciones_rite_kw").setAttribute("required", "");

    //------------------------------   Ocultar los demas   ------------------------------

    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";



  }
  if (d != "Cuota_instalaciones_rite") {

    document.getElementById("cuota_instalaciones_rite_kw").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("Presupuesto_cuota_instalaciones_rite_kw").removeAttribute("required");


  }

  if (d == "Cuota_instalaciones_renovacion_aire") {
    div_cuota_instalaciones_renovacion_aire.style.display = "flex";

    document.getElementById("cuota_instalaciones_renovacion_aire").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("Presupuesto_cuota_instalaciones_renovacion_aire").setAttribute("required", "");

    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }
  if (d != "Cuota_instalaciones_renovacion_aire") {

    document.getElementById("cuota_instalaciones_renovacion_aire").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("Presupuesto_cuota_instalaciones_renovacion_aire").removeAttribute("required");


  }

  if (d == "Cuota_redessuministro_redesinfraestructura_redessaneamiento") {
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "flex";

    document.getElementById("cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("Presupuesto_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento").setAttribute("required", "");


    //------------------------------   Ocultar los demas   ------------------------------

    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }
  if (d != "Cuota_redessuministro_redesinfraestructura_redessaneamiento") {

    document.getElementById("cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("Presupuesto_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento").removeAttribute("required");


  }

  if (d == "Cuota_lineas_BT") {
    div_lineas_BT.style.display = "flex";

    document.getElementById("ml_lineas_bt").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_ml_lineas_bt").setAttribute("required", "");


    //------------------------------   Ocultar los demas   ------------------------------



    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }
  if (d != "Cuota_lineas_BT") {

    document.getElementById("ml_lineas_bt").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_ml_lineas_bt").removeAttribute("required");


  }

  if (d == "Cuota_lineas_AT") {
    div_lineas_AT.style.display = "flex";

    document.getElementById("ml_lineas_at").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_ml_lineas_at").setAttribute("required", "");

    //------------------------------   Ocultar los demas   ------------------------------


    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_CT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";


  }

  if (d != "Cuota_lineas_AT") {
    document.getElementById("ml_lineas_at").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_ml_lineas_at").removeAttribute("required");


  }

  if (d == "Cuota_lineas_CT") {
    div_lineas_CT.style.display = "flex";

    document.getElementById("ml_lineas_ct").setAttribute("required", "");  //Hacer parametro requerido
    document.getElementById("presupuesto_ml_lineas_ct").setAttribute("required", "");


    //------------------------------   Ocultar los demas   ------------------------------
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_alumbrado_publico.style.display = 'none';
    div_alumbrado_publico2.style.display = 'none';
    div_cantidad_gruas.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_proyecto_instalaciones_actividad.style.display = "none";



  }
  if (d != "Cuota_lineas_CT") {

    document.getElementById("ml_lineas_ct").removeAttribute("required");    //Hacer parametro no requerido
    document.getElementById("presupuesto_ml_lineas_ct").removeAttribute("required");


  }






  //div_parametro_pts.style.display = "initial";
  // label_eur.style.display = "initial";


  //else {
  //   div_parametro_pts.style.display = "none";
  //   label_alumbrado_sustitucion.display = "none";
  //   label_eur.style.display = "none";
  //   // label_pts_alumbrado.style.display = "none";

  // }

  // if (d != "Proyecto_construccion_nave") { //Para que oculte los checkbox si no es es (es el unico por ahora)
  //   var div_parametro = document.getElementsByClassName("checkboxes")[0];
  //   div_parametro.style.display = "none";

  // }

}

// function obtener_opcion_seleccionada_estudio() {
//   /* boton_calcular.disabled= false; */
//   var div_eur = document.getElementById("div_eur");

//   d = document.getElementById("estudio_opcion_seleccionada").value;

//   if (d == "Estudio_basico_seguridad_y_salud") { //Para que muestre el input de precio
//     var div_eur = document.getElementById("div_eur");
//     div_eur.style.display = "initial";

//   }


//   if (d == "Cuota_puntos_recarga") { //Para que muestre el input de precio
//     var div_cuota_puntos_recarga = document.getElementById("div_cuota_puntos_recarga");
//     div_cuota_puntos_recarga.style.display = "initial";

//   }
// }

function obtener_opcion_seleccionada_estudio() {
  d = document.getElementById("estudio_opcion_seleccionada").value;




  if (d == "Estudio_acustico") {
    div_parametro_estudio_segysalud.style.display = "none";

  }

  if (d == "Estudio_basico_seguridad_y_salud") {
    div_parametro_estudio_segysalud.style.display = "none";

  }

  if (d == "Estudio_seguridad_y_salud") {
    // console.log("Se ha seleccionado estudio seguridad y salud");
    div_parametro_estudio_segysalud.style.display = "flex";
    document.getElementById("presupuesto_estudio_segysalud").setAttribute("required", "");  //Hacer parametro requerid

  }
  if (d != "Estudio_seguridad_y_salud") {
    document.getElementById("presupuesto_estudio_segysalud").removeAttribute("required");    //Hacer parametro no requerido

  }

  if (d == "Estudio_de_detalle") {
    div_parametro_estudio_segysalud.style.display = "none";

  }

  if (d == "Estudio_impacto_medioambiental") {
    div_parametro_estudio_segysalud.style.display = "none";


  }


}

// Checkbox parte adosada sin cerramientos eventos
var checkBox_parte_adosada = document.getElementById("parte_adosada_sin_cerramientos");
checkBox_parte_adosada.addEventListener('change', (event) => {
  if (event.currentTarget.checked) {
    div_parte_adosada_sin_cerramientos_M2.style.display = "initial"; //¿O flexbox?
    input_m2parteadosada.required = true;
  } else {
    div_parte_adosada_sin_cerramientos_M2.style.display = "none";
    input_m2parteadosada.required = false;
  }
})

// Checkbox demoler edificacion existente tevento
var demoler_ya_existente = document.getElementById("demoler_ya_existente");
demoler_ya_existente.addEventListener('change', (event) => {
  if (event.currentTarget.checked) {
    div_m3_residuos_solidos.style.display = "initial";
    input_m3residuosolido.required = true;
  } else {
    div_m3_residuos_solidos.style.display = "none";
    input_m3residuosolido.required = false;

  }
})

// Checkbox documentos profesionales
// var documentos_profesionales = document.getElementById("documentos_profesionales");
// documentos_profesionales.addEventListener('change', (event) => {
//   if (event.currentTarget.checked) {
//     div_documentos_profesionales.style.display = "initial";
//   } else {
//     div_documentos_profesionales.style.display = "none";
//   }
// })

document.getElementById('parametro_superficie_label').addEventListener('change', function () {
  // console.log('You selected: ', this.value);
});

function updateInput(ish) {
  document.getElementById("fieldname").value = ish;

}

function obtener_opcion_seleccionada_direccion_tecnica() {
  d = document.getElementById("direccion_tecnica_seleccionada").value;

  if (d == "Direccion_tecnica_050") {
    // console.log("Se ha seleccionado direccion tecnica 050");
    proyecto_opcion_seleccionada.style.display = "initial";   //Se muestra el dropdown de tipo de proyecto y a partir de ahi continua
  }

  if (d == "Direccion_tecnica_070") {
    // console.log("Se ha seleccionado direccion tecnica 070");
    proyecto_opcion_seleccionada.style.display = "initial";   //Se muestra el dropdown de tipo de proyecto y a partir de ahi continua
  }

  if (d == "Direccion_tecnica_100") {
    // console.log("Se ha seleccionado direccion tecnica 100");
    proyecto_opcion_seleccionada.style.display = "initial";   //Se muestra el dropdown de tipo de proyecto y a partir de ahi continua
  }


  if (d == "Direc.Tec.Grua") {
    proyecto_opcion_seleccionada.style.display = "none";

    div_alumbrado_publico.style.display = "none";
    div_alumbrado_publico2.style.display = "none";
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_cantidad_gruas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";

  }

  if (d == "Direccion_tecnica_reforma_vehiculos") {
    proyecto_opcion_seleccionada.style.display = "none";
    div_alumbrado_publico.style.display = "none";
    div_alumbrado_publico2.style.display = "none";
    div_proyecto_construccion_nave.style.display = "none";
    div_parametro_presupuesto.style.display = "none";
    div_cantidad_gruas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    cuota_piscinas.style.display = "none";
    div_cuota_puntos_recarga.style.display = "none";
    div_cuota_garaje.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas.style.display = "none";
    div_cuota_instalaciones_fotovoltaicas_autoconsumo.style.display = "none";
    div_cuota_instalacione_grupo_presion_electrogeno.style.display = "none";
    div_cuota_depositos_ppl.style.display = "none";
    div_cuota_depositos_GLP.style.display = "none";
    div_cuota_redes_gas.style.display = "none";
    div_proyecto_instalacion_bt_industrial_publica.style.display = "none";
    div_proyecto_solo_calificacion_ambiental.style.display = "none";
    div_proyecto_instalaciones_viviendas.style.display = "none";
    div_proyecto_desmantelamiento.style.display = "none";
    div_cuota_receptoras_gas.style.display = "none";
    div_cuota_instalaciones_rite.style.display = "none";
    div_cuota_instalaciones_renovacion_aire.style.display = "none";
    div_cuota_Redes_suministrosAgua_InfraestructuraTelecomunicaciones_Redes_saneamiento.style.display = "none";
    div_lineas_BT.style.display = "none";
    div_lineas_AT.style.display = "none";
    div_lineas_CT.style.display = "none";

  }

}

// ANIMACION BOTONES CALCULO
$('#boton_calcular').hover(
  function () {
    $('#boton_calcular_hover').addClass('fa-bounce');
  },
  function () {
    $('#boton_calcular_hover').removeClass('fa-bounce');
  }
)

$('#boton_submit').hover(
  function () {
    $('#boton_nuevo_calculo_hover').addClass('fa-spin');
  },
  function () {
    $('#boton_nuevo_calculo_hover').removeClass('fa-spin');
  }
)

// ANIMACION BOTON ATRAS
$('#boton_volver_atras').hover(
  function () {
    $('#icono_atras').addClass('fa-fade');
  },
  function () {
    $('#icono_atras').removeClass('fa-fade');
  }
)

const form = document.querySelector('#formulario_main')  //Mostrar div de carga y hacer scroll al resultado
form.onsubmit = (e) => {
  $('#loading_screen2').removeClass('hide');
  smoothScroll();

}


document.addEventListener('DOMContentLoaded', function () {

  iframe.onload = function () {
    try {
      iframe.contentWindow.location.href; hide_loadingscreen2();
    }
    catch (err) {

      document.getElementById("div_error_iframe").classList.remove("DISPLAY_NONE")
    }
  }


  // function hide(){
  //   window.alert("No pudo ser");
  // }
});