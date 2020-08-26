<?php 
include 'inc/header.php';?>


				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Inbox</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Mailbox</span></li>
								<li><span>Inbox</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->
					<section class="content-with-menu mailbox">
						<div class="content-with-menu-container" data-mailbox data-mailbox-view="folder">
							<div class="inner-menu-toggle">
								<a href="#" class="inner-menu-expand" data-open="inner-menu">
									Show Menu <i class="fa fa-chevron-right"></i>
								</a>
							</div>
							
							<menu id="content-menu" class="inner-menu" role="menu">
								<div class="nano">
									<div class="nano-content">
							
										<div class="inner-menu-toggle-inside">
											<a href="#" class="inner-menu-collapse">
												<i class="fa fa-chevron-up visible-xs-inline"></i><i class="fa fa-chevron-left hidden-xs-inline"></i> Hide Menu
											</a>
							
											<a href="#" class="inner-menu-expand" data-open="inner-menu">
												Show Menu <i class="fa fa-chevron-down"></i>
											</a>
										</div>

	<div class="inner-menu-content">
		<a href="mailCompose.php" class="btn btn-block btn-primary btn-md pt-sm pb-sm text-md">
			<i class="fa fa-envelope mr-xs"></i>
			Compose
		</a>

		<ul class="list-unstyled mt-xl pt-md">
				<li>
				<a href="mailInboxList.php" class="menu-item active">Inbox <span class="label label-primary text-weight-normal pull-right">43</span></a>
				</li>
				<li>
				<a href="mailsentList.php" class="menu-item">Sent</a>
				</li>
		</ul>

		<hr class="separator" />


		


	</div>
									</div>
								</div>
							</menu>

							<div class="inner-body mailbox-folder">
								<!-- START: .mailbox-header -->
								<header class="mailbox-header">
									<div class="row">
										<div class="col-sm-6">
											<h1 class="mailbox-title text-weight-light m-none">
												<a id="mailboxToggleSidebar" class="sidebar-toggle-btn trigger-toggle-sidebar">
													<span class="line"></span>
													<span class="line"></span>
													<span class="line"></span>
													<span class="line line-angle1"></span>
													<span class="line line-angle2"></span>
												</a>
							
												Inbox
											</h1>
										</div>
										<div class="col-sm-6">
											<div class="search">
												<div class="input-group input-search">
													<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
													<span class="input-group-btn">
														<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
													</span>
												</div>
											</div>
										</div>
									</div>
								</header>
								<!-- END: .mailbox-header -->
							
								<!-- START: .mailbox-actions -->
								<div class="mailbox-actions">
									<ul class="list-unstyled m-none pt-lg pb-lg">
										<li class="ib mr-sm">
											<div class="btn-group">
												<a href="#" class="item-action fa fa-chevron-down dropdown-toggle" data-toggle="dropdown"></a>
							
												<ul class="dropdown-menu" role="menu">
													<li><a href="#">All</a></li>
													<li><a href="#">None</a></li>
													<li><a href="#">Read</a></li>
													<li><a href="#">Unread</a></li>
													<li><a href="#">Starred</a></li>
													<li><a href="#">Unstarred</a></li>
												</ul>
											</div>
										</li>
										<li class="ib mr-sm">
											<a class="item-action fa fa-refresh" href="#"></a>
										</li>
										<li class="ib mr-sm">
											<a class="item-action fa fa-tag" href="#"></a>
										</li>
										<li class="ib">
											<a class="item-action fa fa-times text-danger" href="#"></a>
										</li>
									</ul>
								</div>
								<!-- END: .mailbox-actions -->
							
								<div id="mailbox-email-list" class="mailbox-email-list">
									<div class="nano">
										<div class="nano-content">
											<ul id="" class="list-unstyled">
							
												<li class="unread">
													<a href="#">
														<div class="col-sender">
															<div class="checkbox-custom checkbox-text-primary ib">
																<input type="checkbox" id="mail1">
																<label for="mail1"></label>
															</div>
															<p class="m-none ib">Mushfiqur rahman</p>
														</div>
														<div class="col-mail">
															<p class="m-none mail-content">
																<span class="subject">Inbox For Testing  &nbsp;–&nbsp;</span>
																<span class="mail-partial">Here Testing Inbox are Coming Under Processing</span>
															</p>
															<p class="m-none mail-date">11:35 am</p>
														</div>
													</a>
												</li>
							
						
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>



<?php include 'inc/footer.php'; ?>

