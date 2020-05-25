<?php
session_start();

if(isset($_SESSION['DNIEmpleado']))
{
    
}
else
{
    header('Location: ../login.html');
}