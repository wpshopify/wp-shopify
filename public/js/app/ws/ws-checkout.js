/*

Fires the on checkout action
Returns: Promise

*/
function beforeCheckoutHook(cart) {

  return jQuery.ajax({
    method: 'POST',
    url: WP_Shopify.ajax,
    dataType: 'json',
    data: {
      action: 'wps_add_checkout_before_hook',
      cart: cart,
      nonce: WP_Shopify.nonce
    }
  });

};


/*

Fires the on checkout action
Returns: Promise

*/
function anyCustomAttrs(cart) {

  return jQuery.ajax({
    method: 'GET',
    url: WP_Shopify.ajax,
    dataType: 'json',
    data: {
      action: 'wps_get_cart_checkout_attrs',
      nonce: WP_Shopify.nonce
    }
  });

};

export {
  beforeCheckoutHook,
  anyCustomAttrs
};
