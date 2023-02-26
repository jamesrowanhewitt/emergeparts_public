<?php



include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    // Check if POST variable "partnumber" exists, if not default the value to blank, basically the same for all variables
    $partnumber = isset($_POST['partnumber']) ? $_POST['partnumber'] : '';
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    $binlocation = isset($_POST['binlocation']) ? $_POST['binlocation'] : '';
    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO parts VALUES (?, ?, ?, ?)');
    $stmt->execute([$id, $partnumber, $quantity, $binlocation,]);
    // Output message
    $msg = '<div class="alert alert-success" role="alert">Part added Successfully!</div><a href="home.php" class="btn btn-primary btn-lg">Return</a>';
}
?>


<?=template_header('Add Part')?>
    <br>
	<h2>Add part to the database</h2>
    <form onkeydown="return event.key != 'Enter'; "action="create.php" method="post">
        <div class="mb-3">
            <label for="partnumber" class="form-label">Part number</label>
            <input type="hidden" name="id" placeholder="26" value="auto" id="id">
            <input type="text" name="partnumber" placeholder="Part number" id="partnumber" class="form-control">
        </div>
        <div class="mb-3">
            <label for="binlocation" class="form-label">Location</label>
            <input type="text" name="binlocation" placeholder="Bin location" id="binlocation" class="form-control">
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="text" name="quantity" placeholder="1" id="Quantity" value="1" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Add part</button>
    </form>


    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>


<?=template_footer()?>