<!-- Set session in php -->
<?php
function active($name){
  $current = $_SERVER['REQUEST_URI'];
  if($current === $name){
    return 'active';
  }

  return null;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
<!-- Add sanitized content -->
  <?php if(!empty($meta)): ?>

<?php if(!empty($meta['title'])): ?>
  <title><?php echo $meta['title']; ?></title>
<?php endif; ?>

<?php if(!empty($meta['description'])): ?>
  <meta name="description" content="<?php echo $meta['description']; ?>">
<?php endif; ?>

<?php if(!empty($meta['keywords'])): ?>
  <meta name="keywords" content="<?php echo $meta['keywords']; ?>">
<?php endif; ?>

<?php endif; ?>
<!-- End sanitized content -->

      <meta charset="UTF-8">
      <title>Hello Welcome to MicroTrain2005</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- <link rel="stylesheet" type="text/css" href="../../public/dist/css/main.min.css"> -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  </head>
    <body>

      <!-- Content of webpage -->
      <div class="container">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="#">MicroTrain2005 Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <!-- <a class="nav-item nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> -->
                <li class="nav-item">
                  <a class="nav-link <?php echo active('/'); ?>" href="index.php">Home</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link <?php echo active('resume.php'); ?>" href="resume.php">Resume</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link <?php echo active('contact.php'); ?>" href="contact.php">Contact</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php echo active('/posts/'); ?>" href="posts/">Posts</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link <?php echo active('/users/'); ?>" href="users/">Users</a>
                </li>

                <li class="nav-item">
                  <?php if(!empty($_SESSION['user']['id'])): ?>
                    <a class="nav-link" href="logout.php">Logout</a>
                  <?php else: ?>
                    <a class="nav-link <?php echo active('login.php'); ?>" href="login.php">Login</a>
                  <?php endif; ?>
                </li>
               <!-- <a class="nav-item nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a> -->
              </div>
            </div>
      </nav>

      <div class="jumbotron">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">Welcome to MicroTrain2005 Blog, Full Stack Web and Hybrid Mobile Applications Developer.</p>
            <hr class="my-4">
            <p>You will learn front-end and client-side development starting with HTML, CSS and JavaScript. You will then work with libraries and frameworks such as jQuery, Bootstrap and Angular. You will learn how you can use web technology to build hybrid mobile applications using Apache’s Cordova. 
                You will learn how to work with third party APIs from vendors such as Google, Nasa, Twilio and LinkedIn. You will learn the server side by working with LAMP (Linux, Apache, MySQL, PHP) and MEAN (MongoDB, Express, Angular, Node,js) stacks. You will apply you newly acquired backend knowledge to build your own cloud-based server.
                Additionally, you will learn security best practices and mobile first design concepts as well as extreme programming, agile and scrum methodologies. You will apply these skills throughout the course building an array of applications to add to your project portfolio.</p>     
            <!-- <a class="btn btn-primary btn-lg" href="contact.html" role="button">Request Information</a> -->
      </div>
      <!-- Start Content Card -->
      <div class="card text-center">
      <div class="card-header">
        Featured
      </div>
      <div class="card-body">
        <p class="card-text"><?php echo $content; ?></p>
      </div>
      <div class="card-footer text-muted">
        Created June 2020
      </div>
      <!-- End Content Card -->
      </div>

          <!-- Footer -->
          <footer class="footer font-small blue pt-4">

          <!-- Footer Links -->
          <div class="container-fluid text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

              <!-- Grid column -->
              <div class="col-md-6 mt-md-0 mt-3">

                <!-- Content -->
                <h5 class="text-uppercase">Visit Our Locations</h5>
                <p>Chicago | Lombard | Highland Park</p>

              </div>
              <!-- Grid column -->

              <hr class="clearfix w-100 d-md-none pb-3">

              <!-- Grid column -->
              <div class="col-md-3 mb-md-0 mb-3">

                <!-- Links -->
                <h5 class="text-uppercase">Chicago</h5>

                <ul class="list-unstyled">
                  <li>
                    <a href="#!">Map</a>
                  </li>
                </ul>

              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-3 mb-md-0 mb-3">

                <!-- Links -->
                <h5 class="text-uppercase">Lombard</h5>

                <ul class="list-unstyled">
                  <li>
                    <a href="#!">Map</a>
                  </li>
                </ul>

              </div>
              <!-- Grid column -->

            </div>
            <!-- Grid row -->

          </div>
          <!-- Footer Links -->

          <!-- Copyright -->
          <div class="footer-copyright text-center py-3">© 2020 Copyright:
            <a href="https://microtrain.net/"> microtrain.net</a>
          </div>
          <!-- Copyright -->

          </footer>
          <!-- Footer -->

      </div>

    
      </div>

      <!-- <script>
        var toggleMenu = document.getElementById('toggleMenu');
        var nav = document.querySelector('nav');
        toggleMenu.addEventListener(
          'click',
          function(){
            if(nav.style.display=='block'){
              nav.style.display='none';
            }else{
              nav.style.display='block';
            }
          }
        );
      </script> -->
  

    </body>

</html>
