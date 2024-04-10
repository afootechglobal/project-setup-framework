<?php if($page=='apply-for-a-job'){?>
<div class="fly-title-div  animated fadeInRight">
<div class="in">
<span id="panel-title"><i class="fa fa-user-plus"></i> Apply For A Job</span>
<div class="close" title="Close" onclick="alert_close();">X</div>
</div>
</div>


<div class="container-back-div sb-container animated fadeInRight" >
   <div class="inner-div">
                <div class="alert alert-success"><span><i class="fa fa-bell-o"></i> NOTE:</span><br />Applicant should fill the form below by providing his/her <span>basic information</span>, <span>contact details</span>, <span>upload passportgraph</span> and <span>curriculum vitae</span></div>
				<?php require_once 'form.php';?>
   </div>
</div>

<?php }?>






<?php if ($view_content=='send_registration_otp'){?>
	<div class="caption-div animated zoomIn">
    		<div  class="title-div">Registration OTP <div class="close" onclick="alert_secondary_close()"><i class="fa fa-close"></i></div></div>
            <div class="div-in animated fadeInRight">
            	<div class="alert alert-success">Hi <strong><?php echo "$surname $othernames"?></strong>, Kindly check your INBOX or SPAM and enter the OTP sent to your email address <span>(<?php echo $email?>)</span> to complete the registration.</div>
            <div class="title">Enter OTP:<span>*</span></div>
            <input type="text" class="text_field" id="otp" placeholder="OTP" title="OTP" />
            	<div class="alert">OTP not recieved? <span id="resend_otp" onclick="_resend_registration_otp('resend_otp','<?php echo $email?>')">RESEND OTP</span></div>
            <button class="btn" type="button"  title="Confirm" id="confirm-btn" onclick="_staff_registration_vet('<?php echo $email?>')"> CONFIRM <i class="fa fa-send"></i></button>
        </div>
    </div>
<?php } ?>



<?php if ($page=='job_application'){?>
<?php
 $user_array=$callclass->_get_staff_detail($conn, $user_id);
 			  $u_array = json_decode($user_array, true);
				$fullname= $u_array[0]['fullname'];
				$job_id=$u_array[0]['job_id'];
				$reg_date= $u_array[0]['reg_date'];
				
					$fetch=$callclass->_get_job_detail($conn, $job_id);
					  $array = json_decode($fetch, true);
						$job_title= $array[0]['job_title'];

?>
                
                <div class="alert alert-success"><span><i class="fa fa-check"></i> Application Submited Successfully!</span></div>
                <div class="title">Application Details:</div>
               	<div class="alert alert-success">
                Application ID: <span><?php echo $user_id;?></span><br />
                Full Name: <span><?php echo $fullname;?></span><br />
                Post: <span><?php echo $job_title;?></span><br />
                </div>
                
                <div class="alert">
                IP Address Used: <span><?php echo $ip_address;?></span><br />
                Date: <span><?php echo $reg_date;?></span><br />
                Kindly check your email for further details. Thanks.
                </div>
                
                     <button class="btn" onclick="alert_close();"> <i class="fa fa-check"></i> OK </button>

<?php } ?>















<?php if($view_content=='product_details_caption'){?>
<?php
$product_id=$ids;
	$query=mysqli_query($conn,"SELECT * FROM product_tab a, stock_tab b WHERE a.product_id=b.product_id AND a.status_id ='A' AND b.selling_price>0 AND a.product_id='$product_id'");
	$fetch=mysqli_fetch_array($query);
		$product_id=$fetch['product_id'];
		$product_desc=$fetch['product_desc'];
		
		$array=$callclass->_get_product_detail($conn, $product_id);
		$get_array = json_decode($array, true);
		$product_cat_id= $get_array[0]['product_cat_id'];
		$product_name= $get_array[0]['product_name'];
		
		$cat_array=$callclass->_get_product_cat_detail($conn, $product_cat_id);
		$get_cat_array = json_decode($cat_array, true);
		$product_cat_name= $get_cat_array[0]['product_cat_name'];
		
		$stock_array=$callclass->_get_stock_detail($conn, $product_id);
		$stock_fetch = json_decode($stock_array, true);
			$selling_price= $stock_fetch[0]['selling_price'];
		
            $pixquery=mysqli_query($conn,"SELECT * FROM product_pix_tab WHERE  product_id='$product_id' ORDER BY RAND() LIMIT 1");
            $pixsel=mysqli_fetch_array($pixquery);
			$product_pix=$pixsel['product_pix'];

		  $product_qty=1;
		  $sub_price=$selling_price;

		$order_que= mysqli_query($conn,"SELECT product_qty FROM add_to_cart_tab WHERE shop_session='$shopsession' AND product_id='$product_id'");
		$order_count=mysqli_num_rows($order_que);
		if($order_count>0){
		$order_sel= mysqli_fetch_array($order_que);
			$product_qty=$order_sel['product_qty'];
			$sub_price=$selling_price*$product_qty;
		}
?>


<div class="caption-div product-caption-div">

		<div class="each-product-details">
            	<div class="inner-div">
                    <div class="product-gallery animated fadeIn">
                        <div class="product-main-pix" id="gallery-big-pix"><img src="uploaded_files/product-pix/<?php echo $product_pix;?>" alt="<?php echo ucwords(strtolower($product_name))?>" /></div>
                        <div class="product-pix-list">
								<?php
                                            $pixquery=mysqli_query($conn,"SELECT * FROM product_pix_tab WHERE  product_id='$product_id'");
                                            while($pixsel=mysqli_fetch_array($pixquery)){
                                            $sn=$pixsel['sn'];
                                            $product_pix=$pixsel['product_pix'];
                                ?>
                            <div class="product-pix" id="img_<?php echo $sn?>" onclick="_view_gallery_img('img_<?php echo $sn?>')"><img src="uploaded_files/product-pix/<?php echo $product_pix;?>" alt="<?php echo ucwords(strtolower($product_name))?>" /></div>
								<?php }?>
                        </div>
                    </div>
                    
                    <div class="product-details-breakdown-div animated fadeIn">
                        <div class="detail-text">
                            <span>PRODUCT CATEGORY:</span><br />
                            <?php echo ucwords(strtolower($product_cat_name))?>
                        </div>
                        <div class="detail-text">
                            <span>PRODUCT NAME:</span><br />
                            <?php echo ucwords(strtolower($product_name))?>
                        </div>
                        <div class="detail-text">
                            <span>PRICE PER UNIT:</span><br />
                            <s>N</s> <?php echo number_format($selling_price,2);?>
                        </div>
                        
                        <div class="qty-div">
                            Qty: <input id="product_qty_<?php echo $product_id?>" type="number" onkeypress="return isNumber(event)" onkeyup="_get_price('<?php echo $product_id;?>','<?php echo $selling_price;?>')"  onchange="_get_price('<?php echo $product_id;?>','<?php echo $selling_price;?>')" class="text_field" value="<?php echo $product_qty;?>"/> 
                            <span><s>N</s></span> <span id="price_<?php echo $product_id?>"><?php echo number_format($sub_price,2);?></span>
                        </div>
                        
                        <div class="btn-div">
                            <button class="btn" id="add-to-cart-btn_<?php echo $product_id?>" onclick="_add_to_cart('<?php echo $product_id?>')"><i class="fa fa-cart-arrow-down"></i> ADD TO CART</button>
                            <button class="btn download" onclick="alert_close()"><i class="fa fa-shopping-basket"></i> CONTINUE SHOPPING</button>
                       </div>                        
                    <?php if ($s_customer_id==''){?>
                    <div class="alert"><a href="account/" title="SIGNUP/LOGIN"><button class="btn">SIGNUP/LOGIN</button></a> to continue. </div>
                    <?php }else{?>
                        <div class="btn-div">
                        <a href="cart" title="Cart Items">
                            <button class="btn payment"> PROCEED TO PAYMENT</button></a>
                       </div>                        
                    <?php }?>
                    </div>
                    <br clear="all" />
            	</div>
            </div>
    </div>

<?php }?>












