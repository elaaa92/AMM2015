<?php

if(isset($_REQUEST['f']) && isset($_REQUEST['q']))
{
    include ('../Model/Settings.php');
    include('../Model/UtenteCliente.php');
    include('../Model/UtenteVenditore.php');
    include('../Model/Articolo.php');
    include('../Model/Conto.php');

    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Content-type: application/json');

    $json = array();

    if($_REQUEST['f'] != null)
    {
        $filtro=$_REQUEST['f'];
    }
    else
    {
        $filtro='tutto';
    }

    if($_REQUEST['q'] != null)
    {
        $chiave=$_REQUEST['q'];
    }
    else
    {
        $chiave='tutto';
    } 
    
    
    if($_REQUEST['venditore'] != '')    //Campo hidden del form di ricerca
    {
        $venditore = $_REQUEST['venditore'];
        $lista=Articolo::oggettiInVendita($venditore,$filtro,$chiave);
        $json[0]['venditore']=$venditore;
    }
    else
    {
        $lista=Articolo::oggettiInVendita(null,$filtro,$chiave);
        $json[0]['venditore']= '';
    }

    $i = 1;
    if($lista!=null)
    {

        foreach($lista as $elemento)
        {
            $json[$i]['id']=$elemento->getId();     //Necessario per il link di acquisto
            $json[$i]['nome']=$elemento->getNome();
            $json[$i]['foto']=$elemento->getImmagine();
            $json[$i]['disponibili']=$elemento->getDisponibili();
            $json[$i]['prezzo']=$elemento->getPrezzo();
            $i++;
        }
    }

    echo json_encode($json);
}