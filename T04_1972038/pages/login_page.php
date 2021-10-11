<?php
$loginPressed = filter_input(INPUT_POST,'btnLogin');
if(isset($loginPressed)){
    $email = filter_input(INPUT_POST,'txtEmail');
    $password = filter_input(INPUT_POST,'txtPassword');
    $user=login($email,$password);
    if($user!=null && $user['email']==$email){
        $_SESSION['my_user']=true;
        $_SESSION['user_name']=$user['name'];
        header(('location:index.php'));
        
    }else{
        echo '<div>Invalid email or password</div>';
    }
}
?>

<form action="" method="post">
    <label for="emailId"></label>
    <input type="email" name="txtEmail" id="emailId" placeholder="Your Email (e.g. john.doe@domain.com)" maxlength="100" required>
    <label for="passwordId">Password</label>
    <input type="password" name="txtPassword" id="passwordId" placeholder="Your Security Key" required>
    <input type="submit" value="Login" name="btnLogin">
</form>