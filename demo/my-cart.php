<?php 
session_start();
error_reporting(0);
include('includes/config.php');

/* ========= AJAX: update quantity instantly (min=1) ========= */
if (isset($_POST['ajax']) && $_POST['ajax']==='1' && isset($_POST['action']) && $_POST['action']==='update_qty') {
    header('Content-Type: application/json');
    $pid = intval($_POST['pid'] ?? 0);
    $qty = intval($_POST['qty'] ?? 0);

    if ($pid <= 0) {
        echo json_encode(['ok'=>false,'msg'=>'Invalid product']); exit;
    }

    // Enforce min 1 server-side
    if ($qty < 1) { $qty = 1; }

    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    if (!isset($_SESSION['cart'][$pid])) {
        $_SESSION['cart'][$pid] = ['quantity'=>$qty];
    } else {
        $_SESSION['cart'][$pid]['quantity'] = $qty;
    }

    // Recalculate totals
    $totalprice = 0.0;
    $totalqunty = 0;
    $shipingcharge = 0.0;
    $lineTotal = 0.0;

    if (!empty($_SESSION['cart'])) {
        $ids = array_map('intval', array_keys($_SESSION['cart']));
        if ($ids) {
            $in = implode(',', $ids);
            $sql = "SELECT id, productPrice, shippingCharge FROM products WHERE id IN($in)";
            $res = mysqli_query($con, $sql);
            $priceMap = [];
            $shipMap = [];
            while ($r = mysqli_fetch_assoc($res)) {
                $priceMap[$r['id']] = (float)$r['productPrice'];
                $shipMap[$r['id']]  = (float)$r['shippingCharge'];
            }

            foreach ($_SESSION['cart'] as $id => $entry) {
                $q = max(1, (int)$entry['quantity']); // safety
                $p = (float)($priceMap[$id] ?? 0);
                $totalqunty += $q;
                $subtotal = $q * $p;
                $totalprice += $subtotal;
                $shipingcharge = (float)($shipMap[$id] ?? $shipingcharge);
                if ($id == $pid) $lineTotal = $subtotal;
            }
        }
    }

    $tax = round($totalprice * 18 / 100, 2);
    $grand = round($totalprice + $tax + (float)$shipingcharge, 2);

    $_SESSION['qnty'] = $totalqunty;
    $_SESSION['tp']   = number_format($totalprice, 2);

    echo json_encode([
        'ok'=>true,
        'pid'=>$pid,
        'qty'=>$qty,
        'line_total'=>number_format($lineTotal, 2),
        'subtotal'=>number_format($totalprice, 2),
        'tax'=>number_format($tax, 2),
        'shipping'=>number_format((float)$shipingcharge, 2),
        'grand'=>number_format($grand, 2),
        'cart_count'=>$totalqunty
    ]);
    exit;
}
/* ========= end AJAX ========= */

if(isset($_POST['submit'])){
    if(!empty($_SESSION['cart'])){
        foreach($_POST['quantity'] as $key => $val){
            $val = (int)$val;
            if ($val < 1) $val = 1; // min 1 on legacy submit
            $_SESSION['cart'][$key]['quantity']=$val;
        }
        echo "<script>alert('Your Cart hasbeen Updated');</script>";
    }
}

// Remove product(s)
if(isset($_POST['remove_code'])) {
    if(!empty($_SESSION['cart'])){
        foreach($_POST['remove_code'] as $key){
            unset($_SESSION['cart'][$key]);
        }
        echo "<script>alert('Your Cart has been Updated');</script>";
    }
}

// Place order
if(isset($_POST['ordersubmit'])) {
    if(strlen($_SESSION['login'])==0){   
        header('location:login.php');
    } else {
        $quantity=$_POST['quantity'];
        $pdd=$_SESSION['pid'];
        $quantity = array_map(function($v){ $v=(int)$v; return $v<1?1:$v; }, $quantity);
        $value=array_combine($pdd,$quantity);
        $_SESSION['order_data'] = $value;
        $grandtotal = $_POST['grandtotal'];
        $_SESSION['grandtotal_data'] = $grandtotal;
        header('Location: pay.php');
    }
}

