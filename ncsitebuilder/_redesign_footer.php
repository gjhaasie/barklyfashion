<?php /* Shared footer for the 2026 redesign — included by Home, About, and Shop. */ ?>
<footer class="site-footer">
	<div class="footer-inner">
		<div>
			<div class="brand-name">Barkly</div>
			<p style="margin-top:14px;">Heirloom apparel and accessories for dogs of every shape, sewn in small batches in the San Francisco Bay Area.</p>
		</div>
		<div>
			<h4>Shop</h4>
			<ul>
				<li><a href="Shop/">All apparel</a></li>
			</ul>
		</div>
		<div>
			<h4>House</h4>
			<ul>
				<li><a href="About-us/">Our story</a></li>
			</ul>
		</div>
		<div>
			<h4>Stay in touch</h4>
			<p style="font-size:13px;">New drops, restocks and the occasional studio note.</p>
			<form class="newsletter-form" data-newsletter action="https://formsubmit.co/amir.akp1@gmail.com" method="POST">
				<input type="text" name="_honey" value="" tabindex="-1" autocomplete="off" style="display:none" aria-hidden="true" />
				<input type="hidden" name="_subject" value="Barkly newsletter signup" />
				<input type="hidden" name="_template" value="table" />
				<input type="hidden" name="_captcha" value="false" />
				<input type="email" name="email" placeholder="your@email" required aria-label="Email address" />
				<button type="submit"><span>Join &rarr;</span></button>
			</form>
		</div>
	</div>
	<div class="footer-bottom">
		<span>&copy; <?php echo date('Y'); ?> Barkly Fashion</span>
		<span>San Francisco · Berkeley · Online everywhere</span>
	</div>
</footer>

<script>
(function () {
	var forms = document.querySelectorAll('form[data-newsletter]');
	for (var i = 0; i < forms.length; i++) {
		(function (form) {
			form.addEventListener('submit', function (e) {
				var honey = form.querySelector('input[name="_honey"]');
				if (honey && honey.value) { e.preventDefault(); return; }
				if (typeof fetch !== 'function') return; // native POST fallback
				e.preventDefault();
				var emailInput = form.querySelector('input[name="email"]');
				var email = emailInput ? emailInput.value.trim() : '';
				if (!email) return;
				var btn = form.querySelector('button');
				if (btn) btn.disabled = true;
				fetch('https://formsubmit.co/ajax/amir.akp1@gmail.com', {
					method: 'POST',
					headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
					body: JSON.stringify({ email: email, _subject: 'Barkly newsletter signup' })
				}).then(function () { /* swallow — show thanks regardless */ })
				  .catch(function () {})
				  .then(function () {
					var thanks = document.createElement('div');
					thanks.className = 'newsletter-form is-done';
					thanks.textContent = 'Thanks ✓';
					form.parentNode.replaceChild(thanks, form);
				});
			});
		})(forms[i]);
	}
})();
</script>
