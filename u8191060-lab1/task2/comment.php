<?php

include __DIR__ . "/../vendor/autoload.php";
include __DIR__ . "/user.php";

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

class Comment
{
    private User $author;
    private string $content;

    /**
     * Constructor
     * @param User $author
     * @param string $content
     */
    public function __construct(User $author, string $content)
    {
        $this->author = $author;
        $this->content = $content;
    }

    /**
     * Getter for the author.
     * @return User
     */
    public function getAuthor() : User
    {
        return $this->author;
    }

    /**
     * Getter for the content.
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * Function for validator.
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints( "content", 
        [
            new Assert\NotBlank([
                'message' => 'Comment can\'t be blank.'
            ]),
            new Assert\Length([
                'min' => 1,
                'max' => 1000,
                'minMessage' => 'Comment\'s content is too short. It should have {{ limit }} characters or more.',
                'maxMessage' => 'Comment\'s content is too long. It should have {{ limit }} characters or less.' 
            ])
        ]);
    }

}

?>