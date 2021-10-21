<?php
/**
 * Json'd plugin for Craft CMS 3.x
 *
 * Adds Twig filters for working with json.
 *
 * @link      https://github.com/chattervast
 * @copyright Copyright (c) 2018 Chattervast
 */

namespace chattervast\jsond\twigextensions;

use chattervast\jsond\Jsond;

use Craft;

/**
 * @author    Chattervast
 * @package   Jsond
 * @since     1
 */
class JsondTwigExtension extends \Twig_Extension
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'Jsond';
    }

    /**
     * @inheritdoc
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('json_decoded', [$this, 'jsondecoded']),
            new \Twig_SimpleFilter('json_last_error_msg', [$this, 'jsonErrorMessage']),
            new \Twig_SimpleFilter('json_last_error', [$this, 'jsonError']),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('json_decoded', [$this, 'jsondecoded']),
            new \Twig_SimpleFunction('json_last_error_msg', [$this, 'jsonErrorMessage']),
            new \Twig_SimpleFunction('json_last_error', [$this, 'jsonError']),
        ];
    }

    /**
     * @param null $text
     *
     * @return string
     */
    public function jsondecoded($json, $type = false, $depth = 512, $options = null)
    {
	    if ($options != null)
	    {
		    $decoded = json_decode($json, $type, $depth, $options);
	    }
	    else {
		    $decoded = json_decode($json, $type, $depth);
	    }

        return $decoded;
    }
    
    public function jsonErrorMessage($json, $type = 'decode')
    {
        $error = '';
	    
	    if ($type == 'encode')
	    {
		    json_encode($json);
		    $error = json_last_error_msg();
	    }
	    else
	    {
		    json_decode($json);
		    $error = json_last_error_msg();
	    }

        return $error;
    }
    
    public function jsonError($json, $type = 'decode')
    {
	    $error = '';
	    
	    if ($type == 'encode')
	    {
		    json_encode($json);
		    $error = json_last_error();
	    }
	    else
	    {
		    json_decode($json);
		    $error = json_last_error();
	    }

        return $error;
    }
}
