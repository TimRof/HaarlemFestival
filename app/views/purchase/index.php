<?php
session_start()
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <title>Haarlem Festival Cart</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
	<meta name="author" content="Jelle de Vries"> 
    <link href="css/Main.css" rel="stylesheet" type="text/css">
    <script src="js/CartScript.js"></script>
</head>
<body>
<section class="NavigationBar">
    <a href="Homepage.php">Home</a>
    <a href="Food_Main.php">Food</a>
    <a href="Jazz_Main.php">Jazz</a>
    <a href="Historic_Main.php">Historic</a>
    <a href="Shopping_Cart.php"><img src="images/"></a>
</section>

<section class="Cart">
    <h1 id="CartTitle">Haarlem Festival Cart</h1>
    <?php
    //Not sure if it is Products but easily replacable 
	if (!empty($_SESSION['Products'])) { ?>

        <table id="CartTable">
            <tr id="TableHead">
                <th>Event</th>
                <th>Product</th>
                <th>Comment</th>
                <th>Price</th>
                <th>Amount</th>
                <th>Total</th>
                <th>Delete</th>
            </tr>

            <?php
            $TotalPrice = 0;
            //Not sure if it is Products but easily replacable 
			foreach ($_SESSION['Products'] as $item) {
                //form to make sure you can delete product from cart
                ?>
                
                    <tr>
                        <td id="TabledataCart"><?php echo $item['EventName']; ?> </td>
                        <td id="Tabledata1"><?php echo $item['ProductName']; ?>
                            <br> <?php echo $timeFormat = date('D d F ', strtotime($item['StartTime'])); ?> </td>
                        <td id="CommentsTable"><?php echo $item['Comment'] ?></td>
                        <td id="TabledataCart">&euro; <?php echo $item ['Price']; ?></td>
                        <td id="Tabledata2">
                            <button name="minusSession" class="minus" type="submit" "
                                    id="minus<?php echo $item['EventID'] ?>">−
                            </button>
                            <input class="input" name="amount" type="number" value="<?php echo $item ['Amount'] ?>"
                                   id="input<?php echo $item['EventID'] ?>"/>
                            <button name="plusSession" class="plus" type="submit"
                                    id="plus<?php echo $item['EventID'] ?>">+
                            </button>

                        </td>
                        <td id="TabledataCart">&euro;<?php echo($item['Amount'] * $item['Price']) ?></td>
                        <?php $TotalPrice += ($item['Amount'] * $item['Price']) ?>
                        <td id="Tabledata2"><button name="deleteSession"><img width="48"height="48" src="images/trash.png"></button>
                    </tr>
                </form>
            <?php }
            ?>
        </table>

        <form class="Payment" action="" method="post" id="Payment">
            <?php $totalamount = number_format($TotalPrice, 2, '.', '') ?>
            <input style="display: none" class="valueAmount" id="amount" name="amount"
                   type="text"
                   value="<?php echo $totalamount ?>"/>
            <table id="Ordertable">
                <tr>
                    <th id="TableHead">Order summary</th>
                    <th id="TableHead"></th>
                </tr>
                <tr>
                    <td id="Tabledata3">Subtotal</td>
                    <td id="Tabledata4">&euro;<?php echo number_format(($totalamount * 0.91), 2, '.', '') ?></td>
                </tr>
                <tr>
                    <td id="Tabledata3">9% Tax</td>
                    <td id="Tabledata4">&euro;<?php echo number_format(($totalamount * 0.09), 2, '.', '') ?></td>
                </tr>
            </table>

            <p id="TotalPrice">Total (incl. Tax): &euro;<?php echo $totalamount ?></p>
            <button id="ProceedButton" form="GoToPayment" id="GoToPayment">
                Proceed to Details
            </button>
        </form>
    <?php } else {
        echo "Add items to your shopping cart and they will be displayed here!!";
    } ?>

</section>
</body>
</html>