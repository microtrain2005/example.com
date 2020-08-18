<?php
// 1. Connect to the database
require '../config/keys.php';
require '../core/db_connect.php';
require '../core/functions.php';

// 2. Filter the user inputs
// $input = filter_input_array(INPUT_POST,[
//     'email'=>FILTER_SANITIZE_EMAIL,
//     'password'=>FILTER_UNSAFE_RAW
// ]);

// Pass user inputs as arguments
$args = [
    'email'=>FILTER_SANITIZE_EMAIL,
    'password'=>FILTER_UNSAFE_RAW,
  ];

$input = filter_input_array(INPUT_POST, $args);  

// 3. Check for a POST request
if(!empty($input)){

    // 4. Query the database for the requested user
    // $input = array_map('trim', $input);
    $sql='SELECT id, hash FROM users WHERE email=:email';
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        'email'=>$input['email']
    ]);
    $row=$stmt->fetch();

    if($row){
        // 5. Attempt a password match
        $match = password_verify($input['password'], $row['hash']);
        if($match){
            // 6.1 Set a session
            $_SESSION['user'] = [];
            $_SESSION['user']['id']=$row['id'];

            $args = [
                'goto'=>FILTER_SANITIZE_STRING,
              ];
          
            // 6.2 Redirect the user
            // header('LOCATION: ' . $_POST['goto']);
            $get = filter_input_array(INPUT_GET, $args);
            $goto = !empty($get['goto'])?$get['goto']:'/';
            header('LOCATION: ' . $goto);
        }
    }
}
$meta=[];
$meta['title']="Login";

$content=<<<EOT
<h1>{$meta['title']}</h1>
<form method="post" autocomplete="off">
    <div class="form-group">
        <label for="email">Email</label>
        <input 
            class="form-control"
            id="email"
            name="email"
            type="email"
        >
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input 
            class="form-control" 
            id="password" 
            name="password" 
            type="password"
        >
    </div>
    <input type="submit" class="btn btn-primary">
</form>
EOT;

require '../core/layout.php';
