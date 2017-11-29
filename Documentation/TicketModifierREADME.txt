ticket.php README

Desc:

This page displays ticket creation and modification forms. If uid is set, the page will assume ticket creation and display the
creation form. If both uid and tid is set, then the ticket modification forms will be displayed.

Currently information is sent through GET for testing purposes, but it will eventually expect information transmitted over POST.



Input:

This page expects one or two variables to be set; uid, and optionally tid. uid always needs to be set to the integer id value of
the user logged in. If not, an error message will be displayed. If tid is set and the ticket exists in the database, then it will
be displayed on the page to be updated. tid can either be a single int id, or an array of ids. If in a array format, make sure
it fits this pattern: tid[]=#,#,...


Output:

This page will send Dashboard.php the uid once finished creating a ticket or updating an old ticket. If the user creates/updates a
ticket and chooses to view suggestions, it will send Suggestions.php the uid and the tid. It will only send one tid at a time so a
user can only view one ticket suggestion at a time.
