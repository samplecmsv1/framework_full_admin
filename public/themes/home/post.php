<?php $this->layout('default');?>



<?php $this->start('content'); ?>


<div class="row">
      
      <div class="col-sm-6 col-md-8">

      		<div class="main_title">
                <h2><?php echo $post['title'];?></h2>
            </div>

            <div class="titBar">
                          <span class="author"> <?php echo $post['auth']?:'转载';?></span>
                         <span class="add_time"><?php echo date('Y-m-d H',$post['created']->sec); ?></span>
            </div>


            
        <div class="txtMain">
           

          <?php echo $post['body']; ?>
          
        </div>
      </div>

      <div class="col-sm-6 col-md-4">
ddd
      </div>
      
</div>

 
 
    


<?php $this->end();?>