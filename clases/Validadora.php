<?php
session_start();

class validadora
{
    public static function validarUsuario($usuario, $clave, $recordar)
    {
        if($usuario=="octavio@admin.com.ar" && $clave=="1234")
        {			
            if($recordar=="true")
            {
                setcookie("registro",$usuario,  time()+36000 , '/');

            }else
            {
                setcookie("registro",$usuario,  time()-36000 , '/');

            }
            $_SESSION['registrado']="octavio";
            $_SESSION['tiempo']= date("Y-m-d H:i:s");
            return true;


        }

        return false;
    }
    
    public static function validarSesionActual()
    {
        if(isset($_SESSION['registrado']))
        {
            $segundos = strtotime(date("Y-m-d H:i:s")) - strtotime($_SESSION['tiempo']);
            if ($segundos <= 5)
            {
                $_SESSION['tiempo']= date("Y-m-d H:i:s");
                return true;
            }
            
        }
        
        return false;
    }
}
?>