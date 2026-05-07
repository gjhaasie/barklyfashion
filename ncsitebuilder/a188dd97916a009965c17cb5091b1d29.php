<?php /* WARNING: 2026 redesign — this homepage is hand-written for the new design system (announce bar, sticky nav, hero, collection grid, story strip, lookbook, dark footer). The NC SiteBuilder wb_* body chrome and the old luxury/redesign sheets have been removed in favor of /css/barkly-2026.css. Re-saving this page from the Network Solutions site builder UI WILL wipe these edits. */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "Barkly Fashion — Heirloom apparel for the well-dressed dog", ENT_QUOTES, 'UTF-8'); ?></title>
	<base href="{{base_url}}" />
	<?php echo isset($sitemapUrls) ? (generateCanonicalUrl($sitemapUrls)."\n") : ""; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "Small-batch heirloom apparel for dogs — coats, sweaters, hoodies in brocade, fairisle and floral cottons.", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta name="keywords" content="<?php echo htmlspecialchars((isset($seoKeywords) && $seoKeywords !== "") ? $seoKeywords : "dog apparel,dog coats,dog sweaters,handmade dog clothing,heirloom dog wardrobe,small batch dog apparel,Barkly Fashion", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:site_name" content="Barkly Fashion">
	<meta property="og:title" content="<?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "Barkly Fashion — Heirloom apparel for the well-dressed dog", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "Small-batch heirloom apparel for dogs — coats, sweaters, hoodies.", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:image" content="<?php echo htmlspecialchars((isset($seoImage) && $seoImage !== "") ? "{{base_url}}".$seoImage : "{{base_url}}gallery/scarlet-brocade-coat.jpeg", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{curr_url}}" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300..600;1,9..144,300..600&family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Inter+Tight:wght@400;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/barkly-2026.css?ts=20260506d" type="text/css" />
	<link rel="preload" as="image" href="gallery/scarlet-brocade-coat.jpeg" fetchpriority="high">
	<ga-code/>
	<link rel="apple-touch-icon" type="image/png" sizes="120x120" href="gallery/favicons/favicon-120x120.png">
	<link rel="icon" type="image/png" sizes="120x120" href="gallery/favicons/favicon-120x120.png">
	<link rel="apple-touch-icon" type="image/png" sizes="180x180" href="gallery/favicons/favicon-180x180.png">
	<link rel="icon" type="image/png" sizes="180x180" href="gallery/favicons/favicon-180x180.png">
	<link rel="icon" type="image/png" href="gallery/favicons/favicon.png">
	<meta name="msvalidate.01" content="D05EFC1E04EBD851B3BBC04C41CA6680" />
</head>
<body data-screen="home">

<div class="announce">
	<span>Pawsitively elegant, designed for the world</span>
	<em>·</em>
	<span>New: The Lunar New Year capsule</span>
</div>

<header class="site-header">
	<nav class="nav" aria-label="Primary">
		<div class="nav-left">
			<a href="Shop/">Shop</a>
			<a href="Try-On/">Fit guide</a>
			<a href="About-us/">About</a>
		</div>
		<a class="brand" href="{{base_url}}" aria-label="Barkly Fashion home">
			<img class="brand-logo" src="gallery/barklylogo.jpg" alt="" />
		</a>
		<div class="nav-right"></div>
	</nav>
</header>

<section class="hero">
	<div class="hero-copy">
		<span class="eyebrow">The 2026 Collection</span>
		<h1 class="h-display">Heirloom apparel<br/>for the <span class="it">well-dressed</span> dog.</h1>
		<p class="lede" style="margin-top:24px; max-width:46ch;">
			Sophisticated jackets rooted in South Asian craft.
			Elegant enough for every occasion. Comfortable enough for every day.
		</p>
		<div class="hero-cta">
			<a class="btn" href="Shop/">Shop the collection <span class="arrow">&rarr;</span></a>
			<a class="btn ghost" href="About-us/">Our story</a>
		</div>
		<div class="hero-meta">
			<div><span class="num">5</span>signature pieces</div>
			<div><span class="num">XS – L</span>fit range</div>
			<div><span class="num">100%</span>natural fibres</div>
		</div>
	</div>
	<figure class="hero-image">
		<img src="gallery/scarlet-brocade-coat.jpeg" alt="Maltese in scarlet brocade coat in a meadow" />
		<div class="stamp">
			Featured · No. 02
			<strong>Scarlet Brocade Coat</strong>
		</div>
	</figure>
</section>

<div class="weave" aria-hidden="true"></div>

