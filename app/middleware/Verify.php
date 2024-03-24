<?php
declare (strict_types = 1);

namespace app\middleware;
use think\Response;
use app\common\model\AuthList as AuthList;
use utils\JwtTools;
class Verify
{
    /**
     * 处理请求:判断请求是否合法
     *
     * @param \think\Request $request
     * @param \Closure       $next
     * @return Response
     */
    public function handle($request, \Closure $next)
    {
        // 判断参数
        $result = $this->verifyParam($request);

        $token  = JwtTools::generateToken([
            "iss"=>"tianji"
        ]);

        if($result['code'] <= 0){
            return jsonReturn($result['code'],$result['msg']);
        }

        return $next($request);
    }

    public function verifyParam($request){
        $token = $request->header("authorization");

        // $domain=$request->host();
        // if(empty($token)){
        //     return ['code' => 0 , 'msg'=>"token验证失败"];
        // }


        // 查询授权数据
        // $data=AuthList::where("domain",$domain)->find();
        // return ['code' => 1];
    }
}
