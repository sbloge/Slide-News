<?php
session_start();

if(isset($_POST['submit_pass']) && $_POST['pass'])
{
 $pass=$_POST['pass'];
 if($pass=="kramfors")
 {
  $_SESSION['password']=$pass;
 }
 else
 {
  $error="Incorrect Pssword";
 }
}

if(isset($_POST['page_logout']))
{
 unset($_SESSION['password']);
}
?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body>
    <div id="bar">
        <h1>Slidele</h1>
    </div>
    <div id="wrapper">
        <?php
        if($_SESSION['password']=="kramfors")
        {
        ?>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                Välj pdf:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Ladda Upp .PDF" name="upload">
            </form>
        <?php
        }
        else
        {
        ?>
            <form method="post" action="" id="login_form">
                <h1>Logga in:</h1>
                    <input type="password" name="pass" placeholder="*******">
                    <input type="submit" name="submit_pass" value="Logga In">
                <p><font style="color:red;"><?php echo $error;?></font></p>
            </form>
        <?php	
        }
        ?>
    </div>
</body>
</html>
