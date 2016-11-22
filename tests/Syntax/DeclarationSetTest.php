<?php

namespace NielsHoppe\PHPCSS\Syntax;

class DeclarationSetTest extends \PHPUnit_Framework_TestCase {

    public function testConstruct () {

        $obj = new DeclarationSet();

        return $obj;
    }

    /**
     * @depends testConstruct
     */
    public function testAddDeclaration ($obj) {

        $obj->addDeclaration(new Declaration('margin-top', '10px', false));
        $obj->addDeclaration(new Declaration('margin-top', '20px', true));

        return $obj;
    }

    /**
     * @depends testAddDeclaration
     */
    public function testCreateDeclaration ($obj) {

        $obj->createDeclaration('margin-bottom', '15px', false);

        return $obj;
    }

    /**
     * @depends testCreateDeclaration
     */
    public function testGetDeclarations ($set) {

        $declarations = $set->getDeclarations();

        $this->assertInternalType('array', $declarations);
        $this->assertCount(2, $declarations);

        $declarations = $set->getDeclarations(array('margin-bottom'));

        $this->assertInternalType('array', $declarations);
        $this->assertCount(1, $declarations);
    }

    /**
     * @depends testCreateDeclaration
     */
    public function testToString ($obj) {

        $this->assertEquals('margin-bottom: 15px; margin-top: 20px !important', strval($obj));

        return $obj;
    }

    public function testUnion () {

        $foo = new DeclarationSet();

        $foo->addDeclaration(new Declaration('margin-top', '10px'));
        $foo->addDeclaration(new Declaration('margin-top', '1px'));
        $foo->createDeclaration('margin-bottom', '3px');

        $bar = new DeclarationSet();

        $bar->addDeclaration(new Declaration('margin-left', '4px'));
        $bar->createDeclaration('margin-bottom', '30px');
        $bar->createDeclaration('margin-right', '2px');

        $baz = $foo->union($bar);

        $this->assertEquals('margin-bottom: 3px; margin-left: 4px; margin-right: 2px; margin-top: 1px', strval($baz));
    }
}
