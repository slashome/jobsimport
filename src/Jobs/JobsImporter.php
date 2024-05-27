<?php

namespace Jobs;

use Jobs\Models\Job;
use Jobs\Repositories\JobRepository;
use Jobs\Repositories\PartnerRepository;

final class JobsImporter
{
    private JobRepository $jobRepository;
    private PartnerRepository $partnerRepository;

    public function __construct(
        JobRepository $jobRepository,
        PartnerRepository $partnerRepository
    )
    {
        $this->jobRepository = $jobRepository;
        $this->partnerRepository = $partnerRepository;
    }

    public function importXML(string $filepath): int
    {
        $partnerId = $this->partnerRepository->getPartnerIdByName('RegionsJob');

        /* parse XML file */
        $xml = (array) simplexml_load_file($filepath);
        $items = $xml['item'];

        $jobs = array_map(function($item) use ($partnerId) {
            return new Job(
                (string) $item->ref,
                (string) $item->title,
                (string) $item->description,
                (string) str_replace('http://www.regionsjob.com', '', $item->url),
                (string) $item->company,
                (string) $item->pubDate,
                $partnerId
            );
        }, $items);

        return $this->jobRepository->insertJobs($jobs);
    }

    public function importJson(string $filepath): int
    {
        $partnerId = $this->partnerRepository->getPartnerIdByName('JobTeaser');

        /* parse JSON file */
        $json = json_decode(file_get_contents($filepath));
        $items = $json->offers;

        $jobs = array_map(function($item) use ($partnerId) {
            $date = date('Y-m-d H:i:s', strtotime($item->publishedDate));
            return new Job(
                (string) $item->reference,
                (string) $item->title,
                (string) $item->description,
                (string) $item->urlPath,
                (string) $item->companyname,
                (string) $date,
                $partnerId
            );
        }, $items);

        return $this->jobRepository->insertJobs($jobs);
    }
}
