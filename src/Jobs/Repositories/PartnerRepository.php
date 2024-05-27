<?php

namespace Jobs\Repositories;

use Core\DBConnector;

class PartnerRepository
{
    private DBConnector $db;

    public function __construct(DBConnector $db)
    {
        $this->db = $db;
    }

    public function deleteAll(): void
    {
        $this->db->exec('DELETE FROM partner');
    }

    public function insertPartners(array $partners): int
    {
        $count = 0;
        foreach($partners as $partner) {
            $this->insertPartner($partner);
            $count++;
        }
        return $count;
    }

    public function insertPartner(array $partner): bool
    {
        $query = 'INSERT INTO partner (name, baseUrl) VALUES (:name, :url)';
        $values = [
            'name' => $partner['name'],
            'url' => $partner['url']
        ];
        return $this->db->insertPreparedQuery($query, $values);
    }

    public function getAllPartners()
    {
        return $this->db->fetchAll('SELECT id, name, baseUrl FROM partner');
    }

    public function getPartnerIdByName(string $partnerName): int
    {
        $partner = $this->db->fetchAll("SELECT id FROM partner WHERE name = :partnerName;", ['partnerName' => $partnerName]);
        return $partner[0]['id'];
    }
}
