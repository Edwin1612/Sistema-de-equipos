<?php
    $id = $_GET["id"];
    $stmt =	Datos::deleteEquipo($id);
    header("Location: index.php?action=ListadoEquipo");
?>