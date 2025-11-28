<?php
// index2.php : structure moderne avec header, container, split-left, split-right, footer
$page_title = 'Accueil - Soa i Madagasikara';
$page_description = "Association Soa i Madagasikara : actions de la diaspora pour le développement économique, social, culturel et sportif à Madagascar.";
$page_keywords = "association Madagascar, diaspora, malagasy, Soa i Madagasikara, développement, solidarité, projets, actualités, économie, culture, sport, entraide, ONG, news Madagascar";
$page_canonical = "https://soaimadagasikara.mg/index2.php";
$og_title = $page_title;
$og_description = $page_description;
$og_url = $page_canonical;
$twitter_title = $page_title;
$twitter_description = $page_description;
$page_css = '<link rel="stylesheet" href="css/layout.css">';
include 'header.php';
?>
<div class="container">
  <div class="split-container">
    <div class="split-left">
      <?php include 'submain.php'; ?>
    </div>
    <div class="split-right">
      <?php include 'subactu.php'; ?>
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>

