<?php
namespace almediatama\Plesk;

class DeleteSubdomain extends BaseRequest
{
    /**
     * @var string
     */
    public $xml_packet = <<<EOT
<?xml version="1.0"?>
<packet version="1.5.2.0">
    <subdomain>
        <del>
            <filter>
                {FILTER}
            </filter>
        </del>
    </subdomain>
</packet>
EOT;

    /**
     * @var array
     */
    protected $default_params = [
        'filter' => null,
    ];

    /**
     * @param array $config
     * @param array $params
     * @throws ApiRequestException
     */
    public function __construct($config, $params = [])
    {
        if (isset($params['subdomain'])) {
            $params['filter'] = new Node('name', $params['subdomain']);
        }

        if (isset($params['id'])) {
            $params['filter'] = new Node('id', $params['id']);
        }

        parent::__construct($config, $params);
    }

    /**
     * @param $xml
     * @return bool
     * @throws ApiRequestException
     */
    protected function processResponse($xml)
    {
        $result = $xml->subdomain->del->result;

        if ($result->status == 'error') {
            throw new ApiRequestException($result);
        }

        return true;
    }
}