<?php if ($page=='get_cart_items'){?>
    
    <?php if ($qtycount==0){ /// check qty count?>
    	
        <div class="false-notification-div animated zoomIn">
        		<div class="icon"><i class="fa fa-shopping-basket"></i></div>
                <h2>No Item In Cart</h2>
                <a href="all-products" title="Order FoodStuffs Online">
                <button class="btn download"><i class="fa fa-shopping-basket"></i> CONTINUE SHOPPING</button></a>
        	
        </div>
    
			
		
    <?php }else{ /// else of qty count?>
 
    		<div class="cart-back-div">
        	<div class="cart-items-div">
            	<div class="inner-in">
                
                
<?php
                $user_array=$callclass->_get_user_detail($conn, $s_customer_id);
                $user_array = json_decode($user_array, true);
                $user_wallet_balance= $user_array[0]['wallet_balance'];
                $user_fullname= $user_array[0]['fullname'];
                $user_phone= $user_array[0]['phone'];
                $user_email= $user_array[0]['email'];
               
				//// cart sub_price
				$total_amount_que=mysqli_fetch_array(mysqli_query($conn,"SELECT SUM(sub_price) AS sub_price FROM add_to_cart_tab WHERE shop_session='$shopsession'"));
				$total_amount= $total_amount_que['sub_price'];
				//// cart qty
				  $qtycountque=mysqli_fetch_array(mysqli_query($conn,"SELECT sum(product_qty) AS product_qty FROM add_to_cart_tab WHERE shop_session='$shopsession'"))or die (mysqli_error($conn));
				  $qtycount= $qtycountque['product_qty'];
		  
				$array=$callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
				$fetch = json_decode($array, true);
				$delivery_fee=$fetch[0]['delivery_fee'];

	$no=0;
				$order_que= mysqli_query($conn,"SELECT * FROM add_to_cart_tab WHERE shop_session='$shopsession'");
				while ($order_sel= mysqli_fetch_array($order_que)){
					$no++;
					$product_id=$order_sel['product_id'];
					$product_qty=$order_sel['product_qty'];
					$sub_price=$order_sel['sub_price'];

					$array=$callclass->_get_product_detail($conn, $product_id);
					$get_array = json_decode($array, true);
					$product_cat_id= $get_array[0]['product_cat_id'];
					$product_name= $get_array[0]['product_name'];
					
					$cat_array=$callclass->_get_product_cat_detail($conn, $product_cat_id);
					$get_cat_array = json_decode($cat_array, true);
					$product_cat_name= $get_cat_array[0]['product_cat_name'];
					
					$stock_array=$callclass->_get_stock_detail($conn, $product_id);
					$stock_fetch = json_decode($stock_array, true);
						$selling_price= $stock_fetch[0]['selling_price'];

            $pixquery=mysqli_query($conn,"SELECT * FROM product_pix_tab WHERE product_id='$product_id' ORDER BY RAND() LIMIT 1");
            $pixsel=mysqli_fetch_array($pixquery);
			$product_pix=$pixsel['product_pix'];
?>
                
                    <div class="table-content-div" id="item_<?php echo $product_id;?>">
                        <div class="content-div-in">
                            <div class="title">ITEM <?php echo $no?> <button class="btn red"  onclick="_delete_cart('<?php echo $product_id;?>')" id="delete_<?php echo $product_id;?>"><i class="fa fa-trash"></i> Delete</button> <button class="btn" onclick="_get_form_with_id('product_details_caption','<?php echo $product_id;?>')"><i class="fa fa-edit"></i> Edit</button></div>
        
                            <div class="item-div">
                            	<div class="item-pix-div"><img src="uploaded_files/product-pix/<?php echo $product_pix;?>" alt="<?php echo $product_name;?>" /></div>
                                <div class="item-content-div">
                                        <div class="detail-text">
                                            <span>PRODUCT NAME:</span><br />
                                           <?php echo ucwords(strtolower("$product_cat_name ($product_name)"));?>
                                        </div>
                                        <div class="detail-text">
                                            <span>PRICE PER UNIT:</span><br />
                                             <s>N</s> <?php echo number_format($selling_price,2);?>
                                        </div>
                                         <div class="qty-div">
                                            Qty:  <span><?php echo $product_qty?></span> @ <span><s>N</s> <?php echo number_format($sub_price,2);?></span>
                                        </div>
                                       
                                </div>
                            <br clear="all" />
                            </div>
                       
                        </div>
                    </div>
 <?php } ?>

                </div>
            </div>
            
            <div class="cart-invoice-div">
            	<div class="inner-div">
                     <div class="title-div">CHECKOUT</div>
                	<div class="alert alert-success">
                        <div class="cart-statistics">Order ID: <div class="value"><?php echo $shopsession;?></div><br clear="all" /></div>
                        
                        <div class="cart-statistics">Customer Name: <div class="value"><?php echo $user_fullname;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Email: <div class="value"><?php echo $user_email;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Phone Number: <div class="value"><?php echo $user_phone;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Wallet Balance: <div class="value">NGN <?php echo number_format($user_wallet_balance,2);?></div><br clear="all" /></div>
                        
                        <div class="cart-statistics">Selected Items: <div class="value"><?php echo $qtycount;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Sub Total: <div class="value">NGN <?php echo number_format($total_amount,2);?></div><br clear="all" /></div>
                    </div>

                   
                          
                        <div class="form-title">SELECT LOGISTICS SERVICE:</div>
                        <label> <div class="radio"><input type="radio" name="logistic_id"  value="D" checked="checked"  /><div class="border"></div></div> DELIVERY</label>
                       
                        <div class="form-title">SELECT DELIVERY LOCATION:</div>
                                <select class="text_field selectinput" id="location" onchange="_get_location();">
                                    <option value="">SELECT LOCATION</option>
										<?php
                                            $query=mysqli_query($conn,"SELECT * FROM setup_locations_tab");
                                            while($fetch=mysqli_fetch_array($query)){
                                                    $location_id=$fetch['location_id'];
                                                    $location_name=strtoupper($fetch['location_name']);
                                        ?>
                                        <option value="<?php echo $location_id?>"><?php echo $location_name?></option>
                                        <?php }?>
                            </select>

                            <div id="delivery-area">
                                <div class="form-title">SELECT DELIVERY AREA:</div>
                                <select class="text_field selectinput" id="delivery_area_id" onchange="_get_delivery_area_details()">
                                    <script>_get_delivery_area();</script>
                                </select>
                            </div>
                            
                              <div class="alert" style="display:none" id="delivery-details"><span>NOTE:</span> Our Delivery Service Cost <span id="delivery_area_cost"></span> Within <span>LAGOS</span> AREA ( <span  id="delivery_area_name"></span> )</div>
                           
                            <div id="delivery-div">
                                      
                            <div class="title-div">ADDRESS DETAILS</div>
                                <div class="form-title">HOUSE NUMBER & STREET NAME:</div>
                                <input class="text_field" placeholder="HOUSE NUMBER & STREET NAME" id="house_numb_and_street"/>
                                <div class="segment-div">
                                    <div class="form-title">LANDMARK:</div>
                                    <input class="text_field" placeholder="LANDMARK" id="landmark"/>
                                </div>
                                <div class="segment-div">
                                    <div class="form-title">CITY/TOWN:</div>
                                    <input class="text_field" placeholder="CITY" id="city"/>
                                </div>

                                
                                
                                    
                                <div class="title-div">DELIVERY TIME</div>
                                <div class="alert">
                                    LAGOS: <span>Within 24hrs</span> <br/>
                                    CANADA, USA & LONDON: <span>Within 7 to 10 working days</span>.
                                </div>
                                
                                <div id="delivery-payment">
                                    <div class="alert alert-success">
                                        <div class="form-title">SELECT PAYMENT METHOD:</div>
                                        <select class="text_field selectinput" id="fund_method_id">
                                            <option value="">SELECT PAYMENT METHOD</option>
                                            <?php
                                                $query=mysqli_query($conn,"SELECT * FROM setup_fund_method_tab WHERE fund_method_id IN ('FM001','FM002','FM003')");
                                                while($fetch=mysqli_fetch_array($query)){
                                                    $fund_method_id=$fetch['fund_method_id'];
                                                    $fund_method_name=strtoupper($fetch['fund_method_name']);
                                            ?>
                                            <option value="<?php echo $fund_method_id?>"><?php echo $fund_method_name?></option>
                                            <?php }?>
                                        </select>
                                    </div>

                                    <div class="form-title">PROMO CODE:</div>
                                    <input class="text_field" type="tel" placeholder="PROMO CODE" id="promo_code" onkeypress="return isNumber(event)"/>
                              
                                </div>

                                
                            </div>

				

                    <div class="btn-div">
                        <div class="btn-show-hide" id="btn-proceed-show" >
                            <button class="btn" onclick="_proceed_to_payment('<?php echo $shopsession;?>')" id="payment-btn"><i class="fa fa-long-arrow-right"></i> MAKE PAYMENT</button>
                        </div>
                        <div class="btn-show-hide" id="btn-quote" >
                            <button class="btn"  id="payment-btn" onclick="_get_form_with_id('quote_details')"><i class="fa fa-long-arrow-right"></i> REQUEST A QUOTE</button>
                        </div>
                        <a href="all-products" title="Order FoodStuffs Online">
                        <button class="btn download"><i class="fa fa-shopping-basket"></i> CONTINUE SHOPPING</button></a>
                    </div>
                </div>
           </div>
        <br clear="all" />
        </div>
    
    <?php } /// end of qty count?>

<?php } ?>