<div class="marquee" aria-hidden="true">
	<div class="marquee-track">
		<span>Hand-cut brocade <span class="dot"></span></span>
		<span>Made in small batches <span class="dot"></span></span>
		<span>Heirloom textiles <span class="dot"></span></span>
		<span>Fitted for every breed <span class="dot"></span></span>
		<span>Hand-cut brocade <span class="dot"></span></span>
		<span>Made in small batches <span class="dot"></span></span>
		<span>Heirloom textiles <span class="dot"></span></span>
		<span>Fitted for every breed <span class="dot"></span></span>
	</div>
</div>

<section class="section">
	<div class="section-head">
		<h2 class="h-section">The <span class="it">2026</span><br/>Collection.</h2>
		<p class="lede">Five pieces, each one inspired by a textile tradition.
			Cut close, lined warm, finished by hand.</p>
	</div>

	<div class="collection">
		<a class="collection-card feature" href="Shop/">
			<img src="gallery/santa-fe-jacket.jpeg" alt="Santa Fe Jacket" />
			<div class="info">
				<div>
					<div class="tag">Signature</div>
					<h3>The Santa Fe Jacket</h3>
				</div>
				<span style="font-size:11px;letter-spacing:.2em;text-transform:uppercase;">Block-printed cotton</span>
			</div>
		</a>
		<a class="collection-card" href="Shop/">
			<img src="gallery/scarlet-brocade-coat.jpeg" alt="Scarlet Brocade Coat" />
			<div class="info">
				<div>
					<div class="tag">New</div>
					<h3>Scarlet Brocade Coat</h3>
				</div>
			</div>
		</a>
		<a class="collection-card" href="Shop/">
			<img src="gallery/midnight-floral-hoodie.jpeg" alt="Midnight Floral Hoodie" />
			<div class="info">
				<div>
					<div class="tag">Bestseller</div>
					<h3>Midnight Floral Hoodie</h3>
				</div>
			</div>
		</a>
		<a class="collection-card" href="Shop/">
			<img src="gallery/nordic-fairisle-sweater.jpeg" alt="Nordic Fairisle Sweater" />
			<div class="info">
				<div>
					<div class="tag">Knitwear</div>
					<h3>Nordic Fairisle</h3>
				</div>
			</div>
		</a>
		<a class="collection-card" href="Shop/">
			<img src="gallery/lunar-cheongsam.jpeg" alt="Lunar Cheongsam" />
			<div class="info">
				<div>
					<div class="tag">Capsule</div>
					<h3>Lunar Cheongsam</h3>
				</div>
			</div>
		</a>
	</div>
</section>

<section class="story">
	<div class="story-inner">
		<div class="story-img">
			<img src="gallery/IMG_0314.jpg" alt="Maltese wearing the Santa Fe bandana jacket in a field" />
		</div>
		<div class="story-copy">
			<span class="eyebrow">The Barkly way</span>
			<h2 class="h-section">Made the <span class="it">slow</span> way.</h2>
			<p class="lede">
				Every piece is patterned on a real dog, made in batches of forty,
				and finished by the same small studio that sketches the originals.
				We use brocades, fairisles, and floral cottons sourced from heritage mills —
				textiles you'd find in a tailor's archive, scaled to fit a four-legged frame.
			</p>
			<div class="pull">"High-quality craft, finished by hand."</div>
			<ul>
				<li>Patterned and graded XS through L on real dogs of every shape</li>
				<li>Quilted cotton lining, brushed for warmth, soft on the coat</li>
				<li>Adjustable belly straps; no Velcro, no plastic snaps</li>
				<li>Each piece crafted by South Asian artisans in lots of forty</li>
			</ul>
			<div style="margin-top:16px;">
				<a class="btn ghost" href="About-us/">Read our story <span class="arrow">&rarr;</span></a>
			</div>
		</div>
	</div>
</section>

<section class="section" style="padding-top:96px;">
	<div class="section-head">
		<h2 class="h-section">In the <span class="it">field.</span></h2>
		<p class="lede">Customer dogs, off-leash and on-trend, wearing the 2026 line.</p>
	</div>
	<div class="lookbook">
		<div class="lookbook-img">
			<img src="gallery/IMG_0320.jpg" alt="Australian shepherd in navy print coat" />
			<div class="label">Park, Sunday morning</div>
		</div>
		<div class="lookbook-img">
			<img src="gallery/midnight-floral-hoodie.jpeg" alt="Maltese in floral hoodie indoors" />
			<div class="label">Artisan · South Asia</div>
		</div>
		<div class="lookbook-img">
			<img src="gallery/IMG_9072.jpg" alt="Goldendoodle in lace-trimmed coat" />
			<div class="label">Backyard, golden hour</div>
		</div>
	</div>
</section>

<?php include dirname(__FILE__).'/_redesign_footer.php'; ?>

{{hr_out}}
</body>
</html>
