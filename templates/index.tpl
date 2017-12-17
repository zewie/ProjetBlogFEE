<div class="container">

<div class="container">
        {if (isset($_SESSION['notification_connexion']))}
        <div class="alert alert-{$connexion_result} alert-dismissible fade show col-md-6" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
            {$_SESSION['notification_connexion']}
            </strong>
        </div>
        {/if}
</div>

<!-- Page Content -->





<div class="form-group">
  
        <form class="form -inline my-lg-0 "method="GET" action="index.php">
        <input type="text" placeholder="Texte" name="recherche" id="recherche" class="form-control input-lg" >
      
   
            <button type="submit" class="btn btn-inverse">Rechercher</button>
           
             </form>
    
</div>

  {if !isset($smarty.get.recherche)} 
    <div class="container col-md-6">

    {foreach from=$tab_articles item=$value}
    <div class="card">
        <img class="card-img-top" src="img/{$value['id']}.png" alt="">
        <div class="card-body">
            <h4 class="card-title">{$value['titre']} </h4>
            <p class="card-title">{$value['texte']} </p>
            <br>
            {$value['date_fr']}
            <a href="articles.php?action=modifier&id={$value['id']}" class="btn btn-primary" name="modifier">Modifier</a>
            
            <a href="sup.php?action=supprimer&id={$value['id']}" class="btn btn-primary" name="delete">supprimer</a>
            
    </div> 
</div>
    {/foreach}
        {else} 
            
            
            
             {foreach from=$tab_articles_recherche item=$value}
    <div class="card">
        <img class="card-img-top" src="img/{$value['id']}.png" alt="">
        <div class="card-body">
            <h4 class="card-title">{$value['titre']} </h4>
            <p class="card-title">{$value['texte']} </p>
            <br>
            {$value['date_fr']}
            <a href="articles.php?action=modifier&id={$value['id']}" class="btn btn-primary" name="modifier">Modifier</a>
            
            <a href="sup.php?action=supprimer&id={$value['id']}" class="btn btn-primary" name="delete">supprimer</a>
            
    </div> 
</div>
    {/foreach}
    
    {/if}
<nav aria-label="Page navigation example">
  <ul class="pagination">
      
            {for $i=1 to $nb_pages}

          <li class="page-item {if $page_courante == $i}active{/if}">
            <a class="page-link" href="?page={$i}">{$i}</a>
                </li>
                {/for}
                
  </ul>
</nav>
    </div>
</div>
                
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

