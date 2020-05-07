<?php
$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
if ($nomrol != "calificador" && $nomrol != "administrador") {
    //header('Location: ' . $raiz . '');
}
?>
<?php
include_once('head.php');
?>
<style>
    .sweet-alert{
        width:750px;
        padding: 0px;
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
                <?php
                if($numerin != 0){
                    echo'
                     <div class="row" id="aviso">
                        <div id="card-alert" class="card red">
                            <div class="card-content white-text">';
                if($numerin==1){
                    echo'<p>Se han guardado los cambios!</p>';
                }elseif ($numerin==2) {
                    echo'
                                <p>Ha ocurrido un error al guardar las calificaciones, por favor inténtalo de nuevo :)</p>'; 
                }elseif ($numerin==3) {
                    echo'
                                <p>El pdf se ha generado exitosamente!!!</p>';
                }elseif ($numerin==4) {
                    echo'
                                <p>Lo sentimos, para que ha ocurido un error con el pdf, porfavor intentalo de nuevo (si el problema persiste contacta al administrador) :/</p>';
                }elseif ($numerin==5) {
                    echo'
                                <p>La revisione se ha reactivado exitosamente!!!</p>';
                }
                echo'
                            </div>
                            <button type="button" class="close deep-purple-text" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>';
                } 
                ?>
                <div class="row">
                    <div class="col s12">
                        <center><h1>Alumno: <?php echo $preguntas[0]['folusuario']; ?></h1></center>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <form method="POST" action="<?php echo $raiz ?>guardar/calificacion">
                            <input type="hidden"  name="idexamen" value="<?php echo $preguntas[0]['idexamen']; ?>" />
                            <input type="hidden"  name="idalumno" value="<?php echo $preguntas[0]['alumno']; ?>" />
                            <input type="hidden"  name="idrevision" value="<?php echo $preguntas[0]['idrev']; ?>" />
                            <ul class="collapsible popout" data-collapsible="accordion">
                                <?php
                                $idpreguntabefore = "";
                                $iddimensionbefore = "";
                                $idpreguntanow = "";
                                $iddimensionnow = "";
                                $numpreguntanow = 0;
                                $numpreguntabefore = "";
                                $grupocontador = 0;
                                if($preguntas != ""){
                                    $vueltascontador=0;
                                    foreach ($preguntas as $key => $value) {
                                        
                                        $idpreguntanow = $preguntas[$key]['idpregunta'];
                                        $iddimensionnow = $preguntas[$key]['iddimension'];
                                            if ($idpreguntabefore != $idpreguntanow && $iddimensionbefore != $iddimensionnow) {
                                                $numpreguntanow++;
                                                echo '
                                        <li>
                                            <div class="collapsible-header light-blue light-blue-text text-lighten-5"><i class="mdi-action-description"></i>' . $numpreguntanow . '. ' . $preguntas[$key]['txtpregunta'] . '<i class="mdi-hardware-keyboard-arrow-down right"></i></div>
                                            <div class="collapsible-body light-blue lighten-5">
                                                <p>
                                                    ' . $preguntas[$key]['respuesta'] . '
                                                </p>
                                            </div>
                                            <br/>
                                        ';
                                                $idpreguntabefore2 = "";
                                                $iddimensionbefore2 = "";
                                                $idpreguntanow2 = "";
                                                $iddimensionnow2 = "";
                                                foreach ($preguntas as $key2 => $value) {
                                                    $idpreguntanow2 = $preguntas[$key2]['idpregunta'];
                                                    if ($idpreguntanow2 == $preguntas[$key]['idpregunta']) {
                                                        $iddimensionnow2 = $preguntas[$key2]['iddimension'];
                                                        if ($iddimensionnow2 != $iddimensionbefore2) {
                                                            $vueltascontador++;
                                                            echo'
                                                                <div class="row">             
                                                                    <div class="col s12 m6">
                                                                        <p class="left">
                                                            ';
                                                            $nivelcontador = 0;
                                                            $grupocontador++;
                                                            //$f=0;
                                                            //$iddimension=$preguntas[$key2]['iddimension'];
                                                            //$idpregunta=$preguntas[$key2]['idpregunta'];
                                                            foreach ($preguntas as $key3 => $value) {
                                                                if($preguntas[$key2]['iddimension']==$preguntas[$key3]['iddimension'] && $idpregunta=$preguntas[$key2]['idpregunta']==$idpregunta=$preguntas[$key3]['idpregunta'] ){
                                                                    $nivelcontador++;
                                                                    //echo $grupocontador.'-'.$nivelcontador.',';
                                                                    if(isset($preguntas[$key3]['calificacion']) && $preguntas[$key3]['calificacion']==$preguntas[$key3]['valnivel'] ){
                                                                        $checked="checked";
                                                                    }else{
                                                                        $checked="";
                                                                    }
                                                                    if($preguntas[$key3]['valnivel']==99){
                                                                        echo'
                                                                        <input name="group'.$grupocontador.'" type="radio" id="test'.$grupocontador.'-'.$nivelcontador.'" '.$checked.' value="'.$preguntas[$key3]['idpregunta'].'|'.$preguntas[$key3]['iddimension'].'|'.$preguntas[$key3]['valnivel'].'" />
                                                                        <label for="test'.$grupocontador.'-'.$nivelcontador.'">'.$preguntas[$key3]['nomnivel'].'</label>
                                                                    ';
                                                                    }else{
                                                                        echo'
                                                                        <input name="group'.$grupocontador.'" type="radio" id="test'.$grupocontador.'-'.$nivelcontador.'" '.$checked.' value="'.$preguntas[$key3]['idpregunta'].'|'.$preguntas[$key3]['iddimension'].'|'.$preguntas[$key3]['valnivel'].'" />
                                                                        <label for="test'.$grupocontador.'-'.$nivelcontador.'">'.$preguntas[$key3]['valnivel'].': '.$preguntas[$key3]['nomnivel'].'</label>
                                                                    ';
                                                                    }
                                                                    
                                                                }
                                                            }
                                                            /* echo'
                                                              <input name="group1" type="radio" id="test'.$numpreguntanow.'-1" />
                                                              <label for="test'.$numpreguntanow.'-1">0: No aceptable</label>
                                                              <input name="group1" type="radio" id="test'.$numpreguntanow.'-2" />
                                                              <label for="test'.$numpreguntanow.'-2">1: Básico</label>
                                                              <input name="group1" type="radio" id="test'.$numpreguntanow.'-3"  />
                                                              <label for="test'.$numpreguntanow.'-3">2: Competente</label>
                                                              <input name="group1" type="radio" id="test'.$numpreguntanow.'-4"  />
                                                              <label for="test'.$numpreguntanow.'-4">3: Sobresaliente</label>
                                                              '; */
                                                            echo'
                                                                        </p>
                                                                    </div>
                                                                    <div class="col s12 m4">
                                                                        <p class="left"><h5>' . $preguntas[$key2]['titulo_dimension'] . '</h5></p>
                                                                    </div>
                                                                    <div class="col s12 m2">
                                                                        <button class="btn btn-message-html' . $grupocontador . ' waves-effect waves-light right" type="button">Ver Rúbrica</button>
                                                                    </div>
                                                                </div>
                                                            ';
                                                        }

                                                        $iddimensionbefore2 = $preguntas[$key2]['iddimension'];
                                                    }
                                                    $idpreguntabefore2 = $preguntas[$key2]['idpregunta'];
                                                }

                                                echo'
                                        </li>
                                        ';
                                            }
                                        $idpreguntabefore = $preguntas[$key]['idpregunta'];
                                        $iddimensionbefore = $preguntas[$key]['iddimension'];
                                        $numpreguntabefore = $numpreguntanow;
                                    }
                                    echo'<input type="hidden" disabled name="numgrupos" value="'.$vueltascontador.'" />';
                                }else{
                                    header('Location: ' . $raiz . '');
                                }
                                
                                $numpregunta = 0;
                                ?>

                            </ul>
                            <div class="row">
                                <button class="waves-effect waves-light btn">Guardar</button>
                                <a href="<?php echo $raiz ?>cali/pdfexa/<?php echo $idexamen.'/'.$idusuarioalum.'/'.$idrevision.'/'.'3'; ?>" class="waves-effect waves-light btn" target="_blank">Pdf</a>
                                <a href="<?php echo $raiz ?>cali/alumnos/<?php echo $preguntas[0]['idexamen']; ?>/0" class="waves-effect waves-light btn">Salir</a>
                            </div>
                        </form>
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
    <?php
    //include_once('rubricasjs.php');
    ?>
    <script type="text/javascript">


