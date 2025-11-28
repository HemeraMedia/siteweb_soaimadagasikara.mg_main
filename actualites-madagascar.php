<?php
$page_title = 'Actualités de Madagascar - Soa i Madagasikara';
$page_description = "Retrouvez toute l’actualité de Madagascar en temps réel : informations, journaux, presse, société, économie, politique, diaspora. Sélection par Soa i Madagasikara.";
$page_keywords = "actualités Madagascar, presse Madagascar, journaux malgaches, Soa i Madagasikara, diaspora, informations Madagascar, société, économie, politique, news, Malagasy, Tribune, Midi, L'Express, NewsMada, LGDI";
$page_canonical = "https://soaimadagasikara.mg/actualites-madagascar.php";
$og_title = $page_title;
$og_description = $page_description;
$og_url = $page_canonical;
$twitter_title = $page_title;
$twitter_description = $page_description;
$page_css = '<link rel="stylesheet" href="css/actualite.css">';
include 'header.php';
?>
  <header class="page-header">
    <span class="header-title">Actualités de Madagascar</span>
    <span class="header-date" id="header-date"></span>
  </header>
  <div class="flux-vertical">
    <div class="flux-block" id="flux-tribune">
      <h2><span class="flux-icon">📰</span>Madagascar Tribune</h2>
      <div class="json-feed">Chargement…</div>
    </div>
    <div class="flux-block" id="flux-lgdi">
      <h2><span class="flux-icon">📰</span>La Gazette de la Grande Ile</h2>
      <div class="json-feed">Chargement…</div>
    </div>
    <div class="flux-block" id="flux-midi">
      <h2><span class="flux-icon">📰</span>Midi Madagasikara</h2>
      <div class="json-feed">Chargement…</div>
    </div>
    <div class="flux-block" id="flux-lexpress">
      <h2><span class="flux-icon">📰</span>L'Express de Madagascar</h2>
      <div class="json-feed">Chargement…</div>
    </div>
    <div class="flux-block" id="flux-newsmada">
      <h2><span class="flux-icon">📰</span>NewsMada</h2>
      <div class="json-feed">Chargement…</div>
    </div>
  </div>
  <script>
        // Affichage dynamique de la date du jour dans l'en-tête
        function updateHeaderDate() {
          const date = new Date();
          const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
          const formatted = date.toLocaleDateString('fr-FR', options);
          document.getElementById('header-date').textContent = formatted.charAt(0).toUpperCase() + formatted.slice(1);
        }
        updateHeaderDate();
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
