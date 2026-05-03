<?php /* WARNING: 2026 redesign — About is hand-written for the new design system (centered editorial hero, banner, four principles, craft strip on dark, story strip, lookbook). NC SiteBuilder wb_* body chrome removed. Re-saving from the Network Solutions builder UI WILL wipe these edits. */ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "About — Barkly Fashion", ENT_QUOTES, 'UTF-8'); ?></title>
	<base href="{{base_url}}" />
	<?php echo isset($sitemapUrls) ? (generateCanonicalUrl($sitemapUrls)."\n") : ""; ?>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "Barkly is a small studio making heirloom apparel for dogs of every shape — patterned on real dogs, made in lots of forty.", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta name="keywords" content="<?php echo htmlspecialchars((isset($seoKeywords) && $seoKeywords !== "") ? $seoKeywords : "Barkly story,handmade dog apparel,heritage textiles,artisan dog jackets,elegant pet clothing,South Asian pet brand", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:site_name" content="Barkly Fashion">
	<meta property="og:title" content="<?php echo htmlspecialchars((isset($seoTitle) && $seoTitle !== "") ? $seoTitle : "About — Barkly Fashion", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:description" content="<?php echo htmlspecialchars((isset($seoDescription) && $seoDescription !== "") ? $seoDescription : "A house built around one small dog. Heritage textiles, real fittings, and answering the phone ourselves.", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:image" content="<?php echo htmlspecialchars((isset($seoImage) && $seoImage !== "") ? "{{base_url}}".$seoImage : "{{base_url}}gallery/scarlet-brocade-coat.jpeg", ENT_QUOTES, 'UTF-8'); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="{{curr_url}}" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300..600;1,9..144,300..600&family=Cormorant+Garamond:ital,wght@0,400;0,500;1,400&family=Inter+Tight:wght@400;500;600&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="css/barkly-2026.css?ts=20260503e" type="text/css" />
	<ga-code/>
	<link rel="apple-touch-icon" type="image/png" sizes="120x120" href="gallery/favicons/favicon-120x120.png">
	<link rel="icon" type="image/png" sizes="120x120" href="gallery/favicons/favicon-120x120.png">
	<link rel="apple-touch-icon" type="image/png" sizes="180x180" href="gallery/favicons/favicon-180x180.png">
	<link rel="icon" type="image/png" sizes="180x180" href="gallery/favicons/favicon-180x180.png">
	<link rel="icon" type="image/png" href="gallery/favicons/favicon.png">
	<meta name="msvalidate.01" content="D05EFC1E04EBD851B3BBC04C41CA6680" />
</head>
<body data-screen="about">

<div class="announce">
	<span>Pawsitively elegant, designed for the world</span>
	<em>·</em>
	<span>New: The Lunar New Year capsule</span>
</div>

<header class="site-header">
	<nav class="nav" aria-label="Primary">
		<div class="nav-left">
			<a href="Shop/">Shop</a>
			<a href="About-us/" class="is-active">About</a>
		</div>
		<a class="brand" href="{{base_url}}" aria-label="Barkly Fashion home">
			<img class="brand-logo" src="gallery/barklylogo.jpg" alt="" />
		</a>
		<div class="nav-right"><a href="Try-On/">Fit guide</a></div>
	</nav>
</header>

<section class="about-hero">
	<span class="eyebrow">Our story</span>
	<h1 class="h-display">A house built<br/>around <span class="it">one</span> small dog.</h1>
	<p class="lede">Barkly began the day we couldn't find a coat that fit. Now we make sophisticated apparel rooted in South Asian craft — elegance that feels as good as it looks.</p>
</section>

<div class="about-banner">
	<div class="about-banner-img">
		<img src="gallery/scarlet-brocade-coat.jpeg" alt="A Maltese in scarlet brocade coat in a meadow at golden hour" />
	</div>
</div>

<div class="weave" aria-hidden="true" style="margin-top:0;"></div>

