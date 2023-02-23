<?php
require_once "../config.php";
$state_id=$_GET['state'];
$cities=$dbquery->multiple_row_with_one_parameter('delivery_locations','state_id',$state_id,'name','ASC');
echo "<option value='' selected disabled>Select city</option>";
foreach($cities as $city){ ?>
<option value="<?=$city['unique_id'];?>"><?=ucwords($city['name']);?></option>
<?php }