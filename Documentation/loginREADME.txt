CoreFiles/login.php README

Description:----------------------------------------------------------------------------------------------------------------------

This page is to be accessed via the internet browser. It presents the user with a form where they can submit a 'username' and
'password'. This page redirects back to itself in order to validate the user's input (more info in section 'Output').

Requires:-------------------------------------------------------------------------------------------------------------------------

Resources/etc.php
Resources/authenticate.php

Input:----------------------------------------------------------------------------------------------------------------------------

This page is to be accessed by:
the user, where they can:
	provide a username
	provide a password,
or
	provide a cookie with a session ID
or by an external mechanism, which can (via POST):
	provide a username
	provide a password.

Output:---------------------------------------------------------------------------------------------------------------------------

If the user logged in correctly,
	they will be redirected to 'dashboard.php'
	with a new/updated cookie and session (mirrored in the database)
If they didn't or they're not using HTTPS,
	an error message will be displayed.

Provides:-------------------------------------------------------------------------------------------------------------------------

N/A
