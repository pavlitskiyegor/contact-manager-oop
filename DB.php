<?php

interface DB
{
    public function connect();

    public function query($contact);

    public function close();
}