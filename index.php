<?php
$page_title = 'Association Soa i Madagasikara - Diaspora et Développement Madagascar';
$page_description = "Association Soa i Madagasikara : actions de la diaspora pour le développement économique, social, culturel et sportif à Madagascar. Actualités, projets, solidarité, engagement.";
$page_keywords = "association Madagascar, diaspora, malagasy, Soa i Madagasikara, développement, solidarité, projets, actualités, économie, culture, sport, entraide, ONG, news Madagascar";
$page_canonical = "https://soaimadagasikara.mg/index.html";
$og_title = $page_title;
$og_description = $page_description;
$og_url = $page_canonical;
$twitter_title = $page_title;
$twitter_description = $page_description;
$page_css = '<link rel="stylesheet" href="css/layout.css">';
include 'header.php';
?>
  <div class="split-container">
    <div class="split-left">
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
    </div>
    <div class="split-right">
      <div id="actualites-include">Chargement des actualités…</div>
    </div>
  </div>
  <script>
    // Carrousel vidéo avec fondu enchaîné
        // Inclure dynamiquement la page actualites-madagascar.html dans <split-right>
        fetch('actualites-madagascar.php')
          .then(response => response.text())
          .then(html => {
            // Extraire uniquement le contenu utile (entre <body> et </body>)
            const bodyMatch = html.match(/<body[^>]*>([\s\S]*?)<\/body>/i);
            let content = bodyMatch ? bodyMatch[1] : html;
            // Nettoyer les balises <body> et <html> si présentes
            // Supprimer le script d'updateHeaderDate pour éviter doublon
            content = content.replace(/<script[\s\S]*?updateHeaderDate\(\);[\s\S]*?<\/script>/gi, '');
            document.getElementById('actualites-include').innerHTML = content;

            // Après injection, exécuter le script de chargement des flux RSS
            // Affichage dynamique de la date du jour dans l'en-tête (si présente)
            var dateEl = document.getElementById('header-date');
            if (dateEl) {
              const date = new Date();
              const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
              const formatted = date.toLocaleDateString('fr-FR', options);
              dateEl.textContent = formatted.charAt(0).toUpperCase() + formatted.slice(1);
            }
            // Chargement des flux RSS
            const fluxList = [
              {
                id: 'flux-tribune',
                url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fwww.madagascar-tribune.com%2Fspip.php%3Fpage%3Dbackend'
              },
              {
                id: 'flux-lgdi',
                url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Flgdi-madagascar.com%2Ffeed%2F'
              },
              {
                id: 'flux-midi',
                url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fmidi-madagasikara.mg%2Ffeed%2F'
              },
              {
                id: 'flux-lexpress',
                url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fwww.lexpress.mg%2Ffeeds%2Fposts%2Fdefault'
              },
              {
                id: 'flux-newsmada',
                url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fnewsmada.com%2Ffeed%2F'
              }
            ];
            fluxList.forEach(flux => {
              const feedDiv = document.querySelector(`#${flux.id} .json-feed`);
              if (!feedDiv) return;
              fetch(flux.url)
                .then(response => response.json())
                .then(data => {
                  let html = '<ul>';
                  if (data.items && data.items.length > 0) {
                    let items = data.items.slice(0, 5);
                    items.forEach(item => {
                      let description = item.description || '';
                      // Supprimer toutes les balises HTML (images, liens, titres, etc.)
                      description = description.replace(/<[^>]+>/g, '');
                      // Limiter la longueur de la description (optionnel, ex: 350 caractères)
                      let descShort = description.length > 350 ? description.substring(0, 347) + '…' : description;
                      html += `<li>\n<a href="${item.link}" target="_blank">${item.title}</a>\n<div>${descShort}</div>\n</li>`;
                    });
                  } else {
                    html += '<li>Aucun article trouvé.</li>';
                  }
                  html += '</ul>';
                  feedDiv.innerHTML = html;
                })
                .catch(error => {
                  feedDiv.innerHTML = "Erreur de chargement du flux.";
                });
            });
          })
          .catch(() => {
            document.getElementById('actualites-include').innerHTML = "Impossible de charger les actualités.";
          });
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

      // Initialiser l'affichage au chargement
      updateLeftContentVisibility();

      let isTransitioning = false;
      bgvideo.addEventListener('ended', function() {
        if (isTransitioning) return;
        isTransitioning = true;
        // Fondu de sortie
        bgvideo.style.transition = 'opacity 0.7s cubic-bezier(0.4,0,0.2,1)';
        bgvideo.style.opacity = 0;
        setTimeout(function() {
          currentVideo = (currentVideo + 1) % videoList.length;
          bgvideoSource.src = videoList[currentVideo];
          bgvideo.load();
        }, 400);
      });

      // Quand la nouvelle vidéo est prête, fondu d'entrée
      bgvideo.addEventListener('loadeddata', function() {
        // On ne relance que si la vidéo est invisible (transition)
        if (bgvideo.style.opacity === '0') {
          bgvideo.play();
          setTimeout(function() {
            bgvideo.style.opacity = 1;
            updateLeftContentVisibility();
            isTransitioning = false;
          }, 100); // petit délai pour garantir l'image affichée
        }
      });
    }

    const fluxList = [
      {
        id: 'flux-tribune',
        url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fwww.madagascar-tribune.com%2Fspip.php%3Fpage%3Dbackend'
      },
      {
        id: 'flux-lgdi',
        url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Flgdi-madagascar.com%2Ffeed%2F'
      },
      {
        id: 'flux-midi',
        url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fmidi-madagasikara.mg%2Ffeed%2F'
      },
      {
        id: 'flux-lexpress',
        url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fwww.lexpress.mg%2Ffeeds%2Fposts%2Fdefault'
      },
      {
        id: 'flux-newsmada',
        url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fnewsmada.com%2Ffeed%2F'
      }
    ];

    fluxList.forEach(flux => {
      fetch(flux.url)
        .then(response => response.json())
        .then(data => {
          let html = '<ul>';
          if (data.items && data.items.length > 0) {
            let items = data.items.slice(0, 5);
            items.forEach(item => {
              let description = item.description || '';
              // Supprimer toutes les balises HTML (images, liens, titres, etc.)
              description = description.replace(/<[^>]+>/g, '');
              // Limiter la longueur de la description (optionnel, ex: 350 caractères)
              let descShort = description.length > 350 ? description.substring(0, 347) + '…' : description;
              html += `<li>
                <a href="${item.link}" target="_blank">${item.title}</a>
                <div>${descShort}</div>
              </li>`;
            });
          } else {
            html += '<li>Aucun article trouvé.</li>';
          }
          html += '</ul>';
          document.querySelector(`#${flux.id} .json-feed`).innerHTML = html;
        })
        .catch(error => {
          document.querySelector(`#${flux.id} .json-feed`).innerHTML = "Erreur de chargement du flux.";
        });
    });
  </script>
</body>
</html>