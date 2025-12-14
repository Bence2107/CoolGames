<?php

class Container {
    private array $services = [];
    private array $instances = [];

    public function set(string $name, callable $factory): void
    {
        $this->services[$name] = $factory;
    }

    /**
     * @throws Exception
     */
    public function get(string $name)
    {
        if (isset($this->instances[$name])) {
            return $this->instances[$name];
        }

        if (isset($this->services[$name])) {
            $this->instances[$name] = $this->services[$name]($this);
            return $this->instances[$name];
        }

        throw new Exception("Service '$name' not found in container");
    }

    public function has(string $name): bool
    {
        return isset($this->services[$name]) || isset($this->instances[$name]);
    }

    /**
     * @throws Exception
     */
    public function make(string $name)
    {
        if (isset($this->services[$name])) {
            return $this->services[$name]($this);
        }

        throw new Exception("Service '$name' not found in container");
    }
}