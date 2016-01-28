<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Doctrine\DBAL\DBALException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 * Console command for importing crimes data
 * Class CrimesImportCommand
 * @package AppBundle\Command
 */
class CrimesImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('police:crimes:import')
            ->setDescription('Import crimes data from sql file')
            ->addArgument(
                'file',
                InputArgument::REQUIRED,
                'Specify the sql file to import from?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $fileName = $input->getArgument('file');
        if ($fileName) {
            $manager = $this->getContainer()->get('doctrine.orm.entity_manager');

            // Deleting the temporary table if it exists
            try {
                $sql = 'DROP TABLE IF EXISTS tmp2;';
                $manager->getConnection()->exec($sql);
                $manager->flush();
            } catch (DBALException $e){
                $output->writeln('Unable to remove tmp2 table. Exiting...');
                throw $e;
            }

            // Importint the data to the table named tmp2
            try {
                $sql = file_get_contents($fileName);
                $manager->getConnection()->exec($sql);
                $manager->flush();
            } catch (DBALException $e){
                $output->writeln('Unable to import data from the file '. $fileName .'. Exiting...');
                throw $e;
            }

            // Creating crime types records (if exists (errors) - skip this step)
            try {
                $sql = 'INSERT INTO crime_type (id, title) SELECT DISTINCT category_id, category_description from tmp2';
                $manager->getConnection()->exec($sql);
                $manager->flush();
            } catch (DBALException $e){
                $output->writeln('Status codes update is skipped. Continue import...');
            }

            // Searching and deleting duplicates:
            try {
                // creating auxiliry indexes
                $sql = 'CREATE INDEX tmp2_date ON tmp2(date, lat, lng, category_id)';
                $manager->getConnection()->exec($sql);
                $manager->flush();
                $sql = 'CREATE INDEX point_created_at ON point(created_at, latitude, longitude, crime_type)';
                $manager->getConnection()->exec($sql);
                $manager->flush();

                $sql = 'DELETE FROM tmp2 WHERE id IN
                            (SELECT * FROM
                                (SELECT tmp2.id AS id FROM tmp2
                                INNER JOIN point on point.created_at = tmp2.date
                                AND point.crime_type = category_id
                                AND abs(point.longitude - tmp2.lng)< 0.000001
                                AND (point.latitude - tmp2.lat) < 0.000001)
                                as t)';
                $manager->getConnection()->exec($sql);
                $manager->flush();

                $sql = 'DROP INDEX point_created_at ON point';
                $manager->getConnection()->exec($sql);
                $manager->flush();

            } catch (DBALException $e){
                $output->writeln('Error deleting duplicates. Exiting...');
                throw $e;
            }

            // Inserting the crime data
            try {
                $sql = 'INSERT INTO point (crime_type, created_at, updated_at, longitude, latitude, type, description)
                        SELECT category_id, date, date, lng, lat, "crime", category_description from tmp2;';
                $manager->getConnection()->exec($sql);
                $manager->flush();
            } catch (DBALException $e){
                $output->writeln('Crimes update failed. Exiting...');
                throw $e;
            }

            // Deleting the temporary table
            try {
                $sql = 'DROP TABLE IF EXISTS tmp2;';
                $manager->getConnection()->exec($sql);
                $manager->flush();
            } catch (DBALException $e){
                $output->writeln('Unable to remove tmp2 table. Exiting...');
                throw $e;
            }


            $output->writeln('Import done');
        } else {
            $output->writeln('Unable to open file ' . $fileName);
        }
    }
}