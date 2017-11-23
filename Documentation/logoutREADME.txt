CoreFiles/login.php README

Description:----------------------------------------------------------------------------------------------------------------------

This page is meant to purge the client's session and redirect them back to the login page afterwards.

Requires:-------------------------------------------------------------------------------------------------------------------------

Resources/etc.php
Resources/authenticate.php

Input:----------------------------------------------------------------------------------------------------------------------------

This page takes a cookie labeled 'sessionID' as input from the user.

Output:---------------------------------------------------------------------------------------------------------------------------

This page purges the browser's session cookie and the corresponding entry in the database.

Provides:-------------------------------------------------------------------------------------------------------------------------

N/A
