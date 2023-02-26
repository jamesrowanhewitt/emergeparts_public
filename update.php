<?php


include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the part id exists, for example update.php?id=1 will get the part with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $partnumber = isset($_POST['partnumber']) ? $_POST['partnumber'] : '';
        $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
        $binlocation = isset($_POST['binlocation']) ? $_POST['binlocation'] : '';

        // Update the record
        $stmt = $pdo->prepare('UPDATE parts SET id = ?, partnumber = ?, quantity = ?, binlocation = ?  WHERE id = ?');
        $stmt->execute([$id, $partnumber, $quantity, $binlocation, $_GET['id']]);
        $msg = '<div class="alert alert-success" role="alert">Updated Successfully!</div> <a href="home.php" class="btn btn-success btn-lg">Search</a>';
    }
    // Get the part from the parts table
    $stmt = $pdo->prepare('SELECT * FROM parts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $part = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$part) {
        exit('part doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Update Part')?>
    <br>

	<h1>Update part<div class="text-white bg-dark"> <?=$part['partnumber']?></div></h1>
    <h1>Bin Location<div class="text-white bg-dark"> <?=$part['binlocation']?></div></h1>
    <h1>Quantity<div class="text-white bg-dark"> <?=$part['quantity']?></div></h1>
    <br>

    <form action="update.php?id=<?=$part['id']?>" method="post">
        <input type="hidden" name="id" placeholder="1" value="<?=$part['id']?>" id="id">
        <div class="mb-3">
            <label for="partnumber" class="form-label">Part Number</label> 
            <input type="text" name="partnumber" placeholder="WOWZ12313etc" value="<?=$part['partnumber']?>" id="partnumber" class="form-control">
        </div>
        <div class="mb-3">
            <label for="binlocation" class="form-label">Bin Location</label>
            <input type="text" name="binlocation" placeholder="Location of the part" value="<?=$part['binlocation']?>" id="binlocation" class="form-control">
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="text" name="quantity" placeholder="1" value="<?=$part['quantity']?>" id="quantity" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary btn-lg">Update</button>
    </form>


    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>


<?=template_footer()?>