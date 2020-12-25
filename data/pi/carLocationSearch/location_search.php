<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>停車位置查詢</title>
    <style>
        /*Header*/
        .header {
            padding: 15px;
            width: 95%;
            text-align: center;
            background: white;
        }
        .header h1 {
            font-size: 50px;
        }
        /* Create columns*/
        .leftcolumn {
            float: left;
            width: 25%;
            height: 200px;
            text-align: left;
            border-width: 2px;
            border-color: #000000;
            border-style: solid;
            line-height: 200px;
        }
        /* Right column */
        .rightcolumn {
            float: left;
            width: 70%;
            height: 200px;
            text-align: center;
            padding-left: 20px;
            border-width: 2px;
            border-color: #000000;
            border-style: solid;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>停車位置查詢系統</h1>
</div>
<div class="row">
    <div class="leftcolumn">
        <form id='query' method='post'>
            車牌號碼：<input type='text' name='firstNumber' style='width:30px' maxlength='4'> -
            <input type='text' name='lastNumber' style='width:50px' maxlength='4'>
            <input type='submit' name='submitButton' value='查詢'></form>
    </div>
    <div class="rightcolumn">
        <?php

        require_once $_SERVER['DOCUMENT_ROOT'] . '/carLocationSearch/Foundation/HttpReq.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/carLocationSearch/Foundation/Config.php';

        if (isset($_POST['submitButton'])){

            $firstNumber = $_POST['firstNumber'];
            $lastNumber = $_POST['lastNumber'];

            if (!empty($firstNumber) and !empty($lastNumber)){
                //post to query
                $url = Config::$ipUrl.'carLocationSearch/Manager/location_query.php';
                $message = array(
                    "firstNumber" => $firstNumber,
                    "lastNumber" => $lastNumber,
                );

                $message = json_encode($message);
                $result = HttpReq::httpPost($url, $message);

                $decodeMessage = json_decode($result);

                echo "<h1>".$decodeMessage->location."</h1>";
            }
        }
        ?>
    </div>
</div>
</body>
</html>
