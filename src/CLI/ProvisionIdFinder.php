<?php

namespace CodingAvenue\Proof\CLI;

/**
 * Provision ID Resolver class.
 * Finds the provisioned ID that will be use to evaluate the test file.
 */

class ProvisionIdFinder
{
    private $baseContentDir;
    private $baseTestDir;

    public function __construct()
    {
        $this->baseContentDir = realpath('content');
        $this->baseTestDir = realpath('tests');
    }

    public function resolve(string $testFile)
    {
        $testFullPath = realpath($testFile);
        if (!file_exists($testFullPath)) {
            throw new \Exception("Cannot find file {$testFullPath}");
        }

        $sep = DIRECTORY_SEPARATOR;

        $pathParts = pathinfo($testFullPath);
        // The lesson is alway the first directory before the tests/content directory
        $lesson = str_replace("{$this->baseTestDir}{$sep}", "", $pathParts['dirname']);

        $contentPath = join($sep, array($this->baseContentDir, $lesson));
        $files = scandir($contentPath);

        $reduce = function($carry, $item) {
            if (preg_match('/\.q\.md$/', $item)) {
                $carry = $item;

                return $carry;
            }

            return $carry;
        };

        $lessonFile = array_reduce($files, $reduce);

        if (!$lessonFile) {
            throw new \Exception("Cannot find question file for test file {$testFile}");
        }

        $contents = file(join($sep, array($contentPath, $lessonFile)));

        $questionId = '';
        foreach ($contents as $line_num => $line) {
            if (preg_match("/^\/\/\//", $line)) { // It's an annotation line
                if (preg_match("/answer=\[$testFile\]/", $line)) {
                    preg_match("/id=(\w+-\w+-\w+-\w+-\w+/", $line, $match);

                    $questionId = $match[0];
                }
            }
        }

        // Time to read mapping.json

        $cwd = getcwd();

        $mapping = json_decode(file_get_contents(join($sep, array($cwd, 'mapping.json'))), true);

        return $mapping[$questionId];
    }
}