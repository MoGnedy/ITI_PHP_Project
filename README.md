# ITI_PHP_Project
##ITI_PHP_Project##

###1-User authentication management:###

	The project manage a local user database (passwd,shadow).The project 
	
		10-create,update, display, and delete groups
		
		20-Create,update, display, and delete user accounts
		
		30-Change group membership
		
		40-The login screen can be used
		
			40-A) Authenticate an admin, and different admin levels
			
			40-B) Each user has certain privileges
			
		50-The authentication to the application will be provided by the authentication group
		
		60-Each operation must be logged as the logging group directions


###2-Apache virtual host configuration###

		10-Add,update, display and delete virtual host
		
		20-The configuration directives:
		
			1-ServerName
			
			2-DocumentRoot
			
			3-Enable / Disable php scripting for that VirtualHost
			
			4-Logging options for that virtual host access
			
			5-ServerAdmin
			
		30-The Application must check for the server error access.
		
		40-Restart the apache web server
		
		50-The authentication to the application will be provided by the authentication group
		
		60-Each operation must be logged as the logging group directions


###3-Process management:###

		10-The user logs in
		
		20-List all owned process(Full details)
		
		30-Can send any signal to that process
		
		40-Each operation must be logged as the loggin group directions


###4-Authentication team:###

To design mysql database to manage the authentication for all above projects (not a  system accounts)

		10-List all users in the system
		
		20-Choose users to delete,disable
		
		30-Add a user
		
		40-Update a user info
		
		50-Create groups
		
		60-Manage the group membership
		
		70-Provide the above projects with the function to authenticate.
		
		80-Each operation must be logged as the logging group directions
		
		
###5-Logging team:###

Log any event from any team to a mysql database.

		10-Provide all above team with a function to log the message
		
		20-Mark every message with a team identifier, so we can list only a certain team messages
		
		30-Categorize the messages into (alert,critical) based on how the message is critical. 
		
		The source of the log 	                    
		
			message will send the message along with its category
		
		40-Design a different levels of filters on the messages to close the search.
		
		50-Messages are logged with the category,date,time,service(which team),message
		
