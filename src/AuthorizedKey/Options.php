<?php

namespace LTDBeget\openssh\AuthorizedKey;

class Options implements \Countable
{
    /** @var Option[] */
    private $options = [];

    /**
     * @param string $name
     * @return Option|null
     */
    public function get(string $name): ?Option
    {
        return $this->options[$name] ?? null;
    }

    /**
     * @param Option $option
     * @return Options
     */
    public function set(Option $option): Options
    {
        $this->options[$option::getName()] = $option;
        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->options[$name]);
    }

    public function unset(string $name): void
    {
        unset($this->options[$name]);
    }

    /**
     * @return string
     */
    public function toString()
    {
        $mapper = static function (Option $option): string {
            return $option->toString();
        };

        return implode(',', array_map($mapper, $this->options));
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->options);
    }
}
