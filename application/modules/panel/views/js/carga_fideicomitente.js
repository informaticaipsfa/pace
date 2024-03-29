var Persona = {};


$( "#id" ).keypress(function( event ) {
  if ( event.which == 13 ) {
    $("#btnActualizar").focus();
  }
});

$('#fingreso').datepicker({
  format: 'dd/mm/yyyy',
  autoclose: true
});

$('#fuascenso').datepicker({
  format: 'dd/mm/yyyy',
  autoclose: true
});

function consultar(){
    limpiar();
    //id = '7131627';
    var val = "13587538";
    ruta = sUrlP + "Panel/consultarBeneficiarios/" + val;
    $.getJSON(ruta, function(data) {
        $("#nombres").val(data.nombres);
        $("#apellidos").val(data.apellidos);
        //cargarSexo(data.sexo);



        $("#componente").val(data.Componente.nombre);
        //cargarGrado(data.Componente.Grado.id, data.Componente.Grado.nombre, data.Componente.id);

        $('#fingreso').val(cargarFecha(data.fecha_ingreso));
        $("#tservicio").val(data.tiempo_servicio);
        $("#nhijos").val(data.numero_hijos);
        $('#fuascenso').val(cargarFecha(data.fecha_ultimo_ascenso));


        $("#noascenso").val(data.no_ascenso);
        $("#profesionalizacion").val(data.profesionalizacion);
        $("#sueldo_base").val(data.sueldo_base_aux);
        $("#sueldo_global").val(data.sueldo_global_aux);
        $("#sueldo_integral").val(data.sueldo_integral_aux);
        $("#arec").val(data.ano_reconocido);
        $("#mrec").val(data.mes_reconocido);
        $("#drec").val(data.dia_reconocido);
        $("#fecha_retiro").val(data.fecha_retiro);
        $("#fano").val(data.aguinaldos_aux);
        $("#vacaciones").val(data.vacaciones_aux);
        $("#numero_cuenta").val(data.numero_cuenta);
        $("#estatus").val(data.estatus_descripcion);
        $("#saldo_disponible").val(data.Calculo.saldo_disponible);
        vBtn();

    }
    ).done(function(msg) {}).fail(function(jqXHR, textStatus) {
        $("#txtMensaje").html('No se encontro cédula de beneficiario');
        $("#logMensaje").modal('show');
        limpiar();
    });

}

function cargarFecha(fecha){
  if(fecha != null){
    var f = fecha.split('-');
    return f[2] + '/' + f[1] + '/' + f[0];
  }
}

function cargarFechaSlash(fecha){
    if(fecha != null){
      var f = fecha.split('/');
      return f[2] + '-' + f[1] + '-' + f[0];
    }
}

function cargarSexo(sex){
    if (sex == '' || sex == null){
        var opt = new Option('SELECCIONE', '');
        $("#sexo").append(opt);
        opt.setAttribute("selected","selected");
        var opt = new Option('MASCULINO', 'M');
        $("#sexo").append(opt);
        var opt = new Option('FEMENINO', 'F');
        $("#sexo").append(opt);
    }else if(sex == 'F'){
        var opt = new Option('MASCULINO', 'M');
        $("#sexo").append(opt);
        var opt = new Option('FEMENINO', 'F');
        $("#sexo").append(opt);
        opt.setAttribute("selected","selected");
    }else{
        var opt = new Option('MASCULINO', 'M');
        $("#sexo").append(opt);
        opt.setAttribute("selected","selected");
        var opt = new Option('FEMENINO', 'F');
        $("#sexo").append(opt);
    }

}


function cargarGrado(cod, nom, id){


    ruta = sUrlP + "cargarGradoComponente/" + id;

    $.getJSON(ruta, function(data) {

        $.each(data, function(d, v){
            var opt = new Option(v.nombre, v.id);
            $("#grado").append(opt);
            if(v.id == cod) opt.setAttribute("selected","selected");
        });

    }).done(function(msg) {}).fail(function(jqXHR, textStatus) {
       $("#txtMensaje").html('No se encontro cédula de beneficiario');
       $("#logMensaje").modal('show');
       limpiar();
    });
}


function limpiar(){
    $("#sexo option").remove();
    $("#grado option").remove();
    $("#nombres").val('');
    $("#apellidos").val('');
    $("#componente").val('');
    $("#fingreso").val('');
    $("#tservicio").val('');
    $("#nhijos").val('');
    $("#fuascenso").val('');
    $("#noascenso").val('');
    $("#profesionalizacion").val('');
    $("#arec").val('');
    $("#mrec").val('');
    $("#drec").val('');
    $("#fecha_retiro").val('');
    $("#fano").val('');
    $("#vacaciones").val('');
    $("#numero_cuenta").val('');
    $("#estatus").val('');
    $("#saldo_disponible").val('');
    $("#comision_servicio").val('');
    $("#monto_recuperado").val('');
    $("#fecha").val('');
    $("#o_b").val('');
    vBtn();
   
}

function cargarBeneficiario(){
    Persona['cedula'] = $("#id").val();
    Persona['sexo'] = $("#sexo option:selected").val();
    Persona['grado'] = $("#grado option:selected").val();
    Persona['nombres'] = $("#nombres").val();
    Persona['apellidos'] = $("#apellidos").val();
    Persona['componente'] = $("#componente").val();
    Persona['fingreso'] = cargarFechaSlash($("#fingreso").val());
    Persona['tservicio'] = $("#tservicio").val();
    Persona['nhijos'] = parseInt($("#nhijos").val());
    Persona['fuascenso'] = cargarFechaSlash($("#fuascenso").val());
    Persona['noascenso'] = parseInt($("#noascenso").val());
    Persona['profesionalizacion'] = parseInt($("#profesionalizacion").val());

    Persona['arec'] = $("#arec").val()!=""?parseInt($("#arec").val()):0;
    Persona['mrec'] = $("#mrec").val()!=""?parseInt($("#mrec").val()):0;
    Persona['drec'] = $("#drec").val()!=""?parseInt($("#drec").val()):0;
    Persona['fecha_retiro'] = $("#fecha_retiro").val();
    Persona['fano'] = $("#fano").val();
    Persona['vacaciones'] = $("#vacaciones").val();
    Persona['numero_cuenta'] = $("#numero_cuenta").val();
    Persona['estatus'] = $("#estatus").val();
    Persona['comision_servicio'] = $("#comision_servicio").val();
    Persona['monto_recuperado'] = $("#monto_recuperado").val();
    Persona['o_b'] = $("#o_b").val();
    Persona['status_id'] = $("#status_id").val();
    Persona['motivo_id'] = $("#motivo_id").val();
    Persona['observ_ult_modificacion'] = $("#observ_ult_modificacion").val();
   
}

function cargar(){
   
  /*$.ajax({    
        url: sUrlP + "fideicomitente",
        type: "POST",
        data: {'data' : 'hola'},
        success: function(data){
          alert(data);
      }
  });*/ 
        consultar();
        cargarBeneficiario();
        console.log(Persona);
        $.ajax({
              url: sUrlP + "actualizarBeneficiario" + val,
              type: "POST",
              data: {'data' : JSON.stringify({
                Persona: Persona
              })},
              success: function (data) {
                $("#txtMensaje").html(data);
                $("#logMensaje").modal('show');
                $("#id").val('');

              },
              error: function(data){
                $("#txtMensaje").html(data);
                $("#logMensaje").modal('show');

              }
            });
        limpiar();
} 

function continuar(){
    $("#logMensaje").modal('hide');
}
