$(document).ready(function() {
    $("form[action='../PHP/recuperar_contrasena.php']").on("submit", function(e) {
        e.preventDefault();

        var $form = $(this);
        var url = $form.attr("action");
        var $mensajeRecuperacion = $("#mensaje-recuperacion");

        $.post(url, $form.serialize(), function(data) {
            $mensajeRecuperacion.text(data).show();
        });
    });
});
