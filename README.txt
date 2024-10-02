For Future Developers:

How to Use the Website:

Requirements:
- XAMPP
- Website documents in `C:/xampp/htdocs`

Steps:
1. Open XAMPP, Start **Apache** and **MySQL**.
2. Place the project folder in the `htdocs` directory.
3. Download the database creation script and import it to **MySQL** via phpMyAdmin.
4. Open your browser and navigate to `http://localhost/website/index.php` to begin.

Admin Credentials:
- Username: admin
- Password: admin

Developer Login:
- Username: james_smith
- Email: james.smith@gmail.com
- Password: jamespassword123
- Role: Developer

General User Login:
- Username: emily_johnson
- Email: emily.johnson@outlook.com
- Password: emilypass456
- Role: General User

---

How to Back Up the Database

Automated Backup:
1. A PHP script (`backup_db.php`) is used to automatically back up the database.
2. The backup is saved to the `C:/xampp/htdocs/backups/` folder.
3. To automate this, schedule a task in **Windows Task Scheduler**:
   - **Program**: `C:/xampp/php/php.exe`
   - **Arguments**: `C:/xampp/htdocs/backup_db.php`
   - Set it to run daily or at your preferred interval.

---

System & PHP Updates

Composer PHP Dependency Updates:
1. A PHP script (`update_composer.php`) is available to automate **Composer** updates.
2. This script updates all PHP libraries your project depends on.
3. Schedule the script to run weekly using **Windows Task Scheduler**:
   - **Program**: `C:/xampp/php/php.exe`
   - **Arguments**: `C:/xampp/htdocs/update_composer.php`

XAMPP Core Updates:
1. Regularly check for new XAMPP versions.
2. Back up your `htdocs` folder and databases before updating.
3. Replace XAMPP’s PHP, MySQL, and Apache components manually if needed.
