<?php
$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
if ($nomrol != "alumno") { //esta línea ira dependiendo quienes se desea que puedan entrar al script.
    header('Location: ' . $raiz . '');
}
?>

<?php
include_once('head.php');
?>

<style type="text/css">
    .notice{
        color: #ff0000;
    }
    .right{
        text-align: right;
    }
    .center{
        text-align: center;
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
                    <div class="col s6">
                        <h1>Instrumento de Habilidades Superiores de Pensamiento</h1>
                        <p class="notice">Ejemplo finalizado</p>
                        <p>
                           A continuación se te presentará la prueba, la cual está compuesta por tres elementos:
                            <ul>
                                <li>-Un caso</li>
                                <li>-Cuatro preguntas abiertas</li>
                                <li>-Materiales anexos (impresos a tu lado derecho)</li>
                            </ul>
                            Tus respuestas serán evaluadas con respecto a:
                            <ul>
                                <li>-Claridad de las ideas</li>
                                <li>-Organización de las ideas</li>
                                <li>-Solidez en el razonamiento</li>
                                <li>-Argumentación de las opiniones</li>
                                <li>-Apego a los materiales</li>
                            </ul>
                            Una vez que pases a la siguiente ventana tendrás dos horas para completar la prueba, podrás consultar el tiempo restante en el indicador en la parte superior de la pantalla y ocultarlo si así lo deseas. Transcurrido el plazo, el sistema se cerrará sin advertencia previa, guardando las respuestas de manera automática.
                        </p>
                        <p align="right">
                            ¡ÉXITO!
                        </p>
                            <center><a class="btn waves-effect waves-light" href="/upn/alum/examen">Iniciar prueba</a><center>                     
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
</body>
</html>