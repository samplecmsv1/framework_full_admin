<?php $this->layout('default');?>



<?php $this->start('content'); ?>
 <div class="container content">
    <h1><?php echo $post['title']; ?></h1>


<div class="date">
  <?php echo my_date($post); ?>
</div>

 

  <?php echo $post['body']; ?>


 </div>
    


<?php $this->end();?>