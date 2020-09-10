<?php
session_start();
require_once "../modelos/Usuarios.php";
include '../public/sha256/SED.php';


$Usuarios=new Usuarios();

$idusuario=isset($_POST["idusuario"])? limpiarCadena($_POST["idusuario"]):"";
$imagenUsuario=isset($_POST["imagenUsuario"])? limpiarCadena($_POST["imagenUsuario"]):"";
$razonSocial=isset($_POST["razonsocial"])? limpiarCadena($_POST["razonsocial"]):"";
$ci=isset($_POST["ci"])? limpiarCadena($_POST["ci"]):"";
$idrazonSocial=isset($_POST["idrazonSocial"])? limpiarCadena($_POST["idrazonSocial"]):"";
$loginUsuario=isset($_POST["loginUsuario"])? limpiarCadena($_POST["loginUsuario"]):"";
$claveUsuario=isset($_POST["claveUsuario"])? limpiarCadena($_POST["claveUsuario"]):"";
$cargoUsuario=isset($_POST["cargoUsuario"])? limpiarCadena($_POST["cargoUsuario"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':


		//IMAGEN DE USUARIO
		if (!file_exists($_FILES['imagenUsuario']['tmp_name']) || !is_uploaded_file($_FILES['imagenUsuario']['tmp_name']))
		{
			$imagenUsuario=$_POST["imagenactual"];
		}
		else
		{
			$ext = explode(".", $_FILES["imagenUsuario"]["name"]);
			if ($_FILES['imagenUsuario']['type'] == "image/jpg" || $_FILES['imagenUsuario']['type'] == "image/jpeg" || $_FILES['imagenUsuario']['type'] == "image/png")
			{
				$imagenUsuario = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["imagenUsuario"]["tmp_name"], "../files/usuarios/" . $imagenUsuario);
			}
		}

		if(empty($imagenUsuario)){
			$imagenUsuario="usernull.png";
		}
		//FIN IMAGEN
//echo "idusuario=".$idusuario;
		if (empty($idusuario)){

			$rspta=$Usuarios->insertar($idrazonSocial, $razonSocial, $ci, $cargoUsuario, $loginUsuario, $claveUsuario, $imagenUsuario);
			echo $rspta ? "El Usuario se ha Registrado con Exito" : "1";
			
		}
		else {
			$rspta=$Usuarios->editar($idusuario,$idrazonSocial, $razonSocial, $ci, $cargoUsuario, $loginUsuario, $claveUsuario, $imagenUsuario);
			//echo $rspta ? "El Usuario se Actualizo con Exito" : "1";
			echo $rspta;
		}
	break;

	case 'desactivar':
		$rspta=$Usuarios->desactivar($idusuario);
 		echo $rspta ? "Usuario Desactivado" : "Usuario no se puede desactivar";
	break;

	case 'activar':
		$rspta=$Usuarios->activar($idusuario);
 		echo $rspta ? "Usuario activado" : "Usuario no se puede activar";
	break;

	case 'mostrar':
		$rspta=$Usuarios->mostrar($idusuario);
 		//Codificar el resultado utilizando json
		 echo json_encode($rspta);

	break;



	case 'permiso':
	    require "../config/Conexion.php";

		//Obtenemos todos los permisos de la tabla permisos
		$sql="SELECT * FROM `Permisos`";
		$rspta=$conexion->query($sql);


		//Obtener los permisos asignados al usuario
		$id=$_GET['id'];
		$sql2="SELECT * FROM `Usuarios_Permisos` WHERE `idusuario`='$id' ";

		$marcados = $conexion->query($sql2);
		//Declaramos el array para almacenar todos los permisos marcados
		$valores=array();
		//Declaramos el array para almacenar todos los permisos marcados


		//Almacenar los permisos asignados al usuario en el array
		while ($per = $marcados->fetch_object())
			{
				array_push($valores, $per->codigoPermiso);
			}

			echo '<input type="checkbox" onclick="marcar(this);" /> Marcar/Desmarcar Todos
			<hr/>';


		//Mostramos la lista de permisos en la vista y si están o no marcados
		while ($reg = $rspta->fetch_object())
				{
					$sw=in_array($reg->codigoPermiso,$valores)?'checked':'';

					echo '<div class="form-check">
          <input type="checkbox" '.$sw.' name="codigoPermiso[]" class="form-check-input"   value="'.$reg->codigoPermiso.'"/>
          <label class="form-check-label">
					'.$reg->descripcionPermiso.'
          </label>
      </div>';
				}
	break;

	case 'listar':

		$rspta=$Usuarios->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
			$estadousuario=0;
			if ($reg->estado==="ACTIVO") {
				$estadousuario=1;
			}else {
				$estadousuario=0;
			}
 			$data[]=array(

				"0"=>($estadousuario)?'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow mr-3 btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Desactivar" data-placement="bottom" class="btn-shadow mr-3 btn btn-danger" onclick="desactivar('.$reg->idusuario.')"><i class="fa fa-times-circle"></i></button>':
				'<button type="button" data-toggle="tooltip" title="Editar registro" data-placement="bottom" class="btn-shadow mr-3 btn btn-warning" onclick="mostrar('.$reg->idusuario.')"><i class="fa fa-pen"></i></button>'.
				' <button type="button" data-toggle="tooltip" title="Activar" data-placement="bottom" class="btn-shadow mr-3 btn btn-success" onclick="activar('.$reg->idusuario.')"><i class="fa fa-check"></i></button>',
				 "1"=>$reg->usuario,
				 "2"=>$reg->razonsocial,
				 "3"=>$reg->ci,
				 "4"=>$reg->cargo,
 				"5"=>($estadousuario)?'<span class="badge badge-success mr-2 ml-0">Activo</span>':
 				'<span class="badge badge-danger mr-2 ml-0">Desactivado</span>'

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;


	case 'verificar':
		$login=$_POST['login'];
	  $clavea=$_POST['clavea'];

	  //Hash SHA256 en la contraseña
		// $clavehash=hash("SHA256",$clavea);
		//$clavehash=SED::encryption($clavea);

		$sql="SELECT * FROM usuario	WHERE usuario='$login' AND password='$clavea' AND estado='ACTIVO'";

		// $rspta=$Usuarios->verificar($login, $clavehash);
		$rspta=$conexion->query($sql);
		$fetch=$rspta->fetch_object();
		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idusuario']=$fetch->idusuario;
	        $_SESSION['razonsocial']=$fetch->razonsocial;
	        $_SESSION['imagenUsuario']=$fetch->imagenUsuario;
					$_SESSION['usuario']=$fetch->usuario;
					$_SESSION['cargoUsuario']=$fetch->cargo;
					$_SESSION['nombreSucursal']="CORONEL OVIEDO - PY";
					$_SESSION['numeropag']='2';
					$_SESSION['numeromiten']='2';

			//Obtenemos los permisos del usuario
			$marcados = $Usuarios->listarmarcados($fetch->idusuario);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->codigoPermiso);
				}

			//Determinamos los accesos del usuario
			in_array(1,$valores)?$_SESSION['Home']=1:$_SESSION['Home']=0;
			in_array(2,$valores)?$_SESSION['Administrador']=1:$_SESSION['Administrador']=0;
			in_array(3,$valores)?$_SESSION['Secretario']=1:$_SESSION['Secretario']=0;
			in_array(4,$valores)?$_SESSION['Caja']=1:$_SESSION['Caja']=0;
			in_array(5,$valores)?$_SESSION['AdministradorDeportivo']=1:$_SESSION['AdministradorDeportivo']=0;
			in_array(6,$valores)?$_SESSION['SecretarioDeportivo']=1:$_SESSION['SecretarioDeportivo']=0;
			in_array(7,$valores)?$_SESSION['TesoreroDeportivo']=1:$_SESSION['TesoreroDeportivo']=0;
			/*
			in_array(5,$valores)?$_SESSION['Sanciones']=1:$_SESSION['Sanciones']=0;
			in_array(7,$valores)?$_SESSION['logistico']=1:$_SESSION['logistico']=0;
			in_array(8,$valores)?$_SESSION['informe']=1:$_SESSION['informe']=0;
			in_array(9,$valores)?$_SESSION['CheckList']=1:$_SESSION['CheckList']=0;
			in_array(10,$valores)?$_SESSION['orden']=1:$_SESSION['orden']=0;
			in_array(11,$valores)?$_SESSION['Mantenimiento']=1:$_SESSION['Mantenimiento']=0;
			in_array(12,$valores)?$_SESSION['rescate']=1:$_SESSION['rescate']=0;
			in_array(13,$valores)?$_SESSION['Usuarios']=1:$_SESSION['Usuarios']=0;*/
			echo "ok";
		}


	break;
	case 'salir':
		//Limpiamos las variables de sesión
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");
	break;
	case 'controlsesion':
		if (isset($_SESSION['idusuario'])) {
			echo "1";
		}
	break;
	case 'listarPermisos':
	require "../config/Conexion.php";
	$sql="SELECT * FROM `Permisos`";
	$rspta=$conexion->query($sql);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				 "0"=>$reg->descripcionPermiso
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	case "VerificarName":

		$sql="SELECT * FROM `Usuarios` WHERE `loginUsuario`='$loginUsuario' ";
		$rspta=$conexion->query($sql);
		$reg = $rspta->fetch_object();
		if (empty($reg)){

		}else{
			echo $reg ? "1" : "1";
		}


	break;


	case "listarRazonSocial":

		$sql="SELECT * FROM `razonsocial` WHERE estado='ACTIVO'";
		$rspta=$conexion->query($sql);

		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
				"0"=>'<button class="btn btn-warning" data-dismiss="modal" onclick="AgregarRazonSocial('.$reg->idrazonsocial.',\''.$reg->razonsocial.'\',\''.$reg->ci.'\')"><span class="fa fa-plus"></span></button>',
				"1"=>$reg->razonsocial,
				"2"=>$reg->ci
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);
	break;

}
?>
