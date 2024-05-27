<?php

declare(strict_types=1);

use Core\{Config, DBConnector, Utils};
use Jobs\{JobsImporter, JobsLister, Repositories\PartnerRepository};
use Jobs\Repositories\JobRepository;

require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/autoloader.php');

Utils::printMessage("Starting...");

$config = new Config();

/* Create instances */
$dbConnector = new DBConnector($config->dbHost, $config->dbUser, $config->dbPwd, $config->dbName);
$jobRepository = new JobRepository($dbConnector);
$partnerRepository = new PartnerRepository($dbConnector);
$jobsImporter = new JobsImporter($jobRepository, $partnerRepository);

/* Delete all data */
$jobRepository->deleteAll();
$partnerRepository->deleteAll();

/* Insert Partners */
$partnerRepository->insertPartners([
    ['name' => 'RegionsJob', 'url' => 'https://www.regionsjob.com/'],
    ['name' => 'JobTeaser', 'url' => 'https://www.jobteaser.com/']
]);

/* Import Jobs from regionsjob.xml */
$count = $jobsImporter->importXML(__DIR__ . '/' . $config->resourcesDir . '/regionsjob.xml');

/* Import Jobs from jobteaser.json */
$count += $jobsImporter->importJson(__DIR__ . '/' . $config->resourcesDir . '/jobteaser.json');

Utils::printMessage("> {count} Jobs imported.", ['{count}' => $count]);


/* list Jobs */
$jobs = $jobRepository->getAllJobs();

Utils::printMessage("> all Jobs ({count}):", ['{count}' => count($jobs)]);
foreach ($jobs as $job) {
    Utils::printMessage(" {id}: {partner} - {reference} - {title} - {publication}", [
    	'{id}' => $job->getId(),
        '{partner}' => $job->getPartnerName(),
    	'{reference}' => $job->getReference(),
        '{title}' => $job->getTitle(),
        '{publication}' => $job->getPublication()
    ]);
}


Utils::printMessage("Terminating...");
