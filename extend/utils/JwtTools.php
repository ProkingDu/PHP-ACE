<?php
/**
 * ======================================
 * ======================================
 * Class : Jwt工具类
 * Authorit ProkingDu
 * email : root@xdu.fyi
 * ======================================
 * ======================================
 */
namespace utils;

/**
 * class JwtTools：用于生成和解析、验证jwt。
 * 用法：首先通过setAlg方法设定签名算法，取值为:HS256(默认)、RSA、ECDSA
 * 然后，通过
 */

class JwtTools{
    private static string $alg = "HS256";   // 签名算法
    private static string $type = "JWT";   //token类型，确定为jwt        
    private static array $payload = [];   //默认的payload

    /**
     * 设定签名算法
     * @param string $alg 签名算法，取值为:HS256(默认)、RSA、ECDSA
     * @return boolean 如果取值合法则设定为当前的签名算法并返回true，否则返回false。
     */

    public static function setAlg($alg){
        $arr = ["HS256","RSA","ECDSA"];
        if(array_search($alg,$arr)){
            self::$alg = $alg;
            return true;
        }else{
            return false;
        }
    }
    /**
     * 生成默认payload
     */
    private static function generateDefaultPayload(){
        $exp = date("Y-m-d H:i:s",time() + config("api.jwt.token_life"));
        $issue = config("api.jwt.issue");
        $iat = date("Y-m-d H:i:s");
        $sub = config("api.jwt.sub");

        self::$payload = [
            "iss" => $issue,
            "iat" => $iat,
            "sub" => $sub,
            "exp" => $exp
        ];

    }
    /**
     * 生成Token
     * @param array $param 有效载荷的数组键值对。
     * @return string 返回生成的token
     */
    public static function generateToken(array $param) : string{

        if(!is_array($param)){
            return false;
        }

        // 生成头部
        $header_json =json_encode([
            "alg"=>self::$alg,
            "typ"=>self::$type
        ]);

        $header_str=base64urlencode($header_json);

        // 生成有效载荷
        self::generateDefaultPayload();

        $payload = array_merge($param,self::$payload);

        $payload_json=json_encode($payload);

        $payload_str = base64urlencode($payload_json);
        // 生成签名
        if(self::$alg === "HS256"){
            $signature = base64urlencode(hash_hmac("sha256",$header_str.".".$payload_str,config("app.sha256_key")));
        }else if(self::$alg === "RSA"){
            // Todo : RSA签名部分
        }else if(self::$alg === "ECDSA"){
            // Todo :ECDSA签名部分
        }

        // 拼接token
        $token = $header_str .".". $payload_str. "." . $signature;

        return $token;
    }
    /**
     * 验证Token
     * @param string $token 待验证的 Token 字符串
     * @return bool|array 返回验证结果：验证通过返回有效载荷，验证失败返回false
     */
    public static function verifyToken(string $token){
        $tokenParts = explode('.', $token);
        $header = json_decode(base64urldecode($tokenParts[0]),true);
        $payload = json_decode(base64urldecode($tokenParts[1]),true);
        $signature = $tokenParts[2];

        // 如果头部不包含签名算法 则验签失败

        if(empty($header['alg'])){
            return false;
        }

        if($header['alg'] == "HS256"){    // 如果签名算法是HS256

            $validSignature = base64urlencode(hash_hmac('sha256', $tokenParts[0] . '.' . $tokenParts[1], config("app.sha256_key")));

            if($signature === $validSignature){
                return $payload;
            }

        }else if($header['alg'] === "RSA"){  // Todo : RSA验签
            // RSA 验证逻辑
        }else if($header['alg'] === "ECDSA"){    // Todo : ECDSA验签
            // ECDSA 验证逻辑
        }

        return false;
    }
    
}


?>