# Nandhu's Beauty Salon — Full Website

A production-ready luxury beauty salon website with online booking, admin dashboard, PostgreSQL, Docker, and Render deployment support.

## Tech Stack
- **Backend:** PHP 8.2 + Apache
- **Database:** PostgreSQL 15
- **Libraries:** PHPMailer 6, PHP dotenv
- **Frontend:** Vanilla CSS/JS, Google Fonts (Playfair Display + Lato)
- **Deployment:** Docker / Docker Compose / Render

---

## 🚀 Quick Start (Docker)

```bash
# 1. Clone the repo
git clone <your-repo-url>
cd salon

# 2. Copy and fill in environment variables
cp .env.example .env
# Edit .env with your DB and SMTP credentials

# 3. Start with Docker Compose
docker-compose up --build

# 4. Visit
open http://localhost:8080
```

The database schema (`init.sql`) runs automatically on first start.

---

## 🔐 Default Admin Credentials

| Field    | Value       |
|----------|-------------|
| URL      | `/admin/login.php` |
| Username | `admin`     |
| Password | `Admin@123` |

> ⚠️ **Change the password immediately after first login!**

To generate a new hash:
```php
echo password_hash('YourNewPassword', PASSWORD_BCRYPT, ['cost' => 12]);
```
Then update the `admins` table directly.

---

## 📁 Project Structure

```
salon/
├── Dockerfile
├── docker-compose.yml
├── render.yaml
├── composer.json
├── .env.example
├── .htaccess
├── init.sql                  ← DB schema + seed data
├── config/
│   ├── db.php                ← PDO connection
│   └── mail.php              ← PHPMailer setup
├── includes/
│   ├── auth.php              ← Session auth (2hr timeout)
│   ├── csrf.php              ← CSRF token helpers
│   ├── functions.php         ← Shared utilities
│   ├── header.php            ← Public site header
│   └── footer.php            ← Public site footer
├── admin/
│   ├── login.php
│   ├── logout.php
│   ├── dashboard.php         ← Stats + today's bookings
│   ├── bookings.php          ← Full booking management
│   ├── services.php          ← Add/edit/delete services
│   ├── gallery.php           ← Upload/delete gallery
│   └── includes/
│       ├── header.php
│       └── footer.php
├── emails/
│   ├── booking_submitted.php
│   ├── booking_confirmed.php
│   └── booking_cancelled.php
├── assets/
│   ├── css/
│   │   ├── style.css         ← Brand design system
│   │   └── admin.css         ← Admin panel styles
│   ├── js/main.js
│   └── images/uploads/       ← Service & gallery images
├── index.php                 ← Home page
├── about.php
├── services.php
├── gallery.php
├── booking.php               ← Online booking form
├── contact.php
└── thank-you.php
```

---

## ☁️ Deploy to Render

1. Push code to GitHub
2. Go to [render.com](https://render.com) → New → Blueprint
3. Connect your GitHub repo — Render reads `render.yaml` automatically
4. Set environment variables in Render dashboard:
   - `SMTP_HOST`, `SMTP_PORT`, `SMTP_USER`, `SMTP_PASS`, `SMTP_FROM`
   - `ADMIN_EMAIL`
   - `APP_URL` → your Render URL
5. Deploy ✅

Render will provision a managed PostgreSQL database automatically via `render.yaml`.

---

## 📧 Email Setup (Gmail SMTP)

1. Enable **2-Factor Authentication** on your Google account
2. Go to Google Account → Security → **App Passwords**
3. Generate an app password for "Mail"
4. Set in `.env` or Render:
   ```
   SMTP_HOST=smtp.gmail.com
   SMTP_PORT=587
   SMTP_USER=your@gmail.com
   SMTP_PASS=your_16char_app_password
   SMTP_FROM=your@gmail.com
   ```

---

## 🔧 Update Placeholder Values

After setup, update these placeholders:

| File | Placeholder | Replace With |
|------|-------------|--------------|
| `includes/footer.php` | `YOUR_WHATSAPP_NUMBER` | e.g. `919876543210` |
| `includes/footer.php` | `Your Salon Address` | Real address |
| `includes/footer.php` | `+91 XXXXX XXXXX` | Real phone |
| `contact.php` | Same as above | Same |
| `booking.php` | Same as above | Same |
| `index.php` | Google Maps embed src | Your salon Maps URL |
| `emails/*.php` | `YOUR_APP_URL` | Production URL |

---

## 🛡️ Security Features

- PDO prepared statements (SQL injection protection)
- `password_hash()` / `password_verify()` for passwords
- CSRF tokens on all forms (rotated after each use)
- Session timeout (2 hours)
- Session ID regeneration on login
- `finfo` MIME-type validation for uploads
- File size limit (5MB max)
- `htmlspecialchars()` on all output (XSS protection)
- `.htaccess` blocks access to `.env`, `vendor/`, `init.sql`
- `noindex` meta on all admin pages

---

## 🎨 Brand Colors

| Name | Hex |
|------|-----|
| Soft Pink | `#F8C8DC` |
| Rose Gold | `#B76E79` |
| Cream | `#FFF5E4` |
| Lavender | `#E6E6FA` |
| Deep Plum | `#5D3A3A` |

Fonts: **Playfair Display** (headings) · **Lato** (body)
