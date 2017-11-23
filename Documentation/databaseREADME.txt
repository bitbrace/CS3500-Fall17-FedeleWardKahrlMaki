Resources/database.php README

Description:-----------------------------------------------------------------------------------------------------------------------

This page is intended to be for the creation of a persistent PDO database (in order to mitigate the overhead of creating multiple
database connections as well as reduce overall codesize)

Requires:--------------------------------------------------------------------------------------------------------------------------

Resources/etc.php

Input:-----------------------------------------------------------------------------------------------------------------------------

This page takes no input.

Output:----------------------------------------------------------------------------------------------------------------------------

On error, this page will display an error message page and stop the program.

Provides:--------------------------------------------------------------------------------------------------------------------------

Function: 'initdb' for initializing the database connection
Function: 'rolldie' for rolling back a database transaction and displaying an error message to the user

Variable: 'database' of type 'PDO' for executing queries on the database

Misc: Some global database related variables
