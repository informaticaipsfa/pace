<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * MamonSoft
 *
 * Kernel
 *
 * @package pace\application\modules\panel\model\beneficiario
 * @subpackage utilidad
 * @author Carlos Peña
 * @copyright Derechos Reservados (c) 2015 - 2016, MamonSoft C.A.
 * @link http://www.mamonsoft.com.ve
 * @since version 1.0
 */

class KGenerador extends CI_Model{

  /**
  * Iniciando la clase, Cargando Elementos Pace
  *
  * @access public
  * @return void
  */
  public function __construct(){
    parent::__construct();
  }


  function Calcular(MBeneficiario & $Beneficiario){

  }

  function Generar(){

  }

  /**
  * Listar tamaños y de las tablas
  */

  function VerArquitecturaDeTablas(){
    $sCon = '
      SELECT relname AS "relation",
        pg_size_pretty(pg_total_relation_size(C.oid)) AS "total_size"
      FROM pg_class C
      LEFT JOIN pg_namespace N ON (N.oid = C.relnamespace)
      WHERE nspname NOT IN (\'pg_catalog\', \'information_schema\')
        AND C.relkind <> \'i\'
        AND nspname !~ \'^pg_toast\'
      ORDER BY pg_total_relation_size(C.oid) DESC
      LIMIT 5;
    ';
  }

  /**
  * Firmar la BD en columnas para saber si cambiaron algo
  */
  function VerPesoDeColumnas(){
    $sCon = '
      SELECT sum(pg_column_size(componente_id)),sum(pg_column_size(grado_id)) FROM beneficiario where status_id=201;
    ';
  }

  /**
  * Archivo de banco nuevos
  */
  function AperturaTXT($path, $archivo, $tipo, $porce){
    $this->load->model('kernel/KSensor');

    $m = 36;
    if($tipo == 1)$m = 37;
    if($tipo == 2)$m = 35;


    $sub = substr($path, 1, 33);
    $handle = fopen("tmp/" . $sub . ".csv", "r");
    $file = fopen("tmp/" . $path . '/APERT' . $archivo . ".txt","a") or die("Problemas");
    $cantidad = 0;
    $sum = 0;
    $plan = '03487';
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
           if($sum > 0){
              $l = explode(";", $buffer);

              if($l[31] == 0 && $l[33] == 0 && $l[34] == 0){
                if($porce < 100){
                    $porcen = round(($l[$m] * $porce)/100,2);
                }else{$porcen = $l[$m];}
                $nombre = '';
                $cedula = $this->completarCero(9, $l[0], '0');
                $nac = 'V';
                $edocivil = 'S';
                $n = explode(" ", $l[5]);
                for( $i=0; $i < 4; $i++){
                  if(isset($n[$i])){
                    $nombre .= $this->completarCero(15, $n[$i], " ", 1);
                  }else{
                    $nombre .= $this->completarCero(15, " ", " ");
                  }
                }
                $campo = $this->completarCero(26, "0", "0");
                $monto = $porcen * 100;
                $monto_s = $this->completarCero(13, $monto, '0');
                $ganancia = '0';
                $numeroyubicacion = $this->completarCero(15, " ", " ");
                if($monto > 0){ //**SE REALIZO ESTA MODIFICACION PARA QUE TS<0 NO SALGAN EN EL ARCHIVO TXT
                  $linea = $plan . $nac . $cedula .  $nombre . $edocivil . $campo . $monto_s;
                  fputs($file,$linea);
                  fputs($file,"\r\n");
                }
                $cantidad++;

              }

           }
          $sum++;


        }

        if (!feof($handle)) {
            return "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
        fclose($file);
    }


    return array(
      'd' => "Duración: " . $this->KSensor->Duracion(),
      'c' => $cantidad
    );
  }



  /**
  * Archivo de banco viejos
  */

