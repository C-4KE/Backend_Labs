<?php

include __DIR__ . "/../vendor/autoload.php";

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private DateTime $creationDateTime;

    /**
     * Constructor
     * @param int $id
     * @param string $name
     * @param string $email
     * @param string $password
     */
    public function __construct(int $id, string $name, string $email, string $password, DateTime $creationDateTime = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        if (!is_null($creationDateTime)) {
            $this->creationDateTime = $creationDateTime;
        } else {
            $this->creationDateTime = new DateTime('NOW');
        }
    }

    /**
     * Getter for creationDateTime
     * @return DateTime
     */
    public function getCreationDateTime(): DateTime
    {
        return $this->creationDateTime;
    }

    /**
     * Function for validator.
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints("id", 
        [
            new Assert\Positive([
                'message' => 'User\'s id must be positive number.'
            ])

        ]);
        
        $metadata->addPropertyConstraints("name",
        [
            new Assert\NotBlank([
                'message' => 'User\'s name can\'t be blank.'
            ]),
            new Assert\Length([
                'min' => 3,
                'max' => 20,
                'minMessage' => 'User\'s name is too short. It should have {{ limit }} characters or more.',
                'maxMessage' => 'User\'s name is too long. It should have {{ limit }} characters or less.' 
            ]),
            new Assert\Regex([
                'pattern' => '/^[a-z\d\-\_]+$/i',
                'message' => 'User nickname must contain only letters, numbers, "-" or "_".'
            ])
        ]);

        $metadata->addPropertyConstraints("email", 
        [
            new Assert\NotBlank([
                'message' => 'User\'s email can\'t be blank.'
            ]),
            new Assert\Email([
                'message' => 'User\'s email is not valid.'
            ])
        ]);

        $metadata->addPropertyConstraints("password", 
        [
            new Assert\NotBlank([
                'message' => 'User\'s password can\'t be blank.'
            ]),
            new Assert\Length([
                'min' => 3,
                'max' => 30,
                'minMessage' => 'User\'s password is too short. It should have {{ limit }} characters or more.',
                'maxMessage' => 'User\'s password is too long. It should have {{ limit }} characters or less.' 
            ]),
            new Assert\Regex([
                'pattern' => '/^[a-z\d\-\_\*\!\%\?\,\.\#]+$/i',
                'message' => 'User nickname must contain only letters, numbers or these symbols: "- _ # ! ? * % , ." .'
            ])
        ]);
    }

}