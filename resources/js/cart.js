$(".increment-qty").click(function () {
    var qty_elem = $(this)
        .parents(".col-auto")
        .siblings(".col-auto:eq(1)")
        .find(".qty");
    var current_qty = parseInt(qty_elem.val());

    qty_elem.val(current_qty + 1);
});

$(".decrement-qty").click(function () {
    var qty_elem = $(this)
        .parents(".col-auto")
        .siblings(".col-auto:eq(0)")
        .find(".qty");
    var current_qty = parseInt(qty_elem.val());
    if (current_qty > 0) {
        qty_elem.val(current_qty - 1);
    }
});
