<?php
$nomrol = $this->session->nomrol;
$idusuario = $this->session->idusuario;
if ($nomrol != "administrador"){ //&& $idusuario != $id) { //esta línea ira dependiendo quienes se desea que puedan entrar al script.
    header('Location: ' . $raiz . '');
}
?>

<?php
include_once('head.php');
?>

<style type="text/css">
    .error{
        font-size: 14px;
        color: #ff4081;
    }
    input{
        margin: 0 0 0 0 !important;
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

                <div class="row">
                    <div class="col s1">
                        <?php 
                        if (!isset($perfil))
                            echo'<br/><a href="'.$raiz.'admin/prof/0" class="btn-floating btn-large waves-effect waves-light red"><i class="mdi-hardware-keyboard-backspace left">add</i></a>';
                            
                        ?>       
                    </div>
                    <div class="col s9">
                        <?php
                        if (isset($perfil))
                            echo'<h1>Perfil: '.$perfil[0]['nomusuario'].' '.$perfil[0]['segnomusuario'].' '.$perfil[0]['apeusuario'].' '.$perfil[0]['lastusuario'].'</h1>';
                        else
                            echo'<h1>Agregar usuario</h1>';
                        ?>
                    </div>
                    <div class="col s2">
                        <br>
                        <?php
                        if (isset($perfil) && $perfil[0]['idrol'] ==1)
                            echo'<a href="' . $raiz . 'admin/addprof" class="waves-effect waves-light btn right"><i class="mdi-content-add right"></i>Agregar usuario</a>';
                        ?>
                    </div>
                </div>
                <div class="card-panel">
                    <form method="POST" action="<?php echo $raiz ?>admin/changeuser" id="formValidate">
                        <?php
                        if(isset($perfil)){
                            $iduser=$perfil[0]['idusuario'];
                        }else{
                            $iduser=0;
                        }
                        ?>
                        <input type="hidden" name="idusuario" value="<?php echo $iduser ?>" />
                        <div class="row">
                            <h5>Datos personales</h5>
                            <!--
                            <div class="row">
                            <label>Username*</label>
                            <input id="uname" name="uname" type="text" data-error=".errorTxt1">
                            <div class="errorTxt1"></div>
                            </div>
                            -->
                            <div class="col s12 m12 l6">
                                <label>Primer nombre</label>
                                <input placeholder="Escribe aqui..." id="first_name" name="first_name" type="text" data-error=".errorTxt1" 
                                <?php
                                if (isset($perfil[0]['nomusuario']))
                                    echo 'value="' . $perfil[0]['nomusuario'] . '"';
                                ?>>
                                <div class="errorTxt1"></div>
                            </div>
                            <div class="col s12 m12 l6">
                                <label>Nombres adicionales</label>
                                <input placeholder="Escribe aqui..." id="second_name" name="second_name" type="text" data-error=".errorTxt2"
                                <?php
                                if (isset($perfil[0]['nomusuario']))
                                    echo 'value="' . $perfil[0]['segnomusuario'] . '"';
                                ?>>
                                <div class="errorTxt2"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l6">
                                <label>Apellido paterno</label>
                                <input placeholder="Escribe aqui..." id="last_name" name="last_name" type="text" data-error=".errorTxt3"
                                <?php
                                if (isset($perfil[0]['nomusuario']))
                                    echo 'value="' . $perfil[0]['apeusuario'] . '"';
                                ?>>
                                <div class="errorTxt3"></div>
                            </div>
                            <div class="col s12 m12 l6">
                                <label>Apellido materno</label>
                                <input placeholder="Escribe aqui..." id="mother_name" name="mother_name" type="text" data-error=".errorTxt4"
                                <?php
                                if (isset($perfil[0]['nomusuario']))
                                    echo 'value="' . $perfil[0]['lastusuario'] . '"';
                                ?>>
                                <div class="errorTxt4"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l6">
                                <label>E-mail</label>
                                <input placeholder="Escribe aqui..." id="email" name="email" type="text" data-error=".errorTxt5"
                                <?php
                                if (isset($perfil[0]['nomusuario']))
                                    echo 'value="' . $perfil[0]['email'] . '"';
                                ?>>
                                <div class="errorTxt5"></div>
                            </div>
                            <div class="col s12 m12 l6">
                                <label>CURP</label>
                                <input placeholder="Escribe aqui..." id="curp" name="curp" type="text" data-error=".errorTxt6"
                                <?php
                                if (isset($perfil[0]['nomusuario']))
                                    echo 'value="' . $perfil[0]['curp'] . '"';
                                ?>>
                                <div class="errorTxt6"></div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <h5>Datos de usuario</h5>
                            <div class="col s12 m12 l6">
                                <label>Nombre de usuario</label>
                                <input placeholder="Escribe aqui..." id="user_name" name="user_name" type="text" data-error=".errorTxt9"
                                <?php
                                if (isset($perfil[0]['nomusuario']))
                                    echo 'value="' . $perfil[0]['usuario'] . '"';
                                ?>>
                                <div class="errorTxt9"></div>
                            </div>
                            <div class="col s12 m12 l6">
                                <label>Rol</label>
                                <?php
                                    if (isset($perfil) && $perfil[0]['idrol'] == 1) {
                                        $disabled = "disabled";
                                    } else {
                                        $disabled = "";
                                    }
                                ?>
                                <select name="idrol" id="selectroles" <?php echo $disabled ?>>
                                    <option value="0">Seleccione...</option>
                                    <?php
                                    foreach ($roles as $key => $value) {
                                        if (isset($perfil) && $perfil[0]['idrol'] == $roles[$key]['idrol']) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        if ($roles[$key]['idrol'] == 1) {
                                            $disabled = "disabled";
                                        } else {
                                            $disabled = "";
                                        }
                                        echo '<option ' . $selected . ' value="' . $roles[$key]['idrol'] . '" ' . $disabled . '>' . $roles[$key]['nomrol'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row" id="hiddendiv" <?php if(isset($perfil)){if($perfil[0]['idrol']==4){echo 'style="display:block"';}else {echo 'style="display:none"';}}else{echo 'style="display:none"';} ?> >
                            <div class="col s12 m12 l6">
                                <label>Programa</label>
                                <?php
                                    if (isset($perfil) && $perfil[0]['idrol'] != 4) {
                                        $disabled = "disabled";
                                    } else {
                                        $disabled = "";
                                    }
                                ?>
                                <select name="idprograma" <?php echo $disabled ?> id="selectprogramas">
                                    <option value="0">Seleccione...</option>
                                    <?php
                                    foreach ($programas as $key => $value) {
                                        if (isset($perfil) && $perfil[0]['nomprograma'] == $programas[$key]['nomprograma']) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo '<option ' . $selected . ' value="' . $programas[$key]['idprograma'] . '">' . $programas[$key]['nomprograma'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col s12 m12 l6">
                                <label>Examen (solo alumnos)</label>
                                <?php
                                    if (isset($perfil) && $perfil[0]['idrol'] != 4) {
                                        $disabled = "disabled";
                                    } else {
                                        $disabled = "";
                                    }
                                ?>
                                <select name="idexamen" <?php echo $disabled ?> id="selectexamenes">
                                    <option value="0">Seleccione...</option>
                                    <?php
                                    foreach ($examenes as $key => $value) {
                                        if (isset($perfil) && $perfil[0]['idexamen'] == $examenes[$key]['idexamen']) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                        echo '<option ' . $selected . ' value="' . $examenes[$key]['idexamen'] . '">' . $examenes[$key]['nomexamen'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l6">
                                <label>Folio</label>
                                <input placeholder="Escribe aqui..." id="folio" name="folio" type="text" class="validate" data-error=".errorTxt7"
                                <?php
                                if (isset($perfil[0]['nomusuario']))
                                    echo 'value="' . $perfil[0]['folusuario'] . '"';
                                ?>>
                                <div class="errorTxt7"></div>
                            </div>
                            <div class="col s12 m12 l6">
                                <?php
                                if($iduser == 0){
                                    echo '<label>Password</label>';
                                }      
                                if (isset($perfil))
                                    $disabled = "disabled";
                                else
                                    $disabled = "";
                                if($iduser == 0){
                                    echo '<input '.$disabled.' placeholder="Escribe aqui..." id="password" name="password" type="text" class="validate" data-error=".errorTxt8"';
                                    if (isset($perfil[0]['nomusuario']))
                                        echo ' value="' . $perfil[0]['decrypt'] . '" >
                                            <div class="errorTxt8"></div>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l6">
                                <?php
                                if ($id == 0)
                                    echo'<br/><button class="waves-effect waves-light btn"><i class="mdi-content-add left"></i>Crear</button>';
                                else
                                    echo'<button class="waves-effect waves-light btn"><i class="mdi-editor-mode-edit left"></i>Editar</button>';
                                ?>
                            </div>
                        </div>
                        <!--<div class="row">
                            <label>Username*</label>
                            <input id="uname" name="uname" type="text" data-error=".errorTxtn">
                            <div class="errorTxtn"></div>
                        </div>-->
                    </form>
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
    $("#formValidate").validate({
        rules: {
            uname: {
                required: true,
                minlength: 5
            },
            first_name: {
                required: true
            },
            last_name: {
                required: true
            },
            mother_name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            curp: {
                required: true,
                minlength: 18
            },
            user_name: {
                required: true,
                minlength: 5
            },
            folio: {
                required: true
            },
            password: {
                required: true
            },
            examples: {
                required: true,
                minlength: 5,
                email: true,
                equalTo: "#password",
                url: true
            }
        },
        //For custom messages
        messages: {
            uname: {
                required: "Campo requerido",
                minlength: "El nombre debe tener al menos 5 caracteres"
            },
            first_name: {
                required: "Campo requerido"
            },
            last_name: {
                required: "Campo requerido"
            },
            mother_name: {
                required: "Campo requerido"
            },
            email: {
                required: "Campo requerido",
                email: "Necesita ser un correo electronico"
            },
            curp: {
                required: "Campo requerido",
                minlength: "Mínimo 18 caracteres"
            },
            user_name: {
                required: "Campo requerido",
                minlength: "Mínimo 5 caracteres"
            },
            folio: {
                required: "Campo requerido"
            },
            password: {
                required: "Campo requerido"
            },
            examples: {
                required: "Enter a username",
                minlength: "Enter at least 5 characters"
            },
            example: "Enter wathever you want",
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        }
    });
    $('#selectroles').change(function () {
        //console.log($('#selectroles').val());
        rolin = $('#selectroles').val();
        if (rolin == 4) {
            document.getElementById("hiddendiv").style.display = "block";
        }else{
            document.getElementById("hiddendiv").style.display = "none";
        }
    });
</script>
</body>
</html>