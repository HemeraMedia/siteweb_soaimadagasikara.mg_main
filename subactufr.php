<header class="page-header">
  <span class="header-title">Presse internationale francophone</span>
  <span class="header-date" id="header-date"></span>
</header>
<div class="flux-vertical">
  <div class="flux-block" id="flux-rfi">
    <h2><span class="flux-icon">📰</span>RFI Madagascar</h2>
    <div class="json-feed">Chargement…</div>
  </div>
  <div class="flux-block" id="flux-allafrica">
    <h2><span class="flux-icon">📰</span>AllAfrica Madagascar</h2>
    <div class="json-feed">Chargement…</div>
  </div>
  <div class="flux-block" id="flux-googlenewsfr">
    <h2><span class="flux-icon">📰</span>Google News (FR)</h2>
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
      id: 'flux-rfi',
      url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fwww.rfi.fr%2Ffr%2Ftag%2Fmadagascar%2Frss'
    },
    {
      id: 'flux-allafrica',
      url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fallafrica.com%2Ffeeds%2Fcountry%2Fmadagascar%2Fheadlines.xml'
    },
    {
      id: 'flux-googlenewsfr',
      url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fnews.google.com%2Frss%2Fsearch%3Fq%3Dmadagascar%26hl%3Dfr%26gl%3DFR%26ceid%3DFR%3Afr'
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
            description = description.replace(/<[^>]+>/g, '');
            let descShort = description.length > 350 ? description.substring(0, 347) + '…' : description;
            html += `<li>\n<a href="${item.link}" target="_blank">${item.title}</a>\n<div>${descShort}</div>\n</li>`;
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
<?php include 'footer.php'; ?>
