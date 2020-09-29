<?php


class Facebook {
    public function getUserToken($userId) {
        echo "Facebook :: getUserToken"."<br>";
    }

    public function postUpdate($message) {
        echo "Facebook :: postUpdate"."<br>";
    }
}



interface iStatusUpdate {
    function getUserToken($userId);
    function postUpdate($message);
}

class Twitter {
    public function checkUserToken($userId) {
        echo "Twitter :: checkUserToken"."<br>";
    }

    public function setStatusUpdate($message) {
        echo "Twitter :: setStatusUpdate"."<br>";
    }
}

class TwitterAdapter implements iStatusUpdate {

    protected $twitter;

    public function __construct(Twitter $twitter){
        $this->twitter = $twitter;
    }

    public function getUserToken($userId) {
        $this->twitter->checkUserToken($userId);
    }

    public function postUpdate($message) {
        $this->twitter->setStatusUpdate($message);
    }
}

class SomeOtherServiceAdapter implements iStatusUpdate {

    protected $otherService;

    public function __construct(SomeOtherService $otherService){
        $this->otherService = $otherService;
    }

    public function getUserToken($userId) {
        $this->otherService->authenticate($userId);
    }

    public function postUpdate($message) {
        $this->otherService->postMessage($message);
    }
}

$someUserId = "someUserId";


//$statusUpdate = new Facebook;
//$statusUpdate->getUserToken($someUserId);
//$statusUpdate->postUpdate('some message');
//print_r($statusUpdate);

$statusUpdate = new TwitterAdapter(new Twitter);
$statusUpdate->getUserToken($someUserId);
$statusUpdate->postUpdate('some message');

//$statusUpdate = new SomeOtherServiceAdapter(new SomeOtherService);
//$statusUpdate->getUserToken($someUserId);
//$statusUpdate->postUpdate('some message');