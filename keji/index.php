<html>
  <head>
  </head>
  
  <body>
    <h1>スレッド一覧</h1>


<?php
 
  //Connect Database 

  try{ 
    $pdo = new PDO("mysql:host=localhost; dbname=keji;charset=utf8","root","1993syou",array(PDO::ATTR_EMULATE_PREPARES => false));
  }catch(PDOException $e){
    exit('データベース接続エラー'.$e->getMessage());
  }


  //Insert processing

  if( $_REQUEST["cmd"] == "reserve"){
    $sql = sprintf(
	"INSERT INTO thread(thread_name,user_name,time_update)
	value( :thread_name, :user_name,NOW())"
	);

    $condition = array(
	":thread_name" => $_REQUEST["thread_name"],
	":user_name"   => $_REQUEST["user_name"]
    );

    $statement = $pdo->prepare($sql);
    $statement->execute($condition);


  //Create Table

    $sqlcreate = sprintf(
	"CREATE TABLE %s(
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        user_name VARCHAR(50) NOT NULL,
        content VARCHAR(400) NOT NULL,
        time_res TIMESTAMP) ENGINE=InnoDB DEFAULT CHARSET=utf8",
	str_replace(array("\0","'"),array("","''"),$_REQUEST["thread_name"])
    );

    $conn = $pdo->prepare($sqlcreate);
    $conn->execute();
  }

    $statement = $pdo->prepare("select * from thread");
    $statement -> execute();
    $results = $statement -> fetchAll();
?>

  <table>
    <h3>スレッド一覧</h3>
      <tr>
        <th>スレッド名</th>
        <th>ユーザ名</th>
        <th>更新日時</th>
      </tr>

  <?php
    foreach($results as $result){
  ?>

  <tr>
    <td><a href="thread.php?thread_name=<?php print(htmlspecialchars($result["thread_name"],ENT_QUOTES)); ?>"> 
      <?php print(htmlspecialchars($result["thread_name"],ENT_QUOTES)); ?></a></td>
    <td><?php print(htmlspecialchars($result["user_name"],ENT_QUOTES)); ?></td>
    <td><?php print(htmlspecialchars($result["time_update"],ENT_QUOTES)); ?></td>
  </tr>

  <?php
    }
  ?>

  </table>


  <!-- Input Form -->

    <form name="reserve_form" method="post" action="index.php" >
    <input type="hidden" name="cmd" value="reserve">

    <table border="1">
    <h3>新規スレッド作成</h3>

    <tr>
      <th>ユーザー名</th>
      <td><input type="text" name="user_name"></td>
    </tr>

    <tr>
      <th>スレッド名</th>
      <td><textarea name="thread_name" rows="2" cols="40"></textarea></td>
    </tr>
    </table>

    <input type="submit" value="送信"  class="Btn-gray button">
    </form>
  </body>
</html>