<?php if ($view_content=='quote_details'){?>
	<div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
				<div class="img"><img src="all-images/images/delivery-alert.png" /></div>
            <h2>DELIVERY ALERT</h2>
            Kindly, note that <span>export delivery</span> is under review.
             <button class="btn" type="button" onclick="alert_close()"><i class="fa fa-check"></i> Okay, Thanks </button>
        </div>
    </div>
<?php } ?>










<?php if ($page=='user_dashboard'){?>
 <?php include '../config/session-validation.php'?>  
                    <div class="table-content-div">
                        <div class="content-div-in">
                            <div class="title">USER PROFILE <button class="btn red" onClick="document.getElementById('logoutform').submit();"><i class="fa fa-sign-out"></i> LogOut</button> <button class="btn" onClick="_get_form_with_id('user_profile','<?php echo $s_customer_id;?>')"><i class="fa fa-edit"></i> Edit</button></div>
        
                            <div class="user-profile-back-div">
                            	<div class="profile-pix-div"><img src="uploaded_files/user_passport/<?php echo $user_passport;?>" alt="<?php echo ucwords(strtolower($user_fullname))?>" id="passportimg2" /></div>
                                <div class="profile-content-div">
                                    Welcome Back!
                                	<h2><?php echo ucwords(strtolower($user_fullname))?></h2>
                                    <span>Last Login Date</span> | <span><?php echo $user_last_login_date;?></span>
                                </div>
                            <br clear="all" />
                            </div>
                       
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    <div class="table-content-div">
                        <div class="content-div-in">
                            <div class="title">RECENT ORDER HISTORY <a href="order-history" title="View Order History"><button class="btn"><i class="fa fa-eye"></i> View All</button></a></div>
        
<div class="table-div animated fadeIn">

            	<table class="table" cellspacing="0">
                	<tr class="tb-col">
                    	<td>DATE</td>
                    	<td>ORDER ID</td>
                    	<td>ITEMS</td>
                    	<td>(<s>N</s>)AMOUNT</td>
                    	<td>LOGISTICS</td>
                    	<td>ORDER STATUS</td>
                    	<td>PAYMENT METHOD</td>
                    	<td>PAYMENT STATUS</td>
                    </tr>
                    
			<?php
			$no=0;
                $query=mysqli_query($conn,"SELECT * FROM order_summary_tab WHERE user_id ='$s_customer_id' AND status_id IN ('P','PP','PR','RD','DL') ORDER BY date DESC LIMIT 5");
                while($fetch=mysqli_fetch_array($query)){
					$no++;
                    $trans_date=$fetch['date'];
                    $order_id=$fetch['order_id'];
					$nums_of_items=$fetch['nums_of_items'];
                    $order_status_id=$fetch['status_id'];
					
					$query1=mysqli_query($conn,"SELECT * FROM payment_tab WHERE order_id='$order_id'");
					$fetch1=mysqli_fetch_array($query1);
					$pay_id=$fetch1['payment_id'];
					$payment_status_id=$fetch1['status_id'];
				    $fund_method_id= $fetch1['fund_method_id'];
				    $total_amount= $fetch1['total_amount'];
					$logistic_id=$fetch1['logistic_id'];
					
					$status_array=$callclass->_get_setup_status_detail($conn, $order_status_id);
					$status_fetch = json_decode($status_array, true);
					$order_status_name= $status_fetch[0]['status_name'];
					
					$status_array1=$callclass->_get_setup_status_detail($conn, $payment_status_id);
					$status_fetch1 = json_decode($status_array1, true);
					$payment_status_name= $status_fetch1[0]['status_name'];

					  $fm_fetch=$callclass->_get_setup_fund_method_detail($conn, $fund_method_id);
					  $fm_array = json_decode($fm_fetch, true);
					  $fund_method_name= $fm_array[0]['fund_method_name'];
							
					  $fetch2=$callclass->_get_setup_logistics_details($conn, $logistic_id);
					  $array2 = json_decode($fetch2, true);
					  $logistic_name= $array2[0]['logistic_name'];

                    if ($order_status_id=='DL'){$class='success';}elseif($order_status_id=='PP'){$class='pending';}elseif($order_status_id=='PR'){$class='progress';}else{$class='ready';}
                    if ($payment_status_id=='SUC'){$class_='success';}elseif($payment_status_id=='P'){$class_='progress';}else{$class_='failed';}
            ?>
                    
                    
                    
                	<tr>
                    	<td><?php echo $trans_date; ?></td>
                        <?php if($order_status_id=='P'){?>
                    	<td><span onClick="_order_cart_list('<?php echo $order_id; ?>')"><?php echo $order_id; ?></span></td>
                        <?php }else{?>
                    	<td><span onClick="_get_form_with_id('get_order_items','<?php echo $order_id; ?>')"><?php echo $order_id; ?></span></td>
                        <?php }?>
                     	<td><?php echo $nums_of_items; ?></td>
                    	<td><span><s>N</s> <?php echo number_format($total_amount,2); ?></span></td>
                    	<td><?php echo $logistic_name; ?></td>
                    	<td class="<?php echo $class; ?>"><?php echo $order_status_name; ?></td>
                    	<td><?php echo $fund_method_name; ?></td>
                   		<td class="<?php echo $class_; ?>"><?php echo $payment_status_name; ?></td>
                    </tr>
         <?php } ?>           
                 
                    <?php if ($no==0){?>
                	<tr>
                    	<td colspan="20">
                            <div class="alert"><i class="fa fa-bell-o"></i> No record found</div>
                        </td>
                    </tr>
                    <?php } ?>
                </table>

</div>                       
                        </div>
                    </div>                    
                    
                    
                    
                    
                    
                    <div class="table-content-div">
                        <div class="content-div-in">
                            <div class="title">WALLET BALANCE <button class="btn" onClick="_get_form('load_user_wallet')"><i class="fa fa-credit-card"></i> Load Wallet</button></div>
        
                            <div class="wallet-back-div">
                            <div class="wallet-div">
                              <div class="text-div">
                                  <div class="amount">NGN <?php echo number_format($amount_received,2);?></div>
                                  <div class="txt">TOTAL AMOUNT RECEIVED</div>
                              </div>
                            </div>
                            
                            <div class="wallet-div">
                              <div class="text-div">
                                  <div class="amount">NGN<?php echo number_format($amount_withdraw,2);?></div>
                                  <div class="txt">TOTAL AMOUNT SPENT</div>
                              </div>
                            </div>
                            
                            <div class="wallet-div none-border">
                              <div class="text-div">
                                  <div class="amount">NGN <?php echo number_format($user_wallet_balance,2);?></div>
                                  <div class="txt">AVAILABLE BALANCE</div>
                              </div>
                            </div>
                            
                        <br clear="all" />
                        
                        
<div class="title">WALLET TRANSACTIONS <a href="wallet" title="<?php echo $thename?> Wallet History & Balance"><button class="btn"><i class="fa fa-eye"></i> View All</button></a></div>
<div class="table-div animated fadeIn" id="search-content">

            	<table class="table" cellspacing="0">
                	<tr class="tb-col">
                    	<td>DATE</td>
                    	<td>TRANS ID</td>
                    	<td>BALANCE BEFORE</td>
                    	<td>AMOUNT LOADED</td>
                    	<td>BALANCE AFTER</td>
                    	<td>TRANS TYPE</td>
                    	<td>STATUS</td>
                    </tr>
                    
			<?php
			$no=0;
                $query=mysqli_query($conn,"SELECT * FROM user_wallet_tab WHERE user_id ='$s_customer_id' ORDER BY date DESC LIMIT 2");
                while($fetch=mysqli_fetch_array($query)){
					$no++;
                    $trans_date=$fetch['date'];
                    $pay_id=$fetch['pay_id'];
                    $balance_before=$fetch['balance_before'];
                    $amount=$fetch['amount'];
                    $balance_after=$fetch['balance_after'];
                    $transaction_type_id=$fetch['transaction_type_id'];
                    $status_id=$fetch['status_id'];
					
						$trans_array=$callclass->_get_transaction_type_details($conn, $transaction_type_id);
						$trans_fetch = json_decode($trans_array, true);
						$transaction_type_name= $trans_fetch[0]['transaction_type_name'];
						
						$status_array=$callclass->_get_setup_status_detail($conn, $status_id);
						$status_fetch = json_decode($status_array, true);
						$status_name= $status_fetch[0]['status_name'];
						
						if ($status_id=='SUC'){$class='success';}elseif($status_id=='P'){$class='progress';}else{$class='failed';}
            ?>
                        
                	<tr id="<?php echo $pay_id;?>">
                    	<td><?php echo $trans_date; ?></td>
                    	<td><?php echo $pay_id; ?></td>
                        <td><span>NGN <?php echo number_format($balance_before,2); ?></span></td>
                        <td class="<?php echo $class; ?>">NGN <?php echo number_format($amount,2); ?> <?php if($status_id=='P'){?> | <span onClick="_cancel_transaction('<?php echo $pay_id;?>')">CANCEL</span><?php }?> </td>
                        <td><span>NGN <?php echo number_format($balance_after,2); ?></span></td>
                    	<td><?php echo $transaction_type_name; ?></td>
                   		<td class="<?php echo $class; ?>"><?php echo $status_name; ?></td>
                    </tr>
            <?php } ?>
                    <?php if ($no==0){?>
                	<tr>
                    	<td colspan="20">
                            <div class="alert"><i class="fa fa-bell-o"></i> No record found</div>
                        </td>
                    </tr>
                    <?php } ?>
                </table>

</div>                        
                        
                        </div>
                       
                        </div>
                    </div>
  
<?php }?>






