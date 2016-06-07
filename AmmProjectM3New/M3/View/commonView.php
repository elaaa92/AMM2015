<?php

function mostraTitolo($titolo)
{
    echo "<h1> $titolo </h1>";
}

function mostraLogin()
{
    if(!isset($_SESSION['ruolo']))
    {
            echo "<a href='login.php'> Login </a> <br/>";
    }
    else
    {
        if($_SERVER['REQUEST_URI']=='/AmmProjectM3/M3/View/descrizione.php')
        {
            echo "<a href='login.php'> Home utente </a> <br/>";
        }
        
        echo "<a href='descrizione.php?logout=true' id='logout'> Logout </a> <br/>";
    }
}

function vLista($lista, $nomeVenditore)  //Il nome venditore è settato solo se è stato il venditore a effettuare
{                                        //la ricerca
    echo "<h2> Cerca </h2>"
    . "<form id='cerca'>"
        . "<label for='chiave'> Filtra </label>"
        . "<input type='text' id='chiave' name='chiave'/>"
        . "<select name='filtro' id='filtro' size='1'>"
            ."<option value='tutto'>Tutto</option>"
            . "<option value='nome'>Nome</option>"
            . "<option value='id'>Id</option>"
            . "<option value='categoria'>Categoria</option>";
    if($nomeVenditore == null)
    {
        echo "<option value='venditore'>Venditore</option>"
        . "</select>"
        . "<input type='hidden' id='venditore' name='venditore' value=''>";
    }
    else
    {
        echo "</select>"
        . "<input type='hidden' id='venditore' name='venditore' value='$nomeVenditore'>";
    }
       
        echo "</select>"
        . "<input type='button' id='ricerca' name='ricerca' value='Cerca'/>"
    . "</form>";
    
    echo "
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Foto</th>
                    <th>Disponibili</th>
                    <th>Prezzo</th>";
    if($nomeVenditore == null)
    {
        echo "<th>Compra</th>";
    }
    else
    {
        echo "<th>Gestione</th>";
    }
    echo "</tr>";
    
    if($lista != null)
    {
        foreach($lista as $elemento)
        {
            echo "
            <tr>
                <td> " . $elemento->getNome()  . "</td>
                <td><img src=" . $elemento->getImmagine() . " alt='Non disponibile' /> </td>
                <td>" . $elemento->getDisponibili(). "</td>
                <td>" . $elemento->getPrezzo() . "</td>
                <td>";
            if($nomeVenditore == null)
            {
                echo "<a href='cliente.php?idArticolo=" . $elemento->getId() . "' > Compra"; 
            }
            else 
            {
                echo "<a href='venditore.php?idArticolo=" . $elemento->getId() . "' > Gestisci"; 
            }
            echo "</a> </td> </tr>";
        }
    }
    if($nomeVenditore != null)
    {
        echo "<tr> <td> Nuovo articolo </td> <td> <img/> </td>  <td> - </td>  <td> - </td>"
        . "<td> <a href='./venditore.php?inserimento=true'> Inserisci </a> </td> </tr>"; 
    }
    
    echo "</table>";
}

function vForm($modifica)
{
    echo "<form action='./venditore.php?conferma=true' method='post'>
                <label for='categoria'> Categoria oggetto </label>
                <input type='text' id='categoria' name='categoria' ";
    if($modifica)
    {
        $categoria=$_SESSION['articolo']->getCategoria();
        echo "value=$categoria";
    }
    echo ">
                <br/>
                <label for='nome'> Nome oggetto </label>
                <input type='text' id='nome' name='nome' ";
    if($modifica)
    {
        $nome=$_SESSION['articolo']->getNome();
        echo "value=$nome";
    }
    echo ">
                <br/>
                <label for='img'> Immagine </label>
                <input type='uri' id='img' name='img'";
    if($modifica)
    {
        $immagine=$_SESSION['articolo']->getImmagine();
        echo "value=$immagine";
    }
    echo ">
                <br/> 
                <label for='descr'> Descrizione </label>
                <br/>
                <textarea id='descr' name='descr' rows='4' cols='70'> ";
    if($modifica)
    {
        $descr=$_SESSION['articolo']->getDescr();
        echo "$descr";
    }
    echo "</textarea>
                <br/>
                <label for='prezzo'> Prezzo </label>
                <input type='number' id='prezzo' name='prezzo' ";
    if($modifica)
    {
        $prezzo=$_SESSION['articolo']->getPrezzo();
        echo "value = $prezzo";
    }
    echo ">
                <br/>
                <label for='disponibili'> Quantità disponibile </label>
                <input type='number' id='disponibili' name='disponibili' ";
    if($modifica)
    {
        $disponibili=$_SESSION['articolo']->getDisponibili();
        echo "value = $disponibili";
    }
    echo ">
                <br/>
                <br/>
                <input type='submit' id='conferma' name='conferma' value='Conferma'/>
            </form>";
}

function vDescrizione()
{
    $articolo=$_SESSION['articolo'];
    echo "<h1>" . ($articolo->getNome()) . "</h1>"
    . "<p> <img src=" . ($articolo->getImmagine()) . " alt='Non disponibile' width='100' height='100'/>" 
    . "<br/> <br/>" . ($articolo->getDescr()) . "<br/>"
    . "Prezzo " . ($articolo->getPrezzo()) . "&euro; <br/>"
    . "Disponibili " . ($articolo->getDisponibili()) . " pezzi </p>";
}

function mostraFormGestione()
{
    echo "<form action='./venditore.php?modifica=true' method='get'> "
    . "<input type='submit' id='modifica' name='modifica' value='Modifica'/>"
    . "</form>"
    . "<form action='./venditore.php?elimina=true' method='get'> "
    . "<input type='submit' id='elimina' name='elimina' value='Elimina'/>"
    . "</form>";
}

function mostraFormAcquisto()
{    
    echo "<form id=formCompra> <label for='quantita'> Quantita </label>
    <input type='number' id='quantita' name='quantita' value='1'><br/>
    <input type='submit' id='compra' name='compra' value='Conferma'> </form>";
}

function vMsg($msg)
{
    if(!isset($_SESSION['ruolo']))
    {
        echo "<p> $msg </p>";  
    }
    else if($_SESSION['ruolo']=='venditore')
    {
        echo "<p> $msg </p> <br/> <a href='venditore.php'> Torna alla lista </a>";
    }
    else
    {
        echo "<p> $msg </p> <br/> <a href='cliente.php'> Torna alla lista </a>";
    }
}