<?php
$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
if ($nomrol != "calificador" && $nomrol !="administrador") {
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
                <?php
                if($numerin != 0){
                    echo'
                     <div class="row" id="aviso">
                        <div id="card-alert" class="card red">
                            <div class="card-content white-text">';
                if($numerin==1){
                    echo'<p>Tu revisión se ha enviado exitosamente!</p>';
                }elseif ($numerin==2) {
                    echo'
                                <p>Ha ocurido un error al crear la revisión, porfavor intentalo de nuevo :)</p>'; 
                }elseif ($numerin==3) {
                    echo'
                                <p>La revisione se ha desactivado exitosamente!!!</p>';
                }elseif ($numerin==4) {
                    echo'
                                <p>Ha ocurido un error, porfavor intentalo de nuevo :)</p>';
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
                        <center><h1>Alumnos pendientes: <?php echo $alumnos[0]['asignaciones'];?></h1></center>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <?php
                        if($alumnos !=0){
                            foreach ($alumnos as $key => $value) {
                            echo '
                                <div class="card light-blue white-text">
                                    <div class="row">
                                        <div class="col s12 m12 l12">
                                            <center><h1>folio:'.$alumnos[$key]['folio_alumno'].'</h1></center>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="row center">
                                        <div class="col s12 m12 l6">
                                            <div class="card light-blue">
                                                <center><p class="flow-text">'.$alumnos[$key]['calif_hechas'].'/'.$alumnos[$key]['total_calificaciones'].'</p></center>
                                            </div>
                                        </div>
                                        <div class="col s12 m12 l6">
                                            <div class="card light-blue">
                                                <center><p class="flow-text">';

                                    if($alumnos[$key]['enviado']==1){
                                        echo 'Enviado';
                                    }else{
                                        if($alumnos[$key]['calif_hechas']==$alumnos[$key]['total_calificaciones']){
                                            echo 'Sin enviar';
                                        }elseif($alumnos[$key]['calif_hechas']==0){
                                            echo 'Pendiente';
                                        }elseif($alumnos[$key]['calif_hechas']<$alumnos[$key]['total_calificaciones']){
                                            echo'En curso';
                                        }
                                    }

                                                echo'
                                                </p></center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l6">';
                                                if($alumnos[$key]['enviado']==0){
                                                    echo'
                                                        <p><center><a href="'.$raiz.'cali/revexa/'.$alumnos[$key]['idexamen'].'/'.$alumnos[$key]['idalumno'].'/'.$alumnos[$key]['idrevision'].'/0" class="btn waves-effect waves-light blue darken-4"><i class="mdi-navigation-check"></i> Revisar</a></center></p>
                                                    ';
                                                }
                                                
                                                echo'
                                        </div>
                                        <div class="col s12 m6 l6">
                                                ';
                                                if($alumnos[$key]['calif_hechas']>=$alumnos[$key]['total_calificaciones'] && $alumnos[$key]['enviado']==0){
                                                    $href='href="'.$raiz.'cali/enviar/'.$alumnos[$key]['idrevision'].'/'.$alumnos[$key]['idexamen'].'"';
                                                    $disabled="";
                                                //echo'<p><center><a href="'.$raiz.'cali/enviar" class="btn waves-effect waves-light red darken-4"><i class="mdi-file-file-download"></i> Enviar</a></center></p>';
                                                }else{
                                                    $href='';
                                                    $disabled="disabled";
                                                 //echo'<p><center><button href="" class="btn waves-effect waves-light red darken-4 disabled"><i class="mdi-file-file-download"></i> Enviar</button></center></p>';   
                                                }
                                                if($alumnos[$key]['enviado']==0){
                                                    echo'<p><center><a '.$href.' class="btn waves-effect waves-light red darken-4 '.$disabled.' "><i class="mdi-file-file-download"></i> Enviar</a></center></p>';
                                                }
                                                echo'
                                        </div>
                                    </div>
                                </div>
                            ';
                        }
                        }else{
                            echo'
                            <div class="row" id="aviso">
                                <div id="card-alert" class="card red">
                                    <div class="card-content white-text">
                                        <center><p>Actualmente no tienes alumnos asignados en este examen</p></center>
                                    </div>
                                    <button type="button" class="close deep-purple-text" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            </div>
                                ';
                        }
                        
                        
                        
                        
                        
                        ?>   
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
    <!-- Script para el pie chart-->
    <script type="text/javascript">
        $("#pie-chart-sample").sparkline([70, 30], {
            type: 'pie',
            width: '50',
            height: '50',
            //tooltipFormat: $.spformat('{{value}}', 'tooltip-class'),
            sliceColors: ['#f4511e', '#ffffff']
        });
        $(document).ready(function(){
            setTimeout(function() {
                $("#aviso").fadeOut(1500);
            },2000);
        });
    </script>
    <!--<div class="col s12 m12 l1">
    <div class="card">
    <center><div id="pie-chart-sample"></div></center>
    </div>                               
    </div>-->
</body>
</html>
