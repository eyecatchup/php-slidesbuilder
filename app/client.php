<?php
namespace SlidesBuilder;

// Composer autoloading (run composer install in the package root first!).
require_once realpath(__DIR__ . '/../vendor/autoload.php');

use SlidesBuilder\Client\StringOutput;
use SlidesBuilder\Client\JsonStringOutput;

try {
    // Create a new slides-builder wizard instance.
    $wizard = new Wizard;


    // Create a new document model (if not done in the constructor call).
    #$wizard->createDocument();

    //var_dump($wizard);exit(0);
    //or..
    /** */
    $customProperties = ['documentDefaults' => [
        'saveAs' => 'app\static\index.html',
        #'templateRoot' => __DIR__,
        #'markdownRoot' => __DIR__,
        'template' => [
            'baseTemplateFilename' => 'base-git2.html',
            /*'pageTemplates' => [
                'className' => 'partialFile.html'
            ]*/
        ]
    ]];
    $wizard->createDocument($customProperties);
    /* */

    // Want a string? (default)
    #print (string) $wizard->getComposedDocument() . PHP_EOL;
    
	if (!$wizard->writeCompiledHtmlToFile()) {
		print "error writing file." . PHP_EOL;
	}
	else {
		print "wrote file." . PHP_EOL;
	}


    // Or want some JSON instead? Use `setOutput`:
    // (Go back by `setOutput(new StringOutput)`.)
    #$wizard->setOutput(new JsonStringOutput);

    #print (string) $wizard->getComposedDocument() . PHP_EOL;


    // Or even want the raw document model object?
    #var_dump((object) $wizard->getDiDocumentModel());
}
catch(\Exception $e) {
    print $e->getMessage();
}
