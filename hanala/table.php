<?php
if(!isset($hasEditRow)){
	$hasEditRow = true;
}

if(!isset($hasDeleteRow)){
	$hasDeleteRow = true;
}

if(!isset($hasSelectorRow)){
	$hasSelectorRow = true;
}
?>
<table id="datatable" class="table table-striped table-bordered bulk_action dt-responsive" cellspacing="0" width="100%">
  <thead>
	<tr>
	
	  <?php if($hasSelectorRow){ ?><th><input type="checkbox" name="table-selector" id="all-table-selector" value="0" class="flat" data-parsley-mincheck="1"/></th><?php } ?>
	  
	  <?php foreach($columns as $key => $column ) { ?>
	  <th><?php echo $column ?></th>
	  <?php } ?>
	  
	  <?php if($hasEditRow){ ?><th>Editar</th><?php } ?>
	  <?php if($hasDeleteRow){ ?><th>Eliminar</th><?php } ?>
	  <?php if(isset($extraLinkRow)){ ?><th><?php echo $extraLinkRow ?></th><?php } ?>
	</tr>
  </thead>

  <tbody>
	<?php foreach($rows as $key => $row ) { ?>
	<tr>
	  
	  <?php if($hasSelectorRow){ ?><th><input type="checkbox" name="table-selector" value="<?php echo $row["id"] ?>" class="flat" data-parsley-mincheck="1"/></th><?php } ?>
	  
	  <?php foreach($row as $key => $value) {?>
	  <td><?php echo $value ?></td>
	  <?php } ?>
	</tr>
	<?php } ?>
  </tbody>
</table>

<script>
	window.addEventListener('load', function() {
		$(".table thead .iCheck-helper").click(function(){
			var selectorContainer = $(this).parent();
			var selector = selectorContainer.find("#all-table-selector");
			if(selector.length > 0){
				if(selector[0].checked){
					$(".table .icheckbox_flat-green").addClass("checked");
				}
			}
		});
	});
</script>