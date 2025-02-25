# Welcome to our neohealth project
#Steps to Install and Test the Laravel Project

### **1. Install PHP & Composer**
- Ensure PHP and Composer are installed on the system:
  ```bash
  php -v
  composer -v

### **2. Navigate to the Project Folder**
- 
  ```bash
  cd path/to/extracted/project

### **3. Install Project Dependencies**
- 
  ```bash
  composer install

### **4. cp .env.example .env**
- 
  ```bash
  cp .env.example .env

### **5. Generate the Application Key
-
  ```bash
  php artisan key:generate

### **6. Configure the Database Connection
-
  ```bash
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password

### **7. Run Database Migrations
-
  ```bash
  php artisan migrate

### **8. Seed the Database ( for admin account)
-
  ```bash
  php artisan db:seed --class=AdminSeeder

### **9. Start the Laravel Development Server & Tailwind CSS ( run two command line by creating two termial at visual studio code)
-
  ```bash
  php artisan serve
  npm run dev
### if any incovenient happens feel free to ask me htoohtoo.mdy.mmr@gmail.com or u6612109@au.edu (microsoft teams) and we will also provide by exporting our mysql database 


