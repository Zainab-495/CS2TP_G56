# Importing Example Users

To import example users into your local database, use the following command in your terminal (replace `username` and `database_name` with your MySQL credentials):

```
mysql -u username -p database_name < database/users.sql
```

This will import the users from the provided SQL file into your database.

**Note:**
- Only use this file for test/demo data. Do not use real user data in public repositories.
- Make sure your database schema matches the structure of the exported users table.
