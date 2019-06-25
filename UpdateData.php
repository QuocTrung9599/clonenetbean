<!DOCTYPE html>
<html>
<body>
<style type="text/css">
    body{
      background: #ADD8E6;
</style>
<h1>UPDATE DATA TO DATABASE</h1>
<form>
         <button type="submit" formaction="index.php">HOME</button>
</form>
<ul>
 <form name="UpdateData" action="UpdateData.php" method="POST" >
<li><strong>Employee ID:</strong></li>  <li><input type="text" name="empid" /></li>
<li><strong>Full name:</strong></li>    <li><input type="text" name="empname" /></li>
<li><strong>empemail:</strong></li><li>    <input type="text" name="empempemail" /></li>
<li><strong>Phone number:</strong></li>    <li><input type="text" name="empphone" /></li>
<li><input type="submit" value="UPDATE" /></li>
</form>
</ul>

<?php
// ini_set('display_errors', 1);
// echo "Update database!";
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

//$sql = 'UPDATE student '
//                . 'SET name = :name, '
//                . 'WHERE ID = :id';
// 
//      $stmt = $pdo->prepare($sql);
//      //bind values to the statement
//        $stmt->bindValue(':name', 'Lee');
//        $stmt->bindValue(':id', 'SV02');
        // update data in the database
//        $stmt->execute();

        // return the number of row affected
        //return $stmt->rowCount();
$sql = "UPDATE employee SET empname = '$_POST[empname]', empemail = '$_POST[empemail]', empphone = '$_POST[empphone]' WHERE empid = '$_POST[empid]'";
      $stmt = $pdo->prepare($sql);
if($stmt->execute() == TRUE){
    echo "Record updated successfully.";
} else {
    echo "Error updating record. ";
}
    
?>
</body>
</html>
