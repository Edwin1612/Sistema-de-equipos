<?php
    $id = $_GET["id"];
    $stmt =	Datos::deleteAdmi($id);
    header("Location: index.php?action=ListadoAdministradores");
?>