# Apex Sports Club Website

> **Course:** ISE 2102: Web Technologies &bull; Semester Mini Project  
> **Club Identity:** Apex Sports Club  
> **Tagline:** *Move With Purpose. Play With Passion.*  
> **Main Slogan:** **PUSH BEYOND LIMITS.**  
> **Live Repository:** [https://github.com/Angy-lai/manly_web.git](https://github.com/Angy-lai/manly_web.git)

---

## 1. Project Overview & Identity

Apex Sports Club is a fictional university student sports and fitness community designed to inspire students across all disciplines to stay active, develop sporting discipline, forge lifelong friendships, and embrace physical wellbeing.

This project is built from scratch without frontend JavaScript frameworks (no React, Next.js, or Vue), strictly adhering to the **ISE 2102** academic syllabus by showcasing **semantic HTML5**, **modern CSS3**, **vanilla JavaScript** (arrays, objects, DOM manipulation, event listeners, form validation), **PHP 8** (includes, server-side sanitization, form processing), and **database persistence** via **PDO** (supporting MySQL and automatic SQLite fallback).

### Color Palette & Design System
* **Primary Deep Green:** `#072804`
* **Deep Black / Pitch:** `#080C07`
* **Main Background:** `#0B110A`
* **Card & Section Dark:** `#152213` / `#10190E`
* **Vibrant Athletic Lime Green (Accent):** `#38E54D` / `#C5F36A`
* **Light Theme Section Background:** `#F5F7F4`
* **Text Main Light:** `#F3F6F2`
* **Muted Subtext:** `#9DA899`
* **Borders:** `#22371E`

---

## 2. Architecture & File Structure

```
manlyweb_site/
├── assets/
│   ├── css/
│   │   └── style.css            # Unified responsive CSS (Flexbox, Grid, variables, Lightbox)
│   ├── js/
│   │   └── main.js              # Vanilla JS: Nav toggle, form validation, filters, modal
│   ├── girl_holding_ropes.jpeg  # Prebuilt athletic fitness asset
│   ├── pic_of_balls.jpeg        # Prebuilt multi-sport balls asset
│   ├── sports.jpeg              # Prebuilt athletics & running asset
│   └── volley.jpeg              # Prebuilt volleyball action asset
├── includes/
│   ├── header.php               # Shared navigation, sticky bar, accessibility metadata
│   ├── footer.php               # Shared footer, quick links, dynamic copyright year
│   └── functions.php            # Helper functions, HTML sanitization, sports & events data
├── config/
│   └── database.php             # PDO database handler (MySQL with SQLite automatic fallback)
├── data/                        # Directory for local SQLite file storage (gitignored)
├── database.sql                 # MySQL/MariaDB DDL schema for membership_applications
├── index.php                    # Home page (Hero, Philosophy, Sports grid, Upcoming preview, CTA)
├── about.php                    # About Us (Story, Mission, Vision, Objectives, Core values, Committee)
├── activities.php               # Activities & Events (Sport cards, Interactive JS filter, Timetable)
├── gallery.php                  # Club Gallery (Responsive grid, JS Category filter, Accessible Lightbox)
├── join.php                     # Join Us / Contact Us (Membership benefits, Form with JS validation)
├── process.php                  # Server-side PHP form processing, PDO database insertion, Receipt UI
├── Dockerfile                   # Production-grade Apache PHP 8.2 container for Render
├── docker-entrypoint.sh         # Dynamic port binding entrypoint for Render ($PORT)
├── render.yaml                  # Render Blueprint configuration
├── .gitignore                   # Standard Git ignore rules
└── README.md                    # Project documentation & deployment manual
```

---

## 3. Five Interconnected Pages

1. **Home (`index.php`)**:
   - High-impact hero section with cinematic athletic imagery and bold typography ("PUSH BEYOND LIMITS.").
   - "MORE THAN JUST A GAME" introduction highlighting Community, Performance, and Wellbeing.
   - "FIND YOUR GAME" cards for Football, Basketball, Gym/Fitness, Volleyball, Running, and Social Sports.
   - Dynamic upcoming fixtures preview with registration deep-links.

2. **About Us (`about.php`)**:
   - The Apex story and motivation for balancing university studies with movement.
   - Formal Mission, Vision, and 6 core Strategic Objectives.
   - Core Values: Inclusion, Teamwork, Discipline, Respect, Growth.
   - Responsive profile cards for student leadership (President, VP, Secretary, Treasurer, Coordinators).

3. **Activities & Events (`activities.php`)**:
   - Overview of all sports disciplines with equipment and venue specifications.
   - **Interactive JavaScript Category Filter** (`ALL`, `FOOTBALL`, `BASKETBALL`, `FITNESS`, `RUNNING`, `VOLLEYBALL`).
   - Responsive upcoming event cards with friendly empty state when no fixtures match.
   - **Semantic Weekly Timetable Table** with `caption`, `thead`, `tbody`, and `th` cells.

4. **Club Gallery (`gallery.php`)**:
   - Responsive multi-sport image gallery utilizing prebuilt sports imagery.
   - Interactive category filtering.
   - **Accessible Fullscreen Lightbox Modal**: Click to zoom, Next/Previous controls, backdrop dismiss, and keyboard accessibility (`Escape` to close, `ArrowLeft`/`ArrowRight` to navigate).

5. **Join Us / Contact (`join.php` & `process.php`)**:
   - 4 key student membership benefits.
   - Full registration form with 10 fields: Full Name, Student Email, Student ID, Course, Study Year, Preferred Sport, Experience Level, Reason/Goals, Form Purpose, and Consent Checkbox.
   - Real-time client-side JavaScript validation with error summaries.
   - Server-side validation, `htmlspecialchars()` sanitization, and PDO database storage in `process.php`.

---

## 4. How to Run Locally

### Prerequisites
* **PHP 8.0 or newer** installed on your system.

### Option A: Using PHP Built-In Web Server (Quickest)
1. Open your terminal / command prompt in this project folder:
   ```bash
   cd c:\Users\DELL\Desktop\manlyweb_site
   ```
2. Start the local server:
   ```bash
   php -S localhost:8000
   ```
3. Open your browser and navigate to:
   ```
   http://localhost:8000
   ```
   *Note: SQLite will automatically create `data/database.sqlite` when the first form is submitted — zero database configuration required!*

### Option B: Using XAMPP / WampServer / LAMP
1. Copy or clone this folder into your web root (e.g. `htdocs/manlyweb_site`).
2. Open phpMyAdmin and create a database named `apex_sports`.
3. Import `database.sql`.
4. In your environment or virtual host, set:
   - `DB_HOST=localhost`
   - `DB_NAME=apex_sports`
   - `DB_USER=root`
   - `DB_PASS=`
5. Navigate to `http://localhost/manlyweb_site`.

---

## 5. Deployment Guide: Deploying to Render

This project contains a **Dockerfile** and `render.yaml` pre-configured to run PHP 8.2 on **Render Web Services**.

### Step 1: Push Code to GitHub
Ensure all files are committed and pushed to your GitHub repository:
```bash
git add .
git commit -m "Complete Apex Sports Club website for ISE 2102"
git branch -M main
git push -u origin main
```

### Step 2: Create Web Service on Render
1. Go to [https://render.com](https://render.com) and log in.
2. Click **New +** and select **Web Service**.
3. Connect your GitHub repository: `https://github.com/Angy-lai/manly_web.git`.
4. Render will detect the `Dockerfile`:
   - **Name:** `apex-sports-club`
   - **Region:** Choose closest region (e.g., Frankfurt or Oregon)
   - **Instance Type:** `Free`
5. Click **Create Web Service**.
6. Render will build the Docker container, run Apache on the dynamic `$PORT`, and provide a public URL (e.g. `https://apex-sports-club.onrender.com`).

### Optional: Connecting a Remote MySQL Database on Render
If you wish to use a live MySQL database on Render:
1. Under Render, click **New +** -> **PostgreSQL** or connect to a free MySQL provider (such as Aiven or Clever Cloud).
2. In your Web Service settings on Render, navigate to **Environment** and add:
   - `DB_HOST`: your remote database hostname
   - `DB_NAME`: database name
   - `DB_USER`: database user
   - `DB_PASS`: database password
3. If no MySQL credentials are provided, the site operates seamlessly using its built-in SQLite database engine.

---

## 6. Academic Rubric Mapping (ISE 2102: Web Technologies)

| Requirement | Implementation Details |
| :--- | :--- |
| **A. HTML** | Semantic elements (`header`, `nav`, `main`, `section`, `article`, `aside`, `footer`, `table`, `caption`, `thead`, `tbody`, `form`, `label`, `input`, `select`, `textarea`, `button`). Logical heading hierarchy (h1 through h3), skip link, and alt tags. |
| **B. CSS** | External `assets/css/style.css` demonstrating CSS Box Model, CSS Grid, Flexbox, relative/absolute positioning, sticky blur header, CSS custom properties, and `@media` queries supporting widths down to 320px. |
| **C. JavaScript** | Variables (`const`, `let`), strict conditionals, loops (`forEach`, `filter`), client-side validation with real-time feedback, mobile menu drawer toggle, dynamic copyright year. |
| **D. Arrays, Objects & Events** | Stored gallery items in `window.APEX_GALLERY_DATA`, event object array, event listeners for `click`, `input`, `submit`, `DOMContentLoaded`, and keyboard events (`Escape`, `ArrowLeft`, `ArrowRight`). |
| **E. PHP** | Shared reusable modular includes (`includes/header.php`, `includes/footer.php`, `includes/functions.php`). Secure POST processor (`process.php`) with `filter_var()` and `htmlspecialchars()` output escaping. Prepared statement PDO database operations with automatic fallback. |
| **F. Hosting & Deployment** | Multi-platform deployment ready with `Dockerfile`, `docker-entrypoint.sh`, and `render.yaml` for Render cloud deployment. |

---

## 7. Sample Information Disclaimer
All committee member names ("Sample President", "Sample Treasurer"), event dates, and contact telephone numbers are academic placeholders for the ISE 2102 project and should be substituted with verified club details upon official campus chartering.
