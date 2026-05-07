<?php /* WARNING: 2026 redesign — Shop is hand-written for the new design system. NC SiteBuilder Store element + wb_* body chrome have been removed in favor of a static product grid (5 pieces, no e-commerce). The Notify-me flow is the only conversion: clicking a product's quick button opens an inline FormSubmit-backed email capture that posts to amir.akp1@gmail.com with the product slug. Re-saving from the Network Solutions site builder UI WILL wipe these edits. */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "Shop — Barkly Fashion", ENT_QUOTES, 'UTF-8'); ?></title>
	<base href="{{base_url}}" />
	<?php echo isset($sitemapUrls) ? (generateCanonicalUrl($sitemapUrls)."\n") : ""; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "The 2026 Collection — eight pieces, no filler. Sustainable heritage textiles, hand-patterned, crafted in small batches. See any piece on your dog with our AI virtual try-on. Leave your email and we'll write the moment a piece is ready.", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta name="keywords" content="<?php echo htmlspecialchars((isset($seoKeywords) && $seoKeywords !== "") ? $seoKeywords : "dog coats,dog jackets,dog sweaters,dog hoodies,festival dog jacket,brocade dog coat,Kashmiri knit dog sweater,small batch dog apparel,sustainable dog clothing,sustainable pet apparel,eco-friendly dog clothing,ethical dog fashion,AI virtual try-on for dogs,Barkly Fashion shop", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:site_name" content="Barkly Fashion">
	<meta property="og:title" content="<?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "Shop — Barkly Fashion", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "Latest pieces from the 2026 Barkly Fashion collection.", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:image" content="<?php echo htmlspecialchars((isset($seoImage) && $seoImage !== "") ? "{{base_url}}".$seoImage : "{{base_url}}gallery/santa-fe-jacket.jpeg", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{curr_url}}" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Inter+Tight:wght@400;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/barkly-2026.css?ts=20260507m" type="text/css" />
	<ga-code/>
	<link rel="apple-touch-icon" type="image/png" sizes="120x120" href="gallery/favicons/favicon-120x120.png">
	<link rel="icon" type="image/png" sizes="120x120" href="gallery/favicons/favicon-120x120.png">
	<link rel="apple-touch-icon" type="image/png" sizes="180x180" href="gallery/favicons/favicon-180x180.png">
	<link rel="icon" type="image/png" sizes="180x180" href="gallery/favicons/favicon-180x180.png">
	<link rel="icon" type="image/png" href="gallery/favicons/favicon.png">
	<meta name="msvalidate.01" content="D05EFC1E04EBD851B3BBC04C41CA6680" />
</head>
<body data-screen="shop">

<div class="announce">
	<span>Pawsitively elegant — designed for the world</span>
</div>

<header class="site-header">
	<nav class="nav" aria-label="Primary">
		<div class="nav-left">
			<a href="Shop/" class="is-active">Shop</a>
			<a href="Try-On/">Fit guide</a>
			<a href="About-us/">About</a>
		</div>
		<a class="brand" href="{{base_url}}" aria-label="Barkly Fashion home">
			<img class="brand-logo" src="gallery/barklylogo.jpg" alt="" />
		</a>
		<div class="nav-right"></div>
	</nav>
</header>

<section class="shop-head">
	<div>
		<span class="eyebrow">The 2026 Collection</span>
		<h1 class="h-display" style="margin-top:18px;">Latest <span class="it">pieces.</span></h1>
	</div>
	<p class="lede">A tight collection cut from heritage textiles.
		Hand-patterned, made in small batches, fitted for dogs of every breed and shape.
		<strong style="display:block; margin-top:12px; font-weight:500; color:var(--ink);">Each piece is crafted in small lots — leave your email and we'll write the moment it's ready to wear.</strong></p>
</section>

<div class="shop-toolbar">
	<div class="filters" id="filters">
		<button class="filter is-active" data-f="all">All</button>
		<button class="filter" data-f="coats">Coats</button>
		<button class="filter" data-f="sweaters">Sweaters</button>
		<button class="filter" data-f="hoodies">Hoodies</button>
		<button class="filter" data-f="capsule">Festival</button>
	</div>
	<div class="right"></div>
</div>