<section class="values">
	<div>
		<span class="eyebrow muted">What we believe</span>
		<h2 class="h-section" style="margin-top:18px;">Four <span class="it">principles</span> we won't compromise.</h2>
		<p class="lede" style="margin-top:18px;">Small batches. Real fittings. We pick up the phone.</p>
	</div>
	<div class="values-list">
		<div class="value">
			<span class="num">01</span>
			<div>
				<h3>Heritage textiles, never plastic</h3>
				<p>Brocades from third-generation mills. Fairisle knits from Northern Yorkshire. Floral cottons block-printed by hand. Nothing on a Barkly coat began life as a plastic bottle.</p>
			</div>
		</div>
		<div class="value">
			<span class="num">02</span>
			<div>
				<h3>Patterned on real dogs</h3>
				<p>Every size — XS through L — is graded on a real dog of that build. Maltese, terriers, dachshunds, doodles, mixes. If it doesn't fit our fit dogs, it doesn't ship.</p>
			</div>
		</div>
		<div class="value">
			<span class="num">03</span>
			<div>
				<h3>Made in lots of forty</h3>
				<p>Each jacket is crafted by artisan makers in South Asia. When a piece sells out it stays sold out — until the next lot is ready.</p>
			</div>
		</div>
		<div class="value">
			<span class="num">04</span>
			<div>
				<h3>Repair, don't replace</h3>
				<p>Send a worn-out Barkly back and we'll re-line, re-stitch and return it. A coat your dog could pass down.</p>
			</div>
		</div>
	</div>
</section>

<section class="craft">
	<div class="craft-inner">
		<div>
			<span class="eyebrow" style="color:var(--terracotta);">From bolt to belly strap</span>
			<h2 class="h-section" style="margin-top:18px;">How a Barkly coat <span class="it">actually</span> gets made.</h2>
			<p class="lede" style="margin-top:18px;">Eight hands. Four hours. From bolt to box on your doorstep.</p>
			<div class="specs">
				<div class="spec">
					<div class="k">Sketch</div>
					<div class="v">Hand-drawn, fitted to a real dog</div>
				</div>
				<div class="spec">
					<div class="k">Pattern</div>
					<div class="v">Graded XS, S, M, L</div>
				</div>
				<div class="spec">
					<div class="k">Cut</div>
					<div class="v">Single-layer, no waste</div>
				</div>
				<div class="spec">
					<div class="k">Sew</div>
					<div class="v">Single seamstress, start to finish</div>
				</div>
				<div class="spec">
					<div class="k">Line</div>
					<div class="v">Brushed cotton, hand-tacked</div>
				</div>
				<div class="spec">
					<div class="k">Finish</div>
					<div class="v">Pressed, photographed, packed</div>
				</div>
			</div>
		</div>
		<div class="craft-img">
			<img src="gallery/IMG_0314.jpg" alt="Dog wearing a Barkly bandana coat in a field" />
		</div>
	</div>
</section>

<section class="story" style="margin-top:0;">
	<div class="story-inner">
		<div class="story-img">
			<img src="gallery/barkly-box.jpeg" alt="Barkly Fashion premium packaging box" />
		</div>
		<div class="story-copy">
			<span class="eyebrow">A note from the studio</span>
			<h2 class="h-section">"It started <span class="it">because</span> nothing fit."</h2>
			<p class="lede">
				Our first dog swam in the smallest jacket we could find. So we made one.
				Then a friend asked for one. Five years later we still pattern every piece
				on the same dog who started it all.
			</p>
			<div class="pull">"We don't dress dogs up. We dress them well."</div>
			<p style="font-family:var(--display); font-style:italic; font-size:18px; color:var(--ink-soft); margin-top:16px;">
				— Barkly Fashion · pawsitively elegant, designed for the world
			</p>
		</div>
	</div>
</section>

<section class="section" style="padding-bottom:48px;">
	<div class="section-head">
		<h2 class="h-section">In the <span class="it">wild.</span></h2>
		<p class="lede">Some of our favorite Barklys, photographed by their humans.</p>
	</div>
	<div class="lookbook">
		<div class="lookbook-img">
			<img src="gallery/IMG_0320.jpg" alt="Australian shepherd in navy print coat" />
			<div class="label">Maple · Navy print</div>
		</div>
		<div class="lookbook-img">
			<img src="gallery/IMG_9072.jpg" alt="Goldendoodle in lace-trimmed coat" />
			<div class="label">Toast · Lace-trim coat</div>
		</div>
		<div class="lookbook-img">
			<img src="gallery/santa-fe-jacket.jpeg" alt="Maltese in scarlet jacket in field" />
			<div class="label">Pip · Santa Fe jacket</div>
		</div>
	</div>
</section>

<?php include dirname(__FILE__).'/_redesign_footer.php'; ?>

{{hr_out}}
</body>
</html>
