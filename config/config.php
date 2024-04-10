<?php
ini_set('session.use_only_cookies', 1); // secure cookie
session_start(); // start session
session_regenerate_id(); // regenerating for security issues

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);



$thename='AgroHandlers'; 
$page = basename($_SERVER['SCRIPT_NAME']);
$website_auto_url =(isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$ip_address=$_SERVER['REMOTE_ADDR']; //ip used
$sysname=gethostname();//computer used
/////////////////////////////////////////////////////////////////

$website_url='http://localhost/agrohandlers.com';
//$website='https://www.agrohandlers.com';

?>










































<?php
class allClass{
/////////////////////////////////////////
function _get_setup_backend_settings_detail($conn, $backend_setting_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_backend_settings_tab WHERE backend_setting_id='$backend_setting_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$smtp_host=$fetch['smtp_host'];
		$smtp_username=$fetch['smtp_username'];
		$smtp_password=$fetch['smtp_password'];
		$smtp_port=$fetch['smtp_port'];
		$sender_name=$fetch['sender_name'];
		$support_email=$fetch['support_email'];
		$promo_code=$fetch['promo_code'];
		$promo_amount_limit=$fetch['promo_amount_limit'];
		$delivery_fee=$fetch['delivery_fee'];
		$bank_name=$fetch['bank_name'];
		$account_name=$fetch['account_name'];
		$account_number=$fetch['account_number'];
		$payment_key=$fetch['payment_key'];
		return '[{"smtp_host":"'.$smtp_host.'","smtp_username":"'.$smtp_username.'","smtp_password":"'.$smtp_password.'",
		"smtp_port":"'.$smtp_port.'","sender_name":"'.$sender_name.'","support_email":"'.$support_email.'","promo_code":"'.$promo_code.'","promo_amount_limit":"'.$promo_amount_limit.'","delivery_fee":"'.$delivery_fee.'","bank_name":"'.$bank_name.'","account_name":"'.$account_name.'",
		"account_number":"'.$account_number.'","payment_key":"'.$payment_key.'"}]';
}
	
