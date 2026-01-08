<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About BibleBridge - Open Source Scripture Integration</title>
    <meta name="description" content="An open-source project providing technical tools for Bible integration and ministry content management.">
    <link rel="stylesheet" href="/css/custom.css">
    {include file="bootstrap-head.tpl"}
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
</head>

<body class="body-text">
    {include file="menu.tpl"}
    
    <div class="container mt-4 px-4">
        <h1 class="text-center">About the BibleBridge Project</h1>
        
        <p class="mt-4 text-center">
            BibleBridge is an <strong>open-source technical framework</strong> designed to help developers and ministries build custom Bible study interfaces. 
            By leveraging modern web technologies like Bootstrap 5 and the Smarty Template Engine, we provide a flexible codebase for managing 
            scripture and community resources.
        </p>

        <h2 class="mt-5">Technical Architecture</h2>
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="card text-dark h-100 border-1 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Extensible UI <i class="bi bi-bootstrap-fill ms-1" style="color:#6f42c1"></i></h5>
                        <p class="card-text">Built on <strong>Bootstrap 5</strong>, making it fully responsive and easy for any developer to theme or modify to fit their unique vision.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-dark h-100 border-1 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Database Integration <i class="bi bi-database ms-1" style="color:#0d6efd"></i></h5>
                        <p class="card-text">Connect your own database seamlessly. Includes breadcrumb navigation and optimized queries for efficient scripture retrieval and search.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card text-dark h-100 border-1 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Smarty Templating <i class="bi bi-file-code ms-1" style="color:#f8961e"></i></h5>
                        <p class="card-text">Utilizes the <strong>Smarty Template Engine</strong> to keep logic separate from presentation, ensuring clean and maintainable code.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-dark text-white p-5 rounded-3 mt-5 shadow">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h2 class="mb-3">Open Source & Community</h2>
                    <p>BibleBridge is a community-driven project. Our source code is hosted on GitHub for anyone to audit, improve, or fork. We believe in providing transparent, free tools for the global community.</p>
                    <a class="btn btn-outline-light btn-lg mt-2" href="https://github.com/ZeroCoolZiemer/bible-bridge" target="_blank">
                        <i class="bi bi-github me-2"></i>View Source on GitHub
                    </a>
                </div>
                <div class="col-md-5 mt-4 mt-md-0">
                    <h5>Built With</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check2-circle text-success me-2"></i> Bootstrap 5</li>
                        <li><i class="bi bi-check2-circle text-success me-2"></i> Smarty Template Engine</li>
                        <li><i class="bi bi-check2-circle text-success me-2"></i> jQuery</li>
                        <li><i class="bi bi-check2-circle text-success me-2"></i> Open Source SQL Support</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <div class="py-4"></div> {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {include file="analytics.tpl"}
    {include file="bookmark.tpl"}
</body>

</html>
