$(document).ready(function(){
    var imagen = 0;
    var clone22;

    $("#descripcion").on("input", function(){
        var maxLenght=$(this).attr("maxlength");
        var currentLenght = $(this).val().length;

        if(currentLenght<=maxLenght){
            $('#Crestantes').text(maxLenght-currentLenght);
        }
    });

    $("#multimedia").change(function() {
        console.log("entro");
        imagen = imagen + 1;
        clone22 = $(this).clone();
        readURL(this, imagen);
        valImagen = true;
    });

    function sliderInit(){
        $('.img-carousel').slick({
            slidesToShow: 1,
            dots: true,
            centerMode: true,
        });
    };

    function readURL(input, intento) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                var elemento = '<div><img class="img-slide" width="100%" src="'+e.target.result+'" alt="First slide"> <input type="button" class="imagenEliminar btn btn-submit" value="Eliminar"><p id="'+intento+'"></p></div>'

                //$("#nueva-imagen").attr("src", e.target.result);
                $(".img-carousel").append(elemento);
                $('.img-carousel').slick("unslick");
                sliderInit();
            }

            /* Add input Hidden para subir al server */
            clone22.removeClass("input-multimedia");
            clone22.attr("id", intento);
            clone22.attr("name","imagenes[]");

            $("#contador").html(intento);
            $("#imagenes-input").append(clone22);
            reader.readAsDataURL(input.files[0]);

        }
    }

    $(document).on("change", "#multimedia-v", function() {
        var $source = $('#video_here');
        $source[0].src = URL.createObjectURL(this.files[0]);
        $source.parent()[0].load();
    });

    $( '.img-carousel' ).on( 'click', 'input', function () {
        var val = $(this).attr('id');
        var inputId=$(this).next().attr("id");
        if(val != null){
            var id=$("#imgAEliminar").val();
            if(id!="")
                $("#imgAEliminar").attr("value", id+"|"+val);
            else
                $("#imgAEliminar").attr("value", val);
        }
        var i = $(".slick-active").attr("data-slick-index");
        console.log(i);
        $('.img-carousel').slick('slickRemove', i);

        $("#imagenes-input").find("#"+inputId).remove();
        imagen--;
        $("#contador").html(imagen);
        $('.img-carousel').slick("unslick");
        sliderInit();
    });

    Date.prototype.toDateInputValue = (function() {
        var local = new Date(this);
        local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
        return local.toJSON().slice(0,10);
    });
    $('#pFecha').val(new Date().toDateInputValue());

    $('#guardarNota').click(function (e) {
        e.preventDefault();

        $("#tituloAlert").hide();
        $("#descripcionAlert").hide();
        $("#contenidoAlert").hide();
        $("#imagenAlert").hide();
        $("#videoAlert").hide();

        $("input[name='estado']").val(1);
        var valid=true;
        var titulo = $("[name='titulo']").val();
        if(titulo==""){
            valid = false;
            $("#tituloAlert").text("Ingrese un título, por favor");
            $("#tituloAlert").show();
        }
        var descripcion = $("[name='descripcion']").val();
        if(descripcion==""){
            valid = false;
            $("#descripcionAlert").text("Ingrese una descripción, por favor");
            $("#descripcionAlert").show();
        }
        var contenido = tinymce.get("noticia-contenido").getContent();
        console.log(contenido);
        if(contenido==""){
            valid = false;
            $("#contenidoAlert").text("Ingrese el contenido de la nota, por favor");
            $("#contenidoAlert").show();
        }
        var contImagenes = $('#contador').text();
        console.log(contImagenes);
        if(contImagenes=="0"||contImagenes=="###"){
            valid = false;
            $("#imagenAlert").text("Ingrese al menos una imagen, por favor");
            $("#imagenAlert").show();
        }
        var video = $('#video_here').attr('src');
        if(video==""){
            valid = false;
            $("#videoAlert").text("Ingrese un video, por favor");
            $("#videoAlert").show();
        }
        if(valid){
            $('#redactarNoticia').submit();
        }else{
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
                }
            toastr.error('Llene todos los campos');
        }
    });

});
