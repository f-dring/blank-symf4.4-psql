**Versions**:
- Symfony version: 4.4.8
- Postgres version: 12.3

**Getting started**:
1. edit .env config file and update your database details
2. run composer install
3. run $ bin/console doctrine:schema:udpate (--force)
4. create user $ bin/console fos:user:create testuser test@example.com p@ssword (further details see https://symfony.com/doc/current/bundles/FOSUserBundle/command_line_tools.html)
