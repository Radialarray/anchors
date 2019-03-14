<?php

namespace craft\anchors;

use craft\helpers\Template;

/**
 * Anchors Twig Extension
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 2.0
 */
class TwigExtension extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName(): string
    {
        return 'anchors';
    }

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters(): array
    {
        return [
            new \Twig_Filter('anchors', [$this, 'anchorsFilter']),
            new \Twig_Filter('anchorsLinks', [$this, 'anchorsArray']),        ];
    }

    /**
     * Parses a string to automatically add anchors to all H1-H3’s
     *
     * @param string $html The HTML to parse.
     * @param mixed $tags The HTML tags to check for.
     * @param string|null The content language, used when converting non-ASCII characters to ASCII
     * @return \Twig_Markup The parsed string.
     */
    public function anchorsFilter($html, $tags = 'h1,h2,h3', string $language = null): \Twig_Markup
    {
        $html = Plugin::getInstance()->getParser()->parseHtml($html, $tags, $language);
        return Template::raw($html);
    }

    /**
     * Parses a string and returns an array with the links for creating an anchor-navigation-menu
     *
     * @param string $html The HTML to parse.
     * @param mixed $tags The HTML tags to check for.
     * @param string|null The content language, used when converting non-ASCII characters to ASCII
     * @return array The array with the found tags
     */
    public function anchorsArray($html, $tags = 'h1,h2,h3', string $language = null)
    {
        $html = Plugin::getInstance()->getParser()->returnArray($html, $tags);
        return $html;
    }
}
