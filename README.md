# kadince_todo
#### Demo: http://35.197.8.81:5050 ([Archived Version (non-functional)](https://web.archive.org/web/20220904093843/http://35.197.8.81:5050/))

<img src="https://raw.githubusercontent.com/wad11656/kadince_todo/main/Demo.gif" width="500"/>

## Background
This was for the coding challenge that the software development company Kadince administered to me. They were unimpressed (visibly confused/judgmental) with the decision to use PHP and, other than that, didn't talk about this code at all in the interview (which code I was proud of).

I went the extra mile to learn how to encrypt the database credentials into a keyfile, then store that file on the server outside of the site's directory (so it couldn't be accessed from potential hackers on the web site itself), which steps to reproduce are in the setup instructions below. I also made careful efforts to document all the resources I used to put this project together (under [Resources](https://github.com/wad11656/kadince_todo/blob/main/README.md#resources)). I also went the extra step of limiting the datepicker to dates from today, onwards.

### The interview itself
This was my first real programming interview. It went terribly. I didn't come into the interview prepared with a particular programming language in mind. (My programming education had us flip-flopping between 5+ languages and frameworks, so we never had the opportunity to truly become comfortable in 1 single language or framework.) So when the interviewers asked me to whiteboard, I mixed up the syntaxes between all the various languages that were swimming around in my head: my variable delcarations and my loops were in the syntaxes of 2 different languages! My brain come to a halt, as it always does around other people (especially in a high-stress situation like a job interview), so I couldn't think critically enough to solve their whiteboard exercises in a non-embarrassing amount of time, nor with a non-embarrassing amount of help. The primary interviewer was very kind, but his "bad cop" counterpart was unafraid to point out my inadequacies (even stating in the middle of the interview that I'm not getting hired), which of course didn't help my anxious brain to function (not that if he _hadn't_ said those things, it would've made a noteworthy difference to my poor performance). Their HR rep claimed in her post-interview follow-up email that the primary interviewer wanted to add me on LinkedIn, but he never accepted my LinkedIn request. Ha.

## Requirements
> The next step in the hiring process it to build your own implementation of a To-do (Task list) full stack web application following these guidelines:
>
> ...
> 
> Build the implementation in 1 week while meeting at least the minimum functionality requirements:
> 
> - View a list of to-do items with the ability to filter the list by pending, complete, and all to-dos
> - Create a new to-do item
> - Edit a to-do item
> - Delete a to-do item
> - Complete a to-do item

## Setup

1. Run `git clone https://github.com/wad11656/kadince_todo.git` where you want the project directory to be stored.
2. Edit `create_table.sql` and replace `mydatabase`(x2), `mydbuser`, `myserver`, and `mypass` with your respective database credentials.
3. Execute the commands in `create_table.sql` on your server, either in a MySQL front-end or the `mysql` console.
4. **(Unix only)** From your site root directory, run `sudo mkdir ../env` and assign the new directory privileges to allow one of this site's `php` pages to write a file to it.
    - If using Nginx+PHP-FPM, this means running `chown www-data:www-data ../env`.
5. **(Unix only)** Run `sudo mkdir /usr/local/keyfile` and assign the new directory privileges to allow one of this site's `php` pages to write to it.
    - If using Nginx+PHP-FPM, this means running `chown www-data:www-data /usr/local/keyfile`.
6. Edit `create_env.php` and replace `myserver`, `mydbuser`, `mypass`, and `mydatabase` with your respective database credentials.
7. Execute `create_env.php` on your server.
    - If permissions are configured to allow it, this should generate a `.env` in the `env` directory above your site root, and a `keyfile` at either `C:\keyfile` or `/usr/local/keyfile/keyfile`.
8. Load `index.php` and test all is working.
9. Delete your plaintext credentials from `create_env.php` and `create_table.sql`.

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

##### Run `.sql` script from bash:
[https://stackoverflow.com/questions/7616520/how-to-execute-a-sql-script-from-bash]()

##### Run `.sql` script from `mysql>`:
[https://stackoverflow.com/a/8940431/3511695]()
</details>

<details><summary>Versioning</summary>

##### Using GitHub CLI tool:
[https://www.youtube.com/watch?v=tm9gdHd9qmE]()

##### Github `master` branch has now officially switched to `main`:
[https://stackoverflow.com/a/67139639/3511695]()

##### Git Branching & Merging:
[https://git-scm.com/book/en/v2/Git-Branching-Basic-Branching-and-Merging]()
</details>
