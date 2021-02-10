<?php
include_once "scramblerf.php";

$task  = 'encode';
if(isset($_GET['task']) && $_GET['task'] != ''){
    $task = $_GET['task'];
}
$original_key = 'abcdefghijklmnopqrstuvwxyz0123456789';
$key = 'abcdefghijklmnopqrstuvwxyz0123456789';

if('key' == $task){
    $key_original = str_split($key);
    shuffle($key_original);
    $key = join('', $key_original);
}
else if(isset($_POST['key']) && $_POST['key'] != ''){
    $key = $_POST['key'];
}

$scrambledData = '';
if('encode' == $task){
    $data = $_POST['data']??'';
    if($data != ''){
        $scrambledData = scrambleData($data, $key);
    }
}

if('decode' == $task){
    $data = $_POST['data']??'';
    if($data != ''){
        $scrambledData = decodeData($data, $key);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Example</title>

    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">

    <style>
        body{
            margin-top:30px;
        }
        #data {
            width:100%;
            height: 160px;
        }
        #result{
            width:100%;
            height: 160px;
        }
        .hidden {
            display:none;
        }
        a {
            padding: 5px;
            padding-right: 0px;
        }
    </style>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="column column-60 column-offset-20">
            <h2>Data Scrambler</h2>
            <p>Use this application to scramble your data</p>
            <p>
                <a href="/Test/DataScrambler/scrambler.php?task=encode">Encode</a>
                <a href="/Test/DataScrambler/scrambler.php?task=decode">Decode</a>
                <a href="/Test/DataScrambler/scrambler.php?task=key">Generate Key</a>

            </p>
        </div>
    </div>
    <div class="row">
        <div class="column column-60 column-offset-20">
            <form method = "POST" action="scrambler.php<?php if('decode' == $task){echo "?task=decode";} ?>">
                <label for="key">Key</label>
                <input type="text" name="key" id="key" <?php displayKey($key) ?> >

                <label for="data">Data</label>
                <textarea name="data" id="data" cols="30" rows="10"><?php if(isset($_POST['data'])){echo $_POST['data'];} ?></textarea>

                <label for="result">Result</label>
                <textarea name="result" id="result" cols="30" rows="10"><?php echo $scrambledData; ?></textarea>

                <button>Do It For Me</button>
            </form>
        </div>
    </div>
</div>
    
</body>
</html>