<?php if($view_content=='user_profile'){?>
 <?php include '../config/session-validation.php'?>   
<div class="fly-title-div  animated fadeInRight">
<div class="in">
<span id="panel-title"><i class="fa fa-user-circle"></i> UPDATE PROFILE</span>
<div class="close" title="Close" onclick="alert_close();">X</div>
</div>
</div>


<div class="container-back-div sb-container animated fadeInRight" >
   <div class="inner-div">
                	<div class="alert alert-success">
                        <div class="cart">USER ID: <div class="value"><?php echo $s_customer_id?></div><br clear="all" /></div>
                        <div class="cart">LAST LOGIN DATE: <div class="value"><?php echo $user_last_login_date?></div><br clear="all" /></div>
                    </div>
            <div class="detail" id="basic-info">
                  <label>
                  <div class="text-div">
                      <div class="passport-div"><img src="uploaded_files/user_passport/<?php echo $user_passport;?>" alt="<?php echo $user_fullname?>" id="passportimg1"/></div>
                    <input type="file" id="passport" accept=".jpg"  onchange="User.UpdatePreview(this);" style="display:none;"/>
                  </div>
                  </label>

			<div class="text-div">
                    <div class="title"><i class="fa fa-user"></i> FULL NAME:</div>
                    <input class="text_field" placeholder="FULLNAME" id="fullname" value="<?php echo $user_fullname?>"/>
                    <div class="title"><i class="fa fa-phone"></i> PHONE:</div>
                    <input class="text_field" placeholder="PHONE NUMBER" id="phone" value="<?php echo $user_phone?>"/>
                    <div class="title"><i class="fa fa-envelope"></i> EMAIL ADDRESS:</div>
                    <input class="text_field" placeholder="ENTER YOUR EMAIL ADDRESS" readonly="readonly" disabled="disabled" id="email"  value="<?php echo $user_email?>"/>
                    <div class="title"><i class="fa fa-map-maker"></i> HOME ADDRESS:</div>
                    <input class="text_field" placeholder="ENTER YOUR HOME ADDRESS" id="address" value="<?php echo $user_address?>"/>
                    <button class="btn" type="button" id="proceed-btn"  title="UPDATE PROFILE" onclick="_update_user()"> UPDATE PROFILE <i class="fa fa-check"></i></button>
			</div>
            </div>				
   </div>
</div>

<?php }?>



