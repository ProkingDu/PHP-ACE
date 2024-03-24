<?php
/**
 * API模块控制器基类
 */

namespace app\api\controller;

use app\BaseController;
use utils\JwtTools;
use app\api\validate\Token;
use Exception;
use think\exception\ValidateException;

class Base extends BaseController
{
    /**
     * 构造方法
     */
    public function initialize()
    {
        
    }

    /**
     * 获取Token
     */
    public function getToken()
    {
        // 获取参数
        $param = request()->post();

        // 验证参数
        try {
            validate(Token::class)->check($param);
        } catch (ValidateException $e) {
            return jsonReturn(1000, $e->getMessage());
        }

        // 设置签名算法
        JwtTools::setAlg("HS256");

        // 生成token
        $token = JwtTools::generateToken($param);

        return jsonReturn(1, "获取成功", $token);

    }

    /**
     * 验证token
     */
    protected function verifyToken()
    {
        try {
            // 获取请求头
            $headers = request()->header();
            // 验证签名
            $token = $headers['authorization'];

            $res = JwtTools::verifyToken($token);
            // 字段验证
            try {
                validate(Token::class)->check($res);
            } catch (ValidateException $e) {
                return dataReturn(1000, $e->getMessage());
            }

            // 其他的验证
            if ($res === false || $res['iss'] !== config("api.jwt.issue")) {
                return dataReturn(1001, config("api.errCode.1001"));
            } else if ($res['exp'] < date("Y-m-d H:i:s")) {
                return dataReturn(1002, config("api.errCode.1002"));
            } else {
                return dataReturn(200, config("api.errCode.200"), $res);
            }
        } catch (Exception $e) {
            return dataReturn(1000, $e->getMessage());
        }

    }
}
?>