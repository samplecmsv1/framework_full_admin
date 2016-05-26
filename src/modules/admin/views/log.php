<?php 
$this->layout('default');
$url = 'admin/config';
?>
<?php 

$this->start('content');

$par = ['s'=>$_GET['s']];

?>


<ul class="list-group">
  <?php foreach($datas as $data){
      $str = htmlspecialchars($data);
          $str = str_replace('[System]',"<span class='btn btn-info'>[System]</span><br>",$str);
          $str = str_replace('.log'.htmlspecialchars('</h3>'),".log<hr>",$str);
          $str = str_replace(htmlspecialchars('<h3>'),"",$str);
      if(!$str){
        continue;
      }
        ?>
         <li class="list-group-item">
          <?php 
          echo $str;
          ?>
            
          </li>
          
       <?php }?> 

</ul>
 
<?php echo $page['link'];?>
  

 
<?php 

$this->end();
?>



 
