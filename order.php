<?php include'inc/header.php' ?>

<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="fspayment">
            <style>
                .fspayment ul li{
                    float: left;
                }
                .fspayment ul li img{
                    margin-left: 20px;
                }

            </style>
            <h2 class="title text-center">Payment System</h2>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="login-form"><!--login form-->
                <p>Select your payment system</p>
                <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST") {

                        header('Location:OrderSuccess.php');
                    }
                ?>

                <form action="order.php" method="post">

                    <ul>
                        <li >
                            <input style="width: 20px; margin: 0;" type="radio" checked value="hand" name="paymentMethod">
                            <img src="images/handCash.jpg" width="200px" height="100px" >
                        </li>
                        <li >
                            <input style="width: 20px; margin: 0;" type="radio" value="bkash" name="paymentMethod">
                            <img src="images/bkash.jpg" width="200px" height="100px" >
                        </li>
                        <li >
                            <input style="width: 20px; margin: 0;" type="radio"  value="master" name="paymentMethod">
                            <img src="images/mas.png" width="200px" height="100px" >
                        </li>
                    </ul><br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <button type="submit" class="btn btn-default">Continue</button>
                </form>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-2"></div>
</div>

<?php include'inc/footer.php'?>
