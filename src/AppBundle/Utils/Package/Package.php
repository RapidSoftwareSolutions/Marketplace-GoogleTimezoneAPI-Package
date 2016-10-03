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
        $this->result = $this->sendRequest($schema, $this->prepareRequest($schema));

        $this->pagination($schema);

        $this->setResponse($schema);
    }

    /**
     * @param $schema
     */
    public function getLocalTime($schema)
    {
        $googleTimeZone = json_decode($this->sendRequest($schema, $this->prepareRequest($schema)), true);

        $this->result = $this->parameters['timestamp'] + $googleTimeZone['dstOffset'] + $googleTimeZone['rawOffset'];

        $this->pagination($schema);

        $this->setResponse($schema);
    }

}