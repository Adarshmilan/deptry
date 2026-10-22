# 📦 UniSync – Campus Delivery Platform

UniSync is a peer-to-peer delivery app for college campuses. A student posts a request for something they need ("get me a notebook from the stationery shop") along with a delivery fee, and another student can accept it, deliver it and earn the fee. Both sides coordinate through a built-in chat.

> Detailed write-up: [`project_documentation.txt`](project_documentation.txt)

## ✨ Features

- **Login / sign up** with PHP sessions
- **Dashboard** listing every pending request from other students
- **Create a request** – item, pickup location and the fee you're offering
- **Accept a request** – become the deliverer for that item
- **My Deliveries** – see tasks you've accepted and requests you've posted, and mark them completed
- **Chat** between requester and deliverer (auto-refreshing, no page reload)
- **Feedback** page for suggestions and complaints

## 🔄 Request lifecycle

```
pending ──(someone accepts)──▶ accepted ──(requester confirms)──▶ completed
                                  │
                                  └── chat opens between both users
```

## 🛠️ Tech stack

- **Frontend:** HTML, Tailwind CSS (CDN), vanilla JavaScript
- **Backend:** PHP (mysqli)
- **Database:** MySQL
- **Local server:** XAMPP (Apache)
- **Deployment:** Heroku-style `Procfile` (`heroku-php-apache2`)

## 📁 Structure

```
├── index.php               # Login / sign-up tabs
├── signup.html
├── dashboard.php           # Pending requests
├── create_request.html     # New request form
├── my_deliveries.php       # Accepted tasks + my requests
├── chat.php                # Chat UI
├── feedback.php            # Suggestions & complaints
├── js/chat_logic.js        # Polls and sends chat messages
├── api/                    # PHP handlers (login, signup, create/accept/complete request,
│                           #   fetch/send messages, suggestions, complaints, db_connect)
└── database/unisync.sql    # users, requests, messages, suggestions, complaints
```

## 🚀 Run locally (XAMPP)

1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL**.
2. Clone this repo into `htdocs`:
   ```bash
   git clone https://github.com/Adarshmilan/deptry.git /opt/lampp/htdocs/unisync
   ```
3. Open phpMyAdmin, create a database called `unisync` and import `database/unisync.sql`.
4. Update the credentials in `api/db_connect.php` to match your MySQL setup.
5. Visit `http://localhost/unisync/`.
