# PHP-Config

A helper package used by other Secure Trading packages.

\Securetrading\Config\Config accepts a multi-dimensional array in its constructor.

Calls to the instance methods 'has', 'get' and 'set' can then be used to easily manipulate entries in the multidimensional array.

Example:

    $config = new \Securetrading\Config\Config([
        'outer' => ['inner' => 'value']
    ]);

    $config->has('outer'); // true
    $config->has('outer/inner'); // true
    $config->get('outer/inner'); // 'value'
    $config->set('outer/inner', 'new_value');
    $config->get('outer/inner'); // 'new_value'
