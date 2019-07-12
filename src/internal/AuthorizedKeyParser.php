<?php

namespace OpenSSH\internal;

use LTDBeget\ascii\AsciiChar;
use LTDBeget\stringstream\StringStream;
use OpenSSH\AuthorizedKey;
use OpenSSH\exceptions\MalformedKeyException;
use OpenSSH\internal\exceptions\AuthorizedKeyParsingException;
use OpenSSH\PublicKey\Type;

class AuthorizedKeyParser
{
    /** @var string */
    private $key;
    /** @var StringStream */
    private $stream;

    /**
     * AuthorizedKeyParser constructor.
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @return AuthorizedKey
     * @throws MalformedKeyException
     */
    public function parse(): AuthorizedKey
    {
        try {
            return (new AuthorizedKeyDeserializer($this->tokenize()))->deserialize();
        } catch (MalformedKeyException $e) {
            throw $e;
        } catch (\Throwable $e) {
            throw new MalformedKeyException('Parsing error', 0, $e);
        }
    }

    /**
     * @return array
     * @throws AuthorizedKeyParsingException
     * @throws MalformedKeyException
     */
    private function tokenize(): array
    {
        $this->stream = new StringStream($this->key);

        try {
            $options = [];
            $type    = $this->extractType();
        } catch (MalformedKeyException $e) {
            $this->stream->start();
            $options = $this->extractOptions();
            $type    = $this->extractType();
        }

        $key     = $this->extractKey();
        $comment = $this->extractComment();

        return [
            'type'    => $type,
            'key'     => $key,
            'comment' => $comment,
            'options' => $options,
        ];
    }

    /**
     * @return string
     * @throws AuthorizedKeyParsingException
     * @throws MalformedKeyException
     */
    private function extractType(): string
    {
        $type = '';
        $this->stream->ignoreHorizontalSpace();

        start:
        $char = $this->stream->currentAscii();
        if ($char->isLetter() || $char->isDigit() || $char->is(AsciiChar::HYPHEN())) {
            $type .= $this->stream->current();
            $this->stream->next();
            goto start;
        } elseif ($char->isHorizontalSpace()) {
            if (!Type::has($type)) {
                throw new MalformedKeyException("Unknown key type '$type'");
            }
            return $type;
        }

        throw new AuthorizedKeyParsingException($this->stream);
    }

    /**
     * @return array
     * @throws AuthorizedKeyParsingException
     */
    private function extractOptions(): array
    {
        $options = [];
        $this->stream->ignoreHorizontalSpace();

        start:
        $options[] = $this->extractOption();
        $char      = $this->stream->currentAscii();
        if ($char->is(AsciiChar::COMMA())) {
            $this->stream->next();
            goto start;
        } elseif ($char->isHorizontalSpace()) {
            return $options;
        }

        throw new AuthorizedKeyParsingException($this->stream);
    }

    /**
     * @return array
     * @throws AuthorizedKeyParsingException
     */
    private function extractOption(): array
    {
        $value = null;
        $name  = $this->extractOptionName();

        $char = $this->stream->currentAscii();
        if ($char->is(AsciiChar::EQUALS())) {
            $this->stream->next();
            $value = $this->extractOptionValue();
        }

        return ['name' => $name, 'value' => $value];
    }

    /**
     * @return string
     * @throws AuthorizedKeyParsingException
     */
    private function extractOptionName(): string
    {
        $name = '';

        start:
        $char = $this->stream->currentAscii();
        if ($char->isLetter() || $char->isDigit() || $char->is(AsciiChar::HYPHEN())) {
            $name .= $this->stream->current();
            $this->stream->next();
            goto start;
        } elseif ($char->isHorizontalSpace() || $char->is(AsciiChar::EQUALS()) || $char->is(AsciiChar::COMMA())) {
            if ($name !== '') {
                return $name;
            }
        }

        throw new AuthorizedKeyParsingException($this->stream);
    }

    /**
     * @return string
     * @throws AuthorizedKeyParsingException
     */
    private function extractOptionValue(): string
    {
        $value    = '';
        $isQuoted = false;

        start:
        $char = $this->stream->currentAscii();
        if (!$isQuoted) {
            if ($value === '' && $char->is(AsciiChar::DOUBLE_QUOTES())) {
                $isQuoted = true;
                $this->stream->next();
                goto start;
            }
        } elseif ($char->is(AsciiChar::DOUBLE_QUOTES())) {
            $this->stream->next();
            return $value;
        } elseif ($char->is(AsciiChar::BACKSLASH())) {
            $backslash = $this->stream->current();
            $this->stream->next();
            $char = $this->stream->currentAscii();
            if ($char->is(AsciiChar::DOUBLE_QUOTES()) || $char->is(AsciiChar::BACKSLASH())) {
                $value .= $this->stream->current();
                $this->stream->next();
            } else {
                $value .= $backslash;
            }
            goto start;
        } elseif (!$char->isVerticalSpace() && !$this->stream->isEnd()) {
            $value .= $this->stream->current();
            $this->stream->next();
            goto start;
        }

        throw new AuthorizedKeyParsingException($this->stream);
    }

    /**
     * @return string
     * @throws AuthorizedKeyParsingException
     */
    private function extractKey(): string
    {
        $isBase64Special = static function (AsciiChar $char): bool {
            return in_array($char->getValue(), [
                AsciiChar::PLUS,
                AsciiChar::SLASH,
                AsciiChar::EQUALS,
            ], true);
        };

        $key = '';
        $this->stream->ignoreHorizontalSpace();

        start:
        $char = $this->stream->currentAscii();
        if ($char->isLetter() || $char->isDigit() || $isBase64Special($char)) {
            $key .= $this->stream->current();
            $this->stream->next();
            goto start;
        } elseif ($char->isHorizontalSpace() || $this->stream->isEnd()) {
            return $key;
        }

        throw new AuthorizedKeyParsingException($this->stream);
    }

    /**
     * @return string
     * @throws AuthorizedKeyParsingException
     */
    private function extractComment(): string
    {
        $comment = '';
        $this->stream->ignoreHorizontalSpace();

        start:
        $char = $this->stream->currentAscii();
        if (!$char->isVerticalSpace()) {
            if ($this->stream->isEnd()) {
                return $comment;
            }

            $comment .= $this->stream->current();
            $this->stream->next();
            goto start;
        }

        throw new AuthorizedKeyParsingException($this->stream);
    }
}
