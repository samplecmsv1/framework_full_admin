<?php $this->layout('default');?>



<?php $this->start('content'); ?>

<a href="<?php echo url('admin/config/index'); ?>" class='fa fa-list' ></a>

<small> <a  class='fa fa-plus' href="<?php echo url('admin/config/edit'); ?>"></a></small>

<span class="label label-default">
<?php   if(!$output['_id']){ echo __('Add');} else{echo __('Edit');}?>
</span>





		    <?php if($error){
		    		 
		    			echo $error;
		    		

		    } ?>
			
			<form action="" method="post">
				<div class="form-group">
					<label><?php echo __('title');?></label>
					<input type='text' class='form-control'  name='title'
					 	 placeholder="<?php echo __('title');?>" value="<?php echo $_POST['title']?:$output['title'];?>">
					</div>
				<div class="form-group">
					<label><?php echo __('body');?></label>
		 			<textarea  id='body' name='body' class='form-control'  >
		 				<?php echo $_POST['body']?:$output['body'];?>
		 			</textarea>

		 			<?php widget('redactor',['ele'=>'#body']);?>
				</div>
				<div class="form-group">
					<input  type='submit' class='btn btn-default'  value="<?php echo __('Save');?>">
				</div>
			</form>
			
			 
 
    


<?php $this->end();?>