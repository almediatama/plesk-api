<?php
namespace almediatama\Plesk;

class ListClients extends BaseRequest
{
    /**
     * @var string
     */
    public $xml_packet = <<<EOT
<?xml version="1.0"?>

<packet version="1.6.7.0">
<customer>
   <get>
      <filter/>

      <dataset>
          <gen_info/>
          <stat/>
      </dataset>
   </get>
</customer>
</packet>

EOT;

    /**
     * @param $xml
     * @return array
     */
    protected function processResponse($xml)
    {
        $result = [];

        for ($i = 0; $i < count($xml->customer->get->result); $i++) {
            $customer = $xml->customer->get->result[$i];

            $result[] = [
                'id' => (string)$customer->id,
                'status' => (string)$customer->status,
                'created' => (string)$customer->data->gen_info->cr_date,
                'name' => (string)$customer->data->gen_info->cname,
                'contact_name' => (string)$customer->data->gen_info->pname,
                'username' => (string)$customer->data->gen_info->login,
                'phone' => (string)$customer->data->gen_info->phone,
                'email' => (string)$customer->data->gen_info->email,
                'address' => (string)$customer->data->gen_info->address,
                'city' => (string)$customer->data->gen_info->city,
                'state' => (string)$customer->data->gen_info->state,
                'post_code' => (string)$customer->data->gen_info->pcode,
                'country' => (string)$customer->data->gen_info->country,
                'locale' => (string)$customer->data->gen_info->locale,
				'password' => (string)$customer->data->gen_info->password,
                'stat' => [
                    'domains' => (int)$customer->data->stat->active_domains,
                    'subdomains' => (int)$customer->data->stat->subdomains,
                    'disk_space' => (int)$customer->data->stat->disk_space,
                    'web_users' => (int)$customer->data->stat->web_users,
                    'databases' => (int)$customer->data->stat->data_bases,
                    'traffic' => (int)$customer->data->stat->traffic,
                    'traffic_prevday' => (int)$customer->data->stat->traffic_prevday,
                ],
            ];
        }

        return $result;
    }
}

