
/*Funciones para simplificar funciones de manipulación del DOM */
function $(selector) {
    return document.querySelector(selector);
}

function $$(selector, numero) {
    return document.querySelectorAll(selector)[numero];
}


document.addEventListener("DOMContentLoaded", load, false);


// Función que se ejecuta cuando se carga el DOM de la página web
function load() {
    switch (location.href) {
        case "http://localhost/DAW/practica06/solicitud.html":
            calcularTabla();
            break;
        case "http://localhost/DAW/practica06/index.html":
            $("#formini>form").onsubmit = function() {
                return comprobarLogin();
            };
            break;
        case "http://localhost/DAW/practica06/registro.html":
            $("#formulario").onsubmit = function() {
                return comprobarRegistro();
            };
            break;
    }
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
        
        if (caracteres1_==0 || caracteres2_==0) {
            devuelve_ = false;
            alert("Login inválido.");
        } else {
            devuelve_ = true;
        }
    } else {
        alert("Debes rellenar todos los campos.");
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


function comprobarRegistro()
{
    
    var nombre_ = $$("#formulario>div>input",0).value,
        contra_ = $$("#formulario>div>input",1).value,
        contra2_ = $$("#formulario>div>input",2).value,
        email_ = $$("#formulario>div>input",3).value,
        masc_ = $$("#formulario>div>input",4).checked,
        fem_ = $$("#formulario>div>input",5).checked,
        fecha_ = $$("#formulario>div>input",6).value
        devuelve_ = true;

    
    //---------------COMPROBACIÓN INPUTS NO VACIOS Y CONTRASEÑAS COINCIDENTES------------------
    if(nombre_ != "" && contra_ != "" && contra2_ != "" && email_ != "" && (masc_||fem_) == true && fecha_ != "")
    {

        if(contra_ != contra2_)
        {
            alert("Las contraseñas no coinciden, por favor vuelve a insertarlas.");
            return false;
        }

        //---------------COMPROBACIÓN NOMBRE------------------

        var numeros = ['0','1','2','3','4','5','6','7','8','9'];

        if(nombre_.length>=3 && nombre_.length<=15)
        {

            //No debe tener números al principio.
            if(numeros.indexOf(nombre_.charAt(0))!= -1)
            {
                alert("El nombre no puede empezar por un número.");
                return false;
            }

            else
            {
                for(let i = 0;i < nombre_.length;i++)
                {
                    //Comprobamos que use los caracteres correspondientes.
                    let letra = nombre_.charAt(i);
                    if ((!(letra >= 'A' && letra <= 'Z')) && (!(letra >= 'a' && letra <= 'z')) && (!(letra >= '0' && letra <= '9')))
                    { 
                        alert("El nombre solo debe contener letras del alfabeto inglés y números.");
                        return false;
                    }
                }
            }
        }

        else
        {
            alert("El nombre debe tener entre 3 y 15 caracteres.");
            return false;
        }



        //---------------COMPROBACIÓN CONTRASEÑA------------------

        if(contra_.length>=6 && contra_.length<=15)
        {
            let nMayusculas = 0, nMinusculas = 0, nNumeros = 0;
            for(let i = 0;i < contra_.length;i++)
                {
                    //Comprobamos que use los caracteres correspondientes.
                    let letra = contra_.charAt(i);

                    if ((!(letra >= 'A' && letra <= 'Z')) && (!(letra >= 'a' && letra <= 'z'))
                        && (!(letra >= '0' && letra <= '9')) && (!(letra == '-')) && (!(letra == '_')))
                    { 
                        alert("La contraseña solo debe contener letras del alfabeto inglés, números, o los símbolos - y _");
                        return false;
                    }

                    //Buscamos mayusculas,minusculas y un número.
                    if(letra >= 'a' && letra <= 'z')
                    {
                        nMinusculas++;
                    }
                    else
                    {
                        if(letra >= 'A' && letra <= 'Z')
                        {
                            nMayusculas++;
                        }
                        else
                        {
                        	if(letra >= '0' && letra <= '9')
	                        {
	                            nNumeros++;
	                        }
                        }
                    }

                    //Comprobamos que tenga como mínimo una mayuscula, una minuscula y un número.
                    if(i == contra_.length-1 && (nMayusculas == 0 || nMinusculas == 0 || nNumeros == 0))
                    {
                        alert('La contraseña al menos debe tener una mayúscula, una minúscula y un número.')
                        return false;
                    }
                    
                }
        }

        else
        {
            alert("La contraseña debe tener entre 6 y 15 caracteres.");
            return false; 
        }

        //---------------COMPROBACIÓN EMAIL------------------
        var partesEmail = email_.split('@');

        //Comprobamos que haya un arroba, parte-local y dominio.
        if(partesEmail.length == 1 || partesEmail[0] == '' || partesEmail[1] == '')
        {
            alert("El email no tiene el formato correcto.");
            return false;
        }

        else
        {
            var plocal = partesEmail[0];
            var pdominio = partesEmail[1];

            //---------------EMAIL PARTE LOCAL------------------

            //Comprobamos la longitud.
            if(plocal.length >= 1 && plocal.length <= 64)
            {
                //Comprobamos que no haya un punto al principio ni al final.
                if(plocal.charAt(0) != '.' && plocal.charAt(plocal.length-1) != '.')
                {
                    //Comprobamos que los símbolos sean correctos.
                    for(let i = 0;i < plocal.length;i++)
                    {
                        //Comprobamos que use los caracteres correspondientes.
                        let letra = email_.charAt(i);
                        if ((!(letra >= 'A' && letra <= 'Z')) && (!(letra >= 'a' && letra <= 'z'))
                            && (!(letra >= '0' && letra <= '9')) && (!(letra == '!')) && (!(letra == '#')) && (!(letra == '$'))
                            && (!(letra == '%')) && (!(letra == '&')) && (!(letra == '\'')) && (!(letra == '*')) && (!(letra == '+'))
                            && (!(letra == '-')) && (!(letra == '/')) && (!(letra == '=')) && (!(letra == '?')) && (!(letra == '^'))
                            && (!(letra == '_')) && (!(letra == '\`')) && (!(letra == '{')) && (!(letra == '|')) && (!(letra == '}'))
                            && (!(letra == '~')) && (!(letra == '.')))
                        { 
                            alert("Los símbolos del email no son correctos.");
                            return false;
                        }

                        else
                        {
                            //Compruebo que no haya dos puntos seguidos
                            if(letra == '.' && email_.charAt(i+1) == '.')
                            {
                                alert('No puede haber dos puntos seguidos en el email.');
                                return false;
                            }
                        }
                    }

                }
                else
                {
                    alert('No puede haber un punto ni al principio, ni al final de la parte local.');
                    return false;
                }
            }

            else
            {
                alert('La parte local tiene que tener mínimo 1 caracter y máximo 64.');
                return false;
            }

            //---------------EMAIL DOMINIO------------------
            //Guardamos los subdominios.
            var subdominios = pdominio.split('.');

            for(let i = 0;i < subdominios.length;i++)
            {
                //Comprobamos que los subdominios tengan la longitud adecuada.
                if(!(subdominios[i].length >= 1 && subdominios[i].length <= 63))
                {
                    alert("Los subdominios tienen que tener entre 1 y 63 caracteres.");
                    return false;
                }

                //Comprobamos que no empiecen ni acaben con guión.
                if(subdominios[i].charAt(0) == '-' || subdominios[i].charAt(subdominios[i].length-1) == '-')
                {
                    alert("El subdominio de un email no puede empezar ni acabar por un guión.");
                    return false;
                }

                //Comprobamos que cada subdominio tenga los caracteres adecuados.
                for(let j = 0;j < subdominios[i].length;j++)
                {
                    let letra = subdominios[i].charAt(j);

                    if ((!(letra >= 'A' && letra <= 'Z')) && (!(letra >= 'a' && letra <= 'z'))
                        && (!(letra >= '0' && letra <= '9')) && (!(letra == '-')))
                    { 
                        alert("Un subdominio solo debe contener letras del alfabeto inglés, números, o el símbolo -");
                        return false;
                    }
                }
            }

        }

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

