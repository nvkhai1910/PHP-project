$(document).ready(function (){
    $('.add-to-cart').click(function (){
        event.preventDefault()
         var product_id = $(this).attr('data-id');
         alert('Thêm vào giỏ hàng thành công');
         // Gọi ajax nhờ PHP thêm sp hiện tại vào giỏ hàng
         $.ajax({
             //url PHP xu ly ajax
             url: 'cart/add/'+product_id,
             //Phuong thuc gui du lieu
             method: 'get',
             // Du lieu truyen len
             data: {
                 product_id: product_id
             },
             //Noi nhan du lieu tra ve tu PHP
             success: function(data){
                 console.log(data);
                 //Thông báo cho user sau khi thêm giỏ hàng thành công
                 $('.ajax-message').html('Thêm sản phẩm vào giỏ thành công');
                 $('.ajax-message').addClass('ajax-message-active');
                 setTimeout(function(){
                     $('.ajax-message').removeClass('ajax-message-active');
                 }, 3000);
                 var cart_total = $('.cart_amount').html();
                 cart_total++;
                 $('.cart_amount').html(cart_total);
             }
         });
    }); 
 })