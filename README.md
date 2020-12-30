# Global access for request parameters

## Intro
This class will help you to fetch data from $_POST and $_GET arrays.

## Installation

Just print in console

```
composer require mezon/request
```

And that's all )

# Learn more

More information can be found here:

[Twitter](https://twitter.com/mezonphp)

[dev.to](https://dev.to/alexdodonov)

[Slack](https://join.slack.com/t/mezon-framework/signup?x=x-p1148081653955-1171709616688-1154057706548)

# How to start

The firs steps are quite simple

```php
var_dump(Request::getParam('some-param', 'default'));// will be outputted 'default'

$_GET['some-param'] = 'some-value';
var_dump(Request::getParam('some-param'));// will be outputted 'some-value'
```

# Fields priorities

In case you have the same parameters in $_GET, $_POST and other global arrays, then they will be prioritized in this way:

- security tokens in HTTP headers
- [Router parameters](https://github.com/alexdodonov/mezon-router)
- HTTP request headers
- $_POST
- $_GET

For example:

```php
$_GET['some-param'] = 'get-value';
$_POST['some-param'] = 'post-value';

var_dump(Request::getParam('some-param'));// will be outputted 'post value'
```

# Router parameters

You can pass your [Router](https://github.com/alexdodonov/mezon-router) object to this class and fetch parameters for non-static routes:

```php
Request::registerRouter(<your Mezon\Router object>);
```

# Security tokens in HTTP headers

There are a way to fetch security token from headers:

- Authentication
- Authorization
- Cgi-Authorization

For example if you will pass in headers something like that:

```
Authorization: Basic <some token>
```

And then call:

```php
Request::getParam('session_id')
```

Then this call will return <some token>.

# Wrappers

There are some convenient wrappers were implemented:

```php
// will return true if the parameter exists
// will return false otherwise
Request::wasSubmitted('param-name')
```

Or wrapper for check-boxes:

```php
Request::getChecked('param-name', ['switched on', 'switched off'])
Request::getChecked('param-name', [1, 0])
Request::getChecked('param-name', [true, false])
```

In this call the method `getChecked` will return the first element of the array which is passed as the second parameter. And the second element otherwise.