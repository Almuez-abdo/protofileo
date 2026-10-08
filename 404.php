<?php
ob_start();
$pageTitle = 'Page Not Found';
$current_page = '404.php';
include 'includes/func/function.php';
include 'includes/config.php';
include 'includes/header.php';
include 'includes/nav.php';
http_response_code(404);
?>
<main id="main">
  <section class="pf-section">
    <div class="pf-wrap" style="text-align:center;max-width:560px;">
      <p class="pf-kicker">Error 404</p>
      <h1 class="pf-h2" style="font-size:2.6rem">This page went missing.</h1>
      <p class="pf-sub" style="margin-left:auto;margin-right:auto">The link you followed doesn't exist or was moved. Let's get you back to something useful.</p>
      <div class="pf-cta" style="justify-content:center">
        <a class="pf-btn" href="index.php">Back to Home</a>
        <a class="pf-btn-ghost" href="index.php#projects">View My Work</a>
      </div>
    </div>
  </section>
</main>
<?php
include 'includes/footer.php';
ob_end_flush();
