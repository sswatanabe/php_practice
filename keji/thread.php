<html>
  <head>
  </head>
  
  <body>

<?php
 
  //Connect Database

  try{
    $pdo = new PDO("mysql:host=localhost; dbname=keji;charset=utf8","root","1993syou",array(PDO::ATTR_EMULATE_PREPARES => false));
  }catch(PDOException $e){
    exit('データベース接続エラー'.$e->getMessage());
  }

  //thread 識別のための変数
  $thread = $_GET['thread_name'];
  
  //Insert
  if( $_REQUEST["cmd"] == "reserve"){
    $sql = sprintf(
        "INSERT INTO %s(user_name,content,time_res)
        value( :user_name, :content,NOW())",
        str_replace(array("\0","'"),array("","''"),$thread)
    );

    $condition = array(
	":user_name"   => $_REQUEST["user_name"],
	":content"     => $_REQUEST["content"]
    );


    $statement = $pdo->prepare($sql);
    $statement->execute($condition);
  }

  $sqllist = sprintf(
	   "SELECT * FROM %s",
	   str_replace(array("\0","'"),array("","''"),$thread)
  );

  //Show res list

  $statement = $pdo->prepare($sqllist);
  $statement->execute(); 
  $results =  $statement -> fetchAll();
?>

<h1><?php print(htmlspecialchars($thread,ENT_QUOTES)); ?></h1>
  <table>
    <h3>スレッド一覧</h3>
      <tr>
	<th>No.</th>
        <th>ユーザー名</th>
        <th>本文</th>
        <th>更新日時</th>
      </tr>

  <?php
    foreach($results as $result){
  ?>

  <tr>
    <td><?php print(htmlspecialchars($result["id"],ENT_QUOTES)); ?></td>
    <td><?php print(htmlspecialchars($result["user_name"],ENT_QUOTES)); ?></td>
    <td><?php print(htmlspecialchars($result["content"],ENT_QUOTES)); ?></td>
    <td><?php print(htmlspecialchars($result["time_res"],ENT_QUOTES)); ?></td>
  </tr>

  <?php
    }
  ?>

  </table>


  <!-- INSERT -->
 
  <form name="reserve_form" method="post" action="thread.php?thread_name=<?php print(htmlspecialchars($thread,ENT_QUOTES)); ?>">
    <input type="hidden" name="cmd" value="reserve">
      
      <table border="1">
        <h3>レスする</h3>
      
          <tr>
            <th>ユーザー名</th>
              <td><input type="text" name= "user_name"></td>
          </tr>
      
          <tr>
            <th>本文</th>
              <td><textarea name="content" rows="4" cols="40"></textarea></td>
          </tr>
     </table>
     
      <input type="submit" value="送信"  class="Btn-gray button">
    </form>
  <a href="index.php">ホームへ戻る</a>
  </body>
</html>
