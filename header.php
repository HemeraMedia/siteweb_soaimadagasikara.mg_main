
<?php
// header.php - En-tête du site (template commun)
// Variables attendues :
// $page_title, $page_description, $page_keywords, $page_canonical, $og_title, $og_description, $og_url, $twitter_title, $twitter_description, $page_css
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title><?php echo isset($page_title) ? $page_title : 'Soa i Madagasikara'; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo isset($page_description) ? $page_description : 'Association Soa i Madagasikara : actions de la diaspora pour le développement économique, social, culturel et sportif à Madagascar.'; ?>">
  <meta name="keywords" content="<?php echo isset($page_keywords) ? $page_keywords : 'association Madagascar, diaspora, malagasy, Soa i Madagasikara, développement, solidarité, projets, actualités, économie, culture, sport, entraide, ONG, news Madagascar'; ?>">
  <meta name="author" content="Soa i Madagasikara">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;400&display=swap" rel="stylesheet">
  <?php if (isset($page_canonical)) { ?>
    <link rel="canonical" href="<?php echo $page_canonical; ?>">
  <?php } ?>
  <meta property="og:title" content="<?php echo isset($og_title) ? $og_title : (isset($page_title) ? $page_title : 'Soa i Madagasikara'); ?>">
  <meta property="og:description" content="<?php echo isset($og_description) ? $og_description : (isset($page_description) ? $page_description : 'Association Soa i Madagasikara : actions de la diaspora pour le développement économique, social, culturel et sportif à Madagascar.'); ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo isset($og_url) ? $og_url : (isset($page_canonical) ? $page_canonical : 'https://soaimadagasikara.mg/'); ?>">
  <meta property="og:image" content="https://soaimadagasikara.mg/soaimadagasikara.png">
  <meta property="og:locale" content="fr_FR">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo isset($twitter_title) ? $twitter_title : (isset($page_title) ? $page_title : 'Soa i Madagasikara'); ?>">
  <meta name="twitter:description" content="<?php echo isset($twitter_description) ? $twitter_description : (isset($page_description) ? $page_description : 'Association Soa i Madagasikara : actions de la diaspora pour le développement économique, social, culturel et sportif à Madagascar.'); ?>">
  <meta name="twitter:image" content="https://soaimadagasikara.mg/soaimadagasikara.png">
  <?php if (isset($page_css)) echo $page_css; ?>
</head>
<body>
