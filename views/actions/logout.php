<?php
if (isset($_COOKIE['session_token'])) {
    unset($_COOKIE['session_token']); 
    setcookie('session_token', '', -1, '/'); 
} 
header('Location: /Lr');

?>