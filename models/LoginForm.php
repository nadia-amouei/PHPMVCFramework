<?php

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
          'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
          'password' => [self::RULE_REQUIRED],
        ];
    }

    public function login(): bool
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            Application::$app->session->setFlash('error', 'wrong information');
            $this->addError('email','User doesn\'t exist with this amail');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password','Incorrect password');
            return false;
        }

        return Application::$app->login($user);
    }
}