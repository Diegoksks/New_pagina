$(document).ready(function() {
    $(".contenedor-formularios").find("input, textarea").on("keyup blur focus", function(e) {
        var $this = $(this),
            label = $this.prev("label");

        if (e.type === "keyup") {
            if ($this.val() === "") {
                label.removeClass("active highlight");
            } else {
                label.addClass("active highlight");
            }
        } else if (e.type === "blur") {
            if ($this.val() === "") {
                label.removeClass("active highlight");
            } else {
                label.removeClass("highlight");
            }
        } else if (e.type === "focus") {
            if ($this.val() === "") {
                label.removeClass("highlight");
            } else if ($this.val() !== "") {
                label.addClass("highlight");
            }
        }
    });

    $(".tab a").on("click", function(e) {
        e.preventDefault();

        $(this).parent().addClass("active");
        $(this).parent().siblings().removeClass("active");

        var target = $(this).attr("href");

        $(".contenido-tab > div").not(target).hide();

        $(target).fadeIn(600);
    });

    // Mostrar el formulario de recuperación de contraseña
    $("#forgot-password-link").on("click", function(e) {
        e.preventDefault();
        $(".contenedor-formularios").hide();
        $("#recuperar-contrasena").fadeIn(600);
    });

    // Volver al formulario de inicio de sesión
    $("#volver-login").on("click", function(e) {
        e.preventDefault();
        $("#recuperar-contrasena").hide();
        $(".contenedor-formularios").fadeIn(600);
    });

    // Enviar el formulario de recuperación de contraseña usando AJAX
    $("#recuperar-contrasena-form").on("submit", function(e) {
        e.preventDefault(); // Evita el envío normal del formulario

        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: $(this).serialize(), // Serializa los datos del formulario
            success: function(response) {
                $("#mensaje-recuperacion").html(response).show();
            },
            error: function() {
                $("#mensaje-recuperacion").html("Hubo un error al enviar el formulario. Inténtalo de nuevo.").show();
            }
        });
    });

    // Enviar el formulario de registro usando AJAX
    $("#register-form").on("submit", function(e) {
        e.preventDefault(); // Prevenir el comportamiento por defecto del formulario

        var formData = $(this).serialize(); // Serializar los datos del formulario

        $.ajax({
            type: "POST",
            url: "../PHP/registro.php",
            data: formData,
            success: function(response) {
                if(response.trim() === "Registro exitoso!") {
                    alert("Registro exitoso!");
                    location.reload(); // Recargar la página
                } else {
                    alert(response); // Mostrar el mensaje de error
                }
            },
            error: function() {
                alert("Error al enviar el formulario.");
            }
        });
    });
});