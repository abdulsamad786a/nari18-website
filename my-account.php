<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{   
    header('location:login.php');
}
else{
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

date_default_timezone_set('Asia/Kolkata');// change according timezone
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
        max-width: 768px;
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

// Tab switching functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabLinks = document.querySelectorAll('[data-tab]');
    const tabContents = document.querySelectorAll('.premium-tab-content');
    
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if(this.getAttribute('href') === '#') {
                e.preventDefault();
            }
            
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
        });
    });
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
                    <a href="bill-ship-addresses.php" class="premium-nav-item">
                        <span class="premium-nav-text">Shipping / Billing Address</span>
                        <span class="material-symbols-outlined premium-nav-arrow">chevron_right</span>
                    </a>
                    <a href="order-history.php" class="premium-nav-item">
                        <span class="premium-nav-text">Order History</span>
                        <span class="material-symbols-outlined premium-nav-arrow">chevron_right</span>
                    </a>
                    <a href="track-orders.php" class="premium-nav-item">
                        <span class="premium-nav-text">Track Order</span>
                        <span class="material-symbols-outlined premium-nav-arrow">chevron_right</span>
                    </a>
                    <a href="pending-orders.php" class="premium-nav-item">
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
                
            </div>
        </div>
    </main>
</div>

<?php include 'footer.php'?>
<?php } ?>
