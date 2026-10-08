<?php
// Vercel serverless entry point: run the homepage from the project root
// so all relative includes and asset URLs keep working.
chdir(__DIR__ . '/..');
require __DIR__ . '/../index.php';
