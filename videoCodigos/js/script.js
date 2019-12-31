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


    $("#pass>input").keypress(function() {
        $("#pass2").fadeIn();
    });


    $("#pass>input").focusout(function() {
        if ($("#pass>input").val() == "") {
            $("#pass2").fadeOut();
        }
    });


    $("input[name='estado']").click(function() {
        var estado = $("input[name='estado']:checked").val();

        if (estado == "otro") {
            $("#otroestado").slideDown("slow");
        } else {
            $("#otroestado").slideUp("slow");
        }
    });


});