<?php
// 应用公共文件
use think\Response;

/**
 * 返回json格式响应
 * @param int $code 返回码
 * @param string $msg 返回消息
 * @param mixed $data 响应数据
 */
function jsonReturn(int|string $code = 0, string $msg = null, mixed $data = null)
{
    $body = [];
    if (is_int($code)) {
        $body['code'] = $code;
    }else if(is_string($code)){
        $body['msg'] = $code;
    }
    !empty($msg) ? $body['msg'] = $msg : false;
    !empty($data) ? $body['data'] = $data : false;

    return json($body);
}

/**
 * 返回请求失败的json数据
 * @param string $msg 失败提示
 */
function jsonReturnFailed(string $msg){
    return jsonReturn(0,$msg);
}

/**
 * 返回请求失败的json数据
 * @param string $msg 失败提示
 */
function jsonReturnSuccess(string $msg,mixed $data){
    return jsonReturn(1,$msg,$msg);
}