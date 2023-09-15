# LegacyIGN - A small server replacement for old Instagram versions
Note: Database template for this version is not updated and the old one is unsupported! I will upload it tommorow <br />
Creadits: i.instagram.com for the api responses, MarioPizza1 for suggestions on how to improve the project <br />
This server supports versions from 1.87 to the latest version on iOS 7 (maybe later) <br />
Supported features: <br />
Login - 100% <br />
Register - 100% <br />
timeline - 50% (retrieves a random photo from the database, might repeat) <br />
popular - 75% (retrieves all photos from the database if they are not over 30) <br />
photo upload - 65% (currently no way exists to retrieve the uploader's username or description, more research required) <br />
Profile - 40% (displays the userinfo (all accounts) and on id 1 it redirects to popular as a userfeed)  ( <br />
Activity - 10% (currently displays no updates yet) <br />
To be added: <br />
Likes - 0% <br />
Comments - 10% (not added in this repo) <br />
inbox - 0% (only on 5+) <br />
video uploading - 0% (no data is available, research required) <br />
Direct messages 12% (only allows you to view an empty direct message page saying how to dm someone) Note: Not included <br />
Known bugs: <br />
doesn't keep you logged in after closing the app (a fix for version 6+ might be available) <br />
Crashes on 3.0.1 when loading a couple of timeline objects <br />
Slow downs on all versions (kinda fixed in popular) <br />
crashes when viewing a picture in version 6+ (due to missing information) <br />
wierd bihaviour when uploading (a different username might appear on the device that has uploaded the picture, not a server side issue!!) <br />
failed upload <br />
