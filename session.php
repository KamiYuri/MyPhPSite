<?php 
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

    session_start();

    if(auto_logout("session_created_time"))
    {
        session_unset();
        session_destroy();
        header("Location:login.php");         
    }

?>