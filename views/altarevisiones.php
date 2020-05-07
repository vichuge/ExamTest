<?php
if($insertar=="TRUE"){
    header('Location: ' . $raiz . 'admin/lstrevision/1');
}
elseif ($insertar=="FALSE")
{
    header('Location: ' . $raiz . 'admin/lstrevision/2');
}
elseif ($insertar==0){
    header('Location: ' . $raiz . 'admin/lstrevision/6');
}else{
    echo'Hubo un problema, contacta al administrador :)';
}