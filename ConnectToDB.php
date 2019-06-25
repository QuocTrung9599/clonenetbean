<!DOCTYPE html>
<html>
<body>
<style type="text/css">
    body{
      background: #ADD8E6;
</style>
<h1>VIEW DATABASE </h1>
<form>
         <button type="submit" formaction="index.php">HOME</button>
</form>
<?php
ini_set('display_errors', 1);
echo "ATNs SYSTEM";
?>

<?php


if (empty(getenv("DATABASE_URL"))){
    echo '<p>The database not exist</p>';
    $pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', '123456');
}  else {
     echo '<p>The database exist</p>';
     echo getenv("dbname");
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

$sql = "SELECT * FROM employee ORDER BY empid";
$stmt = $pdo->prepare($sql);
//Thiết lập kiểu dữ liệu trả về
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$stmt->execute();
$resultSet = $stmt->fetchAll();
echo '<p>INFORMATION OF EMPLOYEE:</p>';
foreach ($resultSet as $row) {
	echo $row['empid'];
        echo "    ";
        echo $row['empname'];
        echo "    ";
        echo $row['empemail'];
        echo "    ";
        echo $row['empphone'];
        echo "<br/>";
}

?>
</body>
</html>
