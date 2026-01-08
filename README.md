# 📖 BibleBridge Framework v1.6  
**A lean, schema-agnostic web engine for presenting Bible databases.**

BibleBridge Framework is a self-hosted Bible-reading engine designed to bridge the gap between raw Scripture databases and modern web interfaces. It serves as a flexible foundation for developers, churches, and ministries to build reliable Scripture-based platforms and integrate Bible data into their own ecosystems.

---

## 🎥 Framework Demo

This short video demonstrates how the framework dynamically adapts to different Bible versions (e.g., KJV / LSG), evolving both content and search behavior in real time.

▶️ [**Watch the demo**](https://youtu.be/YFuIX6sQVVM)

---

## 🎯 Purpose

BibleBridge exists to simplify how Bible data is presented and managed on the web. It provides practical tools for studying and publishing Scripture-based content—without locking users into proprietary platforms or rigid data formats.

Whether you are:
- A **developer** working with an existing Bible database, or  
- A **church or ministry** seeking a customizable Bible-reading platform,

BibleBridge is built to adapt to your data and workflow.

---

## 🛠️ System Requirements

To ensure stability and performance with **Smarty 5**, BibleBridge v1.6 requires:

* **PHP:** 8.1 or higher (Optimized for Smarty 5.4)
* **Composer:** Required to manage core dependencies
* **Database:** MySQL 5.7+ or MariaDB 10.3+ (Required for full `utf8mb4` support)
* **Core Extensions:** `pdo_mysql`, `mbstring`, `openssl`, and `json`
* **Web Server:** Apache (with `mod_rewrite`) or Nginx

---

## 🔧 Installation & Configuration

BibleBridge features a streamlined setup process:

1. **Upload:** Upload all files to your web server, preserving the directory structure.
2. **Dependencies:** From the project root, run: `composer install`
3. **Permissions:** Ensure `./config/config.php` and `./smarty/templates_c/` are **writable**.
4. **Setup:** Visit `yourwebsite.com/setup.php` in your browser.
5. **Database:** Enter your database host, name, and credentials.
6. **Mapping:** Map your Bible table columns (Book name, Chapter, Verse, Text, Book ID) and configure any **license/permissions** notes.
7. **Optional:** Add additional Bible versions or datasets, enabling multi-Bible support in the UI.
8. **Security:** **Delete `setup.php` and `match-columns.php` immediately after setup.**

---

## 🚀 Features

### ✝️ Bible Database Integration
Connect your existing Bible database and present it through a clean, responsive interface built with **Bootstrap 5** and **Smarty**.
* **Navigation:** Structured book, chapter, and verse browsing with breadcrumbs.
* **Fast Search:** Intuitive search engine optimized for Scripture datasets.
* **Schema Mapping:** Link any SQL Bible table to the framework. By mapping Book Names directly, BibleBridge remains language-agnostic.
* **Seamless Swapping:** Switch between configured Bible versions or datasets directly in the UI—no code changes required.


### 🌍 Intelligent & Adaptive Features
* **Database-Aware Navigation:** Auto-adjusts book names and navigation based on your database structure.
* **SEO-Friendly Output:** Generates clean URLs and meta descriptions for better search engine discoverability.
* **Self-Healing "Proactive" Architecture:** Monitors engine health to prevent crashes or the "White Screen of Death."

---

## 🛡️ Security Recommendations
* Set configuration files (`./config/config.php`, `./config/connect.php`) to `644`.
* **Optional:** Move configuration files outside the public web root for maximum security.
* Update `settings.php` if directories are relocated to ensure paths remain valid.

---

## 📈 Version History

### **v1.6 (Current)**
* CMS and article features removed for a dedicated, lean Bible engine.
* Improved database mapping and version switching.
* Added permissions/license field in mapping for each Bible version.

### **v1.5**
* User settings for font size and color.
* Personal Bible notes for registered users.
* Improved SEO-friendly URLs.

---

## 🛠️ Built With
* **[Smarty](https://www.smarty.net/)** - Template Engine
* **[Bootstrap 5](https://getbootstrap.com/)** - UI Framework
* **[PHPMailer](https://github.com/PHPMailer/PHPMailer)** - Email handling
* **[jQuery](https://jquery.com/)** - JavaScript Library

---

## ☕ Support the Project
If BibleBridge is useful for your ministry or development work, consider supporting continued development:

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20a%20Coffee-ffdd00?style=for-the-badge&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/ziemer)
