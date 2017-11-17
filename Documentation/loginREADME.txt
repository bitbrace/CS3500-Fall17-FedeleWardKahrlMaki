login.php README

Description:----------------------------------------------------------------------------------------------------------------------

This page is to be accessed via the internet browser. It presents the user with a form where they can submit a 'username' and
'password'. This page redirects back to itself in order to validate the user's input.

Requires:-------------------------------------------------------------------------------------------------------------------------

etc.php
database.php

Input:----------------------------------------------------------------------------------------------------------------------------

This page is to be accessed by:
the user, where they can:
	provide a username
	provide a password,
or by an external mechanism, which can (via POST):
	provide a username
	provide a password.

Output:---------------------------------------------------------------------------------------------------------------------------

If the user logged in correctly,
	they will be redirected to 'dashboard.php'
	with their accompanying 'uid' will be passed as part of the GET variables.
If they didn't,
	an error message will be displayed.

Provides:-------------------------------------------------------------------------------------------------------------------------

N/A
