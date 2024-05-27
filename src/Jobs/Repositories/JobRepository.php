<?php

namespace Jobs\Repositories;

use Core\DBConnector;
use Jobs\Models\Job;

class JobRepository
{
    private DBConnector $db;

    public function __construct(DBConnector $db)
    {
        $this->db = $db;
    }

    public function deleteAll(): void
    {
        $this->db->exec('DELETE FROM job');
    }

    public function insertJobs(array $jobs): int
    {
        $count = 0;
        foreach($jobs as $job) {
            $this->insertJob($job);
            $count++;
        }
        return $count;
    }

    public function insertJob(Job $job): bool
    {
        $query = 'INSERT INTO job (reference, title, description, url, company_name, publication, partner_id) VALUES (:reference, :title, :description, :url, :company_name, :publication, :partner_id)';
        $values = [
            'reference' => $job->getReference(),
            'title' => $job->getTitle(),
            'description' => $job->getDescription(),
            'url' => $job->getUrl(),
            'company_name' => $job->getCompanyName(),
            'publication' => $job->getPublication(),
            'partner_id' => $job->getPartnerId(),
        ];
        return $this->db->insertPreparedQuery($query, $values);
    }

    public function getAllJobs()
    {
        $jobs = $this->db->fetchAll('SELECT `job`.`id`, `job`.`reference`, `job`.`title`,
                                            `job`.`description`, `job`.`url`, `job`.`company_name`, `job`.`publication`,
                                            `partner`.`id` as `partner_id`,
                                            `partner`.`name` as `partner_name`
                                        FROM `job`
                                        LEFT JOIN `partner` ON `partner`.id = job.partner_id');

        return array_map(function($job) {
            return new Job(
                $job['reference'],
                $job['title'],
                $job['description'],
                $job['url'],
                $job['company_name'],
                $job['publication'],
                $job['partner_id'],
                $job['partner_name'],
                $job['id'],
            );
        }, $jobs);
    }
}
