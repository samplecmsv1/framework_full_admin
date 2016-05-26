<?php $this->layout('default');?>



<?php $this->start('content'); ?>


<a href="<?php echo url('admin/lang/index'); ?>" class='fa fa-list' ></a>



<a  class='fa fa-plus' href="<?php echo url('admin/lang/edit'); ?>"></a>
	




<span class="label label-default">
<?php   if(!$output['_id']){ echo __('Add');} else{echo __('Edit');}?>
</span> 
		    <?php if($error){
		    		 
		    			echo $error;
		    		

		    } ?>
			
			<form action="" method="post">

			<div class="form-group">
			    	<label><?php echo __('title');?></label>
			    	<input type='text' class='form-control' name='title'
				 	 placeholder="<?php echo __('title');?>" 
				 	 value="<?php echo $_POST['title']?:$output['title'];?>">
 
			</div>

			<div class="form-group">
			    	<label><?php echo __('Lang');?></label>
			    	<select name='lang' class='select ' style='width:160px;'>
		 			<?php 
		 			$lang =  config('app.langs');
		 			foreach($lang as $k=>$v){
		 			?>
		 				<option value="<?php echo $k;?>" 
		 					<?php if($output['lang']==$k){echo "selected='selected'";}?>>
		 				
		 				<?php echo $v;?></option>
		 			<?php }?>
		 			</select>
		 			
 
			</div>

			<div class="form-group">
			    	<label><?php echo __('body');?></label>
			    	<input type='text' class='form-control' name='body'
				 	 placeholder="<?php echo __('body');?>" 
				 	 value="<?php echo $_POST['body']?:$output['body'];?>">
 
			</div>

				
	
				
	 			
	 			
	 			
				 	  
	
				<div class="form-group">
					<input  type='submit' class='btn btn-default' value="<?php echo __('Save');?>">
				</div>
			</form>
			
			 

 
    


<?php $this->end();?>