<?php


/**
 * Orignal idea of Florin POP: 
 * 
 * Here is the ref: https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/
 * 
 * */
class AccountUtility {
    public static function accountPageBody(){?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <meta charset="utf-8">
         
                <script src="https://kit.fontawesome.com/0ef31ce130.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<meta name="google-signin-client_id" content="892591699744-bge3r6op06k1brb81ao3ja5jnmlgkd36.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
                <link href="inc/css/accountpage.css" rel="stylesheet">
                             
                <title>Login Page</title>

                <script>
                    // null on 
                    // ref: https://stackoverflow.com/questions/26107125/cannot-read-property-addeventlistener-of-null
                    window.onload=function(){
                        const signUpButton = document.getElementById('signUp');
                        const signInButton = document.getElementById('signIn');
                        const container = document.getElementById('container');

                        signUpButton.addEventListener('click', () => {
                            container.classList.add('right-panel-active');
                        });

                        signInButton.addEventListener('click', () => {
                            container.classList.remove('right-panel-active');
                        });
                    }
                    function onSignIn(googleUser) {
        // Useful data for your client-side scripts:
        var profile = googleUser.getBasicProfile();
        console.log('User is '+googleUser.getBasicProfile());
        console.log("ID: " + profile.getId()); // Don't send this directly to your server!
        console.log('Full Name: ' + profile.getName());
        console.log('Given Name: ' + profile.getGivenName());
        console.log('Family Name: ' + profile.getFamilyName());
        console.log("Image URL: " + profile.getImageUrl());
        console.log("Email: " + profile.getEmail());

        // The ID token you need to pass to your backend:
        var id_token = googleUser.getAuthResponse().id_token;
        console.log("ID Token: " + id_token);
      }
     
                </script>
            </head>
            <body>
                <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->

                <div class="container" id="container">
                    <div class="form-container sign-up-container">
                        <!-- Sign Up form code goes here -->
                        <form action='<?php echo $_SERVER["PHP_SELF"];?>' method="POST">
                        <h1>Create Account</h1>
                        <div class="social-container"> 
                            <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        </div>
                        <span>or use your email for registration</span>
                        <input type="text"  name="username" placeholder="User Name" />
                        <input type="email"  name="email" placeholder="Email" />
                        <input type="password"  name="password" placeholder="Password" />
                        <input type="hidden" id="action" name="action" value="<?php echo ACTION_SIGNUP_ACCOUNT;?>">
                        <button>Sign Up</button>

                    </form>
                    </div>
        <div class="form-container sign-in-container">
        <form action='<?php echo $_SERVER["PHP_SELF"];?>' method="POST">
        <h1>Sign in</h1>
        <div class="social-container">      


        <div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark">
        </div>
  <!-- <input type="submit" value="Sign in with Google" class="btn btn-danger"> -->



        </div>
        <span>or use your account</span>
        <input type="text" name="username" placeholder="User Name" />
        <input type="password" name="password" placeholder="Password" />
        <input type="hidden" id="action" name="action" value="<?php echo ACTION_SIGIN_ACCOUNT;?>">
        <button>Sign In</button> 
        </form>
        </div>

                    <div class="overlay-container">
                        <div class="overlay">
                            <div class="overlay-panel overlay-left">
                                <h1>Welcome Back!</h1>
                                <p>
                                    To keep connected with us please login with your personal info
                                </p>
                                <button class="ghost" id="signIn">Sign In</button>
                            </div>
                            <div class="overlay-panel overlay-right">
                                <h1>Welcome</h1>
                                <p>Enter your personal details and start journey with us</p>
                                <button class="ghost" id="signUp">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
        </html>
<?php 
    }
}


?>