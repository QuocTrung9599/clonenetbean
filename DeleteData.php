<!DOCTYPE html>
<html>
<body>
<style type="text/css">
    body{
      background: #ADD8E6;
</style>
<h1>DELETE DATA TO DATABASE</h1>
<form>
         <button type="submit" formaction="index.php">HOME</button>
</form>
<ul>
    <form name="DeleteData" action="DeleteData.php" method="POST" >
<li><strong>Employee ID:</strong></li>  <li><input type="text" name="empid" /></li>

<li><input type="submit" value="DELETE" /></li>
</form>
</ul>
<?php
// ini_set('display_errors', 1);
// echo "Insert database!";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The DB does not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     
   $db = parse_url(getenv("DATABASE_URL"));
   $pdo = new PDO("pgsql:" . sprintf(
        "host=ec2-54-83-192-245.compute-1.amazonaws.com;port=5432;user=vcujfzrpxvdtyx;password=6722ff5be8a5a94e3fb874bb728a7f177eacfb70f9317f010e37a7d1e00d9668;dbname=dfu22a679eqmoc",
        $db["host"],
        $db["port"],
        $db["user"],
        $db["pass"],
        ltrim($db["path"], "/")
   ));
}  

$sql = "DELETE FROM employee WHERE empid = '$_POST[empid]'";
$stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record deleted successfully.";
} else {
    echo "Error deleting record: ";
}

?>
</body>
</html>
