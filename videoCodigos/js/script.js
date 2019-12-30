$(document).ready(function() {


    $("main>p>button").click(function() {
        
        var valor = $("input[name='align']:checked").val();
        var lista = $("main>ol");
        var msjError = $("main>p>span");

        if (valor != undefined) {
            if (valor == "left") {
                lista.css("text-align", "left");
            } else if (valor == "center") {
                lista.css("text-align", "center");
            } else if (valor == "right") {
                lista.css("text-align", "right");
            }
            msjError.hide();
        } else {
            msjError.show();
        }

    });


    $("main>select").change(function() {

        var tamanyo = $("main>select").val();
        var texto = $("#info");

        if (tamanyo == "p") {
            //texto.css("font-size", ".75em");
            texto.animate({fontSize: ".75em"}, 500);
        } else if (tamanyo == "n") {
            //texto.css("font-size", "1em");
            texto.animate({fontSize: "1em"}, 500);
        } else if (tamanyo == "g") {
            //texto.css("font-size", "1.5em");
            texto.animate({fontSize: "1.25em"}, 500);
        }
    });


    $("#pass").keypress(function() {
        $("#pass2").fadeIn();
    });


    $("#pass").focusout(function() {
        var val = $("#pass").text();
        console.log(val);
        if ($("#pass").val() == "") {
            $("#pass2").fadeOut();
        }
    });


});