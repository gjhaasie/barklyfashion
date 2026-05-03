# Barkly Fashion — Engineering Setup

This is the source for **barklyfashion.com**. PHP site, hosted on Namecheap (cPanel), auto-deployed from GitHub via a cron job. Read this end-to-end before making your first change.

---

## 1. What this is

- **Stack**: PHP 8 (no framework), vanilla JS, hand-written CSS. No build step.
- **Origin**: started as a Network Solutions "NCSiteBuilder" export. Most pages have been rewritten by hand for the 2026 redesign — the original `wb_*` chrome is gone. Files like `ncsitebuilder/index.php` still contain the original page-routing logic and are intentionally left untouched.
- **AI features**: virtual try-on uses Stability AI (search-and-replace inpainting) + Google Gemini Vision (auto-pick the right jacket from breed). Both keys live in a server-side secrets file, never in git.
- **Hosting**: Namecheap shared hosting, cPanel UI, LiteSpeed web server.
- **Repo**: https://github.com/gjhaasie/barklyfashion (public).

---

## 2. Local setup

### Prerequisites (macOS)

```bash
# Homebrew if you don't have it
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Accept Xcode CLI license — required by Homebrew on a fresh machine
sudo xcodebuild -license accept

# PHP 8+ (the live server runs PHP 8.1, but 8.5 works fine for local dev)
brew install php

# Verify
php --version    # should show 8.1+
git --version
```

Linux/Windows: install PHP 8 from your package manager / php.net. Everything below is the same.

### Clone and run

```bash
git clone https://github.com/gjhaasie/barklyfashion.git
cd barklyfashion

# Start a local dev server from the repo root
php -S 127.0.0.1:8000 -t .

# Open http://127.0.0.1:8000/ncsitebuilder/try-on.php
```

> The home page URL on production is `barklyfashion.com/` (root). Locally, hit `http://127.0.0.1:8000/ncsitebuilder/<page-file>.php` directly because the production-only `.htaccess` rewrite rules don't run under PHP's built-in dev server. Page filenames are listed in `ncsitebuilder/index.php` in the `$pages` array.

### Test the AI try-on locally

The AI calls won't work without API keys. Create a local secrets file (it's gitignored):

```bash
cat > ncsitebuilder/barkly-secrets.php <<'EOF'
<?php
define('STABILITY_KEY', 'sk-...');     // ask the studio for the dev key
define('GEMINI_KEY',    'AIza...');    // free key from aistudio.google.com/app/apikey
EOF
```

Then submit a photo through `/ncsitebuilder/try-on.php` and the inpainting will fire against Stability's API.

---

## 3. Project structure

```
barklyfashion/
  .cpanel.yml                 # cPanel deployment manifest (rsync to /home/barkgjug/public_html/)
  .htaccess                   # Apache rewrite rules + LiteSpeed cache off + file deny rules
  .gitignore                  # never commit barkly-secrets.php, .env, error_log, etc.

  ncsitebuilder/
    index.php                 # original NC SiteBuilder router. Maps URL aliases to PHP files.
    a188dd97916a009965c17cb5091b1d29.php   # Home page (id is from the original builder)
    a188dd97916a02dc5d341a8477c3ea12.php   # About page
    a188dd97916a01fb85848aa7afb9175e.php   # Shop page
    try-on.php                # Size Finder + AI Fitting Room
    _redesign_footer.php      # shared footer + chatbot widget (included by all pages)

    virtual-try-on-api.php    # POST endpoint → Stability AI inpainting (+ Gemini auto-pick)
    barkly-leads.php          # POST endpoint → appends form submissions to barkly-leads.csv

    css/barkly-2026.css       # entire 2026 design system. cache key in URL: ?ts=YYYYMMDDx
    gallery/                  # product photos, lookbook, favicons
```

URL → file mapping (from `index.php` `$pages` array):

| URL                     | File                                       |
| ----------------------- | ------------------------------------------ |
| `/`                     | `a188dd97916a009965c17cb5091b1d29.php`     |
| `/About-us/`            | `a188dd97916a02dc5d341a8477c3ea12.php`     |
| `/Shop/`                | `a188dd97916a01fb85848aa7afb9175e.php`     |
| `/Try-On/`              | `try-on.php`                                |
| `/virtual-try-on-api.php` | `ncsitebuilder/virtual-try-on-api.php`   |
| `/barkly-leads.php`     | `ncsitebuilder/barkly-leads.php`           |

The `.htaccess` at repo root does the rewriting: any URL that isn't a real file gets prefixed with `ncsitebuilder/` and the router takes over.

---

## 4. Hosting (Namecheap / cPanel)

