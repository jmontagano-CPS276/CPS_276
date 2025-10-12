<?php

class Directories
{

    private static $directoryPath = "../directories/";

    private static $readMeFile = "/readme.txt";
    private $directoryName = "";
    private $fileContents = "";

    private $filePath = "";

    public function __construct(string $directoryName, string $fileContents)
    {
        $this->directoryName = self::$directoryPath . $directoryName;
        $this->fileContents = $fileContents;
    }
    public function newDir()
    {
        try {
            if ($this->createDirectory($this->directoryName, 0777) === false) {
                throw new Exception("This directory: " . $this->directoryName . " already exists");
            }
            $this->filePath = $this->directoryName . self::$readMeFile;
            touch($this->filePath);
            $handle = fopen($this->filePath, "w");
            if (!$handle) {
                throw new Exception("Cannot Open " . $this->filePath);
            }
            fwrite($handle, $this->fileContents);
            fclose($handle);
        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return $e->getMessage();
        }
        return "Path where file is located.";
    }


    public function createDirectory(string $directoryName, int $permissions = 0777)
    {
        if (mkdir($this->directoryName)) {
            chmod($this->directoryName, $permissions);
            return true;
        }
        return false;
    }


}

