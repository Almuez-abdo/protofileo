<?php
/* =====================================================================
   SITE CONFIG - edit every placeholder in this ONE file to personalize
   the portfolio. Anything wrapped like [YOUR NAME] must be replaced
   with real information before sending the site to recruiters.
   ===================================================================== */

$SITE = [
    'name'     => 'Elmuez Abdullah',
    'role'     => 'Web Developer',
    'tagline'  => 'Building modern, fast, and scalable web experiences that turn ideas into real products.',
    'email'    => 'ezzoservice@gmail.com',
    'phone'    => '+9660540612435',
    'github'   => 'https://github.com/Almuez-abdo',
    'cv'       => 'assets/cv.pdf', // place your real CV file at this path
];

/* Outgoing mail (contact form). Uses Gmail SMTP.
   1. Enable 2-Step Verification on the Google account.
   2. Create an App Password: Google Account > Security > App passwords.
   3. Put that 16-letter password in 'pass' below (NOT your login password). */
$MAIL = [
    'host' => 'smtp.gmail.com',
    'port' => 587,
    'user' => 'ezzoservice@gmail.com',
    'pass' => '[GMAIL-APP-PASSWORD]',
    'to'   => 'ezzoservice@gmail.com',
];

/* Local secrets override (never committed - see .gitignore).
   Copy config.local.example.php to config.local.php and put the real
   Gmail app password there. */
if (is_file(__DIR__ . '/config.local.php')) {
    $LOCAL = require __DIR__ . '/config.local.php';
    if (isset($LOCAL['MAIL']) && is_array($LOCAL['MAIL'])) {
        $MAIL = array_merge($MAIL, $LOCAL['MAIL']);
    }
}
/* About statistics - replace each value with a real number. */
$STATS = [
    ['value' => '5', 'label' => 'Years of Experience'],
    ['value' => '8', 'label' => 'Projects Completed'],
    ['value' => '10', 'label' => 'Technologies Used'],
    ['value' => '8', 'label' => 'Happy Clients'],
];

/* Skills, grouped. Add/remove items freely. */
$SKILLS = [
    'Front-End' => ['HTML5', 'CSS3', 'JavaScript', 'Responsive Design'],
    'Back-End'  => ['PHP', 'Node.js', 'REST APIs', 'MySQL'],
    'Tools'     => ['Git', 'GitHub', 'VS Code', 'Figma', 'XAMPP'],
];

/* Featured project (large case-study card). */
$FEATURED = [
    'name'        => 'Ezzo Service - Bookstore Platform',
    'overview'    => 'A web platform for buying, selling, and exchanging used books, with categorized listings, user accounts, and order management.',
    'challenge'   => 'Readers needed a single place to list their books for sale, find fairly priced used books, and arrange exchanges with other readers.',
    'solution'    => 'I built a PHP/MySQL platform with book listings by section, a checkout flow that generates tracked order numbers, and a book-exchange request system with photo uploads.',
    'tech'        => ['PHP', 'MySQL', 'Bootstrap', 'JavaScript'],
    'features'    => ['Book listings with photos, condition, and price', 'Checkout with tracked order numbers and payments', 'Book exchange requests between users'],
    'result'      => 'A complete working marketplace covering the full lifecycle: listing, purchase, and exchange.',
    'demo'        => '../ezoService/index.php',
    'github'      => 'https://github.com/Almuez-abdo/ezoService',
];

/* Project cards. 'folder' must match a folder inside layout/images/.
   'shots' = how many N.png screenshots that folder holds. */
