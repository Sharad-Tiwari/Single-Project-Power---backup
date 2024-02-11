<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-compatible" content="ie-edge" />
    <title>Project Login Page</title>
    <link rel="stylesheet" href="chat_style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/all.min.css"
      integrity="sha512-gRH0EcIcYBFkQTnbpO8k0WlsD20x5VzjhOA1Og8+ZUAhcMUCvd+APD35FJw3GzHAP3e+mP28YcDJxVr745loHw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <script
      src="https://kit.fontawesome.com/a9903cb47c.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
      integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE="
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <div class="wrapper">
      <section class="form login">
        <header>Single Project Power</header>
        <form method="POST">
          <div class="error-txt">This is an Error Message!</div>
          <div class="field input">
            <label> Email Address:</label>
            <input
              type="email"
              name="email"
              placeholder="Enter your Email...."
              autocomplete="off"
              required
            />
          </div>
          <div class="field input">
            <label> Company code:</label>
            <input
              type="text"
              name="c_code"
              placeholder="Enter your company code...."
              required
            />
          </div>
          <div class="field input">
            <label> Password: </label>
            <input
              type="password"
              name="password"
              placeholder="Enter your Password here.... "
              autocomplete="off"
              required
            />
            <i class="fas fa-eye"></i>
          </div>
          <div class="field button">
            <input type="submit" value="Continue" />
          </div>
        </form>
        <div class="link">
          Not Signed up?<a href="Signup page.html">&nbsp;&nbsp;Sign UP Now</a>
        </div>
      </section>
    </div>

    <script src="Javascript/pass-show-hide.js"></script>
    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   
    <script src="javascript/login.js"></script>
  </body>
</html>
