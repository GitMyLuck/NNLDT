
function listClick(listButton)
{
    // General->list-group(elenco notizie)
    // prelevo id della notizia selezionata
    var id = $(listButton).attr("name");

    // provoco il redirect alla pagina con il
    // numero di notizia indicato in $GET
    location.href='general.php?id=' + id;
}