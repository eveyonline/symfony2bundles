<?php

namespace Knp\Bundle\Symfony2BundlesBundle\Detector\Criterion;

require_once __DIR__ . '/CriterionTest.php';

class SymfonySubmoduleTest extends CriterionTest
{
    /**
     * @dataProvider getMatches
     */
    public function testMatches($directory, $expected)
    {
        $repo = $this->getRepo(__DIR__ . '/fixtures/' . $directory);

        $criterion = new SymfonySubmodule();

        $this->assertEquals($expected, $criterion->matches($repo));
    }

    public function getMatches()
    {
        return array(
            array('empty', false),
            array('standard', true),
            array('standard-fake', false)
        );
    }
}
