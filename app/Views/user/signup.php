<?php require_once 'app\Views\partials\html.boilerplate.php';?>

<section>
    <h4>SIGN UP</h4>

    <form action="/signup" method="post">

        <label for="user_name"><b>Username</b>
            <input type="text" placeholder="Enter username" name="user_name" required>
        </label>
        <label for="password"><b>Password</b>
            <input type="password" placeholder="Enter Password" name="password" required>
        </label>
        <label for="password_validate"><b>Repeat Password</b></label>
        <input type="password" placeholder="Repeat Password" name="password_validate" required>
        <label for="email"><b>Email</b>
            <input type="email" placeholder="Enter email" name="email" required>
        </label>

        <button type="submit" name="submit" >Sign Up</button>
    </form>
</section>


<?php require_once 'app\Views\partials\html.closing.php';?>

