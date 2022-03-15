<?php $root = $_SERVER["DOCUMENT_ROOT"];
include($root . '/sub/header.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Program</title>
</head>
<body>
<div class="overview">
<div class="container">
<div class="row">
        <div class="col-3">col-4</div>
            <div class="col-9" style="border: 1px solid #e3e3e3; padding: 20px;">
                <?php
                $servername = "mysql";
                $username = "root";
                $password = "secret123";
                $dbname = "haarlemfestival";

                echo "<label>";
                echo "<select name='selectedValue'>";
                echo "<option value='Newest'>Newest</option>";
                echo "<option value='Oldest'>Oldest</option>";
                echo "</select>";
                echo "</label> ";

                $conn = new PDO ("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                switch($_POST['selectedValue']){
                    case 'Newest':
                        $stmt = $conn->prepare("SELECT capacity, date, name, content, price FROM event SORT BY date ASC");
                    break;
                    case 'Oldest':
                        $stmt = $conn->prepare("SELECT capacity, date, name, content, price FROM event SORT BY date DESC");
                    break;     
                    default:
                    $stmt = $conn->prepare("SELECT capacity, date, name, content, price FROM event");
                }
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
             
                foreach($stmt->fetchAll()as $k=>$v) {
                echo "<div class='ticket'><table>";
                echo "<tr>";
                echo "<td class='date'>" .$v['date'] . "</td>"; 
                echo "<td class='capacity'>~" .$v['capacity'] . " Tickets left" . "</td>"; 
                echo "</tr><tr>";
                echo "<td class='name'>" .$v['name'] . "</td>"; 
                echo "</tr><tr>";
                echo "<td class='content'>" .$v['content'] . "</td>"; 
                echo "</tr><tr>";
                echo "<td class='language'>" . "<img src='https://cdn11.bigcommerce.com/s-ey7tq/images/stencil/1280x1280/products/3157/18870/china-flag__01397.1639690364.jpg?c=2'>" . "</td>"; 
                echo "</tr><tr>";
                echo "<td class='price'>€" .$v['price'] . ",-</td>"; 
                echo "<td class='btnBuy'><button class='BuyTicketsBtn'>Buy Tickets</button></td>";
                echo "</table></div>";
                }
                $conn = null;
                ?>
            </div>
        </div>
    </div>
</div>
<?php $root = $_SERVER["DOCUMENT_ROOT"];
include($root . '/sub/footer.php'); ?>

</body>
</html>