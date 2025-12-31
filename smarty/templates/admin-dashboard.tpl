<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Holy Bible Articles</title> {include file="bootstrap-head.tpl"} {include file="fonts.tpl"} {include file="favicon.tpl"}
  </head>
  <body class="body-text dashboard"> {include file="menu.tpl"} <div class="container mt-4">
      <div class="row">
        <div class="col-md-4 mb-4 mx-auto">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-center">Welcome, <span class="text-danger">{$smarty.session.username}</span>! </h5>
              <p class="card-text text-primary text-center">{if $smarty.session.role === 'demo'}You are logged into a <i>demo account</i>. Some features are <i>limited</i>.{else}You are logged in.{/if} </p>
              <p class="card-text text-center">Here are your latest articles:</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row"> {foreach from=$articles item=article} <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{$article.title}</h5>
              <p class="card-text">{$article.content|strip_tags|truncate:150}</p>
              <a href="/edit-article.php?id={$article.id}" class="btn btn-primary me-2">Edit</a>
              <button type="button" class="btn btn-danger" onclick="confirmDelete({$article.id})">Delete</button>
            </div>
          </div>
        </div> {/foreach} </div> {if $total_pages > 1} <div class="pagination-container">
        <nav>
          <ul class="pagination justify-content-center"> {if $current_page > 1} <li class="page-item">
              <a class="page-link" href="/admin-dashboard{if $current_page > 2}/{$current_page-1}{/if}">Previous</a>
            </li> {/if} <li class="page-item disabled">
              <span class="page-link">Page {$current_page} of {$total_pages}</span>
            </li> {if $current_page < $total_pages} <li class="page-item">
              <a class="page-link" href="/admin-dashboard/{$current_page+1}">Next</a>
              </li> {/if} </ul>
        </nav>
      </div> {/if} <div class="d-flex justify-content-center mt-4 mb-5">
        <a href="/create-article" class="btn btn-success">Create New Article</a>
      </div>
    </div> {include file="footer.tpl"} <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/confirm-delete.js"></script> {include file="bookmark.tpl"}
  </body>
</html>