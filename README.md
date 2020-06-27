***Cron Job Monitoring Tool*** is a web based tool to centrally monitor all your cron jobs running in several servers in one web console.

![How CMJT works?](https://github.com/anandprabhusk/Cron-Job-Monitoring/blob/master/guide/CronJobMonitoringTool.png)

***Step 1***: In your mysql db, create a table named "cronjob" using guide\cronjob.sql script

***Step 2***: Copy 3 folders (api, jobs & config folders) to your web server that supports PHP

***Step 3***: Configure database credentials in config/database.php file

***Step 4***: Before proceeding for next step, verify web service using postman. A sample postman result is given - guide\sample-postman.png.
You must receive Status Code: 201. Data is successfully stored.

![Sample Postman results](https://github.com/anandprabhusk/Cron-Job-Monitoring/blob/master/guide/sample-postman.PNG)

***Step 5***: Add script to guide\shell-curl-script.txt to your script file. A sample is given - sample-shellscript.txt
You must assign values to variables in the shell-curl-script.txt

***Step 6***: Execute shell script and verify if values are posted to database