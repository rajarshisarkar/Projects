#Scheduled delivery in e-commerce

This project highlights how deliveries can be scheduled in e-commerce. A user can schedule his delivery by choosing a delivery date and a delivery time slot and the package will be delivered to the user at that scheduled date and time slot only. This reduces the problem of expecting your package to be delivered at odd times. A college goer or an office goer can conveniently schedule their package when they are free (say 6:30 PM – 7:00 PM) and need not to panic as the delivery will never be made when they are unable to receive it. A negligible amount may be charged to avail this service and this amount can directly contribute to the revenue to the company. As future prospects, the negligible amount to avail this service can be surged if too many deliveries are to be made at a specific location at a single time slot. This will also directly contribute to the revenue to the company.

## To run the web app online:

01. Open the web browser and type 'tinyurl.com/scheduleddeliveryinecommerce' in the URL box. Press enter to go to the online version of the app.
02. To login use the following credentials:
    02.01. Customer (username: a, password: b)
    02.02. Admin (username: admin, password: admin)
03. Login as a customer to place your order by selecting your delivery date and time slot.
04. Login as an admin to see the comprehensive list of scheduled deliveries arranged according to date, timeslots and pincodes.

##To run the web app locally on your system:

01. Install XAMPP.
02. Run XAMPP and start the Apache server and MySQL server.
03. Make sure that your system is connected to the internet as the app fetches data using Walmart's Open API. Without internet the app will not run.
04. Copy the 'src' folder to '~/xampp/htdocs' where ~ denotes the installation directory of XAMPP.
05. Open the web browser and type 'localhost/phpmyadmin/' in the URL box.
06. Create a database named 'preferred_delivery_time_db' and import the 'preferred_delivery_time_db.sql' file from 'src' folder.
07. Go to '~/xampp/htdocs/src' and modify the values of $username and $password variable of connect.php file if the username and password of your MySQL server varies from the one given in connect.php.
08. Open the web browser and type 'localhost/src/index.php' in the URL box to run the app.
09. To login use the following credentials:
    09.01. Customer (username: a, password: b)
    09.02. Admin (username: admin, password: admin)
10. Login as a customer to place your order by selecting your delivery date and time slot.
11. Login as an admin to see the comprehensive list of scheduled deliveries arranged according to date, timeslots and pincodes.