<?php

namespace watel\Filter;

class Filter
{


    private $filters = [
        "nl2br" => "nl2br",
        "bbcode" => "bbcode",
        "link" => "link",
        "markdown" => "markdown"
    ];
    /**
    * Helper, BBCode formatting converting to HTML.
    *
    * @param string text The text to be converted.
    * @returns string the formatted text.
    */
    public function bbcode2html($text)
    {
        $search = array(
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
            );
            $replace = array(
                '<strong>$1</strong>',
                '<em>$1</em>',
                '<u>$1</u>',
                '<img src="$1" />',
                '<a href="$1">$1</a>',
                '<a href="$1">$2</a>'
            );
            return preg_replace($search, $replace, $text);
    }

    public function makeClickable($text)
    {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            create_function(
                '$matches',
                'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
            ),
            $text
        );
    }

    /**
    * Helper, Markdown formatting converting to HTML.
    *
    * @param string text The text to be converted.
    *
    * @return string the formatted text.
    */
    public static function markdown($text)
    {
        return \Michelf\Markdown::defaultTransform($text);
    }

    // Take filter string
    //each separate filter must be extingished by a ,(comma)
    private function validateFilters($filterOption = null)
    {
        if ($filterOption == null) {
            return;
        }

        $chosenFilter = explode(",", $filterOption);
        $validFilters = [];
        for ($i=0; $i < count($chosenFilter); $i++) {
            foreach ($this->filters as $key) {
                if ($key == $chosenFilter[$i]) {
                    array_push($validFilters, $key);
                }
            }
        }

        return $validFilters;
    }

    public function doFilter($text, $filters = null)
    {
        if ($filters == null) {
            return $text;
        }

        $validatedFilters = $this->validateFilters($filters);

        for ($i=0; $i < count($validatedFilters); $i++) {
            if ($validatedFilters[$i] == "link") {
                $text = $this->makeClickable($text);
            }

            if ($validatedFilters[$i] == "bbcode") {
                $text = $this->bbcode2html($text);
            }


            if ($validatedFilters[$i] == "markdown") {
                $text = $this->markdown($text);
            }

            if ($validatedFilters[$i] == "nl2br") {
                $text = nl2br($text);
            }
        }
        // var_dump($validatedFilters);
        return $text;
    }
}
