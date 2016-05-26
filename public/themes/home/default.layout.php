<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo strip_tags(db_config('title')).$title;?></title>
    <meta name="keywords" content="<?php echo $keywords;?>" />
	<meta name="description" content="<?php echo $description;?>" />
	<meta name="author" content="<?php echo $author;?>" />
	<meta name="date" content="<?php echo $date;?>" />
  <meta name="author" content="samplecms <sunkang@wstaichi.com>">
  
  


  </head>
  <body>
    

     <?php $this->extend('include/sidebar'); ?>
    

     <div class="container">
     <?php  echo $this->view['content'];?>
     </div>
      
 
<div style="clear:both;">
<div id="footer">
  <div class="face_cooper">
    <div class="face_cooper_i"></div>
    <span class="face_cooper_w">培训、交流、学习、合作等  微信：<a href="mailto:ImePOM-stickers@sogou-inc.com">sunkangchina</a></span>
  </div>
  <div class="ftbox">
  <a href="#" target="_blank">网站地图</a> - 
  <a href="#" rel="external nofollow" target="_blank">企业推广</a> - 
  <a href="#" target="_blank">拼音输入法</a> - 
  <a href="#" target="_blank">搜狗浏览器</a> - 
  <a href="#" rel="external nofollow" target="_blank">诚聘英才</a><br>© 
  2016 
  WSTAICHI.COM <a href="#" rel="external nofollow" target="_blank">京ICP证050897号</a> 
  <a href="#" rel="external nofollow" target="_blank">免责声明</a>
    </div>
</div>
 
<!--zly-->

</div>



	<?php widget('jquery',['level'=>99]);?>


  
  <?php 
  
  widget('bootstrap',['level'=>10]);
 
  

  ?>

<link rel="stylesheet" type="text/css" href="<?php echo theme_url('css/style.css');?>">
	 
  <?php echo $this->view['footer'];?>

  <?php widget_render();?>

  </body>
</html>