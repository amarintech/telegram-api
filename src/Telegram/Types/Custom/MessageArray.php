<?php
declare(strict_types = 1);

namespace unreal4u\TelegramAPI\Telegram\Types\Custom;

use unreal4u\TelegramAPI\Abstracts\CustomType;
use Psr\Log\LoggerInterface;
use unreal4u\TelegramAPI\Interfaces\CustomArrayType;
use unreal4u\TelegramAPI\Telegram\Types\Message;
use unreal4u\TelegramAPI\Telegram\Types\Update;

/**
 * Used for methods that will return an array of messages
 */
class MessageArray extends CustomType implements CustomArrayType
{
    public function __construct(array $data = null, LoggerInterface $logger = null)
    {
        if (\count($data) !== 0) {
            foreach ($data as $telegramResponse) {
                // Create an actual Update object and fill the array
                $this->data[] = new Message($telegramResponse, $logger);
            }
        }
    }

    /**
     * Traverses through our $data, yielding the result set
     *
     * @return Update[]
     */
    public function traverseObject()
    {
        foreach ($this->data as $message) {
            yield $message;
        }
    }
}