INFORMATION ABOUT THE FILES:

1."db.php"
	>This contains class DB which contains function :
		a) connect : for establishing connection with the database.
		b) runQuery : for executing a query;
		c) closeConnection : for closing database connection;
	>No direct access is provided to this file.
	>It is included in other files for mysql queries.

2."api.php"
	>This contains classes
		a) SETVALUE
		 functions : 1) constructor : which sets the commission and service taxes percentages as required.
		b) FILE_HANDLER
		 functions : 1) putfile : which obtains the contents of the csv file chosen as input.
		 			 2) getfile : which returns the output csv file that contains the final settlement report;

3."index.php"
	>It contains the field for choosing the input file.
	>It contains the objects of the classes which are used for calling functions and as parameters.
	