<?php
namespace almediatama\Plesk\Wordpress;

use almediatama\Plesk\ApiRequestException;
use almediatama\Plesk\BaseRequest;
use SimpleXMLElement;

class RemoveInstance extends BaseRequest
{
    public $xml_packet = <<<EOT
<?xml version="1.0"?>
<packet>
    <wp-instance>
         <remove>
             <filter>
                  <id>{ID}</id>
             </filter>
         </remove>
     </wp-instance>
</packet>
EOT;

    /**
     * @var array
     */
    protected $default_params = [
        'id' => null,
    ];

    /**
     * @param SimpleXMLElement $xml
     * @return bool
     * @throws ApiRequestException
     */
    protected function processResponse($xml)
    {
        if ((string) $xml->{'wp-instance'}->{'remove'}->result->status === 'error') {
            throw new ApiRequestException($xml->{'wp-instance'}->{'remove'}->result);
        }

        return true;
    }
}
