<html>
<head>

</head>
<body>
<?php
strict_types(1);
//error_reporting(-1);
error_reporting(E_ALL);
//ini_set('display_startup_errors',true);
ini_set('display_errors',true);
ini_set('error_reporting',E_ALL);
echo "<p>Begin";
$s=file_get_contents("not_existing_file.txt");

echo "<p>Continue";
$a=1/0;
echo "<p>".$a;
?>

</body>
</html>
