/*
 * @author: rgb72
 * @copyright: บริษัท อาร์จีบีเซเว่นตี้ทู จำกัด
 */

$(function() {
	$(document).on("click", "a[href=#]", function(e){
		e.preventDefault();
	});
});


/* Match Height*/
$(function() {
	/*Match Height*/
	if ($.fn.matchHeight != undefined) {
			$(".match-height").matchHeight();
	}
});
	
$(function() {
	/*Checkbox*/
	if ($.fn.iCheck != undefined) {
		$('form input[type="checkbox"]').iCheck({
						handle        : 'checkbox',
						checkboxClass : 'icheckbox_flat-orange'
						
		});
		$('form input[type="radio"]').iCheck({
						handle        : 'radio',
						radioClass    : 'iradio_flat-orange'
						
		});
	}
});

/*Open tab from other url*/
$(function() {
		//grabs the hash tag from the url
		var hash = window.location.hash;
		//checks whether or not the hash tag is set
			if (hash != "") {
			//removes all active classes from tabs
			$('#hilight-home li').each(function() {
			$(this).removeClass('active');
			});
			$('#hilight-tab-content div').each(function() {
			  $(this).removeClass('in active');
			});
			//this will add the active class on the hashtagged value
			var link = "";
			$('#hilight-home li').each(function() {
			  link = $(this).find('a').attr('href');
			  if (link == hash) {
				$(this).addClass('active');
			  }
			});
			$('#hilight-tab-content div').each(function() {
			
			  link = $(this).attr('id');
			  if ('#'+link == hash) {
			
				$(this).addClass('in active');
			  }
			});
		}
});

// Selectbox
$(function() {
	if ($.fn.selectBox != undefined) {
		$("select").selectBox({ mobile:false });
	}
});

//Fancybox
$(function() {
	if ($.fn.fancybox != undefined) {
      $('.fancybox').fancybox();
	}
});

//Accordion
$(function() {
	$('#leftNav').find('.panel-default:has(".in")').addClass('panel-focus');

	$('#leftNav')
		.on('shown.bs.collapse', function (e) {
			$(e.target).closest('.panel-default').addClass('panel-focus');
		})
		.on('hidden.bs.collapse', function (e) {
			$(e.target).closest('.panel-default').removeClass('panel-focus');
		});
		
});

// Placeholder
$(function() {
	if ($.fn.placeholder != undefined) {
      $("input, textarea").placeholder();
	}
});

//viewport
function updateViewport() {
	if ($("meta[name=viewport]").attr("default") === undefined) $("meta[name=viewport]").attr("default", $("meta[name=viewport]").attr("content"));

	if (screen.width >= 768) {
		$("meta[name=viewport]").attr("content", "width=970, maximum-scale=1, user-scalable=yes");
	} else {
		//"width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=1;"

		/*if ($("meta[name=viewport]").attr("default") !== undefined)
			$("meta[name=viewport]").attr("content", $("meta[name=viewport]").attr("default"));*/

		$("meta[name=viewport]").attr("content", "width=device-width, maximum-scale=2.0; user-scalable=1");
	}
}

//viewport
$(document).ready(function() {

	updateViewport();

	// Load Sitemap
	//$("footer div.sitemap-wrapper:first").load("/FSS/ajax/sitemap-th.html");
	

	$("footer div.sitemap-wrapper:first").load("/ajax/sitemap-th.html", function() {
		$('.sitemap-list')
		   .on('shown.bs.collapse', function (e) {
			$(e.target).closest('.panel-default').addClass('panel-active');
		   })
		   .on('hidden.bs.collapse', function (e) {
			$(e.target).closest('.panel-default').removeClass('panel-active');  
		   });
	  });
  
});

