# Simple PHP template filler

## usage example

```php
$template = "<article><h2><!-- title --></h2>" .
    "<p><!-- body --></p></article>";
$tpl = new \mc\template($template, \mc\template::comment_modifiers);
echo $tpl->fill([
    "title" => "Article title",
    "body" => "Article body",
])->value();
```

## testing

```shell
php tests/runner.php
```

## project usage

You can use my simple [module manager](https://github.com/mcroitor/module_manager),
just include in `modules.json`:

```json
[{
    "user" : "mcroitor",
    "repository" : "template",
    "branch" : "master",
    "source" : "./src"
}]
```

and install it.

## interface

```php
namespace mc;

class template
{
    public const prefix = "prefix";
    public const suffix = "suffix";

    public const comment_modifiers = [self::prefix => "<!-- ", self::suffix => " -->"];
    public const bracket_modifiers = [self::prefix => "{{", self::suffix => "}}"];
    
    /**
     *
     * @param string $template
     * @param array $modifiers
     */
    public function __construct(string $template, array $modifiers = []);

    /**
     * Create new template object from file
     * @param string $file
     * @param array $modifiers
     * @return template
     */
    public static function load(string $file, array $modifiers = []): template

    /**
     * set filler prefix
     * @param string $prefix
     */
    public function set_prefix(string $prefix);

    /**
     * set filler suffix
     * @param string $suffix
     */
    public function set_suffix(string $suffix);

    /**
     * $data is a simple list of pairs <i>$pattern</i> => <i>$value</i>
     * Method replace <i>$pattern</i> with <i>$value</i>
     * and return new template object
     * Example:
     * <pre>$template->fill($data1)->fill(data2)->value();</pre>
     * @param array $data
     * @return \template
     */
    public function fill(array $data): template;

    /**
     * Replace single $pattern with $value
     * @param string $pattern
     * @param string $value
     * @return \template
     */
    public function fill_value(string $pattern, string $value): template;

    /**
     * returns template value
     * @return string
     */
    public function value(): string;
}

```
