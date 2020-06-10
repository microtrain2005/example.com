<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Hello Welcome to MicroTrain2005</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="../public/dist/css/main.min.css">
  </head>
  <body>

    <div id="Wrapper">
        <nav class="top-nav">
            <a href="index.html" class="pull-left" href="/">MicroTrain2005 WebSite</a>
            <ul role="navigation">
                <li><a href="index.php">Home</a></li>
                <li><a href="resume.php">Resume</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>

        <div class="row">
            <div id="Sidebar">
              <div id="AboutMe">
                <div class="header">Hello, I am MicroTrain2005</div>
                <img src="https://www.gravatar.com/avatar/4678a33bf44c38e54a58745033b4d5c6?d=mm" alt="My Avatar" class="img-circle">
                <p>You will learn front-end and client-side development starting with HTML, CSS and JavaScript. You will then work with libraries and frameworks such as jQuery, Bootstrap and Angular. You will learn how you can use web technology to build hybrid mobile applications using Apache’s Cordova. 

You will learn how to work with third party APIs from vendors such as Google, Nasa, Twilio and LinkedIn. You will learn the server side by working with LAMP (Linux, Apache, MySQL, PHP) and MEAN (MongoDB, Express, Angular, Node,js) stacks. You will apply you newly acquired backend knowledge to build your own cloud-based server.

Additionally, you will learn security best practices and mobile first design concepts as well as extreme programming, agile and scrum methodologies. You will apply these skills throughout the course building an array of applications to add to your project portfolio.</p>     
  </div>
            <div id="Content">
                <?php echo $content; ?>
            </div>

            </div>
        </div>

        <div id="Footer" class="clearfix">
            <small>&copy; 2020 - MyAwesomeSite.com</small>
            <ul role="navigation">
                <li><a href="terms.html">Terms</a></li>
                <li><a href="privacy.html">Privacy</a></li>
            </ul>
        </div>
    </div>

  </body>

</html>
