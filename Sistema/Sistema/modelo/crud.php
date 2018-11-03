<?php

require_once("conexion.php");
//session_start();


class Datos extends Conexion{
        
    #Registro de usuarios
    public function registroUsuarioModel($datosModel){

        $carrera= (int)$datosModel["carrera"];
        $tutor= (int)$datosModel["tutor"];
        $stmt = Conexion::conectar()->prepare("INSERT INTO alumnos (nombre, situacion, correo, idCarrera, idTutor,imagen) VALUES(:nombre, :situacion,
        :correo ,:idCarrera,:idTutor,:imagen) ");
        
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":situacion", $datosModel["situacion"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":idCarrera", $carrera);
        $stmt->bindParam(":idTutor", $tutor);
        $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }

        $stmt->close();

    }

    public function AddTutor($datosModel)
    {
        $carrera= (int)$datosModel["carrera"];
        $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios (nombre,correo,contrasena,foto,tipoUsuario,idCarrera) 
        VALUES(:nombre,:correo,:contrasena,:foto,2,:idCarrera) ");
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["correo"] , PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $datosModel["contrasena"] , PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datosModel["foto"] , PDO::PARAM_STR);
        $stmt->bindParam(":idCarrera", $carrera);
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }

    public function AddEquipo($datosModel)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO equipos (nombre,tipoEquipo) VALUES(:nombre,:tipo) ");
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datosModel["tipoEquipo"] , PDO::PARAM_STR);
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }
  
    public function AddJugadorSelecion($datosModel)
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from selecion WHERE idJugador=:id');
        $stmt->bindParam(":id",$datosModel["jugador"]);
        $stmt->execute();
        $result = $stmt->fetch();
      
        if($result["count(*)"]<3)
        {
            $stmt3 = Conexion::conectar()->prepare('SELECT count(*) from vista_selecion WHERE idJugador=:id && tipo="Soccer"');
            $stmt3->bindParam(":id",$datosModel["jugador"]);
            $stmt3->execute();
            $result2 = $stmt3->fetch();
            if($result2["count(*)"]<1)
            {
              $stmt2 = Conexion::conectar()->prepare("INSERT INTO selecion (idJugador,idEquipo) VALUES(:jugador,:equipo) ");
              $stmt2->bindParam(":jugador", $datosModel["jugador"] );
              $stmt2->bindParam(":equipo", $datosModel["equipo"] );
              $stmt2->execute();
              return "success";
            }else
            {
              $stmt3 = Conexion::conectar()->prepare('SELECT count(*) from vista_selecion WHERE idJugador=:id && tipo="Basquetbol"');
              $stmt3->bindParam(":id",$datosModel["jugador"]);
              $stmt3->execute();
              $result2 = $stmt3->fetch();
              if($result2["count(*)"]<1)
              {
                $stmt2 = Conexion::conectar()->prepare("INSERT INTO selecion (idJugador,idEquipo) VALUES(:jugador,:equipo) ");
                $stmt2->bindParam(":jugador", $datosModel["jugador"] );
                $stmt2->bindParam(":equipo", $datosModel["equipo"] );
                $stmt2->execute();
                return "success";
              }else
              {
                $stmt3 = Conexion::conectar()->prepare('SELECT count(*) from vista_selecion WHERE idJugador=:id && tipo="Volibol"');
                $stmt3->bindParam(":id",$datosModel["jugador"]);
                $stmt3->execute();
                $result2 = $stmt3->fetch();
                if($result2["count(*)"]<1)
                {
                  $stmt2 = Conexion::conectar()->prepare("INSERT INTO selecion (idJugador,idEquipo) VALUES(:jugador,:equipo) ");
                  $stmt2->bindParam(":jugador", $datosModel["jugador"] );
                  $stmt2->bindParam(":equipo", $datosModel["equipo"] );
                  $stmt2->execute();
                  return "success";
                }
                
              }
            }
          
        }
    }

    public function addSeg($datosModel)
    {
        $myid=$_SESSION["idUsuario"];
        $stmt = Conexion::conectar()->prepare('INSERT INTO sesiones (fecha,idAlumno,idUsuario,notacion,idSes) 
        VALUES(NOW(),:idAlumno, :idUsuario,:notacion,:idSes) ');
        $stmt->bindParam(":idAlumno", $datosModel["idAlumno"] , PDO::PARAM_STR);
        $stmt->bindParam(":idUsuario", $myid);
        $stmt->bindParam(":notacion", $datosModel["notacion"] , PDO::PARAM_STR);
        $stmt->bindParam(":idSes", $datosModel["idSesion"]);
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }




    public function AddJugador($datosModel)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO jugadores (nombre,ruta_img) 
        VALUES(:nombre,:ruta)");
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":ruta", $datosModel["foto"] , PDO::PARAM_STR);
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }

    public function AddAdministrador($datosModel)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios (nombre,correo,contrasena,tipoUsuario) 
        VALUES(:nombre,:correo,:contrasena,0)");
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["correo"] , PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $datosModel["contrasena"] , PDO::PARAM_STR);
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }

    public function AddDepartamento($datosModel)
    {
        $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios (nombre,correo,contrasena,tipoUsuario) 
        VALUES(:nombre,:correo,:contrasena,1)");
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["correo"] , PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $datosModel["contrasena"] , PDO::PARAM_STR);
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function EditarEquipo($datosModel)
    {
        $id= (int)$datosModel["id"];
        $stmt = Conexion::conectar()->prepare("UPDATE equipos SET nombre=:nombre, tipoEquipo=:tipo WHERE idEquipo=:id");
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datosModel["tipoEquipo"] , PDO::PARAM_STR);
        $stmt->bindParam(":id", $id);
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }

    public function editarJugador($datosModel)
    {
        $stmt = Conexion::conectar()->prepare("UPDATE jugadores SET 
        nombre=:nombre,tipoJugador=:tipo, ruta_img=:foto,idEquipo=:equipo WHERE idJugador=:id");
        $stmt->bindParam(":nombre", $datosModel["nombre"]);
        $stmt->bindParam(":tipo",$datosModel["tipo"] , PDO::PARAM_STR);
        $stmt->bindParam(":foto",$datosModel["foto"] , PDO::PARAM_STR);
        $stmt->bindParam(":equipo", $datosModel["equipo"]);
        $stmt->bindParam(":id", $datosModel["id"]);
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }

    public function EditarTutor($datosModel)
    {
        $id= (int)$datosModel["id"];
        $carrera= (int)$datosModel["carrera"];
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET 
        nombre=:nombre,correo=:correo,contrasena=:contrasena, foto=:foto,idCarrera=:idCarrera WHERE idUsuario=:id");
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":correo",$datosModel["correo"] , PDO::PARAM_STR);
        $stmt->bindParam(":contrasena",$datosModel["contrasena"] , PDO::PARAM_STR);
        $stmt->bindParam(":foto", $datosModel["foto"] , PDO::PARAM_STR);
        $stmt->bindParam(":idCarrera", $carrera);
        $stmt->bindParam(":id", $id);
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }

    public function editarAdministrador($datosModel)
    {
        $id= (int)$datosModel["id"];
        $stmt = Conexion::conectar()->prepare("UPDATE usuarios SET 
        nombre=:nombre,correo=:correo,contrasena=:contrasena WHERE idUsuario=:id");
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["correo"] , PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $datosModel["contrasena"] , PDO::PARAM_STR);
        $stmt->bindParam(":id", $id);
        if($stmt->execute()){
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }

    public function editarUsuarioModel($datosModel){

        $carrera= (int)$datosModel["carrera"];
        $tutor= (int)$datosModel["tutor"];
        $id= (int)$datosModel["id"];
        $stmt = Conexion::conectar()->prepare("UPDATE alumnos  SET nombre=:nombre, situacion=:situacion, correo=:correo, idCarrera=:idCarrera, idTutor=:idTutor,imagen=:imagen  WHERE idAlumno=:id ");
        
        $stmt->bindParam(":nombre", $datosModel["nombre"] , PDO::PARAM_STR);
        $stmt->bindParam(":situacion", $datosModel["situacion"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $datosModel["correo"], PDO::PARAM_STR);
        $stmt->bindParam(":idCarrera", $carrera);
        $stmt->bindParam(":idTutor", $tutor);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_STR);

        if($stmt->execute()){
            return 1;
        }else{
            return 0;
        }

        $stmt->close();

    }
//////////////////////////////////////////////////////////////////////////////////////////////////
    public function getUsuariosLogin($datos)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuarios WHERE correo=:correo && contrasena=:contrasena');
        $stmt->bindParam(":correo", $datos["correo"] , PDO::PARAM_STR);
        $stmt->bindParam(":contrasena", $datos["contrasena"] , PDO::PARAM_STR);
        if($stmt->execute())
        {
            $respuesta = $stmt->rowCount();
            $resultado =$stmt->fetch();
            session_start();
            $_SESSION["correo"]=$resultado["correo"];
            $_SESSION["nombre"]=$resultado["nombre"];
            $_SESSION["idUsuario"]=$resultado["idUsuario"];
            $_SESSION["contrasena"]=$resultado["contrasena"];
            $_SESSION["foto"]=$resultado["foto"];
            $_SESSION["tipoUsuario"]=$resultado["tipoUsuario"];
            $_SESSION["idCarrera"]=$resultado["idCarrera"];

            return $respuesta;
        }else
        {
            return "error";
        }
        
    }

    public function getReporteSesiones($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from sesiones WHERE idUsuario=:id && idSes=0 && idGrupal=0');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        return $stmt;
    }

    
    
    public function getAdministradores()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuarios WHERE tipoUsuario=0');
        $stmt->execute();
        return $stmt;
    }

    public function getDepartamento()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuarios WHERE tipoUsuario=1');
        $stmt->execute();
        return $stmt;
    }

    public function getAdministradoresID($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuarios WHERE tipoUsuario=0 && idUsuario=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getEquipos()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from equipos');
        $stmt->execute();
        return $stmt;
    }

    public function getCorreo($correo)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuarios WHERE correo=:correo');
        $stmt->bindParam(":correo",$correo);
        $stmt->execute();
        if($stmt->rowCount()>0)
        {
            return "repetido";
        }else
        {
            return "success";
        }
        
    }

    public function getJugadores()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from jugadores');
        $stmt->execute();
        return $stmt;
    }
  
     public function getSelecionesJug()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from vista_selecion');
        $stmt->execute();
        return $stmt;
    }

    public function getResiones()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from sesiones WHERE idSes=0');
        $stmt->execute();
        return $stmt;
    }
    
    public function getTutorID($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuarios where idUsuario=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function getJugadoresID($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from jugadores where idJugador=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    
    public function getEquipoID($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from equipos where idEquipo=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function MisTutorados()
    {
        $id=$_SESSION["idUsuario"];
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from alumnos where idUsuario=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    public function GetMisTutorados()
    {
        $id=$_SESSION["idUsuario"];
        $stmt = Conexion::conectar()->prepare('SELECT *from alumnos where idUsuario=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        return $stmt;
    }

    public function SessionesActivas()
    {
        $id=$_SESSION["idUsuario"];
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from sesiones where idUsuario=:id && idSes!=0');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    public function SessionesFinalizadaid($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from sesiones where idUsuario=:id && idSes!=0 && estado="finalizada"');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function deleteUsuario($id)
    {
        $stmt = Conexion::conectar()->prepare('DELETE from usuarios where idUsuario=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
    }

    public function deleteJugador($id)
    {
        $stmt = Conexion::conectar()->prepare('DELETE FROM jugadores WHERE idJugador=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
    } 

    public function deleteEquipo($id)
    {
        $stmt = Conexion::conectar()->prepare('DELETE from equipos where idEquipo=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
    } 

    public function deleteAdmi($id)
    {
        $stmt = Conexion::conectar()->prepare('DELETE from usuarios where idUsuario=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
    } 


    public function countAlumnos()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from alumnos');
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    } 

    public function countTutores()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from usuarios where tipoUsuario=1');
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    } 

    public function countAdmin()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from usuarios where tipoUsuario=0');
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    }

    public function countCarreras()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from carreras');
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    }
///////////////////////////////
    public function countTutoradosID($id)
    {
        
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from alumnos WHERE idAlumno=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    } 

    public function countTutoresID()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from usuarios where tipoUsuario=1');
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    } 

    public function countAdminID()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from usuarios where tipoUsuario=0');
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    }

    public function countCarrerasID()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from carreras');
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    }

    public function countAlumnoSesiones($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from sesiones WHERE idAlumno=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    }

    public function countAlumnoReportes($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from sesiones WHERE idAlumno=:id && idSes != 0');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    }
  
    public function countGrupales()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from sesiones WHERE idGrupal!=0');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    }
  
    public function countIndividual()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from sesiones WHERE idGrupal=0');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    }
  
    public function countReporteGrupales()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from sesiones WHERE idGrupal!=0 && idSes=0');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    }
    public function countReporteIndi()
    {
        $stmt = Conexion::conectar()->prepare('SELECT count(*) from sesiones WHERE idGrupal=0 && idSes!=0');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $resultado=$stmt->fetch();
        return $resultado;
    }
   /* public function IniciarSesionModel($datosModel)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuario WHERE usuario=:usuario && contrasena=:contrasea');
        $stmt->bindParam(":usuario", $datosModel["usuario"] , PDO::PARAM_STR);
        $stmt->bindParam(":contrasea", $datosModel["password"], PDO::PARAM_STR);
        $stmt->execute();
        if($stmt->rowCount()==1){
            session_start();
            $_SESSION["usuario"]=$datosModel["usuario"];
            $_SESSION["contrasena"]=$datosModel["password"];
            return "success";
        }else{
            return "error";
        }
        $stmt->close();
    }

    public function getUsuarios()
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuario');
        $stmt->execute();
        return $stmt;
    }

    public function getUsuariosID($id)
    {
        $stmt = Conexion::conectar()->prepare('SELECT *from usuario where idUsuario=:id');
        $stmt->bindParam(":id",$id);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
    //Metodo que con mediante setencias sql con PDO se editan datos, agrege el MD5 por seguridad ya que envio la contraseña de la sesion por get, para que no puedan
    //obtener la contraseña de una manera facil
    public function updateUsuariosModel($datosModel)
    {
            $stmt = Conexion::conectar()->prepare("UPDATE usuario SET usuario=:usuario, contrasena=:contrasena, correo=:correo WHERE idUsuario=:id");
            $stmt->bindParam(":usuario",$datosModel["usuario"]);
            $stmt->bindParam(":contrasena",$datosModel["contrasena"]);
            $stmt->bindParam(":correo",$datosModel["correo"]);
            $stmt->bindParam(":id",$datosModel["id"]);
            if($stmt->execute())
            {
                return "success";
            }
            else 
            { return "error";}
    }
    //Metodo que elimina al usuario con sentencia sql y PDO , al igual que el de editar se agrega la contraseña para saber si sera capaz de poder elimianr la info
    public function eliminarUsuario($datosModel){
        if(MD5($datosModel["Pas1"])== $datosModel["Pas2"])
        {
            $stmt = Conexion::conectar()->prepare("DELETE FROM usuario WHERE idUsuario=:id");
            $stmt->bindParam(":id",$datosModel["id"]);
            if($stmt->execute())
            {
                return "success";
            }
        }else
        {
            return "error";
        }

    }*/

}