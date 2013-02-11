$(document).ready(function() {
	
	function extractParamFromUri(uri, paramName){
	    if(!uri){
	        return;
	    }
	    var uri = uri.split('#')[0]; //remove anchor
	    var parts = uri.split('?'); //check for query params
	    if(parts.length == 1){
	        return; //no params
	    }

	    var query = decodeURI(parts[1]);

	    //find the url param
	    paramName += '=';
	    var params = query.split('&');
	    for(var i = 0, param; param = params[i]; ++i){
	        if(param.indexOf(paramName) === 0){
	            return unescape(param.split('=')[1]);
	        }
	    }
	}

	var $is_mobile = false;
    if($('#mobile').css('display') == 'none'){$is_mobile = true;}
	if(!$is_mobile){$("[rel=tooltip]").tooltip();}

	$('.categories ul').clone().appendTo('.mobile-categories');
	$('#toggle-categories').click(function()
	{
		$('.mobile-categories ul').slideToggle('fast');
		return false;
	});

	$('.twitter-button').click(function() {
		var text = $(this).attr('data-text');
		var url = $(this).attr('data-url');
		var via = $(this).attr('data-via');
		var related = $(this).attr('data-related');
		var fullurl = 'text=' + encodeURIComponent(text) + '&url=' + encodeURIComponent(url) + '&via=' + via + '&related=' + related;
		var encodedUrl = encodeURIComponent(url);
    window.twttr = window.twttr || {};
    var D = 550,
        A = 335,
        C = screen.height,
        B = screen.width,
        H = Math.round((B / 2) - (D / 2)),
        G = 0,
        F = document;
    if (C > A) {
        G = Math.round((C / 2) - (A / 2));
    }
    window.twttr.shareWin = window.open('https://twitter.com/intent/tweet?' + fullurl, '', 'left=' + H + ',top=' + G + ',width=' + D + ',height=' + A + ',personalbar=0,toolbar=0,scrollbars=1,resizable=1');
		_gaq.push(['_trackSocial', 'Twitter', 'tweet', fullurl]);
		return false;
	});

	$('.linkedin-share-button').click(function() {
		var text = $(this).attr('data-text');
		var url = $(this).attr('data-url');
		var fullurl = 'text=' + encodeURIComponent(text) + '&url=' + encodeURIComponent(url);
		var encodedUrl = encodeURIComponent(url);
    window.twttr = window.twttr || {};
    var D = 550,
        A = 450,
        C = screen.height,
        B = screen.width,
        H = Math.round((B / 2) - (D / 2)),
        G = 0,
        F = document;
    if (C > A) {
        G = Math.round((C / 2) - (A / 2));
    }
    window.twttr.shareWin = window.open('http://www.linkedin.com/cws/share?' + fullurl, '', 'left=' + H + ',top=' + G + ',width=' + D + ',height=' + A + ',personalbar=0,toolbar=0,scrollbars=1,resizable=1');
		_gaq.push(['_trackSocial', 'LinkedIn', 'share', fullurl]);
		return false;
	});

	$('.facebook-share-button').click(function() {
		var text = $(this).attr('data-text');
		var url = $(this).attr('data-url');
		var fullurl = 't=' + encodeURIComponent(text) + '&u=' + encodeURIComponent(url);
		var encodedUrl = encodeURIComponent(url);
    window.fbook = window.fbook || {};
    var D = 550,
        A = 365,
        C = screen.height,
        B = screen.width,
        H = Math.round((B / 2) - (D / 2)),
        G = 0,
        F = document;
    if (C > A) {
        G = Math.round((C / 2) - (A / 2));
    }
    window.fbook.shareWin = window.open('https://www.facebook.com/sharer.php?' + fullurl, '', 'left=' + H + ',top=' + G + ',width=' + D + ',height=' + A + ',personalbar=0,toolbar=0,scrollbars=1,resizable=1');
		_gaq.push(['_trackSocial', 'Facebook', 'share', fullurl]);
		return false;
	});
	
	$('.google-share-button').click(function() {
		var text = $(this).attr('data-text');
		var url = $(this).attr('data-url');
		var fullurl = 'url=' + encodeURIComponent(url);
		var encodedUrl = encodeURIComponent(url);
    window.twttr = window.twttr || {};
    var D = 550,
        A = 450,
        C = screen.height,
        B = screen.width,
        H = Math.round((B / 2) - (D / 2)),
        G = 0,
        F = document;
    if (C > A) {
        G = Math.round((C / 2) - (A / 2));
    }
    window.twttr.shareWin = window.open('https://plus.google.com/share?' + fullurl, '', 'left=' + H + ',top=' + G + ',width=' + D + ',height=' + A + ',personalbar=0,toolbar=0,scrollbars=1,resizable=1');
		_gaq.push(['_trackSocial', 'Google Plus', 'share', fullurl]);
		return false;
	});
	

	$('.pinterest-share-button').click(function() {
		var text = $(this).attr('data-text');
		var url = $(this).attr('data-url');
		var desc = $(this).attr('data-description');
		var fullurl = 'url=' + encodeURIComponent(url) + '&description=' + encodeURIComponent(text) + '&media=';
		var encodedUrl = encodeURIComponent(url);
    window.tumblrwin = window.tumblrwin || {};
    var D = 550,
        A = 450,
        C = screen.height,
        B = screen.width,
        H = Math.round((B / 2) - (D / 2)),
        G = 0,
        F = document;
    if (C > A) {
        G = Math.round((C / 2) - (A / 2));
    }
    window.tumblrwin.shareWin = window.open('http://pinterest.com/pin/create/button/?' + fullurl, '', 'left=' + H + ',top=' + G + ',width=' + D + ',height=' + A + ',personalbar=0,toolbar=0,scrollbars=1,resizable=1');
		_gaq.push(['_trackSocial', 'Pinterest', 'share', fullurl]);
		return false;
	});
	
	$('.stumble-share-button').click(function() {
		var text = $(this).attr('data-text');
		var url = $(this).attr('data-url');
		var desc = $(this).attr('data-description');
		var fullurl = 'url=' + encodeURIComponent(url);
		var encodedUrl = encodeURIComponent(url);
    window.tumblrwin = window.tumblrwin || {};
    var D = 550,
        A = 450,
        C = screen.height,
        B = screen.width,
        H = Math.round((B / 2) - (D / 2)),
        G = 0,
        F = document;
    if (C > A) {
        G = Math.round((C / 2) - (A / 2));
    }
    window.tumblrwin.shareWin = window.open('http://www.stumbleupon.com/badge/??' + fullurl, '', 'left=' + H + ',top=' + G + ',width=' + D + ',height=' + A + ',personalbar=0,toolbar=0,scrollbars=1,resizable=1');
		_gaq.push(['_trackSocial', 'Stumble', 'share', fullurl]);
		return false;
	});	

	$('.tumblr-share-button').click(function() {
		var text = $(this).attr('data-text');
		var url = $(this).attr('data-url');
		var desc = $(this).attr('data-description');
		var fullurl = 'url=' + encodeURIComponent(url) + '&name=' + encodeURIComponent(text) + '&description=' + encodeURIComponent(desc);
		var encodedUrl = encodeURIComponent(url);
    window.tumblrwin = window.tumblrwin || {};
    var D = 550,
        A = 450,
        C = screen.height,
        B = screen.width,
        H = Math.round((B / 2) - (D / 2)),
        G = 0,
        F = document;
    if (C > A) {
        G = Math.round((C / 2) - (A / 2));
    }
    window.tumblrwin.shareWin = window.open('http://www.tumblr.com/share/link?' + fullurl, '', 'left=' + H + ',top=' + G + ',width=' + D + ',height=' + A + ',personalbar=0,toolbar=0,scrollbars=1,resizable=1');
		_gaq.push(['_trackSocial', 'Tumblr', 'share', fullurl]);
		return false;
	});

	$('.show-all').click(function()
	{
		$(this).hide();
		$('.hide-all').show();
		$('.topics.all').slideDown('fast');
		return false;
	});
	$('.hide-all').click(function()
	{
		$(this).hide();
		$('.show-all').show();
		$('.topics.all').slideUp('fast');
		return false;
	});

});
	
