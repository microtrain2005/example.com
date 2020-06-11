<?php
require '../../config/keys.php';
require '../../core/db_connect.php';

$args=[
  'id'=>FILTER_UNSAFE_RAW,
  'confirm'=>FILTER_VALIDATE_INT
];

$input = filter_input_array(INPUT_GET, $args);
$id=$input['id'];

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=:id");
$stmt->execute(['id'=>$id]);
$row = $stmt->fetch();

if(!empty($input['confirm'])){
  $stmt = $pdo->prepare("DELETE FROM posts WHERE id=:id");
  if($stmt->execute(['id'=>$id])){
    header('Location: /posts/');
  }
}

$meta=[];
$meta['title']="DELETE: {$row['title']}";

$content=<<<EOT
<h1 class="text-danger text-center">DELETE: {$row['title']}</h1>
<p class="text-danger text-center">Are you sure you want to delete {$row['title']}?</p>

<div class="text-center">

  <a href="delete.php?id={$row['id']}&confirm=1" class="btn btn-link text-danger">Delete</a>
  <br><br>
  <a href="./" class="btn btn-success btn-lg">Cancel</a>
  </div>
EOT;

require '../../core/layout.php';