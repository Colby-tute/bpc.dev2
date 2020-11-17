<?php
if(count($result) > 0){
	foreach($result as $message) { ?>
		<tr>
			<td>
				<a href="#" class="p-3 d-flex border-bottom">
			       <div class="wd-90p">
			            <div class="d-flex">
			                <h5 class="mb-1 name" style="width: 100%">
			                	<?= $message->tbl_broadcast_message ?>
			               	</h5>
			            </div>
			            <p class="mb-0 desc"><?= $message->tbl_broadcast_insertdate ?></p>
			        </div>
			    </a>
			</td>
			<td>
            	<span class="text-right edit" data-toggle="modal" data-target="#editMessage"  data-message="<?php echo $message->tbl_broadcast_message; ?>" data-id="<?php echo $message->tbl_broadcast_id; ?>" style="float: right;"><i class="fa fa-edit"></i></span>
    			<span class="text-right delete" data-id="<?php echo $message->tbl_broadcast_id; ?>" style="float: right;"><i class="fa fa-trash"> </i></span>
    		</td>
		</tr>
	<?php }
}else{ ?>
	<tr>
		<td colspan="2">
		   Message List Empty!
		</td>
	</tr>
<?php } ?>