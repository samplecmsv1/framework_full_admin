<?php 
use data\post;
$this->layout('default');
$post = post::get(['slug'=>'connect']);
?>

<?php $this->start('content');?>
<div class="wrapper container" role="main">
    <article class="post" itemscope="" itemtype="">
        <h1 class="post-title" itemprop="name headline"><?php echo $post['title'];?></h1>
        <div class="post-content" itemprop="articleBody">
            <?php echo $post['body'];?>
 
        </div>
    </article>
   
</div>

<?php $this->end();?>