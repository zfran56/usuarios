<?php
    function existeUsuario($usuario){
        $idConexion = conectar();
        $sql = "select * from usuarios where usuario='$usuario'";
        $verificar = mysqli_query($idConexion, $sql);
        $nfilas = mysqli_num_rows($verificar);
        if($nfilas==0){
            $estado = "false";
        }else{
            $estado = "true";
        }
        return $estado;
    }

    function agregarUsuario($usuario,$nombre,$apellido,$password,$nivel,$estado,$fecha){
        $idConexion = conectar();
        $query = "INSERT INTO usuarios VALUES('$usuario','$nombre','$apellido','$password','$nivel','$estado','$fecha')";
        if(mysqli_query($idConexion, $query)){
            $estado = "true";
        }else{
            $estado = "false";
        }
        return $estado;
    }

    function modificarUsuario($usuario,$nombre,$apellido,$password,$nivel,$fecha){
        $idConexion = conectar();
        $query = "UPDATE usuarios SET nombre='$nombre',apellido='$apellido',nivel='$nivel',fecha='$fecha' ";
        if($password!=""){
            $query .= ",password='$password' ";
        }
        $query .= " WHERE usuario='$usuario'";
        if(mysqli_query($idConexion, $query)){
            $estado = "true";
        }else{
            $estado = "false";
        }
        return $estado;
    }


    function eliminarUsuario($usuario){
        $idConexion = conectar();
        $query = "DELETE from usuarios ";
        $query .= " where usuario='$usuario'";
        if(mysqli_query($idConexion, $query)){
            $estado = "true";
        }else{
            $estado = "false";
        }
        return $estado;
    }

    function cambiarEstadoUsuario($estado,$usuario){
        $idConexion = conectar();
        $query = "UPDATE usuarios SET estado='$estado' ";
        $query .= " WHERE usuario='$usuario'";
        if(mysqli_query($idConexion, $query)){
            $estado = "true";
        }else{
            $estado = "false";
        }
        return $estado;
    }

    function aDatosUsuario($usuario){
        $conexion = conectar();
        $query = mysqli_query($conexion,"select * from usuarios where usuario='$usuario'");
        $aDatos = mysqli_fetch_array($query);
        return $aDatos;
    }

    function nombreUsuario($usuario,$mostrarApellido="0"){
        $conexion = conectar();
        $aDatos = aDatosUsuario($usuario);
        if($mostrarApellido=="0"){
            $nombre = $aDatos["nombre"];
        }else{
            $nombre = $aDatos["nombre"]." ". $aDatos["apellido"];
        }
        return $nombre;
    }

    function logearUsuario($usuario,$password){
        $conexion = conectar();
        $password = md5($password);
        $query = mysqli_query($conexion,"select * from usuarios where usuario='$usuario' and password='$password' and estado='1'");
        $filas = mysqli_num_rows($query);
        mysqli_close($conexion);
        return $filas;
    }

    function nivelAccesoUsuario($usuario){
        $aDatos = aDatosUsuario($usuario);
        $nivel = $aDatos["nivel"];
        return $nivel;
    }


?>