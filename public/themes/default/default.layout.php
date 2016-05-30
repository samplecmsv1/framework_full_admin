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
   <div class="main">
        <header id="header">
            <div class="wrapper">
                <nav id="nav" role="navigation">

                <?php 
    $menu = [
      'HOME'=>'home/home/index',
      'CLASSES'=>'home/home/classes',
      'WU STYLE TAICHI'=>'home/home/taichi',
      'CONNECT'=>'home/home/connect',
      'LEARN AT FRANCE & UK'=>'home/home/learn',
    ];
    $arr = url_array();
    $current = $arr['module'].'/'.$arr['controller'].'/'.$arr['action'];
    foreach ($menu as $k=>$v){
    ?>
      <a   <?php if(strpos($v,$current)!==false){echo "class='current'";} ?> 
        href="<?php echo url($v);?>"><?php echo __($k);?></a> 
    
    <?php }?>


                 
            </div>

            <h1 class="title">
                <?php echo db_config('title');?>               
                 <div id="toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </h1>
        </header>



     

     
     <?php  echo $this->view['content'];?>
     
      
 <footer class="footer wrapper center">
        &copy; 2016 <b> </b>. All rights reserved.  
    </footer>
    <div class="btm-search">
        <form class="search" method="post" action="/" role="search">
            <input type="search" name="s" autocomplete="off">
        </form>
    </div>
</div>


<?php $this->extend('sidebar');?>



	<?php widget('jquery',['level'=>99]);?>


  
  <?php 
  
  widget('bootstrap',['level'=>10]);
 
  

  ?>
<?php widget_render();?>
<link rel="stylesheet" type="text/css" href="<?php echo theme_url('style.css');?>">
	 
  <?php echo $this->view['footer'];?>

  

  </body>
</html>