// Billing update
if(isset($_POST['update'])) {
    $baddress=$_POST['billingaddress'];
    $bstate=$_POST['bilingstate'];
    $bcity=$_POST['billingcity'];
    $bpincode=$_POST['billingpincode'];
    $query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
    if($query) { echo "<script>alert('Billing Address has been updated');</script>"; }
}

// Shipping update
if(isset($_POST['shipupdate'])) {
    $saddress=$_POST['shippingaddress'];
    $sstate=$_POST['shippingstate'];
    $scity=$_POST['shippingcity'];
    $spincode=$_POST['shippingpincode'];
    $query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
    if($query) { echo "<script>alert('Shipping Address has been updated');</script>"; }
}
?>
<?php include 'header.php'?>

<div id="page-content"> 
    <div class="page-header text-center">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                    <div class="page-title"><h1>My Cart</h1></div>
                    <div class="breadcrumbs"><a href="index.html" title="Back to the home page">Home</a><span class="main-title"><i class="icon anm anm-angle-right-l"></i>My Cart</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">  
    <form method="post" class="cart-table table-bottom-brd">   
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                <?php if(!empty($_SESSION['cart'])){ ?>
                <table class="table align-middle" id="cartTable">
                    <thead class="cart-row cart-header position-relative">
                        <tr>
                            <th class="action">Remove</th>
                            <th colspan="2" class="text-start">Product</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $pdtid=array();
                        $sql = "SELECT * FROM products WHERE id IN(";
                        foreach($_SESSION['cart'] as $id => $value){
                            $sql .=$id. ",";
                        }
                        $sql=substr($sql,0,-1) . ") ORDER BY id ASC";
                        $query = mysqli_query($con,$sql);
                        $totalprice=0;
                        $totalqunty=0;
                        $shipingcharge=0;
                        if(!empty($query)){
                            while($row = mysqli_fetch_array($query)){
                                $qty = max(1,(int)$_SESSION['cart'][$row['id']]['quantity']);
                                $_SESSION['cart'][$row['id']]['quantity'] = $qty;
                                $subtotal= $qty * (float)$row['productPrice'];
                                $shipingcharge = (float)$row['shippingCharge'];
                                $totalprice += $subtotal;
                                $tax = $totalprice*18/100;
                                $_SESSION['qnty']=$totalqunty+=$qty;
                                array_push($pdtid,$row['id']);
                    ?>
                        <tr class="cart-row cart-flex position-relative" data-pid="<?php echo $row['id']; ?>">
                            <td class="cart-delete text-center">
                                <input type="checkbox" name="remove_code[]" value="<?php echo htmlentities($row['id']);?>" />
                            </td>
                            <td class="cart-image cart-flex-item">
                                <img class="cart-image rounded-0 blur-up lazyload" data-src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" src="admin/productimages/<?php echo $row['id'];?>/<?php echo $row['productImage1'];?>" alt="Product" width="120" height="170" />
                            </td>
                            <td class="cart-meta small-text-left cart-flex-item">
                                <a href="product-details.php?pid=<?php echo htmlentities($pd=$row['id']);?>"><?php echo $row['productName']; $_SESSION['sid']=$pd; ?></a>
                            </td>
                            <td class="cart-price cart-flex-item text-center">
                                <span class="money">RS: <?php echo number_format($row['productPrice'], 2); ?></span>
                            </td>
                            <td class="cart-update-wrapper cart-flex-item text-end text-md-center">
                                <div class="cart-qty d-flex justify-content-end justify-content-md-center">
                                    <div class="qtyField">
                                        <a class="qtyBtn minus" href="#;" data-role="minus" data-pid="<?php echo $row['id']; ?>"><i class="icon anm anm-minus-r"></i></a>
                                        <input class="cart-qty-input qty" 
                                            type="text" 
                                            value="<?php echo (int)$_SESSION['cart'][$row['id']]['quantity']; ?>" 
                                            name="quantity[<?php echo $row['id']; ?>]" 
                                            pattern="[0-9]*"
                                            inputmode="numeric"
                                            data-pid="<?php echo $row['id']; ?>"
                                            id="qty-<?php echo $row['id']; ?>"
                                        />
                                        <a class="qtyBtn plus" href="#;" data-role="plus" data-pid="<?php echo $row['id']; ?>"><i class="icon anm anm-plus-r"></i></a>
                                    </div>
                                </div>
                                <a href="#" title="Remove" class="removeMb d-md-none d-inline-block text-decoration-underline mt-2 me-3">Remove</a>
                            </td>
                            <td class="cart-price cart-flex-item text-center small-hide">
                                <span class="money fw-500" id="line-total-<?php echo $row['id']; ?>">RS: <?php echo number_format($_SESSION['cart'][$row['id']]['quantity']*$row['productPrice'],2); ?></span>
                            </td>
                        </tr>
                    <?php } } 
                        $_SESSION['pid']=$pdtid;
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-start"><a href="index.php" class="btn btn-outline-secondary btn-sm cart-continue">Continue shopping</a></td>
                            <td colspan="3" class="text-end">
                                <button type="submit" name="submit" class="btn btn-secondary btn-sm cart-continue ms-2">Update Cart</button>
                            </td>
                        </tr>
                    </tfoot>
                </table> 
            </div>

            <?php
            $query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
            while($row=mysqli_fetch_array($query))
            {
            ?>
            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <div class="block mb-3 shipping-address mb-4">
                    <div class="block-content">
                        <h3 class="title mb-3 text-uppercase">Billing Address</h3>
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="fullname" class="form-label ">Full Name <span class="required">*</span></label>
                                    <input name="fullname" value="<?php echo $row['name'];?>" id="fullname" type="text" required="" placeholder="Full Name" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="address-1" class="form-label ">Address <span class="required">*</span></label>
                                    <input name="billingaddress" value="<?php echo $row['billingAddress'];?>" id="billingaddress" type="text" required="" placeholder="Billing address" class="form-control">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input name="bilingstate" value="<?php echo $row['billingState'];?>" id="bilingstate" type="text" required="" placeholder="Billing State" class="form-control">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input name="billingcity" value="<?php echo $row['billingCity'];?>" id="billingcity" type="text" required="" placeholder="Billing City" class="form-control">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input name="billingpincode" value="<?php echo $row['billingPincode'];?>" id="billingpincode" type="text" required="" placeholder="Billing Pincode" class="form-control">
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn btn-secondary btn-sm cart-continue ms-2">Update Billing Address</button>
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" id="copyAddress" onclick="copyBillingToShipping()">
                                <label class="form-check-label" for="copyAddress">Same as Billing Address</label>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                <div class="block mb-3 shipping-address mb-4">
                    <div class="block-content">
                        <h3 class="title mb-3 text-uppercase">Shipping Address</h3>
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <label for="fullname" class="form-label ">Full Name <span class="required">*</span></label>
                                    <input name="fullname" value="<?php echo $row['name'];?>" id="fullname" type="text" required="" placeholder="Full Name" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input name="shippingaddress" value="<?php echo $row['shippingAddress'];?>" id="shippingaddress" type="text" required="" placeholder="Shipping address" class="form-control">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input name="shippingstate" value="<?php echo $row['shippingState'];?>" id="shippingstate" type="text" required="" placeholder="Shipping State" class="form-control">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input name="shippingcity" value="<?php echo $row['shippingCity'];?>" id="shippingcity" type="text" required="" placeholder="Shipping City" class="form-control">
                                </div>
                                <div class="form-group col-12 col-sm-12 col-md-12 col-lg-12">
                                    <input name="shippingpincode" value="<?php echo $row['shippingPincode'];?>" id="shippingpincode" type="text" required="" placeholder="Shipping Pincode" class="form-control">
                                </div>
                            </div>
                            <button type="submit" name="shipupdate" class="btn btn-secondary btn-sm cart-continue ms-2">Update Shipping Address</button>
                        </fieldset>
                    </div>
                </div>
            </div>
            <?php } ?>

            <div class="col-12 col-sm-12 col-md-12 col-lg-4 cart-footer">
                <div class="cart-info sidebar-sticky">
                    <div class="cart-order-detail cart-col">
                        <div class="row g-0 border-bottom pb-2">
                            <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Subtotal</strong></span>
                            <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end" id="subtotal">
                                <?php echo $_SESSION['tp']="$totalprice". ".00"; ?>
                                <input type="hidden" name="subtotal" value="<?php echo $totalprice; ?>">
                            </span>
                        </div>
                        <div class="row g-0 border-bottom py-2">
                            <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Tax</strong></span>
                            <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end" id="tax">
                                <?php echo number_format($tax,2); ?>
                                <input type="hidden" name="tax" value="<?php echo $tax; ?>">
                            </span>
                        </div>
                        <div class="row g-0 border-bottom py-2">
                            <span class="col-6 col-sm-6 cart-subtotal-title"><strong>Shipping</strong></span>
                            <span class="col-6 col-sm-6 cart-subtotal-title cart-subtotal text-end" id="shipping">
                                <span class="money">
                                    RS: <?php echo number_format($shipingcharge,2); ?>
                                    <input type="hidden" name="shipping" value="<?php echo $shipingcharge; ?>">
                                </span>
                            </span>
                        </div>
                        <div class="row g-0 pt-2">
                            <span class="col-6 col-sm-6 cart-subtotal-title fs-6"><strong>Total</strong></span>
                            <span class="col-6 col-sm-6 cart-subtotal-title fs-5 cart-subtotal text-end text-primary" id="grand-wrap">
                                <b class="money" id="grand">
                                <?php 
                                  $grand_now = ($totalprice + $shipingcharge) + $tax;
                                  echo number_format($grand_now,2);
                                ?>
                                </b>
                                <input type="hidden" name="grandtotal" id="grandtotal" value="<?php echo number_format($grand_now,2,'.',''); ?>">
                            </span>
                        </div>

                        <button name="ordersubmit" id="cartCheckout" class="btn btn-lg my-4 checkout w-100">Proceed To Checkout</button>
                        <div class="paymnet-img text-center"><img src="assets/images/icons/safepayment.png" alt="Payment" width="299" height="28" /></div>
                    </div>                                
                </div>
            </div>

            </div>
            </form> 
            <?php } ?>
        </div>
    </div>
