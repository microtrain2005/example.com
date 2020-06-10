<?php
require '../core/About/src/Validation/Validate.php';
include '../vendor/autoload.php';
require '../config/keys.php';
use Mailgun\Mailgun;
use About\Validation;

$valid = new About\Validation\Validate();

$filters = [
    'name'=>FILTER_SANITIZE_STRING,
    'email'=>FILTER_SANITIZE_EMAIL,
    'message'=>FILTER_SANITIZE_STRING,
];
$input = filter_input_array(INPUT_POST, $filters);

if(!empty($input)){
    $valid->validation = [
        'email'=>[[
                'rule'=>'email',
                'message'=>'Please enter a valid email'
            ],[
                'rule'=>'notEmpty',
                'message'=>'Please enter an email'
        ]],
        'name'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please enter your name'
        ]],
        'message'=>[[
            'rule'=>'notEmpty',
            'message'=>'Please add a message'
        ]],
    ];

    $valid->check($input);

    if(empty($valid->errors)){

# Instantiate the client.
$mgClient = Mailgun::create(MG_KEY,MG_API); //MailGun key 
$domain = MG_DOMAIN; //API Hostname
$from = "Mailgun Sandbox <postmaster@{$domain}>";

# Make the call to the client.
$result = $mgClient->messages()->send($domain,
array   (  
          'from'    => "{$input['name']} <{$input['email']}>",      
          'to'      => 'Chad <chad@killer-sites.com>',
          'subject' => 'Hello Chad Svastisalee',
          'text'    => $input['message']
        )
    );   
/* Use To Show Input When Needed
var_dump($result);
*/

    $message = "<div class=\"message-success\">Your form has been submitted!</div>";
    }else{
    $message = "<div class=\"message-error\">Your form has errors!</div>";
    }
}