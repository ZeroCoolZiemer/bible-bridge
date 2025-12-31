# 📖 BibleBridge v1.5  
**A flexible web platform for presenting Bible databases and ministry content.**

BibleBridge is a self-hosted web application that connects raw Bible databases to a modern, user-friendly web interface. It is designed for developers, churches, and ministries that need a reliable way to display Scripture, manage related content, and integrate Bible data into their own systems.

---

## 🎯 Purpose

BibleBridge exists to simplify how Bible data is presented and managed on the web.  
It provides practical tools for studying, organizing, and publishing Scripture-based content—without locking users into proprietary platforms or rigid data formats.

Whether you are:
- a **developer** working with an existing Bible database, or  
- a **church or ministry** seeking a customizable Bible and article platform,

BibleBridge is built to adapt to your data and workflow.

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

## 🔧 Installation & Configuration

BibleBridge uses a two-part setup process:  
**(1) Bible Reader configuration** and **(2) CMS configuration**.

### Part 1: Bible Reader Setup
1. Upload all files to your web server, preserving the directory structure  
2. Temporarily set `./config/config.php` permissions to `777`  
3. Visit `yourwebsite.com/setup.php`  
4. Enter database host, name, and credentials  
5. Map your Bible table columns (Book, Chapter, Verse, Text)  
6. **Security:** Delete `setup.php` and `match-columns.php` after setup  

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

## ☕ Support the Project
If BibleBridge is useful for your ministry or development work, consider supporting continued development:

[![Buy Me A Coffee](https://img.shields.io/badge/Buy%20Me%20a%20Coffee-ffdd00?style=for-the-badge&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/ziemer)
