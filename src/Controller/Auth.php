<?php
namespace App\Controller;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use App\Model\User;

class Auth {
    public static function handle($entityManager) {
        $data = json_decode(file_get_contents("php://input"), true);
        
        if (!isset($data['action'])) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid request"]);
            return;
        }

        switch ($data['action']) {
            case 'register':
                self::register($entityManager, $data);
                break;
            case 'login':
                self::login($entityManager, $data);
                break;
            default:
                http_response_code(400);
                echo json_encode(["error" => "Unknown action"]);
        }
    }

    private static function register($entityManager, $data) {
        if (!isset($data['email'], $data['password'],$data['username'],$data['usersurname'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }
        
        $user = new User();
        $user->setEmail($data['email']);
        $user->setUserName($data['username']);
        $user->setUserSurname($data['usersurname']);
        $user->setPassword(password_hash($data['password'], PASSWORD_BCRYPT));
        
        $entityManager->persist($user);
        $entityManager->flush();
        
        echo json_encode(["message" => "User registered successfully"]);
    }

    private static function login($entityManager, $data) {
        if (!isset($data['email'], $data['password'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing required fields"]);
            return;
        }
        
        $userRepo = $entityManager->getRepository(User::class);
        $user = $userRepo->findOneBy(["email" => $data['email']]);
        
        if (!$user || !password_verify($data['password'], $user->getPassword())) {
            http_response_code(401);
            echo json_encode(["error" => "Invalid credentials"]);
            return;
        }

        //TODO Define your secret key (you should move this to a config/env file for security)
        $secretKey = 'your-secret-key';  // Update with your actual secret key
        $issuer = 'yourdomain.com';      // Update with your actual domain
        
        $payload = [
            "iss" => $issuer,           // Issuer of the token
            "iat" => time(),            // Issued at time
            "exp" => time() + 3600,     // Expiration time (1 hour)
            "user_id" => $user->getId(), // User ID for identification
            "email" => $user->getEmail() // User email (optional)
        ];
        $token = JWT::encode($payload, $secretKey,'HS256');
        
        echo json_encode(["token" => $token]);
    }


}