<section class="products" id="products">
	<article class="product" id="santa-fe-jacket" data-cat="coats" data-slug="santa-fe-jacket" data-name="Jaipur Jacket">
		<div class="product-media">
			<span class="badge hot">Bestseller</span>
			<img src="gallery/santa-fe-jacket.jpeg" alt="Jaipur Jacket" />
			</div>
		<div class="product-info">
			<h3>Jaipur Jacket</h3>
			<div class="meta">Block-printed cotton · XS – L</div>
		</div>
	</article>

	<article class="product" id="scarlet-brocade-coat" data-cat="coats capsule" data-slug="scarlet-brocade-coat" data-name="Brocade Jacket">
		<div class="product-media">
			<span class="badge">New</span>
			<img src="gallery/scarlet-brocade-coat.jpeg" alt="Brocade Jacket" />
			</div>
		<div class="product-info">
			<h3>Brocade Jacket</h3>
			<div class="meta">Silk brocade, quilted lining · XS – M</div>
		</div>
	</article>

	<article class="product" id="nordic-fairisle-sweater" data-cat="sweaters" data-slug="nordic-fairisle-sweater" data-name="Kashmiri Knit Sweater">
		<div class="product-media">
			<span class="badge">Knit</span>
			<img src="gallery/nordic-fairisle-sweater.jpeg" alt="Kashmiri Knit Sweater" />
			</div>
		<div class="product-info">
			<h3>Kashmiri Knit Sweater</h3>
			<div class="meta">Wool-cotton knit · XS – L</div>
		</div>
	</article>

	<article class="product" id="midnight-floral-hoodie" data-cat="hoodies" data-slug="midnight-floral-hoodie" data-name="Midnight Floral Hoodie">
		<div class="product-media">
			<span class="badge hot">Bestseller</span>
			<img src="gallery/midnight-floral-hoodie.jpeg" alt="Midnight Floral Hoodie" />
			</div>
		<div class="product-info">
			<h3>Midnight Floral Hoodie</h3>
			<div class="meta">Brushed cotton, removable hood · XS – L</div>
		</div>
	</article>

	<article class="product" id="lunar-cheongsam" data-cat="coats capsule" data-slug="lunar-cheongsam" data-name="Festival Jacket">
		<div class="product-media">
			<span class="badge">Festival</span>
			<img src="gallery/lunar-cheongsam.jpeg" alt="Festival Jacket" />
			</div>
		<div class="product-info">
			<h3>Festival Jacket</h3>
			<div class="meta">Red &amp; gold brocade · XS – M</div>
		</div>
	</article>

	<article class="product" data-cat="coats" data-slug="santa-fe-bandana" data-name="Jodhpuri Jacket">
		<div class="product-media">
			<span class="badge">Lookbook</span>
			<img src="gallery/IMG_0314.jpg" alt="Jodhpuri Jacket" />
			</div>
		<div class="product-info">
			<h3>Jodhpuri Jacket</h3>
			<div class="meta">Block-print cotton, tie-back · XS – L</div>
		</div>
	</article>

	<article class="product" data-cat="coats" data-slug="heritage-navy-print" data-name="Bagru Indigo Jacket">
		<div class="product-media">
			<span class="badge">Block-print</span>
			<img src="gallery/IMG_0320.jpg" alt="Bagru Indigo Jacket" />
			</div>
		<div class="product-info">
			<h3>Bagru Indigo Jacket</h3>
			<div class="meta">Cotton canvas, indigo block-print · S – L</div>
		</div>
	</article>

	<article class="product" data-cat="coats capsule" data-slug="atelier-lace-coat" data-name="Udaipur Lace Jacket">
		<div class="product-media">
			<span class="badge">Hand-set lace</span>
			<img src="gallery/IMG_9072.jpg" alt="Udaipur Lace Jacket" />
			</div>
		<div class="product-info">
			<h3>Udaipur Lace Jacket</h3>
			<div class="meta">Cotton sateen, hand-set lace · S – M</div>
		</div>
	</article>
</section>

<section class="sizes-strip">
	<div class="sizes-strip-inner">
		<div>
			<span class="eyebrow">Sizing</span>
			<h3 style="font-family:var(--display); font-size:28px; margin:6px 0 0; font-weight:500;">Patterned on real dogs.</h3>
			<p style="margin:6px 0 0; color:var(--ink-soft); font-size:14px;">Measure neck, chest and back length. Or send a photo — we'll size you.</p>
		</div>
		<div class="size-grid">
			<span class="s">XS · 6–14 lb</span>
			<span class="s">S · 14–22 lb</span>
			<span class="s">M · 22–32 lb</span>
			<span class="s">L · 32–55 lb</span>
		</div>
	</div>
</section>

<section class="section" style="padding-top:96px;">
	<div class="section-head">
		<h2 class="h-section">As <span class="it">worn</span> by.</h2>
		<p class="lede">Real dogs, real walks. Tag #barklyfashion to be featured.</p>
	</div>
	<div class="lookbook">
		<div class="lookbook-img">
			<img src="gallery/IMG_0314.jpg" alt="Jodhpuri Jacket" />
			<div class="label">Jodhpuri Jacket</div>
		</div>
		<div class="lookbook-img">
			<img src="gallery/IMG_0320.jpg" alt="Bagru Indigo Jacket" />
			<div class="label">Bagru Indigo Jacket</div>
		</div>
		<div class="lookbook-img">
			<img src="gallery/IMG_9072.jpg" alt="Udaipur Lace Jacket" />
			<div class="label">Udaipur Lace Jacket</div>
		</div>
	</div>
</section>

<?php include dirname(__FILE__).'/_redesign_footer.php'; ?>

