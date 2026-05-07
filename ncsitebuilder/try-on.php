<?php /* WARNING: 2026 redesign — Style Finder & Fitting Room. NC SiteBuilder wb_* chrome removed. Re-saving from the Network Solutions builder UI WILL wipe these edits. */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "Style Finder — Barkly Fashion", ENT_QUOTES, 'UTF-8'); ?></title>
	<base href="{{base_url}}" />
	<?php echo isset($sitemapUrls) ? (generateCanonicalUrl($sitemapUrls)."\n") : ""; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="AI virtual try-on for dogs — upload a photo and see your dog wearing any Barkly piece. Plus a quick size finder using weight and breed." />
	<meta name="keywords" content="AI virtual try-on for dogs,AI dog try-on,virtual dog clothing try-on,dog jacket try-on,dog size finder,sustainable dog clothing,sustainable pet apparel,eco-friendly dog clothing,Barkly Fashion fitting room" />
	<meta property="og:site_name" content="Barkly Fashion">
	<meta property="og:title" content="Style Finder — Barkly Fashion" />
	<meta property="og:description" content="Find your dog's perfect Barkly size and see exactly how a Barkly jacket could look on them." />
	<meta property="og:image" content="{{base_url}}gallery/scarlet-brocade-coat.jpeg" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{curr_url}}" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Inter+Tight:wght@400;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/barkly-2026.css?ts=20260507n" type="text/css" />
	<ga-code/>
	<link rel="apple-touch-icon" type="image/png" sizes="120x120" href="gallery/favicons/favicon-120x120.png">
	<link rel="icon" type="image/png" sizes="120x120" href="gallery/favicons/favicon-120x120.png">
	<link rel="apple-touch-icon" type="image/png" sizes="180x180" href="gallery/favicons/favicon-180x180.png">
	<link rel="icon" type="image/png" sizes="180x180" href="gallery/favicons/favicon-180x180.png">
	<link rel="icon" type="image/png" href="gallery/favicons/favicon.png">
	<meta name="msvalidate.01" content="D05EFC1E04EBD851B3BBC04C41CA6680" />
</head>
<body data-screen="tryon">

<div class="announce">
	<span>Pawsitively elegant — designed for the world</span>
</div>

<header class="site-header">
	<nav class="nav" aria-label="Primary">
		<div class="nav-left">
			<a href="Shop/">Shop</a>
			<a href="Try-On/" class="is-active">Fit guide</a>
			<a href="About-us/">About</a>
		</div>
		<a class="brand" href="{{base_url}}" aria-label="Barkly Fashion home">
			<img class="brand-logo" src="gallery/barklylogo.jpg" alt="" />
		</a>
		<div class="nav-right"></div>
	</nav>
</header>

<!-- Hero -->
<section class="about-hero" style="padding-bottom: 56px;">
	<span class="eyebrow">Style finder</span>
	<h1 class="h-display">Find the <span class="it">perfect</span> fit.</h1>
	<p class="lede">Tell us about your dog and we'll find their size — and which Barkly pieces were made for them.</p>
</section>

<div class="weave" aria-hidden="true" style="margin-top:0;"></div>

