<?php
require '../../config/keys.php';
require '../../core/db_connect.php';
// require '../../core/sessions.php';

$input = filter_input_array(INPUT_GET);

$slug = preg_replace("/[^a-z0-9-]+/","",$input['slug']);

$stmt = $pdo->prepare("SELECT * FROM posts WHERE slug=:slug");
$stmt->execute(['slug'=>$slug]);
$row = $stmt->fetch();

$meta=[];
$meta['title']=$row['title'];
$meta['description']=$row['meta_description'];
$meta['keywords']=$row['meta_keywords'];

$content=<<<EOT
<h1>{$row['title']}</h1>
{$row['body']}<br>
{$row['meta_description']}<br>
{$row['meta_keywords']}<br>
{$row['created']}

<hr>
<div>
  <a class="btn btn-link" href="edit.php?id={$row['id']}">Edit</a>
  <a class="btn btn-link text-danger" href="delete.php?id={$row['id']}">Delete</a>
</div>
EOT;

require '../../core/layout.php';