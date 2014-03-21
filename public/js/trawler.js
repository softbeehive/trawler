$(document).ready(function() {
    
    // Start operation
    $(".operation-form").submit(function(e) {
        e.preventDefault();
        showSpinner();
        var turl = "/trawler/add",
            q = $("#operation-input").val();
            target = ".append-op-unit";
            $.ajax({
                url: turl,
                type: "POST",
                dataType: "html",
                data: { 'query': q },
                success: function(data){
                    $(target).append(data);
                    hideSpinner();
                },
                error: function() {
                    hideSpinner();
                }
            });
    });

    // Intelligence table
    $(document).on("click", ".intel", function(e) {
        var turl = "/trawler/intel",
            id = $(this).data("keyword"),
            opp = $(".tw-popup.act");
        e.preventDefault();
        makeAjax(turl, id, opp);
    });

    // Actual results grid
    $(document).on("click", ".actual", function(e) {
        var turl = "/trawler/actual",
            id = $(this).data("keyword"),
            opp = $(".tw-popup.int");
        e.preventDefault();
        makeAjax(turl, id, opp);
    });

    // Remove popup
    $(document).on("click", ".tw-popup-header .close", function() {
        $(".tw-popup").remove();
    });
});

// Resusable ajax
function makeAjax(turl, id, opp) {
    showSpinner();
    $.ajax({
        url: turl,
        type: "POST",
        dataType: "html",
        data:{ 'kid': id },
        success: function(data){
            $(".tw-append").append(data);
            hideSpinner();
        },
        error: function(){
            hideSpinner(spinner);
        },
        complete: function(){
            if (opp.is(":visible")) {
                opp.remove();
            }
        }
    });
}

// Spinner indication
function showSpinner() {
    $(".spinner").show();
}

function hideSpinner() {
    $(".spinner").hide();
}