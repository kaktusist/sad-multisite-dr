(function(E, $) {
  E.quickTable = function() {
    E = this;
    E.quickPop.open('<table id="bue-quick-table" style="width: auto; height: auto;"> <tr><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td></tr> <tr><td></td><td></td><td></td></tr> </table>');
    quickTableX = -1, quickTableY = -1;
    $('#bue-quick-table td').each(quickTableTd);
  };
  
  quickTableTd = function () {
    $(this).css(
      {width: '16px', height: '16px', border: '1px solid #ddd', padding: '5px', backgroundColor: 'white', cursor: 'pointer'}
    ).html('&nbsp;').mouseover(quickTableTdOver).click(quickTableTdClick);
  };

  quickTableTdOver = function () {
    var row = this.parentNode, table = row.parentNode, X = this.cellIndex, Y = row.rowIndex;
    if (X == row.cells.length - 1) {
      for (var i = table.rows.length; i; i--) quickTableTd.apply(table.rows[i-1].insertCell(X+1));
    }
    if (Y == table.rows.length - 1) {
      var _row = table.insertRow(Y+1);
      for (var i = 0, t = row.cells.length; i < t; i++) quickTableTd.apply(_row.insertCell(i));
    }
    var aX = X < quickTableX ? [quickTableX, X, quickTableY, 'white'] : [X, quickTableX, Y, 'blue'];
    var aY = Y < quickTableY ? [quickTableY, Y, quickTableX, 'white'] : [Y, quickTableY, X, 'blue'];
    for (var i = aX[0]; i > aX[1]; i--) for (var j = aX[2]; j > -1; j--) {
      table.rows[j].cells[i].style.backgroundColor = aX[3];
    }
    for (var i = aY[0]; i > aY[1]; i--) for (var j = aY[2]; j > -1; j--) {
      table.rows[i].cells[j].style.backgroundColor = aY[3];
    }
    quickTableX = X, quickTableY = Y;
  };

  quickTableTdClick = function () {
    var cells = '', rows = '';
    for (var i = quickTableX; i > -1 ; i--) {
      cells += '  <td></td>\n';
    }
    for (var i = quickTableY; i > -1 ; i--) {
      rows += '\n<tr>\n'+ cells +'</tr>';
    }
    return E.replaceSelection('<table>'+ rows +'\n</table>', 'end');
  };
})(BUE.instance.prototype, jQuery);