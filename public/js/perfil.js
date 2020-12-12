$(document).ready(function(){

    var jq = jQuery.noConflict();
    function pendientesInit() {
        jq('#pendientes').slick({
            speed: 1200,
            autoplay:false,
            slidesToShow: 4,
            slidesToScroll: 4,
        });
    }
    function pendientesDestroy() {
        if ($('#pendientes').hasClass('slick-initialized')) {
            jq('#pendientes').slick('destroy');
        }
    }
    function slickCarousel() {
        jq('.misPublicaciones').slick({
            speed: 1200,
            autoplay:false,
            slidesToShow: 4,
            slidesToScroll: 4,
        });
    }
    function destroyCarousel() {
        if ($('.misPublicaciones').hasClass('slick-initialized')) {
            jq('.misPublicaciones').slick('unslick');
        }
    }

    $('.aPublicar').click(function(e){
        e.preventDefault();
        var i = $(this).parent().parent().attr("data-slick-index");
        var element = $(this).parent().parent();
        /*var source = element.find('img.reseña-imagen').attr('src')
        alert(source);
        var titulo = element.parent().parent().find('p').text();
        alert(titulo);
        var es = element.find('input[type="text"]').val();
        alert(es);*/
        let _token   = $('meta[name="csrf-token"]').attr('content');
        let postId = $(this).attr("href");
        let path = "/noticia/"+postId+"/edit";
        $.ajax({
            url:path,
            type:"GET",
            data:{
                _token:_token,
                id:postId
            },
            success:function(response){
                if(response){
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
                    toastr.success('Publicacion publicada');
                }
                animateRemove(element, i);
            }
        });
    });

    function animateRemove(el, i) {
        el.animate({height: '0px', width: '0px'}, 800, function(){
            jq('#pendientes').slick('slickRemove', i);
            pendientesDestroy()
            pendientesInit()
        });
    }

    $('a[data-toggle="list"]').on('shown.bs.tab', function(e) {
        var s = jq($(this).attr('href')).find('.misPublicaciones');
        s.slick({
            speed: 1200,
            autoplay:false,
            slidesToShow: 4,
            slidesToScroll: 4,
        })
    });

    $("#imgload").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgshow').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#perfilGuardar').click(function(e){
        e.preventDefault();
        var nombre = $("[name='name']").val();
        var valid=true;
        if(nombre==""){
            valid = false;
            $("#nombreAlert").text("Ingrese un nombre porfavor");
            $("#nombreAlert").show();
        }
        var email = $("[name='email']").val();
        if(email==""){
            valid = false;
            $("#mailAlert").text("Ingrese un correo porfavor");
            $("#mailAlert").show();
        }else if(!email.includes("@")){
            valid = false;
            $("#mailAlert").text("Ingrese un correo valido porfavor");
            $("#mailAlert").show();
        }
        var passv1 = $("[name='password']").val();
        var passv2 = $("[name='password_confirmation']").val();
        var upperCase= new RegExp('[A-Z]');
        var lowerCase= new RegExp('[a-z]');
        var passSize=passv1.length;
        if(passv1!=""){
            if(passv2==""){
                valid = false;
                $("#passAlert").text("Ingrese ambas contraseñas");
                $("#passAlert").show();
            }else if(passv1.match(upperCase) && passv1.match(lowerCase) && passSize>=8){
                if(passv1!=passv2){
                    valid = false;
                    $("#passAlert").text("Las contraseñas no coinciden");
                    $("#passAlert").show();
                }
            }else{
                valid = false;
                $("#passAlert").html("La contraseña debe tener mayusculas, minusculas y minimo 8 caracteres");
                $("#passAlert").show();
            }
        }

        if(valid){
            $('#formPerfil').submit();
        }
    });


    $('#submitAutor').click(function(e){
        e.preventDefault();

        $("#nombreAlertAutor").hide();
        $("#emailAlertAutor").hide();
        $("#passAlertAutor").hide();

        $("[name='nameAutor']").removeClass('errorInput');
        $("[name='emailAutor']").removeClass('errorInput');
        $("[name='passwordAutor']").removeClass('errorInput');
        $("[name='password_confirmationAutor']").removeClass('errorInput');

        var nombre = $("[name='nameAutor']").val();
        var valid=true;
        if(nombre==""){
            valid = false;
            $("[name='nameAutor']").addClass('errorInput');
            $("#nombreAlertAutor").text("Ingrese un nombre porfavor");
            $("#nombreAlertAutor").show();
        }
        var email = $("[name='emailAutor']").val();
        if(email==""){
            valid = false;
            $("[name='emailAutor']").addClass('errorInput');
            $("#emailAlertAutor").text("Ingrese un correo porfavor");
            $("#emailAlertAutor").show();
        }else if(!email.includes("@")){
            valid = false;
            $("[name='emailAutor']").addClass('errorInput');
            $("#emailAlertAutor").text("Ingrese un correo valido porfavor");
            $("#emailAlertAutor").show();
        }
        var passv1 = $("[name='passwordAutor']").val();
        var passv2 = $("[name='password_confirmationAutor']").val();
        var upperCase= new RegExp('[A-Z]');
        var lowerCase= new RegExp('[a-z]');
        var passSize=passv1.length;
        if(passv1!=""){
            if(passv2==""){
                valid = false;
                $("[name='passwordAutor']").addClass('errorInput');
                $("[name='password_confirmationAutor']").addClass('errorInput');
                $("#passAlertAutor").text("Ingrese ambas contraseñas");
                $("#passAlertAutor").show();
            }else if(passv1.match(upperCase) && passv1.match(lowerCase) && passSize>=8){
                if(passv1!=passv2){
                    valid = false;
                    $("[name='passwordAutor']").addClass('errorInput');
                    $("[name='password_confirmationAutor']").addClass('errorInput');
                    $("#passAlertAutor").text("Las contraseñas no coinciden");
                    $("#passAlertAutor").show();
                }
            }else{
                valid = false;
                $("[name='passwordAutor']").addClass('errorInput');
                $("#passAlertAutor").html("La contraseña debe tener mayusculas, minusculas y minimo 8 caracteres");
                $("#passAlertAutor").show();
            }
        }else{
            valid = false;
            $("[name='passwordAutor']").addClass('errorInput');
            $("#passAlertAutor").text("Ingrese una contraseña");
            $("#passAlertAutor").show();
        }

        if(valid){
            $('#formAutor').submit();
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:"/AutorRegistrar",
                type:"POST",
                data:{
                    _token:_token,
                    name:nombre,
                    email:email,
                    password:passv1
                },
                success:function(response){
                    if(response){
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
                        toastr.success('Autor registrado');
                    }
                }
            });
        }
    });
});
