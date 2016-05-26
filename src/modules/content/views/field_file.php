<div class="form-group">
	    <label><?php echo $label;?></label>
	  	<?php 
	  	widget('jui');
	  	widget('plupload',[
	  			'ele'=>'file',
	  			'option'=>[
		  			//'CKEDITOR'=>$field,
					'maxSize'=>'30',
	  				'class'=>'upload',
	  				'count'=>100,
	  				'data'=>$data[$field],
		  		]			
		]);
	  	?>
</div>