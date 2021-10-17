<?php require_once 'app\Views\partials\html.boilerplate.php';?>

<?php   session_start();
?>

<?php if(isset($_SESSION['user_id']))
{
?>
    <li><a href="/"><?php echo $_SESSION['user_name']; ?></a> </li>
    <li><a href="user/logout.template.php">LOGOUT</a> </li>
    <?php
}
else
{
    ?>
    <li><a href="/auth.template.php">BACK TO HOME</a> </li>
    <?php
    }
?>



<?php require_once 'app\Views\partials\html.closing.php';?>