$PROJECTS = [
    [
        'name'   => 'Government Services Portal',
        'folder' => 'comp',
        'desc'   => 'Service portal for police and civil-registry procedures with a service-center directory and news updates.',
        'tech'   => ['PHP', 'MySQL', 'Bootstrap'],
        'demo'   => '../complaints/index.php', 'github' => 'https://github.com/Almuez-abdo/complaints',
    ],
    [
        'name'   => 'Ezzo Service Bookstore',
        'folder' => 'ezo_web',
        'desc'   => 'Online bookstore with categorized browsing, book details, pricing, and purchase flow.',
        'tech'   => ['PHP', 'MySQL', 'Bootstrap'],
        'github' => 'https://github.com/Almuez-abdo/ezoService',
    ],
    [
        'name'   => 'Educational Platform',
        'folder' => 'platformR',
        'desc'   => 'E-learning platform with courses dashboard, subscriptions, and student accounts.',
        'tech'   => ['PHP', 'MySQL', 'Bootstrap'],
        'github' => 'https://github.com/Almuez-abdo/platformR',
    ],
    [
        'name'   => 'Rayo Marketing Website',
        'folder' => 'Rayo_Markting',
        'desc'   => 'Marketing agency website with services, team members, and a project gallery.',
        'tech'   => ['HTML', 'CSS', 'JavaScript'],
        'demo'   => '../Rayo%20Company/Rayo.html', 'github' => 'https://github.com/Almuez-abdo/Rayo-Company',
    ],
    [
        'name'   => 'Scale Line Company Website',
        'folder' => 'Scale Line',
        'desc'   => 'Construction company website presenting services, projects, and contact information.',
        'tech'   => ['HTML', 'CSS', 'JavaScript'],
        'demo'   => '../Scale%20Line/index.html', 'github' => 'https://github.com/Almuez-abdo/Scale-Line',
    ],
    [
        'name'   => 'SEG Management System',
        'folder' => 'seg',
        'desc'   => 'Personnel-affairs dashboard with employee records, request tracking, and announcements.',
        'tech'   => ['PHP', 'MySQL', 'JavaScript'],
        'demo'   => '../SEG/log.php', 'github' => 'https://github.com/Almuez-abdo/SEG',
    ],
    [
        'name'   => 'White Rose Clinic Website',
        'folder' => 'white_rose',
        'desc'   => 'Clinic website with separate doctor and patient login areas and online consultation requests.',
        'tech'   => ['PHP', 'MySQL', 'Bootstrap'],
        'demo'   => '../White_Rose/index.php', 'github' => '[GITHUB URL]',
    ],
    [
        'name'   => 'Qudurat - Mobile App UI',
        'folder' => 'qudurat', 'portrait' => true,
        'desc'   => 'Educational mobile app for general-aptitude test preparation, with subjects, practice tests, and subscriptions.',
        'tech'   => ['Flutter', 'Android'],
'github' => '[GITHUB URL]',
    ],
    [
        'name'   => 'Ezzo Service - Mobile App UI',
        'folder' => 'Ezzo_service', 'portrait' => true,
        'desc'   => 'Bookstore mobile app with categorized book browsing, book details, and purchase flow.',
        'tech'   => ['Flutter', 'Android'],
'github' => '[GITHUB URL]',
    ],
    [
        'name'   => 'Job Opportunity - Mobile App UI',
        'folder' => 'job_opportunity', 'portrait' => true,
        'desc'   => 'Job platform mobile app connecting recruitment agencies with job seekers through dedicated logins.',
        'tech'   => ['Flutter', 'Android'],
'github' => '[GITHUB URL]',
    ],
    [
        'name'   => 'Sado - Mobile App UI',
        'folder' => 'sado', 'portrait' => true,
        'desc'   => 'Pharmaceutical supply mobile app linking companies, pharmacies, and labs, with orders, price lists, and statistics.',
        'tech'   => ['Flutter', 'Android'],
'github' => '[GITHUB URL]',
    ],
];

/* Services offered. */
$SERVICES = [
    ['t' => 'Website Development',            'd' => 'Modern, maintainable websites built with clean code and best practices.'],
    ['t' => 'Responsive Web Design',          'd' => 'Layouts that look and work great on desktop, tablet, and mobile.'],
    ['t' => 'Landing Page Development',       'd' => 'Fast, focused pages designed to convert visitors into customers.'],
    ['t' => 'Front-End Development',          'd' => 'Interactive interfaces with HTML, CSS, JavaScript, and React.'],
    ['t' => 'Web Application Development',    'd' => 'Dynamic apps with PHP or Node.js back ends and MySQL databases.'],
    ['t' => 'API Integration',                'd' => 'Connect your site to third-party services through REST APIs.'],
    ['t' => 'Performance Optimization',       'd' => 'Faster load times through image, asset, and code optimization.'],
    ['t' => 'Website Maintenance',            'd' => 'Ongoing updates, fixes, and improvements to keep sites healthy.'],
];

