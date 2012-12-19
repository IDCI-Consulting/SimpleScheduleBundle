<?php

/**
 * 
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 * @licence: GPL
 *
 */

namespace IDCI\Bundle\SimpleScheduleBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpdateCategoriesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('simple-schedule:categories:update')
            ->setDescription('Update the level and the tree fields based on the hierarchy for each categories')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

        $categories = $em
            ->getRepository('IDCISimpleScheduleBundle:Category')
            ->findAll()
        ;

        $output->writeln('<info>Start to update category fields</info>');

        $count = 0;
        foreach($categories as $category) {
            if($category->updateHierachyFields()) {
                $em->persist($category);
                $count++;
            }
        }
        $em->flush();
        $output->writeln(sprintf('<info>%d entities updated</info>', $count));
    }
}
