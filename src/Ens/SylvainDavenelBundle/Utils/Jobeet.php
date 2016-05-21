<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 20/05/16
 * Time: 14:09
 */

namespace Ens\SylvainDavenelBundle\Utils;

/**
 * Class Jobeet
 *
 * @package Ens\SylvainDavenelBundle\Utils
 */
class Jobeet
{
    static public function slugify($text)
    {
        if (empty($text))
        {
            return 'n-a';
        }
        
        // replace all non letters or digits by -
        $text = preg_replace('/\W+/', '-', $text);

        // trim and lowercase
        $text = strtolower(trim($text, '-'));

        return $text;
    }
}
