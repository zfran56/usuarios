<?php
    session_start();
    require("../config/config.php");
    require("../config/usuarios_config.php");

	$idConexion = conectar();
	$jsondata = array();
	$jsondataList = array();

    $filtro = "";
    if(isset($_GET["filtro"])){
        $filtro = $_GET["filtro"];
    }

    $parametro = "";

    if(isset($_GET['param1'])){
        $parametro = $_GET['param1'];
    }

    if(isset($_POST['param1'])){
        $parametro = $_POST["param1"];
    }

	if($parametro=="cuantos")
	{
		$myquery = "SELECT COUNT(*) total FROM usuarios where nombre LIKE '%$filtro%' or apellido LIKE '%$filtro%' or usuario LIKE '%$filtro%'";
		$resultado = mysqli_query($idConexion,$myquery);
		$fila = mysqli_fetch_array($resultado);
		$jsondata['total'] = $fila['total'];
	}
	elseif($parametro=="dame")
	{
		$myquery = "SELECT * FROM usuarios where nombre LIKE '%$filtro%' or apellido LIKE '%$filtro%' or usuario LIKE '%$filtro%' LIMIT ". $_GET['limit'] ." OFFSET ". $_GET["offset"];
		$resultado = mysqli_query($idConexion,$myquery);
		while($fila = mysqli_fetch_array($resultado))
		{
			$jsondataperson = array();
			$jsondataperson["id"] = $fila["usuario"];
			$jsondataperson["nombre"] = $fila["nombre"];
			$jsondataperson["apellido"] = $fila["apellido"];

            if($fila["estado"]=="0"){
                $estadoE = base64_encode("1");
                $iconoEstado = "<a href=\"javascript:cambiarEstado('$estadoE','$fila[usuario]');\" style='color:#7E7563;' title='Activar Cuenta'> <i class=\"glyphicon glyphicon-user\"></i><b>Desactivada</b></a>";
            }else{
                $estadoE = base64_encode("0");
                $iconoEstado = "<a href=\"javascript:cambiarEstado('$estadoE','$fila[usuario]');\" style='color:#008F00;' title='Desactivar Cuenta'> <i class=\"glyphicon glyphicon-user\"></i><b>Activada</b></a>";
            }

            $iconoAcciones = "
            <button type=\"button\" id=\"btnEditar\" name=\"btnEditar\" class=\"btn btn-primary\" onclick=\"javascript:editarRegistro('$fila[usuario]');\"><i class=\"glyphicon glyphicon-pencil\"></i></button>
            <button type=\"button\" id=\"btnEliminar\" name=\"btnEliminar\" class=\"btn btn-danger\" onclick=\"javascript:confirmarRegistro('$fila[usuario]');\"><i class=\"glyphicon glyphicon-trash\"></i></button>
            ";

			$jsondataperson["estado"] = $iconoEstado;
			$jsondataperson["nivel"] = $fila["nivel"];
			$jsondataperson["iconos"] = $iconoAcciones;
			$jsondataList[]=$jsondataperson;
		}
		$jsondata["lista"] = array_values($jsondataList);
	}else if($parametro=="cambiar"){
        $estado = "";
        if(isset($_GET["estado"])){
            $estado = base64_decode($_GET["estado"]);
        }
        $usuario = "";
        if(isset($_GET["usuario"])){
            $usuario = $_GET["usuario"];
        }

        if($usuario==$_SESSION["user_logeado"]){
                $jsondata["estado"] = false;
                $jsondata["mensaje"] = "No se puede cambiar el estado al usuario actual";
        }else{
            if(cambiarEstadoUsuario($estado,$usuario)){
                $jsondata["estado"] = true;
                $jsondata["mensaje"] = "Se cambio el estado";
            }else{
                $jsondata["estado"] = false;
                $jsondata["mensaje"] = "Error interno consulte con el administrador";
            }
        }
	}else if($parametro=="agregar"){
        if($_POST){
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $nivel = $_POST["nivel"];
            $hoy = date("Y-m-d H:i:s");

            if(existeUsuario($usuario)=="true"){
                $jsondata["estado"] = false;
                $jsondata["mensaje"] = "Este usuario ya existe";
            }else{
                if(agregarUsuario($usuario,$nombre,$apellido,md5($password),$nivel,"1",$hoy)=="true"){
                    $jsondata["estado"] = true;
                    $jsondata["mensaje"] = "Datos almacenados con exito";
                }else{
                    $jsondata["estado"] = false;
                    $jsondata["mensaje"] = "No se pudo registrar los datos";
                }
            }

        }else{
            $jsondata["estado"] = false;
            $jsondata["mensaje"] = "No se enviaron datos por post";
        }
	}else if($parametro=="ver"){
	    $usuario = "";
        if(isset($_GET["usuario"])){
            $usuario = $_GET["usuario"];
        }
        $aDatosUsuario = aDatosUsuario($usuario);
        $jsondata["estado"] = true;
        $jsondata["mensaje"] = "Datos Recuperados";
        $jsondata["usuario"] = $aDatosUsuario["usuario"];
        $jsondata["nombre"] = $aDatosUsuario["nombre"];
        $jsondata["apellido"] = $aDatosUsuario["apellido"];
        $jsondata["nivel"] = $aDatosUsuario["nivel"];
	}else if($parametro=="modificar"){
        if($_POST){
            $nombre = $_POST["nombre"];
            $apellido = $_POST["apellido"];
            $usuario = $_POST["usuario"];
            $password = $_POST["password"];
            $nivel = $_POST["nivel"];
            $cambiar = $_POST["cambiar"];
            if($cambiar=="true"){
                $elPass = md5($password);
            }else{
                $elPass = "";
            }
            $hoy = date("Y-m-d H:i:s");

            if(modificarUsuario($usuario,$nombre,$apellido,$elPass,$nivel,$hoy)=="true"){
                $jsondata["estado"] = true;
                $jsondata["mensaje"] = "Datos modificados con exito";
            }else{
                $jsondata["estado"] = false;
                $jsondata["mensaje"] = "No se pudo modificar los datos";
            }
        }else{
            $jsondata["estado"] = false;
            $jsondata["mensaje"] = "No se enviaron datos por post";
        }
	}else if($parametro=="eliminar"){
        $usuario = "";
        if(isset($_POST["usuario"])){
            $usuario = $_POST["usuario"];
        }
        if(eliminarUsuario($usuario)=="true"){
            $jsondata["estado"] = true;
            $jsondata["mensaje"] = "Datos eliminados con exito";
        }else{
            $jsondata["estado"] = false;
            $jsondata["mensaje"] = "No se pudo eliminar los datos";
        }
	}
    //header("Content-type:application/json; charset = utf-8");
    echo json_encode($jsondata);
?>