<!-- ── FITTING ROOM (AI-powered) — moved up to be the first interactive section ── -->
<section class="fitting-room-section" style="margin-top:0;">
	<div class="fitting-room-inner">
		<div>
			<span class="eyebrow">Fitting room · AI</span>
			<h2 class="h-section" style="margin-top:18px;">See it on <span class="it">your dog.</span></h2>
			<p class="lede" style="margin-top:18px;">Upload your dog's photo, pick a Barkly piece. Our AI dresses them in 8&ndash;15 seconds — same dog, same pose, just the jacket added.</p>
			<div class="fitting-actions" style="margin-top:28px;">
				<label class="btn" for="fit-upload" style="cursor:pointer; display:inline-flex; align-items:center; gap:10px; background:var(--terracotta); border-color:var(--terracotta); color:#fff; box-shadow:0 4px 14px rgba(199,89,53,0.35);">
					Upload photo <span class="arrow" style="transform:rotate(-90deg);">&#8594;</span>
				</label>
				<input type="file" id="fit-upload" accept="image/jpeg,image/png,image/webp" style="display:none" />
				<a class="btn" id="fit-shop-cta" href="Shop/" style="display:none; background:var(--terracotta); border-color:var(--terracotta);">Shop the <span id="fit-shop-cta-name">style</span> <span class="arrow">&rarr;</span></a>
				<button class="btn ghost" id="fit-download" onclick="barklyDownload()" style="display:none; border-color:var(--cream); color:var(--cream);">Download <span class="arrow" style="transform:rotate(90deg);">&#8594;</span></button>
			</div>
			<p class="lede" style="font-size:15px; margin-top:10px; color:rgba(244,234,215,0.85);">Let AI pick the right piece for your dog &mdash; or choose one yourself.</p>
			<div class="fit-swatches" id="fit-swatches">
				<button class="fit-swatch fit-swatch-auto" data-slug="auto" onclick="barklyTryOn('auto',this)" title="AI picks for your dog">
					<span class="fit-swatch-auto-label">AI picks</span>
				</button>
				<button class="fit-swatch" data-slug="santa-fe" onclick="barklyTryOn('santa-fe',this)" title="Sikar Jacket">
					<img src="gallery/santa-fe-jacket.jpeg" alt="Sikar Jacket" />
				</button>
				<button class="fit-swatch" data-slug="scarlet-brocade" onclick="barklyTryOn('scarlet-brocade',this)" title="Brocade Jacket">
					<img src="gallery/scarlet-brocade-coat.jpeg" alt="Brocade Jacket" />
				</button>
				<button class="fit-swatch" data-slug="midnight-floral" onclick="barklyTryOn('midnight-floral',this)" title="Midnight Floral Hoodie">
					<img src="gallery/midnight-floral-hoodie.jpeg" alt="Midnight Floral Hoodie" />
				</button>
				<button class="fit-swatch" data-slug="nordic-fairisle" onclick="barklyTryOn('nordic-fairisle',this)" title="Kashmiri Knit Sweater">
					<img src="gallery/nordic-fairisle-sweater.jpeg" alt="Kashmiri Knit Sweater" />
				</button>
				<button class="fit-swatch" data-slug="lunar-cheongsam" onclick="barklyTryOn('lunar-cheongsam',this)" title="Festival Jacket">
					<img src="gallery/lunar-cheongsam.jpeg" alt="Festival Jacket" />
				</button>
			</div>
		</div>

		<div class="fitting-canvas-wrap">
			<div class="fit-stage" id="fit-stage">
				<div class="fitting-placeholder" id="fit-placeholder">
					<span style="font-size:48px; opacity:0.35;">&#128247;</span>
					<p>Upload your dog's photo<br/>to get started</p>
				</div>
				<img class="fit-stage-img" id="fit-photo-preview" alt="Your dog" hidden />
				<img class="fit-stage-img" id="fit-result-img" alt="Your dog wearing a Barkly piece" hidden />
				<div class="fit-result-caption" id="fit-result-caption" hidden></div>
				<div class="fit-loading" id="fit-loading" hidden>
					<div class="fit-pulse"></div>
					<p class="fit-loading-msg" id="fit-loading-msg">Stitching the brocade…</p>
				</div>
				<div class="fit-error" id="fit-error" hidden>
					<span class="eyebrow" style="color:var(--terracotta);">Try again</span>
					<p class="fit-error-msg" id="fit-error-msg"></p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ── SIZE FINDER ──────────────────────────────────────────── -->
