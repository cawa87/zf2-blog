/*
	For Edit This File Please Read Documentation
*/

var myPlaylist = [
	{
		mp3:'../../../3.s3.envato.com/files/10407161/preview.mp3',
		oga:'music/5.ogg',
		title:'Missing You',
		artist:'Alexander Doe feat. Morina Jackson',
		rating:5,
		buy:'#',
		price:'19.99',
		duration:'5:25',
		cover:'music/1.jpg'	
	}
];
jQuery(document).ready(function ($) {
	$('.music-single').ttwMusicPlayer(myPlaylist, {
		currencySymbol:'$',
		buyText:'BUY',
		tracksToShow:3,
		ratingCallback:function(index, playlistItem, rating){
			//some logic to process the rating, perhaps through an ajax call
		},
		jPlayer:{
			swfPath:'../../../www.jplayer.org/2.1.0/js'
		},
		autoPlay:true
	});
});