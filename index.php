<?php include 'config/connection.php'?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http: //www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'meta.php'?>
<title><?php echo $thename?> - Online store for Raw Food and groceries - Lagos | Nigeria</title>
<meta name="keywords" content="<?php echo $thename?>, Buy foodstuff online,foodstuff website in nigeria, Online foodstuff market, Buy Nigerian Food Stuff, local food stuff in lagos, international food stuff in Nigeria, buy food stuff in lagos, Online food stuff in lagos" />
<meta name="description" content="Agrohandlers is an online store for retail and bulk Nigerian food items and groceries. Get quick delivery of fresh food ingredients and consumables from bulk marketplace. We deliver to Lagos, UK, Canada & USA"/>

<meta property="og:title" content="<?php echo $thename?> - A reputable online store for food and groceries. Delivers in Lagos, USA, UK & Canada" />
<meta property="og:image" content="<?php echo $website?>/all-images/plugin-pix/agrohandlers_3.jpg"/>
<meta property="og:description" content="Buy Food from Bulk Market- Online store for retail and bulk Nigerian food items and groceries. Get quick delivery of fresh food ingredients and consumables from bulk marketplace. We deliver to Lagos, UK, Canada & USA"/>

<meta name="twitter:title" content="<?php echo $thename?> - A reputable online store for food and groceries. Delivers in Lagos, USA, &amp; UK"/> 
<meta name="twitter:card" content="<?php echo $thename?>"/> 
<meta name="twitter:image"  content="<?php echo $website?>/all-images/plugin-pix/agrohandlers_3.jpg"/> 
<meta name="twitter:description" content="Agrohandlers is an online store for retail and bulk Nigerian food items and groceries. Get quick delivery of fresh food ingredients and consumables"/>


<link rel="stylesheet" type="text/css" href="slide-property/engine/style.css" />
</head>
<body>
<?php include 'header.php'?>
<?php include 'slide.php'?>


<div class="back-container">
<div class="slide-bottom-div">
	<div class="slide-content-div animated fadeInLeft animated animated">
    	<div class="div-in" data-aos="zoom-in" data-aos-duration="1400">
        	<h1><hr /><br /><span id="page-title">Online Retail Market Place for FoodStuffs</span></h1>
            <p>Agrohandlers is an online store for retail and bulk Nigerian food items and groceries. Shop fresh food ingredients and consumables from Lagos bulk marketplaces.</p>
    <a href="all-products" title="Order Raw FoodStuffs & Groceries Online">
    <button class="btn" title="Place Order Now"><i class="fa fa-shopping-basket"></i> Start Shopping Now!</button></a>
        </div>
    </div>
</div>

<script type="text/javascript">
// List of sentences
var _CONTENT = [ "Online Retail MarketPlace for Groceries, Food & Home essentials","Home, Business, Party bulk-buy Food Marketplace","Delivers to Lagos, UK, Canada & USA"];
// Current sentence being processed
var _PART = 0;
// Character number of the current sentence being processed 
var _PART_INDEX = 0;
// Element that holds the text
var _ELEMENT = document.querySelector("#page-title");
// Implements typing effect
function Type() { 
	var text =  _CONTENT[_PART].substring(0, _PART_INDEX + 1);
	_ELEMENT.innerHTML = text;
	_PART_INDEX++;

	// If full sentence has been displayed then start to delete the sentence after some time
	if(text === _CONTENT[_PART]) {
		clearInterval(_INTERVAL_VAL);
		setTimeout(function() {
			_INTERVAL_VAL = setInterval(Delete, 2);
		}, 5000);
	}
}
// Implements deleting effect
function Delete() {
	var text =  _CONTENT[_PART].substring(0, _PART_INDEX - 1);
	_ELEMENT.innerHTML = text;
	_PART_INDEX--;

	// If sentence has been deleted then start to display the next sentence
	if(text === '') {
		clearInterval(_INTERVAL_VAL);

		// If last sentence then display the first one, else move to the next
		if(_PART == (_CONTENT.length - 1))
			_PART = 0;
		else
			_PART++;
		_PART_INDEX = 0;

		// Start to display the next sentence after some time
		setTimeout(function() {
			_INTERVAL_VAL = setInterval(Type, 50);
		}, 100);
	}
}
// Start the typing effect on load
_INTERVAL_VAL = setInterval(Type, 50);
</script>






<div class="service-div animated fadeInUp">
    
    <div class="in-div">
    
        <div class="service">
            <div class="icon">&nbsp;<i class="fa fa-truck"></i>&nbsp;</div>
            <div class="detail">
                <span>Logistics Services</span><br />
                <strong>Delivery</strong> Our highly experienced logistics partner (www.valuehandlers.com) we deliver to our customers in Lagos and overseas buyers professionally.
            </div>
        </div>
        <div class="service">
            <div class="icon">&nbsp;<i class="fa fa-thumbs-o-up"></i>&nbsp;</div>
            <div class="detail">
                <span>Quality Assured</span><br />
                We buy from most consistent, reliable and hygienically tested suppliers.
            </div>
        </div>
        <div class="service">
            <div class="icon">&nbsp;<i class="fa fa-volume-control-phone"></i>&nbsp;</div>
            <div class="detail">
                <span>Friendly Service</span><br />
                We give you satisfying experience everytime we connect with you across all channels.
            </div>
        </div>
    
    </div>

