<?php 
$this->layout('default');
use models\menu;
if($datas){
	foreach($datas as $v){
		$new[] = $v;
	}
	$datas = menu::tableTree($new);
}
?>
<?php 

$this->start('content');

$par = ['s'=>$_GET['s']];

?>

 <a href="<?php echo url('admin/menu/index'); ?>" class='fa fa-list' ></a>

<small> <a  class='fa fa-plus' href="<?php echo url('admin/menu/view'); ?>"></a></small>

<span class="label label-default">
<?php   if(!$data['_id']){ echo __('Add');} else{echo __('Edit');}?>
</span>
     <?php if($list==1){?>
     <table class="table table-bordered">
      <caption>管理菜单(<?php echo $count;?>). 
      	 
	  </caption>
      <thead>
        <tr>
          <th>菜单名</th>
          <th>时间</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      <?php if($datas){foreach($datas as $data){ ?>
        <tr>
          <th scope="row"><?php echo strip_tags($data['title']);?> [<?php echo strip_tags($data['slug']);?>]</th>
          <td><?php echo date('Y-m-d H',$data['created']->sec);?></td>
          <td >
          
          	<a href="<?php echo url('admin/menu/status',['id'=>(string)$data['_id']]+$par);?>" class="button">
	         	<?php 
	         		switch ($data['status']){
	         			case 1:
	         				echo '<span class="fa fa-check"></span>';
	         				break;
	         			default:
	         				echo '<span class="fa fa-close" style="color:red;"></span>';
	         				break;
	         		}
	         	?> 
	        </a>
	        
	        
          	<a href="<?php echo url('admin/menu/view',['id'=>(string)$data['_id']]);?>" class="fa fa-pencil">
	          
	        </a>
	        
	        <a href="<?php echo url('admin/menu/remove',['id'=>(string)$data['_id']]);?>" class="remove fa fa-remove">
	          
	        </a>
	        
	        
          </td>
        </tr>
       <?php }}?> 
      </tbody>
    </table>
    <?php echo $page;?>
    <?php }?>
    
   <?php if($view==1){?>
     <form method="POST" class='ajaxform'  enctype="multipart/form-data">
	  <div class="form-group">
	    <label >菜单名</label>
	    <input type="input" class="form-control"  value="<?php echo $data['title'];?>" name='title' >
	  </div>
	  <div class="form-group">
	    <label >唯一标识</label>
	    <input type="input" class="form-control"  value="<?php echo $data['slug'];?>" name='slug' >
	  </div>
	  <div class="form-group">
	    <label>分类</label>
		<p>
		    <select name='pid' class="form-control select">
		    	<?php echo $category;?>
		    </select>
	    </p>
	  </div>
	 	  <div class="form-group">
	    <label>状态</label>
	    
	    <?php $status = [
	    	1=>'启用',
	    	0=>'禁用',
	    ];?>
	    <p>
	    <select name="status" class="select" style='width:100px;'>
	    <?php 
	    $true = false;
	    foreach($status as $k=>$v){?>
	    	<option value=<?php echo $k;?> <?php if($true===false && ($data['status']==$k || !$_GET['id']) ) { $true = true;?>selected<?php }?> >
	    		<?php echo $v;?>
	    	</option>
	    <?php }?>
	    </select>
	    </p>
	  </div>
	   
	  <button type="submit" id='submit' class="btn btn-success">保存</button>
	</form>
<?php }?>


 
     

<?php 

$this->end();
?>



 
