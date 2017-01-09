(function(document, window, $) {
	'use strict';

	var Site = window.Site;

	$(document).ready(function($) {
		Site.run();
	});

	var defaults = Plugin.getDefaults("webuiPopover");

  // Example Webui Popover Pop with Table
  // ------------------------------------
  (function() {
    var tableContent = $('#examplePopoverTable').html(),
      tableSettings = {
        title: 'WebUI Popover',
        content: tableContent,
        width: 500
      };

    $('#examplePopWithTable').webuiPopover($.extend({}, defaults, tableSettings));
  })();

})(document, window, jQuery);

function showData(id)
{
	/*var defaults = Plugin.getDefaults("webuiPopover");
	var tableContent = $('#data'+id).html(),
	tableSettings = {
		title: 'WebUI Popover',
		content: tableContent,
		width: 500
	};

	$('#avatar'+id).webuiPopover($.extend({}, defaults, tableSettings));*/

	var tableContent = $("#data"+id).html();
	var tableTitle = 'EMPLOYEE DATA';

	$("#avatar"+id).webuiPopover({title:tableTitle, content:tableContent, width:600, animation:'fade', autoHide:5000, closeable:true, placement:'auto'});
}

function comein(id)
{
	var total = $("#last").val();
	console.log(total);
}