<div class="sizefinder-wrap" style="padding-top:96px;">
	<div class="sizefinder">

		<!-- Left: form -->
		<div id="sf-form-col">
			<span class="eyebrow" style="color:var(--olive);">Size finder</span>
			<h2 class="h-section" style="margin-top:14px;">Three quick <span class="it">questions.</span></h2>
			<div class="sf-fields">
				<label class="sf-label">
					<span>Dog's name</span>
					<input class="sf-input" id="sf-name" type="text" placeholder="e.g. Pip" autocomplete="off" />
				</label>
				<label class="sf-label">
					<span>Weight <small>in lbs</small></span>
					<input class="sf-input" id="sf-weight" type="number" placeholder="e.g. 8" min="1" max="150" />
				</label>
				<label class="sf-label">
					<span>Breed <small>optional</small></span>
					<input class="sf-input" id="sf-breed" type="text" placeholder="e.g. Maltese" autocomplete="off" />
				</label>
			</div>
			<button class="btn" onclick="barklyFindSize()">Find my size <span class="arrow">&rarr;</span></button>
		</div>

		<!-- Right: result (hidden until submitted) -->
		<div class="sf-result-wrap" id="sf-result" hidden>
			<div class="sf-badge-row">
				<div class="sf-size-badge" id="sf-size-out">S</div>
				<div>
					<h2 class="h-section" style="font-size:32px;" id="sf-headline">That's a <span class="it">size S.</span></h2>
					<p class="lede" style="font-size:16px; margin-top:8px;" id="sf-desc"></p>
				</div>
			</div>
			<div class="sf-measure-tip" id="sf-measure-tip"></div>
		</div>

	</div>

	<!-- Size chart sits right under the form so XS/S/M/L are explained
	     before the buyer submits. -->
	<div class="size-chart-inline">
		<div class="size-chart-head">
			<span class="eyebrow" style="color:var(--olive);">Size guide</span>
			<p class="size-chart-sub">Measure around the widest part of the chest, just behind the front legs.</p>
		</div>
		<table class="size-table" aria-label="Barkly size guide">
		<thead>
			<tr>
				<th>Size</th>
				<th>Weight</th>
				<th>Chest girth</th>
				<th>Neck</th>
				<th>Typical breeds</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="s-label">XS</td>
				<td>Under 5 lbs</td>
				<td>8 – 11 in</td>
				<td>5 – 8 in</td>
				<td>Teacup Chihuahua, Toy Yorkie</td>
			</tr>
			<tr>
				<td class="s-label">S</td>
				<td>5 – 12 lbs</td>
				<td>12 – 16 in</td>
				<td>8 – 11 in</td>
				<td>Maltese, Pomeranian, Miniature Pinscher</td>
			</tr>
			<tr>
				<td class="s-label">M</td>
				<td>12 – 25 lbs</td>
				<td>16 – 21 in</td>
				<td>11 – 14 in</td>
				<td>French Bulldog, Beagle, Corgi, Cocker Spaniel</td>
			</tr>
			<tr>
				<td class="s-label">L</td>
				<td>25 – 50 lbs</td>
				<td>21 – 27 in</td>
				<td>14 – 18 in</td>
				<td>Australian Shepherd, Labrador, Golden, Boxer</td>
			</tr>
		</tbody>
		</table>
		<p style="font-size:13px; color:var(--ink-soft); margin-top:14px;">Between sizes? Size up. A Barkly jacket should sit snug at the neck and have 1–2 fingers of clearance at the chest.</p>
	</div>

	<!-- Product recommendations (hidden until submitted) -->
	<div id="sf-products" hidden style="margin-top:56px;">
		<h3 class="sf-products-title">Picks for <span id="sf-name-out">your dog</span>.</h3>
		<div class="prod-recs" id="sf-product-grid"></div>
		<div style="margin-top:28px;">
			<a class="btn ghost" href="Shop/">See full collection <span class="arrow">&rarr;</span></a>
		</div>
	</div>
</div>

<?php include dirname(__FILE__).'/_redesign_footer.php'; ?>

<script>
/* ── SIZE FINDER ─────────────────────────────────────── */
var SF_SIZES = {
	XS: { label:'XS', chest:'8 – 11 in', neck:'5 – 8 in', desc:'For the tiniest pups. Snug, lightweight, and easy to slip on.' },
	S:  { label:'S',  chest:'12 – 16 in', neck:'8 – 11 in', desc:'Our most popular size. Built for petite breeds who love a little extra flair.' },
	M:  { label:'M',  chest:'16 – 21 in', neck:'11 – 14 in', desc:'The versatile middle. Fits stocky small breeds and lean medium ones equally well.' },
	L:  { label:'L',  chest:'21 – 27 in', neck:'14 – 18 in', desc:'For the bigger beauties. Same craft, more coat.' }
};
var SF_PRODUCTS = [
	{ name:'Sikar Jacket',      tag:'Signature',  img:'gallery/santa-fe-jacket.jpeg' },
	{ name:'Brocade Jacket', tag:'New',        img:'gallery/scarlet-brocade-coat.jpeg' },
	{ name:'Midnight Floral Hoodie',tag:'Bestseller',img:'gallery/midnight-floral-hoodie.jpeg' },
	{ name:'Kashmiri Knit Sweater',tag:'Knitwear',   img:'gallery/nordic-fairisle-sweater.jpeg' },
	{ name:'Festival Jacket', tag:'Festival', img:'gallery/lunar-cheongsam.jpeg' }
];

