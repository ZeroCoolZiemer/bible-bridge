# 📖 BibleBridge Framework v1.5  
**A flexible web platform for presenting Bible databases and ministry content.**

BibleBridge Framework is a self-hosted Bible-reading engine designed to bridge the gap between raw Scripture databases and modern web interfaces. It serves as a flexible foundation for developers, churches, and ministries to build reliable Scripture-based platforms, manage related ministry content, and integrate Bible data into their own custom ecosystems.

## 🎥 Framework Demo

This short video demonstrates how the framework dynamically adapts to different Bible versions (KJV / SEG), evolving both content and search behavior in real time.  

▶️ [Watch the demo](https://youtu.be/YFuIX6sQVVM)

---

## 🎯 Purpose

BibleBridge exists to simplify how Bible data is presented and managed on the web.  
It provides practical tools for studying, organizing, and publishing Scripture-based content—without locking users into proprietary platforms or rigid data formats.

Whether you are:
- a **developer** working with an existing Bible database, or  
- a **church or ministry** seeking a customizable Bible and article platform,

BibleBridge is built to adapt to your data and workflow.

## 🛠️ System Requirements

To ensure stability and performance with **Smarty 5**, BibleBridge v1.5 requires:

* **PHP:** 8.1 or higher (Required for Smarty 5.4 compatibility)
* **Composer:** Required to manage and install core dependencies
* **Database:** MySQL 5.7+ or MariaDB 10.3+ (Required for full `utf8mb4` Bible text support)
* **Core Extensions:** `pdo_mysql`, `mbstring`, `openssl`, and `json`
* **Web Server:** Apache (with `mod_rewrite` enabled for SEO-friendly URLs) or Nginx

---

## 🚀 Features

### ✝️ Bible Database Integration
Connect your existing Bible database and present it through a clean, responsive interface. Built with **Bootstrap 5** and the **Smarty Template Engine**, BibleBridge supports:
- Structured book, chapter, and verse navigation  
- Breadcrumb-based browsing  
- Fast, intuitive search  

The system adapts to your database structure rather than forcing a predefined schema.

---

### ✍️ Content Management for Ministries
BibleBridge includes a built-in CMS for publishing articles alongside Scripture:
- **Article Publishing:** Write and share teachings, devotionals, and updates  
- **Quill Rich Text Editor:** A modern editor for formatting content  
- **Admin Dashboard:** Create, edit, and manage content without technical overhead  

This allows ministries to keep Scripture and teaching materials in one unified platform.

---

### 🌍 Intelligent & Adaptive Features
- **Database-Aware Navigation:** Automatically adjusts book names, navigation, and search behavior based on the language and structure of your Bible database  
- **SEO-Friendly Output:** Generates clean URLs and meta descriptions (e.g., `/article/version-history`) to improve discoverability in search engines  

---

### 🌱 Adapt to Evolve

BibleBridge is more than a web application — it’s a framework for building adaptable Bible-based platforms. At its core, it uses **Data Abstraction** to connect to any existing Bible database without forcing a rigid schema.

All core settings are mapped through `./config/config.php`, allowing you to:

- **Schema Mapping:** Link any existing SQL Bible table to the framework. By mapping **Book Names** directly from your database, BibleBridge remains **language-agnostic**, preserving your specific nomenclature and translations (e.g., "Juan" vs. "John") without hardcoded restrictions.  
  *(Note: All Bible books should be present in your dataset; mapping a single book only is not supported.)*

- **Seamless Swapping:** Switch Bible versions or entire datasets in seconds—no changes to core logic required.

- **Dynamic Growth:** Adjust display behavior and data sources as your project evolves, without rewrites.

BibleBridge provides a flexible foundation so developers, churches, and ministries can **build, customize, and expand** Bible and content platforms on top of a consistent framework.

---

## 🔧 Installation & Configuration

BibleBridge uses a two-part setup process:  
**(1) Bible Reader configuration** and **(2) CMS configuration**.

### Part 1: Bible Reader Setup
1. Upload all files to your web server, preserving the directory structure
2. From the project root, run:
   `composer install`
3. Before running the setup script, ensure that `./config/config.php` and `./smarty/templates_c` are **writable** by the web server
4. Visit `yourwebsite.com/setup.php`  
5. Enter database host, name, and credentials  
6. Map your Bible table columns (Book, Chapter, Verse, Text)  
7. **Security:** Delete `setup.php` and `match-columns.php` after setup  

---

### Part 2: CMS & Articles Setup
1. Import `articles.sql` into your articles database  
2. Update credentials in `./db/articles-db.php`  
3. Run `setup-admin.php` to create an administrator account  
4. **Security:** Delete `setup-admin.php` after use  
5. Access the dashboard at `yourwebsite.com/login.php`  

---

## 🛡️ Security Recommendations
- Set config files (`config.php`, `articles-db.php`, `connect.php`) to `644`  
- Move configuration files outside the public web root when possible  
- Update file paths in `settings.php` if directories are relocated  

---

## 📈 Version History

### **v1.5 (Current)**
- User settings for font size and color  
- Personal Bible notes for registered users  
- Improved SEO-friendly URLs  

### **v1.4 – v1.1**
- Multi-language database support  
- Anonymous bookmarks (up to 7 passages)  
- Web-based installer  

### **v1.0**
- Initial release with Bible search, CMS, and article feed  

---

## 🛠️ Built With
BibleBridge is made possible by these amazing open-source projects:
* **[Smarty](https://www.smarty.net/)** - Template Engine
* **[Bootstrap 5](https://getbootstrap.com/)** - UI Framework
* **[Quill](https://quilljs.com/)** - Rich Text Editor
* **[PHPMailer](https://github.com/PHPMailer/PHPMailer)** - Email handling
* **[jQuery](https://jquery.com/)** - JavaScript Library

---

## ☕ Support the Project
If BibleBridge is useful for your ministry or development work, consider supporting continued development:

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20a%20Coffee-ffdd00?style=for-the-badge&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/ziemer)