<script>
(function () {
	// ---- filter chips ----
	var filters = document.querySelectorAll('#filters .filter');
	var products = document.querySelectorAll('#products .product');

	function applyFilter(cat) {
		filters.forEach(function (b) {
			b.classList.toggle('is-active', b.dataset.f === cat);
		});
		products.forEach(function (p) {
			var cats = (p.dataset.cat || '').split(/\s+/);
			p.style.display = (cat === 'all' || cats.indexOf(cat) !== -1) ? '' : 'none';
		});
		// keep state deep-linkable
		try {
			var u = new URL(window.location.href);
			if (cat === 'all') u.searchParams.delete('cat');
			else u.searchParams.set('cat', cat);
			history.replaceState(null, '', u.toString());
		} catch (e) {}
	}

	filters.forEach(function (btn) {
		btn.addEventListener('click', function () { applyFilter(btn.dataset.f); });
	});

	// initial filter from ?cat=
	try {
		var initial = new URL(window.location.href).searchParams.get('cat');
		if (initial) applyFilter(initial);
	} catch (e) {}

	// ---- notify-me flow ----
	function openNotify(btn) {
		var product = btn.closest('.product');
		if (!product) return;
		var existing = product.querySelector('.notify-form');
		if (existing) {
			var input = existing.querySelector('input[type="email"]');
			if (input) input.focus();
			return;
		}
		var name = product.dataset.name || (product.querySelector('h3') || {}).textContent || 'this piece';
		var slug = product.dataset.slug || '';
		var form = document.createElement('form');
		form.className = 'notify-form';
		form.setAttribute('novalidate', 'novalidate');
		form.innerHTML =
			'<label>Leave your email and we\'ll write the moment <em></em> is ready to wear.</label>' +
			'<div class="row">' +
				'<input type="email" required placeholder="your@email" aria-label="Email address" autocomplete="email" />' +
				'<button type="submit">Notify me</button>' +
			'</div>' +
			'<p class="fineprint">We\'ll only use your email to write you about this piece.</p>' +
			'<p class="err" hidden></p>';
		// safe text insertion (avoid HTML injection from product name)
		form.querySelector('label em').textContent = name;

		form.addEventListener('submit', function (e) {
			e.preventDefault();
			var input = form.querySelector('input[type="email"]');
			var btnEl = form.querySelector('button');
			var errEl = form.querySelector('.err');
			var email = input ? input.value.trim() : '';
			if (!email) {
				if (errEl) { errEl.textContent = 'Please enter a valid email.'; errEl.hidden = false; }
				if (input) input.focus();
				return;
			}
			if (errEl) { errEl.textContent = ''; errEl.hidden = true; }
			if (btnEl) { btnEl.disabled = true; btnEl.textContent = 'Sending'; }

			function done() {
				var confirm = document.createElement('p');
				confirm.className = 'confirm';
				confirm.appendChild(document.createTextNode('✓ We\'ll be in touch about '));
				var nameEl = document.createElement('em');
				nameEl.textContent = name;
				confirm.appendChild(nameEl);
				confirm.appendChild(document.createTextNode('.'));
				form.innerHTML = '';
				form.appendChild(confirm);
			}

			if (typeof fetch !== 'function') { done(); return; }

			/* Persist server-side (CSV) in parallel with email relay */
			try {
				var leadFd = new FormData();
				leadFd.append('email', email);
				leadFd.append('type', 'notify');
				leadFd.append('product', name);
				leadFd.append('slug', slug);
				leadFd.append('source', 'shop:notify-me');
				fetch('barkly-leads.php', { method: 'POST', body: leadFd, keepalive: true });
			} catch (e) { /* never block user flow on logging */ }

			fetch('https://formsubmit.co/ajax/barklyfashion@gmail.com', {
				method: 'POST',
				headers: { 'Accept': 'application/json', 'Content-Type': 'application/json' },
				body: JSON.stringify({
					customer_email: email,
					product_interested_in: name,
					product_slug: slug,
					_subject: 'Notify me — ' + name,
					_replyto: email
				})
			}).then(function () { done(); })
			  .catch(function () {
				// network/relay failed — still confirm to user; the studio captures
				// successful sends server-side; they can re-prompt later if needed
				done();
			});
		});

		product.appendChild(form);
		setTimeout(function () {
			var input = form.querySelector('input[type="email"]');
			if (input) input.focus();
		}, 50);
	}

	document.querySelectorAll('.product .product-media').forEach(function (media) {
		media.setAttribute('role', 'button');
		media.setAttribute('tabindex', '0');
		var product = media.closest('.product');
		var label = product ? (product.dataset.name || '') : '';
		media.setAttribute('aria-label', label ? ('Notify me when ' + label + ' is ready') : 'Notify me when ready');
		media.addEventListener('click', function () { openNotify(media); });
		media.addEventListener('keydown', function (e) {
			if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openNotify(media); }
		});
	});

	// scroll to product grid when "Notify me" in nav is clicked from same page
	var navNotify = document.querySelector('.nav-right a[href="#products"]');
	if (navNotify) {
		navNotify.addEventListener('click', function (e) {
			var target = document.getElementById('products');
			if (target) {
				e.preventDefault();
				target.scrollIntoView({ behavior: 'smooth', block: 'start' });
			}
		});
	}
})();
</script>

{{hr_out}}
</body>
</html>
