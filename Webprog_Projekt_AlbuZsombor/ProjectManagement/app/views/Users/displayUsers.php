<?php
    require APPROOT . '/views/includes/head.php';
    require APPROOT . '/views/includes/navigation.php';

    if(!isset($_SESSION['user_id'])) : ?>
        <h1>Please Log in first</h1>
    <?php else : ?>
        <div class="container-fluid">
        <br>
        <h1 class="p-3 mb-2 bg-secondary text-white" style="text-align:center">Users in the system</h1>
                   
		
		<input type="text" id="myInput" class="form-control form-control mb-2 mt-5" onkeyup="myFunction()" placeholder=" Search ...">
		
		
	
		
        <?php if (count(json_decode($data)) > 0): ?>
            <table id="myTable" class="table table-hover table-responsive">
                <thead class="thead-inverse">
                    <tr>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(0)">Id</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(1)">Username</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(2)">Telephone</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(3)">Email</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(4)">Date of birth</th>
                    <th onMouseOver="this.style.backgroundColor='#c7c5bf'"  onMouseOut="this.style.backgroundColor='#EDEDED'" style="cursor: pointer;" onclick="sortTable(4)">Type</th>
                    
                    </tr>
                    </thead>
                    <tbody class="bg-light">
            <?php foreach (json_decode($data) as $row): $row= (array) $row; array_map('htmlentities', $row); ?>
                <tr>
              
                  <td><?php echo $row["id"]; ?></td>
             	    <td><?php echo $row["username"]; ?></td>
                 	<td><?php echo $row["telephone"]; ?></td>
                 	<td><?php echo $row["email"]; ?></td>
                	<td><?php echo $row["dateofbirth"]; ?></td>
       	      		<td><?php echo $row["type"]; ?></td>
			          	
                   
                <td> <form action="<?php echo URLROOT . '/users/deleteUserContr'?>" method="post">
                        <input type = "hidden" name = "usersId" value = "<?php echo $row['id']; ?>" />
                        <button type="submit" class="btn btn-outline-danger" >Delete</button>
                    </form>
                </td>
                
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
            
            
            </div>
<?php endif; ?>



            
<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>


<?php 
    endif;
    require APPROOT . '/views/includes/footer.php';