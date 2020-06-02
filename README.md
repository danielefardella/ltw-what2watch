# LTW - Progetto WHAT2WATCH
**Are you bored?** you would like to watch some movie? but you don't know which one?
No problem!
**WHAT2WATCH** works in way that every page refresh it will show you varius of new suggestions depending on the movie genre selected.

------------
### Which technologies used to develop this website?
- Bootstrap 4.5 - The main source of design.
- JavaScript - for the input control ***(addtrailer.js)***
- JQuery - For AJAX requests and manipulaton on the website logo. ***(alljs.js)***
- AJAX - Used for asynchronous requests which allows us to recive data as response without refreshing the page,so it is invisible to the visitor.
Used for the following functions: 
	- Movie details that shown up on the Bootstrap modal ***(trailerinfo.php)***
	- Sorting by genre ***(sort.php)***
	- Updating movie details inside Admin Panel ***(updateinfo.php)***
- PHP - As a side server language
- PostgrSQL - which is database system that extends the SQL language.
- And of course HTML5 and CSS.

### Features:
- Login system only for admin
- Admin control panel
	- Add new trailer
	- Edit trailer
	- Remove trailer

### What's inside?

**dbconnect.php** - in order to establish a connection to the database. (Must at first to be edited)
**index.php** - the main page of the website.
**sort.php** - sends a query to the database by selected genre and retrieve movies in random order from database.
**login.php** - login page for admin only.
**loginform.php** - check if admin does exists and opens a session.
**admin.php** - Admin Panel page.
**deletetrailer.php** - deletes the movie which was clicked on delete button.
**edittrailer.php** - Gets movie infomation from database and returns as response into Bootstrap modal which will allows us to edit the current movie.
**trailerinfo.php** - Gets movie information and shows inside Bootstrap modal.

......
to be continued

