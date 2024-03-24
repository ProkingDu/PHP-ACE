<?php
/**
 * Token验证类
 */
namespace app\api\validate;
use think\Validate;
class Token extends Validate{
    protected $rule=[
        "domain|域名（domain）" => "require|activeUrl",
        "ip|服务器IP地址"=>"require|ip",
    ];
}


?>