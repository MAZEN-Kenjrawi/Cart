/*
 *
 * CART JS File
 * 
 */

// CONFIG
var getUrl = window.location;
var baseUrl = getUrl .protocol + '//' + getUrl.host + '/' + getUrl.pathname.split('/')[1] + '/' + getUrl.pathname.split('/')[2] + '/';

// TESTS

//  Variables

//  Functions
function updateQty(item_id, is_adding)
{
    var $closestTR = $('tr[data-id="'+item_id+'"]'),
        item_id = $closestTR.data('id'),
        $qtyVAL = $closestTR.find('input[type="number"]'),
        qty = parseInt($qtyVAL.val());
    if(is_adding)
    {
        qty += 1;
    } else {
        qty -= 1;
    }
    if(isNaN(qty) || qty < 0){
        qty = 0;
    }
    $qtyVAL.val(qty);
    updateItem(item_id, qty);
}
function updateItem(item_id, qty)
{
    if(isNaN(qty) || !$('[data-id="'+item_id+'"]').length)
    {
        return false;
    }
    $.ajax({
        url: baseUrl + 'cart/update',
        data: {'item_id': item_id, 'qty': qty},
        dataType: 'JSON',
        method: 'POST',
        success: function(response)
        {
            if(response.status != 'success')
            {
                
            }
            console.log(response);
        },
        error: ajaxErrorHandler
    });
    console.log(item_id, qty);
}
function ajaxErrorHandler(errorResponse)
{
    console.log(errorResponse.responseText);
}

//  DOM READY EVENTS
$(document).ready(function(){
    $('.addQty').click(function(){
        updateQty($(this).closest('tr').data('id'), true);
    });
    $('.subQty').click(function(){
        updateQty($(this).closest('tr').data('id'), false);        
    });
});