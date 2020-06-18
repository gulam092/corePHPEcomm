
<?php include "inc/header.php"; ?>

<?php 
if (!isset($_GET['proid'])||$_GET['proid']==NULL) {
    echo "<script>window.location ='404.php'</script>";
}else{
   $id =$_GET['proid'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'&& isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
       

        $addCart = $ct->addToCart($quantity, $id);
    }
?>
<?php 
   $cmrId  =Session::get("cmrId");
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['campare'])) {
        $productId = $_POST['productId'];     
        $insertCom = $pd->inserCompareDate($productId, $cmrId);
    }

?>

<?php 
$cmrId  =Session::get("cmrId");
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
            
        $saveWlist = $pd->saveWishListData($id, $cmrId);
    }

?>

<style type="text/css">
	.mybutton{width: 100px;float: left;margin-right: 40px;}	
</style>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">
                 <?php 
              $pdpd  =$pd->getSingleProduct($id);
               if ($pdpd) {
               	while ($result =$pdpd->fetch_assoc()) {
               		
             
                 ?>

					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName'];?> </h2>
					<p><?php echo $fm->textShorten($result['body'], 200);?></p>					
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'];?></span></p>
						<p>Category: <span><?php echo $result['catName'];?></span></p>
						<p>Brand:<span><?php echo $result['brandName'];?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Add to Cart"/>
					</form>				
				</div>
				<span style="color: red;font-size: 20px;">
				<?php 
                if (isset($addCart)) {
                echo $addCart;
                }
                if (isset($insertCom)) {
                	echo($insertCom);
                }
                  if (isset($saveWlist)) {
                	echo($saveWlist);
                }
				?>
				</span>

		<?php  $login =  Session::get("cuslogin");
	  		if($login == true){?>

				<div class="add-cart">
				 <div class="mybutton">  
				 <form action=" " method="post">
						<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?>"/>
						<input type="submit" class="buysubmit" name="campare" value="Add to Campare"/>
					</form>	
                   </div>
                 <div class="mybutton"> 
 				<form action=" " method="post">
				<input type="submit" class="buysubmit" name="wlist" value="Wish List"/>
					</form>

					</div>
				</div>
			<?php }?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo ($result['body']);?></p>
	    </div>
		<?php 
  }
}
		?>		
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php
                         $getcat  =$cat->getAllCat();
                         if ($getcat) {
                         while ($result =$getcat->fetch_assoc()) {
                       
						 ?>
				      <li><a href="productbycat.php?catId=<?php echo $result['catId']?>"><?php echo $result['catName']?></a></li>
				      <?php }}?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
    <?php include "inc/footer.php"; ?>