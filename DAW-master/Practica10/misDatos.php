<?php
if (isset($_COOKIE['sesion'])) {
    header('Location:' . 'index.php');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>Modificar mis datos | myAlbum</title>
    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<body>
<?php
include('header.php');
?>

<div id="background-misDatos" class="background_parallax">
    <?php
    if (isset($_GET['error'])) {

        if ($_GET['error'] == 'user') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El usuario no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'pass') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El password no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'pass_repeat') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El password no es igual</h1>";
        }
        if ($_GET['error'] == 'old_pass') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El password antiguo no es correcto</h1>";
        }
        if ($_GET['error'] == 'email') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El email no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'ciudad') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>La ciudad no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'sexo') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El sexo no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'estilo') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El estilo no tiene un formato válido</h1>";
        }
        if ($_GET['error'] == 'pais') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El pais no existe en la BD</h1>";
        }
        if ($_GET['error'] == 'img') {
            echo "<br><h1 style='color:white; text-transform: uppercase; padding: 0.3em; font-size: 1.5em; background-color: #ff2856; text-align:center;'>El formato de la img no es valido</h1>";
        }
    }
    ?>
    <section class="col-4 margin_auto padding20">
        <h2 class="text_shadow" style="color:red;">
        </h2>
        <h2 class="white text_shadow">Modificar mis datos</h2>
        <form enctype="multipart/form-data" action="resMisDatos.php" method="post">
            <div class="row">
                <div style="float:left;padding: 0 4% 0 0%;" class="col-6">
                    <label>
                        <label class="label_blanco text_shadow">Nombre de usuario</label>
                        <?php
                        require("conexionBD.php");
                        $id = mysqli_real_escape_string($conexion, $_SESSION['sesion']['IdUsuario']);
                        $sql = "SELECT * FROM USUARIOS WHERE IdUsuario='$id'";
                        $resultado = $conexion->query($sql);
                        $resultado_fetch = $resultado->fetch_assoc();

                        $nombre = $resultado_fetch['NomUsuario'];
                        $email = $resultado_fetch['Email'];
                        $sexo = $resultado_fetch['Sexo'];
                        $fecha = $resultado_fetch['FNacimiento'];
                        $estilo = $resultado_fetch['Estilo'];
                        $ciudad = $resultado_fetch['Ciudad'];
                        $pais = $resultado_fetch['Pais'];

                        echo "<input type='text' name='usuario' placeholder='$nombre' required>";
                        ?>
                </div>
                <div style="float:left;" class="col-6 top_none">
                    <br id="br_none">
                    <label>
                        <label style="float:left;" class="label_blanco text_shadow">Contraseña actual</label>
                        <input type="password" name="old_password" placeholder="**********"
                               style="width: 100%"></label>
                </div>
            </div>
            <br>

            <div class="row">
                <div style="float:left;padding: 0 4% 0 0%;" class="col-6">
                    <label>
                        <label class="label_blanco text_shadow">Nueva contraseña</label>
                        <input type="password" name="new_password" placeholder="**********"
                               style="width: 100%"></label>
                </div>
                <div style="float:left;" class="col-6 top_none">
                    <br id="br_none">
                    <label>
                        <label style="float:left;" class="label_blanco text_shadow">Verificar contraseña</label>
                        <input type="password" name="password_repeat" placeholder="**********"
                               style="width: 100%"></label>
                </div>
            </div>
            <br>

            <label class="label_blanco text_shadow" for="email">Correo electrónico</label>

            <?php
            echo "<input type='email' name='email' placeholder='$email' required>";
            ?>
            <br><br>

            <div class="row">
                <div style="float:left; padding: 0 4% 0 0%;margin-bottom: 1em" class="col-6">
                    <label class="label_blanco text_shadow">Género</label>
                    <div class="select">
                        <select name="gender">
                            <?php
                            if ($sexo == "hombre") {
                                echo "<option value='hombre' selected>Hombre</option><option value='mujer'>Mujer</option><option value='otro'>Otro</option>";
                            }
                            if ($sexo == "mujer") {
                                echo "<option value='hombre'>Hombre</option><option value='mujer' selected>Mujer</option><option value='otro'>Otro</option>";
                            }
                            if ($sexo == "otro") {
                                echo "<option value='hombre'>Hombre</option><option value='mujer'>Mujer</option><option value='otro' selected>Otro</option>";
                            }
                            ?>

                        </select></div>
                </div>
                <div style="float:left;" class="col-6">
                    <label class="label_blanco text_shadow" for="FNacimiento">Fecha nacimiento</label>

                    <?php
                    echo "<input type='date' required name='fecha_nacimiento' value='$fecha'>";
                    ?>
                </div>
            </div>



            <label class="label_blanco text_shadow">Estilo</label>
            <div class="select">
                <select required name="estilos">
                    <?php
                    if ($estilo == "1") {
                        echo "<option value='1' selected>Estilo responsive</option>";
                        echo "<option value='2'>Estilo alto contraste</option>";
                    }
                    if ($estilo == "2") {
                        echo "<option value='1'>Estilo responsive</option>";
                        echo "<option value='2' selected>Estilo alto contraste</option>";
                    }
                    ?>
                </select>
            </div>
            <br><br>

            <div  style="margin-bottom: 1em" class="row">
                <div style="float:left; padding: 0 4% 0 0%;" class="col-6">
                    <label>
                        <label class="label_blanco text_shadow">Ciudad</label>
                        <?php
                        echo "<input required type='text' name='ciudad' placeholder='$ciudad' style='width: 100%'></label>";
                        ?>

                </div>
                <div style="float:left;" class="col-6">
                    <br id="br_none">
                    <label class="label_blanco text_shadow">País</label>
                    <div class="select">
                        <select required name="paises">
                            <?php
                            $sql = "SELECT * FROM PAISES";
                            $resultados = $conexion->query($sql);

                            while ($fila = $resultados->fetch_assoc()) {

                                $id_fila_pais = $fila['IdPais'];
                                $fila_pais = $fila['NomPais'];

                                if ($fila['IdPais'] == $pais)
                                    echo "<option value='$id_fila_pais' selected>$fila_pais</option>";
                                else {
                                    echo "<option value='$id_fila_pais'>$fila_pais</option>";
                                }
                            }
                            ?>

                        </select></div>
                </div>
            </div>
            <br id="br_none">
            <label id="add-computer-button" for="fileupload" class="upload_file_btn">Sube tu foto
            </label>
            <input id="fileupload" required type="file" multiple="multiple" name="input_foto" accept="image/jpeg"
                   style="visibility: hidden">
            <button type="submit" style="cursor:pointer;">Guardar cambios</button>


        </form>
    </section>
</div>
</body>
</html>