CoreFiles/dashboard.php README

Description:-----------------------------------------------------------------------------------------------------------------------

This page displays a list of tickets associated with a given users.

Requires:--------------------------------------------------------------------------------------------------------------------------

CoreFiles/includes/header.inc.php
CoreFiles/includes/footer.inc.php
Resources/database.php
Resources/images/ic_mode_edit_black_24dp_1x.png

Input:-----------------------------------------------------------------------------------------------------------------------------

This page takes uses the superglobal '_GET'
In the future it should be shifted to '_POST', and/or '_COOKIE'.

Output:----------------------------------------------------------------------------------------------------------------------------

This page displays a table of tickets and links to edit them, along with a New Ticket button.
Provides tid when calling ticket.php.

Provides:--------------------------------------------------------------------------------------------------------------------------

N/A
