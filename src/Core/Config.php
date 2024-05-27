<?php

namespace Core;

class Config
{
    public function __construct()
    {
        $this->dbHost = getenv('DB_HOST');
        $this->dbUser = getenv('DB_USER');
        $this->dbPwd = getenv('DB_PWD');
        $this->dbName = getenv('DB_NAME');

        $this->resourcesDir = getenv('RESOURCES_DIR');
    }
}
