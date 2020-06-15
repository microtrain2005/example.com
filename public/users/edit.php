<?php
require '../../core/functions.php';
require '../../config/keys.php';
require '../../core/db_connect.php';

// Get the user
$get = filter_input_array(INPUT_GET);
$id = $get['id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id=:id");
$stmt->execute(['id'=>$id]);

$row = $stmt->fetch();

//If the id cannot be found kill the request
if(empty($row)){
  http_response_code(404);
  die('Page Not Found <a href="/">Home</a>');
}

//var_dump($row);
$meta=[];
$meta['title']= "Edit: {$row['first_name']} {$row['last_name']}";

// Update the user
$message=null;

$args = [
    'id'=>FILTER_SANITIZE_STRING, //strips HMTL
    'first_name'=>FILTER_SANITIZE_STRING, //strips HMTL
    'last_name'=>FILTER_SANITIZE_STRING, //strips HMTL
    'email'=>FILTER_SANITIZE_EMAIL
];

$input = filter_input_array(INPUT_POST, $args);

if(!empty($input)){

    //Strip white space, begining and end
    $input = array_map('trim', $input);

    //Sanitized insert
    $sql = 'UPDATE
        users
      SET
        first_name=:first_name,
        last_name=:last_name,
        email=:email
      WHERE
        id=:id';

    if($pdo->prepare($sql)->execute([
      'first_name'=>$input['first_name'],
      'last_name'=>$input['last_name'],
      'email'=>$input['email'],
      'id'=>$input['id']
    ])){
       header('LOCATION:view.php?id=' . $row['id']);
    }else{
        $message = 'Something bad happened';
    }
}

$content = <<<EOT
<h1>Edit: {$row['first_name']} {$row['last_name']}</h1>
{$message}
<form method="post">
<input id="id" name="id" value="{$row['id']}" type="hidden">
<div class="form-group">
    <label for="first_name">First Name</label>
    <input id="first_name" value="{$row['first_name']}" name="first_name" type="text" class="form-control">
</div>
<div class="form-group">
    <label for="last_name">Last Name</label>
    <input id="last_name" value="{$row['last_name']}" name="last_name" type="text" class="form-control">
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input id="email" value="{$row['email']}" name="email" type="text" class="form-control">
</div>
<div class="form-group">
    <input type="submit" value="Submit" class="btn btn-primary">
</div>
</form>
EOT;

include '../../core/layout.php';
