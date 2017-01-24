#Warehouse statistics

Want to have the current amount of processing orders on a screen in your warehouse?
Just hook a screen to, for example, a Raspberry PI and run the page from a browser.
Updates every minute.

Make sure to add your warehouse IP Address to the .htaccess

This little snippet gives something like this:
![Example](https://i.gyazo.com/a3056887d54f5b8aaa37cf563f41224c.png)



##Orders till cutoff time
If you, for example, have a cutoff time at 16:00. You can just change:

$toDate = date('Y-m-d H:i:s', strtotime("now"));

to 

$toDate = date('Y-m-d H:i:s', strtotime("**today 16:00**"));

That will display all orders till 16:00, so your warehouse knows how much orders are left to process.

