# Coding Avenue PHP Proof Library

A PHP Proof Library that can parse, analyze, and evaluate a given php file. It aims to help PHP course authors of CA School on validating user's answers. Having said that, this library is ideally used inside your PHPUnit tests.


## PHP Proof Library has 3 main components

 - **Parse** - Parses the php file and can traverse through it to be able to understand fully what is on the code.

 - **Analyze** - Analyze the php file if it follows the PSR2 Coding Standard and Mess Detection.

 - **Evaluate** - Evaluates the php file and gives back the output, returned value or error.


## Terms and Meaning

Before we dig deeper into this library, let's try to identify some terms and it's meaning that is use in this wiki.

 - **code file** - This is the file where this library will look as the code input. Meaning the php file that will be parsed, analyze and evaluated.
 <!--Where the student's answer is.-->
 - **proof file** - A proof file is a PHPUnit test that uses this library. <!--https://github.com/CodingAvenue/codestop-course-php-introduction/blob/master/tests/ArithmeticWithMultipleVariables/HannahsWeeklyIncomeTest.php-->
 - **Test Answers** - A Test answer is a php file that would be use as an answer to your course question. This term is primarily use for local testing and setting up the environment.
<!--Test answers verifies proof file. For example, SELECT * FROM table; see: https://github.com/CodingAvenue/codestop-course-php-introduction/blob/master/answers/ArithmeticWithMultipleVariables/HannahsWeeklyIncomeTest.php-->

## File structure requirement

This library requires a certain file structure for it to work properly.

 - All Proof files must be placed inside a parent directory and that directory is on the root of your project.
 - All Test Answers must be placed inside a parent directory and that directory is also on the root of your project.
 - A test answer must have the same file name as the Proof file. And should have the same path part after it's parent directory respectively. What this means is that if you have a proof file at `proofs/chapter1/question3.php` Then your test answer for this proof file should be at `testAnswers/chapter1/question3.php`. Assuming `proofs` and `testAnswers` are your proof file and test answers parent directory respectively. 

# Installation

To install via Composer add the following to your `composer.json` file
```
{
     "repositories": [
          {
              "type": "git",
              "url": "https://github.com/CodingAvenue/ca-school-php-proof"
          }
     ],
     "require": {
          "codingavenue/php-proof": "0.0.7"
     }
}
```
Then do `composer update`. Once composer has finish, you are now ready to use this awesome library!

# Configuration for local testing

Coding Avenue Proof Library was created with a mindset that it should work on any environment, and not just on the CA School Sandbox. This allows authors to test their proof files locally.


In order for this library to work on your environment, create a configuration file `proof.json` on your course root directory. The file only needs 3 settings

 - **codeFilePath** - This is the path to the file where the php file to be use by this library is located.
 - **answerDir** - This is the base directory for all test answers files.
 - **proofDir** - This is the base directory for all proof files.

