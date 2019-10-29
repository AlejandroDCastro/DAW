
/*Funciones para simplificar funciones de manipulación del DOM */
function $(selector) {
    return document.querySelector(selector);
}

function $$(selector, numero) {
    return document.querySelectorAll(selector)[numero];
}



// Sentencia que se ejecuta al cargar la página
document.addEventListener("DOMContentLoaded", load, false);


function load() {
    
}


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
