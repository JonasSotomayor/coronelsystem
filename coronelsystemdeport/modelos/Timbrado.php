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
								$nroinicialTimbrado,
								$nrofinalTimbrado,
								$sucursalT)//recibimos estos parametros
		{
			$sql="INSERT INTO timbrado (nrotimbradovigente,vctoTimbrado,nroactualTimbrado,nroinicialTimbrado,nrofinalTimbrado,sucursalTimbrado)
			VALUES ($nrotimbradovigente,$vctoTimbrado,$nroactualTimbrado,$nroinicialTimbrado,$nrofinalTimbrado,$sucursalT)";//enviamos valores a los sgtes campos
			//return ejecutarConsulta($sql);
			//echo 'hola mundo';
			echo $sql;
		}

	//Implementamos un método para editar registros
	public function editar($codigoTimbrado,$nrotimbradovigente,$nroactualTimbrado,$vctoTimbrado,$nroinicialTimbrado,$nrofinalTimbrado,$sucursalT)
		{
			$sql="UPDATE timbrado SET 
                nrotimbradovigente='$nrotimbradovigente',
				nroactualTimbrado='$nroactualTimbrado',
                vctoTimbrado='$vctoTimbrado',
                nroinicialTimbrado='$nroinicialTimbrado',
                nrofinalTimbrado='$nrofinalTimbrado',
                sucursalTimbrado='$sucursalT'
                WHERE codigoTimbrado='$codigoTimbrado'";
			return ejecutarConsulta($sql);
		}

	//Implementamos un método para eliminar persona

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($codigoTimbrado)
		{
			$sql="SELECT * FROM timbrado WHERE codigoTimbrado='$codigoTimbrado'";
			return ejecutarConsultaSimpleFila($sql);
		}

    public function listar($sucursal)
        {
            $sql="SELECT * FROM `timbrado` WHERE `sucursalTimbrado`='$sucursal'";
            return ejecutarConsulta($sql);		
        }



}

?>