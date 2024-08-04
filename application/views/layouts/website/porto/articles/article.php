		<?php 
		$site = $pages['sitelink'];
		?>
		<main class="main">
			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo site_url(); ?>"><i class="icon-home"></i></a></li>
						<li class="breadcrumb-item" aria-current="page">Blog</li>
						<li class="breadcrumb-item" aria-current="page"><?php echo $site['categories']['title']; ?></li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
					</ol>
				</div><!-- End .container -->
			</nav>

			<div class="container">
				<div class="row">
					<div class="col-lg-9">
						<article class="post single">
							<div class="post-media">
								<img src="<?php echo $site['article']['image']; ?>" alt="Post">
							</div><!-- End .post-media -->

							<div class="post-body">
								<div class="post-date">
									<span class="day"><?php echo date("d",strtotime($site['article']['created']));?></span>
									<span class="month"><?php echo date("M",strtotime($site['article']['created']));?></span>
								</div><!-- End .post-date -->

								<h2 class="post-title"><?php echo $site['article']['title']; ?></h2>

								<!--
								<div class="post-meta">
									<a href="#" class="hash-scroll">0 Comments</a>
								</div>
								-->

								<div class="post-content">
									<p>
										<?php echo $site['article']['content']; ?>
									</p>
								</div><!-- End .post-content -->

								<!--
								<div class="post-share">
									<h3 class="d-flex align-items-center">
										<i class="fas fa-share"></i>
										Share this post
									</h3>

									<div class="social-icons">
										<a href="#" class="social-icon social-facebook" target="_blank"
											title="Facebook">
											<i class="icon-facebook"></i>
										</a>
										<a href="#" class="social-icon social-twitter" target="_blank" title="Twitter">
											<i class="icon-twitter"></i>
										</a>
										<a href="#" class="social-icon social-linkedin" target="_blank"
											title="Linkedin">
											<i class="fab fa-linkedin-in"></i>
										</a>
										<a href="#" class="social-icon social-gplus" target="_blank" title="Google +">
											<i class="fab fa-google-plus-g"></i>
										</a>
										<a href="#" class="social-icon social-mail" target="_blank" title="Email">
											<i class="icon-mail-alt"></i>
										</a>
									</div>
								</div>
								-->

								<div class="post-author">
									<h3><i class="far fa-user"></i>Penulis</h3>

									<figure>
										<a href="#">
											<img src="<?php echo site_url('upload/default.png'); ?>" alt="author">
										</a>
									</figure>

									<div class="author-content">
										<h4><a href="#"><?php echo ucfirst($site['article']['author']);?></a></h4>
										<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod
											odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in
											adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis
											placerat, felis enim ornare nisi, vitae mattis nulla ante id dui.</p>
									</div>
								</div>

								<!--
								<div class="comment-respond">
									<h3>Leave a Reply</h3>

									<form action="#">
										<p>Your email address will not be published. Required fields are marked *</p>

										<div class="form-group">
											<label>Comment</label>
											<textarea cols="30" rows="1" class="form-control" required></textarea>
										</div>

										<div class="form-group">
											<label>Name</label>
											<input type="text" class="form-control" required>
										</div>

										<div class="form-group">
											<label>Email</label>
											<input type="email" class="form-control" required>
										</div>

										<div class="form-group">
											<label>Website</label>
											<input type="url" class="form-control">
										</div>

										<div class="form-group-custom-control mb-2">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="save-name">
												<label class="custom-control-label" for="save-name">Save my name, email,
													and website in this browser for the next time I comment.</label>
											</div>
										</div>

										<div class="form-footer my-0">
											<button type="submit" class="btn btn-sm btn-primary">Post
												Comment</button>
										</div>
									</form>
								</div>
								-->
							</div>
						</article>

						<hr class="mt-2 mb-1">

						<div class="related-posts">
							<h4>Artikel<strong> Lainnya</strong></h4>

							<div class="owl-carousel owl-theme related-posts-carousel" data-owl-options="{'dots': false}">
								<?php
								foreach($site['categories']['result_news'] as $v){ 
									$set_url = $pages['sitelink']['categories']['url'].'/'.$v['news_url'];
									$set_image = !empty($v['news_image']) ? site_url().$v['news_image'] : site_url('upload/noimage.png');
          							$set_title = substr($v['news_title'],0,20);
									$set_description = substr(strip_tags($v['news_content']),0,20);										
								?>
								<article class="post">
									<div class="post-media zoom-effect">
										<a href="<?php echo $set_url; ?>">
											<img src="<?php echo $set_image; ?>" alt="Post">
										</a>
									</div><!-- End .post-media -->

									<div class="post-body">
										<div class="post-date">
											<span class="day"><?php echo date("d",strtotime($v['news_date_created']));?></span>
											<span class="month"><?php echo date("M",strtotime($v['news_date_created']));?></span>
										</div><!-- End .post-date -->

										<h2 class="post-title">
											<a href="<?php echo $set_url; ?>"><?php echo $set_title; ?></a>
										</h2>

										<div class="post-content">
											<p><?php echo $set_description; ?></p>
											<a href="<?php echo $set_url; ?>" class="read-more">selengkapnya<i class="fas fa-angle-right"></i></a>
										</div><!-- End .post-content -->
									</div><!-- End .post-body -->
								</article>
								<?php 
								}
								?>
							</div><!-- End .owl-carousel -->
						</div><!-- End .related-posts -->
					</div><!-- End .col-lg-9 -->

					<div class="sidebar-toggle custom-sidebar-toggle">
						<i class="fas fa-sliders-h"></i>
					</div>
					<div class="sidebar-overlay"></div>
					<aside class="sidebar mobile-sidebar col-lg-3">
						<div class="sidebar-wrapper" data-sticky-sidebar-options='{"offsetTop": 72}'>
							<div class="widget widget-categories">
								<h4 class="widget-title">Kategori Blog</h4>

								<ul class="list">
									<?php 
									foreach($site['categories']['result'] as $v){
									?>
									<li><a href="<?php echo $v['category_url']; ?>"><?php echo $v['category_name']; ?></a></li>
									<?php 
									}
									?>
								</ul>
							</div><!-- End .widget -->
							<!--
							<div class="widget">
								<h4 class="widget-title">Recent Posts</h4>

								<ul class="simple-post-list">
									<li>
										<div class="post-media">
											<a href="single.html">
												<img src="<?php echo $asset; ?>assets/images/blog/widget/post-1.jpg" alt="Post">
											</a>
										</div>
										<div class="post-info">
											<a href="single.html">Post Format - Video</a>
											<div class="post-meta">
												April 08, 2018
											</div>
										</div>
									</li>
								</ul>
							</div>

							<div class="widget">
								<h4 class="widget-title">Tags</h4>

								<div class="tagcloud">
									<a href="#">ARTICLES</a>
									<a href="#">CHAT</a>
								</div>
							</div>
							-->
						</div>
					</aside><!-- End .col-lg-3 -->
				</div><!-- End .row -->
			</div><!-- End .container -->
		</main>