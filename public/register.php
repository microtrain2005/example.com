<?php
require '../core/sessions.php';
require '../core/db_connect.php';
require '../core/About/src/Validation/Validate.php';

use About\Validation;

$valid = new About\Validation\Validate();
$message=null;

$input = filter_input_array(INPUT_POST,[
    'first_name'=>FILTER_SANITIZE_STRING,
    'last_name'=>FILTER_SANITIZE_STRING,
    'email'=>FILTER_SANITIZE_EMAIL,
    'password'=>FILTER_UNSAFE_RAW,
    'confirm_password'=>FILTER_UNSAFE_RAW
]);

if(!empty($input)){

    $valid->validation = [

        'email'=>[[
            'rule'=>'email',
            'message'=>'Please enter a valid email'
        ],[
            'rule'=>'notEmpty',
            'message'=>'Please enter a email'
        ]],

        'first_name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a first name'
        ]],

        'last_name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a last name'
        ]],

        'password'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter a password'
        ],[
            'rule'=>'strength',
            'message'=>'Must contain [\Wa-zA-Z0-9]'
        ]],

        'confirm_password'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please confirm your password'
        ],[
            'rule'=>'matchPassword',
            'message'=>'Passwords do not match'
        ]],

    ];

    $valid->check($input);

    if(empty($valid->errors)){
        //Strip white space, beginning and end
        $input = array_map('trim', $input);
        $hash = password_hash($input['password'], PASSWORD_DEFAULT); 

        $sql='INSERT INTO 
            users 
        SET 
            id=UUID(),
            email=:email,
            first_name=:first_name,
            last_name=:last_name,
            hash=:hash
        ';

        $stmt=$pdo->prepare($sql);

        try {

            $stmt->execute([
                'email'=>$input['email'],
                'first_name'=>$input['first_name'],
                'last_name'=>$input['last_name'],
                'hash'=>$hash
            ]);

            header('LOCATION: ./login.php');

        } catch(PDOException $e) {
            $message="<div class=\"alert alert-danger\">{$e->errorInfo[2]}</div>";
        }
    }else{
        //3. If validation fails create a message, DO NOT forget to add the validation 
        //methods to the form.
        $message = "<div class=\"alert alert-danger\">Your form has errors!</div>";
    }

    
}

$meta=[];
$meta['title']="Register";

$content=<<<EOT
<h1>{$meta['title']}</h1>
{$message}
<form method="post" autocomplete="off">

    <div class="form-group">
        <label for="email">Email</label>
        <input 
            class="form-control" 
            id="email" 
            name="email" 
            type="email"
            value="{$valid->userInput('email')}"
        >
        <div class="text text-danger">{$valid->error('email')}</div>
    </div>

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input 
            class="form-control" 
            id="first_name" 
            name="first_name"
            value="{$valid->userInput('first_name')}"
        >
        <div class="text text-danger">{$valid->error('first_name')}</div>
    </div>


    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input 
            class="form-control" 
            id="last_name" 
            name="last_name" 
            value="{$valid->userInput('last_name')}"
        >
        <div class="text text-danger">{$valid->error('last_name')}</div>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input 
            class="form-control" 
            id="password" 
            name="password" 
            type="password"
            value="{$valid->userInput('password')}"
        >
        <div class="text text-danger">{$valid->error('password')}</div>
<label for="password">Must contain ([0-9]{/!-*/}) </label>
    </div>

    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input 
            class="form-control" 
            id="confirm_password" 
            name="confirm_password" 
            type="password"
            value="{$valid->userInput('confirm_password')}"
        >
        <div class="text text-danger">{$valid->error('confirm_password')}</div>
    </div>

    <input type="submit" class="btn btn-primary">

</form>
EOT;

require '../core/layout.php';
