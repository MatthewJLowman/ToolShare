# Tool Share

This is Tool Share, the site I made for the capstone project at ABTech for the Web Development program.
Tool Share is primarily written in PHP, with CSS and minor Javascript functions

## Basic Features

You can add tools to the site to be borrowed by other users. An account is necessary to be able to lend and borrow tools.
An account is not necessary to browse the available tools.
There is also an admin account that can view, edit, and delete existing accounts.

## Installation

Download the code and put it in your localhost's folder. Use the included .sql file to set up the data base.
Make sure you modify db_credentials.php in the private folder to match your localhost's information.

define("DB_SERVER", "[your localhost name]");
define("DB_USER", "[your username]");
define("DB_PASS", "[your password]");
define("DB_NAME", "[your database name]");
