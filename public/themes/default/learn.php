<?php  
use data\link;
$this->layout('default');
 


?>



<?php $this->start('content'); 

 
?>
 
  


    
  
   <div class="wrapper container" role="main">
    <article class="post no-line" itemscope="" itemtype="">
        <h1 class="post-title" itemprop="name headline"><?php echo __('RECETENY ARTICLES');?></h1>
        <div class="post-content" itemprop="articleBody">
            <h3><?php echo __('OUR TEAM');?></h3>
            <ul class="links fav-list">

            <?php foreach($posts as $v){?>
            <li><a href="<?php echo url('home/home/post',['slug'=>$v['slug']]);?>" ><?php echo __('Read');?></a>
                
                    <div link="<?php echo url('home/home/post',['slug'=>$v['slug']]);?>" class="link-des"><?php echo $v['title'];?></div>
            

            </li>
            <?php }?>
            </ul>
            <h3><?php echo __('WU STYLE TAICHI AROUND WORLD');?></h3>
            <ul class="links site-list clearfix">
            <?php 
                $all = link::get_all([]);
                foreach($all as $v){
            ?>
                <li><a href="<?php echo $v['url'];?>" title="" target="_blank"><?php echo $v['title'];?></a></li>
            <?php }?>
            </ul>
        </div>
    </article>
</div>


    


<?php $this->end();?>