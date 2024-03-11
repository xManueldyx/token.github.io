<?php
    include('conexion.php');
    function login($user, $password){
        $con = connect();
        $token = 'NULL';
        $password = md5($password);
        $query = 'SELECT * FROM usuarios WHERE user = "'.$user.'" AND password = "'.$password.'" LIMIT 1';
        $result  = $con->query($query);
        if($result) {
            date_default_timezone_set('America/Mexico_City');
            $fecha_nueva = date("Y-m-d H:i:s"); 
            $user = ('user');
            $password = ('password');
            $id = ('id');   
            $token = md5($user.$password.$fecha_nueva);
            $query = "UPDATE usuarios SET token = '$token', fecha_sesion = '$fecha_nueva' WHERE id=$id";
            $result2 = $con->query($query);
            if($result2)return $token;
        }
        return $token;
    }
    if($user = "manuel" && $pass = "manuel"){
        $token = login($_GET["user"], $_GET["pass"]);
        echo $token;
    }else{
        echo "usuario o contraseña incorrectos";
    }

    function consulta($token, $tabla){
        if($token){
            $con = connect();
            $query = 'SELECT * FROM usuarios WHERE token = "'.$token.'" LIMIT 1';
            $result  = $con->query($query);
            $fila = $result->fetch_assoc();
            if($fila){
                $query2 = 'SELECT * FROM '.$tabla;
                $result2  = $con->query($query2);
                if(!$result2)return 'no hay registros';
                $fila2 = $result2->fetch_assoc();
                if($fila2)return $fila2;
                return 'no hay registros de esa tabla: '.$tabla;
            }
            return 'token no valido';
        }
        return  'no envio token';
            
    }

    function logout($token){
        
    }