$(document).ready
(
    function () 
    {
        $(document).on('click', '#ricerca',
            function () 
            {
                $.ajax
                ( 
                    {
                        type: "GET",
                        url: "../Controller/Filter.php",
                        data: 
                        {
                            venditore: $("#venditore").val(),
                            f: $("#filtro").val(),
                            q: $("#chiave").val()
                        },
                        dataType: 'json',
                        success: function (data, state) 
                        {
                            result(data);
                        },
                        error: function (data, state) 
                        {
                            error(data);
                        }


                    }
                );
        
                function result(data)
                {
                    mostraLista(data);
                }
                
                function error(data)
                {
                    erroreLista();
                }
            }
        );
    }                 
);