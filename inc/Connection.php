<?php
function connecter()
{
    static $connect = null;
    if ($connect === null) 
    {
        $connect = mysqli_connect('localhost', 'root', '', 'ajaxfb');
    }
    return $connect;
}

?>