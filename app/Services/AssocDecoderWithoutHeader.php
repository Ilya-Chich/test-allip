<?php

declare(strict_types=1);


namespace App\Services;

use Clue\React\Csv\AssocDecoder;
use React\Stream\ReadableStreamInterface;

/**
 * This class is a workaround only for 1-column data structures because AssocDecoder does not support csv without header
 */
class AssocDecoderWithoutHeader extends AssocDecoder
{
    protected int $expected;
    /**
     * @var array|string[]
     */
    private array $headers;

    public function __construct(
    ReadableStreamInterface $input,
    $delimiter = ',',
    $enclosure = '"',
    $escapeChar = '\\',
    $maxlength = 65536,
    $headers = ['column']
) {
    $this->expected = 1;
    $this->headers = $headers;
    parent::__construct($input, $delimiter, $enclosure, $escapeChar, $maxlength);
}
}
