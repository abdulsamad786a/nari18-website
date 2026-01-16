<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{   
    header('location:login.php');
}
else{
    // Handle Account Info Update
    if(isset($_POST['update']))
    {
        $name=$_POST['name'];
        $contactno=$_POST['contactno'];
        $query=mysqli_query($con,"update users set name='$name',contactno='$contactno' where id='".$_SESSION['id']."'");
        if($query)
        {
            echo "<script>alert('Your info has been updated');</script>";
        }
    }

    // Handle Password Change
    date_default_timezone_set('Asia/Kolkata');
    $currentTime = date( 'd-m-Y h:i:s A', time () );

    if(isset($_POST['submit']))
    {
        $sql=mysqli_query($con,"SELECT password FROM  users where password='".md5($_POST['cpass'])."' && id='".$_SESSION['id']."'");
        $num=mysqli_fetch_array($sql);
        if($num>0)
        {
            $con=mysqli_query($con,"update students set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where id='".$_SESSION['id']."'");
            echo "<script>alert('Password Changed Successfully !!');</script>";
        }
        else
        {
            echo "<script>alert('Current Password not match !!');</script>";
        }
    }

    // Handle Billing Address Update
    if(isset($_POST['updatebilling']))
    {
        $baddress=$_POST['billingaddress'];
        $bstate=$_POST['bilingstate'];
        $bcity=$_POST['billingcity'];
        $bpincode=$_POST['billingpincode'];
        $query=mysqli_query($con,"update users set billingAddress='$baddress',billingState='$bstate',billingCity='$bcity',billingPincode='$bpincode' where id='".$_SESSION['id']."'");
        if($query)
        {
            echo "<script>alert('Billing Address has been updated');</script>";
        }
    }

    // Handle Shipping Address Update
    if(isset($_POST['shipupdate']))
    {
        $saddress=$_POST['shippingaddress'];
        $sstate=$_POST['shippingstate'];
        $scity=$_POST['shippingcity'];
        $spincode=$_POST['shippingpincode'];
        $query=mysqli_query($con,"update users set shippingAddress='$saddress',shippingState='$sstate',shippingCity='$scity',shippingPincode='$spincode' where id='".$_SESSION['id']."'");
        if($query)
        {
            echo "<script>alert('Shipping Address has been updated');</script>";
        }
    }

    // Handle Pending Order Deletion
    if(isset($_GET['deletepending'])) {
        mysqli_query($con,"delete from orders where userId='".$_SESSION['id']."' and paymentMethod is null and id='".$_GET['deletepending']."' ");
        echo "<script>alert('Successfully Deleted');</script>";
    }

    // Fetch user data
    $userQuery = mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
    $userData = mysqli_fetch_array($userQuery);
?>
<?php include 'header.php'?>

<!-- Google Fonts for Premium Design -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<!-- Material Symbols Outlined Icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

<style>
    /* Premium My Account Page Styles */
    :root {
        --primary: #800020;
        --secondary: #D4AF37;
        --background-light: #F9F8F6;
        --text-dark: #1a1a1a;
        --text-muted: #6b7280;
        --border-light: #e5e7eb;
    }
    
    .my-account-wrapper {
        background-color: var(--background-light);
        min-height: 100vh;
    }
    
    /* Page Header */
    .premium-page-header {
        background: #ffffff;
        border-bottom: 1px solid var(--border-light);
        padding: 48px 0;
    }
    
    .premium-page-header .container {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 24px;
    }
    
    .premium-page-header-content {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    
    @media (min-width: 768px) {
        .premium-page-header-content {
            flex-direction: row;
            align-items: baseline;
            justify-content: space-between;
        }
    }
    
    .premium-page-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        letter-spacing: 0.1em;
        font-weight: 400;
        text-transform: uppercase;
        color: var(--text-dark);
        margin: 0;
    }
    
    .premium-breadcrumbs {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: #9ca3af;
    }
    
    .premium-breadcrumbs a {
        color: #9ca3af;
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .premium-breadcrumbs a:hover {
        color: var(--primary);
    }
    
    .premium-breadcrumbs .current {
        color: var(--text-dark);
    }
    
    /* Main Content Area */
    .premium-account-main {
        max-width: 1280px;
        margin: 0 auto;
        padding: 64px 24px;
    }
    
    .premium-account-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 64px;
    }
    
    @media (min-width: 1024px) {
        .premium-account-grid {
            grid-template-columns: 280px 1fr;
        }
    }
    
    /* Sidebar Navigation */
    .premium-sidebar-nav {
        display: flex;
        flex-direction: column;
    }
    
    .premium-nav-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid var(--border-light);
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .premium-nav-item.active {
        color: var(--primary);
    }
    
    .premium-nav-item.active .premium-nav-text {
        font-family: 'Playfair Display', serif;
        font-size: 1.125rem;
        font-style: italic;
        font-weight: 600;
    }
    
    .premium-nav-item:not(.active) {
        color: #6b7280;
    }
    
    .premium-nav-item:not(.active) .premium-nav-text {
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-weight: 500;
    }
    
    .premium-nav-item:not(.active):hover {
        color: var(--text-dark);
    }
    
    .premium-nav-item .premium-nav-arrow {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .premium-nav-item.active .premium-nav-arrow {
        opacity: 1;
    }
    
    .premium-nav-item:not(.active):hover .premium-nav-arrow {
        opacity: 1;
    }
    
    .premium-nav-logout {
        display: flex;
        align-items: center;
        padding: 16px 0;
        text-decoration: none;
        color: #b91c1c;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-weight: 600;
        transition: opacity 0.3s ease;
    }
    
    .premium-nav-logout:hover {
        opacity: 0.8;
        color: #b91c1c;
    }
    
    /* Content Area */
    .premium-content-area {
        max-width: 100%;
    }
    
    .premium-welcome-header {
        margin-bottom: 48px;
    }
    
    .premium-welcome-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--text-dark);
        margin-bottom: 16px;
        font-weight: 400;
    }
    
    .premium-welcome-title .user-name {
        color: var(--primary);
        font-style: italic;
    }
    
    .premium-welcome-description {
        color: #6b7280;
        font-weight: 300;
        line-height: 1.75;
        font-size: 0.875rem;
        max-width: 640px;
    }
    
    /* Account Info Card */
    .premium-account-card {
        background: #ffffff;
        padding: 32px;
        border: 1px solid var(--border-light);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    @media (min-width: 768px) {
        .premium-account-card {
            padding: 48px;
        }
    }
    
    .premium-section-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 32px;
    }
    
    .premium-section-line {
        width: 32px;
        height: 1px;
        background: #d1d5db;
    }
    
    .premium-section-title {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        font-weight: 700;
        color: #9ca3af;
        margin: 0;
    }
    
    /* Form Styles */
    .premium-form {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }
    
    .premium-form-group {
        position: relative;
    }
    
    .premium-form-label {
        display: block;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-weight: 700;
        color: #9ca3af;
        margin-bottom: 8px;
    }
    
    .premium-form-label .required {
        color: var(--primary);
    }
    
    .premium-form-input {
        width: 100%;
        background: transparent;
        border: none;
        border-bottom: 1px solid #d1d5db;
        padding: 12px 0;
        font-family: 'Playfair Display', serif;
        font-size: 1.125rem;
        font-style: italic;
        color: var(--text-dark);
        transition: border-color 0.3s ease;
        outline: none;
    }
    
    .premium-form-input:focus {
        border-color: var(--primary);
    }
    
    .premium-form-input::placeholder {
        color: #d1d5db;
    }
    
    .premium-form-input:read-only {
        color: #6b7280;
        cursor: not-allowed;
    }
    
    /* Submit Button */
    .premium-submit-wrapper {
        padding-top: 24px;
    }
    
    .premium-submit-btn {
        display: inline-flex;
        align-items: center;
        gap: 16px;
        background: var(--primary);
        color: #ffffff;
        padding: 20px 48px;
        border: 1px solid var(--primary);
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .premium-submit-btn:hover {
        background: #000000;
        border-color: #000000;
        box-shadow: 0 0 15px rgba(212, 175, 55, 0.4);
    }
    
    /* Change Password Tab Content */
    .premium-tab-content {
        display: none;
    }
    
    .premium-tab-content.active {
        display: block;
    }
    
    /* Floating Action Buttons */
    .premium-floating-actions {
        position: fixed;
        bottom: 32px;
        right: 32px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        z-index: 100;
    }
    
    .premium-scroll-top {
        width: 48px;
        height: 48px;
        background: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .premium-scroll-top:hover {
        background: #f9fafb;
        color: var(--text-dark);
    }
    
    .premium-whatsapp-btn {
        width: 48px;
        height: 48px;
        background: #25D366;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        text-decoration: none;
        transition: opacity 0.3s ease;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    
    .premium-whatsapp-btn:hover {
        opacity: 0.9;
        color: #ffffff;
    }
    
    .premium-whatsapp-btn svg {
        width: 24px;
        height: 24px;
        fill: currentColor;
    }
    
    /* Material Symbols Styling */
    .material-symbols-outlined {
        font-family: 'Material Symbols Outlined' !important;
        font-weight: normal !important;
        font-style: normal !important;
        font-size: 24px;
        line-height: 1;
        letter-spacing: normal;
        text-transform: none;
        display: inline-block !important;
        white-space: nowrap;
        word-wrap: normal;
        direction: ltr;
        -webkit-font-feature-settings: 'liga';
        -moz-font-feature-settings: 'liga';
        font-feature-settings: 'liga';
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        font-variation-settings: 'FILL' 0, 'wght' 300, 'GRAD' 0, 'opsz' 24;
    }
    
    .premium-nav-arrow {
        font-size: 18px !important;
    }
    
    .premium-submit-btn .material-symbols-outlined {
        font-size: 16px !important;
    }
    
    /* Tab Navigation for Mobile */
    @media (max-width: 1023px) {
        .premium-sidebar-nav {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 32px;
        }
        
        .premium-nav-item {
            padding: 12px 16px;
            border: 1px solid var(--border-light);
            border-radius: 4px;
            flex: 0 0 auto;
        }
        
        .premium-nav-item.active {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }
        
        .premium-nav-item.active .premium-nav-text {
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            font-style: normal;
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }
        
        .premium-nav-item .premium-nav-arrow {
            display: none;
        }
        
        .premium-nav-logout {
            padding: 12px 16px;
            border: 1px solid #fee2e2;
            border-radius: 4px;
            background: #fef2f2;
        }
    }
    
    /* Password Form Styling */
    .premium-password-form .premium-form-input {
        font-family: 'Inter', sans-serif;
        font-style: normal;
        letter-spacing: 0.2em;
    }
    
    /* Address Cards Grid */
    .premium-address-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 32px;
    }
    
    @media (min-width: 768px) {
        .premium-address-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    .premium-address-card {
        background: #ffffff;
        padding: 32px;
        border: 1px solid var(--border-light);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    }
    
    /* Table Styles for Order History */
    .premium-table-wrapper {
        background: #ffffff;
        border: 1px solid var(--border-light);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }
    
    .premium-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }
    
    .premium-table thead {
        background: var(--background-light);
        border-bottom: 2px solid var(--border-light);
    }
    
    .premium-table th {
        padding: 16px;
        text-align: left;
        font-size: 10px;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-weight: 700;
        color: #6b7280;
    }
    
    .premium-table td {
        padding: 16px;
        border-bottom: 1px solid var(--border-light);
        font-size: 0.875rem;
        color: var(--text-dark);
    }
    
    .premium-table tbody tr:hover {
        background: #fafafa;
    }
    
    .premium-table-img {
        width: 60px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
    }
    
    .premium-table-product-name {
        font-family: 'Playfair Display', serif;
        font-style: italic;
        color: var(--text-dark);
        text-decoration: none;
        transition: color 0.3s ease;
    }
    
    .premium-table-product-name:hover {
        color: var(--primary);
    }
    
    .premium-table-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--primary);
        color: #ffffff;
        padding: 10px 20px;
        border: none;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .premium-table-btn:hover {
        background: #000000;
        color: #ffffff;
    }
    
    .premium-table-btn.btn-danger {
        background: #dc2626;
    }
    
    .premium-table-btn.btn-danger:hover {
        background: #991b1b;
    }
    
    /* Track Order Form */
    .premium-track-form {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    
    @media (min-width: 768px) {
        .premium-track-form {
            flex-direction: row;
            align-items: flex-end;
        }
        
        .premium-track-form .premium-form-group {
            flex: 1;
        }
    }
    
    /* Empty State */
    .premium-empty-state {
        text-align: center;
        padding: 64px 32px;
        background: #ffffff;
        border: 1px solid var(--border-light);
    }
    
    .premium-empty-state .material-symbols-outlined {
        font-size: 64px;
        color: #d1d5db;
        margin-bottom: 16px;
    }
    
    .premium-empty-state h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: var(--text-dark);
        margin-bottom: 8px;
    }
    
    .premium-empty-state p {
        color: #6b7280;
        font-size: 0.875rem;
    }
</style>

<script type="text/javascript">
function valid()
{
    if(document.chngpwd.cpass.value=="")
    {
        alert("Current Password Field is Empty !!");
        document.chngpwd.cpass.focus();
        return false;
    }
    else if(document.chngpwd.newpass.value=="")
    {
        alert("New Password Field is Empty !!");
        document.chngpwd.newpass.focus();
        return false;
    }
    else if(document.chngpwd.cnfpass.value=="")
    {
        alert("Confirm Password Field is Empty !!");
        document.chngpwd.cnfpass.focus();
        return false;
    }
    else if(document.chngpwd.newpass.value!= document.chngpwd.cnfpass.value)
    {
        alert("Password and Confirm Password Field do not match !!");
        document.chngpwd.cnfpass.focus();
        return false;
    }
    return true;
}

// Popup window for track order
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
    if(popUpWin)
    {
        if(!popUpWin.closed) popUpWin.close();
    }
    popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

// Tab switching functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabLinks = document.querySelectorAll('[data-tab]');
    const tabContents = document.querySelectorAll('.premium-tab-content');
    
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const tabId = this.getAttribute('data-tab');
            if(!tabId) return;
            
            // Update active states
            tabLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            // Show/hide content
            tabContents.forEach(content => {
                content.classList.remove('active');
                if(content.id === tabId) {
                    content.classList.add('active');
                }
            });
            
            // Update URL hash without scrolling
            history.replaceState(null, null, '#' + tabId);
        });
    });
    
    // Check for hash on page load
    const hash = window.location.hash.substring(1);
    if(hash) {
        const targetTab = document.querySelector('[data-tab="' + hash + '"]');
        if(targetTab) {
            targetTab.click();
        }
    }
});
</script>

