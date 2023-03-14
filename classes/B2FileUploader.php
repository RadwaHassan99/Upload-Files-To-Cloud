<?php
use BackblazeB2\Client;
use BackblazeB2\Bucket;

class B2FileUploader
{
    private $client;
    private $bucket;

    public function __construct($keyId, $appKey, $bucketId, $bucketName)
    {
        $this->client = new Client($keyId, $appKey);
        $this->bucket = new Bucket($bucketId, $bucketName, $this->client);
    }

    public function uploadFile($fileData)
    {
        if (!isset($fileData['name']) || !isset($fileData['type']) || !isset($fileData['tmp_name'])) {
            throw new InvalidArgumentException('Invalid file data.');
        }

        if (!is_uploaded_file($fileData['tmp_name'])) {
            throw new InvalidArgumentException('File does not exist or is not readable.');
        }

        $file = $this->client->upload([
            'BucketId' => $this->bucket->getId(),
            'FileName' => $fileData['name'],
            'Body' => fopen($fileData['tmp_name'], 'r')
        ]);

        return $file;
    }
}

?>