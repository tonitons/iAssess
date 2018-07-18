
<select id="agri_class" name="sub_type" class="form-control">
	<option selected disabled>--- SELECT --</option>
<?php foreach ($market_values as $value): ?>
	<option value="<?php echo $value->agri_id ?>"><?php echo $value->agri_land ?></option>
<?php endforeach ?>	
</select>

