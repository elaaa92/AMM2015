<?php
        
if(!isset($_SESSION['ruolo']))      //Se non è impostato il ruolo (cioè non è stato effettuato il login)
{
   $state = 0;
   mostraTitolo('Errore');          //Le echo per il momento stanno tutte su commonView
}
else if($_SESSION['ruolo']=='venditore')    //Se il ruolo impostato è quello sbagliato
{
    $state = 1;
    mostraTitolo('Errore');
}
else                                        //Se il ruolo è corretto
{
    $state = 2;
    if(!isset($_REQUEST['idArticolo']) && !isset($_REQUEST['compra']))
    {
        $_REQUEST['listaArticoli']=true;    //Se non è stato scelto un articolo in particolare o non si è cliccato
    }                                       //sul link compra si abilita la visualizzazione della lista articoli (default)
    mostraTitolo('Prodotti');
}

function content($state)                    //La funzione compila la sezione principale
{
    switch ($state)                         //Stato 0 e 1 sono di errore
    {
        case 0:                             //Non loggato
        {
            vMsg('Accesso non effettuato'); //La funzione stampa un messaggio e un eventuale link di reindirizzamento
            break;
        }
        case 1:                             //Venditore intruso
        {
            vMsg('Accesso negato');
            break;
        }
        case 2:                             //Se ci si è correttamente loggati come cliente
        { 
            $filtro='tutto';
            $chiave='tutto';
            
            $lista=Articolo::oggettiInVendita(null,$filtro,$chiave);    //Il primo parametro identifica il venditore
            
            if(isset($_REQUEST['idArticolo']))                     //Se si è scelto un elemento tramite link compra
            {
                $id=$_REQUEST['idArticolo'];
                $_SESSION['articolo'] = $lista["$id"];                  //Recupera l'elemento e lo inserisce in sessione
                vDescrizione();                                         //Mostra la descrizione
                mostraFormAcquisto();                                   //Mostra i tasti per l'acquisto
            }
            else if(isset($_SESSION['articolo']) && isset($_REQUEST['compra']) //Se si è premuto sul tasto compra
            && isset($_REQUEST['quantita']))                                   //e si è scelta la quantità
            {
                $risultato=$_SESSION['utente']->compraArticolo($_SESSION['articolo'],$_REQUEST['quantita']);
                vDescrizione();                                                 //Tenta l'acquisto, fa un resoconto
                switch ($risultato)                                             //Visualizza il risultato
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
            else if(isset($_REQUEST['listaArticoli']))
            {
                vLista($lista, null);                         //Visualizza la lista
            }
            break;
        }
    }
}