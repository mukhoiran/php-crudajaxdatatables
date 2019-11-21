<?php

require_once 'db_connect.php';

$output = array('data' => array());

$sql = "SELECT * FROM members";
$query = $connect->query($sql);

$x = 1;
while ($row = $query->fetch_assoc()) {
	$active = '';
	if($row['active'] == 1) {
		$active = '<label class="label label-success">Active</label>';
	} else {
		$active = '<label class="label label-danger">Deactive</label>';
	}

	$actionButton = '
	<a type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#editMemberModal" onclick="editMember('.$row['id'].')"> <span class="glyphicon glyphicon-edit"></span> Edit</a>
	<a type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#removeMemberModal" onclick="removeMember('.$row['id'].')"> <span class="glyphicon glyphicon-trash"></span> Remove</a>
		';

	$output['data'][] = array(
		$x,
		$row['name'],
		$row['address'],
		$row['contact'],
		$active,
		$actionButton
	);

	$x++;
}

// database connection close
$connect->close();

echo json_encode($output);
