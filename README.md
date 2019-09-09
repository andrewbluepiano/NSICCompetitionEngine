# Welcome to the NSICCompetitionEngine!

The engine is still a work in progress, but what is posted functions once you add a few things on your end.

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

- Run a search for "PATH" over all files. You will need to update those. 



That should be it, it's not very pretty right now on the backend, but it's functional. 
