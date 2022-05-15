<?php
    if (session_id() === ''){
        session_start();
    }

    function auto_logout($field)
    {
        $t = time();
        $t0 = $_SESSION[$field];
        $diff = $t - $t0;
        if ($diff > 1200 || !isset($t0))
        {
            return true;
        }
        else
        {
            $_SESSION[$field] = time();
        }
    }

    if(auto_logout("session_created_time"))
    {
        session_regenerate_id(true);
        session_unset();
        session_destroy();
        header("Location:/login.php");         
    }
?>