<?php
namespace stratease;
class HypermailService
{
    protected $apiKey;

    function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function addEmailToList($email, $listId)
    {

        return $this->request(['area' => 'email', 'action' => 'addemail', 'id' => $listId, 'email' => $email]);
    }

    protected function request(array $params)
    {
        $params['apikey'] = $this->apiKey;
        $q = http_build_query($params);

        return file_get_contents('http://hypermaillogin.com/api.php?' . $q);
    }
}