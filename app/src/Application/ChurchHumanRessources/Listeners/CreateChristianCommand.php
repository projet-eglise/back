<?php

namespace Src\Application\ChurchHumanRessources\Listeners;

interface CreateChristianCommand
{
    public function uuid(): string;
    public function firstname(): string;
    public function lastname(): string;
    public function email(): string;
    public function phone(): string;
    public function birthdate(): string;
    public function profilePicture(): string;
}