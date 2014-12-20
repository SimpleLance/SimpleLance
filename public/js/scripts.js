$(function() {

    $('#side-menu').metisMenu();

});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
$(function() {
    $(window).bind("load resize", function() {
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.sidebar-collapse').addClass('collapse')
        } else {
            $('div.sidebar-collapse').removeClass('collapse')
        }
    })
});
// date picker for invoice created date
$(function() {
    $( "#created_date" ).datepicker({dateFormat: 'dd-mm-yy'});
});

// date picker for invoice due date
$(function() {
    $("#due_date").datepicker({dateFormat: 'dd-mm-yy'});
});

// calculate totals
function startCalc(){
    interval = setInterval("calc()",1);
}
function calc(){
    one = document.invoice_item.price.value;
    two = document.invoice_item.quantity.value;
    document.invoice_item.total.value = (one) * (two);
}
function stopCalc(){
    clearInterval(interval);
}
