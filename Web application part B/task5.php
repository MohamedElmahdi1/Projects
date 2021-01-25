<style>
table, td, th {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  width: 40%;
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
   $sql = "SELECT cid, name, AVG(mark) AS avg_mark
   FROM Grade g JOIN Assessment a ON g.aid = a.aid GROUP BY cid, name
   ORDER BY cid, name";
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
   
   // Printing out the course details in the array results
?>
   <h2>the course ID, the name and average mark of each assessment.</h2>


<table>
<tr>
    <th>Course ID</th>
    <th>Assessment Name</th>
    <th>Average mark</th>
</tr>
<?php foreach ($results as $row): ?>
    <tr>
      <td><?php echo $row['cid']?></td>
      <td><?php echo $row['name']?></td>
      <td><?php echo $row['avg_mark']?></td>
    </tr>
<?php endforeach; ?>
	
</table>