Check [File Structure Requirements](https://github.com/CodingAvenue/ca-school-proof-library/wiki#file-structure-requirement) for details.

Once you save your settings. This library should now be ready to work on your environment.
# Basic Usage

PHP Proof Library only requires you to import the Code class `CodingAvenue\Proof\Code`. An create an instance of the `Code` class.

```php
use CodingAvenue\Proof\Code;

$code = new Code();
```

With this code, you now have the full arsenal of the library on your PHPUnit test. The `Code` class looks at your PHP File that you [configure](https://github.com/CodingAvenue/ca-school-proof-library/wiki/Configuration-for-local-testing) on your `proof.json` file. 

The constructor will throw an error if the file cannot be found. So make sure you setup your settings properly.

## Methods

### Main methods

 - **[analyzer](https://github.com/CodingAvenue/ca-school-proof-library/wiki/Analyzer)** - Returns an instance of `CodingAvenue\Proof\Analyzer` class.
 - **[evaluator](https://github.com/CodingAvenue/ca-school-proof-library/wiki/Evaluator)** - Returns an instance of `CodingAvenue\Proof\Evaluator` class.
 - **[getNodes](https://github.com/CodingAvenue/ca-school-proof-library/wiki/Nodes)** - Returns an instance of `CodingAvenue\Proof\Code\Nodes` class.
 - **[find](https://github.com/CodingAvenue/ca-school-proof-library/wiki/Traversing)** - Returns an instance of `CodingAvenue\Proof\Code\Nodes` class but filters the  result already from the selector.

### Other methods

 - **[parse](https://github.com/CodingAvenue/ca-school-proof-library/wiki/Parser)** - Returns the parsed php code by [PHP Parser](https://github.com/nikic/PHP-Parser)
 - **[getConfig](https://github.com/nikic/Config)** - Returns the instance of the Config class that this `Code` instance uses.

 # Analyzer

The Analyzer class checks the php file for any **PSR2 Coding Standard** violations and **Mess Detection**.

## Methods

### codingStandard

```php
use CodingAvenue\Proof\Code;

$code = new Code();
$analyzer = $code->analyzer();

$result = $analyzer->codingStandard();
```

`$result` will be an array of violations of the **PSR2 Coding Standard**. Each element of the array is an array with the following keys

 - **message** - The actual violation message.
 - **line** - The line number from the code where the violation is found.
 - **column** - The column number from the code where the violation is found.

`codingStandard()` method accepts an optional parameter `$option` which is an array. Current supported option is `skipEndTagMessage` which ignores the violation for code that has no php end tag `?>` at the end of the Php file.

### messDetection

```php
use CodingAvenue\Proof\Code;

$code = new Code();
$analyzer = $code->analyzer();

$result = $analyzer->messDetection();
```

`$result` will be an array of violations for possible potential problems on the code. Each element of the array is an array with the following keys

 - **message** - The actual violation message.
 - **beginLine** - The line where the violation started.
 - **endLine** - The line where the violation ends.

`messDetection()` accepts an optional parameter `$rules`, which is an array of rules to be used for detecting possible problems on the code. The following are the supported rules

 - `cleancode`
 - `codesize`
 - `controversial`
 - `design`
 - `naming`
 - `unusedcode`

By default, all rules are applied to the PHP file.

# Evaluator

The Evaluator class evaluates the Php File.

```php
use CodingAvenue\Proof\Code;

$code = new Code();
$evaluator = $code->evaluator();

$result = $evaluator->evaluate();
```

`$result` will be an array with the following keys

 - **result** - The result of the evaluated code. This is the returned value of the code before it exits.
 - **output** - The output of the evaluated code. This is anything that is normally printed to your screen if you run the php file  yourself.
 - **error** - If the evaluated code result to any error, the error can be access through this.

`evaluate()` accepts an optional parameter `$code` which is an additional string of code that will be appended to the actual code. This is useful if you wanted to check if a given function actually gives you the desired result.

Given the following code

```php
function add($firstNumber, $secondNumber)
{
  return $firstNumber + $secondNumber;
}
```

Evaluating it as is won't give us a result that we could use. The best way to evaluate it is to actually call the `add()` function itself. This is where the optional line of code can come in handy.

```php
use CodingAvenue\Proof\Code;

$code = new Code();
$evaluator = $code->evaluator();

$result = $evaluator->evaluate('add(1,1)');
```

The result will then be
```php
array(
 [result] => 2,
 [output] => ''
)
```

which is more useful to us since now we can validate that the `add()` function is behaving correctly.

# Nodes

A `Nodes` class represent the parsed php code and allows us to traverse through the node tree to find specific nodes. It is design to traverse the node tree in a more expressive way. Although this class is using the [PHP Parser](https://github.com/nikic/PHP-Parser) results, it's objective is to simplify how to traverse on it without any knowledge of what the PHP Parser is.

## Traversing

The main method for traversing for the `Nodes` class is the `find()` method. It accepts a `selector` string, much like a `css selector`. Here's a glimpse on how the `Nodes` class can be use.

```php
use CodingAvenue\Proof\Code;

$code = new Code();
$nodes = $code->getNodes();

// Finding all echo nodes.
$echoNodes = $nodes->find('construct[name="echo"]');

// Finding all assignment nodes;
$assignmentNodes = $nodes->find('operator[name="assignment"]');

// Want to know how many times the echo statement was used?
$echoNodes->count();

// Want to know the string literals from the echo nodes?
$echoNodes->text();

// The find() method returns a new instance of the Nodes class so you can cascade the calls
$assignmentNodes = $nodes->find('function[name="add"]')->find('operator[name="assignment"]');
// Will return all assignment operator statement inside the function add().
```

PHP has a lot of built-in functions, language constructs , operators. Each of those will be discussed on it's own page so it will be easier to look at them in the future. Check the sub list on the right to know more on how you can find them on the `Nodes` class.

## `Code` class `find` method

The `Code` class also has a find method which is just a shortcut of calling `getNodes()` and the `find()` method of the `Nodes` class.

```php
$code = new Code();

$nodes = $code->find('construct[name="echo"]');
```

`$nodes` will then be a `Nodes` class with the echo nodes on it.


