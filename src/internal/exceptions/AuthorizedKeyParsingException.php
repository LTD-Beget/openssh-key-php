<?php

namespace OpenSSH\internal\exceptions;

use LTDBeget\stringstream\StringStream;
use OpenSSH\exceptions\MalformedKeyException;

class AuthorizedKeyParsingException extends MalformedKeyException
{
    /**
     * @var StringStream
     */
    private $stream;

    /**
     * AuthorizedKeyParsingException constructor.
     * @param StringStream $stream
     */
    public function __construct(StringStream $stream)
    {
        $this->stream = $stream;

        parent::__construct(implode(' ', [
            $this->getErrorDescription(),
            $this->getPositionDescription(),
        ]));
    }

    /**
     * @return string
     */
    private function getErrorDescription(): string
    {
        if ($this->stream->isEnd() || $this->stream->current() === '') {
            return 'Unexpected end';
        }

        return "Unexpected character '{$this->stream->current()}'";
    }

    /**
     * @return string
     */
    private function getPositionDescription(): string
    {
        if ($this->stream->isEnd()) {
            $this->stream->end();
        }

        return "at position {$this->stream->position()}";
    }
}
