<?php
    $id = $_GET["id"];
    $stmt =	Datos::deleteJugador($id);
    header("Location: index.php?action=ListadoJugadores");
?>