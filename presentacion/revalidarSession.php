<?php

session_start();

if (!isset($_SESSION['usuario']))
{
    header($_SERVER['SERVER_PROTOCOL']. ' 401 Unauthorized');
    die();
}
else
{
    define('USUARIO', $_SESSION['usuario']);
}