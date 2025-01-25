<?php

namespace app\models;

use app\core\UserModal;

class User extends UserModal
{
    public string $name;
    public string $email;
    public string $password;
    public string $confirmPassword;

    public function tableName(): string
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'name',
            'email',
            'password',
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [
                self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class]
            ],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, ['min'=> 2]]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function save(): bool
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function getDisplayName(): string
    {
        return $this->name;
    }
}