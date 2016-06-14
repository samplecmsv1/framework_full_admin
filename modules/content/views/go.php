<?php 
$this->layout('default');
$url = 'content/admin';
?>
<?php 

$this->start('content');
 

$th = [
'sky', 'vine',  'gray', 'industrial', 'social'
];

?>


 <div class="page-header">
  <h1 class='hot'><?php echo __('Content Type'); ?></h1>
</div>

<div class="list row">
      <?php $i=0; foreach($posts as $v){?>
        <div class="col-sm-6 col-md-2">

          <div class="thumbnail">
          
            
            	<a class='fa fa-plus' href="<?php echo url('content/admin/view',['q'=>$v['key']]);?>">
              
              </a>
              
        
          <a href="<?php echo url('content/admin/index',['q'=>$v['key']]);?>">
            <img   data-src="holder.js/150x150?outline=1&text=<?php echo $v['title']?>&size=18&theme=<?php echo $th[$i];?>"
              >
          </a>

          </div>

       
      </div>
      <?php if($i%5==0){
          $i = 0;
      } 
      $i++;
      }?>
</div>

 

<style>

.list .thumbnail .fa-plus {
    position: absolute;
    top: 10px;
    right: 26px;
    font-size: 27px;
}

</style>
     

<?php 
 
$this->end();
?>


<?php $this->start('js1');?>


<script src="<?php echo base_url();?>misc/holder.js">

<?php $this->end();?>



 
