<?php

namespace Models;

/**
 * Class Post.
 *
 * @property User $user
 * @package Models
 */
class Post extends Model {
    /**
     * @var int Primary key.
     */
    public int $id;

    /**
     * @var int User that owns post.
     */
    public int $userId;

    /**
     * @var string The title of the post.
     */
    public string $title;

    /**
     * @var string The body of the post.
     */
    public string $content;

    /**
     * @var string When the post was created.
     */
    public string $createdAt;

    /**
     * @var string The last time the post was updated.
     */
    public string $updatedAt;

    /**
     * @inheritDoc
     */
    protected function setAttributes(array $attributes): void
    {
        $this->id = $attributes['id'];
        $this->userId = $attributes['user_id'];
        $this->title = $attributes['title'];
        $this->content = $attributes['content'];
        $this->createdAt = $attributes['created_at'];
        $this->updatedAt = $attributes['updated_at'];

        $this->user = (new User())->find($this->userId);
    }

    /**
     * @inheritDoc
     */
    protected function setTableName(): void
    {
        $this->tableName = 'posts';
    }
}