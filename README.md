# CPR Facility Management System

This is a web app I built during my internship at **BHEL, Jhansi**.

The goal of this project was to create a simple, digital way for the Central Plant Repairs (CPR) department to handle facility maintenance requests. I noticed that the existing process could be slow, so I developed this system to help track issues easily and make sure everything gets resolved faster.

---

### What it Does

* **Log In:** A secure login system for both regular employees and system admins.
* **Submit a Request:** Any employee can log in and submit a new maintenance request or flag an issue they've found.
* **Track Status:** Users can see the live status of their requests (e.g., Pending, In Progress, Resolved).
* **Admin Dashboard:** Admins get a central dashboard to view all incoming requests, assign them to the right people, and mark them as complete.

---

### Tools I Used

I built this project using a standard LAMP stack:
* **PHP** for the backend logic.
* **MySQL** for the database.
* **HTML** and **Tailwind CSS** for the user interface.

---

### How to Run It

If you want to get this running on your own machine, here’s how:

**What you'll need:**
* A local server environment like XAMPP or WAMP.

**Setup Steps:**

1.  First, clone this repository into your `htdocs` folder (if you're using XAMPP).
    ```sh
    git clone [https://github.com/Yousuf-Wizdan/CPR-FACILITY-MANAGEMENT-SYSTEM.git](https://github.com/Yousuf-Wizdan/CPR-FACILITY-MANAGEMENT-SYSTEM.git)
    ```
2.  Make sure Apache and MySQL are running from your XAMPP control panel.

3.  Next, you'll need to set up the database. Go to `http://localhost/phpmyadmin`, create a new database, and import the `.sql` file included in this repo.

4.  Finally, open up the database connection file (probably named `config.php` or `db_connect.php`) and update the database name, username, and password to match your local settings.

5.  You should now be able to run the app by going to `http://localhost/CPR-FACILITY-MANAGEMENT-SYSTEM` in your browser.

---

### A Note of Thanks

A big thank you to everyone at **BHEL, Jhansi**, for the amazing internship opportunity. I learned a ton while working on this project and am grateful for the guidance I received from the team.
