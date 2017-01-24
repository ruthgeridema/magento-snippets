# Open sales order page in magento by phone
Will try to find the order at every phonecall. 
I'll look into C# next week to open the browser only when an order is found.

Note:
-Works best if you remove all dashes (-) at checkout.
-In our production enviroment we get about 60% hit rate.
-Ofcourse doesnt work with anonymous callers.
-Provided 'as is', feel free to modify.



Required:
- VOIP Phone with asterisk server
- Activa for Asterisk 
- Phoner (http://www.phoner.de/index_en.htm)

#Installation

##Setup Activa / TAPI
Install Activa, and fill in the settings like:

![alt tag](https://i.gyazo.com/164a57c8f2123a9a69edd1204724f24f.png)

If you haven't got an asterisk server, try finding an installer which adds your voip phone to your windows enviroment.

##Install on webserver
Upload PHP file to, for example, /phoneredirect/index.php.
Test it by visiting the url and adding ?phonenumber=0612341234&apikey=apikey behind it, ofcourse using a phonenumber that exists in your orders. The apikey is the one you set up in the .php file.

##Setup Phoner
Install phoner  
Copy connected.bat to a directory, for example c:/batfiles/connected.bat
Change the URL to the one you uploaded and add your API key.

Open Phoner and go to Options>>Communication.
Check if your phone is there. If not; make it go there :)

After that go to Options>>External Application
Selected connected.bat under the 'connected call' field, click on 'OK'.

Or you can compile connected.cs with an C# compiler.
Just change the code where needed, and select the exe instead of the .bat.
I prefer the exe, because it only opens your browser when an order is found.

Problems with compiling? Just download Visual Studio Code, install the C# extension.
CD into the directory where the file is in the commandline (type CMD to open).
Enter the following:
csc connected.cs

An exe has been generated :)


![alt tag](https://i.gyazo.com/600784d9e45789d2d849ef41a6e815ca.png)

You get the idea, if something doesn't work you can easily find it yourself.




