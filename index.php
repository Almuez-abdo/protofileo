<?php
ob_start();
session_start();

$pageTitle = 'Home';
$current_page = basename($_SERVER['PHP_SELF']);
include 'includes/func/function.php';
include 'includes/config.php';
include 'includes/header.php';
include 'includes/nav.php';

/* Slider id counter shared by every gallery on this page. */
$pfSlideN = 0;

/* Render a CSS-only image slider. $shots = number of N.png files. */
function pf_slider($folder, $shots, $tall = false) {
    global $pfSlideN;
    $cls = $tall ? 'slides tall' : 'slides';
    echo '<div class="pf-proj-media"><ul class="' . $cls . '" role="group" aria-label="Project screenshots">';
    for ($i = 1; $i <= $shots; $i++) {
        $pfSlideN++;
        $id = 'pf-s' . $pfSlideN;
        $checked = ($i === 1) ? ' checked' : '';
        // neighbour ids, deterministic within this gallery
        $first = $pfSlideN - $i + 1;
        $prevId = 'pf-s' . ($first + (($i + $shots - 2) % $shots));
        $nextId = 'pf-s' . ($first + ($i % $shots));
        $src = 'layout/images/' . $folder . '/' . $i . '.png';
        echo '<input type="radio" name="pf-g' . $first . '" id="' . $id . '"' . $checked . '>';
        echo '<li class="slide-container"><div class="slide">';
        echo '<img src="' . htmlspecialchars($src) . '" alt="" loading="lazy">';
        echo '</div><div class="nav">';
        echo '<label class="prev" for="' . $prevId . '" aria-hidden="true">&#8249;</label>';
        echo '<label class="next" for="' . $nextId . '" aria-hidden="true">&#8250;</label>';
        echo '</div></li>';
    }
    $first = $pfSlideN - $shots + 1;
    echo '<li class="nav-dots" aria-hidden="true">';
    for ($i = 0; $i < $shots; $i++) {
        echo '<label class="nav-dot" for="pf-s' . ($first + $i) . '"></label>';
    }
    echo '</li></ul></div>';
}
?>
<main id="main">

  <!-- ================= HERO ================= -->
  <section class="pf-hero" id="home">
    <div class="pf-wrap pf-hero-grid">
      <div>
        <p class="pf-kicker">Available for new opportunities</p>
        <h1>Hi, I'm <span class="accent"><?php echo htmlspecialchars($SITE['name']); ?></span></h1>
        <p class="pf-role"><?php echo htmlspecialchars($SITE['role']); ?></p>
        <p class="pf-lead"><?php echo htmlspecialchars($SITE['tagline']); ?></p>
        <div class="pf-cta">
          <a class="pf-btn" href="#projects">View My Work</a>
          <a class="pf-btn-ghost" href="#contact">Contact Me</a>
        </div>
        <div class="pf-social-row">
          <a class="pf-icon-btn" href="<?php echo htmlspecialchars($SITE['github']); ?>">GitHub</a>
          <a class="pf-icon-btn" href="<?php echo htmlspecialchars($SITE['cv']); ?>" download>Download CV</a>
        </div>
      </div>
      <div class="code-window" aria-hidden="true">
        <div class="code-bar"><i></i><i></i><i></i></div>
