<style>
table, td, th {
  border: 1px solid black;
}

table {
  border-collapse: collapse;
  width: 20%;
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
   $sql = "SELECT name, weighting  
   FROM Assessment a JOIN Course c ON a.cid = c.cid
   WHERE title = 'Database systems'
   ORDER BY name ";
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
   
  
?>
   <h2>List the names and weightings of all assessments in the course titled “Database systems”</h2>

<table>
<tr>
    <th>Name</th>
    <th>Weighting</th>
</tr>
<?php foreach ($results as $row): ?>
    <tr>
      <td><?php echo $row['name']?></td>
      <td><?php echo $row['weighting']?>%</td>
    </tr>
<?php endforeach; ?>
	
</table>