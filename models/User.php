<?php

namespace Models;

/**
 * Class User
 */
class User extends Model
{
    /**
     * @var int Primary Key.
     */
    public int $id;

    /**
     * @var string Name of the user.
     */
    public string $name;

    /**
     * @var string Email of the user.
     */
    public string $email;

    /**
     * @var string Password of the user.
     */
    public string $password;

    /**
     * @var bool Check if user is admin.
     */
    public bool $isAdmin;

    /**
     * @inheritDoc
     */
    protected function setAttributes(array $attributes): void
    {
        $this->id = $attributes['id'];
        $this->name = $attributes['name'];
        $this->email = $attributes['email'];
        $this->password = $attributes['password'];
        $this->isAdmin = $attributes['is_admin'];
    }

    /**
     * @inheritDoc
     */
    protected function setTableName(): void
    {
        $this->tableName = 'users';
    }
}
