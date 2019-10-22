<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificación de datos completado | myAlbum</title>

    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('header.php');
?>

<div id="background-resMisDatos" class="background_parallax">
    <section class="col-4 margin_auto padding20">
        <br><br>
        <?php
        require("conexionBD.php");
        $datosCorrectos = true;

        $exp_regular = "/^[A-Za-z0-9_-]{4,10}$/";
        $exp_regular_pass = "/^[A-Za-z0-9_-]{6,13}$/";
        $exp_regular_ciudad = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";

        $usuario = $_POST['usuario'];
        if(!preg_match($exp_regular, $usuario)){
            header('Location: misDatos.php?error=user');
            $datosCorrectos=false;
        }

        if($_FILES["input_foto"]["type"] != "image/jpeg")
        {
            header('Location: misDatos.php?error=img');
            $datosCorrectos=false;
        }

        $tmp_name = $_FILES["input_foto"]["tmp_name"];
        $name_img = basename($_FILES["input_foto"]["name"]);
        $fichero_subido = $usuario . ".jpg";
        move_uploaded_file($tmp_name, "img/$fichero_subido");

        $old_pass = $_POST['old_password'];
        $pass = $_POST['new_password'];
        $pass_repeat = $_POST['password_repeat'];
        if(!preg_match($exp_regular_pass, $pass) || !preg_match($exp_regular_pass, $pass_repeat) || !preg_match($exp_regular_pass, $old_pass)){
            header('Location: misDatos.php?error=pass');
            $datosCorrectos=false;
        }

        $email = $_POST['email'];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header('Location: misDatos.php?error=email');
            $datosCorrectos=false;
        }
        $ciudad = $_POST['ciudad'];
        if(!preg_match($exp_regular_ciudad, $ciudad)){
            header('Location: misDatos.php?error=ciudad');
            $datosCorrectos=false;
        }
        $pais = $_POST['paises'];
        $array = array();

        $flag = false;
        $sql_paises = "SELECT IdPais FROM paises";
        $paises = $conexion->query($sql_paises);
        while ($fila = $paises->fetch_assoc()) {
            $array[] = $fila['IdPais'];
        }
        foreach ($array as $valor) {
            if($valor==$pais){
                $flag = true;
            }
        }

        if(!$flag){
            header('Location: misDatos.php?error=pais');
            $datosCorrectos=false;
        }

        $sexo = $_POST['gender'];
        if($sexo!="hombre" && $sexo!="mujer" && $sexo!="otro"){
            header('Location: misDatos.php?error=sexo');
            $datosCorrectos=false;
        }
        $estilo = $_POST['estilos'];
        if($estilo!="1" && $estilo!="2"){
            header('Location: misDatos.php?error=estilo');
            $datosCorrectos=false;
        }
        $fechaN = $_POST['fecha_nacimiento'];


        $id = mysqli_real_escape_string($conexion, $_SESSION['sesion']['IdUsuario']);

        $sql = "SELECT Clave FROM usuarios WHERE IdUsuario = $id;";
        $result_pass = $conexion->query($sql);
        $result_fetch_pass = $result_pass->fetch_assoc();

        if($result_fetch_pass['Clave'] == $old_pass){
            if ($pass != $pass_repeat) {
                header('Location: misDatos.php?error=pass_repeat');
                $datosCorrectos=false;
            }
            else if($datosCorrectos==true){
                $esc_usuario = mysqli_real_escape_string($conexion,$usuario);
                $esc_pass = mysqli_real_escape_string($conexion, $pass);
                $esc_email = mysqli_real_escape_string($conexion, $email);
                $esc_ciudad = mysqli_real_escape_string($conexion, $ciudad);
                $esc_pais = mysqli_real_escape_string($conexion, $pais);
                $esc_sexo = mysqli_real_escape_string($conexion, $sexo);
                $esc_estilo = mysqli_real_escape_string($conexion, $estilo);
                $esc_fechaN = mysqli_real_escape_string($conexion, $fechaN);

                $sql = "UPDATE usuarios
                SET NomUsuario = '$esc_usuario',
                    Clave = '$esc_pass',
                    Email = '$esc_email',
                    Sexo = '$esc_sexo',
                    FNacimiento = '$esc_fechaN',
                    Ciudad = '$esc_ciudad',
                    Pais = '$esc_pais',
                    Foto = '$fichero_subido',
                    Estilo = '$esc_estilo'
                WHERE IdUsuario = '$id'";

                if ($conexion->query($sql) === TRUE) {
                    echo "<h2 class=\"white text_shadow\">Modificación correcta</h2>";
                    echo "<h2 class=\"white text_shadow\">Tus datos son:</h2>";
                    echo "<p style='color:white;'>Usuario: " . $usuario . "</p>";
                    echo "<p style='color:white;'>Password: " . $pass . "</p>";
                    echo "<p style='color:white;'>Email: " . $email . "</p>";
                    echo "<p style='color:white;'>Ciudad: " . $ciudad . "</p>";
                    echo "<p style='color:white;'>Pais: " . $pais . "</p>";
                    echo "<p style='color:white;'>Sexo: " . $sexo . "</p>";
                    echo "<p style='color:white;'>Estilo: " . $estilo . "</p>";
                    echo "<p style='color:white;'>Fecha: " . $fechaN . "</p>";
                    echo "<p style='color:white;'>Foto: " . $name_img . "</p>";
                } else {
                    echo "<h2 class=\"white text_shadow\">La modificación ha sido incorrecta</h2>";
                }
            }
        }else{
            header('Location: misDatos.php?error=old_pass');
        }
        ?>
        <br><br>
    </section>
</div>

</body>
</html>