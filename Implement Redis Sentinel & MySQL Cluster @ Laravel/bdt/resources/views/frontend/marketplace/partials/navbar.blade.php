      <!-- BEGIN HEADER-->
      <header class="header header--brand">
        <div class="container">
          <div class="header__row">
            <a href="index.html" class="header__logo">
              <svg>
                <use xlink:href="#icon-logo--mob"></use>
              </svg>
            </a>
            <div class="header__social">
              <div class="social social--header social--circles"><a href="#" class="social__item"><i class="fa fa-facebook"></i></a><a href="#" class="social__item"><i class="fa fa-twitter"></i></a><a href="#" class="social__item"><i class="fa fa-google-plus"></i></a></div>
            </div>
            <div class="header__contacts" style="float:right;">
{{--                 <a href="tel:+12025550135" class="header__phone">
                <svg class="header__phone-icon">
                  <use xlink:href="#icon-phone"></use>
                </svg><span class="header__span">+1 202 555 0135</span></a> --}}
            </div>
            <!-- end of block .header__contacts-->
<!--             <div class="auth auth--header">
              <ul class="auth__nav">
                <li class="dropdown auth__nav-item">
                  <div class="dropdown__menu auth__dropdown--restore">
                    <h5 class="auth__title">Reset password</h5>
                    <form action="#" class="form form--flex form--auth form--restore js-restore-form js-parsley">
                      <div class="row">
                        <div class="form-group">
                          <label for="restore-email-dropdown" class="control-label">Enter your User Name or Email</label>
                          <input type="email" name="email" id="restore-email-dropdown" required class="form-control">
                        </div>
                      </div>
                      <div class="row">
                        <button type="submit" class="form__submit">Reset password</button>
                      </div>
                      <div class="row">
                        <div class="form__options">Back to
                          <button type="button" class="js-user-login">Log In</button>or
                          <button type="button" class="js-user-register">Registration</button>
                        </div>

                      </div>
                    </form>

                  </div>
                </li>
                <li class="dropdown auth__nav-item">
                  <button data-toggle="dropdown" type="button" class="dropdown-toggle js-auth-nav-btn auth__nav-btn">
                    <svg class="auth__icon-user">
                      <use xlink:href="#icon-user"></use>
                    </svg><span class="header__span"> Log in /</span>
                  </button>
                  <div class="dropdown__menu auth__dropdown--login">
                    <h5 class="auth__title">Login in your account</h5>
                    <form action="#" class="form form--flex form--auth js-login-form js-parsley">
                      <div class="row">
                        <div class="form-group">
                          <label for="login-username-dropdown" class="control-label">Username</label>
                          <input type="text" name="username" id="login-username-dropdown" required data-parsley-trigger="keyup" data-parsley-minlength="6" data-parsley-validation-threshold="5" data-parsley-minlength-message="Login should be at least 6 chars" class="form-control">
                        </div>
                        <div class="form-group">
                          <label for="login-password-dropdown" class="control-label">Password</label>
                          <input type="password" name="password" id="login-password-dropdown" required class="form-control">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form__options form__options--forgot">
                          <button type="button" class="js-user-restore">Forgot password ?</button>
                        </div>
                        <button type="submit" class="form__submit">Sign in</button>
                      </div>
                      <div class="form__remember">
                        <input type="checkbox" id="remember-in-dropdown" class="in-checkbox">
                        <label for="remember-in-dropdown" class="in-label">Remember me</label>
                      </div>
                      <div class="row">
                        <div class="form__options">Not a user yet?
                          <button type="button" class="js-user-register">Get an account</button>
                        </div>
                      </div>
                    </form>

                  </div>
                </li>
                <li class="dropdown auth__nav-item">
                  <button data-toggle="dropdown" type="button" class="dropdown-toggle auth__nav-btn"><span class="header__span">  Sign up</span></button>
                  <div class="dropdown__menu auth__dropdown--register">
                    <h5 class="auth__title">Sign up a new account</h5>
                    <form action="#" class="form form--flex form--auth js-register-form js-parsley">
                      <div class="row">
                        <div class="form-group form-group--col-6">
                          <label for="register-name-dropdown" class="control-label">First name</label>
                          <input type="text" name="username" id="register-name-dropdown" required class="form-control">
                        </div>
                        <div class="form-group form-group--col-6">
                          <label for="register-lastname-dropdown" class="control-label">Last name</label>
                          <input type="text" name="name" id="register-lastname-dropdown" required class="form-control">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group form-group--col-6">
                          <label for="register-email-dropdown" class="control-label">E-mail</label>
                          <input type="email" name="email" id="register-email-dropdown" required class="form-control">
                        </div>
                        <div class="form-group form-group--col-6">
                          <label for="register-password-dropdown" class="control-label">Password</label>
                          <input type="password" name="password" id="register-password-dropdown" required class="form-control">
                        </div>
                      </div>
                      <div class="row">
                        <div class="form__options">Back to
                          <button type="button" class="js-user-login">Log In</button>
                        </div>
                        <button type="submit" class="form__submit">Sign up</button>
                      </div>
                    </form>

                  </div>
                </li>
              </ul>
            </div> -->
            <button type="button" class="header__navbar-toggle js-navbar-toggle">
              <svg class="header__navbar-show">
                <use xlink:href="#icon-menu"></use>
              </svg>
              <svg class="header__navbar-hide">
                <use xlink:href="#icon-menu-close"></use>
              </svg>
            </button>
            <!-- end of block .header__navbar-toggle-->
          </div>
        </div>
      </header>
      <!-- END HEADER-->
      <div id="header-nav-offset"></div>
      <nav id="header-nav" class="navbar navbar--header">
      </nav>