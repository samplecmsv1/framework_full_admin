<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo strip_tags(db_config('title')).$title;?></title>
    <meta name="keywords" content="<?php echo $keywords;?>" />
	<meta name="description" content="<?php echo $description;?>" />
	<meta name="author" content="<?php echo $author;?>" />
	<meta name="date" content="<?php echo $date;?>" />
  
  


  </head>
  <body>
    

     <?php $this->extend('include/sidebar'); ?>
    

     <div class="container">
     <?php  echo $this->view['content'];?>
     </div>
      
 


	<?php widget('jquery',['level'=>99]);?>


  
  <?php 
  
  widget('bootstrap',['level'=>10]);
   
  

  ?>


	 
  <?php echo $this->view['footer'];?>

  <?php widget_render();?>

  </body>
</html>