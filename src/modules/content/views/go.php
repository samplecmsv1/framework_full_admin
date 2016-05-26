<?php 
$this->layout('default');
$url = 'content/admin';
?>
<?php 

$this->start('content');
 

?>


 <div class="page-header">
  <h1 class='hot'><?php echo __('Content Type'); ?></h1>
</div>

<div class="row">
      <?php foreach($posts as $v){?>
        <div class="col-sm-6 col-md-2">

        <div class="thumbnail">
        
          <div class="caption">
          	<a href="<?php echo url('content/admin/view',['q'=>$v['key']]);?>">
            <span class='icon1'><?php echo __('Add');?></span>
            </a>
            <h4>
            <a href="<?php echo url('content/admin/index',['q'=>$v['key']]);?>">
            	<?php echo $v['title'];?>
            </a>
            </h4>
          </div>
        
          <img   src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTkyIiBoZWlnaHQ9IjIwMCIgdmlld0JveD0iMCAwIDE5MiAyMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzEwMCV4MjAwCkNyZWF0ZWQgd2l0aCBIb2xkZXIuanMgMi42LjAuCkxlYXJuIG1vcmUgYXQgaHR0cDovL2hvbGRlcmpzLmNvbQooYykgMjAxMi0yMDE1IEl2YW4gTWFsb3BpbnNreSAtIGh0dHA6Ly9pbXNreS5jbwotLT48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWyNob2xkZXJfMTU0ZWQ2OTg5YzQgdGV4dCB7IGZpbGw6I0FBQUFBQTtmb250LXdlaWdodDpib2xkO2ZvbnQtZmFtaWx5OkFyaWFsLCBIZWx2ZXRpY2EsIE9wZW4gU2Fucywgc2Fucy1zZXJpZiwgbW9ub3NwYWNlO2ZvbnQtc2l6ZToxMHB0IH0gXV0+PC9zdHlsZT48L2RlZnM+PGcgaWQ9ImhvbGRlcl8xNTRlZDY5ODljNCI+PHJlY3Qgd2lkdGg9IjE5MiIgaGVpZ2h0PSIyMDAiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSI3MC4wNTQ2ODc1IiB5PSIxMDQuNSI+MTkyeDIwMDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="height: 100px; width: 100%; display: block;">
          
        </div>
      </div>
      <?php }?>
</div>

 


     

<?php 
 
$this->end();
?>



 
