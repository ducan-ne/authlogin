# FB GET Access Token
GET access_token app facebook with email &amp; password via restapi: https://api.facebook.com/restserver.php. Make easy form login with account Facebook. First login will check point, go settings -> turn off [Login Approvals], [Login Alerts] and login again :)

## Usage
```php
$authlogin = new authlogin([
'locale' => 'vi_VN',
'email' => '<Email FB>',
'password' => '<Password>'
// 'format' => 'xml'
]);
$authlogin->_exec();
print_r($authlogin->_getObject()); // output is stdclass object
print_r($authlogin->_getArray()); // output is array
```

## Requirements
PHP >= 5.0

## License
MIT
