<?php

use Simple\Hydrate;

class TestObject
{
    /**
     * Name
     * @var string
     */
    protected $name;

    /**
     * Age
     * @var int
     */
    protected $age = 18;

    use Hydrate\HydrateTrait, Hydrate\HydrateProtectedTrait, Hydrate\HydrateConstructorTrait {
        Hydrate\HydrateProtectedTrait::hydrate insteadof Hydrate\HydrateTrait;
    }

    /**
     * Constructor
     * @param array|string $data
     */
    public function __construct($data = [])
    {
        $args = func_get_args();
        if (is_array($data)) {
            $this->hydrate($data);
        }
        $this->hydrateByArgs(['name', 'age'], $args);
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     * @return self
     */
    public function setAge($age)
    {
        $filterNum = preg_replace('/[^\d]/', '', $age);
        $this->age = $filterNum;
        return $this;
    }
}
