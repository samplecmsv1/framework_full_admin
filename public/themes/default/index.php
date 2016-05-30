<?php
 use data\post;
$posts = post::get_tag();
$banner = post::get_banner();
 $this->layout('default');
 ?>

<?php  $this->start('content');?>
<div class="wrapper container" role="main">

        <?php foreach($posts as $v){?>
        </article>
            <article class="post">
            <h2 class="post-title" itemprop="name headline">
                <a itemtype="url" href="<?php echo url('home/home/post',['slug'=>$v['slug']]);?>"><?php echo $v['title'];?></a>
            </h2>

            
            <div class="post-meta"> <!-- 文章信息，为了避免产生多余空格，本段代码未缩进 -->
                <span class="post-category"><a href="http://brdev.org/front-end">前端</a></span><time datetime="2015-03-15T00:19:00+08:00" itemprop="datePublished">3月15日</time>
            </div>
        </article>

        <?php }?>
    
    <div class="post-page clearfix">
                                <a class="rss" href="http://brdev.org/feed/" title="订阅RSS"></a>
            </div>
</div>





<?php $this->end();?>
