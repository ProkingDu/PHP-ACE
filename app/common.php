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
/**
 * 将字符串转为base64url编码
 * @param string $str 原始的待编码字符串
 */
function base64urlencode(string $str) : string{
    // base编码
    $base = base64_encode($str);

    // 替换字符
    $res = str_replace(['=',"+"."/"],["","-","_"],$base);

    // 返回结果
    return $res;
}
function base64urldecode($data) {
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

/**
 * 数据返回方法，用于在程序间传递返回值
 * @param int $code 返回码 默认为1,即正常
 * @param string|null $msg 返回消息
 * @param mixed $data 返回数据
 */
function dataReturn($code=1,$msg="success",$data=null){
    return [
        "code"=>$code,
        "msg"=>$msg,
        "data"=>$data
    ];
}