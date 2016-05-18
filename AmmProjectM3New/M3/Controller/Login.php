<?php
include ('../Model/Settings.php');
include('../Model/UtenteCliente.php');
include('../Model/UtenteVenditore.php');
include('../Model/Articolo.php');
include('../Model/Conto.php');
include('../View/commonView.php');
session_start();

if(isset($_SESSION['ruolo']) && $_SERVER['REQUEST_URI']=='/AmmProjectM3/M3/View/login.php')
{
    reindirizza();
}
else if(isset($_REQUEST['login']) && isset($_REQUEST['id']) && isset($_REQUEST['password']))
{
    if(!login())
    {
        vMsg('Autenticazione fallita');
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
        $mysqli= new mysqli();
        $mysqli->connect(Settings::$db_host, Settings::$db_user,Settings::$db_password,Settings::$db_name);
        if($mysqli->connect_errno!= 0)
        {
            $idErrore= $mysqli->connect_errno;
            $msg= $mysqli->connect_error;
            return false;
        }
        else
        { 
            $id=$_REQUEST['id'];
            $password=$_REQUEST['password'];
            $match=$mysqli->query("select tipologia from utenti where id='$id' and password='$password'");
            if($match->num_rows > 0)
            {
                $utente=$match->fetch_array();

                if($utente['tipologia'] == 'cliente')
                {
                    $_SESSION['utente']=new UtenteCliente($id, $password); 
                }
                else
                {
                    $_SESSION['utente']=new UtenteVenditore($id, $password);
                }
                
                $_SESSION['ruolo']=$utente['tipologia'];
                return true;
            }
            else
            {
                return false;
            }
            mysqli_close($mysqli);
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
