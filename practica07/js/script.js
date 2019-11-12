// Variables globales
var ordenacion_inicial_;
var articles_inicial_;


// Funciones para simplificar funciones de manipulación del DOM
function $(selector) {
    return document.querySelector(selector);
}

function $All(selector) {
    return document.querySelectorAll(selector);
}

function $$(selector, numero) {
    return document.querySelectorAll(selector)[numero];
}



// Funciones para facilitar el acceso a las cookies
function setCookie(c_name, value, expiredays) { 
    var exdate = new Date(); 
    exdate.setDate(exdate.getDate() + expiredays); 
    document.cookie = c_name + "=" + escape(value) + ((expiredays == null) ? "" : ";expires="+ exdate.toGMTString()); 
}

function getCookie(c_name) { 
    if(document.cookie.length > 0) { 
        c_start = document.cookie.indexOf(c_name + "="); 
        if(c_start != -1) { 
            c_start = c_start + c_name.length + 1; 
            c_end = document.cookie.indexOf(";", c_start); 
                if(c_end == -1) 
                    c_end = document.cookie.length; 
            return unescape(document.cookie.substring(c_start, c_end)); 
        } 
    }
    return "";
}


document.addEventListener("DOMContentLoaded", load, false);



// Función que se ejecuta cuando se carga el DOM de la página web
function load() {

    // En función de la página en la que nos encontremos...
    switch (location.href) {
        case "http://localhost/DAW/practicaOptativaJS/solicitud.html":
        case "http://localhost/DAW/practicaOptativaJS/solicitud.html?":
        case "http://localhost/DAW/practicaOptativaJS/solicitud.html#cabecera":
            calcularTabla();
            break;
        case "http://localhost/DAW/practicaOptativaJS/":
        case "http://localhost/DAW/practicaOptativaJS/index.html":
        case "http://localhost/DAW/practicaOptativaJS/index.html?":
        case "http://localhost/DAW/practicaOptativaJS/index.html#cabecera":
            $("#formini>form").onsubmit = function() {
                return comprobarLogin();
            };
            break;
        case "http://localhost/DAW/practicaOptativaJS/registro.html":
        case "http://localhost/DAW/practicaOptativaJS/registro.html?":
        case "http://localhost/DAW/practicaOptativaJS/registro.html#cabecera":
            $("#formulario").onsubmit = function() {
                return comprobarRegistro();
            };
            break;
        case "http://localhost/DAW/practicaOptativaJS/resultado.html":
        case "http://localhost/DAW/practicaOptativaJS/resultado.html?":
        case "http://localhost/DAW/practicaOptativaJS/resultado.html#cabecera":
            $("#ordenacion>select").addEventListener("change", determinaOrdenacion);
            break;
    }
    
    $("header>select").addEventListener("change", cambiaEstilo);
    // En cualquier página...
    var estilo_seleccionado_ = getCookie("estilo");
    console.log("get: " + getCookie("estilo"));
    if (estilo_seleccionado_ != null  &&  estilo_seleccionado_ != "") {
        $("header>select").value = estilo_seleccionado_;
        cambiaEstilo();
    }
   
}




// Función para hacer login correctamente mediante expresiones regulares
function comprobarLogin() {
    var nombre_ = $$("#formini>form>input", 0).value,
        password_ = $$("#formini>form>input", 1).value,
        expValida_ = new RegExp("[!-~]"),
        respuesta_ = "", devuelve_;

    if (nombre_ == "") {
        respuesta_ = "Nombre: Campo vacío.\n";
    } else if (!expValida_.test(nombre_)) {
        respuesta_ = "Nombre: Cadena inválida.\n";
    }
    if (password_ == "") {
        respuesta_ += "Password: Campo vacío.";
    } else if (!expValida_.test(password_)) {
        respuesta_ += "Password: Cadena inválida.";
    }

    if (respuesta_ != "") {
        devuelve_ = false;
        alert(respuesta_);
    } else {
        devuelve_ = true;
    }
    
    return devuelve_;
}




