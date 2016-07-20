<?php

namespace App\Http\Logic;


use Illuminate\Support\Facades\DB;

class TopicLogic
{
    // 贴子列表，无分页
    public function getTopicsListNoPage ($limit) {
        $res = DB::table('topics')->select('topics.*', 'b.nickname',
            'b.avatar', 'c.nickname as rname', 'd.cname')
            ->where('topics.is_hidden', 0)
            ->leftJoin('users as b', 'b.uid', '=', 'topics.uid')
            ->leftJoin('users as c', 'c.uid', '=', 'topics.ruid')
            ->leftJoin('nodes as d', 'd.node_id', '=', 'topics.node_id')
            ->orderBy('ord', 'desc')
            ->take($limit)->get();
        return $res;
    }

    /**
     * 通过节点获取帖子
     * @param $limit
     * @param $nodeIds
     * @return mixed
     */
    public function getTopicsListByNodeIds ($limit, $nodeIds) {
        return DB::table('topics as a')
            ->select('a.topic_id', 'a.title', 'a.node_id', 'a.updatetime', 'b.uid', 'b.nickname')
            ->leftJoin('users as b', 'b.uid', '=', 'a.uid')
            ->whereIn('node_id', $nodeIds)
            ->orderBy('a.updatetime','desc')
            ->groupBy('node_id')
            ->take($limit)
            ->get();
    }

    /**
     * 获取最新的帖子
     * @param $limit
     * @return mixed
     */
    public function getLatestTopics($limit) {
        return DB::table('topics')
            ->select('topic_id', 'title', 'updatetime')
            ->where('is_hidden',0)
            ->orderBy('updatetime','desc')
            ->take($limit)->get();
    }


}