<?php if ($page=='change-user-password-form'){?>
 <?php include '../config/session-validation.php'?>   

                <div class="fly-title-div  animated fadeInRight">
                <div class="in">
                <span id="panel-title"><i class="fa fa-lock"></i> CHANGE PASSWORD</span>
                <div class="close" title="Close" onclick="alert_close();">X</div>
                </div>
                </div>
                <div class="container-back-div sb-container animated fadeInRight" >
                              <div class="inner-div">
                                
                                <div class="alert">Enter the <span>OLD PASSWORD</span> and create your <span>NEW PASSWORD</span></div>
                                
                                   <div class="title">OLD PASSWORD</div>
                                       <input id="oldpass" type="password" class="text_field" placeholder="ENTER OLD PASSWORD" title="OLD PASSWORD"/>
                                   <div class="title">NEW PASSWORD</div>
                                      <input id="newpass" type="password" class="text_field" placeholder="CREATE NEW PASSWORD" title="NEW PASSWORD"/>
                                   <div class="title">CONFIRM NEW PASSWORD</div>
                                      <input id="cnewpass" type="password" class="text_field" placeholder="CONFIRM NEW PASSWORD" title="CONFIRM NEW PASSWORD"/>
                                     <button class="btn" type="button" title="Submit" id="update-user-password-btn" onclick="_update_user_password();"> <i class="fa fa-refresh"></i> CHANGE PASSWORD </button>
                        </div>
                </div>
<?php } ?>


