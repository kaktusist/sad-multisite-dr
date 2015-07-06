(function($) {
  Drupal.behaviors.addSpinner = {
    attach : function(context, settings) {
      $(".commerce-add-to-cart .form-item-quantity input, .views-field-edit-quantity input").spinner({
        min:1,
        max:9999,
      });
    }
  }
})(jQuery);