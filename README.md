# PHP SESSION
---
PHP library for handling sessions


###Install
See in packagist
````
https://packagist.org/packages/fatkulnurk/session
````
with composer
```
composer require Josantonius/Session
```

###Under Development
- [ ] Get session with nested key
- [ ] Set session with Nested Value

###Usage

**Start session:**
```
Session::init();
```

**Start session by setting the session duration:**

Param in seconds.
```
Session::init(3600);
```

**Add value to a session:**
```
Session::set('name', 'Fatkul Nur Koirudin');
```

**Add multiple value to sessions:**

Unsupport for nested array.
```
$data = [
    'name'     => 'Rudi',
    'gender'   => 'Male',
];

Session::set($data);
```

**Extract session item, delete session item and finally return the item:**
```
Session::pull('name');
```

**Return the session array / Return all session value:**
```
Session::get();
```

**Get session id:**
```
Session::id();
```

**Destroys one key session:**
```
Session::destroy('name');
```

**Destroys all sessions:**
```
Session::destroy();
```