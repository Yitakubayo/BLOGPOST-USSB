<?php
include_once 'sms.php';

class Menu {
    private $text;
    private $sessionId;
    private $phoneNumber;
    private $conn;
    private $sms;

    public function __construct($text, $sessionId, $phoneNumber, $conn) {
        $this->text = $text;
        $this->sessionId = $sessionId;
        $this->phoneNumber = $phoneNumber;
        $this->conn = $conn;
        $this->sms = new Sms();
    }

    public function middleWare($text) {
        return trim($text);
    }

    public function mainMenu() {
        echo "CON Welcome to Menu Service\n";
        echo "1. Subscribe\n";
        echo "2. Unsubscribe\n";
        echo "3. Rate Blog\n";
        echo "4. Suggest Topic\n";
        echo "5. Feedback";
    }

    public function menuSubscribe($input) {
        if (count($input) == 1) {
            $stmt = $this->conn->prepare("INSERT IGNORE INTO subscribers (phone_number) VALUES (?)");
            $stmt->execute([$this->phoneNumber]);

            $this->sms->sendSMS("You are now subscribed to updates.", $this->phoneNumber);
            echo "END You are now subscribed.";
        } else {
            echo "END Invalid input.";
        }
    }

    public function menuUnsubscribe($input) {
        if (count($input) == 1) {
            $stmt = $this->conn->prepare("UPDATE subscribers SET status = 'inactive' WHERE phone_number = ?");
            $stmt->execute([$this->phoneNumber]);

            $this->sms->sendSMS("You have been unsubscribed.", $this->phoneNumber);
            echo "END You have been unsubscribed.";
        } else {
            echo "END Invalid input.";
        }
    }

    public function menuRateBlog($input) {
        if (count($input) == 1) {
            echo "CON Enter your rating (1-5):";
        } elseif (count($input) == 2) {
            $rating = intval($input[1]);
            if ($rating >= 1 && $rating <= 5) {
                $stmt = $this->conn->prepare("INSERT INTO ratings (phone_number, rating) VALUES (?, ?)");
                $stmt->execute([$this->phoneNumber, $rating]);

                $this->sms->sendSMS("Thanks for your $rating-star rating!", $this->phoneNumber);
                echo "END Thank you for your rating!";
            } else {
                echo "END Invalid rating. Enter 1-5.";
            }
        }
    }

    public function menuSuggestTopic($input) {
        if (count($input) == 1) {
            echo "CON Enter your topic suggestion:";
        } elseif (count($input) == 2) {
            $stmt = $this->conn->prepare("INSERT INTO topics (phone_number, suggestion) VALUES (?, ?)");
            $stmt->execute([$this->phoneNumber, $input[1]]);

            $this->sms->sendSMS("Thanks for your topic suggestion!", $this->phoneNumber);
            echo "END Suggestion received.";
        }
    }

    public function menuFeedback($input) {
        if (count($input) == 1) {
            echo "CON Enter your feedback:";
        } elseif (count($input) == 2) {
            $stmt = $this->conn->prepare("INSERT INTO feedback (phone_number, feedback) VALUES (?, ?)");
            $stmt->execute([$this->phoneNumber, $input[1]]);

            $this->sms->sendSMS("Thanks for your feedback!", $this->phoneNumber);
            echo "END Feedback received.";
        }
    }
}
?>
