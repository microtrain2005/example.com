<?php
require '../../config/keys.php';
require '../../core/db_connect.php';

$input = filter_input_array(INPUT_GET);

$id = !(empty($input['id']))?$input['id']:null;
$email = !(empty($input['email']))?$input['email']:null;

if(!empty($email)){
  $lookup = $email;
  $where = 'email = :lookup';
}else{
  $lookup = $id;
  $where = 'id = :lookup';
}


$stmt = $pdo->prepare("SELECT * FROM users WHERE {$where}");
$stmt->execute(['lookup'=>$lookup]);
$row = $stmt->fetch();

$meta=[];
$meta['title']="{$row['first_name']} {$row['last_name']}";

$content=<<<EOT
<h1>{$row['first_name']} {$row['last_name']}</h1>
{$row['email']}
<hr>
<div>
  <a class="btn btn-link" href="edit.php?id={$row['id']}">Edit</a>
  <a class="btn btn-link text-danger" href="delete.php?id={$row['id']}">Delete</a>
</div>
EOT;

require '../../core/layout.php';
