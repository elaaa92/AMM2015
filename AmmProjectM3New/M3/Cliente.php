<?php

include ("./Model/Articolo.php");
if(!isset($_SESSION['ruolo']))
{
   $state = 0;
   echo "<h1> Errore </h1>";
}
else if($_SESSION['ruolo']=='venditore')
{
    $state = 1;
    showLogout();
    echo "<h1> Errore </h1>";
}
else
{
    $state = 2;
    showLogout();
    echo "<h1> Prodotti </h1>";
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
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Foto</th>
                        <th>Disponibili</th>
                        <th>Prezzo</th>
                        <th>Compra</th>
                    </tr>";
            compila();
            
            echo "</table>";
        break;
        }
    }
}   
function compila()
{
    $lista = Articolo::oggettiInVendita();
    
    foreach($lista as $elemento)
    {
        echo "
        <tr>
            <td> " .  ($elemento->getNome())  . "</td>
            <td><img src=" . ($elemento->getImmagine()) . " alt='Non disponibile' /> </td>
            <td>" . ($elemento->getDisponibili()) . "</td>
            <td>" . ($elemento->getPrezzo()) . "</td>
            <td>
                <a onclick='descrizione(" . $elemento->getId() . ")'>Compra</a>
            </td>
        </tr>";
    }
    
    /*
    echo "
        <tr>
            <td>Scarpe da corsa</td>
            <td><img src='../Immagini/scarpe.png' alt='Non disponibile'/></td>
            <td>5</td>
            <td>80,00 Euro</td>
            <td>
                <a onclick='descrizione($elemento.getId())'>Compra</a>
            </td>
        </tr>
        <tr>
            <td>Tavola da surf</td>
            <td><img src='../Immagini/tavola.png' alt='Non disponibile'/></td>
            <td>100</td>
            <td>30,00 Euro</td>
            <td>
                <a onclick='descrizione($elemento)'>Compra</a>
            </td>
        </tr>
        <tr>
            <td>Tuta da ciclista</td>
            <td><img src='../Immagini/tuta.png' alt='Non disponibile'/></td>
            <td>2</td>
            <td>40,00 Euro</td>
            <td>
                <a href='cliente.php'>Compra</a>
            </td>
        </tr>
        <tr>
            <td>Sbarra per trazioni</td>
            <td><img src='../Immagini/sbarra.png' alt='Non disponibile'/></td>
            <td>200</td>
            <td>16,00 Euro</td>
            <td>
                <a href='cliente.php'>Compra</a>
            </td>
        </tr>
        <tr>
            <td>Guantoni da boxe</td>
            <td><img src='../Immagini/guantoni.png' alt='Non disponibile'/></td>
            <td>147</td>
            <td>30,00 Euro</td>
            <td>
                <a href='cliente.php'>Compra</a>
            </td>
        </tr>";*/
}
