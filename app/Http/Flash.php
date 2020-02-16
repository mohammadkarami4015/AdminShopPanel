<?php
/**
 * Created by PhpStorm.
 * User: BR
 * Date: 01/07/2018
 * Time: 08:36 PM
 */

namespace app\Http;


class Flash
{
    public function create($title ,$message , $level , $key ='flash_message')
    {
        return session()->flash($key,[
            'title' => $title ,
            'message' => $message ,
            'level' => $level
        ]);
    }
    public function info($title ,$message )
    {
        return $this->create($title,$message,'info');
    }

    public function success($title ,$message )
    {
        return $this->create($title,$message,'success');

    }

    public function error($title ,$message )
    {
        return $this->create($title,$message,'error');

    }

    public function warning($title ,$message )
    {
        return $this->create($title,$message,'warning');

    }
    public function overlay($title ,$message ,$level = 'success' )
    {
        return $this->create($title,$message,$level, 'flash_message_overlay');

    }



}
