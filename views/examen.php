<?php
$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
if ($nomrol != "alumno") { //esta línea ira dependiendo quienes se desea que puedan entrar al script.
    header('Location: ' . $raiz . '');
}

if($estatus==1){
    header('Location: ' . $raiz . 'alum/finalizar');
}

?>

<?php
include_once('head.php');
?>

<style type="text/css">
    #txtarea {
        width: 100%;
        height: 100%;
        background-color: #dddddd;
    }
    textarea {
        resize: vertical; /* user can resize vertically, but width is fixed */
    }
</style>
</head>
<body>
    <?php
    include_once('header.php');
    ?>
    <!-- START MAIN -->
    <div id="main">
        <!-- START WRAPPER -->
        <div class="wrapper">
            <?php
            include_once('navbar.php');
            ?>
            <!-- START CONTENT -->
            <section id="content">
                <!-- Aqui va el código-->
                <div class="row">
                    <div class="col m12 l6">
                        <h1>Instrucciones</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col m12 l6 ">
                        <!-- Aqui van las instrucciones viñetadas-->
                        <ol>
                            <li>Lee el caso y la pregunta que se te presenta a continuación.</li>
                            <li>Lee el material anexo con el título "Material anexo EJEMPLO".</li>
                            <li>Reponde la pregunta correspondiente</li>
                        </ol>
                    </div>
                    <div class="col m12 l6">
                        <p id="demo"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col m12 l6">
                        <b>caso</b><br/>
                        <textarea disabled id="txtarea" oncopy="return false" onpaste="return false" rows="15">
                            <?php echo $contenido[0]['contenido']; ?>
                        </textarea>
                    </div>
                    <div class="col l6">
                        <!-- Aqui van las preguntas con su acorden para respuestas y el boton "finalizar ejemplo" -->
                        <form method="POST" action="<?php echo $raiz.'alum/finalizar' ?>">
                            <input type="hidden"  name="idexamen" value="" />
                            <input type="hidden"  name="idalumno" value="" />
                            <input type="hidden"  name="idrevision" value="" />
                            <ul class="collapsible popout" data-collapsible="accordion">
                                <?php
                                $num=1;
                                foreach ($contenido as $key => $value) {
                                    echo '
                                    <li>
                                        <div class="collapsible-header light-blue light-blue-text text-lighten-5"><i class="mdi-action-description"></i>'.$contenido[$key]['txtpregunta'].'<i class="mdi-hardware-keyboard-arrow-down right"></i></div>
                                        <div class="collapsible-body light-blue lighten-5">
                                            <div class="row">
                                                <div class="col s12">
                                                    <p>Escribe tu respuesta</p>
                                                    <textarea required oncopy="return false" onpaste="return false" rows="10" class="form-control" data-toggle="tooltip" data-placement="left" title="" placeholder="" spellcheck="false" id="txtrespuesta'.$num.'" onKeyUp="count('.$num.')" ></textarea>
                                                    <p id="numpalabras'.$num.'">Número de palabras: 0</p>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                    </li>
                                    <br/>
                                    ';
                                    $num++;
                                 } 
                                ?>
                            </ul>
                            <div class="row">
                                <button class="waves-effect waves-light btn btnenviar" id="enviar2">Enviar</button>
                            </div>
                        </form>
                        <!-- Aqui va el formulario-->
                    </div>
                </div>
            </section>
            <!-- END CONTENT -->
        </div>
        <!-- END WRAPPER -->
    </div>
    <!-- END MAIN -->
    <?php
    include_once('scripts.php');
    ?>
    <script type="text/javascript">
        // Set the date we're counting down to
        //Debug.Log('<?php echo $year.",".$month.",".$days.",".$hours.",".$minutes.",".$seconds ?>');

        //var countDownDate = new Date("May 11, 2018 16:00:00").getTime();
        var countDownDate = new Date("<?php echo $month ?> <?php echo $days ?>, <?php echo $year ?> <?php echo $hours ?>:<?php echo $minutes ?>:<?php echo $seconds ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();
            
            // Find the distance between now an the count down date
            var distance = countDownDate - now;
            
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Output the result in an element with id="demo"
            if(days !=0){
                document.getElementById("demo").innerHTML = days + "d " + hours + ": "
            + minutes + ": " + seconds + " ";
            }else{
                document.getElementById("demo").innerHTML =hours + ": "
            + minutes + ": " + seconds + "";
            }
            
            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";

                var respuesta=document.getElementById("txtrespuesta1").innerHTML;
                if(respuesta == ""){
                   document.getElementById("txtrespuesta1").innerHTML="Sin Respuesta"; 
                }

                var respuesta=document.getElementById("txtrespuesta2").innerHTML;
                if(respuesta == ""){
                   document.getElementById("txtrespuesta2").innerHTML="Sin Respuesta"; 
                }

                var respuesta=document.getElementById("txtrespuesta3").innerHTML;
                if(respuesta == ""){
                   document.getElementById("txtrespuesta3").innerHTML="Sin Respuesta"; 
                }

                var respuesta=document.getElementById("txtrespuesta4").innerHTML;
                if(respuesta == ""){
                   document.getElementById("txtrespuesta4").innerHTML="Sin Respuesta";
                }

                var btn=document.getElementById("enviar2").click();
                //btn.click();
                //console.log('si entre al click');
                $( "#enviar2" ).click();
            }
        }, 1000);
    </script>
    <script type="text/javascript">
        function count(id) {
            idtext="txtrespuesta"+id;
            numpal="numpalabras"+id;
            textoArea = document.getElementById(idtext).value;

            primerBlanco = /^ /;
            ultimoBlanco = / $/;
            variosBlancos = /[ ]+/g;
            texto = textoArea.replace (variosBlancos," ");
            texto = texto.replace (primerBlanco,"");
            texto = texto.replace (ultimoBlanco,"");

            if(texto !=""){

                textoTroceado = texto.split (" ");
                numeroPalabras = textoTroceado.length;
                console.log(numeroPalabras);
                document.getElementById(numpal).innerHTML = "Número de palabras: "+numeroPalabras;
            }else{
                numeroPalabras=0;
                document.getElementById(numpal).innerHTML = "Número de palabras: "+numeroPalabras;
            }
            
        }
        
    </script>
</body>
</html>