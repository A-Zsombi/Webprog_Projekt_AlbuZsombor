
<?php

    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

 ?>
    <div class="p-3 mb-2 bg-light text-dark">
    <div class="row" style="text-align:center;">
    <div class="w-95 mx-auto">
    
    
    
    <h1 class="p-3 mb-2 bg-secondary text-white">Dashboard</h1>
    <br><br><br>
        




    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
	 
	   <canvas id="myChart1" style="max-width:800px;margin:auto"></canvas>
       
  
      <?php foreach ($data1 as $row1): $row1= (array) $row1; array_map('htmlentities', $row1); ?>
			 <?php foreach ($data2 as $row2): $row2= (array) $row2; array_map('htmlentities', $row2); ?>
			  <?php foreach ($data3 as $row3): $row3= (array) $row3; array_map('htmlentities', $row3); ?>
			  
		
		
		
	<script>
var xValues = ["Kész", "Befejezetlen", "Folyamatban"];
var yValues = [<?php echo $row1["COUNT(projects.id)"]; ?>, 
			   <?php echo $row2["COUNT(projects.id)"]; ?>,
			   <?php echo $row3["COUNT(projects.id)"]; ?>];
			  
			   
var barColors = [
  "green",
  "#e30505",
  "#427dd4"
];

new Chart("myChart1", {
  type: "doughnut",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "All Projects by stages"
    }
  }
});
</script>	
		 
			   <?php endforeach; ?>
			  <?php endforeach; ?>
			 <?php endforeach; ?>
		
                        
	
      




       <br><br><br><br>
         
         <?php foreach ($data as $row): $row= (array) $row; array_map('htmlentities', $row); ?> 
            <h3>The Sum of all project values:</h3>
              <h2><?php echo "$ " . $row["SUM(value)"]; ?></h2>
         <?php endforeach; ?>
                  
           
         <br><br><br>

      
      <?php foreach ($data4 as $row): $row= (array) $row; array_map('htmlentities', $row); ?> 
         <h3>The Average project values:</h3>
           <h2><?php echo "$ " . $row["AVG(value)"]; ?></h2>
      <?php endforeach; ?>
      <br><br>




		
    </div></div></div> 

<?php 
    require APPROOT . '/views/includes/footer.php';