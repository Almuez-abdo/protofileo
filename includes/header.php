<?php
require_once __DIR__ . '/config.php';
if (!isset($pageTitle)) { $pageTitle = $SITE['name'] . ' | Web Developer'; }
$metaDesc = 'Portfolio of ' . $SITE['name'] . ', a Web Developer building modern, fast, and scalable web experiences.';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?php echo htmlspecialchars($metaDesc); ?>">
  <meta name="theme-color" content="#0b0f17">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($metaDesc); ?>">
  <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230b0f17'/%3E%3Ctext x='32' y='44' font-size='34' text-anchor='middle' fill='%2322d3ee' font-family='monospace' font-weight='bold'%3E%3C/%3E%3C/text%3E%3C/svg%3E">
  <link rel="stylesheet" href="layout/css/bootstrap.min.css">
  <link rel="stylesheet" href="layout/css/all.css">
  <link rel="stylesheet" href="layout/css/front.css?v=4">
  <noscript><style>.reveal { opacity: 1 !important; transform: none !important; }</style></noscript>
  <title><?php echo htmlspecialchars($pageTitle); ?></title>
  <script type="application/ld+json">
  {"@context":"https://schema.org","@type":"Person","name":"<?php echo htmlspecialchars($SITE['name']); ?>","jobTitle":"Web Developer"}
  </script>
</head>
<body>
<a class="skip-link" href="#main">Skip to content</a>
