<?php


include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the part ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM parts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $part = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$part) {
        exit('Part doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM parts WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = '<div class="alert alert-success" role="alert">You have deleted the part!</div><a href="home.php" class="btn btn-success btn-lg">Search</a>';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Delete Part')?>

<br>
	<h1>Delete Part? 
        <div class="text-white bg-dark"><?=$part['partnumber']?></div></h1> 
        <h1>Quantity <div class="text-white bg-dark"><?=$part['quantity']?></div></h1> 
        <h1>Location <div class="text-white bg-dark"><?=$part['binlocation']?></div></h1> 
        <br>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">WARNING: Are you sure you want to delete part <?=$part['partnumber']?>? This deletes the WHOLE RECORD including all quantities. Use UPDATE to remove a quantity</div>
        <a href="delete.php?id=<?=$part['id']?>&confirm=yes" class="btn btn-danger btn-lg">Yes - delete this part</a>
        <a href="home.php" class="btn btn-primary btn-lg">No I will keep it</a>


    <?php endif; ?>


<?=template_footer()?>