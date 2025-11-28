<?php
// submain.php : contenu fixe de la partie gauche (split-left)
?>
<div style="background:#000;position:absolute;top:0;left:0;width:100%;height:100%;z-index:0;"></div>
<video autoplay muted playsinline poster="assets/videos/sainamalagasy.jpg" id="bgvideo" style="background:#000;z-index:1;position:absolute;top:0;left:0;width:100%;height:100%;object-fit:cover;transition:opacity 0.7s cubic-bezier(0.4,0,0.2,1);">
  <source id="bgvideo-source" src="assets/videos/madagasikara.mp4" type="video/mp4">
  Votre navigateur ne supporte pas la vidéo de fond.
</video>
<div class="content" id="left-content" style="position:relative;z-index:2;">
  <img class="responsive-logo" alt="SOA I MADAGASIKARA" src="soaimadagasikara.png">
  <h1>Ny fitiavan-tanindrazana no lova soan'ny taranaka</h1>
  <h2>L'amour de la terre des ancêtres, voilà bien l'héritage des descendants</h2>
</div>
<script>
  // Carrousel vidéo avec fondu enchaîné (partie split-left)
  const videoList = [
    'assets/videos/madagasikara.mp4',
    'assets/videos/alleebaobab.mp4',
    'assets/videos/morontsiraka.mp4',
    'assets/videos/sifaka.mp4'
  ];
  let currentVideo = 0;
  const bgvideo = document.getElementById('bgvideo');
  const bgvideoSource = document.getElementById('bgvideo-source');
  const leftContent = document.getElementById('left-content');
  if (bgvideo && bgvideoSource) {
    function updateLeftContentVisibility() {
      if (videoList[currentVideo].includes('madagasikara.mp4')) {
        leftContent.style.opacity = 0;
        leftContent.style.pointerEvents = 'none';
      } else {
        leftContent.style.opacity = 1;
        leftContent.style.pointerEvents = '';
      }
    }
    updateLeftContentVisibility();
    let isTransitioning = false;
    bgvideo.addEventListener('ended', function() {
      if (isTransitioning) return;
      isTransitioning = true;
      bgvideo.style.transition = 'opacity 0.7s cubic-bezier(0.4,0,0.2,1)';
      bgvideo.style.opacity = 0;
      setTimeout(function() {
        currentVideo = (currentVideo + 1) % videoList.length;
        bgvideoSource.src = videoList[currentVideo];
        bgvideo.load();
      }, 400);
    });
    bgvideo.addEventListener('loadeddata', function() {
      if (bgvideo.style.opacity === '0') {
        bgvideo.play();
        setTimeout(function() {
          bgvideo.style.opacity = 1;
          updateLeftContentVisibility();
          isTransitioning = false;
        }, 100);
      }
    });
  }
</script>
