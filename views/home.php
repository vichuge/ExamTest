<?php
$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
$nombre = $this->session->nombreCompleto;
$curp= $this->session->curp;
$identificador= $this->session->identificador;
$nomprograma=$this->session->nomprograma;
if ($nomrol == "" && $idusuario == "") {
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
                    <div class="col s12">
                        <h1>Hola, por favor verifica tus datos:</h1>
                        <?php
                        echo'<p>
                                Nombre: '.$nombre.' <br/>
                                CURP: '.$curp.' <br/>
                                Identificador: '.$identificador.' <br/>';
                            if($this->session->nomrol=="alumno"){
                                echo'Programa: '.$nomprograma.' <br/>';
                            }
                        echo'</p>';
                        if(($this->session->nomrol)=="alumno"){
                            echo'<a class="btn waves-effect waves-light col s2" href="'.$raiz.'alum/bien">Continuar</a>';
                        }
                        ?>
                    </div>
                    <div class="col s12">

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