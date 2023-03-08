Symfony webapp test environment
========================


Requirements
------------

  * PHP 8.1.0 or higher;
  * PDO-SQLite PHP extension enabled;
  * and the [usual Symfony application requirements][2].



Usage
-----

There's no need to configure anything before running the application. There are
2 different ways of running this application depending on your needs:

**Option 1.** [Download Symfony CLI][4] and run this command:

```bash
$ cd my_project/
$ symfony serve
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

**Option 2.** Use a web server like Nginx or Apache to run the application
(read the documentation about [configuring a web server for Symfony][3]).

On your local machine, you can run this command to use the built-in PHP web server:

```bash
$ cd my_project/
$ php -S localhost:8000 -t public/
```


[1]: https://symfony.com/doc/current/best_practices.html
[2]: https://symfony.com/doc/current/setup.html#technical-requirements
[3]: https://symfony.com/doc/current/setup/web_server_configuration.html
[4]: https://symfony.com/download
[5]: https://symfony.com/book
[6]: https://getcomposer.org/
