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
            alert(clone22.val());
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

});
