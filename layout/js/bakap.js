/* Portfolio interactions — vanilla JS, no dependencies. */
(function () {
  'use strict';

  /* ---------- Mobile navigation ---------- */
  var toggle = document.getElementById('navToggle');
  var menu = document.getElementById('navMenu');
  if (toggle && menu) {
    toggle.addEventListener('click', function () {
      var open = menu.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      toggle.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
    });
    menu.addEventListener('click', function (e) {
      if (e.target.closest('a')) {
        menu.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
      }
    });
  }

  /* ---------- Sticky nav shadow + scroll-to-top ---------- */
  var nav = document.querySelector('.pf-nav');
  var toTop = document.getElementById('toTop');
  function onScroll() {
    var y = window.scrollY || 0;
    if (nav) { nav.classList.toggle('scrolled', y > 10); }
    if (toTop) { toTop.classList.toggle('show', y > 500); }
  }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
  if (toTop) {
    toTop.addEventListener('click', function () {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  }

  /* ---------- Scrollspy ---------- */
  var links = Array.prototype.slice.call(document.querySelectorAll('.pf-link[data-section]'));
  var sections = links
    .map(function (a) { return document.getElementById(a.getAttribute('data-section')); })
    .filter(Boolean);
  if (sections.length && 'IntersectionObserver' in window) {
    var spy = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) {
          links.forEach(function (a) {
            a.classList.toggle('active', a.getAttribute('data-section') === en.target.id);
          });
        }
      });
    }, { rootMargin: '-40% 0px -55% 0px' });
    sections.forEach(function (s) { spy.observe(s); });
  }

  /* ---------- Reveal on scroll ---------- */
  var revealEls = document.querySelectorAll('.reveal');
  if ('IntersectionObserver' in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (en) {
        if (en.isIntersecting) {
          en.target.classList.add('in');
          io.unobserve(en.target);
        }
      });
    }, { threshold: 0.1 });
    revealEls.forEach(function (el) { io.observe(el); });
  } else {
    revealEls.forEach(function (el) { el.classList.add('in'); });
  }

  /* ---------- Project galleries: autoplay inside each project ----------
     Change AUTOPLAY_SECONDS to retime (e.g. 600 for 10 minutes). */
  var AUTOPLAY_SECONDS = 10;
  var reduceMotion = window.matchMedia &&
    window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var sliders = Array.prototype.slice.call(document.querySelectorAll('.slides'));
  sliders.forEach(function (slider, sIdx) {
    var dots = slider.querySelectorAll('.nav-dot');
    var radios = slider.querySelectorAll('input[type="radio"]');
    if (!radios.length) { return; }
    function paint() {
      radios.forEach(function (r, i) {
        if (dots[i]) { dots[i].classList.toggle('on', r.checked); }
      });
    }
    slider.addEventListener('change', paint);
    paint();
    if (reduceMotion || radios.length < 2) { return; }
    var timer = null;
    function current() {
      for (var i = 0; i < radios.length; i++) {
        if (radios[i].checked) { return i; }
      }
      return 0;
    }
    function go(n) {
      radios[n].checked = true;
      paint();
    }
    function start() {
      stop();
      timer = setInterval(function () {
        if (document.hidden) { return; }
        go((current() + 1) % radios.length);
      }, AUTOPLAY_SECONDS * 1000 + sIdx * 700);
    }
    function stop() {
      if (timer) { clearInterval(timer); timer = null; }
    }
    slider.addEventListener('mouseenter', stop);
    slider.addEventListener('mouseleave', start);
    slider.addEventListener('focusin', stop);
    slider.addEventListener('focusout', start);
    start();
  });

  /* ---------- Contact form: validate, then compose email ---------- */
  var form = document.getElementById('contactForm');
  if (form) {
    var note = document.getElementById('contactNote');
    var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var ok = true;
      form.querySelectorAll('.pf-field').forEach(function (field) {
        var input = field.querySelector('input, textarea');
        if (!input) { return; }
        var val = input.value.trim();
        var rule = field.getAttribute('data-check');
        var valid = val.length > 0;
        if (rule === 'email') { valid = emailRe.test(val); }
        if (input.tagName === 'TEXTAREA') { valid = val.length >= 10; }
        field.classList.toggle('invalid', !valid);
        if (!valid) { ok = false; }
      });
      if (!ok) {
        note.className = 'pf-form-note bad';
        note.textContent = 'Please fix the highlighted fields and try again.';
        return;
      }
      var name = form.name.value.trim();
      var email = form.email.value.trim();
      var subject = form.subject.value.trim();
      var body = form.message.value.trim();
      note.className = 'pf-form-note';
      note.textContent = 'Sending…';
      var btn = form.querySelector('button[type="submit"]');
      if (btn) { btn.disabled = true; }
      fetch('contact.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name: name, email: email, subject: subject, message: body })
      }).then(function (res) { return res.json(); }).then(function (data) {
        if (btn) { btn.disabled = false; }
        if (data.ok) {
          note.className = 'pf-form-note ok';
          note.textContent = 'Thanks ' + name + '! Your message has been sent. I usually reply within one business day.';
          form.reset();
        } else {
          note.className = 'pf-form-note bad';
          note.textContent = data.error || 'Could not send the message. Please try again later.';
        }
      }).catch(function () {
        if (btn) { btn.disabled = false; }
        note.className = 'pf-form-note bad';
        note.textContent = 'Network error. Please check your connection and try again.';
      });
    });
    form.querySelectorAll('input, textarea').forEach(function (input) {
      input.addEventListener('input', function () {
        input.closest('.pf-field').classList.remove('invalid');
      });
    });
  }
})();
