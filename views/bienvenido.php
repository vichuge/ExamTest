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
                    <div class="col s4"> </div>
                    <div class="col s4">
                        <h1 align="center">Bienvenido</h1>
                        <p align="justify">
                            En esta prueba se evaluarán dos habilidades de pensamiento superior: Solución de Problemas y Análisis de la Información. 
                            La evaluación consiste en realizar una tarea de desempeño donde deberás contestar varias preguntas acerca de un escenario hipotético pero realista. 
                            Para hacerlo se te proporcionará un conjunto de documentos físicos que incluyen diversas fuentes de información.
                            En la siguiente sección se te presentará un ejemplo para que observes cómo es una tarea de desempeño y lo que se espera de tus respuestas.
                        </p>
                        <a class="btn waves-effect waves-light" href="/upn/alum/ejem">Ir a ejemplo</a>
                    </div>
                    <div class="col s4"> </div>
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