<!-- Premium My Account Page -->
<div class="my-account-wrapper">
    
    <!-- Page Header -->
    <div class="premium-page-header">
        <div class="container">
            <div class="premium-page-header-content">
                <h1 class="premium-page-title">My Account</h1>
                <nav class="premium-breadcrumbs">
                    <a href="index.php">Home</a>
                    <span>/</span>
                    <span class="current">My Account</span>
                </nav>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <main class="premium-account-main">
        <div class="premium-account-grid">
            
            <!-- Sidebar Navigation -->
            <aside>
                <nav class="premium-sidebar-nav">
                    <a href="#" class="premium-nav-item active" data-tab="account-info">
                        <span class="premium-nav-text">Account Info</span>
                        <span class="material-symbols-outlined premium-nav-arrow">chevron_right</span>
                    </a>
                    <a href="#" class="premium-nav-item" data-tab="change-password">
                        <span class="premium-nav-text">Change Password</span>
                        <span class="material-symbols-outlined premium-nav-arrow">chevron_right</span>
                    </a>
                    <a href="#" class="premium-nav-item" data-tab="addresses">
                        <span class="premium-nav-text">Shipping / Billing Address</span>
                        <span class="material-symbols-outlined premium-nav-arrow">chevron_right</span>
                    </a>
                    <a href="#" class="premium-nav-item" data-tab="order-history">
                        <span class="premium-nav-text">Order History</span>
                        <span class="material-symbols-outlined premium-nav-arrow">chevron_right</span>
                    </a>
                    <a href="#" class="premium-nav-item" data-tab="track-order">
                        <span class="premium-nav-text">Track Order</span>
                        <span class="material-symbols-outlined premium-nav-arrow">chevron_right</span>
                    </a>
                    <a href="#" class="premium-nav-item" data-tab="pending-orders">
                        <span class="premium-nav-text">Payment Pending Orders</span>
                        <span class="material-symbols-outlined premium-nav-arrow">chevron_right</span>
                    </a>
                    <a href="logout.php" class="premium-nav-logout">
                        <span class="premium-nav-text">Log Out</span>
                    </a>
                </nav>
            </aside>
            
            <!-- Content Area -->
            <div class="premium-content-area">
                
                <!-- Account Info Tab -->
                <div id="account-info" class="premium-tab-content active">
                    <!-- Welcome Header -->
                    <header class="premium-welcome-header">
                        <h2 class="premium-welcome-title">
                            Hello, <span class="user-name"><?php echo htmlspecialchars($userData['name']); ?></span>
                        </h2>
                        <p class="premium-welcome-description">
                            From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.
                        </p>
                    </header>
                    
                    <!-- Account Information Card -->
                    <div class="premium-account-card">
                        <div class="premium-section-header">
                            <span class="premium-section-line"></span>
                            <h3 class="premium-section-title">Account Information</h3>
                        </div>
                        
                        <form method="post" class="premium-form">
                            <div class="premium-form-group">
                                <label class="premium-form-label">Name <span class="required">*</span></label>
                                <input type="text" name="name" class="premium-form-input" value="<?php echo htmlspecialchars($userData['name']); ?>" required>
                            </div>
                            
                            <div class="premium-form-group">
                                <label class="premium-form-label">Email Id <span class="required">*</span></label>
                                <input type="email" name="email" class="premium-form-input" value="<?php echo htmlspecialchars($userData['email']); ?>" readonly>
                            </div>
                            
                            <div class="premium-form-group">
                                <label class="premium-form-label">Contact No. <span class="required">*</span></label>
                                <input type="tel" name="contactno" class="premium-form-input" value="<?php echo htmlspecialchars($userData['contactno']); ?>" maxlength="10" required>
                            </div>
                            
                            <div class="premium-submit-wrapper">
                                <button type="submit" name="update" class="premium-submit-btn">
                                    Update Info
                                    <span class="material-symbols-outlined">arrow_forward</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Change Password Tab -->
                <div id="change-password" class="premium-tab-content">
                    <!-- Welcome Header -->
                    <header class="premium-welcome-header">
                        <h2 class="premium-welcome-title">
                            Change <span class="user-name">Password</span>
                        </h2>
                        <p class="premium-welcome-description">
                            Keep your account secure by updating your password regularly. Enter your current password and then create a new one.
                        </p>
                    </header>
                    
                    <!-- Change Password Card -->
                    <div class="premium-account-card">
                        <div class="premium-section-header">
                            <span class="premium-section-line"></span>
                            <h3 class="premium-section-title">Change Password</h3>
                        </div>
                        
                        <form method="post" name="chngpwd" onSubmit="return valid();" class="premium-form premium-password-form">
                            <div class="premium-form-group">
                                <label class="premium-form-label">Current Password <span class="required">*</span></label>
                                <input type="password" name="cpass" class="premium-form-input" placeholder="Enter current password" required>
                            </div>
                            
                            <div class="premium-form-group">
                                <label class="premium-form-label">New Password <span class="required">*</span></label>
                                <input type="password" name="newpass" class="premium-form-input" placeholder="Enter new password" required>
                            </div>
                            
                            <div class="premium-form-group">
                                <label class="premium-form-label">Confirm Password <span class="required">*</span></label>
                                <input type="password" name="cnfpass" class="premium-form-input" placeholder="Confirm new password" required>
                            </div>
                            
                            <div class="premium-submit-wrapper">
                                <button type="submit" name="submit" class="premium-submit-btn">
                                    Change Password
                                    <span class="material-symbols-outlined">lock</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Shipping / Billing Address Tab -->
                <div id="addresses" class="premium-tab-content">
                    <header class="premium-welcome-header">
                        <h2 class="premium-welcome-title">
                            Shipping / <span class="user-name">Billing Address</span>
                        </h2>
                        <p class="premium-welcome-description">
                            Manage your shipping and billing addresses. Keep them updated for faster checkout.
                        </p>
                    </header>
                    
                    <div class="premium-address-grid">
                        <!-- Billing Address Card -->
                        <div class="premium-address-card">
                            <div class="premium-section-header">
                                <span class="premium-section-line"></span>
                                <h3 class="premium-section-title">Billing Address</h3>
                            </div>
                            
                            <form method="post" class="premium-form">
                                <div class="premium-form-group">
                                    <label class="premium-form-label">Address <span class="required">*</span></label>
                                    <input type="text" name="billingaddress" class="premium-form-input" value="<?php echo htmlspecialchars($userData['billingAddress']); ?>" placeholder="Enter billing address" required>
                                </div>
                                
                                <div class="premium-form-group">
                                    <label class="premium-form-label">State <span class="required">*</span></label>
                                    <input type="text" name="bilingstate" class="premium-form-input" value="<?php echo htmlspecialchars($userData['billingState']); ?>" placeholder="Enter state" required>
                                </div>
                                
                                <div class="premium-form-group">
                                    <label class="premium-form-label">City <span class="required">*</span></label>
                                    <input type="text" name="billingcity" class="premium-form-input" value="<?php echo htmlspecialchars($userData['billingCity']); ?>" placeholder="Enter city" required>
                                </div>
                                
                                <div class="premium-form-group">
                                    <label class="premium-form-label">Pincode <span class="required">*</span></label>
                                    <input type="text" name="billingpincode" class="premium-form-input" value="<?php echo htmlspecialchars($userData['billingPincode']); ?>" placeholder="Enter pincode" required>
                                </div>
                                
                                <div class="premium-submit-wrapper">
                                    <button type="submit" name="updatebilling" class="premium-submit-btn">
                                        Update Billing
                                        <span class="material-symbols-outlined">receipt_long</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Shipping Address Card -->
                        <div class="premium-address-card">
                            <div class="premium-section-header">
                                <span class="premium-section-line"></span>
                                <h3 class="premium-section-title">Shipping Address</h3>
                            </div>
                            
                            <form method="post" class="premium-form">
                                <div class="premium-form-group">
                                    <label class="premium-form-label">Address <span class="required">*</span></label>
                                    <input type="text" name="shippingaddress" class="premium-form-input" value="<?php echo htmlspecialchars($userData['shippingAddress']); ?>" placeholder="Enter shipping address" required>
                                </div>
                                
                                <div class="premium-form-group">
                                    <label class="premium-form-label">State <span class="required">*</span></label>
                                    <input type="text" name="shippingstate" class="premium-form-input" value="<?php echo htmlspecialchars($userData['shippingState']); ?>" placeholder="Enter state" required>
                                </div>
                                
                                <div class="premium-form-group">
                                    <label class="premium-form-label">City <span class="required">*</span></label>
                                    <input type="text" name="shippingcity" class="premium-form-input" value="<?php echo htmlspecialchars($userData['shippingCity']); ?>" placeholder="Enter city" required>
                                </div>
                                
                                <div class="premium-form-group">
                                    <label class="premium-form-label">Pincode <span class="required">*</span></label>
                                    <input type="text" name="shippingpincode" class="premium-form-input" value="<?php echo htmlspecialchars($userData['shippingPincode']); ?>" placeholder="Enter pincode" required>
                                </div>
                                
                                <div class="premium-submit-wrapper">
                                    <button type="submit" name="shipupdate" class="premium-submit-btn">
                                        Update Shipping
                                        <span class="material-symbols-outlined">local_shipping</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Order History Tab -->
                <div id="order-history" class="premium-tab-content">
                    <header class="premium-welcome-header">
                        <h2 class="premium-welcome-title">
                            Order <span class="user-name">History</span>
                        </h2>
                        <p class="premium-welcome-description">
                            View all your past orders and track their current status.
                        </p>
                    </header>
                    
                    <?php
                    $orderQuery = mysqli_query($con, "SELECT products.productImage1 as pimg1, products.productName as pname, products.id as proid, orders.productId as opid, orders.quantity as qty, products.productPrice as pprice, products.shippingCharge as shippingcharge, orders.paymentMethod as paym, orders.orderDate as odate, orders.id as orderid FROM orders JOIN products ON orders.productId = products.id WHERE orders.userId = '".$_SESSION['id']."' AND orders.paymentMethod IS NOT NULL ORDER BY orders.orderDate DESC");
                    $orderNum = mysqli_num_rows($orderQuery);
                    
                    if($orderNum > 0) {
                    ?>
                    <div class="premium-table-wrapper">
                        <table class="premium-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Shipping</th>
                                    <th>Total</th>
                                    <th>Payment</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cnt = 1;
                                while($row = mysqli_fetch_array($orderQuery)) {
                                    $qty = $row['qty'];
                                    $price = $row['pprice'];
                                    $shippcharge = $row['shippingcharge'];
                                ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td>
                                        <img class="premium-table-img" src="admin/productimages/<?php echo $row['proid']; ?>/<?php echo $row['pimg1']; ?>" alt="Product">
                                    </td>
                                    <td>
                                        <a href="product-details.php?pid=<?php echo $row['opid']; ?>" class="premium-table-product-name"><?php echo htmlentities($row['pname']); ?></a>
                                    </td>
                                    <td><?php echo $qty; ?></td>
                                    <td>₹<?php echo number_format($price); ?></td>
                                    <td>₹<?php echo number_format($shippcharge); ?></td>
                                    <td><strong>₹<?php echo number_format(($qty * $price) + $shippcharge); ?></strong></td>
                                    <td><?php echo $row['paym']; ?></td>
                                    <td><?php echo $row['odate']; ?></td>
                                    <td>
                                        <a href="javascript:void(0);" onClick="popUpWindow('track-order.php?oid=<?php echo htmlentities($row['orderid']); ?>')" class="premium-table-btn">
                                            Track
                                        </a>
                                    </td>
                                </tr>
                                <?php $cnt++; } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } else { ?>
                    <div class="premium-empty-state">
                        <span class="material-symbols-outlined">shopping_bag</span>
                        <h3>No Orders Yet</h3>
                        <p>You haven't placed any orders yet. Start shopping to see your order history here.</p>
                    </div>
                    <?php } ?>
                </div>
                
                <!-- Track Order Tab -->
                <div id="track-order" class="premium-tab-content">
                    <header class="premium-welcome-header">
                        <h2 class="premium-welcome-title">
                            Track <span class="user-name">Order</span>
                        </h2>
                        <p class="premium-welcome-description">
                            Enter your Order ID and billing email to track your order status.
                        </p>
                    </header>
                    
                    <div class="premium-account-card">
                        <div class="premium-section-header">
                            <span class="premium-section-line"></span>
                            <h3 class="premium-section-title">Track Your Order</h3>
                        </div>
                        
                        <form method="post" action="order-details.php" class="premium-form">
                            <div class="premium-track-form">
                                <div class="premium-form-group">
                                    <label class="premium-form-label">Order ID <span class="required">*</span></label>
                                    <input type="text" name="orderid" class="premium-form-input" placeholder="Enter your Order ID" required>
                                </div>
                                
                                <div class="premium-form-group">
                                    <label class="premium-form-label">Billing Email <span class="required">*</span></label>
                                    <input type="email" name="email" class="premium-form-input" placeholder="Enter billing email" required>
                                </div>
                                
                                <div class="premium-submit-wrapper" style="padding-top: 0;">
                                    <button type="submit" name="submit" class="premium-submit-btn">
                                        Track Order
                                        <span class="material-symbols-outlined">search</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Payment Pending Orders Tab -->
                <div id="pending-orders" class="premium-tab-content">
                    <header class="premium-welcome-header">
                        <h2 class="premium-welcome-title">
                            Payment <span class="user-name">Pending Orders</span>
                        </h2>
                        <p class="premium-welcome-description">
                            Orders that are waiting for payment completion. Complete your payment or remove unwanted orders.
                        </p>
                    </header>
                    
                    <?php
                    $pendingQuery = mysqli_query($con, "SELECT products.productImage1 as pimg1, products.productName as pname, orders.productId as opid, products.id as proid, products.shippingCharge as shipcharge, orders.quantity as qty, products.productPrice as pprice, orders.paymentMethod as paym, orders.orderDate as odate, orders.id as orderid FROM orders JOIN products ON orders.productId = products.id WHERE orders.userId = '".$_SESSION['id']."' AND orders.paymentMethod IS NULL ORDER BY orders.orderDate DESC");
                    $pendingNum = mysqli_num_rows($pendingQuery);
                    
                    if($pendingNum > 0) {
                    ?>
                    <div class="premium-table-wrapper">
                        <table class="premium-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Shipping</th>
                                    <th>Total</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $cnt = 1;
                                while($row = mysqli_fetch_array($pendingQuery)) {
                                    $qty = $row['qty'];
                                    $price = $row['pprice'];
                                    $shippcharge = $row['shipcharge'];
                                ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td>
                                        <img class="premium-table-img" src="admin/productimages/<?php echo $row['proid']; ?>/<?php echo $row['pimg1']; ?>" alt="Product">
                                    </td>
                                    <td>
                                        <a href="product-details.php?pid=<?php echo $row['opid']; ?>" class="premium-table-product-name"><?php echo htmlentities($row['pname']); ?></a>
                                    </td>
                                    <td><?php echo $qty; ?></td>
                                    <td>₹<?php echo number_format($price); ?></td>
                                    <td>₹<?php echo number_format($shippcharge); ?></td>
                                    <td><strong>₹<?php echo number_format(($qty * $price) + $shippcharge); ?></strong></td>
                                    <td><?php echo $row['odate']; ?></td>
                                    <td>
                                        <a href="my-account.php?deletepending=<?php echo $row['orderid']; ?>#pending-orders" class="premium-table-btn btn-danger" onclick="return confirm('Are you sure you want to delete this order?');">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php $cnt++; } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php } else { ?>
                    <div class="premium-empty-state">
                        <span class="material-symbols-outlined">pending_actions</span>
                        <h3>No Pending Orders</h3>
                        <p>You don't have any orders with pending payment. All caught up!</p>
                    </div>
                    <?php } ?>
                </div>
                
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'?>
<?php } ?>
