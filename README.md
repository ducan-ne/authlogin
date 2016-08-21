# FB GET Access Token
GET access_token app facebook with email &amp; password via restapi: https://api.facebook.com/restserver.php. Make easy form login with account Facebook

## Usage
```php
$authlogin = new authlogin([
'locale' => 'vi_VN',
'email' => '<Email FB>',
'password' => '<Password>'
]);
$authlogin->_exec();
print_r($authlogin->_getObject());
```

## Requirements
PHP >= 5.0

## License
MIT
