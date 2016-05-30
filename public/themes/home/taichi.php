<?php  $this->layout('default');

use data\post;
$posts = post::get_tag();
$banner = post::get_banner();


?>



<?php $this->start('content'); 



?>
 
    

<div class="page-header">
  <h1 class='hot'>课程</h1>
</div>

<div class="row">
       
</div>

 



    
  
   
    


<?php $this->end();?>