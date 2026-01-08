<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom d-print-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">BibleBridge</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {if $activePage == 'home'}active{/if}" href="/">
                        <i class="bi bi-house"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {if $activePage == 'about'}active{/if}" href="/about">
                        About
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {if $activePage == 'bible'}active{/if}"
                       href="#" id="bibleDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Bible Versions
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="bibleDropdown">
                        {foreach from=$bibles key=v item=version}
                        <li>
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="/bible/{$v|lower}/old-testament">
                                {$version.name|default:$v|upper}
                                {if $selectedVersion == $v}
                                    <i class="bi bi-check text-primary"></i>
                                {/if}
                            </a>
                        </li>
                        {/foreach}
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link {if $activePage == 'contact'}active{/if}" href="/contact">
                        Contact
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {if $activePage == 'setup'}active{/if}" href="/get-started">
                        Get Started
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="bookmarksDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i style="color:#aa002b;" class="bi bi-bookmark-fill me-1"></i> Bookmarks
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm" id="bookmarksMenu" aria-labelledby="bookmarksDropdown">
                        <li>
                            <a class="dropdown-item disabled text-muted">No bookmarks saved</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
