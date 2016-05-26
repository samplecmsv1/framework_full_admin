<?php $this->layout('default');?>



<?php $this->start('content'); ?>


<div class="row">
      
      <div class="col-sm-6 col-md-8">

      		<div class="main_title">
                <h2>汤祯兆 | “素人”原来没有那么“色”</h2>
            </div>

            
        <div class="thumbnail">
          <div class="caption">
            <span class='icon1'><?php echo date('Y-m-d H',$post['created']->sec); ?></span>
            <h4><?php echo $post['title']; ?></h4>
          </div>

          <?php echo $post['body']; ?>
          
        </div>
      </div>

      <div class="col-sm-6 col-md-4">
ddd
      </div>
      
</div>

 
 
    


<?php $this->end();?>