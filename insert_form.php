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
    <textarea name="contents" rows="2" cols="70"></textarea>
</p>
    <?php
    /**
     * Created by PhpStorm.
     * User: kobahiro
     * Date: 2016/12/27
     * Time: 17:35
     */
    //DB接続
    require_once '../../htdocs/b_board/DbManager.php';
    require_once '../../htdocs/b_board/Encode.php';
    if(isset($_POST['name']) && isset($_POST['contents'])) {
        if (empty($_POST['name']) || empty($_POST['contents'])) {
            echo "未入力の項目があります";
        } else {
            try {
                $db = getDb();
                $name = e($_POST['name']);
                $contents = e($_POST['contents']);
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
    ?>

<p>
    <input type = "submit" value = "登録" />
</p>
    <table border="1">
        <tr>
            <th>名前</th><th>本文</th>
        </tr>

        <?php
        //require_once '../../htdocs/b_board/DbManager.php';

        try{
            $db = getDb();
            $stt = $db->prepare('select * from post order by id desc');
            $stt->execute();
            while($row = $stt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['contents']; ?></td>
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