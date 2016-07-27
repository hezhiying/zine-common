<?php
/**
 * Created by PhpStorm.
 * User: apple
 * Date: 16/7/27
 * Time: 下午7:13
 */

namespace zine;


class Tree
{

    /**
     * tree 树形数据转换成rows
     * @param $array
     * @return array
     */
    public static function treeToArray( $array )
    {
        $arr = [];
        $tem = [];
        foreach ($array as $item) {
            $arr[] = $item;

            if($item['children']){
                $children = self::treeToArray( $item['children'] );
                foreach ($children  as $v) {
                    $arr[] = $v;
                }
            }
        }
        return $arr;
    }

    /**
     * 将rows转换成tree结构
     * @param array $array
     * @param int   $pid
     * @param int   $lev
     * @return array
     * 返回数据结构
     * {
     *  id:1,
     *  pid:0,
     *  level:0
     *  children:[]
     * }
     */
    public static function initData($array = [], $pid = 0, $lev=0){
        $arr = array();
        $tem = array();
        foreach ($array as $v) {
            if ($v['pid'] == $pid) {
                $tem = self::initData($array, $v['id'], $lev+1);
                //tree level
                $v['level'] = $lev;
                //tree children
                $v['children'] = $tem;
                $arr[] = $v;
            }
        }
        return $arr;
    }


}