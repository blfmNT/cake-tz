<?php
use PHPUnit\Framework\TestCase;

class ScriptTest extends TestCase
{
    public function testRevert()
    {
        $this->assertEquals(revertCharacters('Привет! Давно не виделись.'),
            'Тевирп! Онвад ен ьсиледив.');
    }
}
