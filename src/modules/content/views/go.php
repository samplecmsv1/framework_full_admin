<?php 
$this->layout('default');
$url = 'content/admin';
?>
<?php 

$this->start('content');
 

?>
 




 <ul class="list-group">
 <?php foreach($posts as $v){?>
  <li class="list-group-item">
  	<a href="<?php echo url('content/admin/index',['q'=>$v['key']]);?>">
  		<?php echo $v['title'];?>
  	</a>
  	</li>
 <?php }?>
 </ul>


     

<?php 
 
$this->end();
?>



 
