
## About This Project 

This is a backend system created with **Laravel**/**Oracle** to manage a libraries systems


- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Stack needed for the project 

To run this project you need : 
- Oracle 21c xe.
- Composer .
- install the yajra/laravel-oci8 package.

**Setting up the Database**
You need to create a specific roles and sysnonyms before you  run this project 
-**ROLE** `CREATE ROLE shared_schema;`.
-**privileges** `GRANT SELECT , INSERT ,UPDATE,DELETE ON YOUR_MAIN_SCHEMA.personal_access_tokens to shared_schema;`
`GRANT SELECT ON YOUR_MAIN_SCHEMA.PERMISSIONS to shared_schema;`.
-**SYNONYMS** `create public synonym PERSONAL_ACCESS_TOKENS for YOUR_MAIN_SCHEMA.PERSONAL_ACCESS_TOKENS;`
 `create public synonym users for YOUR_MAIN_SCHEMA.users;`
 `create public synonym sessions for YOUR_MAIN_SCHEMA.sessions;`
 `create public synonym PERMISSIONS for YOUR_MAIN_SCHEMA.PERMISSIONS;`
 `create public synonym etudiants for YOUR_MAIN_SCHEMA.etudiants;`.
 ` create public synonym personnels for YOUR_MAIN_SCHEMA.personnels;`
 ` create public synonym livres for YOUR_MAIN_SCHEMA.livres;`
 ` create public synonym emprunts for YOUR_MAIN_SCHEMA.emprunts;`
  `create public synonym retards for YOUR_MAIN_SCHEMA.retards;`
 ` create public synonym detail_emprunts for YOUR_MAIN_SCHEMA.detail_emprunts;`
**Setting up the Laravel Project**
- put your dbhost and password in the .env file
- run `php artisan migrate`
- run `php artisan serve`
