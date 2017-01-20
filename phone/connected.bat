@echo OFF

IF "%~1" == "" GOTO End
IF "%~1" == "Anonymous" GOTO End
start "" "https://www.yoururl.com/directory/file.php?phonenumber=%1&apikey=9rxP28m90F64oLAJ7dM4Qxy05q9bQXWm"

:End
exit /b
