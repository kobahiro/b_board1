<?php
    require_once 'DbManager.php';
    require_once 'Encode.php';
?>

<html>
<head>
<title>データの登録 </title>
</head>
<body>

<h1>掲示板</h1>
<form method = "POST" action = "">
<p>
    名前：(30字以内)<br/ >
    <input type = "text" name = "name" size = "30" maxlength = "30" />
</p>
<p>
    本文：(140字以内)<br />
    <input type = "text" name = "contents" size = "140" maxlength = "140"/>
</p>
    <?php



    if(isset($_POST["name"]) && isset($_POST['contents'])) {
        if ($_POST["name"] == null || $_POST['contents'] == null) {
            echo "未入力の項目があります.";
        }else {

            if (mb_strlen($_POST['name']) > 30) {
                echo "名前は30文字以内で入力してください";
            } else if (mb_strlen($_POST['contents']) > 140) {
                echo "本文は140文字以内で入力してください";
            } else {
                try {
                    $db = getDb();
                    $name = $_POST['name'];
                    $contents = $_POST['contents'];
                    $stt = $db->prepare('INSERT INTO post(name,contents) VALUES(:name, :contents)');

                    $stt->bindValue(':name', $name);
                    $stt->bindValue(':contents', $contents);
                    $stt->execute();
                    $db = NULL;
                } catch (PDOException $e) {
                    die("エラーメッセージ：{$e->getMessage()}");
                }
            }
        }
    }

    ?>

<p>
    <input type = "submit" value = "登録" />
</p>
    <table border = "1">
        <tr>
            <th>名前</th><th>本文</th>
        </tr>

        <?php


        try{
            $db = getDb();
            $stt = $db->prepare('select * from post order by id desc');
            $stt->execute();
            while($row = $stt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo e($row['name']); ?></td>
                    <td><?php echo e($row['contents']); ?></td>
                </tr>
                <?php
            }
            $db = NULL;
            //DB接続error
        }catch(PDOException $e){
            die("error:{$e->getMessage()}");
        }
        ?>

    </table>

</form>
</body>
</html>
