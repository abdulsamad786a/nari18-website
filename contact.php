<?php include 'header.php'?>

            <!-- Body Container -->
            <div id="page-content"> 
                <!--Page Header-->
                <div class="page-header text-center">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 d-flex justify-content-between align-items-center">
                                <div class="page-title"><h1>Contact Us</h1></div>
                                <!--Breadcrumbs-->
                                <div class="breadcrumbs"><a href="index.html" title="Back to the home page">Home</a><span class="main-title fw-bold"><i class="icon anm anm-angle-right-l"></i>Contact Us</span></div>
                                <!--End Breadcrumbs-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Page Header-->

                <!--Main Content-->
                <div class="container contact-style1">
                    <!-- Contact Form - Details -->
                    <div class="contact-form-details section pt-0">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                                <!-- Contact Form -->
                                <div class="formFeilds contact-form form-vertical mb-4 mb-md-0">
                                    <div class="section-header">
                                        <h2>From My Heart to Yours</h2>
                                        <p>Every outfit at Nari 18 is crafted with love, care and the belief that every woman deserves to feel beautiful in her own way. Here, you don’t just wear Nari 18—you live it.</p>
                                        <p>Because here, you don’t just wear Nari 18—you live it.</p>
                                    </div>

                                    <form action="php/ajax_sendmail.php" name="contactus" method="post" id="contact-form" class="contact-form">	
                                        <div class="form-row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" id="ContactFormName" name="name" class="form-control" placeholder="Name" />
                                                    <span class="error_msg" id="name_error"></span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">                               
                                                <div class="form-group">
                                                    <input type="email" id="ContactFormEmail" name="email" class="form-control" placeholder="Email" />
                                                    <span class="error_msg" id="email_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <input class="form-control" type="tel" id="ContactFormPhone" name="phone" pattern="[0-9\-]*" placeholder="Phone Number"  />
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                                <div class="form-group">
                                                    <input type="text" id="ContactSubject" name="subject" class="form-control" placeholder="Subject" />
                                                    <span class="error_msg" id="subject_error"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <textarea id="ContactFormMessage" name="message" class="form-control" rows="5" placeholder="Message"></textarea>
                                                    <span class="error_msg" id="message_error"></span>
                                                </div>
                                            </div>  
                                        </div>
                                        <div class="form-row">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                                <div class="form-group mailsendbtn mb-0 w-100">	
                                                    <input class="btn btn-lg" type="submit" name="contactus" value="Send Message" />
                                                    <div class="loading"><img class="img-fluid" src="assets/images/icons/ajax-loader.gif" alt="loading" width="16" height="16"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="response-msg"></div>
                                </div>
                                <!-- End Contact Form -->
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <!-- Contact Details -->
                                <div class="contact-details bg-block">
                                    <h3 class="mb-3 fs-5">VISIT US</h3>
                                    <p>Our studio is not just a space—it’s a little corner where dreams meet design. Step in, feel the fabrics, and let’s style your story together.</p>
                                    <ul class="list-unstyled">
                                        <li class="mb-2 address">
                                            <strong class="d-block mb-2">Address :</strong>
                                            <p><i class="icon anm anm-map-marker-al me-2 d-none"></i> Shop no 119-120, First Floor, SS Omnia, Sector 86, Gurugram, Haryana 122004</p>
                                        </li>
                                        <li class="mb-2 phone"><strong>Phone :</strong><i class="icon anm anm-phone me-2 d-none"></i> <a href="tel:+91-8826446755">+91-8826446755 </a> </li>
                                        <li class="mb-0 email"><strong>Email :</strong><i class="icon anm anm-envelope-l me-2 d-none"></i> <a href="mailto:Info@nari18.com">Info@nari18.com</a>, <a href="mailto:richa@nari18.com">richa@nari18.com</a></li>
                                    </ul>
                                    <hr>
                                    <div class="open-hours">
                                        <strong class="d-block mb-2">Opening Hours</strong>
                                        <p class="lh-lg">
                                            Mon - Sat : 9:30 AM - 6:30 PM<br>
                                            Sunday: Close
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="follow-us">
                                        <label class="d-block mb-3"><strong>Stay Connected</strong></label>
                                         <ul class="list-inline social-icons mt-3">
                                    <li class="list-inline-item"><a href="https://www.facebook.com/share/17CuUJyWF9/" data-bs-toggle="tooltip" data-bs-placement="top" title="Facebook"><i class="icon anm anm-facebook-f"></i></a></li>
                                    <!-- <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Twitter"><i class="icon anm anm-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Pinterest"><i class="icon anm anm-pinterest-p"></i></a></li>
                                    <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Linkedin"><i class="icon anm anm-linkedin-in"></i></a></li> -->
                                    <li class="list-inline-item"><a href="https://www.instagram.com/richa_nari18?igsh=cGt3dDU2MGVheHZs&utm_source=qr" data-bs-toggle="tooltip" data-bs-placement="top" title="Instagram"><i class="icon anm anm-instagram"></i></a></li>
                                    <!-- <li class="list-inline-item"><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Youtube"><i class="icon anm anm-youtube"></i></a></li> -->
                                </ul>
                                    </div>
                                </div>
                                <!-- End Contact Details -->
                            </div>
                        </div>
                    </div>
                    <!-- End Contact Form - Details -->

                    <!-- Contact Map -->
                    <div class="contact-maps section p-0">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="map-section ratio ratio-16x9">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3509.591069046731!2d76.94426707494821!3d28.401416694539268!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d3d7606c9f057%3A0x485a0d1cf85b64d5!2sNari18!5e0!3m2!1sen!2sin!4v1757066337352!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
                                    <div class="map-section-overlay-wrapper">
                                        <div class="map-section-overlay rounded-0">
                                            <h3>Our store</h3>
                                            <div class="content mb-3">
                                                <p class="mb-2">Shop no 119-120, First Floor, SS Omnia, Sector 86, Gurugram, Haryana 122004</p>
                                                <p>Mon - Sat, 9:30am - 6:30pm<br>Sunday, Close</p>
                                            </div>
                                            <p><a href="https://maps.app.goo.gl/gZq1RZfPYDikAFe88" target="_blank" class="btn btn-secondary btn-sm">Get directions</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Contact Map -->
                </div>
                <!--End Main Content-->
            </div>
            <!-- End Body Container -->
<?php include 'footer.php';?>