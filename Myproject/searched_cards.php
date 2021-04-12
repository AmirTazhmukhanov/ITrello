<?php
include 'views/db.php';
$arr = Search_Card($_GET['searched_card'],$_GET['searched_card']);

?>
<html>
<?php include 'layout/head.php'?>

<body>
<div class="container">
    <?php include 'layout/navbar.php'?>
    <div class="row">
        <div class="offset-1">
        <?php include 'layout/ban_message.php';?>
        </div>
        <?php if($_SESSION['user']['user_status']=='active'){?>
        <div class="col">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Card name</th>
                    <th>Card text</th>
                    <th>Details</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($arr as $card){?>
                <tr>
                    <td><?php echo $card['id']?></td>
                    <td><?php echo $card['name']?></td>
                    <td><?php echo $card['text']?></td>
                    <td><a href="details.php/?card_id=<?php echo $card['id'] ?>">Details</a></td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php }?>
</div>
<?php include "layout/footer.php";?>
</body>
</html>
