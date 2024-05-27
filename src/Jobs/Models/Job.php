<?php

namespace Jobs\Models;

class Job
{
    private int|null $id;
    private string $reference;
    private string $title;
    private string $description;
    private string $url;
    private string $companyName;
    private string $publication;
    private int $partnerId;
    private string $partnerName;

    public function __construct(
        string $reference,
        string $title,
        string $description,
        string $url,
        string $companyName,
        string $publication,
        int $partnerId,
        string $partnerName = '',
        int $id = null,
    )
    {
        $this->id = $id;
        $this->reference = $reference;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->companyName = $companyName;
        $this->publication = $publication;
        $this->partnerId = $partnerId;
        $this->partnerName = $partnerName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getPublication(): string
    {
        return $this->publication;
    }

    public function getPartnerId(): int
    {
        return $this->partnerId;
    }

    public function getPartnerName(): string
    {
        return $this->partnerName;
    }
}
