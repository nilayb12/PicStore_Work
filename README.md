# PicStore
An Image Hosting Solution
## How to Deploy:
1. Install [XAMPP](https://www.apachefriends.org/)/[WAMP](https://www.wampserver.com/en/).
2. Create a DB with your choice of name, and 2 Tables `images` & `users`.
   1. You can also create a User in your SQL Server specifically for this Application.
   2. Make sure to give Proper Permissions and Level of Access to this Account.
3. Make 2 Columns in `images` Table with `UserName` as the 1st Column & `FileName` as the 2nd, and both type `TEXT/VARCHAR`.
4. Make 3 Columns in `users` Table with `ID` as the 1st Column (Type `INT`), and `UserName` & `Password` as the 2nd & 3rd Columns (Type `TEXT/VARCHAR`).
5. Add Users to the `users` Table as required.
6. Clone the Project in `C:\xampp\htdocs`.
7. Modify the `dbConfig.php` as follows:
```php
<?php
$db = mysqli_connect('localhost', 'YOUR_ACCOUNT_USERNAME', 'YOUR_ACCOUNT_PASSWORD', 'DB_NAME');
?>
```
8. Create a folder `images` in `C:\xampp\htdocs\PicStore`.
9. Start your Web Server & DB Server and navigate to `localhost/PicStore`.
## Pictures:
