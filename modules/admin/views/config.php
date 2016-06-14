<?php $this->layout('default');?>



<?php $this->start('content'); ?>




<a href="<?php echo url('admin/config/index'); ?>" class='fa fa-list' ></a>

<small> <a  class='fa fa-plus' href="<?php echo url('admin/config/edit'); ?>"></a></small>

 
<table class="table table-bordered">
      <thead>
        <tr>
          <th><?php echo __('title');?></th>
          <th><?php echo __('date');?></th>
          
        </tr>
      </thead>
      <tbody>
      <?php foreach($datas as $v){ ?>
        <tr>
          <th scope="row">
          	
          	<a href="<?php echo url('admin/config/edit',['id'=>(string)$v['_id']]+$_GET); ?>" >

          		<?php echo $v['title']; ?> 
				
			</a>

          </th>
          <td>
          	
          	<?php echo date('Y-m-d',$v['created']->sec); ?>

          </td>
          
        </tr>
        <?php }?>
      </tbody>
    </table>

  
<?php echo $pager;?>
    

    


<?php $this->end();?>