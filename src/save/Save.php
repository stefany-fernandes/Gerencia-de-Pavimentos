<?php

namespace save;

class Save {

public function  save():int {
    $contents=@file_get_contents($this->getClassName().'.txt');
    if (!($contents===FALSE)) {
        $objects = explode(PHP_EOL, $contents);
        foreach ($objects as &$obj) {
            if (!$obj)  break;
            $serial = unserialize($obj);
            $attribute = $this::getIdAttribute();
            if ($serial->$attribute == $this->$attribute) {
                $obj = serialize($this);
                return file_put_contents($this->getClassName() . '.txt', implode(PHP_EOL, $objects));
            }
        }
    }
    return file_put_contents($this->getClassName().'.txt',serialize($this).PHP_EOL,FILE_APPEND);
}

public static function  load(string $id)
{
    $d = (static::getClassName().'.txt');
    $contents=@file_get_contents($d);
    $objects=explode(PHP_EOL,$contents);
    foreach ($objects as $obj){
        if (!$obj)  break;
        $serial=unserialize($obj);
        $attribute = static::getIdAttribute();
        if ( $id == $serial->$attribute){
            return $serial;
        }
    }
    return null;
}
    public function delete() {
        $contents = file_get_contents(static::getClassName() . '.txt');
        $contents = str_replace(serialize($this) . PHP_EOL, '', $contents);
        file_put_contents($this->getClassName() . '.txt', $contents);

    }

public static function getIdAttribute()
{
    return 'nomedefeito';
}
public static function  getClassName()
{
   return 'Defeitos';
}

}