# Handoff: Barkly Fashion — Site Redesign (Home, About, Shop)

## Overview

A full visual + UX redesign of `barklyfashion`, a small-batch dog apparel
boutique. Three pages are in scope: **Home**, **About Us**, and **Shop**.
The site has **no e-commerce**: there is no checkout, cart, or bag. The only
conversion is a per-product **"Notify me"** email capture so the studio can
follow up when a piece is ready.

## About the Design Files

The files in `design/` are **design references in static HTML/CSS** —
prototypes showing intended look, copy, and behavior. They are **not
production code to copy directly**.

The current production site (`barklyfashion/`) is built on the **Nicepage / NC
SiteBuilder** PHP stack (`index.php` → `router.php` → `ncsitebuilder/`). Your
job is to **recreate these designs inside that existing stack** — meaning:
edit the rendered pages so they output this layout, copy, and styling. Do not
ship the HTML prototypes as-is. If the site is being migrated off NC
SiteBuilder, pick the framework that best fits the project (a static site
generator is plenty — there is no dynamic data) and implement there.

The HTML/CSS in `design/` is hand-written and reasonably clean, so you can
lift markup structure and styles directly when convenient.

## Fidelity

**High-fidelity.** All colors, type, spacing, copy, imagery, and interaction
states are final. Match them pixel-close. The CSS file (`design/styles.css`)
is the source of truth for tokens — pull values from it directly rather than
re-typing from this README if there is ever a discrepancy.

---

## Files in this bundle

```
design/
  index.html        Home
  about.html        About Us
  shop.html         Shop (products + filter + Notify-me flow)
  styles.css        ALL styles for all three pages
  images/           Product photos + lifestyle photos + logo
```

Open `design/index.html` in a browser to view the prototype. All three pages
share the same `styles.css`, the same `<header>` / `<footer>` structure, and
the same announce bar — implement those once as a layout and reuse.

---

## Global / Shared Chrome (apply to all three pages)

