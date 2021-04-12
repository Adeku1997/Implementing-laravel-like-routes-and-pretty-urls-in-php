<?php

namespace Models;

/**
 * Class Post.
 *
 *
 * @package Models
 */
class Comment extends Model
{
    /**
     * @var ?User The user that made the comment.
     */
    public ?User $user;

     /**
      * @var int Primary key.
      */
     public int $id;

     /**
      * @var int User that owns the comment.
      */
     public int $userId;

     /**
      * @var int post that owns comment.
      */
     public int $postId;

     /**
      * @var string the comment content.
      */
     public string $comment;

     /**
      * @var string when the comment was created.
      */
     public string $createdAt;

     /**
      * @inheritDoc
      */
     protected function setTableName(): void
     {
         $this->tableName= 'comments';
     }

     /**
      * @inheritDoc
      */
     protected function setAttributes(array $attributes): void
     {
         $this->id = $attributes['id'];
         $this->userId = $attributes['user_id'];
         $this->postId = $attributes['post_id'];
         $this->comment = $attributes['comment'];
         $this->createdAt = $attributes['created_at'];

         $this->user = (new User())->find($this->userId);
     }

 }