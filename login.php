<?php include'inc/header.php'?>
<?php
    if(Session::get("customerLogin") == true){
        header("Location:order.php");
    }
?>
    <div class="main">
        <div class="content">
            <?php
            if(isset($_POST['login'])){
                $userLogin = $customer->fuserLogin($_POST);
            }
            ?>
             <div class="login_panel">
                 <?php
                    if(isset($userLogin)){
                        echo $userLogin;
                    }
                 ?>
                <h3>Existing Customers</h3>
                <p>Sign in with the form below.</p>
                <form action="" method="post" >
                    <input name="email" type="text" placeholder="Enter Email">
                    <input name="pass" type="password" placeholder="Password">
                    <div class="buttons">
                        <div><button class="grey" type="submit" name="login">Login </button></div>
                    </div>
                </form>
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>

             </div>
            <?php
                if(isset($_POST['submit'])){
                    $createUser = $customer->createUser($_POST);
                    }
            ?>

                <div class="register_account">
                    <h3>Register New Account</h3>
                    <?php
                        if(isset($createUser)){
                            echo $createUser;
                        }
                    ?>
                    <form action="" method="post">
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            <input type="text" name="cName" placeholder="Enter Your Name" >
                                        </div>

                                        <div>
                                            <input type="text" name="city" placeholder="Enter Your City" >
                                        </div>

                                        <div>
                                            <input type="text" name="zipCode" placeholder="Enter Your Zip-code" >
                                        </div>
                                        <div>
                                            <input type="text" name="email" placeholder="Enter Your Email" style="width: 95%!important; background: #fff!important; border: 1px solid #111; color: #000;!important; padding: 7px;margin-top:5px" >
                                        </div>
                                    </td>

                                    <td>
                                        <div>
                                            <input type="text" name="address" placeholder="Enter Your Address" >
                                        </div>

                                         <div>
                                            <select id="country" name="country"  class="frm-field required">
                                                <option value="null">Select a Country</option>
                                                <option value="AF">Afghanistan</option>
                                                <option value="BD">Bangladesh</option>
                                            </select>
                                         </div>

                                          <div>
                                              <input type="text" name="phone" placeholder="Enter Your Phone" >
                                          </div>

                                          <div>
                                              <input type="password" name="pass" placeholder="Enter Password"style="width: 95%!important; background: #fff!important; border: 1px solid #111; color: #000;!important; padding: 7px;margin-top:5px">
                                          </div>
                                    </td>
                                 </tr>
                             </tbody>
                        </table>

                           <div class="search">
                               <div><button class="grey" name="submit" type="submit">Create Account</button></div>
                           </div>
                            <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
                            <div class="clear"></div>
                    </form>
                </div>
                        <div class="clear"></div>
        </div>
    </div>



<?php include'inc/footer.php'?>

