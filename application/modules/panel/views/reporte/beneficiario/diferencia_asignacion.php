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

 <table style="width: 700px;  text-align: justify;  font-size: 15px">
  <tr>
    <td>Nro.</td><td>320.600-<?php echo substr(md5($Beneficiario->cedula . $Beneficiario->fecha_ultima_modificacion), 0,6);?>/03</td>
  </tr>
  <tr>
    <td >DE:</td><td><b>CNEL. GERENTE DE BIENESTAR Y SEGURIDAD SOCIAL</b></td>
  </tr>
  <tr>
    <td>PARA:</td><td><b>CNEL. GERENTE DE DE FINANZAS</b></td>
  </tr>
  <tr>
    <td>ASUNTO:</td><td><b>PAGO DE DIFERENCIA DE ASIGNACION DE ANTIGUEDAD</b></td>
  </tr>

  <tr>
    <td valign="TOP">AFILIADO:</td><td><b><?php
      echo $Beneficiario->Componente->Grado->nombre . ' ' . $Beneficiario->Componente->descripcion . ' ' .
      $Beneficiario->nombres . ' ' . $Beneficiario->apellidos . '<br> CEDULA DE IDENTIDAD: ' . $Beneficiario->cedula; ?></b></td>
  </tr>
  <tr>
    <td valign="TOP">FALLECIMIENTO:</td><td><b><?php
      echo $Beneficiario->fecha_retiro; ?></b></td>
  </tr>
 </table>
 <table style="width: 700px">
  <tr>
   <td style="border: 0px solid #dddddd; text-align: justify; font-size: 16px; line-height: 1.5">

     <!--&emsp;&emsp;Mediante la presente comunicación me dirijo a Ud., en la oportunidad de solicitar su valiosa colaboración a objeto -->
     &emsp;&emsp;Tengo el honor de dirigirme a usted, en la oportunidad se estudie la posibilidad de solicitar su valiosa colaboración a objeto
     gire sus instruciones con la finalidad sea realizado el pago de la Diferencia de la Asignación de Antiguedad no colocada en fideicomiso
      por el fallecimiento del afiliado  en referencia quien de acuerdo a lo previsto en el artículo 57 de la LOSSFANB y los
      artículos 822 al 832 del Código Civil Venezolano
     <br><br>

     <table class="ctd">
       <thead>
          <tr>
            <th>COD</th>
            <th>APELLIDOS Y NOMBRES DE LOS BENEFICIARIOS</th>
            <th>CEDULA</th>
            <th>MONTO BS.S</th>
          </tr>
       </thead>
       <tbody>
        <?php
          $sum = 0;
          foreach ($lst as $c => $v) {
            if ($v['mdaa'] > 0){
              echo '<tr><td>' . $v['codigo'] . '</td><td>' . strtoupper($v['nombre']) . '</td><td>' . $v['cedula'] . '</td><td  style="text-align: right">' .
              number_format($v['mdaa'], 2, ',','.') . '</td></tr>';
              $sum += $v['mdaa'];
            }
          }
          echo '<tr><td colspan="3" style="text-align: right">TOTAL&nbsp;&nbsp;</td><td  style="text-align: right">' . number_format($sum, 2, ',','.') . '</td></tr>'
        ?>
       </tbody>
     </table>
     <br>
     &emsp;&emsp;Solicitud que le hago llegar, para su conocimiento y demas fines consiguientes.<br>
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
       <br><br><br><b>
        CNEL. JUAN GABRIEL PUERTAS TOVAR<BR></b>
     </center>
     <br>

     Notas:<br>
     <FONT SIZE=2>
     <?php
       $o = explode('*MA', $Beneficiario->observacion);
       $o[0] = str_replace("\n", '<br>', $o[0]);
       echo $o[0];
      ?>
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
