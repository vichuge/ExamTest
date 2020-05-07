<?php
if($eliminar=="TRUE"){
    header('Location: ' . $raiz . 'admin/lstrevision/3');
}
elseif ($eliminar=="FALSE")
{
    header('Location: ' . $raiz . 'admin/lstrevision/4');
}
else{
    echo'Hubo un problema, contacta al administrador :)';
}