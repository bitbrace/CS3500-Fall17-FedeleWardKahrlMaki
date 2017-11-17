database.php README

Description:----------------------------------------------------------------------------------------------------------------------

This page is intended to be for the creation of a persistent PDO database (in order to mitigate the overhead of creating multiple
database connections as well as reduce overall codesize)

Requires:-------------------------------------------------------------------------------------------------------------------------

etc.php

Input:----------------------------------------------------------------------------------------------------------------------------

This page takes no input.

Output:---------------------------------------------------------------------------------------------------------------------------

On error, this page will display an error message page and stop the program.

Provides:-------------------------------------------------------------------------------------------------------------------------

This page provides the function 'initdb' for creating databases (it returns an object of type PDO).
