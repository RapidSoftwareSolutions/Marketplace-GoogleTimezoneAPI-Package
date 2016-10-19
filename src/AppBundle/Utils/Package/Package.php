<?php
/**
 * @author Dmitry Shumytskyi <d.shumytskyi@gmail.com>
 */

namespace AppBundle\Utils\Package;

use AppBundle\Utils\Package\Abstracts\BlockAbstract;

class Package extends BlockAbstract
{
    /**
     * @param $schema
     */
    public function getTimeZone($schema)
    {
        $this->result = json_decode($this->sendRequest($schema, $this->prepareRequest($schema)), true);

        $this->pagination($schema);

        $this->setResponse($schema);
    }

    /**
     * @param $schema
     */
    public function getLocalTime($schema)
    {
        $googleTimeZone = json_decode($this->sendRequest($schema, $this->prepareRequest($schema)), true);

        if(!(isset($googleTimeZone['dstOffset']) && isset($googleTimeZone['rawOffset']))){
            $this->result = $googleTimeZone;
        }else{
            $this->result = ['status' => 'OK', 'timestamp' => $this->parameters['timestamp'] + $googleTimeZone['dstOffset'] + $googleTimeZone['rawOffset']];
        }

        $this->pagination($schema);

        $this->setResponse($schema);
    }

}