function barklyFindSize() {
	var name   = (document.getElementById('sf-name').value   || '').trim();
	var weight = parseFloat(document.getElementById('sf-weight').value);
	var breed  = (document.getElementById('sf-breed').value  || '').trim();
	if (!weight || isNaN(weight) || weight <= 0) {
		document.getElementById('sf-weight').focus();
		document.getElementById('sf-weight').style.borderColor = 'var(--scarlet)';
		return;
	}
	document.getElementById('sf-weight').style.borderColor = '';
	var key = weight < 5 ? 'XS' : weight <= 12 ? 'S' : weight <= 25 ? 'M' : 'L';
	var sz  = SF_SIZES[key];
	var who = name || 'your dog';

	document.getElementById('sf-size-out').textContent = sz.label;
	document.getElementById('sf-headline').innerHTML   = name
		? 'Perfect for <span class="it">' + name + '.</span>'
		: 'That&rsquo;s a <span class="it">size ' + sz.label + '.</span>';
	document.getElementById('sf-desc').textContent =
		'At ' + weight + ' lbs, ' + who + ' wears a size ' + sz.label + '. ' + sz.desc;
	document.getElementById('sf-measure-tip').innerHTML =
		'<strong>Double-check:</strong> Measure the chest at its widest point. A size ' + sz.label +
		' fits a chest of ' + sz.chest + ' and a neck of ' + sz.neck + '.';

	document.getElementById('sf-name-out').textContent = who;
	var grid = document.getElementById('sf-product-grid');
	grid.innerHTML = '';
	SF_PRODUCTS.slice(0, 3).forEach(function(p) {
		var a = document.createElement('a');
		a.className = 'prod-rec'; a.href = 'Shop/';
		a.innerHTML = '<img src="' + p.img + '" alt="' + p.name + '" />' +
			'<div class="prod-rec-info"><span class="tag" style="font-size:10px;letter-spacing:.2em;text-transform:uppercase;color:var(--scarlet);">' + p.tag + '</span>' +
			'<div class="prod-rec-name">' + p.name + '</div>' +
			'<div class="prod-rec-size">Size ' + sz.label + ' available</div></div>';
		grid.appendChild(a);
	});

	document.getElementById('sf-result').hidden   = false;
	document.getElementById('sf-products').hidden = false;
	document.getElementById('sf-result').scrollIntoView({ behavior:'smooth', block:'nearest' });
}
/* Allow Enter to submit */
['sf-name','sf-weight','sf-breed'].forEach(function(id) {
	document.getElementById(id).addEventListener('keydown', function(e) {
		if (e.key === 'Enter') barklyFindSize();
	});
});

/* ── FITTING ROOM (AI-powered via Stability AI) ──────── */
var fitPhotoFile  = null;
var fitJacketSlug = null;
var fitResultUrl  = null;
var fitLoadTimer  = null;

var FIT_LOAD_MSGS = [
	'Reading your dog\'s pose…',
	'Selecting the right cut…',
	'Stitching the brocade trim…',
	'Lining the cotton interior…',
	'Pressing the final seams…',
	'Almost ready for the runway…'
];

document.getElementById('fit-upload').addEventListener('change', function() {
	var file = this.files[0]; if (!file) return;
	if (file.size > 10 * 1024 * 1024) {
		showFitError('Photo too large — max 10 MB.'); return;
	}
	fitPhotoFile = file;
	var reader = new FileReader();
	reader.onload = function(e) {
		document.getElementById('fit-photo-preview').src = e.target.result;
		showFitState('photo');
	};
	reader.readAsDataURL(file);
});

