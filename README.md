# wnk_changedata
Change Data Capture for CakePHP 3

It provides capture of datachanges from public users


## Installation
``` shell
composer require ava007/wnk_changedata
```

### Config/bootstrap.php
```
Plugin::load('WnkChangedata', ['routes' => true, 'autoload' => true, 'bootstrap' => false]);

Configure::write('WnkChangedata', [
    'tablePrefix' => '',     // optional prefix for database tables
]);
```
### src/Application.php
```
class Application extends BaseApplication {

  public function bootstrap() {
    parent::bootstrap();
    $this->addPlugin('WnkChangedata');
  }
}
```
### Database

run one of the appropriate sql-ddl-script:
- postgresql:   ddl-postgresql.sql
- mysql:        ddl-mysql.sql



## References

visit https://www.logikfabrik.com/comparison/show/trend-indica?edit=1
