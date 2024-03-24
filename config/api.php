<?php
// api 模块配置文件
return [
    "jwt" => [
        "token_life" => 3600,    // Token有效期，单位：秒
        "issue" => "tiani",     // 签发人
        "sub" => "鉴权",       // 签发主题
    ],
    "errCode" => [      // 错误码配置
        200 => "请求正常",
        1000=>"验证器通用错误码",
        1001 => "Token验证失败",
        1002 => "Token已过期"
    ]
];

