<header class="page-header">
  <span class="header-title">International Press (English)</span>
  <span class="header-date" id="header-date"></span>
</header>
<div class="flux-vertical">
  <div class="flux-block" id="flux-bbc">
    <h2><span class="flux-icon">📰</span>BBC News Africa</h2>
    <div class="json-feed">Loading…</div>
  </div>
  <div class="flux-block" id="flux-reuters">
    <h2><span class="flux-icon">📰</span>Reuters Africa</h2>
    <div class="json-feed">Loading…</div>
  </div>
  <div class="flux-block" id="flux-allafricaen">
    <h2><span class="flux-icon">📰</span>AllAfrica Madagascar (EN)</h2>
    <div class="json-feed">Loading…</div>
  </div>
  <div class="flux-block" id="flux-africareport">
    <h2><span class="flux-icon">📰</span>The Africa Report</h2>
    <div class="json-feed">Loading…</div>
  </div>
</div>
<script>
  // Dynamic date in header
  function updateHeaderDate() {
    const date = new Date();
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const formatted = date.toLocaleDateString('en-GB', options);
    document.getElementById('header-date').textContent = formatted.charAt(0).toUpperCase() + formatted.slice(1);
  }
  updateHeaderDate();
  const fluxList = [
    {
      id: 'flux-bbc',
      url: 'https://api.rss2json.com/v1/api.json?rss_url=http%3A%2F%2Ffeeds.bbci.co.uk%2Fnews%2Fworld%2Fafrica%2Frss.xml'
    },
    {
      id: 'flux-reuters',
      url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fwww.reuters.com%2FrssFeed%2FafricaNews'
    },
    {
      id: 'flux-allafricaen',
      url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fallafrica.com%2Ffeeds%2Fcountry%2Fmadagascar%2Fheadlines.xml'
    },
    {
      id: 'flux-africareport',
      url: 'https://api.rss2json.com/v1/api.json?rss_url=https%3A%2F%2Fwww.theafricareport.com%2Ffeed%2F'
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
          html += '<li>No articles found.</li>';
        }
        html += '</ul>';
        document.querySelector(`#${flux.id} .json-feed`).innerHTML = html;
      })
      .catch(error => {
        document.querySelector(`#${flux.id} .json-feed`).innerHTML = "Feed loading error.";
      });
  });
</script>
<?php include 'footer.php'; ?>
