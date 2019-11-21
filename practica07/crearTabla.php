<?php

    // Creamos el título de la tabla...
    echo '<h2>Precios</h2>';

    // Creamos la nueva tabla...
    echo '<table>';

    // Primera fila...
    echo '<tr>
            <th></th>
            <th></th>
            <th colspan="2">Blanco y negro</th>
            <th colspan="2">Color</th>
        </tr>';

    // Segunda fila...
    echo '<tr>
            <th>Número de páginas</th>
            <th>Número de fotos</th>
            <th>150-300 dpi</th>
            <th>450-900 dpi</th>
            <th>150-300 dpi</th>
            <th>450-900 dpi</th>
        </tr>';

    // Calculamos y creamos los valores de las celdas...
    $precio_pag_ = 0.10;
    $precio_ = 0;
    for ($i=1; $i<=15; $i++) {
        echo '<tr>';
        if ($i >= 5  &&  $i <= 11) {
            $precio_pag_ = 0.08;
        } elseif ($i > 11) {
            $precio_pag_ = 0.07;
        }
        $precio_ += $precio_pag_;
        for ($j=1; $j<=6; $j++) {
            switch ($j) {
                case 1:
                    echo '<td>', $i, '</td>';
                    break;
                case 2:
                    echo '<td>', 3*$i, '</td>';
                    break;
                case 3:
                    echo '<td>', round($precio_, 2), '</td>';
                    break;
                case 4:
                    echo '<td>', round($precio_ + (3*$i)*0.02, 2), '</td>';
                    break;
                case 5:
                    echo '<td>', round($precio_ + (3*$i)*0.05, 2), '</td>';
                    break;
                case 6:
                    echo '<td>', round($precio_ + ((3*$i)*0.05) + ((3*$i)*0.02), 2), '</td>';
                    break;
            }
        }
        echo '</tr>';
    }

    echo '</table>';

?>