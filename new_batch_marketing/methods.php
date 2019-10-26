<?php


function check_exist($column,$new_batch_marketing,$table,$input){
	$check = $new_batch_marketing->query("SELECT count(*) as count FROM $table WHERE $column  = '$input'");
	$count = 0;
	foreach($check as $key){
			$count = $key['count'];
	}
	return $count;
}

function check_exist_name($column1,$column2,$new_batch_marketing,$table,$input1,$input2){
	$check = $new_batch_marketing->query("SELECT count(*) as count FROM $table WHERE `$column1` = '$input1' AND `$column2` = '$input2'");
	$count = 0;
	foreach($check as $key){
			$count = $key['count'];
	}
	return $count;
}

function check_username($column1,$new_batch_marketing,$table,$input1){
	$check = $new_batch_marketing->query("SELECT count(*) as count FROM $table WHERE `$column1` = '$input1'");
	$count = 0;
	foreach($check as $key){
			$count = $key['count'];
	}
	return $count;
}

function get_info($column1,$column2,$new_batch_marketing,$table,$input1,$input2){
	$check = $new_batch_marketing->query("SELECT * FROM $table WHERE `$column1` = '$input1' AND `$column2` = '$input2'");

	return $check;
}

function area_check($column1,$new_batch_marketing,$table,$input1){
	$check = $new_batch_marketing->query("SELECT count(*) as count FROM $table WHERE `$column1` = $input1");
	$count = 0;
	foreach($check as $key){
		$count = $key['count'];
	}
	return $count;
}

function get_area($column1,$column2,$new_batch_marketing,$table,$input1,$input2){
	$area = '';
	$check = $new_batch_marketing->query("SELECT area FROM $table WHERE `$column1` = '$input1' AND `$column2` = '$input2'");

	foreach($check as $key){
		$area = $key['area'];
	}

	return $area;
}

function select_supplier_name($column1,$new_batch_marketing,$table,$input1){
	$name = '';
	$check = $new_batch_marketing->query("SELECT supplier_name FROM $table WHERE `$column1` = '$input1'");

	foreach($check as $key){
		$name = $key['supplier_name'];
	}

	return $name;
}

function get_quantity($new_batch_marketing,$table,$column1,$column2,$input1){
	$quantity = '';
	$case = $new_batch_marketing->query("SELECT `$column1` FROM `$table` WHERE `$column2` = '$input1'");
	foreach($case as $key){
		$quantity = $key['quantity'];
	}
	return $quantity;
}

function get_all($column1,$column2,$new_batch_marketing,$input1,$input2,$table){
	$details = $new_batch_marketing->query("SELECT * FROM $table WHERE $column1 = '$input1' AND $column2 = '$input2'");
	
	return $details;
}
function update_area($new_batch_marketing,$table,$column1,$column2,$column3,$column4,$input1,$input2,$input3,$input4){
	$update_area = $new_batch_marketing->query("UPDATE $table SET $column1 = '$input1', $column2 = '$input2', $column3 = '$input3' WHERE $column4 = '$input4'");
}
function get_balance($new_batch_marketing,$table,$column1,$column2,$column3,$input1){
 $get_balance = $new_batch_marketing->query("SELECT $column1 FROM $table WHERE $column2 = '$input1' and $column3 > 0");
  return $get_balance;
}
// function delete_entry($transaction_id,$product_code){

// 	$delete_entry = $new_batch_marketing->query("DELETE * FROM order_supplier_list WHERE order_supplier_id = '$transaction_id' AND product_code = '$product_code'");

// 	echo'<script>alert("DONE")</script>';

// }
?>