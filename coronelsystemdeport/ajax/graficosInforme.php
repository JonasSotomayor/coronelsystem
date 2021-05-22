<?php
    session_start();
    require "../config/Conexion.php";
    require "../config/bdd2.php";
    $anho=isset($_POST["anho"])? limpiarCadena($_POST["anho"]):"";
    $mes=isset($_POST["mes"])? limpiarCadena($_POST["mes"]):"";
    $fechaInicio=isset($_POST["fechaInicio"])? limpiarCadena($_POST["fechaInicio"]):"";
    $fechaFin=isset($_POST["fechaFin"])? limpiarCadena($_POST["fechaFin"]):"";
    $sucursal=$_SESSION['codigoSucursal'];
    $usuario=$_SESSION['codigoUsuario'];
    switch ($_GET["op"]){
      case 'graficarEmpleadosFirmaCant':
        $datos=null;
        $sqlfE="call sp_filtrarEmpleado('".$sucursal."');";
        $rsMant1=$conexion->query($sqlfE);
        //var_dump($rsMant1);
        if ($rsMant1==null) {
          $rsMant1 = $bdd->prepare($sqlOL);
          $rsMant1->execute();
          $repMant1=$rsMant1->fetch(PDO::FETCH_OBJ);
          $total=$repMant1->firmasConfirmadas+$repMant1->firmasFaltantes;
          $firmasConfirmadas=($repMant1->firmasConfirmadas*100)/$total;
          $firmasFaltantes=($repMant1->firmasFaltantes*100)/$total;
          $datos=array('firmasConfirmadas'=>$firmasConfirmadas,'firmasFaltantes'=>$firmasFaltantes);
        }else{
          $repMant1=$rsMant1->fetch_object();
          $total=$repMant1->firmasConfirmadas+$repMant1->firmasFaltantes;
          $firmasConfirmadas=($repMant1->firmasConfirmadas*100)/$total;
          $firmasFaltantes=($repMant1->firmasFaltantes*100)/$total;
          $datos=array('firmasConfirmadas'=>$firmasConfirmadas,'firmasFaltantes'=>$firmasFaltantes);
        }
        echo json_encode($datos);
      break;

    }

?>
