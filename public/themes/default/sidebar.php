<?php
use data\link;
use data\post;
?>

<div class="sidebar">
        <div class="widget center">
            <i class="logo"></i>
            <span class="name"><?php echo db_config('name');?></span>
        </div>
        <div class="social">
            <div class="center">
                <a href="https://github.com/samplecms/samplecms" target="_blank" title="GitHub"></a>
                <a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&amp;email=sunkang@wstaichi.com" target="_blank" title="Mail"></a>
                <a href="http://weibo.com/sunkangchina" target="_blank" title="Weibo"></a>
            </div>
        </div>
        <div class="widget">
            <h3 class="widget-title"><?php echo __('NEWS');?></h3>
            <ul class="widget-list article-list">
            <?php
                $all = post::get_all(['tag'=>'news']);
                foreach($all as $v){
            ?>
                <li><a href="<?php echo url('home/home/post',['slug'=>$v['slug']]);?>"><?php echo $v['title'];?></a></li>
            <?php }?>
            </ul>
        </div>
        <div class="widget">
            <h3 class="widget-title"><?php echo __('FRIEND LINKS');?></h3>
            <ul class="widget-list">

            <?php 
                $all = link::get_all([]);
                foreach($all as $v){
            ?>
                <li><a href="<?php echo $v['url'];?>" title="" target="_blank"><?php echo $v['title'];?></a></li>
            <?php }?>
                            
                        </ul>
        </div>
        <div class="widget">
            <form class="search" method="post" action="/" role="search">
                <input type="search" name="s" autocomplete="off">
            </form>
        </div>
    </div>