function barklyTryOn(slug, btn) {
	if (!fitPhotoFile) {
		document.getElementById('fit-upload').click();
		return;
	}
	document.querySelectorAll('.fit-swatch').forEach(function(s){ s.classList.remove('is-active'); });
	btn.classList.add('is-active');
	fitJacketSlug = slug;

	showFitState('loading');
	startFitLoadingMsgs();

	var fd = new FormData();
	fd.append('image', fitPhotoFile);
	fd.append('jacket', slug);

	fetch('virtual-try-on-api.php', { method: 'POST', body: fd })
		.then(function(r) { return r.json().then(function(j) { return { ok: r.ok, body: j }; }); })
		.then(function(res) {
			stopFitLoadingMsgs();
			if (!res.ok || !res.body || !res.body.image) {
				var msg = (res.body && res.body.error) || 'Something went wrong. Try again.';
				if (res.body && res.body.error === 'setup_needed') {
					msg = res.body.message || 'AI try-on is not configured yet.';
				}
				showFitError(msg);
				return;
			}
			fitResultUrl = res.body.image;
			document.getElementById('fit-result-img').src = res.body.image;
			showFitState('result');
			document.getElementById('fit-download').style.display = 'inline-flex';
			/* Shop CTA: deep-link to the matching product on the Shop page */
			var SHOP_SLUG = {
				'santa-fe':        'santa-fe-jacket',
				'scarlet-brocade': 'scarlet-brocade-coat',
				'midnight-floral': 'midnight-floral-hoodie',
				'nordic-fairisle': 'nordic-fairisle-sweater',
				'lunar-cheongsam': 'lunar-cheongsam'
			};
			var shopCta = document.getElementById('fit-shop-cta');
			var anchor  = SHOP_SLUG[res.body.slug];
			if (anchor) {
				shopCta.href = 'Shop/#' + anchor;
				document.getElementById('fit-shop-cta-name').textContent = res.body.jacket || 'style';
				shopCta.style.display = 'inline-flex';
			} else {
				shopCta.style.display = 'none';
			}
			/* If AI picked, surface a small caption + highlight the chosen swatch */
			var caption = document.getElementById('fit-result-caption');
			if (res.body.auto_picked && res.body.slug) {
				var label = res.body.jacket || 'a Barkly piece';
				var breedTxt = res.body.breed ? ' for your <em>' + res.body.breed + '</em>' : '';
				caption.innerHTML = '<span class="ai-tag">&#10024; AI picked</span> <strong>' + label + '</strong>' + breedTxt + (res.body.reason ? '<br/><span class="reason">' + res.body.reason + '</span>' : '');
				caption.hidden = false;
				/* mirror the highlight onto the matching specific swatch */
				document.querySelectorAll('.fit-swatch').forEach(function(s){ s.classList.remove('is-active'); });
				var match = document.querySelector('.fit-swatch[data-slug="' + res.body.slug + '"]');
				if (match) match.classList.add('is-active');
				var auto = document.querySelector('.fit-swatch-auto'); if (auto) auto.classList.add('is-active');
			} else {
				caption.hidden = true;
			}
		})
		.catch(function() {
			stopFitLoadingMsgs();
			showFitError('Network error — please try again.');
		});
}

function showFitState(state) {
	document.getElementById('fit-placeholder').hidden    = (state !== 'placeholder');
	document.getElementById('fit-photo-preview').hidden  = (state !== 'photo');
	document.getElementById('fit-result-img').hidden     = (state !== 'result');
	document.getElementById('fit-loading').hidden        = (state !== 'loading');
	document.getElementById('fit-error').hidden          = (state !== 'error');
}

function showFitError(msg) {
	document.getElementById('fit-error-msg').textContent = msg;
	showFitState('error');
}

function startFitLoadingMsgs() {
	var i = 0;
	var msg = document.getElementById('fit-loading-msg');
	msg.textContent = FIT_LOAD_MSGS[0];
	fitLoadTimer = setInterval(function() {
		i = (i + 1) % FIT_LOAD_MSGS.length;
		msg.style.opacity = '0';
		setTimeout(function() {
			msg.textContent = FIT_LOAD_MSGS[i];
			msg.style.opacity = '1';
		}, 220);
	}, 2500);
}

function stopFitLoadingMsgs() {
	if (fitLoadTimer) { clearInterval(fitLoadTimer); fitLoadTimer = null; }
}

function barklyDownload() {
	if (!fitResultUrl) return;
	var a = document.createElement('a');
	a.href = fitResultUrl;
	a.download = 'my-dog-in-' + (fitJacketSlug || 'barkly') + '.jpg';
	a.click();
}
</script>

{{hr_out}}
</body>
</html>
