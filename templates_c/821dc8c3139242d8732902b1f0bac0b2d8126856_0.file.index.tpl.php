<?php
/* Smarty version 3.1.30, created on 2017-12-13 14:58:09
  from "E:\UwAmp\www\ProjetBlog\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a314001bcff55_28865547',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '821dc8c3139242d8732902b1f0bac0b2d8126856' => 
    array (
      0 => 'E:\\UwAmp\\www\\ProjetBlog\\templates\\index.tpl',
      1 => 1513177024,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a314001bcff55_28865547 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">

<div class="container">
        <?php if ((isset($_smarty_tpl->tpl_vars['_SESSION']->value['notification_connexion']))) {?>
        <div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['connexion_result']->value;?>
 alert-dismissible fade show col-md-6" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>
            <?php echo $_smarty_tpl->tpl_vars['_SESSION']->value['notification_connexion'];?>

            </strong>
        </div>
        <?php }?>
</div>

<!-- Page Content -->





<div class="form-group">
  
        <form class="form -inline my-lg-0 "method="GET" action="index.php">
        <input type="text" placeholder="Texte" name="recherche" id="recherche" class="form-control input-lg" >
      
   
            <button type="submit" class="btn btn-inverse">Rechercher</button>
           
             </form>
    
</div>

  <?php if (!isset($_GET['recherche'])) {?> 
    <div class="container col-md-6">

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab_articles']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
    <div class="card">
        <img class="card-img-top" src="img/<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
.png" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $_smarty_tpl->tpl_vars['value']->value['titre'];?>
 </h4>
            <p class="card-title"><?php echo $_smarty_tpl->tpl_vars['value']->value['texte'];?>
 </p>
            <br>
            <?php echo $_smarty_tpl->tpl_vars['value']->value['date_fr'];?>

            <a href="articles.php?action=modifier&id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-primary" name="modifier">Modifier</a>
            
            <a href="sup.php?action=supprimer&id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-primary" name="delete">supprimer</a>
            
    </div> 
</div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <?php } else { ?> 
            
            
            
             <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tab_articles_recherche']->value, 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
    <div class="card">
        <img class="card-img-top" src="img/<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
.png" alt="">
        <div class="card-body">
            <h4 class="card-title"><?php echo $_smarty_tpl->tpl_vars['value']->value['titre'];?>
 </h4>
            <p class="card-title"><?php echo $_smarty_tpl->tpl_vars['value']->value['texte'];?>
 </p>
            <br>
            <?php echo $_smarty_tpl->tpl_vars['value']->value['date_fr'];?>

            <a href="articles.php?action=modifier&id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-primary" name="modifier">Modifier</a>
            
            <a href="sup.php?action=supprimer&id=<?php echo $_smarty_tpl->tpl_vars['value']->value['id'];?>
" class="btn btn-primary" name="delete">supprimer</a>
            
    </div> 
</div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    
    <?php }?>
<nav aria-label="Page navigation example">
  <ul class="pagination">
      
            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? $_smarty_tpl->tpl_vars['nb_pages']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['nb_pages']->value)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration == 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration == $_smarty_tpl->tpl_vars['i']->total;?>

          <li class="page-item <?php if ($_smarty_tpl->tpl_vars['page_courante']->value == $_smarty_tpl->tpl_vars['i']->value) {?>active<?php }?>">
            <a class="page-link" href="?page=<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</a>
                </li>
                <?php }
}
?>

                
  </ul>
</nav>
    </div>
</div>
                
<!-- Bootstrap core JavaScript -->
<?php echo '<script'; ?>
 src="vendor/jquery/jquery.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="vendor/popper/popper.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="vendor/bootstrap/js/bootstrap.min.js"><?php echo '</script'; ?>
>

<?php }
}
