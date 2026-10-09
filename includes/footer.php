<footer class="pf-footer">
  <div class="pf-wrap pf-foot-grid">
    <div>
      <p class="pf-foot-brand">&lt;/&gt; <?php echo htmlspecialchars($SITE['name']); ?></p>
      <p class="pf-foot-tag">Web Developer — modern, fast, and scalable web experiences.</p>
    </div>
    <nav aria-label="Footer">
      <a href="<?php echo ($current_page ?? '') === 'index.php' ? '#home' : 'index.php'; ?>">Home</a>
      <a href="index.php#projects">Projects</a>
      <a href="index.php#contact">Contact</a>
      <a href="follow.php">Cost Estimator</a>
    </nav>
    <div class="pf-social">
      <a href="<?php echo htmlspecialchars($SITE['github']); ?>" aria-label="GitHub profile" title="GitHub">
        <svg viewBox="0 0 16 16" width="20" height="20" fill="currentColor" aria-hidden="true"><path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8Z"/></svg>
      </a>
      <a href="mailto:<?php echo htmlspecialchars($SITE['email']); ?>" aria-label="Send email" title="Email">
        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m2 7 10 6L22 7"/></svg>
      </a>
    </div>
  </div>
  <p class="pf-copy">Create by Ezzo Service @2025</p>
</footer>

<button class="pf-top" id="toTop" aria-label="Scroll back to top">↑</button>
<script src="layout/js/bootstrap.bundle.min.js"></script>
<script src="layout/js/bakap.js?v=3"></script>
</body>
</html>
