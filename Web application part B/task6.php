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
   $sql = "SELECT * FROM Student";
	
   $query = $dbhandle->prepare($sql);

   if ( $query->execute() === FALSE ) {
      die('Error Running Query: ' . implode($query->errorInfo(),' ')); 
   }
		
   // Put the results into a nice big associative array
   $results = $query->fetchAll();
	
   
?>
   <h2>Student Data System </h2>
   
   <form action="task7.php" method="get">
 
  <label for="student">Choose a student:</label>
  <select id="sid" name="sid">
  <?php foreach ($results as $row): 
  $sid= $row['sid'];
  $forename= $row['forname'];
  $surnmae= $row['surname'];
  $gender= $row['gender'];
  echo "<option value='$sid'>".$sid.": ".$forename." ".$surnmae."gender: ".$gender."</option>"
  ?>
  <?php endforeach; ?>
  </select>
  <input type="submit">
</form>
