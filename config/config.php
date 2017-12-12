<?php
    function datosConexion()
    {
      $server = "localhost";
      $user = "root";
      $pass = "usbw";
      $db = "usadmin";

      $datos = array($server,$user,$pass,$db);
      return $datos;
    }

    function conectar()
    {
        $datos = datosConexion();
        $server = $datos[0];
        $user = $datos[1];
        $pass = $datos[2];
        $db = $datos[3];

        $mysqlConexion = new MySQLi($server,$user,$pass,$db);
        if($mysqlConexion->connect_errno)
        {
            die("ERROR : -> ".$mysqlConexion->connect_error);
        }
        return $mysqlConexion;
    }


    function formatoFecha($fecha)
    {
        $a = substr($fecha,0,4);
        $m = substr($fecha,5,2);
        $d = substr($fecha,8,2);
        $h = substr($fecha,11,8);
        $fecha = "$d-$m-$a $h";
        return $fecha;
    }

    function fechaExterna($fecha)
    {
        $a = substr($fecha,0,4);
        $m = substr($fecha,5,2);
        $d = substr($fecha,8,2);
        $fecha = "$d-$m-$a";
        return $fecha;
    }

    function fechaInterna($fecha)
    {
        $a = substr($fecha,6,4);
        $m = substr($fecha,3,2);
        $d = substr($fecha,0,2);
        $fecha = "$a-$m-$d";
        return $fecha;
    }

    function formatoFechaInterna($fecha)
    {
        $a = substr($fecha,6,4);
        $m = substr($fecha,3,2);
        $d = substr($fecha,0,2);
        $h = substr($fecha,11,8);
        $fecha = "$a-$m-$d $h";
        return $fecha;
    }

    function formatoFechaLetras($fecha,$mostrarHora="0")
    {
        $a = substr($fecha,0,4);
        $m = substr($fecha,5,2);
        $d = substr($fecha,8,2);
        $h = substr($fecha,11,8);

        $arregloFecha = getdate(mktime(0,0,0,$m,$d,$a));
        $dia = $arregloFecha["weekday"];
        $mes = $arregloFecha["month"];

        if($dia=="Monday"){
            $strDia = "Lunes";
        }else if($dia=="Tuesday"){
            $strDia = "Martes";
        }else if($dia=="Wednesday"){
            $strDia = "Miercoles";
        }else if($dia=="Thursday"){
            $strDia = "Jueves";
        }else if($dia=="Friday"){
            $strDia = "Viernes";
        }else if($dia=="Saturday"){
            $strDia = "Sabado";
        }else if($dia=="Sunday"){
            $strDia = "Domingo";
        }else{
            $strDia = "Desconocido";
        }

        if($mes=="January"){
            $strMes = "Enero";
        }else if($mes=="February"){
            $strMes = "Febrero";
        }else if($mes=="March"){
            $strMes = "Marzo";
        }else if($mes=="April"){
            $strMes = "Abril";
        }else if($mes=="May"){
            $strMes = "Mayo";
        }else if($mes=="June"){
            $strMes = "Junio";
        }else if($mes=="July"){
            $strMes = "Julio";
        }else if($mes=="August"){
            $strMes = "Agosto";
        }else if($mes=="September"){
            $strMes = "Septiembre";
        }else if($mes=="October"){
            $strMes = "Octubre";
        }else if($mes=="November"){
            $strMes = "Noviembre";
        }else if($mes=="December"){
            $strMes = "Diciembre";
        }else{
            $strMes = "Desconocido";
        }

        if($mostrarHora=="0"){
            $fecha = "$strDia $d de $strMes del $a";
        }else{
            $fecha = "$strDia $d de $strMes del $a a las $h";
        }
        return $fecha;
    }
?>
