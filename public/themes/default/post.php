<?php $this->layout('default');?>

<?php $this->start('content');?>
<div class="wrapper container" role="main">
    <article class="post" itemscope="" itemtype="">
        <h1 class="post-title" itemprop="name headline"><?php echo $post['title'];?></h1>
        <div class="post-meta"> 
            <span class="post-category"></span>
            <time datetime="<?php echo date('Y-m-d H',$post['created']->sec); ?>" itemprop="datePublished">
             <?php echo date('Y-m-d H',$post['created']->sec); ?>
                
            </time>
        </div>
        <div class="post-content" itemprop="articleBody">
            <?php echo $post['body']; ?>
        </div>
    </article>
    
 
    
    
        
</div>

<?php $this->end();?>