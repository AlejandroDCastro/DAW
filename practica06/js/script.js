
/*Funciones para simplificar funciones de manipulación del DOM */
function $(selector) {
    return document.querySelector(selector);
}

function $$(selector, numero) {
    return document.querySelectorAll(selector)[numero];
}



// Sentencia que se ejecuta al cargar la página
document.addEventListener("load", load, false);


function load() {
    
    // Control del formulario de inicio de sesión
    $("#formini>form").addEventListener("submit", comprobarLogin);
}


function comprobarLogin() {
    var nombre_ = $$("#formini>form>input", 0),
        password_ = $$("#formini>form>input", 1),
        devuelve_ = false;

    if (nombre_.value != ""  &&  password_.value != "") {
        let caracteres1_ = 0, caracteres2_ = 0;

        for (let i=0; i<nombre_.length && i<password_.length; i++) {
            caracteres1_ += (i<nombre_.length && nombre_.charAt(i)!=" ") ? 1 : 0;
            caracteres2_ += (i<password_.length && password_.charAt(i)!=" ") ? 1 : 0;
        }
        
        devuelve = (caracteres1_==nombre_.length && caracteres2_==password_.length) ? true : false;
    }

    return devuelve_;
}
