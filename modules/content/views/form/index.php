<?php 
$this->layout('default');
$url = 'content/admin';
?>
<?php 

$this->start('content');

$par = ['s'=>$_GET['s'],'q'=>$_GET['q']];

?>

<a href="<?php echo url($url.'/index',$par);?>" class='fa fa-list' > </a>

<small> <a  class='fa fa-plus' href="<?php echo url($url.'/view',$par);?>">  </a></small>


<span class="label label-default">
<?php echo $type;?>
</span>

 
     
     <form method="POST" class='ajaxform'  enctype="multipart/form-data">
     
     
	  <div class="form-group">
	    <label >标题</label>
	    <input type="input" class="form-control"  value="<?php echo $data['title'];?>" name='title' >
	  </div>
	  
	  <?php foreach($fields as $k=>$v){?>
	  
	  <?php 
	  	$this->extend('/../fields/'.$v['element'],[
	  		'label'=>$v['label'],	
	  		'field'=>$k,
	  		'data'=>$data,
	  	]);
	  ?>
	  
	  <?php }?>
	  
	  
	 
	  <div class="form-group">
	    <label>状态</label>
	    
	    <?php $status = [
	    	1=>'启用',
	    	0=>'禁用',
	    ];?>
	  
	    <select name="status" class="select" style="width:100px;">
	    <?php 
	    $true = false;
	    foreach($status as $k=>$v){?>
	    	<option value=<?php echo $k;?> <?php if($true===false && ($data['status']==$k || !$_GET['id']) ) { $true = true;?>selected<?php }?> >
	    		<?php echo $v;?>
	    	</option>
	    <?php }?>
	    </select>
	    
	  </div>
	  <div class="form-group">
	  	<button type="submit" id='submit' class="btn btn-default"><?php echo __('Save');?></button>
	  </div>
	</form>
 


 
     

<?php 
 
$this->end();
?>



 
