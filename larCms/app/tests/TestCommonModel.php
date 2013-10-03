<?php

class StuffTest extends Zizaco\TestCases\TestCase
{
    /**
     * Clean collection between every test
     */
    public function setUp()
    {
        foreach( Stuff::all() as $s ) { $s->delete(); }
        parent::setUp(); // Don't forget this if you overwrite the setUp() method
    }

    /* Your tests here :) */
}