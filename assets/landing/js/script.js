$(function() {
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }
});
  // fav
  $(document).on('click', '.add_cart', function(e){
    e.preventDefault();
      var id = $(this).attr('data-id');
      var $property = $(this);
      $.ajax({
          url: base_url + 'product/add_to_cart',
          type: "POST",
          data: {'product_id' : id},
          dataType: "json",
          success: function( returneddata ){
              if( returneddata.status == "success" ){
                  get_total();
                  $property.html('Remove from cart');
                  $property.removeClass('btn-warning add_cart');
                  $property.addClass('btn-danger remove_cart');
                  var counter = ( $('#cart_counter').text() * 1) + 1 ;
                  $('#cart_counter').text(counter);
              }
              toastr[returneddata.status](returneddata.message);
          },
          error: function(){
              toastr["error"]("Sorry there was an error adding the product to your cart");
          }
      });
  });

  // unfav
  $(document).on('click', '.remove_cart', function(e){
      e.preventDefault();
      var id = $(this).attr('data-id');
      var $property = $(this);
      $.ajax({
          url: base_url + 'product/remove_from_cart',
          type: "POST",
          data: {'product_id' : id},
          dataType: "json",
          success: function( returneddata ){
              if( returneddata.status == "success" ){
                  get_total();
                  $property.removeClass('btn-danger remove_cart');
                  $property.addClass('btn-warning add_cart');
                  $property.html('Add to cart');
                  var status = returneddata.status;
                  toastr[returneddata.status](returneddata.message);
                  var counter = ( $('#cart_counter').text() * 1) - 1 ;
                      $('#cart_counter').text(counter);
              }
          },
          error: function(){
              toastr["error"]("Sorry there was an error removing the product to your cart");
          }
      });
  });

  // Remove item from the cart page
  $('.remove-item').on('click', function(){
      get_total();
      $(this).attr('disabled', 'disabled');
      var $button = $(this);
      var id = $(this).data('item-id');
      $.ajax({
          url: base_url + 'product/remove_from_cart',
          type: "POST",
          data: {'product_id' : id},
          dataType: "json",
          success: function( returneddata ){
              if( returneddata.status == "success" ){
                  // get_total();
                  $('#cart_counter').text(function(i, val) { return val-1 });
                  $button.parent().parent().fadeOut('slow', function(){
                    get_total();
                    if( $('.cart_row:visible').length < 1 ){
                      $('.checkout').attr('disabled','disabled'); 
                    }
                  });
                  toastr[returneddata.status](returneddata.message);

              }else{
                toastr["error"](returneddata.message);
              }
              // get_total();
          },
          error: function(){
              toastr["error"]("Sorry there was an error removing the product to your cart");
          }
      });      
  });

$(function() {
  // User trying to change the qty
  $(".qty-control").on("change", function(){
      var $property = $(this);
      var amount = $(this).data("amount");
      var qty = $(this).val();
      var row_id = $(this).data("item-id")
      var new_sub = amount * qty;
      $property.closest('td').next('td').next('td').next('td').text('₦'+new_sub);
      // lets just update the cart
      $.post( base_url + "cart/cart_update", { row_id: row_id, qty: qty } );
      get_total();
      
  });

  $('.no-login').on('click', function(){
      swal({
        title: "Error occured.",
        text: "You need to login before you can process your payment.",
        type: "error",
        });
      window.location.href = base_url + "account/";
  });

  $('.checkout').on('click', function(){
      $(this).attr('disabled','disabled');
      var email = $(this).data('email');
      var amount = get_total().toFixed();
      amount = amount * 100;
      var handler = PaystackPop.setup({
        key: 'pk_test_1cb622d5aceadc646a389055ce2aed8b36fb092f',
        email: email,
        amount: amount,
        callback: function( response ){
          // response.reference
          // go to server to verify, send mail and SMS
          $.ajax({
              url: base_url + 'cart/checkout',
              type: "POST",
              data: {'reference' : response.reference },
              dataType: "json",
              success: function( returneddata ){
                  if( returneddata.status == "success" ){
                      window.location.href = base_url + 'landing';
                  }
                  toastr[returneddata.status](returneddata.message);
              },
              error: function(){
                  toastr["error"]("Technical error, please contact support");
              }
          });
        }, 
        onClose: function(){
          swal({title: "Window closed",text: "Your order has not been completed",type: "error",});
        }
      });
      handler.openIframe();
  });
});

function get_total(){
  var pricesum = 0;
  $(".subtotal:visible").each(function(){
      pricesum += parseFloat($(this).text().replace('₦',''));
  });
  $('.total_amount').text('₦'+pricesum.toFixed(2));
  return pricesum;
}