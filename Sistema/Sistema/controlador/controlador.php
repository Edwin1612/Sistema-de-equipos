<?php
class MvcControlador
{
    public function Plantilla()
    {
        include "vista/plantilla.php";
    }

    public function login()
    {
        include("vista/modulos/login.php");
    }

    public function enlacesPaginasControlador()
    {
        if(isset($_GET['action'])){
            //guardar el valor de la variable action en views/modules/navegacion.php en el cual se recibe mediante el metodo get esa variable
            $enlaces = $_GET['action'];
        }else{
            //Si viene vacio inicializo con index
            $enlaces = "index";
        }
        $respuesta = Paginas::enlacesPaginasModel($enlaces);

        include $respuesta;
        
    }

    public function agregarUsuario()
    {
        if(isset($_POST["usuarioRegistro"]) && isset($_POST["passwordRegistro"]))
        {
            $datos = array("usuario"=>$_POST["usuarioRegistro"] , "contrasena"=>$_POST["passwordRegistro"]);
            $respuesta = Paginas::agregarUsuarioModelo($datos);
        }
        
    }

    public function Log()
    {
        if(isset($_POST["correo"]) && isset($_POST["pass"]))
        {
            $datos = array("correo"=>$_POST["correo"] , "contrasena"=>$_POST["pass"]);
            $respuesta = Datos::getUsuariosLogin($datos);
            return $respuesta;
        }
        
    }
//////////////////////////////////////
    public function AddEquipo()
    {
        if(isset($_POST["nombre"]) && isset($_POST["tipoEquipo"]))
        {
            $datos = array("nombre"=>$_POST["nombre"] , "tipoEquipo"=>$_POST["tipoEquipo"]);
            print_r($datos);
            $respuesta = Datos::AddEquipo($datos);
            return $respuesta;
        }
        
    }

    public function AddJugador()
    {
        if(isset($_POST["nombre"]) && isset($_FILES['foto']))
        {
            $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
            $max_tamanyo = 1024 * 1024 * 8;
            if ( in_array($_FILES['foto']['type'], $extensiones) ) {
                //echo 'Es una imagen';
                if ( $_FILES['foto']['size']< $max_tamanyo ) {
                     //echo 'Pesa menos de 1 MB';
                }
           }

           $ruta_indexphp = dirname(realpath(__FILE__));
            $ruta_fichero_origen = $_FILES['foto']['tmp_name'];
            $ruta_nuevo_destino = 'imagenes/' .rand(1,1000000). $_FILES['foto']['name'];
            if ( in_array($_FILES['foto']['type'], $extensiones) ) {
                //echo 'Es una imagen';
                if ( $_FILES['foto']['size']< $max_tamanyo ) {
                    //echo 'Pesa menos de 1 MB';
                    if( move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino ) ) {
                    }
                }
            }
            $datos = array("nombre"=>$_POST["nombre"] , "foto"=>$ruta_nuevo_destino);
            $respuesta = Datos::AddJugador($datos);
            print_r($datos);
            return $respuesta;
        }
        
    }

    public function AddAdministrador()
    {
        if(isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["contrasena"]))
        {
            $respuesta = Datos::getCorreo($_POST["correo"]);
            if($respuesta=="success")
            {   
                $datos = array("nombre"=>$_POST["nombre"] , "correo"=>$_POST["correo"],"contrasena"=>$_POST["contrasena"]);
                print_r($datos);
                $respuesta = Datos::AddAdministrador($datos);
                return $respuesta;
            }else
            {
                return $respuesta;
            }

            
        }
        
    }
  
    public function AddJugadorSelecion()
    {
        if(isset($_POST["jugador"]) && isset($_POST["equipo"]))
        {
            
            $datos = array("jugador"=>$_POST["jugador"] , "equipo"=>$_POST["equipo"]);
            print_r($datos);
            $respuesta = Datos::AddJugadorSelecion($datos);
            return $respuesta;

            
        }
        
    }




        
//////////////////////////////////////////////////
   

    public function editarJugador()
    {
        if(isset($_POST["nombre"]) && isset($_POST["tipo"]) && isset($_FILES['foto']) && isset($_POST["equipo"]) && isset($_GET["id"]))
        {
            $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
            $max_tamanyo = 1024 * 1024 * 8;
            if ( in_array($_FILES['foto']['type'], $extensiones) ) {
                //echo 'Es una imagen';
                if ( $_FILES['foto']['size']< $max_tamanyo ) {
                     //echo 'Pesa menos de 1 MB';
                }
           }

           $ruta_indexphp = dirname(realpath(__FILE__));
            $ruta_fichero_origen = $_FILES['foto']['tmp_name'];
            $ruta_nuevo_destino = 'imagenes/' .rand(1,1000000). $_FILES['foto']['name'];
            if ( in_array($_FILES['foto']['type'], $extensiones) ) {
                //echo 'Es una imagen';
                if ( $_FILES['foto']['size']< $max_tamanyo ) {
                    //echo 'Pesa menos de 1 MB';
                    if( move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino ) ) {
                        echo 'Fichero guardado con éxito';
                    }
                }
            }

            $datos = array("nombre"=>$_POST["nombre"],"foto"=>$ruta_nuevo_destino,
            "tipo"=>$_POST["tipo"],"equipo"=>$_POST["equipo"],"id"=>$_GET["id"]);
            print_r($datos);
            $respuesta = Datos::editarJugador($datos);
            return $respuesta;
        }
        
    }

    public function EditarEquipo()
    {
        if(isset($_POST["nombre"]) && isset($_POST["tipoEquipo"]) && isset($_GET["id2"]))
        {
            $datos = array("nombre"=>$_POST["nombre"] , "tipoEquipo"=>$_POST["tipoEquipo"], "id"=>$_GET["id2"]);
            $respuesta = Datos::EditarEquipo($datos);
          
            return $respuesta;
        }
        
    }

    public function editarAdministrador()
    {
        if(isset($_POST["nombre"]) && isset($_POST["correo"]) && isset($_POST["contrasena"]) && isset($_GET["id"]))
        {
            $datos = array("nombre"=>$_POST["nombre"] , "correo"=>$_POST["correo"], "contrasena"=>$_POST["contrasena"],"id"=>$_GET["id"]);
            $respuesta = Datos::editarAdministrador($datos);
            print_r($datos);
            return $respuesta;
        }
        
    }
}
?>