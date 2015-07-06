/* Implement custom javascript here */

//(function($) {
//$('#modalBackdrop').live("click", function(){ Drupal.CTools.Modal.dismiss(); });

$('#modalBackdrop').click(function() {
 Drupal.CTools.Modal.dismiss();
});

//$('#modalBackdrop').click(function() {
//$('.popups-close').trigger('click');
//});
//})(jQuery);