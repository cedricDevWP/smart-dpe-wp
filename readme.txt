=== Smart DPE ===
Contributors: cedricchevillard
Tags: dpe, ges, energy label, real estate, energy efficiency
Requires at least: 5.8
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Generate and display DPE and GES labels connected to Smart DPE.

== Description ==

**Smart DPE** helps you display DPE and GES energy labels automatically on your WordPress site.

Designed for real estate professionals, landlords, or property managers, this plugin connects directly to the [Smart DPE](https://smart-dpe.immo/) service.

Save time staying compliant with energy performance regulations — no need to re-enter your data every time.

- Dynamically generate compliant labels.
- Secure connection to your Smart DPE account (or free use with watermark).
- Responsive display on all pages, posts, or listings.
- **Automatic caching for 7 days** to reduce API requests.
- Option to **manually clear the cache** per post to force regeneration.
- Automatic label updates if your diagnostics change.

== Installation ==

1. Download the plugin from WordPress.org or your WordPress dashboard.
2. Activate the plugin via **Plugins > Installed Plugins**.
3. Go to **Settings > Smart DPE** to connect your Smart DPE account with your email and password.
4. Copy and paste the `[smart_dpe]` shortcode wherever you want to display the label.

== Frequently Asked Questions ==

= Is the plugin free? =
Yes, you can use the plugin for free. Without a Smart DPE account, your generated labels will include a watermark. With a premium account, the watermark is removed and you can display your saved labels.

= Where can I find my label ID? =
Log in to your [Smart DPE](https://smart-dpe.immo/) account and get the ID of the label you want to display.

= How do I use the shortcode? =
You can insert the shortcode in your pages, posts, or templates. Examples:
- Generate a label: `[smart_dpe dpe="50" ges="3" format="jpg"]`
- Display an existing label: `[smart_dpe id="123"]`

The default image format is "jpg".

= How does the cache work? =
Each label is stored in an internal cache for 7 days to reduce the number of API requests to Smart DPE.  
You can manually clear the cache for a specific post from the WordPress editor.

= Are the labels compliant with regulations? =
Yes, Smart DPE generates labels that comply with current regulations.

== Screenshots ==

1. Smart DPE settings in the WordPress admin.
2. Example of a DPE label displayed on a page.
3. Button to clear the Smart DPE cache for a specific post.

== Changelog ==

= 1.0.0 =
* Initial version: API connection, JWT token management, cron token check, label shortcode, 7-day cache system with per-post clear cache button.

== Upgrade Notice ==

= 1.0.0 =
First stable release.

== License ==

Smart DPE is distributed under the GPLv3 or later license.

== External Services ==

This plugin connects to the Smart DPE API at https://api.smart-dpe.immo to generate and display energy labels.

**What data is sent:**  
- When you connect your Smart DPE account, your email and password are used to generate a secure JWT token.  
- When generating a label, the DPE and GES values or the ID of an existing label are sent.

**Where:**  
- Data is sent securely to the Smart DPE API endpoint at https://api.smart-dpe.immo.

**Why:**  
- This is necessary to dynamically generate energy labels and display them on your WordPress site.

---

## 🔑 Notes
- Keep your WordPress site up to date for the latest improvements.
- All sensitive data (login/password) is encrypted.
- The plugin is translation-ready (interface in English, generated labels in French).
- More info and support at [https://smart-dpe.immo/](https://smart-dpe.immo/).
