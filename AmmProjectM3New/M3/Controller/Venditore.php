<?php

if(!isset($_SESSION['ruolo']))              //L'utente non è loggato
{
   $state = 0;
   mostraTitolo('Errore');
}
else if($_SESSION['ruolo']=='cliente')      //L'utente è un cliente
{
    $state = 1;
    mostraTitolo('Errore');
}
else if(isset($_REQUEST['idArticolo']))     //E' stato selezionato un articolo dalla lista
{
    $state = 2;
    mostraTitolo('Descrizione articolo');
}
else if(isset($_REQUEST['inserimento']))      //Si vuole aggiungere un nuovo elemento (visualizza form)
{
    $state = 3;
    $_SESSION['modalita']='inserimento';
    mostraTitolo('Inserisci nuovo oggetto');   
}
else if(isset($_REQUEST['modifica']))       //Si vuole modificare un elemento (visualizza form)
{
    $state = 4;
    $_SESSION['modalita']='modifica';
    mostraTitolo('Modifica oggetto');
}
else if(isset($_REQUEST['elimina']))        //Si vuole eliminare un elemento (elimina)
{
    $state = 5;
    mostraTitolo('Elimina oggetto');
}
else if(isset($_REQUEST['conferma']))       //E' stata confermata una modifica o un inserimento (aggiorna e mostra)
{
    $state = 6;
    mostraTitolo('Riepilogo articolo');
}
else                                        //Lista dei propri articoli (default)
{
    $state = 7;
    mostraTitolo('Lista oggetti in vendita');
}

function content($state)
{
    switch ($state)
    {
        case 0:                 //Non loggato
        {
            vMsg('Accesso non effettuato');
            break;
        }
        case 1:                 //Cliente intruso
        {
            vMsg('Accesso negato');
            break;
        }
        case 2:  //Visualizzazione articolo scelto dalla lista
        {
            $nomeVenditore=$_SESSION['utente']->getId();
            $idArticolo=$_REQUEST['idArticolo'];
            $lista=Articolo::oggettiInVendita($nomeVenditore,'id',$idArticolo);
            $_SESSION['articolo']=reset($lista);
            //L'unico articolo con quell'id è il primo elemento della lista
            vDescrizione();
            mostraFormGestione();
            vMsg('');
            break;
        }
        case 3:                 //Form di aggiunta nuovo elemento
        {
            vForm(false);       //Il booleano indica l'abilitazione della modalità modifica
            vMsg('');
            break;
        }
        case 4:                 //Form di modifica elemento esistente
        {
            if(isset($_SESSION['articolo']))
            {
                vForm(true);    //Modalità modifica
                vMsg('');
            }
            break;
        }
        case 5:                 //Rimozione articolo
        {
            $result=$_SESSION['utente']->rimuoviArticolo($_SESSION['articolo'], 0, true); //Specifica quantità oppure
            if($result)                                                                   //rimozione completa
            {
                vMsg('Rimozione effettuata');
            }
            else
            {
                vMsg('Rimozione non riuscita');
            }
            break;
        }
        case 6:                 //Aggiunta o modifica dell'articolo (con annesso riepilogo)
        {            
            if(isset($_REQUEST['categoria']) && isset($_REQUEST['nome']) 
            && isset($_REQUEST['img']) && isset($_REQUEST['descr']) && isset($_REQUEST['prezzo']) 
            && isset($_REQUEST['disponibili']))
            {
                if($_SESSION['modalita']=='inserimento')
                {
                     //In fase di creazione l'id oggetto è inizialmente impostato a 0: il valore viene
                    //impostato al momento dell'inserimento
                    $_SESSION['articolo']=new Articolo(0, $_SESSION['utente'], $_REQUEST['categoria'], $_REQUEST['nome'], 
                    $_REQUEST['prezzo'], $_REQUEST['descr'], $_REQUEST['disponibili'], $_REQUEST['img']);
                    inserimento();
                }
                else
                {
                    $id=$_SESSION['articolo']->getId();
                    $_SESSION['articolo']=new Articolo($id, $_SESSION['utente'], $_REQUEST['categoria'], $_REQUEST['nome'], 
                    $_REQUEST['prezzo'], $_REQUEST['descr'], $_REQUEST['disponibili'], $_REQUEST['img']);
                    modifica();
                }
            }
            
            break;
        }
        case 7:                 //Visualizzazione articoli del venditore
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
            $nomeVenditore=$_SESSION['utente']->getId();
            $lista=Articolo::oggettiInVendita($nomeVenditore,$filtro,$chiave);
            vLista($lista, 'venditore');
            break;
        }
    }
    
}

function inserimento()          //Aggiorna la lista e visualizza il riepilogo
{
    $result=$_SESSION['utente']->inserisciArticolo($_SESSION['articolo']);
    if($result == 1)
    {
        vDescrizione();
        vMsg('Articolo inserito!');
    }
    else if($result == 0)
    {
        vMsg('Errore, articolo già esistente');

    }
    else
    {
        vMsg('Errore di connessione'); 
    }
}

function modifica()             //Aggiorna la lista e visualizza il riepilogo
{
    $result=$_SESSION['utente']->modificaArticolo($_SESSION['articolo']);
    if($result)
    {
        vDescrizione();
        vMsg('Articolo modificato!');
    }
    else
    {
        vMsg('Errore di connessione');
    }
}