<?php
/*
 *  $('.btn-message-html2').click(function () {
        swal({
            title: value2,
            text: '<div class="row"><div class="col s12"><p>Encuentra la idea (causa) en un texto que no lo dice de manera explícita; se infiere de una serie de ideas elaboradas a lo largo del caso para integrarlas en un todo</p></div></div>    <div class="row"><div class="col s12"><table><thead><tr><th>Nivel 0:No aceptable</th><th>Nivel 1:Básico</th><th>Nivel 2:Competente</th><th>Nivel 3:Sobresaliente</th></tr></thead><tbody><tr><th>El sustentante se limita a describir o parafrasear el caso, sin identificar alguna causa concreta; o a describir consecuencias en vez de causas</th><th>El sustentante plantea causas que no son claras, que no corresponden a los expuestos en el caso o materiales o que se contradicen entre sí</th><th>Plantea claramente una o varias causas interrelacionadas entre sí, pero se refieren a causas evidentes, por ejemplo:<li>El uso del celular</li><li>Falta de maestros a la escuela</li><li>Falta del seguimiento de protocolos para los módulos libres</li></th><th>Plantea claramente una o varias causas interrelacionadas entre sí, las cuales subyacen a la problemática planteada por ejemplo:<br/>-Administración<br/>-Bullying</th></tr></tbody></table></div></div>',
            html: true
        });
    });
 */
