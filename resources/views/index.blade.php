<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/login.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">

        </div>

        <!-- Login Form -->
        <form id="form" name="form" class="md-float-material form-material" method="post" action='login'" autocomplete="off">
            {{ csrf_field() }}
            <input type="text" id="email" class="fadeIn second" name="email" placeholder="Email">
            <input type="text" id="password" class="fadeIn third" name="password" placeholder="Password">
            <button id="entrar" type="button" onclick="noclick();" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-20">Entrar</button>
        </form>


        <div id="formFooter">

        </div>

    </div>
</div>

<script>
    $('.input').keypress(function (e) {
        if (e.which == 13) {
            $("#entrar").prop('disabled', true);
            $('#form').submit();
        }
    });

    function noclick(){
        $("#entrar").prop('disabled', true);
        $('#form').submit();
    }

    $(document).ready(function() {
        if($('#error').val() == ''){

        }else{
            $('#h-100').css('height','90px');
            $.notify({
                icon: 'glyphicon glyphicon-warning-sign',
                title: 'Verifica tu usuario y contraseña <br>',
                message: ''
            },{
                type: 'danger',
                placement: {from: "bottom", align: "center"},
                delay: 5000,
                timer: 1000
            });
            setTimeout(function(){
                $("#shake").addClass("shake-slow shake-constant");
            },10);
            endShake();
        }
    });

</script>
