<?php
if (isset($_COOKIE['recuerdame'])) {
    $data = json_decode($_COOKIE['recuerdame'], true);
    $_SESSION['sesion'] = $data;
}

?>