using System;
using System.Net;
using System.Diagnostics;

namespace Caller
{
    class Check 
    {
        static void Main(string[] args) 
        {
            
            var url = "http://www.yoururl.com/directory/file.php?exe=1&apikey=9rxP28m90F64oLAJ7dM4Qxy05q9bQXWm&phonenumber=";
            var phonenumber = args[0];

            var result = new WebClient().DownloadString(url + phonenumber);
        
            if (result != ""){
                Process.Start(result);
            }
            
        }
    }
}
