<?php

/**
 * Lab 03, Exercise 2 & 3 — Start File
 * @author Bramus Van Damme <bramus.vandamme@odisee.be>
 */
    // Show all errors (for educational purposes)
        ini_set('error_reporting', E_ALL);

    // Simple func
        function console_log( $data ){
            echo '<script>';
            echo 'console.log('. json_encode( $data ) .')';
            echo '</script>';
        }

    // vars
        $basePath = __DIR__ . DIRECTORY_SEPARATOR . 'images'; // /images
        $baseUrl = 'images'; // images
        $captionsUrl = $baseUrl . DIRECTORY_SEPARATOR . 'captions.txt'; // captions
        $images = array(); // An array which will hold all our images


    // POST all variables
        $descriptionUpl = isset($_POST['description']) ? (string) $_POST['description'] : '';
        $moduleAction = isset($_POST['moduleAction']) ? (string) $_POST['moduleAction'] : '';
        $msg = '';

    // form is sent: perform formchecking!
        if ($moduleAction == 'process') {

            $allOk = true;
            if(! ((isset($_FILES['fileSel']) &&($_FILES['fileSel']['error'] === UPLOAD_ERR_OK)))) {
                $allOk = false;
                $msg = 'Trouble uploading...';
            }elseif (!(in_array((new SplFileInfo($_FILES['fileSel']['name']))->getExtension(), array('jpeg', 'jpg', 'png', 'gif')))){
                $allOk = false;
                $msg = 'Please select a file with a image extension...';
            }

            if($descriptionUpl === ''){
                $allOk = false;
                $msg = 'Please enter a description...';
            }

            if($allOk){
                $i = iterator_count(new FilesystemIterator($baseUrl, FilesystemIterator::SKIP_DOTS)) -1;

                $moved = @move_uploaded_file($_FILES['fileSel']['tmp_name'], $baseUrl . DIRECTORY_SEPARATOR .$i . '.' . (new SplFileInfo($_FILES['fileSel']['name']))->getExtension());

                file_put_contents($captionsUrl,$descriptionUpl . "\n", FILE_APPEND);

                if ($moved) {
                    $msg = 'Success!!';
                } else {
                    $msg = 'Error while saving file in the uploads folder';
                }
            }
        }

	// Main code
        $di = new DirectoryIterator($baseUrl);
        $handle = @fopen($captionsUrl, "r");

        foreach ($di as $file) {
            // exclude . and .. + we don't want directories
            if (!$file->isDot() && !$file->isDir()) {
                if(pathinfo($file, PATHINFO_EXTENSION) === 'jpg')
                    array_push($images,array('url'=>$baseUrl . DIRECTORY_SEPARATOR . $file, 'caption'=>fgetss($handle)));
            }
        }

?><!doctype html>
<html>
<head>
	<title>Images</title>
	<meta charset="utf-8" />
	<style>
        body {
            font-family: "HelveticaNeue-Light", "Helvetica Neue Light", "Helvetica Neue", sans-serif;
            font-weight: 300;
            font-size: 14px;
            line-height: 1.2;
            background: #FCFCFC;
        }

        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        li {
            display:  block;
            width: 310px;
            height: 310px;
            float: left;
            border: 1px solid #ccc;
            margin: 50px 20px;
            position: relative;
            box-shadow: 0 0 20px #CCC;

        }

        li img {
            max-width: 100%;
        }

        li .caption {
            display: block;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 5px;
            color: #000;
            background: rgba(255,255,255,0.9);
            border-top: 1px solid #ccc;
            text-shadow: 1px 1px 1px #fff;
        }

        li:hover {
            box-shadow: 0 0 20px #999;
        }

        fieldset{
            float: left;
            width: 100%;
        }

	</style>
</head>
<body>
<ul>
    <?php
    foreach ($images as $image) {
        echo '<li><img src="' . $image['url'] . '" alt=""><p class:="caption" >' . $image['caption'] . '</p></li>' . PHP_EOL;
    }
    ?>
</ul>
</body>
<form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
<fieldset>

    <h2>Upload a new file:</h2>

    <dl class="clearfix">

        <dt><label for="fileSel">Select a file:</label></dt>
        <dd class="text"><input type="file" id="fileSel" name="fileSel" accept="image/*" class="input-file" /></dd>

        <dt><label for="description">Description:</label></dt>
        <dd class="text"><textarea name="description" id="description" rows="5" cols="40"></textarea></dd>

        <dt class="full clearfix" id="lastrow">
            <input type="hidden" name="moduleAction" value="process" />
            <span class="floatyLeft"><?php echo $msg; ?></span>
            <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit" />
        </dt>

    </dl>

</fieldset>
</form>
</body>
</html>