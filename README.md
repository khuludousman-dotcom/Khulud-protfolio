# 🌟 Fetiha Ousman - Personal Portfolio & Dynamic Contact System

**Comprehensive Documentation of the Personal Portfolio and Full-Stack Contact Management System**

---

## 1. Introduction

Welcome to the official portfolio repository of **Fetiha Ousman**! This project is a modern, engaging, and powerful full-stack website built to showcase personal skills, hobbies, and educational background. Beyond serving as a personal portfolio, it integrates a fully functional database-driven contact and messaging (Contact & Inbox) system, structured with high professional care.

---

## 2. Key Features

* **Modern Dark Theme UI:** Styled with a sleek dark aesthetic combined with vibrant purple glow accents, creating an immersive, visually appealing, and comfortable reading experience.
* **Fully Responsive Design:** Built using CSS Flexbox and Media Queries to ensure flawless compatibility, cleanliness, and readability across diverse devices such as laptops, tablets, and smartphones.
* **Interactive Contact Form:** Allows visitors to send messages securely. It utilizes PHP input validation, sanitization, and email verification to guarantee data integrity before saving it to the database.
* **Automated Database Setup:** Automatically provisions and sets up the MySQL database and the required `messages` table on-the-fly upon the first application load if they do not already exist.
* **Admin Inbox Dashboard (`messages.php`):** A dedicated backend interface that counts total incoming messages and displays them in reverse chronological order (newest first).

---

## 3. Security & Code Quality

* **SQL Injection Protection:** Communicates with the database using **PDO (PHP Data Objects)** and prepared statements to completely prevent database security vulnerabilities and injection attacks.
* **XSS Prevention:** Sanitizes and escapes all user-submitted text using `htmlspecialchars()` before rendering it in the browser, successfully blocking potential Cross-Site Scripting (XSS) threats.

---

## 4. Project Structure & File Breakdown

The project is structured in the following manner, where each file plays a vital role:

```text
├── index.php      # Main landing page (Home, About, Hobbies, Skills, & Contact Form)
├── messages.php   # Admin inbox dashboard where received messages are displayed
├── style.css      # Stylesheet containing layout, colors, animations, and responsive rules
└── Profile.jpg    # Profile picture displayed prominently on the homepage
```

### Detailed File Explanations:
* **`index.php`:** Serves as the main entry page of the website. It contains the profile picture, personal description, hobbies (Reading, Coding, Music, Movies), technical skills, and the contact submission form.
* **`messages.php`:** Acts as the dedicated admin inbox page where the owner can view all visitor messages.
* **`style.css`:** Provides custom styling, glow effects, typography, and responsive layouts across different screen sizes.

---

## 5. How to Run Locally? (How to Run Locally)

To easily run and test this project on your local machine, follow these steps:

1. **Start Server:** Open XAMPP (or a similar local server environment) and start both **Apache** and **MySQL**.
2. **Move Files:** Place the project files inside the `htdocs` directory in XAMPP under a dedicated project folder.
3. **Open in Browser:** Open your web browser and navigate to `http://localhost/your_folder_name/index.php` to launch, use, and test the website locally.

---
&copy; 2026 Fetiha Ousman. All Rights Reserved. | Professional Portfolio Documentation
