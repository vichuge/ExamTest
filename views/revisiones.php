<?php
$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
if ($nomrol != "administrador") {
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
                        <center><h1>Lista de calificaciones</h1></center>
                    </div>
                </div>
                <div class="divider"></div>
                <form method="POST" action="<?php echo $raiz ?>admin/calificaciones">
                    <div class="row">
                        <div class="col s12 m12 l4">
                            <p>Folio del Alumno</p>
                            <select name="idusuarioalumno">
                                <option value="0">Seleccione...</option>
                                <?php
                                foreach ($alumnos as $key => $value) {
                                    if ($alumnos[$key]['idusuario'] == $idalumno) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo'
                                    <option value="' . $alumnos[$key]['idusuario'] . '" ' . $selected . ' >' . $alumnos[$key]['folusuario'] . '</option>
                                ';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col s12 m12 l4">
                            <p>Programa</p>
                            <select name="idprograma">
                                <option value="0">Seleccione...</option>
                                <?php
                                foreach ($programas as $key2 => $value) {
                                    if ($programas[$key2]['idprograma'] == $idprograma) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo'
                                    <option value="' . $programas[$key2]['idprograma'] . '" ' . $selected . ' >' . $programas[$key2]['nomprograma'] . '</option>
                                ';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col s12 m12 l4">
                            <p>Dimensión</p>
                            <select name="iddimension">
                                <option value="0">Seleccione...</option>
                                <?php
                                foreach ($dimensiones as $key3 => $value) {
                                    if ($dimensiones[$key3]['iddimension'] == $iddimension) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo'
                                    <option value="' . $dimensiones[$key3]['iddimension'] . '" ' . $selected . ' >' . $dimensiones[$key3]['titulo'] . '</option>
                                ';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l4">
                            <p>Pregunta</p>
                            <select name="idpregunta">
                                <option value="0">Seleccione...</option>
                                <?php
                                foreach ($preguntas as $key4 => $value) {
                                    if ($preguntas[$key4]['idpregunta'] == $idpregunta) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo'
                                    <option value="' . $preguntas[$key4]['idpregunta'] . '" ' . $selected . ' >' . $preguntas[$key4]['txtpregunta'] . '</option>
                                ';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col s12 m12 l4">
                            <p>Calificador</p>
                            <select name="idusuariocalificador">
                                <option value="0">Seleccione...</option>
                                <?php
                                foreach ($calificadores as $key5 => $value) {
                                    if ($calificadores[$key5]['idusuario'] == $idusuariocalificador) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    echo'
                                    <option value="' . $calificadores[$key5]['idusuario'] . '" ' . $selected . ' >' . $calificadores[$key5]['nomusuario'] . ' ' . $calificadores[$key5]['apeusuario'] . ' ' . $calificadores[$key5]['lastusuario'] . '</option>
                                ';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col s12 m12 l4">
                            <p>Examen</p>
                            <select name="idexamen">
                                <option value="0">Seleccione...</option>
                                <?php
                                foreach ($examenes as $key7 => $value) {
                                    if ($examenes[$key7]['idexamen'] == $examen) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    if ($examenes[$key7]['idexamen'] != 0) {
                                        echo'
                                            <option value="' . $examenes[$key7]['idexamen'] . '" ' . $selected . ' >'. $examenes[$key7]['nomexamen'] . '</option>
                                        ';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!--<div class="row">
                        <div class="col s12 m12 l4">
                            <p>Nivel</p>
                            <select name="idnivel">
                                <option value="99">Seleccione...</option>-->
                                <?php
                                /*foreach ($niveles as $key6 => $value) {
                                    if ($niveles[$key6]['valnivel'] == $valnivel) {
                                        $selected = "selected";
                                    } else {
                                        $selected = "";
                                    }
                                    if ($niveles[$key6]['valnivel'] != 99) {
                                        echo'
                                            <option value="' . $niveles[$key6]['valnivel'] . '" ' . $selected . ' >' . $niveles[$key6]['valnivel'] . ': ' . $niveles[$key6]['nomnivel'] . '</option>
                                        ';
                                    }
                                }*/
                                ?>
                            <!--</select>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col s12">
                            <button class="waves-effect waves-light btn"><i class="mdi-action-search left"></i>Buscar</button>
                        </div>
                    </div>
                </form>
                <div class="divider"></div><br/>
                <form method="POST" action="<?php echo $raiz ?>admin/excel">
                    <div class="row">
                        <div class="col s12">
                            <input type="hidden" name="idusuarioalumno" value="<?php echo $idalumno ?>"/>
                            <input type="hidden" name="idprograma" value="<?php echo $idprograma ?>"/>
                            <input type="hidden" name="iddimension" value="<?php echo $iddimension ?>"/>
                            <input type="hidden" name="idpregunta" value="<?php echo $idpregunta ?>"/>
                            <input type="hidden" name="idusuariocalificador" value="<?php echo $idusuariocalificador ?>"/>
                            <input type="hidden" name="idnivel" value="<?php echo $valnivel ?>"/>
                            <input type="hidden" name="idexamen" value="<?php echo $examen ?>"/>
                            <center><button class="waves-effect waves-light btn "><i class="mdi-image-grid-on left"></i>Generar Excel</button></center>
                        </div>
                    </div>
                </form>
                <div class="divider"></div>
                
                <!--<div id="row-grouping" class="section">-->
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table id="data-table-simple" class="responsive-table display" cellspacing="0" width="100%">
                        <!--<table id="data-table-row-grouping" class="responsive-table display" cellspacing="0" width="100%"> -->
                                <thead>
                                    <tr>
                                        <th>Folio Revisión</th>
                                        <th>Folio Alumno</th>
                                        <th>Programa</th>
                                        <th>Dimensión</th>
                                        <th>Id Pregunta</th>
                                        <th>Pregunta</th>
                                        <th>Nombre calificador</th>
                                        <th>Calificación</th>
                                        <th>Fecha de envio</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>Folio Revisión</th>
                                        <th>Folio Alumno</th>
                                        <th>Programa</th>
                                        <th>Dimensión</th>
                                        <th>Id Pregunta</th>
                                        <th>Pregunta</th>
                                        <th>Nombre calificador</th>
                                        <th>Calificación</th>
                                        <th>Fecha de envio</th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php
                                    if ($revisionesc != 0) {
                                        foreach ($revisionesc as $key7 => $value) {
                                            echo'
                                          <tr>
                                            <td>' . $revisionesc[$key7]['folrevision'] . '</td>
                                            <td>' . $revisionesc[$key7]['folusuario'] . '</td>
                                            <td>' . $revisionesc[$key7]['nomprograma'] . '</td>
                                            <td>' . $revisionesc[$key7]['nomdimension'] . '</td>
                                            <td>' . $revisionesc[$key7]['idpregunta'] . '</td>
                                            <td>' . $revisionesc[$key7]['txtpregunta'] . '</td>
                                            <td>' . $revisionesc[$key7]['nomcalificador'] . '</td>
                                            <td>' . $revisionesc[$key7]['valcalificacion'] . '</td>
                                            <td>' . $revisionesc[$key7]['dtenviado'] . '</td>
                                          </tr>
                                          ';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <!--</div>-->
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
    /*Show entries on click hide*/
    $(document).ready(function () {
        $(".dropdown-content.select-dropdown li").on("click", function () {
            var that = this;
            setTimeout(function () {
                if ($(that).parent().hasClass('active')) {
                    $(that).parent().removeClass('active');
                    $(that).parent().hide();
                }
            }, 100);
        });
    });
</script>
</body>
</html>