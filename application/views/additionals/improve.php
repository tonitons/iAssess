<?php $addctr = $this->session->ctr; 
	$unit_id = 'improve-unit-'.$addctr; 
	$plant_id = 'plantation-'.$addctr;
	$improvemv_id = 'improve-market-'.$addctr;
?>

<tr>
    <td>
        <select name="kind[]" id="<?php echo 'plantation-'.$addctr ?>" class="form-control" onchange='improve_unit_value("<?php echo $unit_id ?>", "<?php echo $plant_id ?>")'>
            <option value="">--SELECT--</option>
            <?php foreach($improvements as $value): ?>
            <option value="<?php echo $value->plant_id ?>"><?php echo $value->kind ?></option>
            <?php endforeach; ?>
        </select>
    </td>
    <td><input type="number" name="total_number[]" class="form-control" onkeyup='improve_mv(this.value, "<?php echo $unit_id ?>", "<?php echo $improvemv_id ?>", "<?php echo $addctr?>")'> </td>
    <td><span id="<?php echo 'improve-unit-'.$addctr ?>"></span></td>
    <td>P <input type="text" id="<?php echo 'improve-market-'.$addctr ?>" readonly></td>
</tr>
<?php 
		$addctr++;
		
		$this->session->set_userdata( ['ctr' => $addctr] );
	 ?>
