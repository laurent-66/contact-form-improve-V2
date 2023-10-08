<?php

namespace App\Service;

use App\Service\LastRequestContact;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ExportContactJson 
{
    private $serializer;
    private $normalizer;

    public function __construct(NormalizerInterface $normalizer, SerializerInterface $serializer)
    {
        $this->normalizer = $normalizer;
        $this->serializer = $serializer;
    }

    public function export($contact, $pathRegister, $email)
    {
        //référence circulaire avec cette solution
        // $encoders = [new JsonEncoder()];
        // $normalizers = [new ObjectNormalizer()];
        // $serializer = new Serializer($normalizers, $encoders);
        // $jsonData = $serializer->serialize($contact, 'json', ['groups' => 'getcontact']);

        //solution qui fonctionne et qui est utilisé
        $arrayData = $this->normalizer->normalize($contact, '', ['groups' => 'getContact']);
        $contact = LastRequestContact::getLastRequestContact($arrayData);
        $jsonData = $this->serializer->serialize($contact, 'json', ['groups' => 'getContact']);
        $filename = $pathRegister .'/'.$email."-id-".uniqid().".json";
        file_put_contents($filename, $jsonData);
    }
}
