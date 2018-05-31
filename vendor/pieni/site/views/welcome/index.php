<div class="jumbotron">
  <div class="container">
    <h1 class="display-3">pieni</h1>
    <p class="lead">THE RAPID PROTOTYPING</p>
<!--
    <iframe
      width="560"
      height="315"
      src="https://www.youtube.com/embed/bnDyQnzRfuU?autoplay=1&showinfo=0&rel=0"
      frameborder="0"
      allow="autoplay; encrypted-media"
      allowfullscreen
    ></iframe>
-->

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
        playerVars: {//パラメータ
          playsinline: 1,// インライン再生指定
          rel      : 0,// 関連動画出さない
          controls: 1,// コントローラー出さない
          showinfo: 0// タイトルとか動画情報出さない
        },    
        events: {//　イベント
            'onReady': onPlayerReady
        }
    });
}

function onPlayerReady() {
  ytPlayer.mute();// ミュートにしてから
  ytPlayer.playVideo();// 再生
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