/////////////////////////////////////////
function _get_sequence_count($conn, $item){
		 $count=mysqli_fetch_array(mysqli_query($conn,"SELECT mast_val FROM setup_masters_tab WHERE mast_id = '$item' FOR UPDATE"));
		  $num=$count[0]+1;
		  mysqli_query($conn,"UPDATE `setup_masters_tab` SET `mast_val` = '$num' WHERE mast_id = '$item'")or die (mysqli_error($conn));
		  if ($num<10){$no='00'.$num;}elseif($num>=10 && $num<100){$no='0'.$num;}else{$no=$num;}
		  return '[{"num":"'.$num.'","no":"'.$no.'"}]';
}
/////////////////////////////////////////
function _alert_sequence_and_update($conn,$alert_detail,$user_id,$user_name,$ip_address,$sysname,$role_id){
		$alertsele=mysqli_fetch_array(mysqli_query($conn,"SELECT mast_val FROM setup_masters_tab WHERE mast_id = 'ALT' FOR UPDATE"));
		$alertno=$alertsele[0]+1;
		$alertid='ALT'.$alertno;
		
		mysqli_query($conn,"INSERT INTO `alert_tab`
		(`alert_id`, `alert_detail`, `user_id`, `name`, `ipaddress`, `computer`, `role_id`, `seen_status`, `date`) VALUES
		('$alertid', '$alert_detail', '$user_id', '$user_name', '$ip_address', '$sysname', '$role_id', 0, NOW())")or die (mysqli_error($conn));
		
		mysqli_query($conn,"UPDATE setup_masters_tab SET mast_val='$alertno' WHERE mast_id = 'ALT'")or die (mysqli_error($conn));
}
	
/////////////////////////////////////////
function _get_setup_role_detail($conn, $role_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_role_tab WHERE role_id = '$role_id'");
	$fetch=mysqli_fetch_array($query);
		$role_name=$fetch['role_name'];
	return '[{"role_name":"'.$role_name.'"}]';
}
/////////////////////////////////////////
function _get_setup_status_detail($conn, $status_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_status_tab WHERE status_id='$status_id'");
	$fetch=mysqli_fetch_array($query);
		$status_name=$fetch['status_name'];
	return '[{"status_name":"'.$status_name.'"}]';
}

/////////////////////////////////////////
function _get_setup_fund_method_detail($conn, $fund_method_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_fund_method_tab WHERE fund_method_id='$fund_method_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$fund_method_name=$fetch['fund_method_name'];
	return '[{"fund_method_name":"'.$fund_method_name.'"}]';
}
/////////////////////////////////////////
function _get_setup_payment_purpose_detail($conn, $payment_purpose_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_payment_purpose_tab WHERE payment_purpose_id='$payment_purpose_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$payment_purpose_name=$fetch['payment_purpose_name'];
	return '[{"payment_purpose_name":"'.$payment_purpose_name.'"}]';
}
function _get_setup_category_detail($conn, $cat_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_categories_tab WHERE cat_id='$cat_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$cat_id=$fetch['cat_id'];
		$cat_name=$fetch['cat_desc'];
	return '[{"cat_id":"'.$cat_id.'","cat_name":"'.$cat_name.'"}]';
}
function _get_transaction_type_details($conn, $transaction_type_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_transaction_type_tab WHERE transaction_type_id='$transaction_type_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$transaction_type_name=$fetch['transaction_type_name'];
	return '[{"transaction_type_name":"'.$transaction_type_name.'"}]';
}
function _get_setup_logistics_details($conn, $logistic_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_logistics_tab WHERE logistic_id='$logistic_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$logistic_name=$fetch['logistic_name'];
	return '[{"logistic_name":"'.$logistic_name.'"}]';
}
function _get_setup_delivery_time_details($conn, $delivery_time_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_delivery_time_tab WHERE delivery_time_id='$delivery_time_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$delivery_time_desc=$fetch['delivery_time_desc'];
	return '[{"delivery_time_desc":"'.$delivery_time_desc.'"}]';
}











	
//////////////////////////////////////////////////////////////////////////////////////////////////////
function _get_staff_detail($conn, $user_id){
	$query=mysqli_query($conn,"SELECT * FROM staff_tab WHERE user_id='$user_id'")or die ('cannot select staff_tab');
$users_sel=mysqli_fetch_array($query);
	$user_id=$users_sel['user_id'];
	$surname=$users_sel['surname'];
	$othernames=$users_sel['othernames'];
	$fullname="$surname $othernames";
	$dob=$users_sel['dob'];
	$gender=$users_sel['gender'];
	$religion=$users_sel['religion'];
	$nationality=$users_sel['nationality'];
	$state=$users_sel['state'];
	$lga=$users_sel['lga'];
	$address=$users_sel['address'];
	$mobile=$users_sel['mobile'];
	$email=$users_sel['email'];
	$passport=$users_sel['passport'];
	if ($passport==''){
		$passport='friends.png';
	}
	$cv_file=$users_sel['cv_file'];
	$otp=$users_sel['otp'];
	$job_id=$users_sel['job_id'];
	$branch_id=$users_sel['branch_id'];
	$role_id=$users_sel['role_id'];
	$status_id=$users_sel['status_id'];
	$reg_date=$users_sel['reg_date'];
	$last_login=$users_sel['last_login'];
	
return '[{"user_id":"'.$user_id.'","surname":"'.$surname.'","othernames":"'.$othernames.'","fullname":"'.$fullname.'","dob":"'.$dob.'",
"gender":"'.$gender.'","religion":"'.$religion.'","nationality":"'.$nationality.'","state":"'.$state.'","lga":"'.$lga.'","address":"'.$address.'",
"mobile":"'.$mobile.'","email":"'.$email.'","passport":"'.$passport.'","cv_file":"'.$cv_file.'","otp":"'.$otp.'","job_id":"'.$job_id.'",
"branch_id":"'.$branch_id.'","role_id":"'.$role_id.'","status_id":"'.$status_id.'","reg_date":"'.$reg_date.'","last_login":"'.$last_login.'"}]';
}	

