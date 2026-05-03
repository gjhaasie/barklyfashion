<?php /* Shared footer for the 2026 redesign — included by Home, About, and Shop. */ ?>
<footer class="site-footer">
	<div class="footer-inner">
		<div>
			<div class="brand-name">Barkly</div>
			<p style="margin-top:14px;">Heirloom apparel and accessories for dogs of every shape, made in small batches.</p>
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
		<span>Barkly &mdash; Pawsitively Elegant Attire</span>
	</div>
</footer>

<!-- ── CHATBOT WIDGET ──────────────────────────────────────── -->
<div class="chat-bubble" id="barkly-chat-bubble">
	<div class="chat-panel" id="barkly-chat-panel" hidden>
		<div class="chat-header">
			<div class="chat-header-left">
				<div class="chat-header-title">Barkly Fit Guide</div>
				<div class="chat-header-sub">Sizing &amp; style help</div>
			</div>
			<button class="chat-close" onclick="barklyChat.close()" aria-label="Close chat">&times;</button>
		</div>
		<div class="chat-messages" id="barkly-chat-msgs"></div>
		<div class="chat-footer">
			<input class="chat-input-field" id="barkly-chat-input" type="text" placeholder="Type a reply…" autocomplete="off" />
			<button class="chat-send" onclick="barklyChat.send()" aria-label="Send">&#8594;</button>
		</div>
	</div>
	<button class="chat-toggle" onclick="barklyChat.toggle()" aria-label="Open Barkly Fit Guide" title="Size help">
		<span>&#128041;</span>
	</button>
</div>

