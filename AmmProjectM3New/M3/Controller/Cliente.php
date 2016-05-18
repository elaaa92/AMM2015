<?php

if(!isset($_SESSION['ruolo']))
{
   $state = 0;
   mostraTitolo('Errore');
}
else if($_SESSION['ruolo']=='venditore')
{
    $state = 1;
    mostraTitolo('Errore');
}
else 
{
    $state = 2;
    if(!isset($_REQUEST['idArticolo']) && !isset($_REQUEST['compra']))
    {
        $_REQUEST['listaArticoli']=true;
    }
    else 
    {
        unset($_REQUEST['listaArticoli']);
    }
    mostraTitolo('Prodotti');
}

function content($state)
{
    switch ($state)
    {
        case 0:
        {
            vMsg('Accesso non effettuato');
            break;
        }
        case 1:
        {
            vMsg('Accesso negato');
            break;
        }
        case 2:
        { 
            if(isset($_REQUEST['ricerca']) && isset($_REQUEST['filtro']) && isset($_REQUEST['chiave']))
            {
                $filtro=$_REQUEST['filtro'];
                $chiave=$_REQUEST['chiave'];
            }
            else
            {
                $filtro='tutto';
                $chiave='tutto';
            }
            $lista=Articolo::oggettiInVendita(null,$filtro,$chiave);
            if(isset($_REQUEST['listaArticoli']))
            {
                vLista($lista, 'cliente');
            }
            else if(isset($_REQUEST['idArticolo']))
            {
                $id=$_REQUEST['idArticolo'];
                $_SESSION['articolo'] = $lista["$id"];
                vDescrizione();
                mostraFormAcquisto();
            }
            else if(isset($_SESSION['articolo']) && isset($_REQUEST['compra']) && isset($_REQUEST['quantita']))
            {
                $risultato=$_SESSION['utente']->compraArticolo($_SESSION['articolo'],$_REQUEST['quantita']);
                vDescrizione();
                switch ($risultato)
                {
                    case -1:
                    {
                        vMsg('Errore di connessione');
                        break;
                    }
                    case 0:
                    {
                        vMsg('Oggetto acquistato!');
                        break;
                    }
                    case 1:
                    {
                        vMsg('Acquisto non effettuato: non ci sono sufficienti articoli');
                        break;
                    }
                    case 2:
                    {
                        vMsg('Acquisto non effettuato: saldo non sufficiente');
                        break;
                    }
                }
            }
            break;
        }
    }
}   

