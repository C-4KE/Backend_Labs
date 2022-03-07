<?php

include __DIR__ . "/../vendor/autoload.php";
include __DIR__ . "/user.php";

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorBuilder;

function validateUser(User $user)
{
    $validator = ((new ValidatorBuilder())->addMethodMapping('loadValidatorMetadata'))->getValidator();

    $errors = $validator->validate($user);

    echo 'Class\'s creation date and time: ' . $user->getCreationDateTime()->format('d-m-Y H:i:s') . '<br>';

    if (count($errors) > 0)
    {
        foreach($errors as $error)
        {
            echo $error->getMessage().'<br>';
        }
    }
    else
    {
        echo 'Valid user.';
    }
}

$newUser = new User((int)null, "", "", "");
validateUser($newUser);
echo '<br>';

$newUser = new User(0, "R2", "bip_bup@", "qq");
validateUser($newUser);
echo '<br>';

$newUser = new User(-5, "DDDDDDDDDDDDDDDDDDDDD", "bip_bup@star_wars", "###############################");
validateUser($newUser);
echo '<br>';

$newUser = new User(5, "R2-D2!@!", "bip_bup@star_wars.", "s####((((");
validateUser($newUser);
echo '<br>';

$newUser = new User(5, "R2-D2", "bip_bup@star_wars.com", "s#!?*2");
validateUser($newUser);
echo '<br>';

?>