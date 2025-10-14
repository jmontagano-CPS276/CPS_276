<?php

class Directories
{

    private static $directoryPath = "directories/";
    private static $readMeFile = "readme.txt";
    private $directoryName = "";
    private $fileContents = "";
    private $filePath = "";

    public function __construct(string $directoryName, string $fileContents)
    {
        $this->directoryName = self::$directoryPath . $directoryName;
        $this->fileContents = $fileContents;
    }
    public function newDirAndFile()
    {
        try {

            // directory existence check
            if (is_dir($this->directoryName)) {
                throw new Exception("A directory already exists with that name.");
            }

            // if directory creation failed for some reason throw exception
            if (!mkdir($this->directoryName)) {
                throw new Exception("Directory could not be created.");
            }

            // change file permissions
            chmod($this->directoryName, 0777);
            // append for full file path
            $this->filePath = $this->directoryName . "/" . self::$readMeFile;

            // if file could not be made for some reason, throw new exception.
            if (trim($this->fileContents) === "" || !touch($this->filePath)) {
                throw new Exception("This file could not be created.");
            }

            // if file stream/file could not open, throw new exception
            if (!$handle = fopen($this->filePath, "w")) {
                throw new Exception("Cannot open " . $this->filePath);
            }

            // would handle these but assignment specifications don't seem to be worried about it.
            fwrite($handle, $this->fileContents);
            fclose($handle);

        } catch (Exception $e) {
            error_log("Error: " . $e->getMessage());
            return "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
        }
        return "<p>File and Directory were created.</p><p><a href='{$this->filePath}' target='_blank'>Path where file is located</a></p>";
    }


}

