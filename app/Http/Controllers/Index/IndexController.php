<?php
/**
 * author zhaotingquan
 * time 2019-09-06 13:26 星期五
 * desc 测试Demo
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * 实例
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        ini_set('max_execution_time', 600);//秒为单位，自己根据需要定义
        if ($request->isMethod("post")) {
            try {
                $client = new Client();
                //"https://www.17sucai.com/preview/806169/2020-03-11/车辆大数据展示平台/index.html";
                $url = str_replace("index.html", "", $request->post('url'));
                //判断是否有参数
                if (empty($url)) {
                    echo "<html><head><style>html,body{padding: 0;margin: 0;width: 100%;height: 100%;}body{display: flex;align-items: center;justify-content: center;}</style></head><body><div class=\"div\"><a href='javascript:history.back(-1)'>没有输入网址，点击返回上一页</a></div></body></html>";
                    exit;
                }
                //获取index内容
                $response = $client->get($url . "/index.html", [
                    "verify" => false
                ]);
                $html = $response->getBody()->getContents();
                //创建文件夹
                $filepath = public_path() . "\\moban\\" . date("YmdH" . str_pad(mt_rand(0, 9999), 4, "0", STR_PAD_LEFT), time()) . "\\";
                !is_dir($filepath) ? mkdir($filepath, 0777, true) : null;
                $myfile = fopen($filepath . "index.html", "w") or die("Unable to open file!");
                fwrite($myfile, $html);
                fclose($myfile);
                $pattern_js = '/<script[^>]*?src="(.*?)"[^>]*?><\/script>/si';
                $pattern_js_ext = '/<script[^>]*?src=\'(.*?)\'[^>]*?><\/script>/si';
                $pattern_css = '/<link[^>]*?href="(.*?)"[^>]*?>/si';
                $pattern_css_ext = '/<link[^>]*?href=\'(.*?)\'[^>]*?>/si';
                $pattern_img = '/<img[^>]*?src="(.*?)"[^>]*?>/si';
                $pattern_img_ext = '/<img[^>]*?src=\'(.*?)\'[^>]*?>/si';
                $css_src = '/src:[^>]*?url\((.*?)\)/si';
                $css_background = '/background:[^>]*?url\((.*?)\)/si';
                preg_match_all($pattern_js, $html, $match_js);
                preg_match_all($pattern_js_ext, $html, $match_js_ext);
                $match_js_result = array_merge($match_js[1]??array(), $match_js_ext[1]??array());
                preg_match_all($pattern_css, $html, $match_css);
                preg_match_all($pattern_css_ext, $html, $match_css_ext);
                $match_css_result = array_merge($match_css[1]??array(), $match_css_ext[1]??array());
                preg_match_all($pattern_img, $html, $match_img);
                preg_match_all($pattern_img_ext, $html, $match_img_ext);
                $match_img_result = array_merge($match_img[1]??array(), $match_img_ext[1]??array());
                //匹配css文件
                if (isset($match_js_result)) {
                    foreach ($match_js_result as $k => $v) {
                        //
                        if (isset(get_headers($url . $v, true)[0]) && (strpos(get_headers($url . $v, true)[0], '200') || strpos(get_headers($url . $v, true)[0], '304'))) {
                            $content_css = file_get_contents($url . $v);
                        } else {
                            $content_css = "";
                        }
                        //处理css中的文件
                        preg_match_all($css_src, $content_css, $css_src_result);
                        preg_match_all($css_background, $content_css, $css_background_result);
                        if (isset($css_src_result[1])){
                            foreach ($css_src_result[1] as $kk=>$vv){
                                $cache_string = str_replace("'", "", $vv);
                                $cache_string = str_replace("\"", "", $cache_string);
                                $cache_string = str_replace("../", "", $cache_string);
                                if (isset(get_headers($url . $cache_string, true)[0]) && (strpos(get_headers($url . $cache_string, true)[0], '200') || strpos(get_headers($url . $cache_string, true)[0], '304'))) {
                                    self::file_exists_S3($url, $cache_string, $filepath);
                                }
                            }
                        }
                        if (isset($css_background_result[1])){
                            foreach ($css_background_result[1] as $kk=>$vv){
                                $cache_string = str_replace("'", "", $vv);
                                $cache_string = str_replace("\"", "", $cache_string);
                                $cache_string = str_replace("../", "", $cache_string);
                                if (isset(get_headers($url . $cache_string, true)[0]) && (strpos(get_headers($url . $cache_string, true)[0], '200') || strpos(get_headers($url . $cache_string, true)[0], '304'))) {
                                    self::file_exists_S3($url, $cache_string, $filepath);
                                }
                            }
                        }
                        $filename_array = explode("/", $v);
                        $count = count($filename_array);
                        $filecsspath = $filepath;
                        for ($i = 0; $i < $count - 1; $i++) {
                            $filecsspath .= $filename_array[$i] . "\\";
                        }
                        !is_dir($filecsspath) ? mkdir($filecsspath, 0777, true) : null;
                        $myfile = fopen($filecsspath . $filename_array[$count - 1], "w") or die("Unable to open file!");
                        fwrite($myfile, $content_css);
                        fclose($myfile);
                    }
                }
                //匹配JS文件
                if (isset($match_css_result)) {
                    foreach ($match_css_result as $k => $v) {
                        if (isset(get_headers($url . $v, true)[0]) && (strpos(get_headers($url . $v, true)[0], '200') || strpos(get_headers($url . $v, true)[0], '304'))) {
                            $content_js = file_get_contents($url . $v);
                        } else {
                            $content_js = "";
                        }
                        $filename_array = explode("/", $v);
                        $count = count($filename_array);
                        $filejspath = $filepath;
                        for ($i = 0; $i < $count - 1; $i++) {
                            $filejspath .= $filename_array[$i] . "\\";
                        }
                        !is_dir($filejspath) ? mkdir($filejspath, 0777, true) : null;
                        $myfile = fopen($filejspath . $filename_array[$count - 1], "w") or die("Unable to open file!");
                        fwrite($myfile, $content_js);
                        fclose($myfile);
                    }
                }
                //匹配img文件
                if (isset($match_img_result)) {
                    foreach ($match_img_result as $k => $v) {
                        self::file_exists_S3($url, $v, $filepath);
                    }
                }
                echo "<html><head><style>html,body{padding: 0;margin: 0;width: 100%;height: 100%;}body{display: flex;align-items: center;justify-content: center;}</style></head><body><div class=\"div\"><script type=\"text/javascript\">function copyUrl2(){var Url2=document.getElementById('content');Url2.select();document.execCommand('Copy');alert('已复制好，可贴粘。');}</script><textarea id=\"content\">" . $filepath . "</textarea><br /><input type=\"button\" onClick=\"copyUrl2()\" value=\"点击复制代码\" /><br><br><a href='javascript:history.back(-1)'>继续爬取，点击返回上一页</a></div></body></html>";
                exit;
            } catch (\Exception $exception) {
                $result["code"] = $exception->getCode();
                $result['msg'] = $exception->getMessage();
                echo json_encode($result);
                exit;
            }
        }
        return view("index.form")->with("");
    }

    function file_exists_S3($url,$filename, $filepath)
    {
        $state = @file_get_contents($url . $filename, 0, null, 0, 1);//获取网络资源的字符内容
        if ($state) {
            $filename_array = explode("/", $filename);
            $count = count($filename_array);
            $fileimgpath = $filepath;
            for ($i = 0; $i < $count - 1; $i++) {
                $fileimgpath .= $filename_array[$i] . "\\";
            }
            !is_dir($fileimgpath) ? mkdir($fileimgpath, 0777, true) : null;
            ob_start();//打开输出
            readfile($url . $filename);//输出图片文件
            $img = ob_get_contents();//得到浏览器输出
            ob_end_clean();//清除输出并关闭
            $fp2 = @fopen($fileimgpath . $filename_array[$count - 1], "a");
            fwrite($fp2, $img);//向当前目录写入图片文件，并重新命名
            fclose($fp2);
            return 1;
        } else {
            return 0;
        }
    }

    /**
     * API首页
     * 欢迎来到Laravel学院，Laravel学院致力于提供优质Laravel中文学习资源
     */
    public function index0(Request $request)
    {
        $request->server;
        return view('index.index')->with([]);
    }
}
