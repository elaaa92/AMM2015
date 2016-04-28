<?php

if(!isset($_SESSION['ruolo']))
{
   $state = 0;
   echo "<h1> Errore </h1>";
}
else if($_SESSION['ruolo']=='cliente')
{
    $state = 1;
    showLogout();
    echo "<h1> Errore </h1>";
}
else
{
    $state = 2;
    showLogout();
    echo "<h1> Inserisci nuovo oggetto </h1>";
}

function showLogout()
{
    echo "<form>
        <input type='submit' id='logout' name='logout' value='Logout'>
    </form>";
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
            if(isset($_REQUEST['conferma']))
            {
                echo '<p> Articolo inserito! </p>';
            }

            echo "

                <form>
                        <label for='nome'> Nome oggetto </label>
                        <input type='text' id='nome' name='nome'>
                        <br/>
                        <label for='img'> Immagine </label>
                        <input type='url' id='img' name='img'>
                        <br/> 
                        <label for='descr'> Descrizione </label>
                        <br/>
                        <textarea id='descr' rows='4' cols='70'></textarea>
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

