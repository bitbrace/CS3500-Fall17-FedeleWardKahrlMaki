Resources/authenticate.php README

Description:-----------------------------------------------------------------------------------------------------------------------

Provides an API for session modification.  Some functions return a type-wise sentinel value if passed 'false' for either the
session ID or user ID.

Requires:--------------------------------------------------------------------------------------------------------------------------

Resources/etc.php
Resources/database.php

Input:-----------------------------------------------------------------------------------------------------------------------------

This page takes no input.

Output:----------------------------------------------------------------------------------------------------------------------------

This page creates no output, but several of the provided functions have side-effects on the database.

Provides:--------------------------------------------------------------------------------------------------------------------------

Function: 'recall' takes a session ID and gets the corresponding user ID from the database; it also calles 'updateSession'
Function: 'createSession' creates a new session given a user ID
Function: 'deleteSession' deletes a session given a session ID
Function: 'cleanSessions' deletes all sessions from the database that've expired
Function: 'authenticate' returns the user ID given the corresponding credentials
Function: 'updateSession' takes a session ID and renews the expiration time to 'duration' seconds from now (assuming it hasn't expired already)
