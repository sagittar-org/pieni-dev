<div class="jumbotron">
  <div class="container">
    <h1 class="display-3">pieni</h1>
    <p class="lead">THE RAPID PROTOTYPING</p>

<div id="player"></div>
<script>
var tag = document.createElement('script');
tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var ytPlayer;

function onYouTubeIframeAPIReady() {
    ytPlayer = new YT.Player('player', {
        height: 315,
        width: 560,
        videoId: 'bnDyQnzRfuU',
        playerVars: {
          playsinline: 1,
          rel      : 0,
          controls: 1,
          showinfo: 0
        },    
        events: {
            'onReady': onPlayerReady
        }
    });
}

function onPlayerReady() {
  ytPlayer.mute();
  ytPlayer.playVideo();
}
</script>

    <p><a class="btn btn-primary btn-lg" href="#" role="button">Experience now &raquo;</a></p>
  </div>
</div>

<div class="container">
  <h2>Requirement</h2>
  <p>Apache 2.4.x / MySQL 5.7.x / PHP 7.0.x</p>

  <h2>License</h2>
  <p>MIT License</p>

  <h2>Install</h2>

<pre>
composer require pieni/core
cp vendor/pieni/core/.htaccess .
cp vendor/pieni/core/index.php .
</pre>

</div>
