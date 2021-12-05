<?php

function getStatus($arg_status)
{
    $status = 0;
    if (isset($arg_status)) {
        $status = 1;
    }
    return $status;
}




?>