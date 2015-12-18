<html>
<body>
<h1>ビジネスホテルの全検索</h1>

<?php
$pdo = new PDO("mysql:host=localhost; dbname=hotel_reservation; charset=utf8","koredake","koredake123",array(PDO::ATTR_EMULATE_PREPARES => false));

$statement = $pdo->prepare("select * from hotels order by price");
$statement -> execute();
$results = $statement->fetchAll();
?>

<table border="1">
<caption>検索結果</caption>
<tr>
<th>ホテル名</th>
<th>宿泊料金</th>
<th>住所</th>
</tr>

<?php
foreach($results as $result){
?>

<tr>
<td><?php print(htmlspecialchars($result["hotel_name"],ENT_QUOTES)); ?></td>
<td><?php print(htmlspecialchars(number_format($result["price"],ENT_QUOTES))); ?></td>
<td>
<?php print(htmlspecialchars($result["pref"],ENT_QUOTES)); ?>
<?php print(htmlspecialchars($result["city"],ENT_QUOTES)); ?>
<?php print(htmlspecialchars($result["adress"],ENT_QUOTES)); ?>
</td>
</tr>

<?php
}
?>
</table>
</body>
</html>