</div>

<div class="body-div">
<div class="body-div-in">
        <div class="title-div" data-aos="fade-up" data-aos-duration="1000">
        	<h2>Product Categories</h2>
        	<h3>Product Categories</h3>
        </div>

        <div class="product-categories-back-div">
		<?php $callclass->_get_all_product_categories($conn);?>
            <div style="width:100%; display:inline-block;"></div>
        </div>

	
    
    
    
    
        <div class="title-div" data-aos="fade-up" data-aos-duration="1000">
        	<h2>Top Sales</h2>
        	<h3>Top Sales</h3>
        </div>


        <div class="product-back-div">
<?php
	$query=mysqli_query($conn,"SELECT * FROM product_tab a, stock_tab b WHERE a.product_id=b.product_id AND a.status_id ='A' AND b.selling_price>0  ORDER BY RAND() DESC LIMIT 16");
	$no=0;
	while($fetch=mysqli_fetch_array($query)){
		$no++;
		$product_id=$fetch['product_id'];
		$product_desc=$fetch['product_desc'];
		
		$array=$callclass->_get_product_detail($conn, $product_id);
		$get_array = json_decode($array, true);
		$product_cat_id= $get_array[0]['product_cat_id'];
		$product_name= $get_array[0]['product_name'];
		$product_name = substr($product_name, 0, 30);
		
		$cat_array=$callclass->_get_product_cat_detail($conn, $product_cat_id);
		$get_cat_array = json_decode($cat_array, true);
		$product_cat_name= $get_cat_array[0]['product_cat_name'];
		
		$stock_array=$callclass->_get_stock_detail($conn, $product_id);
		$stock_fetch = json_decode($stock_array, true);
			$selling_price= $stock_fetch[0]['selling_price'];
		
            $pixquery=mysqli_query($conn,"SELECT * FROM product_pix_tab WHERE  product_id='$product_id' ORDER BY RAND() LIMIT 1");
            $pixsel=mysqli_fetch_array($pixquery);
			$product_pix=$pixsel['product_pix'];
?>
        
        	<div class="product-div">
        	    <a href="product-details?pr=<?php echo $product_id?>" title="<?php echo $product_name;?> DETAILS">
                <div class="img"><img src="uploaded_files/product-pix/<?php echo $product_pix;?>" alt="<?php echo $product_name;?>" /></div>
                <div class="price"><s>N</s> <?php echo number_format($selling_price,2);?></div>
                <div class="text-div">
                   <span><?php echo ucwords(strtolower($product_cat_name))?></span>
                    <h2><?php echo $product_name?>...</h2>
                
                </a>
                <button class="btn" onclick="_get_form_with_id('product_details_caption','<?php echo $product_id;?>')"><i class="fa fa-shopping-basket"></i> ADD TO CART</button>
                </div>
           </div>
<?php } ?>
            <div style="width:100%; display:inline-block;"></div>
<br clear="all" />
<?php if ($no==0){?>
    <div class="false-notification-div">
        <p>NO RECORD FOUND!</p>
    </div>               
<?php } ?>

        </div>
    
</div>
</div>





<div class="body-div body-hash">
	<div class="info-div">
    	<div class="image-div" data-aos="fade-up" data-aos-duration="1000">
            <div class="image"><img src="all-images/body-pix/about-bellemata.png" alt="About bellemata" /></div>
        </div>
        <div class="info-text" >
        <div class="padding-div"></div>
        	<h2>Who we are </h2>
        	<h3>Who we are </h3>
            <p>Agrohandlers.com is an online marketplace for retail and bulk Nigerian food items and groceries. Operating from Lagos, we source our stocks from the most quality-reliable places all across Nigeria. Our
warehouses and distribution hubs are located in major bulk markets in Lagos, giving us the advantage of being able to deliver to our online customers at cheaper prices.</p>
            <p>Our delivery efficiency in Lagos, USA, Canada and the UK is highly facilitated by our parent company, valuehandlers.com , a leading logistics company with over 12 years experience in distribution and
logistics in Nigeria, Europe, America and Asia.</p>
        	<p><strong>Our mission:</strong> Our mission is to source right, handle hygienically and neatly deliver Nigerian food ingredients and groceries at moderate costs.</p>
        </div>
    </div>
</div>


<div class="body-div">
<div class="body-div-in">
        <div class="title-div" data-aos="fade-up" data-aos-duration="1000">
        	<h2>Latest Insights</h2>
        	<h3>Latest Insights</h3>
        </div>
			
			<?php include 'mini-blog.php'?>
</div>
</div>


<?php include 'footer.php'?>
</div>

</body>
</html>

