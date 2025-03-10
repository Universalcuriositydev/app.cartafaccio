<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <title>Sign in Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          
          <form action="login/login.php" class="sign-in-form" method="post">
            <h2 class="title">Accesso</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="username" id="username" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" />
            </div>
            <input type="submit" value="Login" class="btn solid" />

            <p class="social-text">Oppure accedi con le piattaforme social</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>

          <form action="signin/signin.php" class="sign-up-form" method="post">
            <h2 class="title">registrazione</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="nome" id="nome" placeholder="nome" required />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="cognome" id="cognome" placeholder="cognome" required />
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="Email" required />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required />
            </div>
            
            <input type="submit" class="btn" value="Sign up" />
            <p class="social-text">Oppure registrati con le piattaforme social</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>

        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>sei nuovo?</h3>
            <p>
              registrati
            </p>
            <button class="btn transparent" id="sign-up-btn">
              registrati
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>sei già registrato?</h3>
            <p>
              accedi al tuo account
            </p>
            <button class="btn transparent" id="sign-in-btn">
              accedi
            </button>            
           
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>
</html>