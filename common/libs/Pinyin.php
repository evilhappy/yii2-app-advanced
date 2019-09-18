<?php
namespace common\libs;

use Yii;

class Pinyin
{
    private static function getMultitonePinyinStrArray($string, $onlyChinese = false)
    {/*{{{*/
        $pinyinTable = PinyinTable::$pinyin_table;
        $flow = array();
        for ($i=0;$i<strlen($string);$i++)
        {
            if (ord($string[$i]) >= 0x81 and ord($string[$i]) <= 0xfe) 
            {
                $h = ord($string[$i]);
                if (isset($string[$i+1])) 
                {
                    $i++;
                    $l = ord($string[$i]);
                    if (isset($pinyinTable[$h][$l])) 
                    {
                        array_push($flow,$pinyinTable[$h][$l]);
                    }
                    else 
                    {
                        array_push($flow,$h);
                        array_push($flow,$l);
                    }
                }
                else 
                {
                    array_push($flow,ord($string[$i]));
                }
            }
            else
            {
                array_push($flow,ord($string[$i]));
            }
        }

        $pinyin = array();
        $pinyin[0] = '';
        for ($i=0;$i<sizeof($flow);$i++)
        {
            if (is_array($flow[$i])) 
            {
                if (sizeof($flow[$i]) == 1)
                {
                    foreach ($pinyin as $key => $value)
                    {
                        $pinyin[$key] .= "_".$flow[$i][0]."_";
                    }
                }
                if (sizeof($flow[$i]) > 1)
                {
                    $tmp1 = $pinyin;
                    foreach ($pinyin as $key => $value)
                    {
                        $pinyin[$key] .= "_".$flow[$i][0]."_";
                    }
                    for ($j=1;$j<sizeof($flow[$i]);$j++)
                    {
                        $tmp2 = $tmp1;
                        for ($k=0;$k<sizeof($tmp2);$k++)
                        {
                            $tmp2[$k] .= "_".$flow[$i][$j]."_";
                        }
                        array_splice($pinyin,sizeof($pinyin),0,$tmp2);
                    }
                }
            }
            else if(false == $onlyChinese) 
            {
                foreach ($pinyin as $key => $value) 
                {
                    $pinyin[$key] .= chr($flow[$i]);
                }
            }
        }
        return $pinyin;
    }/*}}}*/

    private static function getPinyinArr($string, $onlyChinese = true)
    {/*{{{*/
        $resultArr = array();
        $res = self::getMultitonePinyinStrArray($string, $onlyChinese);
        foreach(explode('_', array_shift($res)) as $pinyin)
        {
            if(false == empty($pinyin))
            {
                $resultArr[] = $pinyin;
            }
        }
        return $resultArr;
    }/*}}}*/

    public static function getPinyinStr($string,$onlyChinese = true)  
    {/*{{{*/
        $resultStr = '';
        foreach(self::getPinyinArr($string,$onlyChinese) as $pinyin)
        {
            $resultStr .= $pinyin;
        }
        return $resultStr;
    }/*}}}*/

    public static function getAcronymStr($string, $onlyChinese = true)  
    {/*{{{*/
        $resultStr = '';
        foreach(self::getPinyinArr($string,$onlyChinese) as $pinyin)
        {
            if(preg_match("/^\d*$/", $pinyin))
            {
                $resultStr .= $pinyin;
            }
            else
            {
                $resultStr .= substr($pinyin, 0, 1);
            }
        }
        return $resultStr;
    }/*}}}*/
}