$cont = 0;
$iddimensionbefore3 = "";
$iddimensionnow3 = "";
foreach ($rubricas as $key4 => $value) {
    $iddimensionnow3 = $rubricas[$key4]['iddimension'];
    if ($iddimensionnow3 != $iddimensionbefore3) {
        $cont++;
        echo '
                    $(".btn-message-html' . $cont . '").click(function () {
                        swal({
                            title: "' . $rubricas[$key4]['titulo'] . '",
                            text:"<div class=\'row\'><div class=\'col s12\'><p>'.$rubricas[$key4]['txtdimension'].'</p></div></div><div class=\'row\'><div class=\'col s12\'><table><thead><tr>';
                                for ($i = 1; $i <= ($rubricas[$key4]['tot_niveles']-1); $i++)
                                {
                                    $e=$i-1;
                                    echo'<th>Nivel '.$rubricas[$e]['valnivel'].': '.$rubricas[$e]['nomnivel'].'</th>';
                                }
                                echo'</tr></thead><tbody><tr>';
                                    $iddimensionbefore4 = "";
                                    $iddimensionnow4 = "";
                                    $contador=0;
                                    foreach ($rubricas as $key5 => $value) 
                                    {
                                        if($rubricas[$key4]['iddimension']==$rubricas[$key5]['iddimension'] && $contador<($rubricas[$key4]['tot_niveles']-1))
                                        {
                                            echo'<th>'.$rubricas[$key5]['txtrubrica'].'</th>';
                                            $contador++;
                                        }
                                    }
                                echo'</tr></tbody></table></div></div>",';
                                echo '
                            html: true
                        });
                    });
        ';
    }
    $iddimensionbefore3 = $rubricas[$key4]['iddimension'];
}
?>
        //});
        $(document).ready(function(){
            setTimeout(function() {
                $("#aviso").fadeOut(1500);
            },2000);
        });
    </script>
</body>
</html>
