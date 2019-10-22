<div id="background-index-top" class="background_parallax">
    <section class="col-4 margin_auto padding20">

        <h2 class="white text_shadow">Bienvenido <?php

            if (isset($_SESSION['sesion'])) {
                echo $_SESSION['sesion']['usuario'];
            }
            ?></h2>
    </section>
</div>