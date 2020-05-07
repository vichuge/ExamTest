<?php
if($activar=="TRUE"){
    header('Location: ' . $raiz . 'admin/lstrevision/5');
}
elseif ($activar=="FALSE")
{
    header('Location: ' . $raiz . 'admin/lstrevision/4');
}
else{
    echo'Hubo un problema, contacta al administrador :)';
}