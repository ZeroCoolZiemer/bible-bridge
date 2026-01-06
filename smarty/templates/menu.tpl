<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom d-print-none">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">BibleBridge</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link {if $activePage == 'home'}active{/if}" href="/"><i class="bi bi-house"></i></a></li>
                <li class="nav-item"><a class="nav-link {if $activePage == 'about'}active{/if}" href="/about">About</a></li>
		<li class="nav-item dropdown">
    			<a class="nav-link dropdown-toggle {if $activePage == 'bible'}active{/if}" href="#" data-bs-toggle="dropdown">
        		Bible Versions
    			</a>
			<ul class="dropdown-menu">
    				{foreach from=$bibles key=v item=version}
        				<li class="nav-item">
            					<a class="dropdown-item" href="/bible/{$v|lower}/old-testament">
                				{$version.name|default:$v|lower}
						{if $selectedVersion == $v} <i class="bi bi-check"></i>{/if}
            					</a>
        				</li>
    				{/foreach}
			</ul>
		</li>            
                <li class="nav-item"><a class="nav-link {if $activePage == 'articles'}active{/if}" href="/articles">Articles</a></li>
                <li class="nav-item"><a class="nav-link {if $activePage == 'contact'}active{/if}" href="/contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link {if $activePage == 'setup'}active{/if}" href="/get-started">Get Started</a></li>
                {if isset($smarty.session.user)}
                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle {if $activePage == 'admin'}active{/if}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
			{if $smarty.session.role == 'admin' || $smarty.session.role == 'demo'}Admin{else}User{/if}</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        {if $smarty.session.role == 'admin' || $smarty.session.role == 'demo'}
                        <li><a class="dropdown-item" href="/user-dashboard">User Dashboard</a></li>
			<li><a class="dropdown-item" href="/admin-dashboard">Admin Dashboard</a></li>
			{else}
			<li><a class="dropdown-item" href="/user-dashboard">Dashboard</a></li>
			{/if}
                        {if $smarty.session.role != "user"}
			<li><a class="dropdown-item" href="/create-article">Create Article</a></li>
                        {/if}
			<li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
                {else}
                <li class="nav-item"><a class="nav-link {if $activePage == 'login'}active{/if}" href="/login">Login</a></li>
                {/if}
		<li class="nav-item dropdown">
    			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Bookmarks</a>
    			<ul class="dropdown-menu" id="bookmarksMenu">
        			<li><a class="dropdown-item">No bookmarks saved</a></li>
    			</ul>
		</li>
            </ul>
        </div>
    </div>
</nav>