<?php if ($page=='load_user_wallet'){?>
 <?php include '../config/session-validation.php'?>   

	<div class="caption-div animated zoomIn">
    		<div  class="title-div"><i class="fa fa-credit-card"></i> Load Wallet <div class="close" onclick="alert_close()"><i class="fa fa-close"></i></div></div>
            <div class="div-in animated fadeInRight">
            	<div class="alert alert-success">Hi <span><strong><?php echo $user_fullname ?></strong></span>, Kindly enter the amount to load your wallet.</div>
            <div class="title">Enter Amount (NGN):<span>*</span></div>
            <input class="text_field" id="amount" placeholder="0.00" title="Amount" type="number" onkeypress="return isNumber(event)"/>
            <button class="btn" type="button"  title="Confirm"  onclick="_load_user_wallet()" id="load_wallet_btn"> LOAD WALLET</button>
        </div>
    </div>
<?php } ?>

<?php if ($view_content=='load_user_wallet_success'){?>
	<div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
				<div class="img"><img src="all-images/images/success.gif" /></div>
            <h2>TRANSACTION SUCCESSFUL</h2>
            You have successfully fund your wallet.
            <a href="wallet" title="My Wallet">
             <button class="btn" type="button"><i class="fa fa-eye"></i> Go to My Wallet </button></a>
        </div>
    </div>
<?php } ?>



<?php if($view_content=='cancel_transaction'){?>
					<?php
                $query=mysqli_query($conn,"SELECT * FROM user_wallet_tab WHERE pay_id ='$pay_id'");
                $fetch=mysqli_fetch_array($query);
                    $trans_date=$fetch['date'];
                    $pay_id=$fetch['pay_id'];
                    $balance_before=$fetch['balance_before'];
                    $amount=$fetch['amount'];
                    $balance_after=$fetch['balance_after'];
                    $transaction_type_id=$fetch['transaction_type_id'];
                    $status_id=$fetch['status_id'];
					
						$trans_array=$callclass->_get_transaction_type_details($conn, $transaction_type_id);
						$trans_fetch = json_decode($trans_array, true);
						$transaction_type_name= $trans_fetch[0]['transaction_type_name'];
						
						$status_array=$callclass->_get_setup_status_detail($conn, $status_id);
						$status_fetch = json_decode($status_array, true);
						$status_name= $status_fetch[0]['status_name'];
						
						if ($status_id=='SUC'){$class='success';}elseif($status_id=='P'){$class='progress';}else{$class='failed';}
                    ?>
                    	<td><?php echo $trans_date; ?></td>
                    	<td><?php echo $pay_id; ?></td>
                        <td><span>NGN <?php echo number_format($balance_before,2); ?></span></td>
                        <td class="<?php echo $class; ?>">NGN <?php echo number_format($amount,2); ?> <?php if($status_id=='P'){?> | <span onclick="_cancel_transaction('<?php echo $pay_id;?>')">CANCEL</span><?php }?> </td>
                        <td><span>NGN <?php echo number_format($balance_after,2); ?></span></td>
                    	<td><?php echo $transaction_type_name; ?></td>
                   		<td class="<?php echo $class; ?>"><?php echo $status_name; ?></td>
<?php }?>




<?php if ($page=='visitors_login'){?>
	<div class="caption-div animated zoomIn">
        
    		<div  class="title-div"> Log-In <div class="close" onclick="alert_close()"><i class="fa fa-close"></i></div></div>
            <div class="div-in animated fadeInRight">
            <div class="alert alert-success">Hello, kindly login to continue.</div>

            <div class="title">EMAIL ADDRESS:<span>*</span></div>
            <input class="text_field" type="text" id="visitor_username" placeholder="ENTER YOUR EMAIL ADDRESS" title="EMAIL ADDRESS"/>
            <div class="title">PASSWORD:<span>*</span></div>
            <input class="text_field" type="password" id="visitor_password" placeholder="ENETR YOUR PASSWORD" title="ENETR YOUR PASSWORD"/>
           
            <!-- <input name="action" value="login" type="hidden" /> -->
            <button class="btn"   title="Login" id="login-btn" onClick="_visitor_login()"> LOG-IN <i class="fa fa-check"></i></button>
            <div class="alert">I don't have account. <a href="<?php echo $website?>/account/"> <span>SIGN-UP</span> </a></div>
        </div>
    </div>
<?php } ?>





<?php if (($view_content=='order_payment_success')||($page=='order_payment_success')){?>
	<div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
				<div class="img"><img src="all-images/images/success.gif" /></div>
            <h2>TRANSACTION SUCCESSFUL</h2>
            You have successfully paid for the order.
            <a href="order-history" title="View Order History">
            <button class="btn" type="button"><i class="fa fa-eye"></i> View Order History </button></a>
        </div>
    </div>
<?php } ?>



