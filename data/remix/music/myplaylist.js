/*
	For Edit This File Please Read Documentation
*/

var myPlaylist = [
	
	{
		mp3:'http://3.s3.envato.com/files/10407161/preview.mp3',
		oga:'music/5.ogg',
		title:'Missing You',
		artist:'Dejans',
		rating:5,
		buy:'#',
		price:'17',
		duration:'5:25',
		cover:'music/5.jpg'	
	},
	{
		mp3:'http://3.s3.envato.com/files/54178721/preview.mp3',
		oga:'music/4.ogg',
		title:'Midnight In Tokyo',
		artist:'BlueFoxMusic',
		rating:4,
		buy:'#',
		price:'17',
		duration:'2:51',
		cover:'music/4.jpg'	
	},		
	{
		mp3:'http://1.s3.envato.com/files/54821639/preview.mp3',
		oga:'music/1.ogg',
		title:'Walking On Horizon',
		artist:'Dejans',
		rating:5,
		buy:'#',
		price:'17',
		duration:'4:29',
		cover:'music/1.jpg'
	},
	{
		mp3:'http://2.s3.envato.com/files/62716273/preview.mp3',
		oga:'music/6.ogg',
		title:'A Happy Carefree Day',
		artist:'JoshKramerMusic',
		rating:5,
		buy:'#',
		price:'13',
		duration:'2:45',
		cover:'music/6.jpg'	
	},
	{
		mp3:'http://3.s3.envato.com/files/41975807/preview.mp3',
		oga:'music/2.ogg',
		title:'Through the Clouds',
		artist:'Dejans',
		rating:4,
		buy:'#',
		price:'17',
		duration:'5:56',
		cover:'music/2.jpg'	
	},
	{
		mp3:'http://3.s3.envato.com/files/2229255/preview.mp3',
		oga:'music/3.ogg',
		title:'Live My Life',
		artist:'Metrolightmusic',
		rating:5,
		buy:'#',
		price:'17',
		duration:'2:31',
		cover:'music/3.jpg'	
	}
];
jQuery(document).ready(function ($) {
	$('.music-player-list').ttwMusicPlayer(myPlaylist, {
		currencySymbol:'$',
		buyText:'BUY',
		tracksToShow:3,
		ratingCallback:function(index, playlistItem, rating){
			//some logic to process the rating, perhaps through an ajax call
		},
		jPlayer:{
			swfPath:'http://www.jplayer.org/2.1.0/js'
		},
		autoPlay:true
	});
});