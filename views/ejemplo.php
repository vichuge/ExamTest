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
                    <div class="col s6">
                        <h1>Ejemplo</h1>
                            <p>
                                A continuación se te presentará un ejemplo en el cual podrás visualizar un caso ficticio en la pantalla y una pregunta, tal cual lo vas a ver en la prueba real. Al seleccionar la pregunta podrás observar que se despliega un cuadro de texto, el cual ya contiene una respuesta ejemplo. Analiza cómo está argumentada con base en el material físico que tienes a tu izquierda con el nombre “Material EJEMPLO”. De igual forma utiliza este espacio para asegurarte que funciona correctamente tu teclado, incluso puedes cambiar la respuesta ejemplo puesto que esta sección no tiene ningún valor o puntuación en tu resultado final.

                                Para analizar el ejemplo cuentas con un máximo de 10 minutos, tiempo que comenzará a transcurrir en cuanto selecciones el botón de “Iniciar Ejemplo”. Podrás observar la cantidad de tiempo restante en el contador ubicado en la parte superior de la pantalla, si deseas ocultarlo puedes seleccionar el botón “Ocultar tiempo restante”.

                                Una vez hayas concluido de leer el caso, el material anexo y de haber analizado la pregunta y respuesta, selecciona el botón “Finalizar ejemplo”, el cual te pedirá confirmar la acción.

                                Cualquier duda con respecto al funcionamiento de la plataforma, puedes consultarla con el aplicador.
                            </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <center><a class="btn waves-effect waves-light" href="/upn/alum/examtest">Ir a ejemplo</a><center>
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