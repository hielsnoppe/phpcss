<?php

namespace NielsHoppe\PHPCSS\Syntax\Statements;

use \NielsHoppe\PHPCSS\Syntax\Rules\ImportStatement;

class ImportStatementTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider    validInputForCreation
     */

    public function testCanBeCreatedFromValidInput ($url, $media) {

        $style = new ImportStatement($url, $media);

        $this->assertInstanceOf(ImportStatement::class, $style);
    }

    /**
     * @dataProvider    validInputForCreation
     */

    public function testCanBeSerialized ($url, $media, $css) {

        $style = new ImportStatement($url, $media);

        $this->assertEquals($css, $style->__toString());
    }

    public function validInputForCreation () {

        return array(

            array('https://fonts.googleapis.com/css?family=Open+Sans', 'all',
                '@import url(https://fonts.googleapis.com/css?family=Open+Sans);'),

            array('https://fonts.googleapis.com/css?family=Open+Sans', 'print',
                '@import url(https://fonts.googleapis.com/css?family=Open+Sans) print;'),

            array('https://fonts.googleapis.com/css?family=Open+Sans', array('all'),
                '@import url(https://fonts.googleapis.com/css?family=Open+Sans);'),

            array('https://fonts.googleapis.com/css?family=Open+Sans', array('print'),
                '@import url(https://fonts.googleapis.com/css?family=Open+Sans) print;'),

            array('https://fonts.googleapis.com/css?family=Open+Sans', array('screen', 'print'),
                '@import url(https://fonts.googleapis.com/css?family=Open+Sans) screen, print;')
        );
    }
}
