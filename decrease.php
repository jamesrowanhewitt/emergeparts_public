<?php


include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the part ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be decreased
    $stmt = $pdo->prepare('SELECT * FROM parts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $part = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$part) {
        exit('Part doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, increase record
            $stmt = $pdo->prepare('UPDATE parts SET quantity = quantity - 1 WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = '<div class="alert alert-success" role="alert">You have decreased quantity by 1!</div><a href="home.php" class="btn btn-success btn-lg">Search</a>';
            header('Location: home.php');
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: home.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>

<?=template_header('Decrease Part')?>

<br>
	<h1>Decrease quantity? 
        <div class="text-white bg-dark"><?=$part['partnumber']?></div></h1> 
        <h1>Quantity <div class="text-white bg-dark"><?=$part['quantity']?></div></h1> 
        <h1>Location <div class="text-white bg-dark"><?=$part['binlocation']?></div></h1> 
        <br>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">Are you sure you want to decrease quantity of <?=$part['partnumber']?>? This will remove 1 quantity</div>
        <a href="decrease.php?id=<?=$part['id']?>&confirm=yes" class="btn btn-danger btn-lg">Yes - DECREASE 1 quantity</a>
        <a href="home.php" class="btn btn-success btn-lg">No I will go back</a>


    <?php endif; ?>


<?=template_footer()?>