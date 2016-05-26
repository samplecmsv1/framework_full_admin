<?php  $this->layout('default');

use data\post;
$posts = post::get_tag();
$banner = post::get_banner();


?>



<?php $this->start('content'); 



?>
 
    
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php
        $q = $banner->count();
        for($i=0;$i<$q;$i++){
        ?>
        <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i;?>" <?php if($i==0){?>class="active"<?php }?>></li>
       <?php }?>
      </ol>
      <div class="carousel-inner" role="listbox">
      <?php $i=0; foreach($banner as $v){
        $url = $v['file'][0];
        ?>
        <div class="item <?php if($i==0){?>active<?php }?>">
          <img style="height:300px;" src="<?php echo host().$url;?>" data-holder-rendered="true">
        </div>
      <?php $i++;}?>
      </div>
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">上一页</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">下一页</span>
      </a>
    </div>


<div class="page-header">
  <h1 class='hot'>推荐阅读 <small>最新消息</small></h1>
</div>

<div class="row">
      <?php
      foreach ($posts as  $v) {
        $url = $v['file'][0];
      
      ?>
      <div class="col-sm-6 col-md-3">

        <div class="thumbnail">
          <div class="caption">
            <span class='icon1'><?php echo $v['tag'];?></span>
            <a href="/post/<?php echo $v['slug'];?>"<h4><?php echo $v['title'];?></h4></a>
          </div>

          <img data-src="holder.js/100%x200" alt="100%x200" src="<?php echo host().$url;?>" data-holder-rendered="true" style="height: 200px; width: 100%; display: block;">
          
        </div>
      </div>
      <?php }?>
</div>

 



    
  
   
    


<?php $this->end();?>