### Announce bar (top of every page)
- Background `--ink` (#1f1a14), text `--cream` (#f4ead7).
- 10px vertical padding, centered, 12px uppercase, letter-spacing 0.18em.
- Two phrases separated by a terracotta `·`:
  - **Home / About**: `Made to order · small batches · sewn in Berkeley` ·
    `New: The Lunar New Year capsule`
  - **Shop**: `Made to order · small batches · sewn in Berkeley` · `Lot 04 of
    the Scarlet Brocade now in production`

### Site header / nav
- Sticky, `--paper` background with a `--rule` (#d9c9a8) bottom border,
  subtle `backdrop-filter: blur(8px)`.
- Three-column grid: `nav-left` | centered `brand` (logo) | `nav-right`.
- Nav links: 13px Inter Tight, 0.16em letter-spacing, uppercase, weight 500.
- Hover color = `--scarlet` (#b13128).
- Active page gets a 1.5px scarlet underline (see `.nav a.is-active`).
- Logo: `images/barklylogo.jpg` at 56px tall, `mix-blend-mode: multiply` so
  the JPG's white background blends into the cream paper.

**Final nav link set (no dead links anywhere — strictly enforced):**

| Page         | nav-left          | nav-right    |
| ------------ | ----------------- | ------------ |
| `index.html` | Shop · About      | Notify me    |
| `about.html` | Shop · About\*    | Notify me    |
| `shop.html`  | Shop\* · About    | Notify me    |

\* = `is-active` underline.

The "Notify me" link in `nav-right` points to `shop.html` from Home/About,
and `#products` (the product grid) from Shop.

### Footer (every page)
Two columns of links + a newsletter form + a bottom rule with copyright.

- **Shop** column → one link: `All apparel` → `shop.html`
- **House** column → one link: `Our story` → `about.html`
- Newsletter form: email input + "Subscribe" button. On submit, prevent
  default and replace the form with a thank-you message. (Mocked client-side
  in the prototype; wire to whatever ESP you use — Mailchimp, Klaviyo, etc.)

⚠️ **Do not add nav, footer, or CTA links to pages that don't exist.** The
prior version had Search, Journal, Sizing guide, Care & repair, Contact,
Jackets, Sweaters, Hoodies, etc. — all dead. Those have been removed and
must stay removed. Only add a link if the destination page actually exists.

---

## Design Tokens

Pulled directly from `design/styles.css` `:root`:

### Colors
| Name             | Hex       | Usage                                              |
| ---------------- | --------- | -------------------------------------------------- |
| `--cream`        | `#f4ead7` | Light text on dark, accent fields                  |
| `--cream-soft`   | `#f9f1e0` | Card backgrounds                                   |
| `--paper`        | `#fbf6ec` | **Page background**                                |
| `--ink`          | `#1f1a14` | Primary text, announce bar, primary buttons        |
| `--ink-soft`     | `#3a322a` | Secondary text, italic prompts                     |
| `--terracotta`   | `#c75935` | Announce bar `·` separator, accents                |
| `--scarlet`      | `#b13128` | Hover, active underline, eyebrow text, badge "hot" |
| `--scarlet-deep` | `#8a221b` | (reserved)                                         |
| `--olive`        | `#6b6238` | (reserved)                                         |
| `--forest`       | `#2d3d2a` | (reserved)                                         |
| `--gold`         | `#b8893a` | (reserved)                                         |
| `--rule`         | `#d9c9a8` | Hairline borders                                   |

### Typography
- `--display`: **Fraunces**, 400 weight, used for h1/h2 and product names.
  Italic variant used for editorial flourishes (`<span class="it">`).
- `--serif`: **Cormorant Garamond**, fallback for display.
- `--sans`: **Inter Tight**, used for body, nav, eyebrows, buttons,
  metadata, prices.
- Base body: 16px / 1.55, antialiased.
- Eyebrow style: 11px Inter Tight, 0.32em letter-spacing, uppercase, weight
  600, color `--scarlet`.

Load the fonts from Google Fonts (or self-host) — the prototype's HTML
already includes the `<link>` tags; copy them.

### Spacing & layout
- Max content width: `--maxw: 1320px`, gutter 32px on the nav/header.
- Grid gap on multi-column sections: 24–32px typical.
- Section vertical rhythm: ~96–120px between major sections.

### Other tokens
- Border radius: deliberately **none / minimal** (boutique editorial feel).
  Buttons and cards are square.
- Shadows: minimal — use the `--rule` hairline to delineate, not shadows.
- Image hover: subtle `transform: scale(1.03)` on product images, 0.6s ease.

---

## Page 1 — Home (`index.html`)

### Sections (top to bottom)
1. **Announce bar** (shared, see Global).
2. **Header / nav** (shared).
3. **Hero**
   - Two-column: left = copy, right = `images/scarlet-brocade-coat.jpeg`.
   - Eyebrow: `Fall · Winter Collection 2026`
   - Display H1: `Heirloom apparel\nfor the *well-dressed* dog.` (the word
     "well-dressed" is in italic display, wrapped in `<span class="it">`).
   - Lede paragraph (max 46ch).
   - Two CTAs: filled `Shop the collection →` → `shop.html`, ghost `Our
     story` → `about.html`.
   - Three meta stats: `5 signature pieces` / `XS – L fit range` /
     `100% natural fibres`.
   - Stamp overlay on the hero image: `Featured · No. 02 / Scarlet Brocade
     Coat`.
4. **Featured collection grid** (5 cards)
   - First card spans wide ("feature"), the next four are equal columns.
   - Each card = full-bleed product photo + caption block (name, price-free
     here, just the product number/material).
   - Click anywhere on a card → `shop.html`.
5. **Story strip**
   - Left: `images/IMG_0314.jpg`. Right: short story copy + ghost CTA `Read
     our story →` → `about.html`.
6. **Lookbook** — three lifestyle photos with bottom-left labels.
7. **Footer** (shared).

---

## Page 2 — About Us (`about.html`)

### Sections
1. **Announce + header** (shared).
2. **About hero**
   - Eyebrow: `Studio notes`
   - H1: editorial, two-line statement (see prototype).
   - Followed by a full-bleed banner image
     (`images/scarlet-brocade-coat.jpeg`) inside `.about-banner`.
3. **Four principles** — 2×2 grid of numbered cards (`.principle`), each
   with eyebrow number, title, and short paragraph. Topics: heritage
   textiles, fit, small batches, repair-not-replace.
4. **Craft process strip** — left column: 3-step list of how a piece is
   made. Right column: `images/IMG_0314.jpg`.
5. **Story strip** — mirror of home's story strip but with
   `images/midnight-floral-hoodie.jpeg`.
6. **Lookbook** — 3 photos labeled with the dog's name + piece worn.
7. **Footer** (shared).

---

## Page 3 — Shop (`shop.html`)

### Sections
1. **Announce + header** (shared, with shop-specific announce copy).
2. **Shop head** — eyebrow `The Winter Edit · 2026` + display H1 `Five
   pieces. *No filler.*` Lede paragraph ends with a bold tagline:
   > "Each piece is made to order — leave your email and we'll write the
   > moment it's ready to wear."
3. **Filter chips** — `.filters` row with chips: All, Coats, Sweaters,
   Hoodies, Capsule. Clicking filters the product grid in-place via
   `data-cat` attributes (vanilla JS already in the page).
4. **Product grid** — 3 cols desktop / 2 cols tablet / 1 col mobile.
   `.product` cards. Each card has:
   - `.product-media` — 4/5 aspect ratio image.
     - Optional `.badge` (top-left): `Bestseller`, `New`, `Knit`, `Lunar
       capsule`. `.badge.hot` uses scarlet bg.
     - `.quick` button — slides up from bottom on `:hover`. Text:
       `Notify me when ready →`. **This is the entire CTA — no add-to-bag.**
   - `.product-info` — two-row grid:
     - Row 1: `<h3>` product name + `<span class="price">` ($28–$40 range).
     - Row 2 (`grid-column: 1 / -1`): `<div class="meta">` with the catalog
       number, fabric, and size range, e.g.: `No. 01 · Block-printed cotton
       · XS – L`.
5. **Sizing strip** (`.specs`) — three plain text columns showing the
   numeric size scale: XS 6–14lb, S 14–22lb, M 22–32lb, L 32–55lb. Pure
   informational — **no Sizing-guide CTA** (was removed; do not re-add).
6. **Lookbook** — 3 lifestyle photos.
7. **Footer** (shared).

### The 5 products

| #   | Name                    | Price | Fabric / detail                        | Size range | Badge       |
| --- | ----------------------- | ----- | -------------------------------------- | ---------- | ----------- |
| 01  | The Santa Fe Jacket     | $35   | Block-printed cotton                   | XS – L     | Bestseller  |
| 02  | Scarlet Brocade Coat    | $38   | Silk brocade, quilted lining           | XS – M     | New         |
| 03  | Nordic Fairisle Sweater | $30   | Wool-cotton fairisle                   | XS – L     | Knit        |
| 04  | Midnight Floral Hoodie  | $28   | Brushed cotton, removable hood         | XS – L     | Bestseller  |
| 05  | Lunar Cheongsam         | $40   | Red & gold brocade                     | XS – M     | Lunar capsule |

Image filenames match the slugs above (`santa-fe-jacket.jpeg`,
`scarlet-brocade-coat.jpeg`, etc.) in `design/images/`.

---

## Interactions & Behavior

### Filter chips (Shop)
Vanilla JS in `shop.html`. Clicking a chip:
1. Toggles `.is-active` on the chip.
2. Reads `data-cat` from the chip and `data-cat` from each `.product`.
3. Hides products whose category doesn't match (sets `display: none`).
4. "All" shows everything.

In a real app, port to whatever framework you're using — keep the chip
state in the URL (`?cat=coats`) so it's deep-linkable.

### Notify-me flow (Shop) — **the only conversion on the site**
This replaces "Add to bag." On every product card the hover button reads
`Notify me when ready →`.

When clicked (`openNotify(this)`), the page:
1. Finds the closest `.product` element.
2. If it already has a `.notify-form` child, just focuses the existing
   input and returns.
3. Otherwise, appends a `<form class="notify-form">` to the product card
   containing:
   - An italic Fraunces label naming the product:
     *"Leave your email and we'll write the moment <product name> is ready
     to wear."*
   - An `<input type="email" required>` with placeholder `your@email`.
   - A square primary button labeled `Notify me`.
   - Fine-print line: *"We'll only use your email to write you about this
     piece."*
4. The form animates in (`@keyframes notify-in`, 0.25s ease, 4px
   translateY).
5. On submit, replace the form's contents with a confirmation:
   `✓ We'll be in touch about <product name>.` (Fraunces italic, 16px,
   color `--scarlet`, with the product name in `--ink`.)

**Backend implementation note:** the prototype only swaps DOM. In
production, on submit you should:
- POST `{ email, product_name, product_slug }` to a backend endpoint
  (or a form service like Formspree / Basin / Netlify Forms).
- Persist to a per-product interest list — when a piece is ready, the studio
  emails everyone on that product's list.
- **Do not** add general newsletter signups via this flow; the footer has a
  separate newsletter form for that.
- Validate email format (HTML5 `type="email"` is fine for the prototype;
  add server-side validation too).
- Handle/display submit errors gracefully — currently the prototype assumes
  success.

### Newsletter form (footer)
Identical pattern — submit, replace with thank-you. Wire to your ESP.

### Hover states
- Nav links: color → `--scarlet`.
- Product card image: subtle scale to 1.03 over 0.6s.
- `.quick` notify button: slides up from bottom with `transform:
  translateY(0)` on `.product:hover`.
- `.notify-form button` hover: bg `--ink` → `--scarlet`.

### Responsive
- Desktop ≥ 1024px: full layout.
- Tablet 640–1023px: 2-col product grid, story strips stack on smaller
  side, hero stacks.
- Mobile < 640px: nav-left/nav-right hidden (logo only), single-column
  everywhere, `.specs` stacks. (Currently no mobile menu — add a
  hamburger if you want full nav on mobile; prototype intentionally
  leaves it as logo-only.)

---

## State Management

Per-page, all state is local:
- **Shop**: `activeCategory` (string), `notifyFormOpen` per product, plus
  the submit-success state per product.
- **Footer newsletter**: submitted/not.

There is **no cart state, no user state, no auth, nothing global**. Don't
add any unless explicitly asked.

---

## Assets — provenance

Every image used is real and ships in `design/images/`. Do **not** invent
or generate new imagery. If a section needs a photo we don't have, ask the
studio for one before building.

| File                            | Subject                                        | Used on            |
| ------------------------------- | ---------------------------------------------- | ------------------ |
| `barklylogo.jpg`                | Wordmark + dog illustration                    | All (header)       |
| `santa-fe-jacket.jpeg`          | Product flat / on-dog                          | Home, Shop, About  |
| `scarlet-brocade-coat.jpeg`     | Product flat / on-dog                          | Home, Shop, About  |
| `nordic-fairisle-sweater.jpeg`  | Product flat / on-dog                          | Shop               |
| `midnight-floral-hoodie.jpeg`   | Product flat / on-dog                          | Home, Shop, About  |
| `lunar-cheongsam.jpeg`          | Product flat / on-dog                          | Shop               |
| `IMG_0314.jpg`                  | Lifestyle: Maltese in field                    | Home, Shop, About  |
| `IMG_0320.jpg`                  | Lifestyle: Aussie shepherd in coat             | Home, Shop, About  |
| `IMG_9072.jpg`                  | Lifestyle: Goldendoodle in coat                | Home, Shop, About  |

All images were sourced from the studio's existing gallery
(`barklyfashion/ncsitebuilder/gallery/`).

---

## What the prototype intentionally does NOT include

If you find yourself about to add any of these, **stop and ask first**:

- Shopping cart, "Add to bag", checkout, PayPal/Stripe, order pages.
- Search.
- Sizing guide page or modal.
- Care & repair page.
- Contact page (the Notify-me form is the contact path).
- Journal / blog.
- Account / login.
- Filler product categories (the only categories that exist are the five
  real pieces).
- Made-up reviews, customer counts, press logos, or other social proof.
- Gradient backgrounds, emoji, drop shadows for depth.

The site's whole pitch is "five pieces, no filler" — keep the surface
small.
