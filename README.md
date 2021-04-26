# kadince_todo

## Setup

1. Run `git clone https://github.com/wad11656/kadince_todo.git` where you want the project directory to be stored.
2. Edit `create_table.sql` and replace `mydatabase`(x3), `mydbuser`, `myserver`, and `mypass` with your respective database credentials.
3. Execute the commands in `create_table.sql` on your server, either in a MySQL front-end or the `mysql` console.
4. Edit `create_env.php` and replace `myserver`, `mydbuser`, `mypass`, and `mydatabase` with your respective database credentials.
5. Load `create_env.php` in your browser.
    - If permissions are configured to allow it, this should generate a `.env` in the directory above your site root, and a `keyfile` at either `C:\keyfile` or `/usr/local/keyfile`.
6. Load `index.php`.

## Resources

<details><summary>Coding</summary>

##### PHP + MySQL ToDo Tutorial:
[https://codewithawa.com/posts/to-do-list-application-using-php-and-mysql-database]()

##### PHP .env plugin (to store DB credentials):
[https://github.com/vlucas/phpdotenv]()

##### Encrypt/Decrypt .env contents:
[https://www.codementor.io/@ccornutt/keeping-credentials-secure-in-php-kvcbrk55z]()

##### Create MySQL tables via command line:
[https://www.tutorialspoint.com/mysql/mysql-create-tables.htm]()

##### Change tutorial's incorrect `font-style: Helvetica` to `font-family: Helvetica`:
[https://stackoverflow.com/questions/32515519/css-invalid-property-value]()

##### Fix `due_date` incorrectly saving into databasae as `1970-01-01` every time:
[https://stackoverflow.com/a/8984620/3511695]()

##### PHP+MySQL - Insert multiple records:
[https://www.w3schools.com/php/php_mysql_insert_multiple.asp]()

##### Create textbox placeholder text:
[https://stackoverflow.com/questions/108207/how-do-i-make-an-html-text-box-show-a-hint-when-empty]()

##### `mysqli_query` `try{}catch(){}` syntax:
[https://www.php.net/manual/en/mysqli-driver.report-mode.php]()

##### Update MySQL via JQuery+Ajax after datepicker `onchange`:
[https://stackoverflow.com/a/28684832/3511695]()

##### JQuery - Extract value from `input` tag:
[https://api.jquery.com/val/]()

##### Disable spellcheck underlines:
[https://www.tutorialrepublic.com/faq/how-to-disable-spell-checking-in-html-forms.php]()

##### Ternary if-else examples:
[https://stackoverflow.com/questions/28602388/ternary-operator-in-php-with-echo-value]()

##### Display MySQL errors (`mysqli_fetch_array() expects parameter 1 to be mysqli_result, boolean given in...`):
[https://stackoverflow.com/questions/15439919/mysqli-fetch-array-expects-parameter-1-to-be-mysqli-result-boolean-given-in]()

##### PHP - Sort table:
[https://codeshack.io/how-to-sort-table-columns-php-mysql/]()

##### When data's stored in `$_GET` vs `$_POST`:
[https://stackoverflow.com/a/42942572/3511695]()

##### Check if PHP `$_SESSION` is already set:
[https://stackoverflow.com/a/10093292/3511695]()

##### PHP - Concatenate strings:
[https://www.codecademy.com/forum_questions/54329217548c35920e0081b7]()

##### Get URL query string:
[https://stackoverflow.com/questions/6768793/get-the-full-url-in-php]()

##### Using prepared statements:
[https://stackoverflow.com/a/51015777/3511695]()

##### Set time zone on datepicker:
[https://stackoverflow.com/a/62542096/3511695]()

##### Word wrap in `<td>`:
[https://stackoverflow.com/a/50880544/3511695]()

##### Prevent line break at hyphen (for `creation_date`):
[https://stackoverflow.com/a/28928832/3511695]()

##### Button hover color transition:
[https://www.w3schools.com/howto/howto_css_transition_hover.asp]()

##### PHP - Put contents in local file:
[https://stackoverflow.com/questions/5440912/how-to-put-the-a-string-into-a-text-file-in-php]()

##### PHP - Detect OS:
[https://stackoverflow.com/a/57843610/3511695]()
</details>

<details><summary>Environment Setup</summary>

##### Install PHP for NginX:
[https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-ubuntu-18-04#]()

##### Enable PHP IDE in Visual Studio 2019:
[https://www.youtube.com/watch?v=uwPtcFowP94]()

##### Fix broken shell interactivity in PuTTY:
[https://stackoverflow.com/questions/14837248/arrow-keys-in-putty-returning-a-d-b-instead-of-moving-the-cursor]()

##### Copy contents between PuTTY and host:
[https://www.alphr.com/copy-paste-putty/]()

##### Switch MySQL Command Line from JS mode to SQL mode:
[https://stackoverflow.com/questions/50645402/mysql-syntaxerror-unexpected-identifier]()

##### PHP project directory in WampServer:
[http://androidcss.com/php/install-setup-php-mysql-windows/]()

##### "Composer" PHP package manager installation on Windows/Linux:
[https://getcomposer.org/doc/00-intro.md]()

##### Reminder to allow external HTTP requests to app in web host firewall settings:
[https://stackoverflow.com/a/19117653/3511695]()

##### Install JQuery:
[https://www.w3schools.com/jquery/jquery_get_started.asp]()

##### Run `.sql` script to configure database:
[https://stackoverflow.com/questions/7616520/how-to-execute-a-sql-script-from-bash]()
</details>

<details><summary>Versioning</summary>

##### Using GitHub CLI tool:
[https://www.youtube.com/watch?v=tm9gdHd9qmE]()

##### Github `master` branch has now officially switched to `main`:
[https://stackoverflow.com/a/67139639/3511695]()

##### Git Branching & Merging:
[https://git-scm.com/book/en/v2/Git-Branching-Basic-Branching-and-Merging]()
</details>