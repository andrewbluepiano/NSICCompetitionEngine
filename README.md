# Welcome to the NSICCompetitionEngine!

The engine is still a work in progress, but what is posted functions once you add a few things on your end. At this time you will need to have some understanding of web backends to use this code. You should be fine if you dont know PHP or HTML, but you will need to be at least familiar with SQL, web backends, and general program flow to use this. <br>
Later commits will be tailored towards usability without requiring any prior knowledge of anything.

## Things you will need installed:
A webserver (Apache) that supports PHP and SQL. <br>
A SQL DB matching the structure posted in SQLdbStructure. You can tweak and use that file to create the DB's.


## Files to configure
- A config.ini file that you will need to fill out with appropriate SQL account information. This is the format(vars) that the posted code looks for. 

[read only] <br>
rdserver = localhost<br>
rdusername = <br>
rdpassword = <br>
rddbname = NSIC2020<br>

[writing]<br>
wrserver = localhost<br>
wrusername = <br>
wrpassword = <br>
wrdbname = NSIC2020<br>

- Run a search for "PATH" over all files. You will need to update those and create the relevant paths. 
<br>
<br>
That should be it, it's not very pretty right now on the backend, but it's functional. 
<br>

### To-Do's

Switch from using .txt files to using .jsons to make things less messy. <br>
Switch from looking for a static ADMIN username to checking the users username against a DB of admins. <br>
Hide the admin menu if the logged in user is not an admin <br>
Add file upload capabilities <br>
Add in functionality to include notes when entering a custom number of points to score a team. <br>
Record time at which teams complete things in the DB <br>
