<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/conexion.php";

Class Timbrado 
{
	//Implementamos nuestro constructor
	public function __construct()
		{

		}

	//Implementamos un método para insertar registros		nroactualTimbrado
	public function insertar($nrotimbradovigente,
								$vctoTimbrado,
								$nroactualTimbrado,
								$prefijoTimbrado,
								$nroinicialTimbrado,
								$nrofinalTimbrado,
								$tipoTimbrado
								)//recibimos estos parametros
		{
			$sql="INSERT INTO timbrado (`codigoTimbrado`,
			`nrotimbradovigente`,
			`vctoTimbrado`,
			`prefijoTimbrado`,
			`nroactualTimbrado`,
			`nroinicialTimbrado`,
			`nrofinalTimbrado`,
			`tipoTimbrado`,
			`estadoTimbrado`)
			VALUES (0,$nrotimbradovigente,
			'$vctoTimbrado','$prefijoTimbrado',$nroactualTimbrado,$nroinicialTimbrado,$nrofinalTimbrado,'$tipoTimbrado',1)";//enviamos valores a los sgtes campos
			
			//echo 'hola mundo';
			//echo $sql;
			return ejecutarConsulta($sql);
		}

	//Implementamos un método para editar registros
	public function editar($codigoTimbrado,$nrotimbradovigente,
	$vctoTimbrado,
	$nroactualTimbrado,
	$prefijoTimbrado,
	$nroinicialTimbrado,
	$nrofinalTimbrado,
	$tipoTimbrado)
		{
			$sql="UPDATE `timbrado`
			SET
			`nrotimbradovigente` = $nrotimbradovigente,
			`vctoTimbrado` = $vctoTimbrado,
			`prefijoTimbrado` = $prefijoTimbrado,
			`nroactualTimbrado` = $nroactualTimbrado,
			`nroinicialTimbrado` = $nroinicialTimbrado,
			`nrofinalTimbrado` =$nrofinalTimbrado,
			`tipoTimbrado` = '$tipoTimbrado'
			WHERE `codigoTimbrado` ='$codigoTimbrado'";
			return ejecutarConsulta($sql);
		}

	//Implementamos un método para eliminar persona

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($codigoTimbrado)
		{
			$sql="SELECT * FROM timbrado WHERE codigoTimbrado='$codigoTimbrado'";
			return ejecutarConsultaSimpleFila($sql);
		}

    public function listar()
        {
            $sql="SELECT * FROM `timbrado`";
            return ejecutarConsulta($sql);		
        }



}

?>