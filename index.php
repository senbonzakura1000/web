<html>
<meta http-equiv="Content-Type"'.' content="text/html; charset=utf8"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="style.css">
<body>
<?php
session_start();
	if(isset($_POST['ac'])){
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE bookstore";
		$conn->query($sql);

		$sql = "SELECT * FROM book WHERE BookID = '".$_POST['ac']."'";
		$result = $conn->query($sql);

		while($row = $result->fetch_assoc()){
			$bookID = $row['BookID'];
			$quantity = $_POST['quantity'];
			$price = $row['Price'];
		}

		$sql = "INSERT INTO cart(BookID, Quantity, Price, TotalPrice) VALUES('".$bookID."', ".$quantity.", ".$price.", Price * Quantity)";
		$conn->query($sql);
	}

	if(isset($_POST['delc'])){
		$servername = "localhost";
		$username = "root";
		$password = "";

		$conn = new mysqli($servername, $username, $password);

		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "USE bookstore";
		$conn->query($sql);

		$sql = "DELETE FROM cart";
		$conn->query($sql);
	}

	$servername = "localhost";
	$username = "root";
	$password = "";

	$conn = new mysqli($servername, $username, $password);

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "USE bookstore";
	$conn->query($sql);	

	$sql = "SELECT * FROM book";
	$result = $conn->query($sql);
?>	

<?php
if(isset($_SESSION['id'])){
	echo '<header>';
	echo '<blockquote>';
	echo '<a href="index.php"><img src="lg.png" ></a>';
	echo '<form class="hf" action="logout.php"><input class="hi" type="submit" name="submitButton" value="Выйти"></form>';
	echo '<form class="hf" action="edituser.php"><input class="hi" type="submit" name="submitButton" value="Изменить профиль"></form>';
	echo '</blockquote>';
	echo '</header>';
}

if(!isset($_SESSION['id'])){
	echo '<header>';
	echo '<blockquote>';
	echo '<a href="index.php"><img src="lg.png"></a>';
	echo '<form class="hf" action="Register.php"><input class="hi" type="submit" name="submitButton" value="Регистрация"></form>';
	echo '<form class="hf" action="login.php"><input class="hi" type="submit" name="submitButton" value="Вход"></form>';
	echo '</blockquote>';
	echo '</header>';
}
echo '<blockquote>';
	echo "<table id='myTable' style='width:80%; float:left'>";
	echo "<tr>";
    while($row = $result->fetch_assoc()) {
	    echo "<td>";
	    echo "<table>";
	   	echo '<tr><td>'.'<img src="'.$row["Image"].'"width="80%">'.'</td></tr><tr><td style="padding: 5px;">Название: '.$row["BookTitle"].'</td></tr><tr><td style="padding: 5px;">ISBN: '.$row["ISBN"].'</td></tr><tr><td style="padding: 5px;">Автор: '.$row["Author"].'</td></tr><tr><td style="padding: 5px;">Жанр: '.$row["Type"].'</td></tr><tr><td style="padding: 5px;">RUB'.$row["Price"].'</td></tr><tr><td style="padding: 5px;">
	   	<form action="" method="post">
	   	Кол-во: <input type="number" value="1" name="quantity" style="width: 20%"/><br>
	   	<input type="hidden" value="'.$row['BookID'].'" name="ac"/>
	   	<input class="button" type="submit" value="Добавить"/>
	   	</form></td></tr>';
	   	echo "</table>";
	   	echo "</td>";
    }
    echo "</tr>";
    echo "</table>";

	$sql = "SELECT book.BookTitle, book.Image, cart.Price, cart.Quantity, cart.TotalPrice FROM book,cart WHERE book.BookID = cart.BookID;";
	$result = $conn->query($sql);

    echo "<table style='width:20%; float:right;'>";
    echo "<th style='text-align:left;'><i class='fa fa-shopping-cart' style='font-size:24px'></i> Корзина <form style='float:right;' action='' method='post'><input type='hidden' name='delc'/><input class='cbtn' type='submit' value='Очистить'></form></th>";
    $total = 0;
    while($row = $result->fetch_assoc()){
    	echo "<tr><td>";
    	echo '<img src="'.$row["Image"].'"width="20%"><br>';
    	echo $row['BookTitle']."<br>RUB".$row['Price']."<br>";
    	echo "Кол-во: ".$row['Quantity']."<br>";
    	echo "Стоимость: RUB ".$row['TotalPrice']."</td></tr>";
    	$total += $row['TotalPrice'];
    }
    echo "<tr><td style='text-align: right;background-color: #f2f2f2;''>";
    echo "Total: <b>RUB".$total."</b><center><form action='checkout.php' method='post'><input class='button' type='submit' name='checkout' value='ПРОВЕРКА'></form></center>";
    echo "</td></tr>";
	echo "</table>";
	echo '</blockquote>';
?>
</body>
</html>