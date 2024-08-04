		<main class="main">
			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?php echo site_url(); ?>"><i class="icon-home"></i></a></li>
						<li class="breadcrumb-item" aria-current="page">Blog</li>
						<li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
					</ol>
				</div><!-- End .container -->
			</nav>

			<div class="container">
				<div class="row">
					<div class="col-lg-9">
						<div class="blog-section row">
							<?php 
							foreach($pages['sitelink']['categories']['result_news'] as $v){
								$set_url = $pages['sitelink']['categories']['url'].'/'.$v['news_url'];
								$set_image = !empty($v['news_image']) ? site_url().$v['news_image'] : site_url('upload/noimage.png');
          						$set_title = substr($v['news_title'],0,20);
								$set_description = substr(strip_tags($v['news_content']),0,20);								
							?>
							<div class="col-md-6 col-lg-4">
								<article class="post">
									<div class="post-media">
										<a href="<?php echo $set_url; ?>">
											<img src="<?php echo $set_image; ?>" alt="Post" width="225"
												height="280">
										</a>
										<div class="post-date">
											<span class="day"><?php echo date("d",strtotime($v['news_date_created']));?></span>
											<span class="month"><?php echo date("M",strtotime($v['news_date_created']));?></span>
										</div>
									</div><!-- End .post-media -->

									<div class="post-body">
										<h2 class="post-title">
											<a href="<?php echo $set_url;?>"><?php echo $set_title;?></a>
										</h2>
										<div class="post-content">
											<p><?php echo $set_description; ?></p>
										</div><!-- End .post-content -->
										<!-- <a href="<?php #echo $set_url; ?>" class="post-comment">0 Comments</a> -->
									</div><!-- End .post-body -->
								</article><!-- End .post -->
							</div>
							<?php 
							}
							?>
						</div>
					</div><!-- End .col-lg-9 -->

					<div class="sidebar-toggle custom-sidebar-toggle">
						<i class="fas fa-sliders-h"></i>
					</div>
					<div class="sidebar-overlay"></div>
					<aside class="sidebar mobile-sidebar col-lg-3">
						<div class="sidebar-wrapper" data-sticky-sidebar-options='{"offsetTop": 72}'>
							<div class="widget widget-categories">
								<h4 class="widget-title">Blog Categories</h4>

								<ul class="list">
									<?php 
									foreach($pages['sitelink']['categories']['result'] as $v){						
									?>
									<li><a href="<?php echo $v['category_url']; ?>"><?php echo $v['category_name']; ?></a></li>
									<?php 
									}
									?>
								</ul>
							</div><!-- End .widget -->

							<div class="widget widget-post">
								<h4 class="widget-title">Popular Blog</h4>

								<ul class="simple-post-list">
									<?php 
									foreach($pages['sitelink']['categories']['result_popular'] as $v){
										$set_url = $pages['sitelink']['categories']['url'].'/'.$v['news_url'];
										$set_image = site_url().$v['news_image'];
										$set_title = substr($v['news_title'],0,20);
										$set_description = substr(strip_tags($v['news_content']),0,20);								
									?>									
									<li>
										<div class="post-media">
											<a href="<?php echo $set_url; ?>">
												<img src="<?php echo $set_image; ?>" alt="Post">
											</a>
										</div>
										<div class="post-info">
											<a href="<?php echo $set_url; ?>"><?php echo $set_title; ?></a>
											<div class="post-meta"><?php echo date("d-M-Y",strtotime($v['news_date_created']));?></div>
										</div>
									</li>
									<?php 
									}
									?>
								</ul>
							</div><!-- End .widget -->

							<!--
							<div class="widget">
								<h4 class="widget-title">Tags</h4>

								<div class="tagcloud">
									<a href="#">ARTICLES</a>
									<a href="#">CHAT</a>
								</div>
							</div>
							-->
						</div><!-- End .sidebar-wrapper -->
					</aside><!-- End .col-lg-3 -->
				</div><!-- End .row -->
			</div><!-- End .container -->
		</main>