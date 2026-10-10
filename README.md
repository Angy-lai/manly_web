# Apex Sports Club Website

> **Course:** ISE 2102: Web Technologies &bull; Semester Mini Project  
> **Club Identity:** Apex Sports Club  
> **Tagline:** *Move With Purpose. Play With Passion.*  
> **Main Slogan:** **PUSH BEYOND LIMITS.**  
> **Live Repository:** [https://github.com/Angy-lai/manly_web.git](https://github.com/Angy-lai/manly_web.git)

---

## 1. Project Overview & Architecture

Apex Sports Club is a student-led sports and fitness community website built for **ISE 2102: Web Technologies**. It strictly demonstrates core web standards:

- **Frontend:** Pure semantic **HTML5**, modern **CSS3**, and modular **Vanilla JavaScript**. All 5 interconnected pages (`index.html`, `about.html`, `activities.html`, `gallery.html`, `join.html`) are clean, framework-free HTML documents.
- **Backend:** **PHP 8** dedicated backend processor (`process.php`) handling secure form validation, data sanitization, PDO prepared statements, and database persistence with automatic fallback from MySQL to SQLite.
- **Deployment:** Dockerized Apache + PHP service tailored for **Render** cloud hosting with dynamic `$PORT` binding.

### Color Palette & Design System
* **Primary Deep Green:** `#072804`
* **Deep Pitch Black:** `#080C07`
* **Main Background:** `#0B110A`
* **Card & Section Dark:** `#152213` / `#10190E`
* **Athletic Lime Green (Accent):** `#38E54D` / `#C5F36A`
* **Light Theme Background:** `#F5F7F4`
* **Text Main Light:** `#F3F6F2`
* **Muted Subtext:** `#9DA899`
* **Borders:** `#1F3B1C`

---

## 2. Directory Structure

```
manlyweb_site/
├── assets/
│   ├── css/
│   │   └── style.css            # Responsive CSS (Variables, Grid, Flexbox, Lightbox modal)
│   ├── js/
│   │   └── main.js              # Vanilla JS: Arrays, Objects, Events, Lightbox, Validation
│   ├── girl_holding_ropes.jpeg  # Prebuilt fitness asset
│   ├── pic_of_balls.jpeg        # Prebuilt multi-sport asset
│   ├── sports.jpeg              # Prebuilt athletics asset
│   └── volley.jpeg              # Prebuilt volleyball asset
├── config/
│   └── database.php             # PDO database handler (MySQL with SQLite automatic fallback)
├── data/                        # Directory for local SQLite file storage (gitignored)
├── database.sql                 # MySQL schema for membership_applications
├── index.html                   # 1. Home Page (Hero, Philosophy, Sports grid, Upcoming events, CTA)
├── about.html                   # 2. About Us (Story, Mission/Vision, Objectives, Core values, Committee)
├── activities.html              # 3. Activities & Events (Filterable events grid, Weekly timetable)
├── gallery.html                 # 4. Gallery (Category filter, Responsive grid, Interactive Lightbox)
├── join.html                    # 5. Join Us (Membership application form with JS validation)
├── process.php                  # PHP Backend Form Processor (Validation, PDO insert, Confirmation receipt)
├── Dockerfile                   # Apache + PHP 8.2 Docker configuration for Render
├── docker-entrypoint.sh         # Dynamic port listener and runtime setup script
├── render.yaml                  # Render deployment blueprint
├── .gitignore                   # Standard Git ignore rules
└── README.md                    # Project documentation
```

---

## 3. Academic Requirements Fulfillment (ISE 2102)

| Component | Syllabus Requirement | Implementation Details |
|---|---|---|
| **A. HTML** | Tags, attributes, headings, paragraphs, links, images, lists, tables, forms | Semantic HTML5 structure across all 5 pages; training schedule table in `activities.html`; 10-field application form in `join.html`. |
| **B. CSS** | External CSS, box model, positioning, backgrounds, responsive design | `assets/css/style.css` using CSS custom properties, CSS Grid, Flexbox, sticky nav, mobile drawer, cards, and media queries. |
| **C. JavaScript** | Variables, conditionals, loops, functions, form validation, interactivity | `assets/js/main.js` with client-side form validation, real-time error messages, dynamic year, mobile hamburger menu. |
| **D. Arrays, Objects, Events** | Data storage in arrays/objects, event listeners (`onclick`, `oninput`, `onkeydown`, etc.) | `SPORTS_DATA`, `EVENTS_DATA`, `COMMITTEE_DATA`, `GALLERY_DATA` arrays of objects; event category filter; interactive Lightbox. |
| **E. PHP Backend** | Form processing, response display, database connectivity | `process.php` handles POST submissions, validates inputs server-side, inserts data via PDO prepared statements, and presents an HTML receipt. |
| **F. Hosting & Deployment** | Publicly accessible URL on cloud hosting | Configured for Render deployment using a custom Docker container with dynamic port routing. |

---

## 4. Local Development

### Prerequisites
- PHP 8.0 or higher
- Modern web browser

### Running Locally with Built-in PHP Server
```bash
# In the project root directory:
php -S localhost:8000
```
Open `http://localhost:8000/index.html` in your web browser.

---

## 5. Render Deployment Instructions

This repository is pre-configured to deploy seamlessly to **Render** as a Web Service:

1. **Push your code to GitHub:**
   ```bash
   git add .
   git commit -m "Refactor to pure HTML frontend and PHP backend"
   git push origin main
   ```
2. **Create a New Web Service on Render:**
   - Log in to your [Render Dashboard](https://dashboard.render.com).
   - Click **New +** &rarr; **Web Service**.
   - Connect your GitHub repository: `https://github.com/Angy-lai/manly_web.git`.
3. **Configure the Service:**
   - **Environment:** `Docker`
   - **Plan:** `Free`
   - Render will detect the `Dockerfile` and `docker-entrypoint.sh` automatically.
4. **Deploy:**
   - Click **Create Web Service**.
   - Render will build the Docker image and provide a live URL (e.g., `https://manly-web.onrender.com`).
   - SQLite will auto-initialize in `/var/www/html/data/` for form storage without any additional configuration required!
