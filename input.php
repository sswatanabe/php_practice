<html>
  <head>
    <title>入力フォーム</title>
  </head>
<body>
  <form action="thank.php" method="post">
  <table>
    <tr>
      <th>趣味を選んでください</th>
	<td>
	  <?php
	  $hobbies = array("読書","music","car","movie");
	  foreach($hobbies as $hobby){
	  ?>
	    <input type="checkbox" name="hobby_checks[]" value="<?php print(htmlspecialchars( $hobby, ENT_QUOTES)); ?>">
	<?php print(htmlspecialchars( $hobby, ENT_QUOTES)); ?><br/>
	    <?php
	    }
	    ?>
         </td>
    </tr>
  </table>
  <input type="submit" value="送信" class="Btn-gray button"/>
  </form>
</body>
</html>
