<?php
namespace stratease;
class HypermailService
{
    protected $apiKey;

    /**
     * HypermailService constructor.
     * @param $apiKey
     */
    function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param $email
     * @param $listId
     * @return mixed
     */
    public function addEmailToList($email, $listId)
    {

        return $this->request(['area' => 'email', 'action' => 'addemail', 'id' => $listId, 'email' => $email]);
    }

    /**
     * @param array $params
     * @return mixed
     */
    protected function request(array $params)
    {
        $params['apikey'] = $this->apiKey;
        $q = http_build_query($params);

        return file_get_contents('http://hypermaillogin.com/api.php?' . $q);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function unsubscribe($email)
    {
        //http://hypermaillogin.com/api.php?apikey=YOURAPIKEYHERE&area=email&action=unsubscribeemail&email=example@test.com
        return $this->request(['action' => 'unsubscribeemail','area'=>'email','email' => $email]);
    }

    /**
     * @param $start
     * @param $limit
     * @return mixed
     */
    public function getUnsubscribeList($start, $limit) {
        return simplexml_load_string($this->request(['action' => 'getunsubscribelist','area'=>'email','start' => $start, 'limit' => $limit]));
    }
}