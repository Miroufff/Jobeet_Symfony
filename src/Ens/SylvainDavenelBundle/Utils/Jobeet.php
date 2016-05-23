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
        // replace non letter or digits by -
        $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

        // trim
        $text = trim($text, '-');

        // lowercase
        $text = strtolower($text);

        // transliterate
        $text = strtr(utf8_decode($text), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');

        // remove unwanted characters
        $text = preg_replace('#[^-\w]+#', '', $text);

        if (empty($text))
        {
            return 'n-a';
        }

        return $text;
    }
}
