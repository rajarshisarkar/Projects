#Scheduled delivery in e-commerce

E-commerce has, undeniably, ushered in a new era, where all the hassles that a shopaholic (or anybody else for that matter) faces have been eliminated. From searching stuff, to adding them to the cart, to actually buying them have all turned into a cakewalk. But there is something that still bothers the customer. TIME!

Imagine you broke the frame of your spectacles and ordered one online. You went to work and returned with sore eyes and a terrible headache in the evening only to read this SMS while scanning your message inbox:

"The product could not be delivered as the addressee was not available."

Right product. Right price. Then what went wrong?

Irrespective of how amazing a product is, or the enormous discount at which it is available, the purchase either does not take place or becomes troublesome if the customer is not available; hence the importance of this app. It ensures smooth delivery and receipt of products. All a customer intending to buy a product has to do is fill up two extra blanks - DATE on which they want their product delivered,and a TIME SLOT of 30 minutes within which they want their product delivered. And bingo! The product is at their doorstep on that very day within the time frame provided by them. The customer is no longer uncertain about the delivery of the product, receives it on time, and is happy with the overall experience. The delivery associate who happens to be a company employee, is just as happy, since he does not have to go to the same place again and again owing to customer unavailability. And ofcourse, the company earns more because of the higher level of customer satisfaction. As a future prospect, the company can even charge the customers who wish to avail this service of delivering things on convenient dates and time slots; resort to peak pricing based on a set of criteria including the selected dates and time slots, the existing delivery traffic and the availability of delivery associates; thereby enabling generation of greater revenue for the company.

In a nutshell, the customer is benefited. And so is the company!

A win win situation, no?

## To run the web app online:

01. Open the web browser and type 'tinyurl.com/scheduleddeliveryinecommerce' in the URL box. Press enter to go to the online version of the app.
02. To login use the following credentials:
	* Customer (username: a, password: b)
	* Admin (username: admin, password: admin)
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
	* Customer (username: a, password: b)
	* Admin (username: admin, password: admin)
10. Login as a customer to place your order by selecting your delivery date and time slot.
11. Login as an admin to see the comprehensive list of scheduled deliveries arranged according to date, timeslots and pincodes.