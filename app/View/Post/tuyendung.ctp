<div class="boxmain">
<div id="title-body-content"><h2>
		<a title="Trang ch?" href="<?php echo DOMAIN?>">Home</a> / <span>Tuyển dụng</span></h2>
</div>
  
     <table border="0" cellspacing="0" cellpadding="0">
                    <?php foreach ($listNews as $rows) { ?>
                        <div id="row_news">
                      <?php if($rows['Post']['images']){?>
								 <img alt="<?php echo $rows['Post']["name"]; ?>" title="<?php echo $rows['Post']["name"]; ?>" style="float:left;border: 1px solid #d2d1d1;padding:2px;"width="120" height="90"src="<?php echo IMAGEAD?>post/<?php echo $rows['Post']['images']?>">
								 <?php } else {?>
								 <?php }?>
								 <div class="row-content">
                                   <h3> <a alt="<?php echo $rows['Post']["name"]; ?>" title="<?php echo $rows['Post']["name"]; ?>"id="tenbaiviet1" href="<?php echo DOMAIN; ?>chi-tiet-tin/<?php echo $rows['Post']['id']; ?>/<?php echo $rows['Post']['slug']?>">
									<?php echo $rows['Post']["name"]; ?></a></h3>
                                    <div class="content_news"> <?php echo $rows['Post']["shortdes"]; ?></div>
                               
                           </div>     
						      </div> 
                      
                    <?php } ?>  
        </tr>   
                </table>
			
				
				 
	
				<tr>
                <td>
                 <div class="pagination">
   <?php
        echo $this->Paginator->first('« Đầu ', null, null, array('class' => 'disabled'));     
        echo $this->Paginator->prev('« Trước ', null, null, array('class' => 'disabled')); 
        echo $this->Paginator->numbers()." ";
        echo $this->Paginator->next(' Tiếp »', null, null, array('class' => 'disabled')); 
        echo $this->Paginator->last('« Cuối ', null, null, array('class' => 'disabled')); 
    ?>
</div>
            </td>
            </tr>	
</div>