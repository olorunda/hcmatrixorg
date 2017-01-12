/*(function(){

	console.log('my script has started...');

	$('.ratemp').raty({ 
		number		: 5,
		hints       : ['1 - Bad', '2 - Poor', '3 - Okay', '4 - Good', '5 - Excellent'],
		click		: function(score, evt) {
						alert('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
		}
	});

});*/

(function(document, window, $) {
	'use strict';

	var Site = window.Site;

	$(document).ready(function($) {
		Site.run();
	});

	$('.ratemp').raty({
		path		: '../../assets/images',
		starHalf    : 'star-half.png',
		starOff     : 'star-off.png',
		starOn      : 'star-on.png',
		number		: 5,
		hints       : ['1 - Bad', '2 - Poor', '3 - Okay', '4 - Good', '5 - Excellent'],
		//target 		: '#hint'+getId('ratemp'),
		click		: function(score, evt) {
			//alert('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
			$("#ratingval"+this.id).val(score);
			$('#ratecomments'+this.id).modal({
				show: true
			});
		}
	});

})(document, window, jQuery);

function loadstar(id)
{
	console.log('am loaded');
	$('#'+id).raty({
		path		: '../../assets/images',
		starHalf    : 'star-half.png',
		starOff     : 'star-off.png',
		starOn      : 'star-on.png',
		number		: 5,
		hints       : ['1 - Bad', '2 - Poor', '3 - Okay', '4 - Good', '5 - Excellent'],
		target 		: '#hint'+id,
		click		: function(score, evt) {
			alert('ID: ' + this.id + "\nscore: " + score + "\nevent: " + evt);
		}
	});
}

function saverating(id, empid)
{
	var token = $('#_ratetoken').val();
	var goalid = id;
	var empid = empid;
	var comment = $('#lmcomment'+id).val();
	var score = $('#ratingval'+id).val();
	var formData = {'_token':token, 'rating':score, 'goalid':goalid, 'empid':empid, 'comment':comment, 'type':3};
	$.post('/lm', formData, function(data,xhr,status){
		if(!data.id && data !== 1)
		{
			swal('Warning', 'Rating Failed! Please try again.','warning');
		}
		else
		{
			swal('Done', 'Rating Successful.','success');
			window.location.reload();
		}
	});
}