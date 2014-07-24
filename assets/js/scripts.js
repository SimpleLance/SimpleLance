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
        }w
    })
})
// date picker for invoice created date
$(function() {
    $("#created_date").datepicker({dateFormat: 'yy-mm-dd'});
});

// date picker for invoice due date
$(function() {
    $("#due_date").datepicker({dateFormat: 'yy-mm-dd'});
});

// calculate totals
function startCalc(){
    interval = setInterval("calc()",1);
}
function calc(){
    one = document.invoice.price.value;
    two = document.invoice.quantity.value;
    document.invoice.total.value = (one * 1) * (two * 1);
}
function stopCalc(){
    clearInterval(interval);
}