/**
Drupal.theme.prototype.my_custom_theme = function () {
  var html = '';
  html += '<div id="ctools-modal" class="popups-box my-first-popup">';
  html += ' <div class="ctools-modal-content my-popup ">';
  html += ' <span class="popups-close"><a class="close" href="#">X</a></span>';
  html += ' <div class="modal-msg"></div>';
  html += ' <div class="modal-scroll"><div id="modal-content" class="modal-content popups-body"></div></div>';
  html += ' </div>';
  html += '</div>';
  return html;
}
*/

/**
   * Provide the HTML to create the modal dialog.
   */
   Drupal.theme.prototype.my_custom_theme = function () {
  //Drupal.theme.prototype.CToolsModalDialog = function () {
    var html = ''
    html += '  <div id="ctools-modal">'
    html += '    <div class="ctools-modal-content">' // panels-modal-content
    html += '      <div class="no-modal-header no-header">';
    html += '        <a class="close" href="#">';
    html +=            Drupal.CTools.Modal.currentSettings.closeText + Drupal.CTools.Modal.currentSettings.closeImage;
    html += '        </a>';
    html += '        <span id="modal-title" class="modal-title">&nbsp;</span>';
    html += '      </div>';
    html += '      <div id="modal-content" class="modal-content">';
    html += '      </div>';
    html += '    </div>';
    html += '  </div>';

    return html;
  }

//$('#modalBackdrop').live("click", function(){ Drupal.CTools.Modal.dismiss(); });
//$('#modalBackdrop').click(function() { close(); });
