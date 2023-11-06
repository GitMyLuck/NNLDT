
function listClick(listButton) {
    // General->list-group(elenco notizie)
    // prelevo id della notizia selezionata
    var id = $(listButton).attr("name");

    var indice = $(listButton).attr("id");
    // provoco il redirect alla pagina con il
    // numero di notizia indicato in $GET
    location.href = 'general.php?id=' + id + '&indice=' + indice;
}

function selectState(btn, state) {
    var b = btn[0].id;
    var st = state;
    if (st == "") {
        st = "read";
    }

    var id = $(".active").attr("name");

    var indice = $(".active").attr("id");
    // provoco il redirect alla pagina con il
    // numero di notizia indicato in $GET
    // e lo stato passato con $_GET  ("". "read", "write", "new")
    location.href = 'general.php?id=' + id + '&indice=' + indice + '&state=' + st;

}

function selectAction(btn, id) {
    var b = btn[0].id;
    switch (b) {
        case "close":
            // chiudi tutti gli accordion
            $(".accordion-collapse").collapse("hide");
            break;
        case "open":
            // apri tutti gli accordion
            $(".accordion-collapse").collapse("show");
            break;
        case "refresh":
            if ( id == '0' )  {
                location.href = 'general.php';
            } else {
                location.href = 'general.php?id=' + id;
            }
            break;
        case "search":
            $("html, body").animate({ scrollTop: 0 }, 100);
            break;
        default:
            break;
                }
}