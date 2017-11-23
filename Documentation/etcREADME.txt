Resources/etc.php README

Description:----------------------------------------------------------------------------------------------------------------------

This page is intended to provide misc functions for site-wide use (at your discretion).

Requires:-------------------------------------------------------------------------------------------------------------------------

Resources/database.php
Resources/authenticate.php

Input:----------------------------------------------------------------------------------------------------------------------------

This page takes no input.

Output:---------------------------------------------------------------------------------------------------------------------------

This page produces no output.

Provides:-------------------------------------------------------------------------------------------------------------------------

Function: 'errpage' for generating an error page with a message of your choice.
Function: 'startup' for initializing the database and performing periodic cleanup of stale data

Variable: 'domainName', which should contain the domain name of the server itself (details get messy)
