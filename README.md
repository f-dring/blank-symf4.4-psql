Getting started:
- edit .env config file and update your database details
- run composer install
- run $ bin/console doctrine:schema:udpate (--force)
- create user $ bin/console fos:user:create testuser test@example.com p@ssword (further details see https://symfony.com/doc/current/bundles/FOSUserBundle/command_line_tools.html)
