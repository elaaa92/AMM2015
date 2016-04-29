<?php
include('./Model/UtenteCliente.php');
include('./Model/UtenteVenditore.php');
include('./Model/Articolo.php');
include('./Model/Conto.php');
session_start();

if(isset($_SESSION['ruolo']) && $_SERVER['REQUEST_URI']=='/AmmProjectM3/M3/login.php')
{
    reindirizza(); 
}
else if(isset($_REQUEST['login']) && isset($_REQUEST['id']) && isset($_REQUEST['password']))
{
    if(!login())
    {
        echo "<p id='error'> Autenticazione fallita </p>";
        logout();
    }
    else
    {
        reindirizza();
    }
}
else if(isset($_REQUEST['logout']))
{
    unset($_REQUEST['login']);
    unset($_REQUEST['logout']);
    logout();
    header("location: ./descrizione.php");
    exit;
}

function reindirizza()
{
    $ruolo=$_SESSION['ruolo'];

    if($ruolo == 'cliente')
    {
        header("location: ./cliente.php");
        exit;
    }
    else if($ruolo == 'venditore')
    {
        header("location: ./venditore.php");
        exit;
    }
}

function login()
{
    if($_REQUEST['id']=='cliente')   //fa un controllo e assegna il ruolo corretto
    {
        $_SESSION['utente']=new UtenteCliente($_REQUEST['id'], $_REQUEST['password']);
        $_SESSION['ruolo']=$_REQUEST['id']; 
        return true;   
    }
    else if($_REQUEST['id']=='venditore')
    {
        $_SESSION['utente']=new UtenteVenditore($_REQUEST['id'], $_REQUEST['password']);
        $_SESSION['ruolo']=$_REQUEST['id'];    //fa un controllo e assegna il ruolo corretto
        return true;   
    }
    else
    {
        return false;
    }
}

function logout()
{
    $_SESSION = array();
    if(session_id() !="" || isset($_COOKIE[session_name()]))
    {
        setcookie(session_name(), '', time() -2592000, '/');
        session_destroy();
    }
}
?>