<pre><code><span class="tok-c">// what I do</span>
<span class="tok-k">const</span> developer = {
  name: <span class="tok-s">'<?php echo htmlspecialchars($SITE['name']); ?>'</span>,
  role: <span class="tok-s">'<?php echo htmlspecialchars($SITE['role']); ?>'</span>,
  stack: [<span class="tok-s">'PHP'</span>, <span class="tok-s">'JavaScript'</span>, <span class="tok-s">'MySQL'</span>],
  focus: <span class="tok-s">'performance &amp; UX'</span>,
  hireable: <span class="tok-k">true</span>
};
<span class="tok-f">build</span>(developer);<span class="typing-caret"></span></code></pre>
        <div class="pf-badges">
          <span class="pf-tech" style="list-style:none;margin:0;padding:0;display:flex;gap:8px;flex-wrap:wrap;">
            <li>PHP</li><li>JavaScript</li><li>MySQL</li><li>Bootstrap</li>
          </span>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= ABOUT ================= -->
  <section class="pf-section" id="about">
    <div class="pf-wrap">
      <span class="pf-kicker">About</span>
      <h2 class="pf-h2">About Me</h2>
      <p class="pf-sub">A developer focused on clean code, real performance, and experiences users enjoy.</p>
      <div class="pf-about-grid">
        <div class="pf-card reveal">
          <p>I'm <strong>Elmuez Abdullah</strong>, a <strong>web developer</strong> specializing in building complete websites and web applications, from responsive user interfaces to back-end databases using PHP/MySQL.</p>
          <p>My approach is simple: first, <strong>understand the problem</strong>, then write <strong>clean, maintainable code</strong> that remains fast as the product grows. I pay attention to the finer details — like performance budgets, accessibility, and consistent user interfaces — because that's what transforms an effective website into a professional one.</p>
          <p>My goal is to <strong>bring your ideas to life</strong> and ensure your complete satisfaction.</p>
        </div>
        <div class="pf-stats">
          <?php foreach ($STATS as $s): ?>
            <div class="pf-stat reveal"><b><?php echo htmlspecialchars($s['value']); ?></b><span><?php echo htmlspecialchars($s['label']); ?></span></div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= SKILLS ================= -->
  <section class="pf-section" id="skills">
    <div class="pf-wrap">
      <span class="pf-kicker">Skills</span>
      <h2 class="pf-h2">Technical Skills</h2>
      <p class="pf-sub">The tools I use to design, build, and ship for the web.</p>
      <div class="pf-grid-3">
        <?php foreach ($SKILLS as $cat => $items): ?>
          <div class="pf-card pf-skill-cat reveal">
            <h3><?php echo htmlspecialchars($cat); ?></h3>
            <ul class="pf-tags">
              <?php foreach ($items as $sk): ?><li><?php echo htmlspecialchars($sk); ?></li><?php endforeach; ?>
            </ul>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ================= FEATURED ================= -->
  <section class="pf-section" id="featured">
    <div class="pf-wrap">
      <span class="pf-kicker">Featured Project</span>
      <h2 class="pf-h2"><?php echo htmlspecialchars($FEATURED['name']); ?></h2>
      <p class="pf-sub">A closer look at my strongest piece of work.</p>
      <article class="pf-card pf-featured reveal">
        <?php pf_slider('Ezzo_service', 3, true); ?>
        <div class="pf-featured-body">
          <h3>Overview</h3>
          <p><?php echo htmlspecialchars($FEATURED['overview']); ?></p>
          <h3>The Challenge</h3>
          <p><?php echo htmlspecialchars($FEATURED['challenge']); ?></p>
          <h3>The Solution</h3>
          <p><?php echo htmlspecialchars($FEATURED['solution']); ?></p>
          <ul class="pf-tech">
            <?php foreach ($FEATURED['tech'] as $t): ?><li><?php echo htmlspecialchars($t); ?></li><?php endforeach; ?>
          </ul>
          <h3>Key Features</h3>
          <ul class="pf-feat-list">
            <?php foreach ($FEATURED['features'] as $f): ?><li><?php echo htmlspecialchars($f); ?></li><?php endforeach; ?>
          </ul>
          <p><strong>Result:</strong> <?php echo htmlspecialchars($FEATURED['result']); ?></p>
          <div class="pf-proj-actions">
            <a class="pf-btn-ghost pf-btn-sm" href="<?php echo htmlspecialchars($FEATURED['github']); ?>">GitHub</a>
          </div>
        </div>
      </article>
    </div>
  </section>

  <!-- ================= PROJECTS ================= -->
  <section class="pf-section" id="projects">
    <div class="pf-wrap">
      <span class="pf-kicker">Projects</span>
      <h2 class="pf-h2">Selected Work</h2>
      <p class="pf-sub">A tour of my best work — real projects, real results.</p>
      <div class="pf-card pf-showcase reveal" id="showcase">
        <ul class="slides showcase-slides" role="group" aria-label="Project showcase">
          <?php $fc = count($PROJECTS); $fi = 0; ?>
          <?php foreach ($PROJECTS as $p): $fi++;
            $fprev = ($fi - 1 < 1) ? $fc : $fi - 1;
            $fnext = ($fi + 1 > $fc) ? 1 : $fi + 1;
          ?>
            <input type="radio" name="pf-feat" id="pf-f<?php echo $fi; ?>"<?php echo ($fi === 1) ? ' checked' : ''; ?>>
            <li class="slide-container">
              <div class="slide">
                <div class="pf-show-grid">
                  <div class="pf-show-media">
                    <img src="<?php echo htmlspecialchars('layout/images/' . $p['folder'] . '/1.png'); ?>" alt="<?php echo htmlspecialchars($p['name']); ?> screenshot" loading="lazy">
                  </div>
                  <div class="pf-show-body">
                    <span class="pf-kicker">Project <?php echo $fi; ?> of <?php echo $fc; ?></span>
                    <h3><?php echo htmlspecialchars($p['name']); ?></h3>
                    <p><?php echo htmlspecialchars($p['desc']); ?></p>
                    <ul class="pf-tech">
                      <?php foreach ($p['tech'] as $t): ?><li><?php echo htmlspecialchars($t); ?></li><?php endforeach; ?>
                    </ul>
                    <div class="pf-proj-actions">
                      <a class="pf-btn-ghost pf-btn-sm" href="<?php echo htmlspecialchars($p['github']); ?>">GitHub</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="nav">
                <label class="prev" for="pf-f<?php echo $fprev; ?>" aria-hidden="true">&#8249;</label>
                <label class="next" for="pf-f<?php echo $fnext; ?>" aria-hidden="true">&#8250;</label>
              </div>
            </li>
          <?php endforeach; ?>
          <li class="nav-dots" aria-hidden="true">
            <?php for ($d = 1; $d <= $fc; $d++): ?>
              <label class="nav-dot" for="pf-f<?php echo $d; ?>"></label>
            <?php endfor; ?>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <!-- ================= SERVICES ================= -->
  <section class="pf-section" id="services">
    <div class="pf-wrap">
      <span class="pf-kicker">Services</span>
      <h2 class="pf-h2">What I Can Do For You</h2>
      <p class="pf-sub">Development services for employers and clients — including a free <a href="follow.php">cost estimator</a>.</p>
      <div class="pf-grid-4">
        <?php $i = 0; foreach ($SERVICES as $s): $i++; ?>
          <div class="pf-card reveal">
            <span class="pf-svc-num"><?php echo sprintf('%02d', $i); ?></span>
            <h3><?php echo htmlspecialchars($s['t']); ?></h3>
            <p><?php echo htmlspecialchars($s['d']); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ================= WHY HIRE ME ================= -->
  <section class="pf-section" id="why">
    <div class="pf-wrap">
      <span class="pf-kicker">For Recruiters</span>
      <h2 class="pf-h2">Why Hire Me</h2>
      <p class="pf-sub">What you get when you bring me onto your team.</p>
      <div class="pf-grid-3">
        <div class="pf-card reveal"><h3>Clean Code</h3><p>Readable, organized code your whole team can maintain and extend with confidence.</p></div>
        <div class="pf-card reveal"><h3>Problem Solving</h3><p>I break complex requirements into small, testable pieces and deliver working solutions.</p></div>
        <div class="pf-card reveal"><h3>Responsive Design</h3><p>Interfaces that work beautifully on desktop, tablet, and mobile — no afterthoughts.</p></div>
        <div class="pf-card reveal"><h3>Performance</h3><p>Optimized assets, lazy loading, and lean code for fast load times and smooth UX.</p></div>
        <div class="pf-card reveal"><h3>Attention to Detail</h3><p>Pixel-consistent layouts, accessible markup, and validated, error-free delivery.</p></div>
        <div class="pf-card reveal"><h3>Team Player</h3><p>Clear communication, Git workflows, and a habit of continuous learning.</p></div>
      </div>
    </div>
  </section>

  <!-- ================= CONTACT ================= -->
  <section class="pf-section" id="contact">
    <div class="pf-wrap">
      <span class="pf-kicker">Contact</span>
      <h2 class="pf-h2">Let's Work Together</h2>
      <p class="pf-sub">Have a role or a project in mind? Send a message — I usually reply within one business day.</p>
      <div class="pf-contact-grid">
        <div class="reveal">
          <ul class="pf-contact-list">
            <li><span>Email</span><a href="mailto:<?php echo htmlspecialchars($SITE['email']); ?>"><?php echo htmlspecialchars($SITE['email']); ?></a></li>
            <li><span>Phone</span><a href="tel:<?php echo htmlspecialchars($SITE['phone']); ?>"><?php echo htmlspecialchars($SITE['phone']); ?></a></li>
            <li><span>GitHub</span><a href="<?php echo htmlspecialchars($SITE['github']); ?>"><?php echo htmlspecialchars($SITE['github']); ?></a></li>
          </ul>
          <a class="pf-btn-ghost" href="<?php echo htmlspecialchars($SITE['cv']); ?>" download>Download CV</a>
        </div>
        <form class="pf-card pf-form reveal" id="contactForm" novalidate>
          <div class="pf-field" data-check="required">
            <label for="cfName">Name</label>
            <input id="cfName" name="name" type="text" autocomplete="name" required>
            <p class="pf-err">Please enter your name.</p>
          </div>
          <div class="pf-field" data-check="email">
            <label for="cfEmail">Email</label>
            <input id="cfEmail" name="email" type="email" autocomplete="email" required>
            <p class="pf-err">Please enter a valid email address.</p>
          </div>
          <div class="pf-field" data-check="required">
            <label for="cfSubject">Subject</label>
            <input id="cfSubject" name="subject" type="text" required>
            <p class="pf-err">Please enter a subject.</p>
          </div>
          <div class="pf-field" data-check="required">
            <label for="cfMsg">Message</label>
            <textarea id="cfMsg" name="message" required></textarea>
            <p class="pf-err">Please write your message (10+ characters).</p>
          </div>
          <button class="pf-btn" type="submit">Send Message</button>
          <p class="pf-form-note" id="contactNote" role="status" aria-live="polite"></p>
        </form>
      </div>
    </div>
  </section>

</main>

<?php
include 'includes/footer.php';
ob_end_flush();