  function AporteTXT($path, $archivo, $tipo, $porce){
    $this->load->model('kernel/KSensor');

    $m = 36;
    if($tipo == 1)$m = 37;
    if($tipo == 2)$m = 35;


    $sub = substr($path, 1, 33);
    $this->load->model('kernel/KSensor');
    $handle = fopen("tmp/" . $sub . ".csv", "r");
    $file = fopen("tmp/" . $path . '/APORT' . $archivo . ".txt","a") or die("Problemas");
    $cantidad = 0;
    $sum = 0;
    $plan = '03487';
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
          if($sum > 0){
              $l = explode(";", $buffer);
              if(($tipo == 2 && $l[7] > 0) || ($tipo == 1 && $l[7] > 0) || $tipo == 0){
              if($l[$m] > 0 ||  $l[$m] > 0 || $l[$m] > 0){
                if($porce < 100){
                    $porcen = round(($l[$m] * $porce)/100,2);
                }else{$porcen = $l[$m];}
                $nac = 'V';
                $cedula = $this->completarCero(9, $l[0], '0');
                $tiptrn = '1';
                $tippre = '00';
                $frmpgo = '0';
                $monto = $porcen * 100;
                $monto_s = $this->completarCero(13, $monto, '0');
                $tippta = 'N';
                $tipcue = '0';
                $numcue = '0000000000';
                $tasaint = '000000';
                $cbrintatp = ' ';
                $cuomen = '000';
                $mtoanu = '0000000000000';
                $cuoanu = '000';
                $linea = $plan . $nac . $cedula . $tiptrn . $tippre . $frmpgo . $monto_s . $tippta . $tipcue . $numcue . $tasaint . $cbrintatp . $cuomen . $mtoanu . $cuoanu;
                fputs($file,$linea);
                fputs($file,"\r\n");
                $cantidad++;
              }
            }
          }
          $sum++;

        }
        if (!feof($handle)) {
            return "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
        fclose($file);
    }

    return array(
      'd' => "Duración: " . $this->KSensor->Duracion(),
      'c' => $cantidad
    );
  }

  function RetiroTXT($path, $archivo, $tipo, $porce){
    $this->load->model('kernel/KSensor');

    $m = 37;

    $sub = substr($path, 1, 33);
    $this->load->model('kernel/KSensor');
    $handle = fopen("tmp/" . $sub . ".csv", "r");
    $file = fopen("tmp/" . $path . '/RETIR' . $archivo . ".txt","a") or die("Problemas");
    $cantidad = 0;
    $sum = 0;
    $plan = '03487';
    if ($handle) {
        while (($buffer = fgets($handle, 4096)) !== false) {
          if($sum > 0){
              $l = explode(";", $buffer);

            if($tipo == 1 && $l[7] > 0){
                if($porce < 100){
                    $porcen = round(($l[$m] * $porce)/100,2);
                }else{$porcen = $l[$m];}
                $nac = 'V';
                $cedula = $this->completarCero(9, $l[0], '0');
                $tiptrn = '3';
                $tippre = '00';
                $frmpgo = 'A';
                $monto = $porcen * 100;
                $monto_s = $this->completarCero(13, $monto, '0');
                $tippta = ' ';
                $tipcue = '0';
                $numcue = '0000000000';
                $tasaint = '000000';
                $cbrintatp = ' ';
                $cuomen = '000';
                $mtoanu = '0000000000000';
                $cuoanu = '000';
                $linea = $plan . $nac . $cedula . $tiptrn . $tippre . $frmpgo . $monto_s . $tippta . $tipcue . $numcue . $tasaint . $cbrintatp . $cuomen . $mtoanu . $cuoanu;
                fputs($file,$linea);
                fputs($file,"\r\n");
                $cantidad++;
              }
          }
          $sum++;

        }
        if (!feof($handle)) {
            return "Error: unexpected fgets() fail\n";
        }
        fclose($handle);
        fclose($file);
    }

    return array(
      'd' => "Duración: " . $this->KSensor->Duracion(),
      'c' => $cantidad
    );
  }



  function completarCero($cant, $cadena, $caracter = " ", $sentido = 0){
     $largo_numero = strlen($cadena);
     $largo_maximo = $cant;
     $agregar = $largo_maximo - $largo_numero;
     //agrego los ceros
     for($i =0; $i<$agregar; $i++){
      if($sentido == 1){
        $cadena = $cadena . $caracter;
      } else {
        $cadena = $caracter . $cadena;
      }

     }

     return $cadena;
  }

}
