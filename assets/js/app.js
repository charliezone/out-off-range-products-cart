(jQuery)($ => {
    $(document).ready(e => {
        $(document).on('click', '.nm-shop-notice.woocommerce-error span i', e => {
            $('.nm-shop-notice.woocommerce-error').hide();
        });
        
        $("#nm-cart-panel .product-quantity input[type=number]").each(function(){
            $(this).attr("disabled", "disabled");
        });
    });
})