<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Form</title>
    <meta name="description" content="sign up form">
    <meta name="author" content="admin">
    
<style>
.flex-container {
    display: flex;
    justify-content: center;
    justify-items: center;
    column-count: 3;

}

.flex-container>div {
    background-color: rgba(255,0,0,.5);
    margin: 0em;
    padding:.6em;
    font-size: 1.5em;
    align-items: flex-start ;
    flex-basis: 25%
}
</style>
    
</head>
    
<body>
    
<?php    
    echo "<pre>", print_r($_POST, true), "<pre>";
    if(isset($_POST['submit']))  {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $nickname = filter_var($_POST['nickname'], FILTER_SANITIZE_STRING);
        $theme = filter_var($_POST['theme'], FILTER_SANITIZE_STRING);        
        $age = filter_var($_POST['age'], FILTER_SANITIZE_STRING);

            
        $to = 'ethanthemagicboy@gmail.com';
        $subject = 'Form Submit';
        $message = "hi\n\n"
                    ."Username: $username\n"
                    ."Nickname: $nickname\n"
                    ."Age: $age\n"  
                    ."Theme: $theme\n";
        $result = mail($to,$subject,$message);
        
        // Connect to Database
        $hostname = 'localhost';
        $dataname = 'ethaneme_ethan';
        $password = '67890';
        $database = 'ethaneme_userform';
        
        $mysqli = new mysqli($hostname, $dataname, $password, $database);
            
        if ($mysqli->connect_errno){
            echo "<p>MySQL Error" . $mysqli->error;
        } else {
            echo 'Thank you for creating you account!<br>';
        }
        
        $username = $mysqli->real_escape_string($username);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $nickname = $mysqli->real_escape_string($nickname);
        $age = $mysqli->real_escape_string($age);
        $theme = $mysqli->real_escape_string($theme);
        
        $query = "INSERT INTO `acct` (`accountid`, `username`, `password`, `nickname`, `theme`, `age`)" . "VALUES (NULL, '$username', '$password', '$nickname', '$theme', '$age')";
        
        echo $query;
        
        if ($mysqli->query($query)) {
            echo '<p>Insert data success!!!</p>';
        } else {
        echo '<p>Insert Error ' . $mysqli->error . '</p>';
        }
    }
    
?>
    
    <style>
        body {
            text-align: center
        }
    </style>
<h1>WELCOME to our site! Please choose your...</h1>    
 
<form method="post">   
<div class="flex-container">
  <div style="color: #000; font-family:sans-serif; max-width: 8em; text-align: right">
      Username:<br><br>
      Password:<br><br>
      Nickname:<br><br>
  </div>
  <div style="max-width: 6.6em">
        <input type="text" name="username"><br>
        <br>
        <input type="text" name="password"><br>
        <br>
        <input type="text" name="nickname"><br>
        <br>
  </div> 
  <div style="color: #000; font-family:sans-serif; text-align: left; min-width: 4em; max-width: 6.6em">
  Age:<br>
  <input type="radio" name="age" value="13-17" checked> 13-17<br>
  <input type="radio" name="age" value="18-29"> 18-29<br>
  <input type="radio" name="age" value="30+"> 30+<br><br>
  Theme:<br>
  <select name="theme">
    <option value="red">Red</option>
    <option value="pink">Pink</option>
    <option value="blue">Blue</option>
    <option value="purple">Purple</option>
  </select>
  </div>
</div>    <br>
<input type="submit" value="Create Account" name="submit">
</form>

<p>***Nickname can be changed at any time, username cannot currently be changed.</p>

</body>
</html>
