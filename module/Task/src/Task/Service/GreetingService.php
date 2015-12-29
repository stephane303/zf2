<?php
namespace Task\Service;

class GreetingService {

    public function getGreeting() {
        if (date("H") <= 11) {
            return "Good morning, world!";
        } else if (date("H") > 11 && date("H") < 17) {
            return "Hello, world!";
        } else {
            return "Good evening, world!";
        }
    }

}
