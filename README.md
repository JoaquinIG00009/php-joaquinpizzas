# MCO Web_App_Test - Joaquin Pizza's


## This application has 2 pages:

[ 1 ] index.php - functionalities:

	- Delete a specific pizza.

	- Add a new pizza.

	- In this page you can enter in a specific pizza page by 'clicking on it', to see the ingredients.

[ 2 ] pizza_info.php - functionalities:

	- If you tapped in a pizza in the previous page it will load his details.

	- Edit the pizza name.

	- Delete an item.

	- Change the order of each ingridient. 

	- Adding a new ingredit with name and price,

	- Return to the previous page.


## How to make the project work:

	1. I used XAMPP, version 8.1.6-0 with MySQL Database and Apache Web Server.

	2. On localhost/phpmyadmin I created a new database called: 'pizza_db'.

	3. There´s an exported database sql file in JoaquinPizzas/db_sql/pizza_db.sql

	4. On the file JoaquinPizzas/php/db.sql I configured the next details: 
		private $servername ='localhost';
	  	private $username='root';
	  	private $password='';
	  	private $dbname='pizza_db';

	5. The project folder must be in the /Applications/XAMPP/xamppfiles/htdocs/

	6. To execute the app enter in the url of your web-navigator: localhost/JoaquinPizzas
