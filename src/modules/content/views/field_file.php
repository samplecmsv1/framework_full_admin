<div class="form-group">
	    <label><?php echo $label;?></label>
	  	<?php 
	  	widget('jui');
	  	widget('plupload',[
	  			'ele'=>'file',
	  			'option'=>[
		  			//'CKEDITOR'=>$field,
					'maxSize'=>50,
	  				'class'=>'upload',
	  				'count'=>50,
	  				'data'=>$data[$field],
		  		]			
		]);
	  	?>
</div>