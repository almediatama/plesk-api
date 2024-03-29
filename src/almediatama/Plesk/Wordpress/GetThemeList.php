<?php
namespace almediatama\Plesk\Wordpress;

use almediatama\Plesk\ApiRequestException;
use almediatama\Plesk\BaseRequest;
use SimpleXMLElement;

class GetThemeList extends BaseRequest
{
    public $xml_packet = <<<EOT
<?xml version="1.0"?>
<packet>
    <wp-instance>
         <get-theme-list>
            <filter>
                  <id>{ID}</id>
             </filter>
         </get-theme-list>
     </wp-instance>
</packet>
EOT;

    /**
     * @param SimpleXMLElement $xml
     * @return array
     * @throws ApiRequestException
     */
    protected function processResponse($xml)
    {
        if ((string) $xml->{'wp-instance'}->{'get-theme-list'}->result->status == "error") {
            throw new ApiRequestException($xml->{'wp-instance'}->{'get-theme-list'}->result);
        }

        $response = [];

        foreach ($xml->{'wp-instance'}->{'get-theme-list'}->result->item as $result) {
            $response[] = [
                'title' => (string) $result->title,
                'id' => (string) $result->id,
            ];
        }

        return $response;
    }
}