<?php if (($view_content=='order_post_paid_invoice_success')||($page=='order_post_paid_invoice_success')){
	$pay_id=$ids;
		$array=$callclass->_get_payment_detail($conn, $pay_id);
		$fetch = json_decode($array, true);
		$fund_method_id= $fetch[0]['fund_method_id'];
		$total_amount= $fetch[0]['total_amount'];

	  $array=$callclass->_get_setup_backend_settings_detail($conn, 'BK_ID001');
	  $fetch = json_decode($array, true);
	  $bank_name=$fetch[0]['bank_name'];
	  $account_name=$fetch[0]['account_name'];
	  $account_number=$fetch[0]['account_number'];
	?>
    <?php if($fund_method_id=='FM005'){?>
	<div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
            <h2>ORDER SUCCESSFULLY PLACED!</h2>
            Kindly Contact the admin on <strong>+234-(0)705-3879-522</strong> for your <strong>PAY LATER</strong> eligibility.
            <a href="order-history" title="View Order History">
            <button class="btn" type="button"><i class="fa fa-eye"></i> View Order History </button></a>
        </div>
    </div>
	<?php }else{ ?>
        <div class="caption-div caption-success-div animated zoomIn">
            <div class="div-in animated fadeInRight">
                <h2>ORDER SUCCESSFULLY PLACED!</h2>
                Kindly pay the sum of <strong><s>N</s><?php echo number_format($total_amount,2); ?></strong> to the account details below:<br />
                - ACCOUNT NAME: <strong><?php echo $account_name; ?></strong><br />
                - ACCOUNT NUMBER: <strong><?php echo $account_number; ?></strong><br />
                - BANK NAME: <strong><?php echo $bank_name; ?></strong><br />
                Contact the admin on <strong>+234-(0)705-3879-522</strong> for order activation after payment.
                <a href="order-history" title="View Order History">
                <button class="btn" type="button"><i class="fa fa-eye"></i> View Order History </button></a>
            </div>
        </div>
	<?php } ?>
<?php } ?>






<?php if($view_content=='get_order_items'){
	$shopsession=$ids;	
?>
<div class="caption-div order-details-caption animated fadeInUp">
    <div class="title-div"><i class="fa fa-shopping-basket"></i> ORDER DETIALS<div class="close" onclick="alert_close()"><i class="fa fa-close"></i></div></div>

<div class="order-details-caption-div">
	<div class="div-in">

<div class="cart-back-div">
        	<div class="cart-items-div">
            	<div class="inner-in">

<?php
	$no=0;
				$order_que= mysqli_query($conn,"SELECT * FROM add_to_cart_backup_tab WHERE order_id='$shopsession'");
				while ($order_sel= mysqli_fetch_array($order_que)){
					$no++;
					$product_id=$order_sel['product_id'];
					$product_qty=$order_sel['product_qty'];
					$sub_price=$order_sel['sub_price'];

					$array=$callclass->_get_product_detail($conn, $product_id);
					$get_array = json_decode($array, true);
					$product_cat_id= $get_array[0]['product_cat_id'];
					$product_name= $get_array[0]['product_name'];
					
					$cat_array=$callclass->_get_product_cat_detail($conn, $product_cat_id);
					$get_cat_array = json_decode($cat_array, true);
					$product_cat_name= $get_cat_array[0]['product_cat_name'];
					
					$stock_array=$callclass->_get_stock_detail($conn, $product_id);
					$stock_fetch = json_decode($stock_array, true);
					$selling_price= $stock_fetch[0]['selling_price'];

                    $pixquery=mysqli_query($conn,"SELECT * FROM product_pix_tab WHERE product_id='$product_id' ORDER BY RAND() LIMIT 1");
                    $pixsel=mysqli_fetch_array($pixquery);
                    $product_pix=$pixsel['product_pix'];
?>
                
                    <div class="table-content-div" id="item_<?php echo $product_id;?>">
                        <div class="content-div-in">
                            <div class="title">ITEM <?php echo $no?> </div>
        
                            <div class="item-div">
                            	<div class="item-pix-div"><img src="uploaded_files/product-pix/<?php echo $product_pix;?>" alt="<?php echo $product_name;?>" /></div>
                                <div class="item-content-div">
                                        <div class="detail-text">
                                            <span>PRODUCT NAME:</span><br />
                                           <?php echo ucwords(strtolower("$product_cat_name ($product_name)"));?>
                                        </div>
                                        <div class="detail-text">
                                            <span>PRICE PER UNIT:</span><br />
                                             <s>N</s> <?php echo number_format($selling_price,2);?>
                                        </div>
                                         <div class="qty-div">
                                            Qty:  <span><?php echo $product_qty?></span> @ <span><s>N</s> <?php echo number_format($sub_price,2);?></span>
                                        </div>
                                       
                                </div>
                            <br clear="all" />
                            </div>
                       
                        </div>
                    </div>
 <?php } ?>

                </div>
            </div>
            
            <div class="cart-invoice-div">
            	<div class="inner-div">
                
              <?php
				$array=$callclass->_get_order_summary_detail($conn, $shopsession);
				$fetch = json_decode($array, true);
					$user_id= $fetch[0]['user_id'];
					$nums_of_items= $fetch[0]['nums_of_items'];
					$sub_total=$fetch[0]['total_amount'];
					$logistic_id=$fetch[0]['logistic_id'];
					$address=$fetch[0]['address'];
					$delivery_date=$fetch[0]['delivery_date'];
					$delivery_time_id=$fetch[0]['delivery_time_id'];
					$delivery_otp=$fetch[0]['delivery_otp'];
					$order_status_id=$fetch[0]['status_id'];
					$staff_id=$fetch[0]['staff_id'];
					$date=$fetch[0]['date'];
					
					$status_array=$callclass->_get_setup_status_detail($conn, $order_status_id);
					$status_fetch = json_decode($status_array, true);
					$order_status_name= $status_fetch[0]['status_name'];
					
					$array=$callclass->_get_payment_id_for_order($conn, $shopsession);
					$fetch = json_decode($array, true);
					$pay_id= $fetch[0]['pay_id'];
					
					
					$fetch=$callclass->_get_user_detail($conn, $user_id);
					$array = json_decode($fetch, true);
					$fullname= $array[0]['fullname'];
					$email= $array[0]['email'];
					$phone= $array[0]['phone'];
					

                    $fetch=$callclass->_get_setup_logistics_details($conn, $logistic_id);
					$array = json_decode($fetch, true);
					$logistic_name= $array[0]['logistic_name'];
					
					$array=$callclass->_get_payment_detail($conn, $pay_id);
					$fetch = json_decode($array, true);
					$fund_method_id= $fetch[0]['fund_method_id'];
					$delivery_fee= $fetch[0]['delivery_fee'];
					$da_id= $fetch[0]['da_id'];
					$payment_status_id= $fetch[0]['status_id'];
					$total_amount= $fetch[0]['total_amount'];

                    $fetch=$callclass->_get_delivery_area_details($conn, $da_id);
					$array = json_decode($fetch, true);
					$da_name= $array[0]['da_name'];

					
					$fetch=$callclass->_get_setup_delivery_time_details($conn, $delivery_time_id);
					$array = json_decode($fetch, true);
					$delivery_time_desc= $array[0]['delivery_time_desc'];

					$fetch=$callclass->_get_setup_fund_method_detail($conn, $fund_method_id);
					$array = json_decode($fetch, true);
					$fund_method_name= $array[0]['fund_method_name'];
					
					$status_array=$callclass->_get_setup_status_detail($conn, $payment_status_id);
					$status_fetch = json_decode($status_array, true);
					$payment_status_name= $status_fetch[0]['status_name'];
            ?>
                
                

                	<div class="alert alert-success">
                    <span>CUSTOMER DETAILS:</span>
                        <div class="cart-statistics">Customer Name: <div class="value"><?php echo $fullname;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Email: <div class="value"><?php echo $email;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Phone Number: <div class="value"><?php echo $phone;?></div><br clear="all" /></div>
                    </div>

                	<div class="alert alert-success">
                    <span>ORDER DETAILS:</span>
                        <div class="cart-statistics">Order ID: <div class="value"><?php echo $shopsession;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Selected Items: <div class="value"><?php echo $nums_of_items;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Sub Total: <div class="value">NGN <?php echo number_format($sub_total,2);?></div><br clear="all" /></div>
                        <div class="cart-statistics">Order Status: <div class="value"><?php echo $order_status_name;?></div><br clear="all" /></div>
                    </div>

                	<div class="alert alert-success">
                    <span>LOGISTIC DETAILS:</span>
                        <div class="cart-statistics">Logistic Type: <div class="value"><?php echo $logistic_name;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Delivery Fee: <div class="value">NGN <?php echo number_format($delivery_fee,2);?></div><br clear="all" /></div>
                        <div class="cart-statistics">Delivery Area: <div class="value"><?php echo $da_name;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Address: <div class="value"><?php echo $address;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Delivery Date: <div class="value"><?php echo $delivery_date;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Delivery Time: <div class="value"><?php echo $delivery_time_desc;?></div><br clear="all" /></div>
                    </div>
                	<div class="alert alert-success">
                    <span>PAYMENT DETAILS:</span>
                        <div class="cart-statistics">Transaction ID: <div class="value"><?php echo $pay_id;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Total Amount: <div class="value">NGN <?php echo number_format($total_amount,2);?></div><br clear="all" /></div>
                        <div class="cart-statistics">Payment Method: <div class="value"><?php echo $fund_method_name;?></div><br clear="all" /></div>
                        <div class="cart-statistics">Payment Status: <div class="value"><?php echo $payment_status_name;?></div><br clear="all" /></div>
                    </div>
                    
                </div>
           </div>
        <br clear="all" />
        </div>
</div>
</div>

</div>

<?php }?>





