<?php

class OrganisationUnit 
{

    public string $name;

    public OrganisationUnitConfig $config;

    public function __construct($name, $config)
    {
        $this->name = $name;
        $this->config = $config;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setConfig(OrganisationUnitConfig $config)
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }
}