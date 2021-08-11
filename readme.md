# Customer import tool
A simple tool import customers from a third party API

Here are the steps you need to do for making this project work.

1. Clone the repository.
2. Create a virtual host that follows `/public` folder .
3. Run`composer update`.
4. Create a mysql/mariadb database.
5. Create an `.env` file, copying from `.env.example`.
6. Change values for DB connection.
7. Run `php bin/console doctrine:migrations:migrate` to create `customers` table in the DB.
8. Run `php bin/console app:import-customer` to import customers from the external API.
9. You can also specify arguments, for example run `php bin/console app:import-customer 2 AU` to import 2 customers from Australia.
10. Check `/customers` and `customers/{id}` endpoints to see the list of customers and a single customer by ID.

