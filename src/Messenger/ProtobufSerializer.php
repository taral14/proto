<?php

namespace App\Messenger;

use Google\Protobuf\Internal\Message;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class ProtobufSerializer implements SerializerInterface
{
    /**
     * @param array $encodedEnvelope
     * @return Envelope
     * @throws \Exception
     */
    public function decode(array $encodedEnvelope): Envelope
    {
        $body = $encodedEnvelope['body'];
        $headers = $encodedEnvelope['headers'];
        $class = $headers['className'];
        if(!class_exists($class)) {
            throw new \Exception(sprintf('Class % not exists', $class));
        }

        $message = new $class;
        if(!$message instanceof Message) {
            throw new \Exception('Message not supported interface Google\Protobuf\Internal\Message');
        }
        $message->mergeFromJsonString($body, false);
        $stamps = [];
        if (isset($headers['stamps'])) {
            $stamps = unserialize($headers['stamps']);
        }
        return new Envelope($message, $stamps);
    }

    /**
     * @param Envelope $envelope
     * @return array
     * @throws \Exception
     */
    public function encode(Envelope $envelope): array
    {
        $message = $envelope->getMessage();
        $allStamps = [];
        foreach ($envelope->all() as $stamps) {
            $allStamps = array_merge($allStamps, $stamps);
        }
        if(!$message instanceof Message) {
            throw new \Exception('Message not supported interface Google\Protobuf\Internal\Message');
        }
        $body = $message->serializeToJsonString();
        return [
            'body' => $body,
            'headers' => [
                'package' => str_replace('\\', '.', get_class($message)),
                'className' => get_class($message),
                'stamps' => serialize($allStamps)
            ],
        ];
    }
}