/////////////////////////////////////////
function _get_blog_detail($conn, $blog_id){
	$query=mysqli_query($conn,"SELECT * FROM blog_tab WHERE blog_id='$blog_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$blog_id=$fetch['blog_id'];
		$blog_cat_id=$fetch['cat_id'];
		$blog_title=$fetch['blog_title'];
		$blog_url =$fetch['blog_url'];
		$seo_keywords=$fetch['seo_keywords'];
		$status_id=$fetch['status_id'];
		$blog_pix=$fetch['blog_pix'];
		if ($blog_pix==''){
			$blog_pix='blog.jpg';
		}
		$user_id=$fetch['user_id'];
		$blog_views=$fetch['views'];
		$blog_reg_date=$fetch['reg_date'];
		$blog_last_updated=$fetch['last_updated'];
		
	return '[{"blog_id":"'.$blog_id.'","blog_cat_id":"'.$blog_cat_id.'",
		"blog_title":"'.$blog_title.'","blog_url":"'.$blog_url.'","seo_keywords":"'.$seo_keywords.'","status_id":"'.$status_id.'",
		"blog_pix":"'.$blog_pix.'","user_id":"'.$user_id.'","blog_views":"'.$blog_views.'","blog_reg_date":"'.$blog_reg_date.'","blog_last_updated":"'.$blog_last_updated.'"}]';
}	


function _get_delivery_area_details($conn, $da_id){
	$query=mysqli_query($conn,"SELECT * FROM setup_delivery_area_tab WHERE da_id='$da_id'")or die ('cannot select job_tab');
	$fetch=mysqli_fetch_array($query);
	$da_id=$fetch['da_id'];
	$da_name=$fetch['da_name'];
	$da_cost=$fetch['da_cost'];
	return '[{"da_id":"'.$da_id.'","da_name":"'.$da_name.'","da_cost":"'.$da_cost.'"}]';
}


	////////////////////////////////	
function _get_job_detail($conn, $job_id){
	$query=mysqli_query($conn,"SELECT * FROM job_tab WHERE job_id='$job_id'")or die ('cannot select job_tab');
	$fetch=mysqli_fetch_array($query);
		$job_id=$fetch['job_id'];
		$job_title=$fetch['title'];
		$job_status_id=$fetch['status_id'];
		$user_id=$fetch['user_id'];
		$job_date_of_reg=$fetch['date_of_reg'];
		$job_last_updated=$fetch['last_updated'];
	return '[{"job_id":"'.$job_id.'","job_title":"'.$job_title.'","job_status_id":"'.$job_status_id.'","user_id":"'.$user_id.'","job_date_of_reg":"'.$job_date_of_reg.'","job_last_updated":"'.$job_last_updated.'"}]';
}

////////////////////////////////		
function _admin_title_pane($user_name){?>
	  <div class="page-title-div dashbord-title animated fadeInDown animated animated">
	  <div class="div-in">
		  <div class="left-div">
			  <span id="page-title"><i class="fa fa-dashboard"></i> Admin Dashboard</span><br />
			  <div class="project-name"><?php echo ucwords(strtolower($user_name)); ?></div>
		  </div>
		  <div class="right-div">
			  Current Time<br />
			  <?php $this->_dateTimeText();?>
			  <?php echo date("l, d F Y");?>
		  </div>
	  </div>
	  </div>
	  
<?php }
////////////////////////////////		
function _dateTimeText(){?>
				<div class="datetime">
				 <span id="clock"><span id="digitalclock" class="styling"></span></span>
				</div>
<?php }



function _get_product_cat_detail($conn, $product_cat_id){
	$query=mysqli_query($conn,"SELECT * FROM product_categories_tab WHERE product_cat_id='$product_cat_id'")or die ('cannot select product_categories_tab');
	$fetch=mysqli_fetch_array($query);
		$product_cat_name=$fetch['product_cat_name'];
		$status_id=$fetch['status_id'];
		$date=$fetch['date'];
	return '[{"product_cat_name":"'.$product_cat_name.'","status_id":"'.$status_id.'","date":"'.$date.'"}]';
}
function _get_product_detail($conn, $product_id){
	$query=mysqli_query($conn,"SELECT * FROM product_tab WHERE product_id='$product_id'")or die ('cannot select product_tab');
	$fetch=mysqli_fetch_array($query);
		$product_cat_id=$fetch['product_cat_id'];
		$product_name=$fetch['product_name'];
		$status_id=$fetch['status_id'];
		$date=$fetch['date'];
	return '[{"product_cat_id":"'.$product_cat_id.'","product_name":"'.$product_name.'","status_id":"'.$status_id.'","date":"'.$date.'"}]';
}


