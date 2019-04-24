# BugHunter 
A Bug management project for Bug Hunter. Bug Hunter easily Manage Bug & track Bug. 

## Features
- Add Bug Category, Bug with (Name,Description,Impact,Procedure & more..)
- Create New Project with URL & Update 
- Add Bug on Project, Mark as Completed & get Info of that Bug
- Use ClickJacking & CORS Tool
- Add New Program Link, Site Link, Tools Link


## Screenshot
![Screenshot1](https://user-images.githubusercontent.com/23343675/56159176-a7435980-5fe1-11e9-811a-2956594739ba.PNG)
![Screenshot2](https://user-images.githubusercontent.com/23343675/56159186-ae6a6780-5fe1-11e9-8e4d-08193c7d6c05.PNG)
![Screenshot3](https://user-images.githubusercontent.com/23343675/56159194-b1fdee80-5fe1-11e9-9c59-7aa790b819c0.PNG)
![Screenshot4](https://user-images.githubusercontent.com/23343675/56159259-d954bb80-5fe1-11e9-94a9-4764c70862b3.PNG)


## How to Run BugHunter
- Install <a href="https://sourceforge.net/projects/xampp/"> Xampp</a> / Lampp / Wampp
- Paste BugHunter in htdocs or www directory
- Upload bughunter.sql in you database using <a href="http://localhost/phpmyadmin">phpmyadmin</a>
- Update .env with your DBName, ServerName, Password
- In CMD Run Command
```
php artisan optimize
php artisan cache:clear
php artisan route:cache
php artisan view:clear
php artisan config:cache
```
- Run this Command for give permission
```sudo chmod -R 777 ./BugHunter```

### Note:- This is Linux Version 