</div>

<script>
function copyBillingToShipping() {
    const checkbox = document.getElementById("copyAddress");
    if (checkbox.checked) {
        document.getElementById("fullname").value = document.querySelector("input[name='fullname']").value;
        document.getElementById("shippingaddress").value = document.getElementById("billingaddress").value;
        document.getElementById("shippingstate").value = document.getElementById("bilingstate").value;
        document.getElementById("shippingcity").value = document.getElementById("billingcity").value;
        document.getElementById("shippingpincode").value = document.getElementById("billingpincode").value;
    } else {
        document.getElementById("shippingaddress").value = "";
        document.getElementById("shippingstate").value = "";
        document.getElementById("shippingcity").value = "";
        document.getElementById("shippingpincode").value = "";
    }
}
</script>

<script>
// One delegated handler, normalized target, full stop, plus lock
(function(){
    const table = document.getElementById('cartTable');
    if (!table) return;

    let lock = false; // prevent double processing during AJAX

    function clampInt(v) {
        v = parseInt(v || '1', 10);
        if (isNaN(v) || v < 1) v = 1;
        return v;
    }

    function postJSON(url, data) {
        return fetch(url, {
            method: 'POST',
            headers: { 'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8' },
            body: new URLSearchParams(data).toString()
        }).then(r => r.json());
    }

    table.addEventListener('click', function(e){
        // Find the nearest qtyBtn regardless of inner <i> click
        const btn = e.target.closest('a.qtyBtn');
        if (!btn || !table.contains(btn)) return;

        // Ensure this click is processed only once
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();

        if (lock) return;
        const pid = btn.getAttribute('data-pid');
        const role = btn.getAttribute('data-role');
        const input = document.getElementById('qty-'+pid);
        let current = clampInt(input.value);

        if (role === 'plus') current = current + 1;
        if (role === 'minus') current = Math.max(1, current - 1);

        // Optimistic UI
        input.value = current;

        lock = true;
        postJSON(window.location.href, {
            ajax: '1',
            action: 'update_qty',
            pid: pid,
            qty: current
        }).then(res=>{
            if (!res || !res.ok) return;

            const lt = document.getElementById('line-total-'+pid);
            if (lt) lt.textContent = 'RS: ' + res.line_total;

            const subtotal = document.getElementById('subtotal');
            if (subtotal) subtotal.childNodes[0].nodeValue = res.subtotal;

            const tax = document.getElementById('tax');
            if (tax) tax.childNodes[0].nodeValue = res.tax;

            const shipping = document.getElementById('shipping');
            if (shipping) shipping.innerHTML = '<span class="money">RS: '+res.shipping+'<input type="hidden" name="shipping" value="'+res.shipping+'"></span>';

            const grand = document.getElementById('grand');
            const grandHidden = document.getElementById('grandtotal');
            if (grand) grand.textContent = res.grand;
            if (grandHidden) grandHidden.value = res.grand;

            const countEl = document.querySelector('[data-cart-count]');
            if (countEl) countEl.textContent = res.cart_count;
        }).catch(console.error).finally(()=>{ lock = false; });
    }, true); // use capture to ensure our stopper runs first

    // Debounced manual typing with min=1
    let debounceTimer = null;
    table.addEventListener('input', function(e){
        const inp = e.target;
        if (!inp.classList.contains('qty')) return;
        const pid = inp.getAttribute('data-pid');

        // sanitize immediately
        inp.value = inp.value.replace(/[^0-9]/g,'');
        if (inp.value === '' || inp.value === '0') inp.value = '1';

        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(()=>{
            if (lock) return;
            const val = clampInt(inp.value);
            inp.value = val;

            lock = true;
            postJSON(window.location.href, {
                ajax: '1',
                action: 'update_qty',
                pid: pid,
                qty: val
            }).then(res=>{
                if (!res || !res.ok) return;
                const lt = document.getElementById('line-total-'+pid);
                if (lt) lt.textContent = 'RS: ' + res.line_total;

                const subtotal = document.getElementById('subtotal');
                if (subtotal) subtotal.childNodes[0].nodeValue = res.subtotal;

                const tax = document.getElementById('tax');
                if (tax) tax.childNodes[0].nodeValue = res.tax;

                const shipping = document.getElementById('shipping');
                if (shipping) shipping.innerHTML = '<span class="money">RS: '+res.shipping+'<input type="hidden" name="shipping" value="'+res.shipping+'"></span>';

                const grand = document.getElementById('grand');
                const grandHidden = document.getElementById('grandtotal');
                if (grand) grand.textContent = res.grand;
                if (grandHidden) grandHidden.value = res.grand;

                const countEl = document.querySelector('[data-cart-count]');
                if (countEl) countEl.textContent = res.cart_count;
            }).catch(console.error).finally(()=>{ lock = false; });
        }, 300);
    }, false);
})();
</script>

<?php include 'footer.php'?>
