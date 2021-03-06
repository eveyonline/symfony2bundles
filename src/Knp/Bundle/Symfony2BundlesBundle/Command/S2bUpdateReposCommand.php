<?php

namespace Knp\Bundle\Symfony2BundlesBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Knp\Bundle\Symfony2BundlesBundle\Updater\Updater;

class S2bUpdateReposCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setDefinition(array())
            ->setName('s2b:update:repos')
        ;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException When the target directory does not exist
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $gitRepoDir = $this->getContainer()->getParameter('knp_symfony2bundles.repos_dir');
        $gitBin = $this->getContainer()->getParameter('knp_symfony2bundles.git_bin');

        $em = $this->getContainer()->get('knp_symfony2bundles.entity_manager');

        $updater = new Updater($em, $gitRepoDir, $gitBin, $output);
        $updater->setUp();
        $updater->updateReposData();
        $em->flush();
    }
}
