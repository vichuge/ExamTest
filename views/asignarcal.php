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
            <form method="POST" action="<?php echo $raiz ?>admin/asigrevisionalta">
                <!-- Aqui va el código-->
                <div class="row">
                    <div class="col s12">
                        <center><h1>Asignar Calificador</h1></center>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m12 l4">
                        <p>Examen</p>
                        <select required class="validate" name="idexamen" id="selecty">
                            <option value="0" selected >Seleccione...</option>
                            <?php
                            foreach ($examenes as $key => $value) {
                                echo'<option value="' . $examenes[$key]['idexamen'] . '" > ' . $examenes[$key]['nomexamen'] . '</option>';  
                            }
                            ?>
                            <!--<option value="" disabled>Seleccione...</option>
                            <option value="1" selected>Instrumento de habilidades de pensamiento superior</option>
                            <option value="2" disabled>Examen de ejemplo</option>-->
                        </select>
                    </div>
                    <div class="col s12 m12 l8">
                        <p>Calificador</p>
                        <select required class="validate" name="idusuariocalificador">
                            <option value="0" disabled >Seleccione...</option>
                            <?php
                            $selected="selected";
                            foreach ($calificadores as $key => $value) {
                                echo'<option value="' . $calificadores[$key]['idusuario'] . '" '.$selected.' >' . $calificadores[$key]['nomusuario'] . ' ' . $calificadores[$key]['apeusuario'] . ' ' . $calificadores[$key]['lastusuario'] . '</option>';
                                $selected="";
                            }
                            ?>
                        </select>
                    </div>
                    <!--<div class="col s12 m12 l2">
                        <a class="waves-effect waves-light btn" disabled><i class="mdi-action-search left"></i>Buscar</a>
                    </div>-->
                </div>
                <div class="row">
                    <div class="col s12 m12 l12">
                        <button class="waves-effect waves-light btn" type="submit"><i class="mdi-action-done left"></i>Asignar</button>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <div class="col s12 m12 l12" id="divtable">
                        <!--<table id="data-table-simple" class="responsive-table display" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Folio</th>
                                    <th>Nombre alumno</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Folio</th>
                                    <th>Nombre alumno</th>
                                </tr>
                            </tfoot>

                            <tbody id="tbody">
                                <?php
                                foreach ($alumnos as $key => $value) {
                                    /*echo'
                                    <tr>
                                        <td>
                                            <p>
                                                <input type="checkbox" id="test' . $alumnos[$key]['idusuario'] . '" value="' . $alumnos[$key]['idusuario'] . '" name="check-list['.$alumnos[$key]['idusuario'].']" />
                                                <label for="test' . $alumnos[$key]['idusuario'] . '"></label>
                                            </p>
                                        </td>
                                        <td>' . $alumnos[$key]['folusuario'] . '</td>
                                        <td>' . $alumnos[$key]['nomusuario'] . ' ' . $alumnos[$key]['segnomusuario'] . ' ' . $alumnos[$key]['apeusuario'] . ' ' . $alumnos[$key]['lastusuario'] . '</td>
                                    </tr>
                                ';*/
                                }
                                ?>
                            </tbody>
                        </table>-->
                    </div>
                </div>
                
            </form>
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
    $(function ready(){
        $(".dropdown-content.select-dropdown li").on("click", function () {
            var that = this;
            setTimeout(function () {
                if ($(that).parent().hasClass('active')) {
                    $(that).parent().removeClass('active');
                    $(that).parent().hide();
                }
            }, 100);
        });
        $('#selecty').change(function(){
            if(this.value !=0){
                //console.log(this.value);
                $("#selecty option:selected").each(function() {
                    idexamen = $('#selecty').val();
                    $.post("http://<?php echo $_SERVER['SERVER_NAME'].$raiz?>ajax/refreshtab", {
                        idexamen : idexamen
                    }, function(data) {
                        $("#divtable").html(data);
                        ready();
                        //$("#divtable").load(" #divtable");
                    });
                });
            }else{
            //$('input:checkbox').removeAttr('checked');
            $("#tbody").html('<tr class="odd"><td valign="top" colspan="3" class="dataTables_empty"> No data available in table</td></tr>');
            }
        });
    });
</script>
</body>
</html>