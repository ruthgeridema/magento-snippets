![alt tag](https://s27.postimg.org/3kxrjdpeb/magentophone.png)
# Open sales order page in magento by phone

Needed:
- VOIP Phone with asterisk server
- Activa for Asterisk 
- Phoner (http://www.phoner.de/index_en.htm)

How to setup?

**Setup Activa / TAPI**
Install Activa, and fill in the settings like:

If you haven't got an asterisk server, try finding an installer which adds your voip phone to your windows enviroment.

**Install on webserver**
Upload PHP file to, for example, /phoneredirect/index.php.
Test it by visiting the url and adding ?phonenumber=0612341234&apikey=apikey behind it, ofcourse using a phonenumber that exists in your orders. The apikey is the one you set up in the .php file.

**Setup Phoner**
Install phoner  
Copy connected.bat to a directory, for example c:/batfiles/connected.bat
Change the URL to the one you uploaded and add your API key.

Open Phoner and go to Options>>Communication.
Check if your phone is there. If not; make it go there :)

After that go to Options>>External Application
Selected connected.bat under the 'connected call' field, click on 'OK'.


You get the idea, if something doesn't work you can easily find it yourself.