function _get_stock_detail($conn, $product_id){
	$query=mysqli_query($conn,"SELECT * FROM stock_tab WHERE product_id='$product_id'")or die ('cannot select product_tab');
	$fetch=mysqli_fetch_array($query);
		$purchase_price=$fetch['purchase_price'];
		$selling_price=$fetch['selling_price'];
		$profit=$fetch['profit'];
		$available_qty=$fetch['available_qty'];
		$outstanding_qty=$fetch['outstanding_qty'];
	return '[{"purchase_price":"'.$purchase_price.'","selling_price":"'.$selling_price.'","profit":"'.$profit.'","available_qty":"'.$available_qty.'","outstanding_qty":"'.$outstanding_qty.'"}]';
}

/////////////////////////////////////		
function _get_alert_detail($conn, $alert_id){
			$query=mysqli_query($conn,"SELECT * FROM alert_tab WHERE alert_id='$alert_id'");
			$fetch = mysqli_fetch_array($query); 
			$user_id = $fetch['user_id'];
			$name = $fetch['name'];
			$ipaddress = $fetch['ipaddress'];
			$computer = $fetch['computer'];
			$seen_status = $fetch['seen_status'];
			$date = $fetch['date'];
			return '[{"user_id":"'.$user_id.'", "name":"'.$name.'", "ipaddress":"'.$ipaddress.'", "computer":"'.$computer.'", "seen_status":"'.$seen_status.'", "date":"'.$date.'"}]';
}

