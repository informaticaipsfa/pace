<?php

  function fecha($fecha = ''){
    $mes = 'Enero';
    switch ($fecha) {
      case 'January':
        $mes="Enero";
        break;
      case 'February':
        $mes="Febrero";
        break;
      case 'March':
        $mes="Marzo";
        break;
      case 'April':
        $mes="Abril";
        break;
      case 'May':
        $mes="Mayo";
        break;
      case 'June':
        $mes="Junio";
        break;
      case 'July':
        $mes="Julio";
        break;
      case 'August':
        $mes="Agosto";
        break;
      case 'September':
        $mes="Septiembre";
        break;
      case 'October':
        $mes="Octubre";
        break;
      case 'November':
        $mes="Noviembre";
        break;
      case 'December':
        $mes="Diciembre";
        break;
      default:
        # code...
        break;
    }
    return $mes;

  }


?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Formulario</title>
 <style>
table {
    font-family: arial, sans-serif;
    font-size: 12px;
    border-collapse: collapse;
    width: 800px;
}

td{
    border: 0px solid #dddddd;
    text-align: left;
    padding: 8px;
}
th {
    border: 1px solid #dddddd;
    text-align: left;
    background-color: #dddddd;
    padding: 8px;
}
.ctd td{
    border: 1px solid #000000;
    text-align: left;
    padding: 8px;
}

.ctd table {
    font-family: arial, sans-serif;
    font-size: 12px;
    border-collapse: collapse;
    width: 800px;
}

.ctd th {
    border: 1px solid #000000;
    text-align: left;
    background-color: #dddddd;
    padding: 8px;
}


/*tr:nth-child(even) {
    background-color: #dddddd;
}*/
</style>
</head>
<BODY>
 <center>
 <table style="width: 700px">
 <tr>
   <td style="width: 100%;  border: 0px solid #dddddd; text-align: center; font-size: 10px">
     REPÚBLICA BOLIVARIANA DE VENEZUELA<BR>
     MINISTERIO DEL PODER POPULAR PARA LA DEFENSA<BR>
     VICEMINISTERIO DE SERVICIOS, PERSONAL Y LOGISTICA<BR>
     DIRECCIÓN GENERAL DE EMPRESAS<BR>
     INSTITUTO DE PREVISIÓN SOCIAL<BR>
     DE LAS FUERZAS ARMADAS<BR>
   </td>

 </tr>
 </table><BR>
 <br>

 <table style="width: 700px;  text-align: justify;  font-size: 15px">
  <tr>
    <td>DE:</td><td><b>CNEL. GERENTE DE BIENESTAR Y SEGURIDAD SOCIAL</b></td>
  </tr>
  <tr>
    <td>PARA:</td><td><b>MAY. CONSULTOR JURIDICO</b></td>
  </tr>
  <tr>
    <td>ASUNTO:</td><td><b>REMISION DE EXPEDIENTE Y SOLICITUD DE VISADO.</b></td>
  </tr>

 </table>
 <BR><BR>
 <table style="width: 700px">
  <tr>
   <td style="border: 0px solid #dddddd; text-align: justify; font-size: 16px; line-height: 1.5">

     &emsp;&emsp;Tengo el agrado de dirigirme a Ud., en la oportunidad de remitirle anexo a la presente
     anexo a la presente comunicación un (01) expediente del afiliado fallecido que se relaciona a continuación
     para dar cumplimiento a lo establecido por la Contraloría Interna, según Memo del 14JUL95.

     <br><br>
     <table class="ctd">
       <thead>
         <tr>
           <th>GRADO</th>
           <th>COMPONENTE</th>
           <th>CEDULA</th>
           <th>APELLIDOS Y NOMBRES</th>
           <?php if ($Beneficiario->fecha_retiro>'2015-12-29')//Condición para validar campo M. Acto de Servicios
           {?>
           <th>M.ACTO DE SERVICIOS</th>
            <?php }?>
           <th>FINIQUITO</th>
           <th>DIFERENCIA AA</th>
         </tr>
       </thead>
       <body>
         <tr>
           <td><?php echo $Beneficiario->Componente->Grado->nombre;?></td>
           <td><?php echo $Beneficiario->Componente->descripcion;?></td>
           <td><?php echo $Beneficiario->cedula;?></td>
           <td><?php echo $Beneficiario->nombres . ' ' . $Beneficiario->apellidos;?></td>
           <td><?php echo substr(md5($Beneficiario->cedula . $Beneficiario->fecha_ultima_modificacion), 0,6) . '/01';?></td>
           <?php if ($Beneficiario->fecha_retiro>'2015-12-29')
           {?>
           <td><?php echo substr(md5($Beneficiario->cedula . $Beneficiario->fecha_ultima_modificacion), 0,6) . '/02';?></td>
           <?php }?>
          <td><?php echo substr(md5($Beneficiario->cedula . $Beneficiario->fecha_ultima_modificacion), 0,6) . '/03';?></td><!--Se Agrega para obtener el Numero de Oficio de AA 08032017 -->
         </tr>
       </body>
     </table>

     <br> &emsp;&emsp;Solicitud que le hago llegar, para su conocimiento y demas fines consiguientes.

     <p align="right">

     <?php $fecha=substr(($Beneficiario->fecha_ultima_modificacion), 0,10);
          $fecha=explode('-', $fecha)
     ?>
       Caracas, <?php echo $fecha[2].'/'.$fecha[1].'/'.$fecha[0];?>
     </p>
     <!--<p align="right">
       Caracas,&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
     </p>-->
     <center>

        <br><br><br><b><br><b>
        CNEL. JUAN GABRIEL PUERTAS TOVAR<BR></b>
     </center><br> <br>


     <br><br>
     RJBB/<?php echo $Beneficiario->usuario_modificacion;?>
   </td>

 </tr>
 </table>

 </center>

  <br><br>
  <center>
    <button onclick="imprimir()" id="btnPrint">Imprimir Reporte</button>
  </center>

  <script language="Javascript">
    function imprimir(){
        document.getElementById('btnPrint').style.display = 'none';
        window.print();
        window.close();
    }
  </script>
</BODY>
</HTML>
