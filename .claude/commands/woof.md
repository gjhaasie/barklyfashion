---
description: Push local commits and redeploy barklyfashion.com via cPanel UAPI
---

Redeploy barklyfashion.com.

Run these steps in order. Stop and surface the error if anything fails.

1. **Read the cPanel API token** from `.claude/cpanel-token` (one line, no whitespace). If missing, tell the user to create that file with the token from cPanel → Manage API Tokens. Export it as `CP_TOKEN` for use in subsequent curl calls.

2. **Push any local commits.** Run `git status -sb`. If there are unpushed commits on `main`, run `git push origin main`. If the working tree has uncommitted changes, stop and tell the user to commit or stash first — don't auto-commit.

3. **Pull on cPanel** so the server-side checkout matches `origin/main`:
   ```
   curl -sS -m 60 -H "Authorization: cpanel barkgjug:$CP_TOKEN" \
     --data-urlencode "repository_root=/home/barkgjug/barklyfashion" \
     --data-urlencode "branch=main" --data-urlencode "remote=origin" \
     -G "https://server72.web-hosting.com:2083/execute/VersionControl/update"
   ```
   Parse the JSON and report the new HEAD commit (`data.last_update.identifier[:7]` and the first line of `data.last_update.message`).

4. **Trigger the deploy:**
   ```
   curl -sS -m 60 -H "Authorization: cpanel barkgjug:$CP_TOKEN" \
     --data-urlencode "repository_root=/home/barkgjug/barklyfashion" \
     -G "https://server72.web-hosting.com:2083/execute/VersionControlDeployment/create"
   ```
   Capture `data.deploy_id` and `data.log_path` (just the basename).

5. **Wait ~6 seconds**, then read the deploy log via Fileman to confirm both `rsync` and `/bin/chmod 0755 $DEPLOYPATH` ran with exit code 0:
   ```
   curl -sS -m 30 -H "Authorization: cpanel barkgjug:$CP_TOKEN" \
     --data-urlencode "dir=/home/barkgjug/.cpanel/logs" \
     --data-urlencode "file=<basename from step 4>" \
     -G "https://server72.web-hosting.com:2083/execute/Fileman/get_file_content"
   ```

6. **Probe the live site:**
   ```
   curl -sS -o /dev/null -w "/         %{http_code} %{size_download}B\n" "https://barklyfashion.com/?cb=$RANDOM"
   curl -sS -o /dev/null -w "/Shop/    %{http_code} %{size_download}B\n" "https://barklyfashion.com/Shop/?cb=$RANDOM"
   curl -sS -o /dev/null -w "/About-us/ %{http_code} %{size_download}B\n" "https://barklyfashion.com/About-us/?cb=$RANDOM"
   ```
   All three should return HTTP 200. If any returns 404, check that `public_html` perms are 0755 — if not, run the chmod fix (api2 `Fileman::fileop op=chmod metadata=755 sourcefiles=/home/barkgjug/public_html`).

Report: HEAD commit deployed, deploy_id, the three HTTP codes. Keep it tight — one line per result.

## Context

- **Account:** `barkgjug` on `server72.web-hosting.com:2083`
- **Repo on server:** `/home/barkgjug/barklyfashion`
- **Docroot:** `/home/barkgjug/public_html`
- **Deploy mechanism:** `.cpanel.yml` runs `rsync -a` + `/bin/chmod 0755 $DEPLOYPATH`. The chmod is critical — without it the docroot drops to 0700 and every URL 404s while the autoindex fallback renders.
- **GitHub remote:** `git@github.com:gjhaasie/barklyfashion.git`
