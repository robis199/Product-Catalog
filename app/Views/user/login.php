<?php require_once 'app\Views\partials\html.boilerplate.php';?>

<h4>LOGIN TO AN EXISTING ACCOUNT</h4>
    <small class="d-block">Not a user? <a href="/signup">Sign up here</a></small>

    <form action="/login" method="post">

        <label for="user_name"><b>Username</b>
            <input type="text" placeholder="Enter username" name="user_name" required>
        </label>

        <label for="password"><b>Password</b>
            <input type="password" placeholder="Enter Password" name="password" required>
        </label>

        <label for="email"><b>Email</b>
            <input type="email" placeholder="Enter Email" name="email" required>
        </label>

        <button type="submit" name="submit">LOGIN</button>
    </form>

<?php require_once 'app\Views\partials\html.closing.php';?>