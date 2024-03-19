<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ezon</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="mainezon.png">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&display=swap" rel="stylesheet">
 
  <style>
    .divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
body{
    font-family: 'Merriweather', serif;
  }
a.text-body{
    text-decoration: none;
    list-style: none;
}
a.text-white{
    text-decoration: none;
    list-style: none;

}
a.link-danger{
    text-decoration: none;
    list-style: none;
    color: red;
}
.text{
    float: left;
    text-align: start;
    margin-left: -150px ;
}
#btnfab{
    border-radius: 50%;
}
#loginbtn{
    text-align: start;
    float: left;
    cursor: pointer;
}
#loginbtn:hover{
    transform: translateY(2px);
    background-color: blue;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
</style>
</head>
<body>

<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
      <img src="draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">

        <form action="alquery.php" method="post">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Sign in with</p>
            <button type="button" class="btn btn-primary mx-1" id="btnfab">
              <i class="fab fa-facebook"></i>
            </button>

            <button type="button" class="btn btn-primary  mx-1" id="btnfab">
            <i class="fab fa-google"></i>
            </button>

            <button type="button" class="btn btn-primary mx-1" id="btnfab">
              <i class="fab fa-linkedin-in"></i>
            </button>
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Or</p>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" name="name" class="form-control form-control-lg"
              placeholder="Enter Your User Name" required="required" />
          </div>
          <div class="form-outline mb-4">
            <input type="email" name="email" class="form-control form-control-lg"
              placeholder="Enter Your Email" required="required" />
          </div>
          <div class="form-outline mb-4">
            <input type="password" name="password" class="form-control form-control-lg"
              placeholder="Enter Your Password" required="required" />
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" name="cpassword" class="form-control form-control-lg"
              placeholder="Enter Your Confirm password" required="required" />
          </div>

          <div class="text-center mt-4 pt-2" >
            <input type="submit"  name="loginbtn" id="loginbtn" class="btn btn-primary btn-lg" value="Sign Up" style="padding-left: 2.5rem; padding-right: 2.5rem;">
          </div>
        <div class="text mt-4 pt-5">
        <p class="small fw-bold mt-2 pt-1 mb-0">All ready have an account? <a href="login.php"
                class="link-danger">Sign In</a></p>
        </div>
        </form>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
      Copyright © 2020. All rights reserved.
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white mx-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white mx-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white mx-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white mx-4">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</section>
</body>
</html>