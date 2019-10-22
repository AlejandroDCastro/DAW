<div id="background-index-top" class="background_parallax">
    <section class="col-4 margin_auto padding20">

        <h2 class="white text_shadow">Iniciar sesión</h2>
        <form action="acceso.php" method="post">
            <label class="label_blanco text_shadow" for="usuario">Nombre de usuario</label>
            <input type="text" name="usuario" placeholder="Introduce tu usuario" required value>
            <br><br>
            <label class="label_blanco text_shadow" for="pass">Contraseña</label>
            <input id="input_pass_login" name="password" type="password" placeholder="Introduce tu password" required>

            <button type="submit" style="cursor:pointer;">Iniciar sesión</button>
            <div class="row">

                <div style="width:30%;">
                    <div style="float: left;margin-right: 5px">
                        <input type="checkbox" id="recuerdame" name="recuerdame" checked style="display:none"/>
                        <label for="recuerdame" class="toggle"><span></span></label>
                    </div>
                    <label class="fontSize white text_shadow col-3" style="float: left">Recuerdame</label>
                </div>

                <div class="fontSize white text_shadow col-7" style="float: right;">¿Todavía no tienes cuenta? <a
                            class="link" href="registro.php">Registrate aquí</a></div>
            </div>

        </form>
    </section>
</div>