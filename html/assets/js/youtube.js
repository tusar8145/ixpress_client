 // Grab data attributes from video-wrapper

var videoID = $(".video-wrapper").data("video-id");
var videoYouTubeLink = $(".video-wrapper").data("video-youtube-link");
var videoStart = $(".video-wrapper").data("video-start");
var videoEnd = $(".video-wrapper").data("video-end");
var videoWidthAdd = $(".video-wrapper").data("video-width-add");
var videoHeightAdd = $(".video-wrapper").data("video-height-add");

// Prepend link to Youtube video if data attr is yes

if (videoYouTubeLink === 'y') {
	$(".video-wrapper").prepend('<a href="https://www.youtube.com/watch?v=' + videoID + '" class="video-expand" target="_blank"></a>');
}
 
// 2. This code loads the IFrame Player API code asynchronously.

var tag = document.createElement('script');
	tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

// 3. This function creates an <iframe> (and YouTube player) after the API code downloads.

var player;

function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
	videoId: videoID,
	playerVars: {
		'autoplay': 0,
		'autohide': 1,
		'end': videoEnd,
		'loop': 1,
		'modestbranding': 1,
		'rel': 0,
		'showinfo': 0,
		'controls': 0,
		'disablekb': 1,
		'enablejsapi': 0,
		'iv_load_policy': 3
	},
	events: {
		'onReady': onPlayerReady,
		'onStateChange': onPlayerStateChange
	}
	});
}

// 4. The API will call this function when the video player is ready.

function onPlayerReady(event) {
	vidRescale();
	event.target.mute();
	event.target.seekTo(videoStart);
}

// 5. The API calls this function when the player's state changes.

function onPlayerStateChange(e) {
	if (e.data === 1){
		$('#player').addClass('active');
	} else if (e.data === 0){
		player.seekTo(videoStart);
	}
}

// This function scales the video to window size and uses additional values to push video beyong window size

function vidRescale(){
	console.log('video reloaded');
	var w = $(window).width() + videoWidthAdd,
		h = $(window).height() + videoHeightAdd;
	if (w/h > 16/9) {
		player.setSize(w, w/16*9);
		$('.tv .screen').css({'left': '0px'});
	} else {
		player.setSize(h/9*16, h);
		$('.tv .screen').css({'left': -($('.tv .screen').outerWidth()-w)/2});
	}
}

// Reloads the video on load and resize

$(window).on('resize', function(){
	vidRescale();
});