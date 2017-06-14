<?php

namespace AppBundle\Utils\Library;

use DateTime;

/**
 * @author Dmitry Shumytskyi <d.shumytskyi@gmail.com>
 */
class RequestBuilder
{
    public function buildUriParams($schema, $parameters)
    {
        if ($schema['object_uri'] !== false) {

            $uri = [];

            foreach ($schema['object_uri'] as $apiValue => $rapidApiValue) {
                if (isset($parameters[$rapidApiValue]) && $parameters[$rapidApiValue] != '') {

                    $uri[$apiValue] = $parameters[$rapidApiValue];
                }
            }

            $patterns = array_keys($uri);

            $replacements = array_values($uri);

            return str_replace($patterns, $replacements, $schema['uri']);
        } else {

            return $schema['uri'];
        }
    }

    public function buildArgsParams($schema, $parameters)
    {
        if ($schema['args'] !== false) {

            $query = [];

            foreach ($schema['args'] as $apiValue => $rapidApiValue) {

                if (isset($parameters[$rapidApiValue['marketName']]) && $parameters[$rapidApiValue['marketName']] != '') {

                    $query[$apiValue] = call_user_func_array(array($this, $rapidApiValue['type']), [$parameters[$rapidApiValue['marketName']], $rapidApiValue]);
                }
            }

            if ($schema['content_body_json'] !== false) {

                return json_encode($query);
            } else {

                return http_build_query($query, '', '&');
            }
        } else {

            return '';
        }
    }

    public function buildHeaders($schema, $parameters)
    {
        if ($schema['object_headers'] !== false) {

            $headers = [];

            $objects = [];

            foreach ($schema['object_headers'] as $apiValue => $rapidApiValue) {
                if (isset($parameters[$rapidApiValue]) && $parameters[$rapidApiValue] != '') {

                    $objects[$apiValue] = $parameters[$rapidApiValue];
                }
            }

            $patterns = array_keys($objects);

            $replacements = array_values($objects);

            foreach ($schema['headers'] as $name => $value) {

                $headers[$name] = str_replace($patterns, $replacements, $value);
            }

            return $headers;
        } else {

            return $schema['headers'];
        }
    }

    /**
     * Normalize json arrays, objects, array of objects, nested objects with array and objects from rtp to valid array
     *
     * @param $json
     * @return mixed
     */
    public function normalizeJson($json)
    {
        return preg_replace_callback('~"([\[{].*?[}\]])"~s', function ($match) {

            return preg_replace('~\s*"\s*~', "\"", $match[1]);
        }, $json);
    }

    /**
     * name:Sam,surname:tomi => ['name' => 'Sam', 'surname' => 'tomi']
     *
     * @param $str
     * @return array
     */
    public function explodeStringToArray($str)
    {
        $values = explode(';', $str);
        $result = [];

        foreach ($values as $value) {
            $temp = explode(',', $value);
            foreach ($temp as $key => $name) {
                list($k, $v) = explode(':', $name);
                $result[$k] = $v;
            }
        }

        return $result;
    }

    /**
     * ['Sam','tomi'] => Sam, tomi
     *
     * @param $arr
     * @return string
     */
    public function convertArrayToList($arr)
    {

        return rtrim(implode(',', $arr), ',');
    }

    public function datePicker($value, $conf)
    {
        if (is_numeric($value)) {

            return $value;
        } else {

            $date = new DateTime($value);

            return $date->getTimestamp();
        }

    }

    public function map($value, $conf)
    {

        return $value;
    }

    public function string($value, $conf)
    {

        return $value;
    }


}