/////////////////////////////////////////
function _get_user_detail($conn, $user_id){
	$query=mysqli_query($conn,"SELECT * FROM user_tab WHERE user_id='$user_id'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
			$user_id=$fetch['user_id'];
			$wallet_balance=$fetch['wallet_balance'];
			$fullname=$fetch['fullname'];
			$phone=$fetch['phone'];
			$email=$fetch['email'];
			$address=$fetch['address'];
			$passport=$fetch['passport'];
			if ($passport==''){
				$passport='friends.png';
			}
			$otp=$fetch['otp'];
			$status_id=$fetch['status_id'];
			$last_login_date=$fetch['last_login_date'];
	return '[{"user_id":"'.$user_id.'","wallet_balance":"'.$wallet_balance.'","fullname":"'.$fullname.'","phone":"'.$phone.'","email":"'.$email.'","address":"'.$address.'","passport":"'.$passport.'","otp":"'.$otp.'", "status_id":"'.$status_id.'", "last_login_date":"'.$last_login_date.'"}]';
}	




///////////////////////////////////////////////////////////////////////////////////////////////////		
function _get_all_product_categories($conn){
			
                $query=mysqli_query($conn,"SELECT * FROM product_categories_tab WHERE status_id ='A' ORDER BY date DESC");
                $no=0;
                while($fetch=mysqli_fetch_array($query)){
                    $no++;
                    $product_cat_id=$fetch['product_cat_id'];
                    
                    $array=$this->_get_product_cat_detail($conn, $product_cat_id);
                    $get_array = json_decode($array, true);
                    $product_cat_name= $get_array[0]['product_cat_name'];
           
		    $pixquery=mysqli_query($conn,"SELECT * FROM product_categories_pix_tab WHERE  product_cat_id='$product_cat_id' ORDER BY RAND() LIMIT 1");
            $pixsel=mysqli_fetch_array($pixquery);
			$product_pix=$pixsel['product_pix'];
            ?>
                    
                        <a href="products?prc=<?php echo $product_cat_id; ?>" title="<?php echo ucwords(strtolower($product_cat_name)); ?>">
                        <div class="product-categories">
                            <div class="img"><img src="uploaded_files/product-cat-pix/<?php echo $product_pix; ?>" alt="<?php echo $product_cat_name; ?>" /></div>
                            <div class="text-div">
                                <h2><?php echo ucwords(strtolower($product_cat_name)); ?></h2>
                            </div>
                        </div>
                        </a>
            <?php } ?>
                    
               <br clear="all" />
              <?php if ($no==0){?>
                  <div class="false-notification-div">
                      <p>NO RECORD FOUND!</p>
                  </div>               
              <?php } ?>

<?php }
///////////////////////////////////////////////////////////////////////////////////////////////////		
function _get_all_user_link($conn,$page){?>

                    <div class="title-div">USER LINKS</div>
                    <a href="user-dashboard" title="<?php echo $thename?> User Dashboard">
                      <li <?php if (($page=='user-dashboard.php')) {?> class="active-li"<?php }?>><i class="fa fa-dashboard"></i> Dashboard</li></a>
                      <a href="order-history" title="View Order History">
                      <li <?php if (($page=='order-history.php')) {?> class="active-li"<?php }?>><i class="fa fa-clock-o"></i> Order History</li></a>
                      <a href="wallet" title="<?php echo $thename?> Wallet History & Balance">
                      <li <?php if (($page=='wallet.php')) {?> class="active-li"<?php }?>><i class="fa fa-credit-card"></i> Wallet History</li></a>
                      <a href="notifications" title="<?php echo $thename?> Notifications">
                      <li <?php if (($page=='notifications.php')) {?> class="active-li"<?php }?>><i class="fa fa-bell-o"></i> Notifications</li></a>
                      <li onClick="_get_form('change-user-password-form')"><i class="fa fa-lock"></i> Change Password</li>
                      <li onclick="document.getElementById('logoutform').submit();"><i class="fa fa-sign-out"></i> LogOut</li>

<?php }
///////////////////////////////////////////////////////////////////////////////////////////////////		


/////////////////////////////////////////
function _get_user_wallet_detail($conn, $user_id){
	/////// credit 
	$query=mysqli_query($conn,"SELECT  COALESCE (SUM(amount),0) AS amount_received  FROM user_wallet_tab WHERE user_id='$user_id' AND transaction_type_id='CR' AND status_id='SUC'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
		$amount_received=$fetch['amount_received'];
	/////// debit 
	$query=mysqli_query($conn,"SELECT  COALESCE (SUM(amount),0) AS amount_withdraw  FROM user_wallet_tab WHERE user_id='$user_id' AND transaction_type_id='DB'  AND status_id='SUC'")or die (mysqli_error($conn));
	$fetch=mysqli_fetch_array($query);
	$amount_withdraw=$fetch['amount_withdraw'];

	return '[{"amount_received":"'.$amount_received.'","amount_withdraw":"'.$amount_withdraw.'"}]';
}	




function _get_order_summary_detail($conn, $order_id){
	$query=mysqli_query($conn,"SELECT * FROM order_summary_tab WHERE order_id='$order_id'")or die ('cannot select order_summary_tab');
	$fetch=mysqli_fetch_array($query);
		$user_id=$fetch['user_id'];
		$nums_of_items=$fetch['nums_of_items'];
		$total_amount=$fetch['total_amount'];
		$logistic_id=$fetch['logistic_id'];
		$address=$fetch['address'];
		$delivery_date=$fetch['delivery_date'];
		$delivery_time_id=$fetch['delivery_time_id'];
		$delivery_otp=$fetch['delivery_otp'];
		$status_id=$fetch['status_id'];
		$staff_id=$fetch['staff_id'];
		$delivery_staff_id=$fetch['delivery_staff_id'];
		$date=$fetch['date'];
	return '[{"user_id":"'.$user_id.'","nums_of_items":"'.$nums_of_items.'","total_amount":"'.$total_amount.'","logistic_id":"'.$logistic_id.'",
	"address":"'.$address.'","delivery_date":"'.$delivery_date.'","delivery_time_id":"'.$delivery_time_id.'","delivery_otp":"'.$delivery_otp.'","status_id":"'.$status_id.'",
	"staff_id":"'.$staff_id.'","delivery_staff_id":"'.$delivery_staff_id.'","date":"'.$date.'"}]';
}

