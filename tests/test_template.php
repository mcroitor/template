<?php

use Mc\Template;

class test_template
{

    public static function test01()
    {
        info("test 1");

        $template = "<article><h2><!-- title --></h2>" .
            "<p><!-- body --></p></article>";

        $expected_result = "<article><h2>Article title</h2>" .
            "<p>Article body</p></article>";

        info("template : ", $template);

        $tpl = new Template($template);
        $result = $tpl->Fill([
            "<!-- title -->" => "Article title",
            "<!-- body -->" => "Article body",
        ])->Value();

        info("result : ", $result);
        test($expected_result === $result);
    }

    public static function test02()
    {
        info("test 2");

        $template = "<article><h2><!-- title --></h2>" .
            "<p><!-- body --></p></article>";

        $expected_result = "<article><h2>Article title</h2>" .
            "<p>Article body</p></article>";

        info("template : ", $template);

        $tpl = new Template($template, ["PREFIX" => "<!-- ", "SUFFIX" => " -->"]);
        $result = $tpl->Fill([
            "title" => "Article title",
            "body" => "Article body",
        ])->Value();

        info("result : ", $result);
        test($expected_result === $result);
    }
}

test_template::test01();
test_template::test02();