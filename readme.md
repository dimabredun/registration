Registration / Login / Logout forms
Create a registration form that allows users to sign up for the site. After successful registration users will
be signed in automatically. The system will display the current user email, name and ‘logout’ link. Users
can log out by clicking on the link. Create a “sign-in” form. Users can sign in with their login + password
OR email + password pairs.
Functional requirements
1. Registration form fields:
   a. email;
   b. login;
   c. real name;
   d. password;
   e. birth date;
   f. country (drop down list taken from database);
   g. agree with terms and conditions (checkbox, must be checked by user).
2. Sign in form fields:
   a. login or email;
   b. password.
   ● All fields should be validated before saving to DB;
   ● Form should remain filled (except password field) in case of validation errors;
   ● Email and login must be unique;
   ● List of countries should be stored in DB;
   ● Add user registration Unix timestamp to DB (field type - integer).
   ● Routing have to work not only in the root of domain, it will be tested on our dev server in separate
   folder, example:
   http://site.com/test-task100500/{your routing}
   Please check this before sending a completed task.
   Development requirements
   ● Should work on PHP 7.4+ / MariaDB 10.3+ / HTML5 / CSS;
   ● Use plain php, off-the-shelf registration/login libs;
   ● You can use 3rd-party mysql libs, validation libs;
   ● Character encoding is UTF-8 everywhere: MySQL, HTML, PHP;
   ● Try to keep your code well structured;
   ● Try to follow S.O.L.I.D. principles;
   ● Create a private repository (ex. on bitbucket.org) and share it with our account -
   services@codeit.com.ua. Provide us with the URL of your repository;
   ● Will be a plus if you could deploy your project on any free hosting and provide us with the URL
   (ex. heroku linux);