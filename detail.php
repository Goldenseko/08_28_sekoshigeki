<?php
//index.php（登録フォームの画面ソースコードを全コピーして、このファイルをまるっと上書き保存）//2番目の手順　一つ作ったらかくにんしていく
include("functions.php");
$id = $_GET["id"]; // echo $id;

//1.  DB接続します
$pdo = db_con();
  
  //２．データ登録SQL作成
  $stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
  $stmt->bindValue(":id", $id, PDO::PARAM_INT);
  $status = $stmt->execute();
  
  //３．データ表示
  $view="";
  if($status==false){
    //execute（SQL実行時にエラーがある場合）
    error_db_info($stmt);
  }else{
    //Selectデータの数だけ自動でループしてくれる //この段階でリンクが貼られているか確認するか確認するのが重要！！！
    $row = $stmt->fetch();
    }
  
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>POSTデータ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前：            <input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>ログイン名：       <input type="text" name="lid" value="<?=$row["lid"]?>"></label><br>
     <label>ログインパスワード：<input type="text" name="lpw" value="<?=$row["lpw"]?>"></label><br>
     <!-- <label><textArea name="naiyou" rows="4" cols="40"></textArea></label><br> -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
