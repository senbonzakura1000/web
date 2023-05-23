<html>
<link rel="stylesheet" href="style.css">
<body>
<header>
<blockquote>
    <a href="index.php"><img src="lg.png"></a>
</blockquote>
</header>
<blockquote>
<div class="container">
<center><h1>Вход</h1></center>
<form action="checklogin.php" method="post">
    Логин:<br><input type="text" name="username"/>
    <br><br>
    Пароль:<br><input type="password" name="pwd" />
    <br><br>
    <input class="button" type="submit" value="Войти"/>
    <input class="button" type="button" name="cancel" value="Назад" onClick="window.location='index.php';" />
</form>
</div>
<blockquote>
<?php
if(isset($_GET['errcode'])){
    if($_GET['errcode']==1){
        echo '<span style="color: red;">Invalid username or password.</span>';
    }elseif($_GET['errcode']==2){
        echo '<span style="color: red;">Please login.</span>';
    }
}

?>
</body>
</html>