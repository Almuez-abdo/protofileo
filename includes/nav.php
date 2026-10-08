<?php
$navLinks = [
    ['href' => '#home',       'label' => 'Home'],
    ['href' => '#about',      'label' => 'About'],
    ['href' => '#skills',     'label' => 'Skills'],
    ['href' => '#projects',   'label' => 'Projects'],
    ['href' => '#contact',    'label' => 'Contact'],
];
$onHome = ($current_page ?? '') === 'index.php';
?>
<nav class="pf-nav" aria-label="Main navigation">
  <div class="pf-nav-inner">
    <a class="pf-brand" href="<?php echo $onHome ? '#home' : 'index.php'; ?>" aria-label="Homepage">&lt;/&gt; <?php echo htmlspecialchars($SITE['name']); ?></a>
    <button class="pf-burger" id="navToggle" aria-expanded="false" aria-controls="navMenu" aria-label="Open menu">
      <span></span><span></span><span></span>
    </button>
    <ul class="pf-links" id="navMenu">
      <?php foreach ($navLinks as $l): ?>
        <li><a class="pf-link" data-section="<?php echo ltrim($l['href'], '#'); ?>" href="<?php echo $onHome ? $l['href'] : 'index.php' . $l['href']; ?>"><?php echo $l['label']; ?></a></li>
      <?php endforeach; ?>
      <li><a class="pf-btn pf-btn-sm" href="<?php echo $onHome ? '#contact' : 'index.php#contact'; ?>">Hire Me</a></li>
    </ul>
  </div>
</nav>