<?php if ($view_content=='read_alert'){?>
<div class="fly-title-div  animated fadeInRight">
    <div class="in">
        <span id="panel-title"><i class="fa fa-bell-o"></i> Notification Details</span>
        <div class="close" title="Close" onclick="alert_close();">X</div>
    </div>
</div>
<div class="container-back-div overflow animated fadeInRight" >
    <div class="inner-div">
    
    <?php
		$query=mysqli_query($conn,"SELECT * FROM alert_tab WHERE alert_id='$alert_id'");
		$fetch=mysqli_fetch_array($query);
		$alert_detail = $fetch['alert_detail'];
			$fatch_array=$callclass->_get_alert_detail($conn, $alert_id);
			$array = json_decode($fatch_array, true);
			$userid= $array[0]['user_id'];
			$name= trim(ucwords(strtolower($array[0]['name'])));
			$ipaddress= $array[0]['ipaddress'];
			$computer= $array[0]['computer'];
			$seen_status= $array[0]['seen_status'];
			$date= $array[0]['date'];
		
			mysqli_query($conn,"UPDATE `alert_tab` SET seen_status=1 WHERE alert_id='$alert_id'");
    ?>
    
    <div class="alert">
        User ID: <span><?php echo $userid;?></span><br />
        Action Performed By: <span><?php echo $name;?></span><br />
        IP Address Used: <span><?php echo $ipaddress;?></span><br />
        Computer Used: <span><?php echo $computer;?></span><br />
    </div>
    
    <div class="alert">
        Alert ID: <span><?php echo $alert_id;?></span><br />
        Date: <span><?php echo $date;?></span><br />
    </div>
    
    <div class="title">Alert Details:</div>
    <div class="alert alert-success"><?php echo $alert_detail;?></div>
    
    <button class="btn" onclick="alert_close();"> <i class="fa fa-check"></i> OK </button>
    </div>
</div>

<?php } ?>













<?php if($view_content=='add_news_letter'){?>
	<div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
				<div class="img"><img src="all-images/images/success.gif" /></div>
                <h2>Subscription Successful!</h2>
                Hence, you will recieve our newsletter via your email.
             <button class="btn" type="button"  title="Okay" onclick="alert_close()"><i class="fa fa-check"></i> Okay, Thanks </button>
        </div>
    </div>

<?php }?>




<?php if($view_content=='send_contact_email'){?>
	<div class="caption-div caption-success-div animated zoomIn">
        <div class="div-in animated fadeInRight">
				<div class="img"><img src="all-images/images/email.jpeg" /></div>
                <h2>Mail Sent!</h2>
                We will revert as soon as possible. Thanks.
             <button class="btn" type="button"  title="Okay" onclick="alert_close()"><i class="fa fa-check"></i> Okay, Thanks </button>
        </div>
    </div>

<?php }?>

