$(document).ready(function(){
    console.log(imagen);
    $('#contador').text(imagen);
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

    $("#multimedia-v").change(function(){
        valVideo = true;

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

    $('#publicarNota').click(function (e) {
        e.preventDefault();

        $("#tituloAlert").hide();
        $("#descripcionAlert").hide();
        $("#contenidoAlert").hide();
        $("#imagenAlert").hide();

        $("input[name='estado']").val(1);
        var valid=true;
        var titulo = $("[name='titulo']").val();
        if(titulo==""){
            valid = false;
            $("input[name='estado']").addClass('errorInput');
            $("#tituloAlert").text("Ingrese un titulo porfavor");
            $("#tituloAlert").show();
        }
        var descripcion = $("[name='descripcion']").val();
        if(descripcion==""){
            valid = false;
            $("input[name='descripcion']").addClass('errorInput');
            $("#descripcionAlert").text("Ingrese una descripcion porfavor");
            $("#descripcionAlert").show();
        }
        var contenido = tinymce.get("noticia-contenido").getContent();
        console.log(contenido);
        if(contenido==""){
            valid = false;
            $("input[name='noticia-contenido']").addClass('errorInput');
            $("#contenidoAlert").text("Ingrese el contenido de la nota porfavor");
            $("#contenidoAlert").show();
        }
        var contImagenes = $('#contador').text();
        console.log(contImagenes);
        if(contImagenes=="0"||contImagenes=="###"){
            valid = false;
            $("#imagenAlert").text("Ingrese al menos una imagen");
            $("#imagenAlert").show();
        }
        if(valid){
            $('#formEditarNoticia').submit();
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
