# Barkly Fashion

Source for **[barklyfashion.com](https://barklyfashion.com)** — heirloom apparel for the well-dressed dog.

## What's in here

- **Home, About, Shop** — editorial pages introducing the 2026 collection
- **Try-On** (`/Try-On/`) — Size Finder (3-question form returns the right size and product picks) and an AI Fitting Room that takes a photo of the customer's dog and repaints it wearing the chosen Barkly piece
- **AI auto-pick** — Gemini Vision identifies breed and style, recommends the best Barkly piece for that dog
- **Sizing chatbot** — floating widget on every page; conversational sizing helper
- **Lead capture** — newsletter and notify-me submissions get emailed and saved to a CSV on the server

## Stack

PHP 8 (no framework), vanilla JS, hand-written CSS. Hosted on Namecheap shared hosting (cPanel + LiteSpeed). Auto-deployed via a cron job that pulls `main` every 5 minutes.

AI calls go to Stability AI (image inpainting) and Google Gemini (vision). Keys live server-side in `barkly-secrets.php`, never in git.

## Getting started

See **[DEVELOPMENT.md](./DEVELOPMENT.md)** for the full onboarding walkthrough — prerequisites, local PHP setup, project layout, Namecheap/cPanel details, the deploy loop, secrets, and common gotchas.

Quick version:

```bash
git clone https://github.com/gjhaasie/barklyfashion.git
cd barklyfashion
brew install php   # macOS; or your platform's package manager
php -S 127.0.0.1:8000 -t .
# open http://127.0.0.1:8000/ncsitebuilder/try-on.php
```

## Deploying

Push to `main`. The server pulls and rebuilds within five minutes. No CI, no staging — keep changes small and verify on the live site after deploy.

## Owner

Studio: barklyfashion@gmail.com
