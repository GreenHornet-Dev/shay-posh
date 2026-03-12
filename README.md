# Shay's Posh Site

Personal website for Shay Hewitt, Independent Perfectly Posh Advocate.
All shop links redirect to: https://perfectlyposh.com/shayhewitt

## Site Structure

```
shay-posh/
├── index.html          # Homepage
├── products.html       # Product highlights with shop + alert buttons
├── alerts.html         # Sale alert signup form
├── about.html          # About Shay
├── css/
│   └── style.css       # Pink-themed global styles
├── sale-alert.php      # Backend: emails Shay + logs CSV
├── download-alerts.php # Password-protected CSV download for Shay
└── data/
    └── sale_alerts.csv # Auto-created on first signup (gitignored)
```

## Features

- All product cards link to `https://perfectlyposh.com/shayhewitt`
- Sale alert signup form captures customer email + product interests
- On signup: Shay gets an email notification + customer gets a confirmation
- All signups logged to `data/sale_alerts.csv`
- Shay can download CSV anytime via password-protected link

## Setup

1. Upload all files to a PHP-enabled host (Hostinger, SiteGround, etc.)
2. In `sale-alert.php` update `yourdomain.com` to your actual domain
3. Optionally change the CSV download password in `download-alerts.php`
4. Make sure the `data/` folder is writable by the server (`chmod 755 data/`)

## Shay's Download Link

```
https://yourdomain.com/download-alerts.php?key=PoshRocks2026
```

## Contact

Shay Hewitt — shayitwithposh@mail.com

## Disclaimer

This is the personal website of an Independent Perfectly Posh Advocate.
Not owned or operated by Perfectly Posh.