<script>
/* ── Barkly Fit Guide chatbot ──────────────────────────────── */
var barklyChat = (function () {
	var panel  = document.getElementById('barkly-chat-panel');
	var msgs   = document.getElementById('barkly-chat-msgs');
	var input  = document.getElementById('barkly-chat-input');
	var opened = false;
	var step   = 0;
	var dogName, dogWeight, dogBreed;

	var PRODUCTS = [
		{ name:'Santa Fe Jacket',       tag:'Signature',  img:'gallery/santa-fe-jacket.jpeg' },
		{ name:'Scarlet Brocade Coat',  tag:'New',        img:'gallery/scarlet-brocade-coat.jpeg' },
		{ name:'Midnight Floral Hoodie',tag:'Bestseller', img:'gallery/midnight-floral-hoodie.jpeg' },
		{ name:'Nordic Fairisle',       tag:'Knitwear',   img:'gallery/nordic-fairisle-sweater.jpeg' },
		{ name:'Lunar Cheongsam',       tag:'Capsule',    img:'gallery/lunar-cheongsam.jpeg' }
	];
	var SIZES = {
		XS: { label:'XS', chest:'8–11 in', neck:'5–8 in',   note:'For the tiniest pups.' },
		S:  { label:'S',  chest:'12–16 in', neck:'8–11 in',  note:'Our most popular size.' },
		M:  { label:'M',  chest:'16–21 in', neck:'11–14 in', note:'Great for stocky small breeds.' },
		L:  { label:'L',  chest:'21–27 in', neck:'14–18 in', note:'For the bigger beauties.' }
	};

	function addMsg(role, html) {
		var d = document.createElement('div');
		d.className = 'chat-msg ' + role;
		d.innerHTML = html;
		msgs.appendChild(d);
		msgs.scrollTop = msgs.scrollHeight;
	}

	function addProducts(sizeLabel) {
		var wrap = document.createElement('div');
		wrap.className = 'chat-products';
		PRODUCTS.slice(0, 3).forEach(function(p) {
			var a = document.createElement('a');
			a.className = 'chat-product'; a.href = 'Shop/';
			a.innerHTML = '<img src="' + p.img + '" alt="' + p.name + '" />' +
				'<div class="chat-product-info">' +
				'<div class="chat-product-name">' + p.name + '</div>' +
				'<div class="chat-product-size">Size ' + sizeLabel + ' available</div>' +
				'</div>';
			wrap.appendChild(a);
		});
		var holder = document.createElement('div');
		holder.className = 'chat-msg bot';
		holder.style.maxWidth = '100%'; holder.style.padding = '0'; holder.style.border = 'none'; holder.style.background = 'transparent';
		holder.appendChild(wrap);
		msgs.appendChild(holder);
		msgs.scrollTop = msgs.scrollHeight;
	}

	function botDelay(html, ms) {
		setTimeout(function() { addMsg('bot', html); }, ms || 400);
	}

	function start() {
		step = 0; dogName = ''; dogWeight = 0; dogBreed = '';
		msgs.innerHTML = '';
		addMsg('bot', "Hi! I'm the Barkly fit guide. 🐾<br/>What's your dog's name?");
		input.placeholder = 'Type a name…';
	}

	function handleInput(val) {
		val = val.trim();
		if (!val) return;
		addMsg('user', val);

		if (step === 0) {
			dogName = val.charAt(0).toUpperCase() + val.slice(1);
			step = 1;
			botDelay("Great name! 🐶 How much does <strong>" + dogName + "</strong> weigh? <em>(in lbs)</em>");
			input.placeholder = 'Weight in lbs…';
		} else if (step === 1) {
			var w = parseFloat(val.replace(/[^0-9.]/g, ''));
			if (!w || isNaN(w) || w <= 0) {
				botDelay("Hmm, I need a number in lbs — like <em>8</em> or <em>14.5</em>.");
				return;
			}
			dogWeight = w;
			step = 2;
			botDelay("Got it! Last one: what breed is " + dogName + "? <em>(or just say 'skip')</em>");
			input.placeholder = 'Breed or skip…';
		} else if (step === 2) {
			dogBreed = (val.toLowerCase() === 'skip' || val.toLowerCase() === 'n/a') ? '' : val;
			step = 3;
			showResult();
		} else {
			/* post-result follow-up */
			var lv = val.toLowerCase();
			if (lv.indexOf('shop') !== -1 || lv.indexOf('buy') !== -1 || lv.indexOf('order') !== -1) {
				botDelay('Head to <a href="Shop/" style="color:var(--scarlet);text-decoration:underline;">our shop</a> to see everything in the 2026 collection.');
			} else if (lv.indexOf('try') !== -1 || lv.indexOf('fit') !== -1 || lv.indexOf('room') !== -1) {
				botDelay('Check out the <a href="Try-On/" style="color:var(--scarlet);text-decoration:underline;">Style Finder page</a> to build your own lookbook moment!');
			} else if (lv.indexOf('return') !== -1 || lv.indexOf('exchange') !== -1) {
				botDelay('We offer free re-lining and re-stitching on any Barkly piece. Email us at <a href="mailto:barklyfashion@gmail.com" style="color:var(--scarlet);">barklyfashion@gmail.com</a> and we\'ll sort it out.');
			} else if (lv.indexOf('again') !== -1 || lv.indexOf('restart') !== -1 || lv.indexOf('another') !== -1) {
				setTimeout(start, 200);
			} else {
				botDelay('I\'m best at sizing help! Type <em>restart</em> to find a size for another dog, or visit the <a href="Shop/" style="color:var(--scarlet);text-decoration:underline;">shop</a> to browse the full collection.');
			}
		}
	}

	function showResult() {
		var key = dogWeight < 5 ? 'XS' : dogWeight <= 12 ? 'S' : dogWeight <= 25 ? 'M' : 'L';
		var sz  = SIZES[key];
		var who = dogName || 'your dog';
		var breedNote = dogBreed ? ' ' + dogBreed + 's are a great fit for this size.' : '';

		addMsg('bot',
			'<strong>' + who + ' wears a size <span style="color:var(--scarlet);font-family:var(--display);font-size:22px;">' + sz.label + '</span></strong><br/>' +
			sz.note + breedNote + '<br/>' +
			'<span style="font-size:12px;color:var(--ink-soft);">Chest: ' + sz.chest + ' &nbsp;·&nbsp; Neck: ' + sz.neck + '</span>'
		);
		setTimeout(function() {
			addMsg('bot', 'Here are three pieces that would look <em>wonderful</em> on ' + who + ':');
			addProducts(sz.label);
			setTimeout(function() {
				addMsg('bot', 'Want to see how they&rsquo;d look? Try the <a href="Try-On/" style="color:var(--scarlet);text-decoration:underline;">Fitting Room &rarr;</a>');
				input.placeholder = 'Any questions?';
			}, 600);
		}, 600);
	}

	input.addEventListener('keydown', function(e) {
		if (e.key === 'Enter') { send(); }
	});

	return {
		toggle: function() {
			if (!opened) { opened = true; panel.hidden = false; start(); input.focus(); }
			else { panel.hidden = !panel.hidden; if (!panel.hidden) input.focus(); }
		},
		close: function() { panel.hidden = true; },
		send: function() {
			var v = input.value.trim();
			if (!v) return;
			input.value = '';
			handleInput(v);
		}
	};
})();
</script>

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
				/* Server-side capture (CSV) in parallel with email relay */
				try {
					var leadFd = new FormData();
					leadFd.append('email', email);
					leadFd.append('type', 'newsletter');
					leadFd.append('source', 'footer:newsletter');
					fetch('/barkly-leads.php', { method: 'POST', body: leadFd, keepalive: true });
				} catch (e) { /* never block submit on logging */ }

				fetch('https://formsubmit.co/ajax/barklyfashion@gmail.com', {
					method: 'POST',
					headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
					body: JSON.stringify({ email: email, _subject: 'Newsletter signup' })
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
