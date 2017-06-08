<?php

namespace watel\Filter;

/**
 * Test cases for class Filter.
 */
class FilterTest extends \PHPUnit_Framework_TestCase
{
    public function testMakeClickable()
    {
        $filter = new Filter();
        $testLink = $filter->makeClickable("https://www.google.se");
        $testLinkResult = "<a href='https://www.google.se'>https://www.google.se</a>";
        $this->assertEquals($testLink, $testLinkResult);

        $this->assertEquals($filter->makeClickable("www.google.se"), "www.google.se");
    }


    public function testbbcode2html()
    {
        $filter = new Filter();
        $testText = $filter->bbcode2html("[b]Bold text[/b]");
        $testTextResult = "<strong>Bold text</strong>";
        $this->assertEquals($testTextResult, $testText);

        $this->assertEquals("<em>Italic text</em>", $filter->bbcode2html("[i]Italic text[/i]"));
    }

    public function testdoFilter()
    {
        $filter = new Filter();
        $this->assertEquals("hello", $filter->doFilter("hello"));

        $testText = $filter->doFilter("[i]Italic text[/i]", "bbcode");
        $this->assertEquals("<em>Italic text</em>", $testText);

        $testText = $filter->doFilter("[i]Italic text[/i]", "bbcode,markdown");
        $this->assertEquals("<p><em>Italic text</em></p>\n", $testText);

        $testText = $filter->doFilter("[i]Italic text[/i] https://www.google.se", "bbcode,nl2br,link");
        $this->assertEquals("<em>Italic text</em> <a href='https://www.google.se'>https://www.google.se</a>", $testText);
    }
}
