		<div class="overlay toggle-btn-mobile"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<!--footer -->
		<div class="footer">
			<p class="mb-0">Developed By : <a href="https://github.com/nikkoenggaliano" target="_blank">NepSka</a>
			<?php echo date('Y'); ?></p>
		</div>
		<!-- end footer -->
	</div>
	<!-- end wrapper -->
	<!--start switcher-->
<!-- 	<div class="switcher-wrapper">
		<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
		</div>
		<div class="switcher-body">
			<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
			<hr/>
			<h6 class="mb-0">Theme Styles</h6>
			<hr/>
			<div class="d-flex align-items-center justify-content-between">
				<div class="custom-control custom-radio">
					<input type="radio" id="darkmode" name="customRadio" class="custom-control-input">
					<label class="custom-control-label" for="darkmode">Dark Mode</label>
				</div>
				<div class="custom-control custom-radio">
					<input type="radio" id="lightmode" name="customRadio" checked class="custom-control-input">
					<label class="custom-control-label" for="lightmode">Light Mode</label>
				</div>
			</div>
			<hr/>
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="DarkSidebar">
				<label class="custom-control-label" for="DarkSidebar">Dark Sidebar</label>
			</div>
			<hr/>
			<div class="custom-control custom-switch">
				<input type="checkbox" class="custom-control-input" id="ColorLessIcons">
				<label class="custom-control-label" for="ColorLessIcons">Color Less Icons</label>
			</div>
		</div>
	</div> -->
	<!--end switcher-->
	<!-- JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="<?php echo fixdir; ?>assets/js/jquery.min.js"></script>
	<script src="<?php echo fixdir; ?>assets/js/popper.min.js"></script>
	<script src="<?php echo fixdir; ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo fixdir; ?>assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
	<script src="<?php echo fixdir; ?>assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
	<!--plugins-->
	<script src="<?php echo fixdir; ?>assets/plugins/simplebar/js/simplebar.min.js"></script>
	<script src="<?php echo fixdir; ?>assets/plugins/metismenu/js/metisMenu.min.js"></script>
	<!-- App JS -->
	<script src="<?php echo fixdir; ?>assets/js/app.js"></script>
</body>
</html>

<?php ob_end_flush(); ?>