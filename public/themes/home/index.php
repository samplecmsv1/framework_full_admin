<?php 
use data\post;
$dates = post::get_group_by_date();
$this->layout('default');

?>



<?php $this->start('content'); 



?>
 
    
      <?php foreach($dates as $v){ 
            $date = $v['_id']['y'].'-'.$v['_id']['m'];
            $all = post::get_data_by_date($date);

      ?>
        <h3><?php echo $date;?></h3>
        
        <?php foreach($all as $post){?>
        <li>
          <a href="/post/<?php echo $post['slug'];?>">
            <div>
              <span class="title"><?php echo $post['title'];?></span>
              <span class="date"><?php echo my_date($post);?></span>
            </div>
          </a>
        </li>
        <?php }?>
      <?php }?>
    
  
   
    


<?php $this->end();?>