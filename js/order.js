var prod_num = $('.prod').length;
console.log(prod_num);        
var tax = 0.06;
var order_total;

var name, price, num;

$("body").on("click", ".prod", function prod(){
    var prod = $(this).attr('id'); //returns product id
    var items_total = parseInt($('#items-total').text());
    var order_subtotal = $('#order-subtotal').text();
    order_subtotal = parseInt(order_subtotal.substring(order_subtotal.indexOf(' ') + 1));
    var quan = 1;

    if (prod == 'product-1'){
        num = 1;
        name = 'P1';
        price = 2;
    }else if(prod == 'product-2'){
        num = 2;
        name = 'P2';
        price = 3;
    }else if(prod == 'product-3'){
        num = 3;
        name = 'P3';
        price = 4;
    }else if(prod == 'product-4'){
        num = 4;
        name = 'P4';
        price = 5;
    }

    var row = '' + 
        '<tr id="user-product-' + num + '" class="">' + 
        '<td id="product">' + name +'</td>' + 
        '<td id="item-price">' + price + '</td>' + 
        '<td id="item-quan-'+ num +'"  class="item-quan">' + 
        '<button class="remove btn btn-info mr-3" id="">' + 
        '<i class="fa fa-minus"></i>' + 
        '</button>' + ' ' + quan + ' ' +
        '<button class="add btn btn-info ml-3" id="">' + 
        '<i class="fa fa-plus"></i>' + 
        '</button> ' + 
        '</td>' + 
        '<td id="item-cost-'+ num +'">' + price + '</td>' + 
        '</tr>' + 
        '';
    var row2 = name;
    // $('#new_row').append(row2);
    var row_count = $('#order-table tr').length;
    if ($('#user-product-'+ num +'').length == 0){
        if (row_count == 1){
            items_total = items_total + 1;
            order_subtotal = order_subtotal + price;
            var order_total = order_subtotal * (1 + tax);
            $('#order-table tr:last').after(row);
            $('#items-total').html(items_total);
            $('#order-subtotal').text('RM ' + order_subtotal.toFixed(2));
            $('#order-total').text('RM ' + order_total.toFixed(2));
            var message;
            $.ajax({
                method: "post",
                url: "orderItem.php",
                data : {
                    'CostPerItem': price,
                    'ProductName': name,
                    'Quantity': quan 
                },
                success: function (response) {
                    message = response;
                    console.log(message);
                }
            });
        }else if (row_count > 1){
            items_total = items_total + 1;
            order_subtotal = order_subtotal + price;
            var order_total = order_subtotal * (1 + tax);
            $('#order-table tr:last').after(row);
            $('#items-total').html(items_total);
            $('#order-subtotal').text('RM ' + order_subtotal.toFixed(2));
            $('#order-total').text('RM ' + order_total.toFixed(2));
            var message;
            $.ajax({
                method: "post",
                url: "orderItem.php",
                data : {
                    'CostPerItem': price,
                    'ProductName': name,
                    'Quantity': quan 
                },
                success: function (response) {
                    message = response;
                    console.log(message);
                }
            });
        }
    }
});

$("body").on("click", ".add", function add(){
    var prod = $(this).closest('tr').attr('id');
    var item = $(this).parent().attr('id');
    console.log(prod);
    console.log(item);
    var quan = parseInt($('#'+prod+' #'+item).text());
    var items_total = parseInt($('#items-total').text());
    var order_subtotal = $('#order-subtotal').text();
    order_subtotal = parseInt(order_subtotal.substring(order_subtotal.indexOf(' ') + 1));
    
    if (prod == 'user-product-1'){
        num = 1;
        name = 'P1';
        price = 2;
    }else if(prod == 'user-product-2'){
        num = 2;
        name = 'P2';
        price = 3;
    }else if(prod == 'user-product-3'){
        num = 3;
        name = 'P3';
        price = 4;
    }else if(prod == 'user-product-4'){
        num = 4;
        name = 'P4';
        price = 5;
    }
    quan = quan+1;
    items_total = items_total + 1;
    var item_cost = quan * price;
    var input =
        '<button class="remove btn btn-info mr-3" id="">' + 
        '<i class="fa fa-minus"></i>' + 
        '</button>' + ' ' + quan + ' ' +
        '<button class="add btn btn-info ml-3" id="">' + 
        '<i class="fa fa-plus"></i>' + 
        '</button> ';

    if(quan > 0){
        order_subtotal = order_subtotal + price;
        order_total = order_subtotal * (1 + tax);
        $('#'+prod+' #'+item).html(input);
        $('#items-total').html(items_total);
        $('#'+prod+' #item-cost-'+num).text(item_cost);
        $('#order-subtotal').text('RM ' + order_subtotal.toFixed(2));
        $('#order-total').text('RM ' + order_total.toFixed(2));
        var message;
        $.ajax({
            method: "post",
            url: "orderItem.php",
            data : {
                'CostPerItem': price,
                'ProductName': name,
                'Quantity': quan 
            },
            success: function (response) {
                message = response;
                console.log(message);
            }
        });
    }


});

