<?php

include 'functions.php';
//  PHP code here.

$con = new PDO("mysql:host=localhost;dbname=nodexlin_db_main",'root','testtest1000');
/*
$query = $con->prepare("SELECT * FROM parts");
$query->execute();
$results = $query->fetchall();
*/

$results = '';

if(isset($_POST["search_part"])) {
	$str = $_POST["search"];
	$query = $con->prepare("SELECT * FROM parts WHERE partnumber LIKE :keyword OR binlocation LIKE :keyword ORDER BY id ASC");
	$query->bindValue(':keyword','%'.$str.'%', PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchall();
	$rows = $query->rowCount();

}

// Home Page template below.
?>

<?=template_header('EmergeParts')?>

<br>
<div class="alert alert-info" role="alert">
  Search by part number or location - To see all parts press Search without any input entered!
</div>
<h2> Search for parts </h2>



		<form method="post">
			<input type="text" class="form-control" name="search" placeholder="Search for parts"> <br>
			<button type="submit" name="search_part" class="btn btn-primary btn-lg">Search</button>
			<a href="create.php" class="btn btn-success btn-lg">Add Part</a>
		</form> 
		
	<br>

<table class="table">
<h2> Parts database</h2>

<tr>
	<th style="width: 35%">Part number</th>
	<th style="width: 20%">Location</th>
    <th style="width: 10%">Quantity</th>
    <th style="width: 25%">Actions</th>
</tr>

<?php 
if (is_array($results) || is_object($results))
{
foreach ($results as $item): 
?>

<tr>
     <td style="width: 35%"><?php echo $item['partnumber'] ?></td>
	 <td style="width: 20%"><?php echo $item['binlocation'] ?></td>
     <td style="width: 10%"><?php echo $item['quantity'] ?></td>
     <td style="width: 25%" class="actions">
                    <a href="update.php?id=<?=$item['id']?>" class="btn btn-info">Update</a>
                    <a href="increase.php?id=<?=$item['id']?>" class="btn btn-success">+</a>
		    <a href="decrease.php?id=<?=$item['id']?>" class="btn btn-danger">-</a>
                    <!-- BUTTON DELETION, REMOVE COMMENTS TAGS TO ENABLE <a href="delete.php?id=<?=$item['id']?>" class="btn btn-danger">Delete</a> -->
    </td>
</tr>

<?php 
endforeach; 
}
?>

</table>



<?=template_footer('EmergeParts')?>
