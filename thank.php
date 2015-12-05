<html>
  <head>
    <title>入力フォーム</title>
  </head>
	<body>
  <table>
    <tr>
      <th>氏名</th>
      <td><?php print( htmlspecialchars( $_REQUEST["value"]*0.5, ENT_QUOTES)); ?></td>
    </tr>

     <tr>
       <th>入力フォーム</th>
       <td><?php print( htmlspecialchars( $_REQUEST["area"], ENT_QUOTES)); ?></td>
    </tr>
  </table>
	</body>
</html>

