					<!--<div id="player" data-plyr-provider="youtube" data-plyr-embed-id="{$videoId}"></div>
					<div id="player"></div>
					<script src="//www.youtube.com/player_api"></script>
					<script>
						var player;
						function onYouTubePlayerAPIReady() {
							player = new YT.Player('player', {
							  width: '560',
							  height: '315',
							  videoId: '{$videoId}',
							  playerVars: { 'controls': 1, 'showinfo': 0, 'autoplay': 1, 'rel': 0, 'loop': 0, 'color': 'white'},
							  //playerVars: { 'autoplay': 1, 'controls': 1, 'showinfo': 0, 'rel': 0, 'loop': 0, 'color': 'white'},
							  events: {
								onStateChange: onPlayerStateChange
							  }
							});
						}
						function onPlayerStateChange(event) {        
							if(event.data === 0) {          
								window.location.href = "{$HOST}/watch/{$next_video_id}"
							}
						}
					</script>-->