// Función para calcular el precio de un álbum y crear su tabla de represenciación
function calcularTabla() {
    var section_ = $("#solicitud>div>section:first-child"),
        new_table_ = creaEncabezados();

    // Calculamos y creamos los valores de las celdas...
    var td_ = undefined, tr_ = undefined, precio_pag_ = 0.10, precio_ = 0;
    for (let i=1; i<=15; i++) {
        tr_ = document.createElement("tr");
        if (i >= 5  &&  i <= 11) {
            precio_pag_ = 0.08;
        } else if (i > 11) {
            precio_pag_ = 0.07;
        }
        precio_ += precio_pag_;
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
                    td_.textContent = precio_.toFixed(2);
                    break;
                case 4:
                    td_.textContent = (precio_ + (3*i)*0.02).toFixed(2);
                    break;
                case 5:
                    td_.textContent = (precio_ + (3*i)*0.05).toFixed(2);
                    break;
                case 6:
                    td_.textContent = (precio_ + ((3*i)*0.05) + ((3*i)*0.02)).toFixed(2);
                    break;
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



// Función para cambiar el estilo del sitio web
function cambiaEstilo() {
    var estilo_ = $("header>select").value,
        arrayEstilos_ = document.getElementsByTagName("link");

        console.log("Cambia estilo " + estilo_);
    for (let i=0; i<arrayEstilos_.length; i++) {

        // Sólo aquellas etiquetas link que hacen referencia a un estilo 
        // y que no sea para impresión...
        if (arrayEstilos_[i].getAttribute("rel") != null  &&  arrayEstilos_[i].getAttribute("rel").indexOf("stylesheet") != -1  &&  arrayEstilos_[i].getAttribute("media") == null) {
            arrayEstilos_[i].disabled = true;

            // Si tiene título es un estilo preferido o alternativo, 
            // si no tiene título es un estilo 
            // predeterminado y siempre tiene que utilizarse...
            if ((arrayEstilos_[i].getAttribute("title") != null  &&  arrayEstilos_[i].getAttribute("title") == estilo_)  ||  arrayEstilos_[i].getAttribute("href").indexOf("style.css") != -1) {
                arrayEstilos_[i].disabled = false;
                console.log(arrayEstilos_[i].getAttribute("href"));
                // Guardamos en una cookie el estilo de la web durante 45 días...
                if (arrayEstilos_[i].getAttribute("href").indexOf("style.css") == -1) {
                    setCookie("estilo", estilo_, 45);
                    console.log("setCookie: " + getCookie("estilo"));
                }
            } else {
                arrayEstilos_[i].disabled = true;
            }
        }
    }
}



// Función para comprobar que el registro se realiza correctamente, mediante expresiones regulares
function comprobarRegistro() {
    var nombre_ = $$("#formulario>div>input", 0).value,
        password_ = $$("#formulario>div>input", 1).value,
        password2_ = $$("#formulario>div>input", 2).value,
        email_ = $$("#formulario>div>input", 3).value,
        hombre_ = $$("#formulario>div>input", 4).checked,
        mujer_ = $$("#formulario>div>input", 5).checked,
        fecha_ = $$("#formulario>div>input",6).value,
        respuesta_ = "", devuelve_, expValida_;

    // Nombre de usuario...
    expValida_ = new RegExp("^[A-Za-z][A-Za-z0-9]{2,14}$");
    if (nombre_ != "") {
        respuesta_ = (expValida_.test(nombre_)) ? "" : " - Nombre de usuario: Cadena inválida.";
    } else {
        respuesta_ = " - Nombre de usuario: Campo vacío.";
    }

    // Password...
    expValida_ = new RegExp("^(?=\\w*\\d)(?=\\w*[A-Z])(?=\\w*[a-z])[\\w-]{6,15}$");
    if (password_ != "") {
        respuesta_ += (expValida_.test(password_)) ? "" : "\n - Contraseña: Cadena inválida.";
    } else {
        respuesta_ += "\n - Contraseña: Campo vacío.";
    }

    // Repetir password...
    if (password2_ != "") {
        respuesta_ += (password_ == password2_) ? "" : "\n - Repetir contraseña: La contraseña no coincide.";
    } else {
        respuesta_ += "\n - Repetir contraseña: Campo vacío.";
    }

    // Dirección de email...
    //expValida_ = new RegExp("^(?!^\\.)(?!.*\\.$)(?!.*?\\.\\.)[\\w!#$%&'*+\\-\\/=?^`{|}~.]{0,64}[^\\.]@[a-zA-Z0-9\\-]{0,63}(?!@\\-)(?:\\.(?!\\-).*)(?:\\.*(?!\\-))$");
    expValida_ = new RegExp("^(?!^\\.)(?!.*\\.$)(?!.*?\\.\\.)[\\w!#$%&'*+\\-\\/=?^`{|}~.]{0,64}[^\\.]@[a-zA-Z0-9\\-]+(?:\\.(?!\\-)[a-zA-Z0-9\\-]+(?!\\-)){0,63}(?!@\\-)$");
    if (email_ != "") {
        respuesta_ += (expValida_.test(email_)) ? "" : "\n - Dirección de email: Cadena inválida.";
    } else {
        respuesta_ += "\n - Dirección de email: Campo vacío.";
    }

    // Sexo...
    if (mujer_ == false  &&  hombre_ == false) {
        respuesta_ += "\n - Sexo: Selecciona una opción.";
    }

    // Fecha de nacimiento...
    if (fecha_ != "") {

        //Comprobamos que el formato de la fecha este bien escrito.
        var dmy = fecha_.split(/[/,.-\s]+/);
        if(dmy.length != 3)
        {
            respuesta_ += "\n - Fecha de nacimiento: El formato de la fecha es incorrecto.";
        } else {

            //Comprobamos que se usen solo numeros.
            var pasa_ = true;
            for(let i = 0; i < dmy.length;i++)
            {
                for(let j = 0;j < dmy[i].length;j++)
                {
                    let numero = dmy[i].charAt(j);
                    if((!(numero >= '0' && numero <= '9')))
                    {
                        respuesta_ += "\n - Fecha de nacimiento: El formato de la fecha es incorrecto.";
                        pasa_ = false;
                    }
                }
            }

            if (pasa_) {
                var dia = dmy[0], mes = dmy[1], anyo = dmy[2];
                mes--;

                //Convertimos la fecha pasada por el usuario a tipo date.
                var date = new Date(anyo,mes,dia);
                //Sacamos la fecha actual para compararla.
                var dateActual = new Date();

                //Comprobamos que no meta una fecha de nacimiento futura.
                var pasa2_ = true;
                if((dateActual.getFullYear() < date.getFullYear())
                    ||(dateActual.getFullYear() == date.getFullYear() && dateActual.getMonth() < date.getMonth())
                    || (dateActual.getFullYear() == date.getFullYear() && dateActual.getMonth() == date.getMonth()) && dateActual.getDate() < date.getDate())
                {
                    respuesta_ += "\n - Fecha de nacimiento: La fecha de nacimiento no puede ser mayor que la actual.";
                    pasa2_ = false;
                }

                if (pasa2_) {

                    //Comprobamos la validez de la fecha introducida por el usuario.
                    if(!(dia == date.getDate()) && (mes == date.getMonth()) && (anyo == date.getFullYear()))
                    {
                        respuesta_ += "\n - Fecha de nacimiento: La fecha es incorrecta.";
                    }
                }
            }
        }
    } else {
        respuesta_ += "\n - Fecha de nacimiento: Campo vacío.";
    }


    // Informamos al usuario si es necesario...
    if (respuesta_ != "") {
        devuelve_ = false;
        alert(respuesta_);
    } else {
        devuelve_ = true;
    }
    
    return devuelve_;
}



// Función para determinar la ordenación de las fotos obtenidas como resultado de búsqueda.
function determinaOrdenacion() {
    var select_ = $("#ordenacion>select").value,
        ordenacion_ = select_.split("-"),
        seccionfoto_ = $("main>section>section>div"),
        section_ = $("main>section>section"),
        parametro_ = 0, nueva_seccion_;

    // Guardamos la ordenacion por defecto...
    if (ordenacion_inicial_ == undefined) {
        ordenacion_inicial_ = seccionfoto_.cloneNode(true);
        articles_inicial_ = $All("main>section>section>div>article");
    }

    switch (ordenacion_[0]) {
        case "t":
            parametro_ = 3;
            break;
        case "f":
            parametro_ = 5;
            break;
        case "a":
            parametro_ = 7;
            break;
        case "p":
            parametro_ = 9;
            break;
    }

    if (parametro_ != 0) {
        if (ordenacion_[0] == "t"  ||  ordenacion_[0] == "a"  ||  ordenacion_[0] == "p") {
            if (ordenacion_[1] == "a") {
                nueva_seccion_ = ordenarFotosAscendente(parametro_);
            } else {
                nueva_seccion_ = ordenarFotosDescendente(parametro_);
            }
        } else if (ordenacion_[0] == "f") {
            if (ordenacion_[1] == "a") {
                nueva_seccion_ = ordenarPorFechaAscendente(parametro_);
            } else {
                nueva_seccion_ = ordenarPorFechaDescendente(parametro_);
            }
        }
    } else {
        nueva_seccion_ = ordenacion_inicial_;
    }
    
    section_.removeChild(seccionfoto_);
    section_.appendChild(nueva_seccion_);
}



// Función para ordenar las fotos ascendentemente en función de parámetros que son string
function ordenarFotosAscendente(numero) {
    var nueva_seccion_ = document.createElement("div"),
        articles_ = articles_inicial_,
        titulo_, new_titulo_;

    for (let i=0; i<articles_.length; i++) {
        if (i == 0) {
            nueva_seccion_.appendChild(articles_[i].cloneNode(true));
        } else {
            for (let j=0; j<nueva_seccion_.children.length; j++) {
                if (numero == 3) {
                    titulo_ = articles_[i].childNodes[3].childNodes[0].textContent;
                    new_titulo_ = nueva_seccion_.childNodes[j].childNodes[3].childNodes[0].textContent;
                } else {
                    titulo_ = articles_[i].childNodes[numero].textContent;
                    new_titulo_ = nueva_seccion_.childNodes[j].childNodes[numero].textContent;
                }
                if (titulo_.localeCompare(new_titulo_) == -1) {
                    nueva_seccion_.insertBefore(articles_[i].cloneNode(true), nueva_seccion_.childNodes[j]);
                    break;
                } else if (titulo_.localeCompare(new_titulo_) == 1  &&  j == nueva_seccion_.children.length-1) {
                    nueva_seccion_.appendChild(articles_[i].cloneNode(true));
                }
            }
        }
    }
    nueva_seccion_.setAttribute("class", "seccionfoto");

    return nueva_seccion_;
}




// Función para ordenar las fotos descendentemente en función de parámetros que son string
function ordenarFotosDescendente(numero) {
    var nueva_seccion_ = document.createElement("div"),
        articles_ = articles_inicial_,
        titulo_, new_titulo_;

    for (let i=0; i<articles_.length; i++) {
        if (i == 0) {
            nueva_seccion_.appendChild(articles_[i].cloneNode(true));
        } else {
            for (let j=nueva_seccion_.children.length-1; j>=0; j--) {
                if (numero == 3) {
                    titulo_ = articles_[i].childNodes[3].childNodes[0].textContent;
                    new_titulo_ = nueva_seccion_.childNodes[j].childNodes[3].childNodes[0].textContent;
                } else {
                    titulo_ = articles_[i].childNodes[numero].textContent;
                    new_titulo_ = nueva_seccion_.childNodes[j].childNodes[numero].textContent;
                }

                if (titulo_.localeCompare(new_titulo_) == -1) {
                    nueva_seccion_.insertBefore(articles_[i].cloneNode(true), nueva_seccion_.childNodes[++j]);
                    break;
                } else if (j == 0) {
                    nueva_seccion_.insertBefore(articles_[i].cloneNode(true), nueva_seccion_.childNodes[j]);
                }
            }
        }
    }
    nueva_seccion_.setAttribute("class", "seccionfoto");

    return nueva_seccion_;
}




// Función para ordenar las fotos en función de la fecha de manera ascendente
function ordenarPorFechaAscendente(numero) {
    var nueva_seccion_ = document.createElement("div"),
        articles_ = articles_inicial_,
        fecha_, new_fecha_;

    for (let i=0; i<articles_.length; i++) {
        if (i == 0) {
            nueva_seccion_.appendChild(articles_[i].cloneNode(true));
        } else {
            for (let j=0; j<nueva_seccion_.children.length; j++) {
                fecha_ = articles_[i].childNodes[numero].textContent;
                new_fecha_ = nueva_seccion_.childNodes[j].childNodes[numero].textContent;
                var pasa_ = compararFechas(fecha_, new_fecha_);
                if (fecha_ != new_fecha_) {
                    if (!pasa_) {
                        nueva_seccion_.insertBefore(articles_[i].cloneNode(true), nueva_seccion_.childNodes[j]);
                        break;
                    } else if (pasa_  &&  j == nueva_seccion_.children.length-1) {
                        nueva_seccion_.appendChild(articles_[i].cloneNode(true));
                    }
                } else {
                    break;
                }
                if (j==15) {
                    break;
                }
            }
        }
    }
    nueva_seccion_.setAttribute("class", "seccionfoto");

    return nueva_seccion_;
}




// Función para ordenar las fotos en función de la fecha de manera descendente
function ordenarPorFechaDescendente(numero) {
    var nueva_seccion_ = document.createElement("div"),
        articles_ = articles_inicial_,
        fecha_, new_fecha_;

    for (let i=0; i<articles_.length; i++) {
        if (i == 0) {
            nueva_seccion_.appendChild(articles_[i].cloneNode(true));
        } else {
            for (let j=nueva_seccion_.children.length-1; j>=0; j--) {
                fecha_ = articles_[i].childNodes[numero].textContent;
                new_fecha_ = nueva_seccion_.childNodes[j].childNodes[numero].textContent;
                var pasa_ = compararFechas(fecha_, new_fecha_);
                if (fecha_ != new_fecha_) {
                    if (!pasa_) {
                        nueva_seccion_.insertBefore(articles_[i].cloneNode(true), nueva_seccion_.childNodes[++j]);
                        break;
                    } else if (j == 0) {
                        nueva_seccion_.insertBefore(articles_[i].cloneNode(true), nueva_seccion_.childNodes[j]);
                    }
                } else {
                    break;
                }
                if (j==15) {
                    break;
                }
            }
        }
    }
    nueva_seccion_.setAttribute("class", "seccionfoto");

    return nueva_seccion_;
}



// Función para averiguar si la primera fecha pasada por parámetro es mayor que la segunda
function compararFechas(f1, f2) {
    var fecha1_ = f1.split(" "), fecha2_ = f2.split(" "),
        dia1_ = fecha1_[1].split("-"), hora1_ = fecha1_[2].split(":"),
        dia2_ = fecha2_[1].split("-"), hora2_ = fecha2_[2].split(":"),
        fecha1 = new Date(parseInt(dia1_[2]), parseInt(dia1_[1]), parseInt(dia1_[0]), parseInt(hora1_[0]), parseInt(hora1_[1]), 0),
        fecha2 = new Date(parseInt(dia2_[2]), parseInt(dia2_[1]), parseInt(dia2_[0]), parseInt(hora2_[0]), parseInt(hora2_[1]), 0);

    if (fecha1 > fecha2) {
        return true;
    } else {
        return false;
    }
}


/*
function comprobarRegistro2()
{
    
    var masc_ = $$("#formulario>div>input",4).checked,
        fem_ = $$("#formulario>div>input",5).checked,
        fecha_ = $$("#formulario>div>input",6).value,
        devuelve_ = true;

    
    //---------------COMPROBACIÓN INPUTS NO VACIOS Y CONTRASEÑAS COINCIDENTES------------------
    if((masc_||fem_) == true && fecha_ != "")
    {

        //---------------COMPROBACIÓN FECHA------------------

        //Comprobamos que el formato de la fecha este bien escrito.
        var dmy = fecha_.split(/[/,.-\s]+/);
        if(dmy.length != 3)
        {
            alert("El formato de la fecha es incorrecto.");
            return false;
        }

        //Comprobamos que se usen solo numeros.
        for(let i = 0; i < dmy.length;i++)
        {
            for(let j = 0;j < dmy[i].length;j++)
            {
                let numero = dmy[i].charAt(j);
                if((!(numero >= '0' && numero <= '9')))
                {
                    alert("El formato de la fecha es incorrecto.");
                    return false;
                }
            }
        }

        var dia = dmy[0], mes = dmy[1], anyo = dmy[2];
        mes--;

        //Convertimos la fecha pasada por el usuario a tipo date.
        var date = new Date(anyo,mes,dia);
        //Sacamos la fecha actual para compararla.
        var dateActual = new Date();

        //Comprobamos que no meta una fecha de nacimiento futura.
        if((dateActual.getFullYear() < date.getFullYear())
            ||(dateActual.getFullYear() == date.getFullYear() && dateActual.getMonth() < date.getMonth())
            || (dateActual.getFullYear() == date.getFullYear() && dateActual.getMonth() == date.getMonth()) && dateActual.getDate() < date.getDate())
        {
            alert("La fecha de nacimiento no puede ser mayor que la actual.");
            return false;
        }

        //Comprobamos la validez de la fecha introducida por el usuario.
        if(!(dia == date.getDate()) && (mes == date.getMonth()) && (anyo == date.getFullYear()))
        {
            alert("La fecha es incorrecta.");
            return false;
        }

    }
    
    else
    {
        alert("Hay campos sin rellenar.");
        return false;
    }

    

    return devuelve_;
}









        //Definimos las expresiones regulares para cada input.
        var ernombre = new RegExp("^[^0-9][a-zA-Z0-9]{2,14}$"),
            ercontrasenya = new RegExp("^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])[\w-]{6,15}$"),
            eremail = new RegExp("^(?!^\.)(?!.*\.$)(?!.*?\.\.)[\w!#$%&'*+\-\/=?^`{|}~.]{0,63}[^\.]$");

        //Comprobamos que las contraseás coinciden.
        

        //Comprobamos que el patron de nombre este bien.
        if(ernombre.test(nombre_))
        {
            devuelve_ = true;
        }
        else
        {
            alert("El formato del nombre no es correcto.");
            return false;
        }

        //Comprobamos que el patron de la contraseña este bien.
        if(ercontrasenya.test(contra_))
        {
            devuelve_ = true;
        }
        */