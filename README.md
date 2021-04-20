# PHP-Config

A helper package used by other Secure Trading packages.

## Release History

| Version  | Changes                        |
| -------- |---------------                 |
| 3.0.0    | PHP 8  compatibility. |
| 2.0.0    | PHP 7.3 and 7.4 compatibility. |
| 1.0.0    | Initial Release                |

## PHP Version Compatibility

| Version  | Changes                        |
| -------- |---------------                 |
| 3.0.0    | PHP 8.0.0 - PHP 8.0.3          |
| 2.0.0    | PHP 7.3 - PHP 7.4              |
| 1.0.0    | PHP 5.3 - PHP 7.2              |

## Usage

`\Securetrading\Config\Config` accepts a multi-dimensional array in its constructor.

Calls to the instance methods `has()`, `get()` and `set()` can then be used to easily manipulate entries in the multi-dimensional array.

Example:

    $config = new \Securetrading\Config\Config([
        'outer' => ['inner' => 'value']
    ]);

    $config->has('outer'); // true
    $config->has('outer/inner'); // true
    $config->get('outer/inner'); // 'value'
    $config->set('outer/inner', 'new_value');
    $config->get('outer/inner'); // 'new_value'
