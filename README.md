# Simple PHP template filler

## usage example

```php
$template = "<article><h2><!-- title --></h2>" .
    "<p><!-- body --></p></article>";
$tpl = new \Mc\Template($template, \Mc\Template::CM);
echo $tpl->Fill([
    "title" => "Article title",
    "body" => "Article body",
])->Value();
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
namespace Mc;

/**
 * simple template filler
 *
 * @author Croitor Mihail <mcroitor@gmail.com>
 */
class Template
{
    public const PREFIX = "PREFIX";
    public const SUFFIX = "SUFFIX";

    public const COMMENT_MODIFIERS = [
        self::PREFIX => "<!-- ",
        self::SUFFIX => " -->",
    ];
    public const BRACKET_MODIFIERS = [
        self::PREFIX => "{{",
        self::SUFFIX => "}}",
    ];

    public const CM = self::COMMENT_MODIFIERS;
    public const BR = self::BRACKET_MODIFIERS;

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
     * @return \Mc\Template
     */
    public static function Load(string $file, array $modifiers = []): Template;

    /**
     * set filler prefix
     * @param string $prefix
     */
    public function SetPrefix(string $prefix): void;

    /**
     * set filler suffix
     * @param string $suffix
     */
    public function SetSuffix(string $suffix): void;

    /**
     * $data is a simple list of pairs <i>$pattern</i> => <i>$value</i>
     * Method replace <i>$pattern</i> with <i>$value</i>
     * and return new template object
     * Example:
     * <pre>$template->Fill($data1)->Fill(data2)->Value();</pre>
     * @param array $data
     * @return \Mc\Template
     */
    public function Fill(array $data): Template;
    /**
     * Replace single $pattern with $value
     * @param string $pattern
     * @param string $value
     * @return \Mc\Template
     */
    public function FillValue(string $pattern, string $value): Template;

    /**
     * returns template value
     * @return string
     */
    public function Value(): string;
}
```
