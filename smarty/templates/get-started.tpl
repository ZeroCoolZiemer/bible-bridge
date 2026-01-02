<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Started - BibleBridge Open Source Setup</title>
    <meta name="description" content="Technical guide to getting started with BibleBridge. Learn about server requirements, installation steps, and core features of our open-source scripture framework.">
    <link rel="stylesheet" href="/css/custom.css">
    {include file="bootstrap-head.tpl"}
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
    <style>
        ul.square-bullets { list-style-type: square; }
    </style>
</head>

<body class="body-text">
    {include file="menu.tpl"}
    
    <div class="container mt-4 px-4">
        <h1 class="text-center">Getting Started with BibleBridge</h1>
        <p class="mt-4 text-center">Follow this guide to deploy the BibleBridge framework on your own server and begin building your custom scripture interface.</p>

        <h2 class="mt-5">Server Requirements</h2>
        <div class="row">
            <div class="col-md-6 mb-3">
                <ul class="list-group">
                    <li class="list-group-item"><strong>PHP 8.1+</strong> (Required for modern security and performance)</li>
                    <li class="list-group-item"><strong>MySQL / MariaDB</strong> (Open-source SQL database support)</li>
                    <li class="list-group-item"><strong>Apache Module mod_rewrite</strong> (Required for clean SEO-friendly URLs)</li>
                </ul>
            </div>
            <div class="col-md-6 mb-3">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Smarty Template Engine</strong> (Included in repository)</li>
                    <li class="list-group-item"><strong>Bootstrap 5 & Icons</strong> (Loaded via CDN)</li>
                    <li class="list-group-item"><strong>Quill JS</strong> (Included for article editing)</li>
                </ul>
            </div>
        </div>

        <h2 class="mt-5">Core Framework Features</h2>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-dark h-100 border-1 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Database Integration <i class="bi bi-database ms-1" style="color:#0d6efd"></i></h5>
                        <p class="card-text">Connect your Bible database to display scripture and browse with ease. The framework uses optimized queries for rapid retrieval.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-dark h-100 border-1 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Article CMS <i class="bi bi-file-earmark-text ms-1" style="color:#ff5733"></i></h5>
                        <p class="card-text">Manage articles and study guides with a built-in CMS. Features rich text editing via Quill JS and automated homepage updates. <a class="text-decoration-none fw-bold" href="/login">Test CMS</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-dark h-100 border-1 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Adaptive Interface <i class="bi bi-layer-backward ms-1" style="color:#28a745"></i></h5>
                        <p class="card-text">The UI automatically adapts navigation and book names to match the language of your specific Bible database tables.</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mt-5">Deployment Steps</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="bg-light p-4 rounded border">
                    <ol>
                        <li class="mb-2"><strong>Clone the Repository:</strong> Fork or clone the project from GitHub to your local environment or server.</li>
                        <li class="mb-2"><strong>Database Setup:</strong> Import your SQL Bible data into your MySQL/MariaDB instance.</li>
                        <li class="mb-2"><strong>Run Web Installer:</strong> Use the built-in web-based installer to configure your database connection and environment variables.</li>
                        <li class="mb-2"><strong>Customize Templates:</strong> Modify the Smarty `.tpl` files to match your ministry or personal branding.</li>
                    </ol>
                </div>
            </div>
        </div>

        <h2 class="mt-5">Developer Support & Contributions</h2>
        <p>As an open-source project, BibleBridge relies on community feedback and contributions. You can help shape the future of the framework in several ways:</p>
        <ul class="square-bullets">
            <li><strong>Dynamic Bookmarking:</strong> Explore and improve our bookmarking logic that integrates passages directly into the user navigation.</li>
            <li><strong>Personal Study Notes:</strong> Help refine the dashboard system where registered users can store reflections and insights.</li>
            <li><strong>Feature Requests:</strong> Submit your ideas for future enhancements via GitHub Issues to help create a better experience for everyone.</li>
        </ul>

        <div class="bg-dark text-white p-5 rounded-3 mt-5 shadow">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h2 class="mb-3">Ready to Build?</h2>
                    <p>BibleBridge is free to use under the MIT License. Visit our GitHub repository to access the full source code, documentation, and community discussions.</p>
                    <a class="btn btn-outline-light btn-lg mt-2" href="https://github.com/ZeroCoolZiemer/bible-bridge" target="_blank">
                        <i class="bi bi-github me-2"></i>Access Source Code
                    </a>
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <h5>Resources</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check2-circle text-success me-2"></i> Technical Setup Guide</li>
                        <li><i class="bi bi-check2-circle text-success me-2"></i> Web-Based Installer</li>
                        <li><i class="bi bi-check2-circle text-success me-2"></i> Community Support via GitHub</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="py-4"></div>

    {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}
</body>

</html>
