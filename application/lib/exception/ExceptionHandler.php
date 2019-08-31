<?php
/**
 * Created by PhpStorm.
 * User: Blurth
 * Date: 2017/9/11
 * Time: 15:42
 */

namespace app\lib\exception;


use think\Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;

    public function render(\Exception $e)
        {
           if($e instanceof BaseException){
                 //ruo如果是自定义异常  则自定义错误码 返回客户端错误信息
                  $this->code = $e->code;
                  $this->errorCode = $e->errorCode;
                  $this->msg = $e->msg;

           }else{
               if(config('app_debug')){
                   return parent::render($e);
               }

               // 服务器错误 记录日志 返回500
               $this->code = 500;
               $this->errorCode = 999;
               $this->msg = 'we have a mistake error';
               $this->recordErrorLog($e);
           }
            $request = Request::instance();
            $result = [
                'msg'  => $this->msg,
                'error_code' => $this->errorCode,
                'request_url' => $request = $request->url()
            ];
            return json($result, $this->code);
        }

    /*
     * 将异常写入日志
     */
    private function recordErrorLog(\Exception $e){
        Log::init([
            'type' => 'File',
            'path' =>  LOG_PATH.'/ERR',
            'level' => ['error']
        ]);
        Log::record($e->getMessage(),'error');
    }
}