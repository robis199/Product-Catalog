<?php require_once 'app\Views\partials\html.boilerplate.php';?>


<section>
    <h4>SIGN UP</h4>

    <form action="user/signup.php" method="post">

        <label for="user_name"><b>Username</b>
            <input type="text" placeholder="Enter username" name="user_name" required>
        </label>
        <label for="password"><b>Password</b>
        <input type="password" placeholder="Enter Password" name="password" required>
        </label>
        <label for="password_verify"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password_verify" required>


            <button type="submit" name="submit" >Sign Up</button>
    </form>



    <h4>LOGIN TO AN EXISTING ACCOUNT</h4>

    <form action="user/login.php" method="post">

        <label for="user_name"><b>Username</b>
            <input type="text" placeholder="Enter username" name="user_name" required>
        </label>

        <label for="password"><b>Password</b>
            <input type="password" placeholder="Enter Password" name="password" required>
        </label>

        <button type="submit" name="submit">LOGIN</button>
    </form>


</section>


<?php require_once 'app\Views\partials\html.closing.php';?>


