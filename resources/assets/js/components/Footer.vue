<template>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-3">
              	<h3>Secure payments with</h3>
                <p><img src="img/cards.png" alt="" class="img-responsive"></p>
                
            </div>
            <div class="col-md-4 col-sm-3">
                <h3>About</h3>
                <ul>
                    <li><a href="javascript:void(0);">About us</a></li>
                    <!-- <li><a href="#0" data-toggle="modal" data-target="#login_2">Login</a></li>
                    <li><a href="#0" data-toggle="modal" data-target="#register">Register</a></li> -->
                    <li><a href="javascript:void(0);">Privacy Policy</a></li>
                    <li><a href="javascript:void(0);">Terms and conditions</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-sm-3"  id="newsletter">
                <h3>Newsletter</h3>
                <p>Join our newsletter to keep be informed about offers and news.</p>
				<div id="message-newsletter_2"></div>
					<form method="post" action="assets/newsletter.php" name="newsletter_2" id="newsletter_2">
                    <div class="form-group">
                        <input name="email_newsletter_2" id="email_newsletter_2"  type="email" value=""  placeholder="Your mail" class="form-control">
                      </div>
                        <input type="submit" value="Subscribe" class="btn_1" id="submit-newsletter_2">
                	</form>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <p>© Mother's Serve</p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer>
</template>

<script>
export default {
	data() {
		return {}
	},

	methods: {}
}
</script>