ml>
  <head>
    <title>入力フォーム</title>
  </head>
	<body>
  <table>
    <tr>
      <th>BMI計算結果</th>
      <td><?php 
	    $is_weight_error = false;
	    $is_height_error = false;
	    $weightc = NULL;
	    $heightc = NULL;

	     if( empty($_REQUEST["weight"]) || $_REQUEST["weight"] >= 300){
		$is_weight_error = true;
		$weightc = "体重";
	     }
	     if( empty($_REQUEST["height"] )|| $_REQUEST["height"] >= 300){
		$is_height_error = true;
		$heightc = "身長";
	      }
	     if( $is_weight_error || $is_height_error){
	   	 print(htmlspecialchars( $weightc,ENT_QUOTES));
	      }
          ?></td>
    </tr>

     <tr>
       <th>入力結果</th>
       <td><?php print( htmlspecialchars( $_REQUEST["height"], ENT_QUOTES)); ?></td>
    </tr>
  </table>
	</body>
</html>

