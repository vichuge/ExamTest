<?php
$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
if ($nomrol != "calificador" && $nomrol != "administrador") {
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
                        <center><h1>Exámenes con pendientes</h1></center>
                    </div>
                </div>
                <?php
                $nomexamen = "";
                if($examenes != 0){
                    foreach ($examenes as $key => $value) {
                    if ($nomexamen != $examenes[$key]['nomexamen']) {
                        echo'
                            <div class="row">
                            <div class="col s12">
                                <div class="card green white-text">
                                    <div class="row">
                                        <div class="col s12">
                                            <center><h1>' . $examenes[$key]['nomexamen'] . '</h1></center>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="row">
                                        <div class="col s12 m6 l6">
                                            <div class="card green">
                                                <center><p> Preguntas por examen: ' . $examenes[$key]['numpreguntas'] . '</p></center>
                                            </div>

                                        </div>
                                        <div class="col s12 m6 l6">
                                            <div class="card green">
                                                <center><p> Revisiones pendientes: ' . $examenes[$key]['asignaciones'] . '</p></center>
                                            </div>
                                        </div>
                                                ';
                    }
                    if ($nomexamen != $examenes[$key]['nomexamen']) {
                        echo'
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l6">
                                            <center><a href="'.$raiz.'cali/alumnos/'.$examenes[$key]['idexamen'].'/0" class="btn waves-effect waves-light blue darken-4"><i class="mdi-navigation-check"></i> Calificar</a></center>             
                                        </div>
                                        <div class="col s12 m6 l6">
                                            <center><a href="../resources/rubricas/'.$examenes[$key]['rubrica'].'" class="btn waves-effect waves-light red darken-4"><i class="mdi-file-file-download"></i> Rúbrica</a></center>
                                        </div>
                                        <div class="col s12 m6 l6">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        ';
                    }
                    $nomexamen = $examenes[$key]['nomexamen'];
                }
                }else{
                    echo '
                        <div class="row" id="aviso">
                                <div id="card-alert" class="card red">
                                    <div class="card-content white-text">
                                        <center><p>Actualmente no tienes examenes asignados</p></center>
                                    </div>
                                    <button type="button" class="close deep-purple-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                        ';
                }
                
                
                
                
                
                ?>


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
