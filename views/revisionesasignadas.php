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
                <?php
                if($numerin != 0){
                    echo'
                     <div class="row" id="aviso">
                        <div id="card-alert" class="card red">
                            <div class="card-content white-text">';
                if($numerin==1){
                    echo'<p>Las revisiones se han insertado exitosamente!!!</p>';
                }elseif ($numerin==2) {
                    echo'
                                <p>Ha ocurido un error al crear la revisión, porfavor intentalo de nuevo :)</p>'; 
                }elseif ($numerin==3) {
                    echo'
                                <p>La revision se ha desactivado exitosamente...</p>';
                }elseif ($numerin==4) {
                    echo'
                                <p>Ha ocurido un error, porfavor intentalo de nuevo :)</p>';
                }elseif ($numerin==5) {
                    echo'
                                <p>La revision se ha reactivado exitosamente!!!</p>';
                }elseif ($numerin==6) {
                    echo'
                                <p>Asegúrate de seleccionar alumnos para el calificador :)</p>';
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
                        <center><h1>Relación de revisiones asignadas</h1></center>
                    </div>
                </div>
                <div class="divider"></div><br/>
                <div class="row">
                    <form method="POST" action="<?php echo $raiz ?>admin/lstrevision/0">
                        <div class="col s12 m12 l4">
                            <p>Calificador</p>
                                <select name="idcalificador">
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
                            <p>Folio del alumno</p>
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
                            <p>Examen</p>
                                <select name="idexamen">
                                    <option value="0">Seleccione...</option>
                                    <?php
                                    foreach ($examenes as $key => $value) {
                                        if ($examenes[$key]['idexamen']==$idexamen) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo'
                                        <option value="' . $examenes[$key]['idexamen'] . '" ' . $selected . ' >' . $examenes[$key]['nomexamen'] . '</option>
                                    ';
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="col s12 m12 l4">
                            <button class="waves-effect waves-light btn"><i class="mdi-action-search left"></i>Buscar</button>
                        </div>
                    </form>
                </div>
                <div class="divider"></div><br/>
                <div class="row">
                    <div class="col s12">
                        <a href="<?php echo $raiz ?>admin/asigrevision" class="waves-effect waves-light btn right"><i class="mdi-content-add right"></i>Asignar calificador</a>
                    </div>
                </div>
                <div class="divider"></div><br/>
                <div class="row">
                    <div class="col s12">
                        <form method="POST" action="<?php echo $raiz ?>admin/excel2">
                            <div class="row">
                                <div class="col s12">
                                    <input type="hidden" name="idusuarioalumno" value="<?php echo $idalumno ?>"/>
                                    <input type="hidden" name="idexamen" value="<?php echo $idexamen ?>"/>
                                    <input type="hidden" name="idcalificador" value="<?php echo $idusuariocalificador ?>"/>
                                    <center><button class="waves-effect waves-light btn "><i class="mdi-image-grid-on left"></i>Generar Excel</button></center>
                                </div>
                            </div>
                        </form>
                        <!--<center><a href="<?php echo $raiz ?>admin/excel2" class="waves-effect waves-light btn"><i class="mdi-image-grid-on left"></i>Generar excel</a></center> comentado vic7may18-->
                    </div>
                </div>
                <div class="divider"></div><br/>
                <div class="row">
                    <div class="col s12 m12 l12">
                  <table id="data-table-simple" class="responsive-table display" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>Fecha</th>
                              <th>Examen</th>
                              <th>Folio alumno</th>
                              <th>Calificador</th>
                              <th></th>
                          </tr>
                      </thead>
                   
                      <tfoot>
                          <tr>
                              <th>Fecha</th>
                              <th>Examen</th>
                              <th>Folio alumno</th>
                              <th>Calificador</th>
                              <th></th>
                          </tr>
                      </tfoot>
                   
                      <tbody>
                          <?php
                          if($revisiones != 0){
                              foreach ($revisiones as $key => $value) {
                                  echo'
                                  <tr>
                                  <td>'.$revisiones[$key]['dtrevision'].'</td>
                                    <td>'.$revisiones[$key]['examen'].'</td>
                                    <td>'.$revisiones[$key]['folio_alumno'].'</td>
                                    <td>'.$revisiones[$key]['calificador'].'</td>';
                                  if($revisiones[$key]['estatus']==0){
                                      echo'
                                    <td id="td'.$revisiones[$key]['idrevision'].'" ><a class="btn waves-effect waves-light blue" onclick="activa('.$revisiones[$key]['idrevision'].');" ><i class="mdi-navigation-check left"></i>Activar</a></td>
                                        ';
                                  }else{
                                      echo'
                                    <td id="td'.$revisiones[$key]['idrevision'].'" ><a class="btn waves-effect waves-light" onclick="desactiva('.$revisiones[$key]['idrevision'].');" ><i class="mdi-action-delete left"></i>Desactivar</a></td>
                                        ';
                                  }
                                  echo'
                                  <!--<td><center><img class="animated-gif"  src="'.$raiz.'resources/imagenes/loading.gif"></center></td>-->
                                  </tr>
                                  ';
                                }
                          }
                          
                                ?>                                                                                                                                                     
                      </tbody>
                  </table>
                </div>
              </div>
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
        $(document).ready(function(){
            $(".dropdown-content.select-dropdown li").on( "click", function() {
                var that = this;
                setTimeout(function(){
                if($(that).parent().hasClass('active')){
                        $(that).parent().removeClass('active');
                        $(that).parent().hide();
                }
                },100);
            });
            setTimeout(function() {
                $("#aviso").fadeOut(1500);
            },2000);
        });
    </script>
    <script type="text/javascript">
        function activa(idbtn) {
            var id=idbtn;
            var uri=<?php echo $raiz ?>;
            $.ajax({
            url : uri + "admin/activRevision/"+id,
            //data : datos,
            cache: false,
                beforeSend: function(){
                    $("#td"+id).html('');
                    $("#td"+id).html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/loading.gif"></center>');
                },
                success: function(data)
                {
                    $("#td"+id).html('');
                    $("#td"+id).html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/ready.gif"></center>');
                    setTimeout(function(){
                        //location.reload();
                        $("#td"+id).html('');
                        $("#td"+id).html('<a class="btn waves-effect waves-light" onclick="desactiva('+id+');" ><i class="mdi-action-delete left"></i>Desactivar</a>');
                    }, 1500);
                },
                error: function ()
                {
                    $("#td"+id).html('');
                    $("#td"+id).html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/x.png"></center>');
                    setTimeout(function(){
                        //location.reload();
                        $("#td"+id).html('');
                        $("#td"+id).html('<a class="btn waves-effect waves-light blue" onclick="activa('+id+');" ><i class="mdi-navigation-check left"></i>Activar</a>');
                    }, 1500);
                }
            });
            console.log('activando, el id es: '+id);
        };

        function desactiva(idbtn) {
            var id=idbtn;
            var uri=<?php echo $raiz ?>;
            $.ajax({
            url : uri + "admin/elimRevision/"+id,
            //data : datos,
            cache: false,
                beforeSend: function(){
                    $("#td"+id).html('');
                    $("#td"+id).html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/loading.gif"></center>');
                },
                success: function(data)
                {
                    $("#td"+id).html('');
                    $("#td"+id).html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/ready.gif"></center>');
                    setTimeout(function(){
                        //location.reload();
                        $("#td"+id).html('');
                        $("#td"+id).html('<a class="btn waves-effect waves-light blue" onclick="activa('+id+');" ><i class="mdi-navigation-check left"></i>Activar</a>');
                    }, 1500);
                },
                error: function ()
                {
                    $("#td"+id).html('');
                    $("#td"+id).html('<center><img class="animated-gif"  src="'+uri+'resources/imagenes/x.png"></center>');
                    setTimeout(function(){
                        //location.reload();
                        $("#td"+id).html('');
                        $("#td"+id).html('<a class="btn waves-effect waves-light" onclick="desactiva('+id+');" ><i class="mdi-action-delete left"></i>Desactivar</a>');
                    }, 1500);
                }
            });
            console.log('desactivando, el id es: '+id);
        };

    </script>
</body>
</html>