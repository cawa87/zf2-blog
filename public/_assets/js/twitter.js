//jtwt.js by Harbor (http://jtwt.hrbor.com)

(function($){

 	$.fn.extend({ 
 		
		//pass the options variable to the function
 		jtwt: function(options) {


			//Set the default values, use comma to separate the settings, example:
			var defaults = {
				username : 'designedbydash',
                count : 4,
                image_size: 0,
                convert_links: 1,
                loader_text: 'Loading Tweets...'
			}
				
			var options =  $.extend(defaults, options);

    		return this.each(function() {
				var o = options;
                var obj = $(this);  
                var randId = 'jtwt' + Math.floor(Math.random()*10000);
				
			$(obj).append('<div class="jtwt" id="' + randId + '"></div>');
				
			$('#' + randId, obj).append('<p class="jtwt_loader muted" style="display:none;">' + o.loader_text + '</p>');	
			$(".jtwt_loader", obj).fadeIn('slow');

			var prettyDate = function(dateString) {
				var rightNow = new Date();
				var then = new Date(dateString);
				var isMSIE = /*@cc_on!@*/0;
					
				if (isMSIE) {
					// IE can't parse these crazy Ruby dates
					then = Date.parse(dateString.replace(/( \+)/, ' UTC$1'));
				}
			
				var diff = rightNow - then;
			
				var second = 1000,
				minute = second * 60,
				hour = minute * 60,
				day = hour * 24,
				week = day * 7;
			
				if (isNaN(diff) || diff < 0) {
					return ""; // return blank string if unknown
				}
			
				if (diff < second * 2) {
					// within 2 seconds
					return "right now";
				}
			
				if (diff < minute) {
					return Math.floor(diff / second) + " seconds ago";
				}
			
				if (diff < minute * 2) {
					return "about 1 minute ago";
				}
			
				if (diff < hour) {
					return Math.floor(diff / minute) + " minutes ago";
				}
			
				if (diff < hour * 2) {
					return "about 1 hour ago";
				}
			
				if (diff < day) {
					return  Math.floor(diff / hour) + " hours ago";
				}
			
				if (diff > day && diff < day * 2) {
					return "yesterday";
				}
			
				if (diff < day * 365) {
					return Math.floor(diff / day) + " days ago";
				}else {
					return "over a year ago";
				}
			
			};

	
			$.getJSON('http://api.twitter.com/1/statuses/user_timeline/' + o.username + '.json?count=' + o.count + '&include_rts=true&callback=?', function(data){ 

			$.each(data, function(i, item) {       
            
                jtweet = '<div class="span5"><div class="icon-box pull-left"><i class="icon-twitter"></i></div>';

                var tweettext = item.text;
                var tweetdate = prettyDate(item.created_at);
                
                if (o.convert_links != 0) {

                	tweettext = tweettext.replace(/(http\:\/\/[A-Za-z0-9\/\.\?\=\-]*)/g,'<a href="$1">$1</a>');
                	tweettext = tweettext.replace(/@([A-Za-z0-9\/_]*)/g,'<a href="http://twitter.com/$1">@$1</a>');
                	tweettext = tweettext.replace(/#([A-Za-z0-9\/\.]*)/g,'<a href="http://twitter.com/search?q=$1">#$1</a>');
                
                }

                jtweet += '<div class="description"><p>';
                jtweet += tweettext;
				jtweet += ' <span class="muted">' + tweetdate + '</span></p></div>';
               
                
 
                jtweet += '</div>';   				
                $(".jtwt_loader", obj).hide(); 
                $('#' + randId, obj).append(jtweet);
        
    


          		 });   
                 

			$(".jtwt_loader", obj).hide();   
           
		});
    
    
			
    		});
    	}
	});
	
})(jQuery);