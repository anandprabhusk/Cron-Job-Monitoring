***Cron Job Monitoring Tool*** is a web based tool to monitor all your cron jobs and shell scripts in a centralized PHP web console.

***Step 1***: Create a table named "cronjob" using cronjob.sql script

***Step 2***: Copy 3 folders (api, jobs & config folders) to your web server that supports PHP

***Step 3***: Configure database credentials in config/database.php file

***Step 4***: Before proceeding for next step, verify web service using postman. A sample is given - sample-postman.png.
You must receive Status Code: 201. Data is successfully stored.

***Step 5***: Add script to shell-curl-script.txt to your script file. A sample is given - sample-shellscript.txt
You must assign values to variables in the shell-curl-script.txt

***Step 6***: Execute shell script and verify if values are posted to database