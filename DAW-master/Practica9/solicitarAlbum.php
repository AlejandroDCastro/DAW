<!DOCTYPE html>
<html lang="es">
<head>

    <title>Solicitar álbum | myAlbum</title>
    <?php
    include("eleccionEstilo.php");
    ?>
</head>
<?php
include('header.php');
?>


<div id="background-album-top" class="background_parallax">

    <div class="col-4 margin_auto padding20">
        <div class="info-album-interior">
            <h2 class="white">Tarifas</h2>

            <table id="tarifas">
                <tr>
                    <th>Concepto</th>
                    <th>Tarifa</th>
                </tr>
                <tr>
                    <td>< 5 páginas</td>
                    <td>0.10€ por pág.</td>
                </tr>
                <tr>
                    <td>entre 5 y 10 páginas</td>
                    <td>0.08€ por pág.</td>
                </tr>
                <tr>
                    <td>> 11 páginas</td>
                    <td>0.07€ por pág.</td>
                </tr>
                <tr>
                    <td>Blanco y negro</td>
                    <td>0€</td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td>0.05€ por foto</td>
                </tr>
                <tr>
                    <td>Resolucion > 300dpi</td>
                    <td>0.02€ por foto</td>
                </tr>
            </table>
        </div>
    </div>
    <br>
</div>

<div id="backgroud-album-bot" id="back_album" class="background_parallax">
    <div class="col-8 margin_auto">
        <br>
        <h2 class="white">Solicitar álbum</h2>
        <form action="resAlbum.php" method="post"
        ">
        <div class="row">
            <div style="float:left;" class="col-6 padding_input4">
                <label>
                    <label class="label_blanco text_shadow">Nombre y apellidos</label>
                    <input type="text" name="nombre" placeholder="Pedro Perez" style="width: 100%" required></label>
            </div>
            <div style="float:left;" class="col-6 padding_input_top">
                <br id="br_none">

                <label class="label_blanco text_shadow" for="album">Album</label>
                <div class="select">
                    <select name="album">
                        <?php
                        require("rellenarAlbumes.php");

                        ?>

                    </select></div>
            </div>
        </div>
        <br>

        <label class="label_blanco text_shadow" for="usuario">Texto adicional</label>
        <textarea name="texto_extra" rows="4" cols="80">Escribe tu información extra</textarea>
        <br><br>


        <div class="row">

            <div style="float:left;" class="col-4-special padding_input4_5 padding_input_top">
                <label>
                    <label class="label_blanco text_shadow">Correo electrónico</label>
                    <input type="text" placeholder="pedro@gmail.com" style="width: 100%" name="email"></label>
            </div>
            <div style="float:left;" class="col-4-special padding_input4_5 padding_input_top">
                <label>
                    <br id="br_none">
                    <label class="label_blanco text_shadow">Dirección de la calle</label>
                    <input type="text" placeholder="Ronda de las parcelas nº10" style="width: 100%" name="direccion"></label>
            </div>
            <div style="float:left;" class="col-4-special padding_input_top">
                <label>
                    <br id="br_none">
                    <label class="label_blanco text_shadow">Código postal</label>
                    <input type="number" placeholder="03350" style="width: 100%"></label>
            </div>
        </div>
        <br>

        <div class="row">
            <div style="float:left; width:48%;" class="col-2 padding_input4">
                <label class="label_blanco text_shadow">Provincia</label>
            </div>
            <div style="float:left; width:48%;" class="col-2">
                <label class="label_blanco text_shadow">País</label>
            </div>
            <div style="float:left; width:48%;" class="col-2 padding_input4">
                <div class="select">
                    <select>
                        <option value="provincia1">Provincia 1</option>
                        <option value="provincia2">Provincia 2</option>
                        <option value="provincia3">Provincia 3</option>
                        <option value="provincia4">Provincia 4</option>
                    </select></div>
            </div>
            <div style="float:left; width:48%;" class="col-2">
                <div class="select">
                    <select>
                        <?php
                        require("rellenarPaises.php");
                        ?>
                    </select></div>
            </div>
        </div>
        <br>


        <div class="row">
            <div style="float:left;" class="col-4-special padding_input4_5 padding_input_top">
                <label>
                    <label class="label_blanco text_shadow">Color</label>
                    <input style="width: 100%" type="color">
            </div>
            <div style="float:left;" class="col-4-special padding_input4_5 padding_input_top">
                <label>
                    <br id="br_none">
                    <label class="label_blanco text_shadow">Número de copias</label>
                    <input name="copias" type="number" value="1" style="width: 100%"></label>
            </div>
            <div style="float:left;" class="col-4-special padding_input_top">
                <label>
                    <br id="br_none">
                    <label class="label_blanco text_shadow">Resolución de las fotos</label>
                    <input required type="number" name="resolucion" name="resolucion" min="150" max="900" step="150"
                           value="150">
            </div>
        </div>
        <br>

        <div class="row">
            <div style="float:left;padding-right: 4%" class="col-6">
                <label>
                    <br id="br_none">
                    <label class="label_blanco text_shadow">Fecha de recepcion</label>
                    <input type="date" style="width: 100%"></label>
            </div>
            <div style="float: right;" class="col-6">
                <br id="br_none">
                <label class="label_blanco text_shadow">Impresión a color</label>
                <div class="select">
                    <select style="float: right;" name="impresion">
                        <option value="bn">Blanco y negro</option>
                        <option value="color">Color</option>
                    </select></div>
            </div>
        </div>
        <br>
        <div class="row">
            <button type="submit" style="cursor:pointer;">Solicitar</button>
        </div>
        </form>
        <br>
    </div>
</div>
</body>
</html>