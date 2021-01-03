<?php

namespace App\Console\Commands;

use App\Models\GithubRepositories;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client;

class GithubFeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'github:feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '保存前100条github动态流';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $githubUsername = env('GITHUB_USERNAME');

        $userAgent = "Mozilla / 5.0 (Macintosh; Intel Mac OS X 10_14_3) AppleWebKit / 537.36 (KHTML, like Gecko) Chrome / 72.0.3626.121 Safari / 537.36";

        $startTime = microtime(true);

        $this->info("开始执行");

        $list = $this->getResponse("https://api.github.com/users/{$githubUsername}/received_events",
            "GET",
            ['Authorization' => 'token ' . env('GITHUB_TOKEN'), 'user-agent' => $userAgent],
            ['per_page' => 100, 'page' => 1],
            [],
            "请求动态流错误",
            "请求动态流未得到响应"
        );

        $contentsCount = count($list);

        $this->info("获取动态列表成功，总数：{$contentsCount}条。");

        $handleNumber = 1;

        foreach ($list as $repo) {

            $repository = $this->getResponse("https://api.github.com/repos/{$repo['repo']['name']}",
                "GET",
                ['Authorization' => 'token ' . env('GITHUB_TOKEN'), 'user-agent' => $userAgent],
                [],
                [],
                "请求项目具体信息错误",
                "请求项目具体信息未得到响应"
            );

            if (!empty($repository)) {
                //获取项目信息不为空
                if (isset($repository['message'])) {
                    //存在消息，项目异常，跳过
                    $this->error("项目{$repo['repo']['name']}获取数据异常，异常消息为{$repo['message']}，已跳过");
                    continue;
                } else {
                    //保存项目
                    GithubRepositories::updateOrCreate([
                        'full_name' => $repository['full_name']
                    ], [
                        'name' => $repository['name'],
                        'full_name' => $repository['full_name'],
                        'description' => $repository['description'],
                        'owner' => json_encode($repository['owner']),
                        'html_url' => $repository['html_url'],
                        'original_data' => json_encode($repository),
                    ]);

                    $this->info("已经保存了{$handleNumber}个项目，项目名为：{$repository['full_name']}");

                    $handleNumber++;
                }
            } else {
                //获取信息为空
                $this->error("项目{$repo['repo']['name']}获取数据为空，已跳过");
                continue;
            }
        }

        $endTime = microtime(true);

        $time = round(($endTime - $startTime), 0);

        $datetime = date('Y-m-d H:i:s'); //完成时间

        $this->info("{$datetime}，执行完成, 花费时间 {$time} 秒");

        return 0;
    }


    /**
     * 获取响应
     * @param string $url 网址
     * @param string $requestType 请求类型
     * @param array $header 请求头
     * @param array $query 查询字符串
     * @param array $formParams 发送 application/x-www-form-urlencoded 的请求数据
     * @param string $hasResponseErrorMessage 存在响应错误提示
     * @param string $hasNotResponseErrorMessage 不存在响应错误提示
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getResponse(string $url, string $requestType, array $header = [], array $query = [], array $formParams = [], string $hasResponseErrorMessage = '', string $hasNotResponseErrorMessage = '')
    {
        $client = new Client();

        try {
            //获取项目具体信息
            $response = $client->request($requestType, $url, [
                RequestOptions::HEADERS => $header,
                RequestOptions::FORM_PARAMS => $formParams,
                RequestOptions::QUERY => $query,
            ]);

            $response = json_decode($response->getBody()->getContents(), true);

            return $response;
        } catch (RequestException $e) {

            if (empty($hasResponseErrorMessage)) {
                $hasResponseErrorMessage = "请求错误";
            }

            if (empty($hasNotResponseErrorMessage)) {
                $hasNotResponseErrorMessage = "请求未得到响应";
            }

            if ($e->hasResponse()) {
                //发生错误，检查是否存在响应
                $this->error("{$hasResponseErrorMessage},错误码：{$e->getResponse()->getStatusCode()}，原因：{$e->getResponse()->getReasonPhrase()}。");
            } else {
                $this->error("{$hasNotResponseErrorMessage},报错：{$e->getMessage()}。");
            }
            exit();
        }
    }
}