function _get_payment_detail($conn, $payment_id){
	$query=mysqli_query($conn,"SELECT * FROM payment_tab WHERE payment_id='$payment_id'")or die ('cannot select payment_tab');
	$fetch=mysqli_fetch_array($query);
		$user_id=$fetch['user_id'];
		$payment_gateway_id=$fetch['payment_gateway_id'];
		$order_id=$fetch['order_id'];
		$fund_method_id=$fetch['fund_method_id'];
		$sub_amount=$fetch['sub_amount'];
		$logistic_id=$fetch['logistic_id'];
		$delivery_fee=$fetch['delivery_fee'];
		$total_amount=$fetch['total_amount'];
		$status_id=$fetch['status_id'];
		$staff_id=$fetch['staff_id'];
		$date=$fetch['date'];
	return '[{"user_id":"'.$user_id.'","payment_gateway_id":"'.$payment_gateway_id.'","order_id":"'.$order_id.'","fund_method_id":"'.$fund_method_id.'",
	"sub_amount":"'.$sub_amount.'","logistic_id":"'.$logistic_id.'","delivery_fee":"'.$delivery_fee.'","total_amount":"'.$total_amount.'","status_id":"'.$status_id.'",
	"staff_id":"'.$staff_id.'","date":"'.$date.'"}]';
}

function _get_payment_id_for_order($conn, $order_id){
	$query=mysqli_query($conn,"SELECT * FROM payment_tab WHERE order_id='$order_id'")or die ('cannot select payment_tab');
	$fetch=mysqli_fetch_array($query);
		$payment_id=$fetch['payment_id'];
		$user_id=$fetch['user_id'];
	return '[{"pay_id":"'.$payment_id.'","user_id":"'.$user_id.'"}]';
}



function _get_cart_backup_detail($conn, $order_id, $product_id){
	$query=mysqli_query($conn,"SELECT * FROM add_to_cart_backup_tab WHERE order_id='$order_id' AND product_id='$product_id'")or die ('cannot select add_to_cart_backup_tab');
	$fetch=mysqli_fetch_array($query);
		$product_cat_id=$fetch['product_cat_id'];
		$puchase_price=$fetch['puchase_price'];
		$selling_price=$fetch['selling_price'];
		$product_qty=$fetch['product_qty'];
		$available_qty=$fetch['available_qty'];
		$outstanding_qty=$fetch['outstanding_qty'];
		$gross_price=$fetch['gross_price'];
		$sub_price=$fetch['sub_price'];
		$sub_profit=$fetch['sub_profit'];
		$status_id=$fetch['status_id'];
		$staff_id=$fetch['staff_id'];
		$date=$fetch['date'];
	return '[{"product_cat_id":"'.$product_cat_id.'","puchase_price":"'.$puchase_price.'","selling_price":"'.$selling_price.'","product_qty":"'.$product_qty.'","available_qty":"'.$available_qty.'",
	"outstanding_qty":"'.$outstanding_qty.'","gross_price":"'.$gross_price.'","sub_price":"'.$sub_price.'","sub_profit":"'.$sub_profit.'","status_id":"'.$status_id.'",
	"staff_id":"'.$staff_id.'","date":"'.$date.'"}]';
}

}//end of class
$callclass=new allClass();




////////////////////////for shop session//////////////////////
	if ($shopsession==''){
		///////////////////////geting sequence//////////////////////////
		$sequence=$callclass->_get_sequence_count($conn, 'SHOP');
		$array = json_decode($sequence, true);
		$no= $array[0]['no'];
		//$num= $array[0]['num'];
		$shopsession='SHOP'.$no.date('Ymdhis');
		$_SESSION['shopsession']=$shopsession;
	}
		$qtycountque=mysqli_fetch_array(mysqli_query($conn,"SELECT sum(product_qty) AS product_qty FROM add_to_cart_tab WHERE shop_session='$shopsession'"));
		$qtycount= $qtycountque['product_qty'];
?>