- **Provider**: Namecheap shared hosting.
- **cPanel host**: `https://server72.web-hosting.com:2083`
- **cPanel user**: `barkgjug`
- **Web root**: `/home/barkgjug/public_html/`
- **Web server**: LiteSpeed (Apache-compatible, but caches aggressively — that's why `CacheLookup off` is in `.htaccess`).
- **PHP version**: 8.1 (configurable via cPanel → Select PHP Version).

Login credentials are with the studio owner. For day-to-day work you don't need cPanel — `git push` is enough.

---

## 5. Auto-deploy mechanism

A cron job on the server runs every 5 minutes and does:

```bash
cd /home/barkgjug/public_html
git fetch origin
git reset --hard origin/main
# then runs the deploy tasks from .cpanel.yml (rsync excluded files etc.)
```

So the workflow is:

1. Edit code locally.
2. `git push origin main`.
3. Wait up to 5 minutes.
4. Refresh the live site — your change is there.

If you need to confirm a deploy landed, hit any page and check the CSS `?ts=` query string (we bump it whenever CSS changes).

`reset --hard` means **any uncommitted changes to files on the server are wiped on every cron run**. Never edit files on the server directly through cPanel File Manager (with two specific exceptions, see Secrets below).

---

## 6. Secrets — the one file that lives only on the server

`barkly-secrets.php` holds API keys and is **deliberately not in git**. It lives at:

```
/home/barkgjug/public_html/barkly-secrets.php
```

Contents (one line per key):

```php
<?php
define('STABILITY_KEY', 'sk-...');     // platform.stability.ai → Account → API Keys
define('GEMINI_KEY',    'AIza...');    // aistudio.google.com/app/apikey
```

`virtual-try-on-api.php` looks for the file at three locations and uses whichever exists. Apache rules in `.htaccess` block direct HTTP access to it. Cron's `reset --hard` ignores it because it's not tracked.

To rotate a key: edit the file via cPanel → File Manager. No deploy needed.

---

## 7. Captured leads

Newsletter signups (footer) and "notify me" submissions (Shop) get **emailed to barklyfashion@gmail.com** via formsubmit.co AND **appended to a CSV** by `barkly-leads.php`.

CSV location (in priority order):

1. `/home/barkgjug/barkly-leads.csv`
2. `/home/barkgjug/public_html/barkly-leads.csv`

Columns: `timestamp_utc, type, email, product_name, product_slug, source_page, ip, user_agent`.

Download via cPanel → File Manager → right-click → Download. Opens directly in Excel.

---

## 8. Making your first change

1. Pull latest:
   ```bash
   git pull origin main
   ```
2. Make your edit. If you touched `css/barkly-2026.css`, bump the cache-bust query string in all four pages so browsers fetch the new file. Search for `ts=2026` and increment the suffix letter.
3. Run a syntax check on any PHP you touched:
   ```bash
   php -l ncsitebuilder/<your-file>.php
   ```
4. (Optional) Spin up the local server and click through the change.
5. Commit and push:
   ```bash
   git add -A
   git commit -m "short description"
   git push origin main
   ```
6. Wait ~5 min, then verify on https://barklyfashion.com.

---

## 9. Gotchas

- **Never re-save a page from the Network Solutions site builder UI.** It will overwrite the redesign. The page files at the top of `ncsitebuilder/*.php` carry warning comments to that effect.
- **Never commit `barkly-secrets.php`.** It's already in `.gitignore`. The repo is public.
- **Never commit `barkly-leads.csv`.** Same reason — that's customer data.
- **Bump the CSS cache key** when you change `css/barkly-2026.css`. LiteSpeed caches CSS for ~7 days otherwise.
- **PHP 8.5 deprecation warnings on the dev server** can leak into JSON responses. The codebase is already cleaned up for 8.5 (`fputcsv` with explicit `escape`, no `curl_close` etc.); follow the same pattern in new code.
- **The home page route is alias `''` in `index.php`**, not `'home'`. If you add a new top-level page, add an entry to the `$pages` array.

---

## 10. Useful one-liners

```bash
# Fetch live API balance for Stability (paid credits)
curl -s "https://api.stability.ai/v1/user/balance" -H "Authorization: Bearer sk-..."

# Tail the deploy state remotely (you need cPanel API token for this)
curl -sk "https://server72.web-hosting.com:2083/execute/Fileman/get_file_content?dir=/home/barkgjug/public_html&file=index.php" \
  -H "Authorization: cpanel barkgjug:<token>"

# Test the leads endpoint locally
curl -X POST "http://127.0.0.1:8000/ncsitebuilder/barkly-leads.php" \
  -F "email=test@example.com" -F "type=notify" -F "product=Scarlet Brocade"

# Test the AI try-on endpoint locally (requires barkly-secrets.php)
curl -X POST "http://127.0.0.1:8000/ncsitebuilder/virtual-try-on-api.php" \
  -F "image=@gallery/IMG_0314.jpg" -F "jacket=auto" -o /tmp/result.json
```

---

## 11. Who to ask

- Brand / copy / product decisions: studio owner.
- Hosting / cPanel access: studio owner.
- API keys: studio owner (Stability + Gemini).

Welcome aboard.
