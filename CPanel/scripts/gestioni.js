
function listClick(listButton)
{
    // General->list-group(elenco notizie)
    // prelevo id della notizia selezionata
    var id = $(listButton).attr("name");

    // provoco il redirect alla pagina con il
    // numero di notizia indicato in $GET
    location.href='general.php?id=' + id;
}

function selectState(btn, state)
{
    var b = btn[0].id;
    var st = state;
    if ( st == "" ) {
        st = "read";
    }

    var id = $(".active").attr("name");
    // provoco il redirect alla pagina con il
    // numero di notizia indicato in $GET
    // e lo stato passato con $_GET  ("". "read", "write", "new")
    location.href='general.php?id=' + id + "&state=" + st;

}

function selectAction(btn, action)
{
    var b = btn[0].id;
    var ac = action; 
    switch (ac) {
        case "close":
            // statements here
            break;

        default:


    }
}