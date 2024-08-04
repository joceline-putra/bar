        <footer class="footer bg-dark">
            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Kontak Kami</h4>
                                <ul class="contact-info">
                                    <li>
                                        <span class="contact-info-label">Alamat:</span><?php echo $link['contact']['address']['office'].'<br>'.$link['contact']['address']['city'].'<br>'.$link['contact']['address']['state']; ?>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Telepon:</span>
                                            <a href="tel:"><?php echo $link['contact']['phone'][0]['phone'];?></a>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Email:</span> 
                                        <a href="#">
                                                <?php echo $link['contact']['email'][0]['email'];?>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <span class="contact-info-label">Jam Kerja:</span><?php echo $link['contact']['work_hour'];?>
                                    </li>
                                </ul>
                                <div class="social-icons">
                                    <?php 
                                    if(!empty($link)){
                                        foreach($link['social'] as $v){
                                        ?>
                                        <a href="<?php echo $v['url'];?>" class="<?php echo $v['icon'];?>" target="_blank" title="<?php echo $v['name'];?>"></a>
                                        <?php 
                                        }
                                    }
                                    ?>
                                </div>
                                <!-- End .social-icons -->
                            </div>
                            <!-- End .widget -->
                        </div>
                        <!-- End .col-lg-3 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Layanan Pelanggan</h4>

                                <ul class="links">
                                    <!-- <li><a href="<?php #echo $link['faqs'];?>">Help & FAQs</a></li> -->
                                    <!-- <li><a href="<?php #echo $link['tracking'];?>">Order Tracking</a></li> -->
                                    <!-- <li><a href="<?php #echo $link['shipping'];?>">Shipping & Delivery</a></li> -->
                                    <!-- <li><a href="<?php #echo $link['history'];?>">Orders History</a></li> -->
                                    <li><a href="<?php echo $link['account'];?>">My Account</a></li>
                                    <li><a href="<?php echo $link['career'];?>">Careers</a></li>
                                    <li><a href="<?php echo $link['about'];?>">About Us</a></li>
                                    <li><a href="<?php echo $link['privacy'];?>">Privacy</a></li>
                                </ul>
                            </div>
                            <!-- End .widget -->
                        </div>
                        <!-- End .col-lg-3 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Produk</h4>

                                <div class="tagcloud">
                                    <!-- <a href="#">Bag</a> -->
                                    <?php 
                                    if(!empty($link['product_category'])){
                                        foreach($link['product_category'] as $v){
                                            echo "<a href='".site_url().$link['routing']['product'].'/'.$v['category_url']."'>".$v['category_name']."</a>"; 
                                        }
                                    }
                                    ?>                                    
                                </div>
                            </div>
                            <!-- End .widget -->
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Blog</h4>

                                <div class="tagcloud">
                                    <!-- <a href="#">Bag</a> -->
                                    <?php 
                                    if(!empty($link['article_category'])){
                                        foreach($link['article_category'] as $v){
                                            echo "<a href='".site_url().$link['routing']['blog'].'/'.$v['category_url']."'>".$v['category_name']."</a>"; 
                                        }
                                    }
                                    ?>                                    
                                </div>
                            </div>
                            <!-- End .widget -->
                        </div>                        
                        <!-- End .col-lg-3 -->

                        <!-- <div class="col-lg-3 col-sm-6">
                            <div class="widget widget-newsletter">
                                <h4 class="widget-title">Subscribe newsletter</h4>
                                <p>Get all the latest information on events, sales and offers. Sign up for newsletter:
                                </p>
                                <form action="#" class="mb-0">
                                    <input type="email" class="form-control m-b-3" placeholder="Email address" required>

                                    <input type="submit" class="btn btn-primary shadow-none" value="Subscribe">
                                </form>
                            </div>
                        </div> -->
                        <!-- End .col-lg-3 -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .footer-middle -->

            <div class="container">
                <div class="footer-bottom">
                    <div class="container d-sm-flex align-items-center">
                        <div class="footer-left">
                            <span class="footer-copyright">© <?php echo $link['brand'].". ".date("Y");?>. All Rights Reserved</span>
                        </div>

                        <div class="footer-right ml-auto mt-1 mt-sm-0">
                            <div class="payment-icons">
                                <span class="payment-icon visa" style="background-image: url(<?php echo $asset; ?>assets/images/payments/payment-visa.svg)"></span>
                                <span class="payment-icon paypal" style="background-image: url(<?php echo $asset; ?>assets/images/payments/payment-paypal.svg)"></span>
                                <span class="payment-icon stripe" style="background-image: url(<?php echo $asset; ?>assets/images/payments/payment-stripe.png)"></span>
                                <span class="payment-icon verisign" style="background-image:  url(<?php echo $asset; ?>assets/images/payments/payment-verisign.svg)"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .footer-bottom -->
            </div>
            <!-- End .container -->
        </footer>



