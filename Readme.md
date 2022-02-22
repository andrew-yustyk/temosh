[![Build Status](https://travis-ci.org/kyvour/temosh.svg?branch=master)](https://travis-ci.org/kyvour/temosh)

# 1. Prepare test data:

You can import test data to the new database/collection using prepared data from restaurants.json file.
In a case when you have installed `mongoimport` tool, you can use following command:
`mongoimport -u USERNAME -p PASSWORD --authenticationDatabase=AUTHDB --db DB_FOR_DATA_IMPORT --collection COLLECTION_NAME --file ./resources/restaurants.json`

For example:
`mongoimport -u root -p root --authenticationDatabase=admin --db temosh --collection restaurants --file ./resources/restaurants.json`

**!NOTE: The user should have *readWrite* access for the selected database.**

# 2. Clone git repository:
`git clone git@github.com:kyvour/temosh.git`

# 3. Dependencies:
- php >= 5.6;
- mongodb extension for php:
    * On Ubuntu 16.04 this extension exists on `universe` repository;
    * Also this extension exists on `ppa:ondrej/php` repository;
    * Also it can be installed via `pecl`: `pecl install mongodb`;

# 4. Installation:
Usual compose project installation:
- Go to the project directory: `cd temosh`;
- Run `composer install` command;

# 5. Usage:
Run application with `./temosh <YOUR_DATABASE_NAME>` command.

Run `./temosh --help` command for the application help.

By default application tries to connect to the default MongoDB instance: `127.0.0.1:27017` without authentication

The next options available:

| Alias   | Option                   | Description                 | Default                        |
| ------- | -------                  | ---------------------       | ----------                     |
| -H      | --host                   | server to connect to        | 127.0.0.1                      |
| -P      | --port                   | port to connect to          | 27017                          |
| -u      | --user                   | username for authentication | (empty)                        |
| -p      | --pass                   | password for authentication | (empty)                        |
|         | --authenticationDatabase | database for authentication | default to connection database |

Full command:
`./temosh -H <CONNECTION_HOST> -P <CONNECTION_PORT> -u <USERNAME> -p <PASSWORD> --authenticationDatabase=<AUTH_DB_NAME> <CONNECTION_DATABASE_NAME>`

You may run the command with options without the values. In this case required options will be asked interactively.

For example:
`./temosh -u <USERNAME> -p -- <CONNECTION_DATABASE_NAME>`.
In this case the password will be asked.

After connection to the database, the query will be asked.

**!NOTE: The query should have the following structure:**

`SELECT <Projections> FROM <Target> [WHERE <Condition>*] [ORDER BY <Field> [ASC|DESC] [,*]] [LIMIT <MaxRecords>] [[SKIP|OFFSET] <SkipRecords>]`

Example sql queries for the `restaurants` collection:
- `select borough, cuisine, address.zipcode, grades.score from restaurants where borough = Bronx and _id < 41396647 or cuisine = Chicken order by borough, address.zipcode asc limit 10`
- `select borough, address.zipcode, grades.score from restaurants where borough = Queens order by _id asc, address.bulding desc, address.zipcode asc limit 5 offset 4`
- `select borough, address.zipcode, grades.score FROM restaurants order by _id asc, address.bulding desc, address.zipcode asc limit 5 offset 4`
- `select borough, address.zipcode, grades.score FROM restaurants limit 5`
- `select borough, address.zipcode, grades.score FROM restaurants order by _id asc, address.bulding desc limit 2`

**You can enter `exit`, `quit`, `die` or `q` instead of SQL query to quit from the program.**

# 6. Limitations:
- Output is not so good for big nested json objects.
