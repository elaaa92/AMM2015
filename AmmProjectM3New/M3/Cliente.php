<?php

if(!isset($_SESSION['ruolo']))
{
   $state = 0;
   echo "<h1> Errore </h1>";
}
else if($_SESSION['ruolo']=='venditore')
{
    $state = 1;
    echo "<h1> Errore </h1>";
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
    echo "<h1> Prodotti </h1>";
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
            if(isset($_REQUEST['ricerca']))
            {
                if(isset($_REQUEST['filtro']) && isset($_REQUEST['chiave']))
                {
                    $chiave=$_REQUEST['chiave'];
                    $filtro=$_REQUEST['filtro'];
                }
                else
                {
                    $filtro='tutto';
                }
                switch ($filtro)
                {
                    case 'nome':
                    {
                        $lista = Articolo::cercaNome($chiave);
                        break;
                    }
                    case 'id':
                    {
                        $lista = Articolo::cercaId($chiave);
                        break;
                    }
                    case 'categoria':
                    {
                        $lista = Articolo::cercaCategoria($chiave);
                        break;
                    }
                    case 'venditore':
                    {
                        $lista = Articolo::cercaVenditore($chiave);
                        break;
                    }
                    case 'tutto':
                    {
                        $lista=Articolo::oggettiInVendita();
                        break;
                    }
                }
            }
            else 
            {
                $lista=Articolo::oggettiInVendita();
            } 
            if(isset($_REQUEST['listaArticoli']))
            {
                compila($lista);
            }
            else if(isset($_REQUEST['idArticolo']))
            {
                $id=$_REQUEST['idArticolo'];
                $_SESSION['articolo'] = $lista[$id];
                descrizione();
                echo "<form id=formCompra> <label for='quantita'> Quantita </label>
                <input type='number' id='quantita' name='quantita' value='1'><br/>
                <input type='submit' id='compra' name='compra' value='Conferma'> </form>";
            }
            else if(isset($_SESSION['articolo']) && isset($_REQUEST['compra']) && isset($_REQUEST['quantita']))
            {
                $riuscito=$_SESSION['utente']->compraArticolo($_SESSION['articolo'],$_REQUEST['quantita']);
                descrizione();
                if($riuscito)
                {
                    echo "<p> Oggetto acquistato! </p>";
                }
                else 
                {
                    echo "<p> Acquisto non effettuato: il saldo non è sufficiente </p>";
                }
                echo "<br/> <a href=cliente.php> Torna alla lista </a>";
            }
            break;
        }
    }
}   

function compila($lista)
{   

    echo "<h2> Cerca </h2>"
    . "<form>"
        . "<select name='filtro' size='1'>"
            ."<option value='tutto'>Tutto</option>"
            . "<option value='nome'>Nome</option>"
            . "<option value='id'>Id</option>"
            . "<option value='categoria'>Categoria</option>"
            . "<option value='venditore'>Venditore</option>"
        . "</select>"
        . "<input type='text' id='chiave' name='chiave'/>"
        . "<input type='submit' id='ricerca' name='ricerca' value='Cerca'/>"
    . "</form>";
    
    echo "
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Foto</th>
                    <th>Disponibili</th>
                    <th>Prezzo</th>
                    <th>Compra</th>
                </tr>";
    
    foreach($lista as $elemento)
    {
        echo "
        <tr>
            <td> " .  $elemento->getNome()  . "</td>
            <td><img src=" . $elemento->getImmagine(). " alt='Non disponibile' /> </td>
            <td>" . $elemento->getDisponibili(). "</td>
            <td>" . $elemento->getPrezzo() . "</td>
            <td>
                <a href='cliente.php?idArticolo=" . $elemento->getId() . "' >Compra</a>
            </td>
        </tr>";
    }
    
    echo "</table>";
}

function descrizione()
{
    $articolo=$_SESSION['articolo'];
    echo "<h1>" . ($articolo->getNome()) . "</h1>"
    . "<p> <img src=" . ($articolo->getImmagine()) . " alt='Non disponibile' width='100' height='100'/>" 
    . "<br/> <br/>" . ($articolo->getDescr()) . "<br/>"
    . "Prezzo " . ($articolo->getPrezzo()) . "&euro; <br/>"
    . "Disponibili " . ($articolo->getDisponibili()) . " pezzi </p>";
}