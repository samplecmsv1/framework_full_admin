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

 
     
     <?php if($list==1){?>
     <table class="table table-bordered">
       
      <thead>
        <tr>
          <th>标题(<?php echo $count;?>)</th>
          <th>时间</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($datas as $data){?>
        <tr>
          <th scope="row"><?php echo strip_tags($data['title']);?></th>
          <td><?php echo date('Y-m-d H',$data['created']->sec);?></td>
          <td >
          
          	<a href="<?php echo url($url.'/status',['id'=>(string)$data['_id']]+$par);?>" class="button">
	         	<?php 
	         		switch ($data['status']){
	         			case 1:
	         				echo '<span class="glyphicon glyphicon-ok"></span>';
	         				break;
	         			default:
	         				echo '<span class="glyphicon glyphicon-remove" style="color:red;"></span>';
	         				break;
	         		}
	         	?> 
	        </a>
	        
	        
          	<a href="<?php echo url($url.'/view',['id'=>(string)$data['_id']]+$par);?>" class="fa fa-pencil">
	          
	        </a>
	        
	        <a href="<?php echo url($url.'/remove',['id'=>(string)$data['_id']]+$par);?>" class="remove fa fa-remove">
	          
	        </a>
	        
	        
          </td>
        </tr>
       <?php }?> 
      </tbody>
    </table>
    <?php echo $page;?>
    <?php }?>
    
   <?php if($view==1){?>
     <form method="POST" class='ajaxform'  enctype="multipart/form-data">
     
     
	  <div class="form-group">
	    <label >标题</label>
	    <input type="input" class="form-control"  value="<?php echo $data['title'];?>" name='title' >
	  </div>
	  
	  <?php foreach($fields as $k=>$v){?>
	  
	  <?php 
	  	$this->extend('field_'.$v['element'],[
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
<?php }?>


 
     

<?php 
 
$this->end();
?>



 
