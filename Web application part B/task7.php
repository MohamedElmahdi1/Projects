<style>
table, td, th {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  width: 80%;
}

th {
  height: 25px;
}
</style>
<?php
   // Connect to database, and print error message if it fails
   try {
      $dbhandle = new PDO('mysql:host=dragon.kent.ac.uk; dbname=co323',
                          'co323', 'h@v3fun');
   } 
   catch (PDOException $e) {
      // The PDO constructor throws an exception if it fails
      die('Error Connecting to Database: ' . $e->getMessage());
   }
   // Run the SQL query, and print error message if it fails.
   $sql1 = 
   "SELECT c.cid, title, name, weighting, mark
   FROM Grade g JOIN Assessment a ON g.aid = a.aid
   JOIN Course c ON a.cid = c.cid 
   WHERE sid = ?";
   
   $sql2 = 
   "SELECT cid, SUM(mark*weighting)/100 AS Final
   FROM Grade g JOIN Assessment a ON g.aid = a.aid
   WHERE sid = ?
   GROUP BY cid;";
   
   $sql = "SELECT forename, surname, gender FROM Student WHERE sid = ?";

   $query = $dbhandle->prepare($sql);
   $query->execute([$_GET['sid']]);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
   
   $query1 = $dbhandle->prepare($sql1);
   $query1->execute([$_GET['sid']]);

   if ( $query1->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query1->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results1 = $query1->fetchAll();


   $query2 = $dbhandle->prepare($sql2);
   $query2->execute([$_GET['sid']]);
   if ( $query2->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query2->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results2 = $query2->fetchAll();
	
   // Printing out the course details in the array results
?>
   <h2>Student details</h2>

   Student ID: <?php echo $_GET["sid"];?>
   <?php foreach ($results as $row): ?>  
   <p id="name"> <?php 
   echo "Name: ".$row['forename']." ".$row['surname']?>
   </p>
   <p id="gender"><?php 
   echo "Gender: ".$row['gender']?>
   </p>
   <?php endforeach; ?>
   
   
   <table>
<tr>
    <th>Course Id</th>
    <th>Title</th>
    <th>Name of Assessment</th>
    <th>Weighting</th>
    <th>Mark</th>
</tr>
<?php foreach ($results1 as $row): ?>
    <tr>
      <td><?php echo $row['cid']?></td>
      <td><?php echo $row['title']?></td>
      <td><?php echo $row['name']?></td>
      <td><?php echo $row['weighting']?>%</td>
      <td><?php echo $row['mark']?></td>
    </tr>
<?php endforeach; ?>
	
</table>
<p> Student's Final results for each course: </p>

   <table>
<tr>
    <th>Course Id</th>
    <th>Final result</th>
</tr>
<?php foreach ($results2 as $row): ?>
    <tr>
      <td><?php echo $row['cid']?></td>
      <td><?php echo $row['Final']?></td>
    </tr>
<?php endforeach; ?>
	
</table>

