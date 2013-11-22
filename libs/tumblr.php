<?php

class tumblr extends Model {
    public $_client;
    public function __construct() {
        require 'libs/Tumblr/API/Client.php';
        require 'libs/Tumblr/API/RequestException.php';
        require 'libs/Tumblr/API/RequestHandler.php';
        require 'libs/Tumblr/API/vendor/autoload.php';
        $this->_client = new Tumblr\API\Client(
                'roXBebjpMkq4fcwCDA127gnjkVd6z3CrJgCUV0iKXvsGseYt6E', 'MkQQNHlvuey190kxypATiChHksN05xCZmrdFXQxLqOMw9A0BXY', 'mNykqpz6K3E1Iks16urKpdHP3iw1tubN96BDpwWPQQSufxyOru', 'gy2q0k06Vmut19yccnHjMDPrQFA7d0vxg9fyaWOL4lCNEki3gJ'
        );
       
        return $this->_client;
    }
    public function getClient(){
        return $this->_client;
    }
}
