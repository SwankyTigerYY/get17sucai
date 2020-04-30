<?php


namespace App\Http\Controllers\Api;


class IndexController
{
    /**
     *
     * @api {get} /v3.1/ues/:sn/rt-info 获取设备上报实时信息
     * @apiVersion 1.0.0
     * @apiName GetUeRealTimeInfo
     * @apiGroup UE
     *
     * @apiHeader {String} Authorization 用户授权token
     * @apiHeader {String} firm 厂商编码
     * @apiHeaderExample {json} Header-Example:
     *     {
     *       "Authorization": "eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjM2NzgsImF1ZGllbmNlIjoid2ViIiwib3BlbkFJZCI6MTM2NywiY3JlYXRlZCI6MTUzMzg3OTM2ODA0Nywicm9sZXMiOiJVU0VSIiwiZXhwIjoxNTM0NDg0MTY4fQ.Gl5L-NpuwhjuPXFuhPax8ak5c64skjDTCBC64N_QdKQ2VT-zZeceuzXB9TqaYJuhkwNYEhrV3pUx1zhMWG7Org",
     *       "firm": "cnE="
     *     }
     */
    public function index():string
    {
        $string = "i am so sorry !";
        $array = [];
        $float = 1.5;
        $int = 1;
        $bool = true;
        array_push($array, $string);
        array_push($array, $float);
        array_push($array, $int);
        array_push($array, $bool);
        $a = array_sum($array);
        dump($array);
        dump($a);
        array_reduce('', function (){

        }, '');
        return json_encode([
            'a' => 1,
            'b' => 2
        ]);
    }
}
