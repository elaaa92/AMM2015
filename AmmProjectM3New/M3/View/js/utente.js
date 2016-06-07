function mostraLista(lista)
{
    if(lista[0]['venditore'] !== '')
    {
        venditore = lista[0]['venditore'];
    }
    else
    {
        venditore=null;
    }
    string = "<h2> Cerca </h2>"
    + "<form id='cerca'>"
        + "<label for='chiave'> Filtra </label>"
        + "<input type='text' id='chiave' name='chiave'/>"
        + "<select name='filtro' id='filtro' size='1'>"
            + "<option value='tutto'>Tutto</option>"
            + "<option value='nome'>Nome</option>"
            + "<option value='id'>Id</option>"
            + "<option value='categoria'>Categoria</option>";
    if(venditore === null)
    {
        string += "<option value='venditore'>Venditore</option>"
        + "</select>"
        + "<input type='hidden' id='venditore' name='venditore' value=''>";
    }
    else
    {
        string += "<input type='hidden' id='venditore' name='venditore' value=" + venditore + ">";
    }
    string += "<input type='button' id='ricerca' name='ricerca' value='Cerca'/>"
    + "</form>";
      
    if(lista.length > 1) //Il primo campo è sempre il venditore
    {
        string += "<table>"
        + "<tr>"
        + "<th>Nome</th>"
        + "<th>Foto</th>"
        + "<th>Disponibili</th>"
        + "<th>Prezzo</th>";

        if(venditore === null)
        {
            string += "<th>Compra</th>";
        }
        else
        {
            string += "<th>Gestione</th>";
        }

        for(i=1; i<lista.length; i++)
        {
            string += "<tr>"
                    + "<td> " + lista[i]['nome']  + "</td>"
                    + "<td><img src=" + lista[i]['foto'] 
                    + " alt='Non disponibile' /> </td>"
                    + "<td>" + lista[i]['disponibili'] + "</td>"
                    + "<td>" + lista[i]['prezzo'] + "</td>"
                    + "<td>";
            if(venditore === null)
            {
                string += "<a href='cliente.php?idArticolo=" + lista[i]['id'] + "' > Compra";
            }
            else
            {
                string += "<a href='venditore.php?idArticolo=" + lista[i]['id'] + "' > Gestisci";
            }
            string += "</a> </td> </tr>";   
        }
        
        if(venditore !== null)
        {
            string += "<tr> <td> Nuovo articolo </td> <td> <img/> </td>  <td> - </td>  <td> - </td>"
            + "<td> <a href='./venditore.php?inserimento=true'> Inserisci </a> </td> </tr>"; 
        }
        string += "</table>";
        $('#Content2').html(string);
    }
    else
    {
        string += '<p> Nessuna corrispondenza </p>';
        $('#Content2').html(string);
    }
}

function erroreLista()
{
    $('#Content2').prepend('Errore di connessione, riprovare');
}