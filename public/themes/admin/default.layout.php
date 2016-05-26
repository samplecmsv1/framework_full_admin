<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title><?php echo strip_tags(db_config('admin_title'));?></title>
    <meta name="keywords" content="<?php echo $keywords;?>" />
	<meta name="description" content="<?php echo $description;?>" />
	<meta name="date" content="<?php echo $date;?>" />
  <meta name="author" content="samplecms <sunkang@wstaichi.com>">
    

     <!-- Icons -->
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo theme_url('apple-touch-icon-144-precomposed.png');?>">
  <link rel="shortcut icon" href="<?php echo theme_url('favicon.ico');?>">

   


  </head>
  <body>
    
	<?php if(has_flash('success')){?>
	<p class='flash container alert alert-success'>
    
     <?php echo flash('success');?>
    
  </p>
	<?php }?>
     <?php $this->extend('include/sidebar'); ?>
    

     <div class="container">
   	 <?php  echo $this->view['content'];?>
     </div>
      
    
 

  <?php $this->extend('include/modal'); ?>

	<?php widget('jquery',['level'=>99]);?>
  <?php widget('ajax_form',['level'=>2]);?>
	<?php 
  
  widget('bootstrap',['level'=>10]);
  widget('font_awesome',['level'=>11]);
  widget('select2');
  

  ?>
  <?php echo $this->view['footer'];?>

  <?php widget_render();?>

 

<link rel="stylesheet" href="<?php echo theme_url('css/style.css');?>">
<link rel="stylesheet" href="<?php echo base_url().'misc/animate.css';?>">

  
  <script type="text/javascript" src="<?php echo theme_url();?>/home.js"></script>

  </body>
</html>