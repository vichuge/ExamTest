<!-- START LEFT SIDEBAR NAV-->
      <aside id="left-sidebar-nav">
        <ul id="slide-out" class="side-nav fixed leftside-navigation">
            <li class="user-details cyan darken-2">
            <div class="row">
                <div class="col col s4 m4 l4">
                    <img src="<?php echo $raiz ?>resources/imagenes/chase.png" alt="" class="circle responsive-img valign profile-image">
                </div>
                <div class="col col s8 m8 l8">
                    <ul id="profile-dropdown" class="dropdown-content">
                        <?php
                        if($this->session->idrol==1){
                            echo '<li><a href="'.$raiz.'admin/prof/0"><i class="mdi-action-face-unlock"></i> Profile</a>
                        </li>';
                        }
                        ?>
                        
                        <!--<li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                        </li>-->
                        <!--<li class="divider"></li>-->
                        <li><a href="<?php echo $raiz ?>"><i class="mdi-hardware-keyboard-tab"></i> Logout</a>
                        </li>
                    </ul>
                    <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown"><?php echo $this->session->usuario; ?><i class="mdi-navigation-arrow-drop-down right"></i></a>
                    <p class="user-roal"><?php echo $this->session->nomrol; ?></p>
                </div>
            </div>
            </li>
            <?php
            $nomrol=$this->session->nomrol;
            switch ($nomrol) {
                case 'administrador':
                    echo '
                        <li class="li-hover"><p class="ultra-small margin more-text">Administrador</p></li>
                        <li class="bold"><a href="'.$raiz.'login/user" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Home</a></li>
                        <li class="bold"><a href="'.$raiz.'admin/usuarios" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Alumnos</a></li>
                        <li class="bold"><a href="" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Crear Examen<span class="badge">Prox.</span></a></li>
                        <!--<li class="bold"><a href="'.$raiz.'admin/impformat" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Imprimir formatos</a></li>-->
                        <li class="bold"><a href="'.$raiz.'admin/lstrevision/0" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Asignar calificadores</a></li>
                        <li class="bold"><a href="'.$raiz.'admin/calificaciones" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Ver calificaciones</a></li>
                    ';
                    break;
                case 'calificador':
                    echo '
                        <li class="bold"><a href="'.$raiz.'login/user" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Home</a></li>
                        <li class="bold"><a href="'.$raiz.'calif/asignados" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Calificaciones asignadas</a></li>
                    ';
                    break;
                case 'elaborador':
                    echo '
                        <li class="bold"><a href="'.$raiz.'login/user" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Home</a></li>
                        <li class="bold"><a href="#" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Elaboraciones pendientes</a></li>
                    ';
                    break;
                case 'alumno':
                    echo '
                        
                    ';
                    break;
                default:
                    echo '
                        <li class="bold"><a href="'.$raiz.'login/user" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>Home</a></li>
                        <li class="bold"><i class="mdi-action-dashboard"></i>Error, sesion perdida!!</li>
                    ';
                    break;
            }
            ?>            
        </ul>
        <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
        </aside>
      <!-- END LEFT SIDEBAR NAV-->
