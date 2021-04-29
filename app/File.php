<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    use HasFactory;

    private $key;

    private $content;

    private $name;

    /**
     * File constructor.
     * @param $key
     * @param $content
     * @param $name
     */
    public function __construct($key, $content, $name)
    {
        $this->key = $key;
        $this->content = $content;
        $this->name = $name;
    }


    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

}
