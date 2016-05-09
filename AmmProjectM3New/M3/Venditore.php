<?php

if(!isset($_SESSION['ruolo']))
{
   $state = 0;
   echo "<h1> Errore </h1>";
}
else if($_SESSION['ruolo']=='cliente')
{
    $state = 1;
    echo "<h1> Errore </h1>";
}
else
{
    $state = 2;
    echo "<h1> Inserisci nuovo oggetto </h1>";
}

function content($state)
{
    switch ($state)
    {
        case 0:
        {
            echo "<p> Accesso non effettuato <p>";
            break;
        }
        case 1:
        {
            echo "<p> Accesso negato <p>";
            break;
        }
        case 2:
        {
            if(isset($_REQUEST['conferma']) && isset($_REQUEST['categoria']) && isset($_REQUEST['nome']) && isset($_REQUEST['img']) && isset($_REQUEST['descr']) && isset($_REQUEST['prezzo']) && isset($_REQUEST['disponibili']))
            {
                $_SESSION['articolo']=new Articolo($_SESSION['utente'], $_REQUEST['categoria'], $_REQUEST['nome'], $_REQUEST['prezzo'], $_REQUEST['descr'], $_REQUEST['disponibili'], $_REQUEST['img']);
                $_SESSION['utente']->inserisciArticolo($_SESSION['articolo'],$_REQUEST['disponibili']);
                descrizione();
                echo '<p> Articolo inserito! </p> <br/> <a href=venditore.php> Torna alla pagina di inserimento </a>';
            }
            else
            {
                echo "

                    <form>
                            <label for='categoria'> Categoria oggetto </label>
                            <input type='text' id='categoria' name='categoria'>
                            <br/>
                            <label for='nome'> Nome oggetto </label>
                            <input type='text' id='nome' name='nome'>
                            <br/>
                            <label for='img'> Immagine </label>
                            <input type='url' id='img' name='img'>
                            <br/> 
                            <label for='descr'> Descrizione </label>
                            <br/>
                            <textarea id='descr' name='descr' rows='4' cols='70'></textarea>
                            <br/>
                            <label for='prezzo'> Prezzo </label>
                            <input type='number' id='prezzo' name='prezzo'>
                            <br/>
                            <label for='disponibili'> Quantità disponibile </label>
                            <input type='number' id='disponibili' name='disponibili'>
                            <br/>
                            <br/>
                            <input type='submit' id='conferma' name='conferma' value='Conferma'/>
                        </form>";
                break;
            }
        }
    }
}


function descrizione()
{
    echo "<h1>" . $_REQUEST['nome'] . "</h1>"
        . "<p> Categoria " . $_REQUEST['categoria'] . "</p>"
        . "<p> <img src=" . $_REQUEST['img'] . " alt='Non disponibile' width='100' height='100'/>" 
        . "<br/> <br/>" . $_REQUEST['descr'] . "<br/>"
        . "Prezzo " . $_REQUEST['prezzo'] . "&euro; <br/>"
        . "Disponibili " . $_REQUEST['disponibili'] . " pezzi </p>";
}

