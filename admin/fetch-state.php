<?php
require_once "../config.php";
$country_id=$_GET['country'];
$states=$dbquery->multiple_row_with_one_parameter('states','country_id',$country_id,'name','ASC');

echo "<option value='' selected disabled>Select state</option>";
foreach($states as $state){ ?>
<option value="<?=$state['id'];?>"><?=ucwords($state['name']);?></option>
<?php }