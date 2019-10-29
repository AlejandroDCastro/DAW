
/*Funciones para simplificar funciones de manipulación del DOM */
function $(selector) {
    return document.querySelector(selector);
}

function $$(selector, numero) {
    return document.querySelectorAll(selector)[numero];
}



// Función para hacer login correctamente
function comprobarLogin() {
    var nombre_ = $$("#formini>form>input", 0).value,
        password_ = $$("#formini>form>input", 1).value,
        devuelve_ = false;

    if (nombre_ != ""  &&  password_ != "") {
        var caracteres1_ = 0, caracteres2_ = 0;

        for (let i=0; i<nombre_.length || i<password_.length; i++) {
            caracteres1_ += (i<nombre_.length && nombre_.charAt(i)!=" ") ? 1 : 0;
            caracteres2_ += (i<password_.length && password_.charAt(i)!=" ") ? 1 : 0;
        }
        
        devuelve_ = (caracteres1_==0 || caracteres2_==0) ? false : true;
    }

    return devuelve_;
}



// Función para calcular el precio de un álbum y crear su tabla de represenciación
function calcularTabla() {
    var section_ = $("#solicitud>div>section:first-child"),
        new_table_ = creaEncabezados();

    // Calculamos y creamos los valores de las celdas...
    var td_ = undefined, tr_ = undefined, precio_pag_ = 0.10;
    for (let i=1; i<=15; i++) {
        tr_ = document.createElement("tr");
        for (let j=1; j<=6; j++) {
            td_ = document.createElement("td");
            switch (j) {
                case 1:
                    td_.textContent = i;
                    break;
                case 2:
                    td_.textContent = 3*i;
                    break;
                case 3:
                    td_.textContent = (i*precio_pag_).toPrecision(2);
                    break;
                case 4:
                    td_.textContent = (3*precio_pag_ + 3*i*0.02).toPrecision(2);
                    break;
                case 5:
                    td_.textContent = (3*precio_pag_ + 3*i*0.05).toPrecision(2);
                    break;
                case 6:
                    td_.textContent = (3*precio_pag_ + 3*i*0.05 + 3*i*0.02).toPrecision(2);
                    break;
            }
            if (i == 4) {
                precio_pag_ = 0.8;
            } else if (i == 11) {
                precio_pag_ = 0.7;
            }
            tr_.appendChild(td_);
        }
        new_table_.appendChild(tr_);
    }

    // Creamos el título de la tabla...
    var h2_ = document.createElement("h2");
    h2_.textContent = "Precios";

    // Insertamos en la página los elementos...
    section_.appendChild(h2_);
    section_.appendChild(new_table_);
}



// Función que crea las filas con el encabezado de la tabla de precios
function creaEncabezados() {
    var tabla_ = document.createElement("table"),
        tr_ = document.createElement("tr"),
        th_;

    // Primera fila...
    for (let i=1; i<=4; i++) {
        th_ = document.createElement("th");
        switch (i) {
            case 1:
            case 2:
                th_.textContent = "";
                break;
            case 3:
                th_.textContent = "Blanco y negro";
                th_.setAttribute("colspan", "2");
                break;
            case 4:
                th_.textContent = "Color";
                th_.setAttribute("colspan", "2");
                break;
        }
        tr_.appendChild(th_);
    }
    tabla_.appendChild(tr_);

    // Segunda fila...
    tr_ = document.createElement("tr");
    for (let i=1; i<=6; i++) {
        th_ = document.createElement("th");
        switch (i) {
            case 1:
                th_.textContent = "Número de páginas";
                break;
            case 2:
                th_.textContent = "Número de fotos";
                break;
            case 3:
            case 5:
                th_.textContent = "150-300 dpi";
                break;
            case 4:
            case 6:
                th_.textContent = "450-900 dpi";
                break;
        }
        tr_.appendChild(th_);
    }
    tabla_.appendChild(tr_);

    return tabla_;
}