$("body").on('click', ".remove", function remove(){
    var prod = $(this).closest('tr').attr('id');
    var item = $(this).parent().attr('id');
    var quan = parseInt($('#'+prod+' #'+item).text());
    var items_total = parseInt($('#items-total').text());
    var order_subtotal = $('#order-subtotal').text();
    order_subtotal = parseInt(order_subtotal.substring(order_subtotal.indexOf(' ') + 1));
    // items_total = 0;
    if (prod == 'user-product-1'){
        num = 1;
        name = 'P1';
        price = 2;
    }else if(prod == 'user-product-2'){
        num = 2;
        name = 'P2';
        price = 3;
    }else if(prod == 'user-product-3'){
        num = 3;
        name = 'P3';
        price = 4;
    }else if(prod == 'user-product-4'){
        num = 4;
        name = 'P4';
        price = 5;
    }
    quan = quan-1;
    // console.log(quan);
    if(quan > 0 ){
        items_total = items_total - 1;
        var item_cost = quan * price;
        order_subtotal = order_subtotal - price;
        order_total = order_subtotal * (1 + tax);
        var input =
        '<button class="remove btn btn-info mr-3" id="">' + 
        '<i class="fa fa-minus"></i>' + 
        '</button>' + ' ' + quan + ' ' +
        '<button class="add btn btn-info ml-3" id="">' + 
        '<i class="fa fa-plus"></i>' + 
        '</button> ';
        $('#'+prod+' #'+item).html(input);
        $('#items-total').html(items_total);
        $('#'+prod+' #item-cost-'+num).text(item_cost);
        $('#order-subtotal').text('RM ' + order_subtotal.toFixed(2));
        $('#order-total').text('RM ' + order_total.toFixed(2));
        var message;
        $.ajax({
            method: "post",
            url: "orderItem.php",
            data : {
                'CostPerItem': price,
                'ProductName': name,
                'Quantity': quan 
            },
            success: function (response) {
                message = response;
                console.log(message);
            }
        });
    } else {
        order_subtotal = order_subtotal - price;
        order_total = order_subtotal * (1 + tax);
        $('#order-subtotal').text('RM ' + order_subtotal.toFixed(2));
        $('#order-total').text('RM ' + order_total.toFixed(2));
        $('#'+prod).remove();
        var message;
        $.ajax({
            method: "post",
            url: "orderItem.php",
            data : {
                'CostPerItem': price,
                'ProductName': name,
                'Quantity': 0 
            },
            success: function (response) {
                message = response;
                console.log(message);
            }
        });
    }

});

$('#order-check-out').on('click',function(e){
    e.preventDefault();
    console.log('open modal checkout');
    var row_count = $('#order-table tr').length;
    // console.log('row'+ row_count);
    if(row_count <= 1){
        $('#checkout-error').modal('toggle');
    } else {
        $('#payment-check-out').modal('toggle');
        var order_total = $('#order-total').text();
        // console.log(order_total);
        $('#checkout-order-total').text(order_total); //fill in modal
        order_total = order_total.replace('.','');
        console.log(order_total);

        order_total = order_total.substring(order_total.indexOf(' '));
        console.log(order_total);
        $.ajax({
            method: "post",
            url: "checkout.php",
            data : {
                'Status': 'Pending',
                'PaidAmountCents': order_total
            },
            success: function (response) {
                message = response;
                console.log(message);
            }
        });
    }


});

$('#checkout-total-paid').keyup(function(){
    // console.log($('#checkout-order-total').text());
    var order_total = $('#checkout-order-total').text();
    order_total = parseFloat(order_total.substring(order_total.indexOf(' ') + 1));
    // console.log('total');
    // console.log(order_total);
    order_total = order_total.toFixed(2);
    order_total_return = order_total.replace('.','');
    var total_paid = parseFloat($('#checkout-total-paid').val());
    total_paid = total_paid.toFixed(2);

    $('#checkout-order-total-input').val(order_total_return);
    if( total_paid >= order_total){
        $('#trans-submit').prop('disabled', false);
        var keyin_paid = total_paid - order_total;
        $('#checkout-change').text('RM '+ keyin_paid.toFixed(2));
        // $('#checkout-change-input').val(keyin_paid.toFixed(2));
    }

});

function transPaid(){
    var order_total = $('#order-total').text();
    order_total = order_total.replace('.','');
    order_total = order_total.substring(order_total.indexOf(' '));
    $.ajax({
        method: "post",
        url: "paid.php",
        data : {
            'Status': 'Completed',
            'TotalAmount': order_total,
            'IsWalkIn': true
        },
        success: function(response) {
            message = response;
            console.log(message);
        }
    })
}

$('#trans-submit').on('click', function(e){
    e.preventDefault();
    //paymentmethod, status, paidamountcents
    var paymentMethod = $('#payment-method').find(':selected').text();
    var status = 'Paid';
    var paidAmountCents = $('#checkout-order-total-input').val();
    $.ajax({
            method: "post",
            url: "checkout.php",
            data : {
                'Status': status,
                'PaidAmountCents': paidAmountCents,
                'paymentMethod': paymentMethod
            },
            success: function (response) {
                message = response;
                transPaid();
                console.log(message);
                window.location.href = 'transaction.html';
            }
        });
});

$('#order-cancel').on('click', function(e){
    e.preventDefault();
    var order_total = $('#order-total').text();
    order_total = order_total.replace('.','');
    order_total = order_total.substring(order_total.indexOf(' '));
    $.ajax({
        method: "post",
        url: "paid.php",
        data : {
            'Status': 'Cancelled',
            'TotalAmount': order_total,
            'IsWalkIn': true
        },
        success: function(response) {
            message = response;
            console.log(message);
            window.location.href = 'orderCancel.html';
        }
    })
});