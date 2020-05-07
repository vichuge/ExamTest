<?php
$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
if ($nomrol !="administrador") { //esta línea ira dependiendo quienes se desea que puedan entrar al script.
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
                            <h1>Lista de alumnos</h1>
                        </div>
                    </div>
                    <div class="row">
                        <form method="POST" action="<?php echo $raiz ?>admin/usuarios">
                            <div class="col s12 m12 l4">
                                <p>Examen</p>
                                <select name="idexamen">
                                    <option value="0">Seleccione...</option>
                                    <?php
                                    foreach ($examenes as $key => $value) {
                                        if ($examenes[$key]['idexamen'] == $idexamen) {
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
                            <div class="row">
                                <div class="col s12">
                                    <button class="waves-effect waves-light btn"><i class="mdi-action-search left"></i>Buscar</button>
                                </div>
                            </div>
                        </form>
                        <form method="POST" action="<?php echo $raiz ?>admin/pdfusus">
                            <div class="row">
                                <div class="col s12">
                                    <input type="hidden" name="idexamen" value="<?php echo $idexamen ?>"/>
                                    <input type="hidden" name="idprograma" value="<?php echo $idprograma ?>"/>
                                    <center><button formtarget="_blank" class="waves-effect waves-light btn "><i class="mdi-image-grid-on left"></i>Generar Listado</button></center>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table id="data-table-simple" class="responsive-table display" cellspacing="0" width="100%">
                        <!--<table id="data-table-row-grouping" class="responsive-table display" cellspacing="0" width="100%"> -->
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Folio</th>
                                        <th>Examen</th>
                                        <th>Programa</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>id</th>
                                        <th>Nombre</th>
                                        <th>Usuario</th>
                                        <th>Folio</th>
                                        <th>Examen</th>
                                        <th>Programa</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php
                                    if ($usuarios != 0) {
                                        foreach ($usuarios as $key => $value) {
                                            echo'
                                                <tr>
                                                <td>'.$usuarios[$key]['idusuario'].'</td>
                                                <td>'.$usuarios[$key]['nomusuario'].' '.$usuarios[$key]['segnomusuario'].' '.$usuarios[$key]['apeusuario'].' '.$usuarios[$key]['lastusuario'].'</td>
                                                  <td>' . $usuarios[$key]['usuario'] . '</td>
                                                  <td>' . $usuarios[$key]['folusuario'] . '</td>
                                                  <td>' . $usuarios[$key]['nomexamen'] . '</td>
                                                  <td>' . $usuarios[$key]['nomprograma'] . '</td>
                                                  <td><a class="btn waves-effect waves-light blue" href="'.$raiz.'admin/prof/'.$usuarios[$key]['idusuario'].'">Perfil</a></td>
                                                  <td><a target="_blank" class="btn waves-effect waves-light blue" href="'.$raiz.'admin/pdfusu/'.$usuarios[$key]['idusuario'].'">Carta</a></td>
                                                </tr>
                                            ';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
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