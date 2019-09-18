<?php

namespace common\libs;

class XDate
{
    /**
     * 根据指定日期获取所在周的起始时间和结束时间
     * @param $date
     * @return array
     */
    public function getWeekinfoByDate($date)
    {
        $idx = strftime("%u", strtotime($date));
        $mon_idx = $idx - 1;
        $sun_idx = $idx - 7;
        return array(
            'week_start_day' => strftime('%Y-%m-%d', strtotime($date) - $mon_idx * 86400),
            'week_end_day' => strftime('%Y-%m-%d', strtotime($date) - $sun_idx * 86400),
        );
    }

    /**
     * 根据指定日期获取所在月的起始时间和结束时间
     * @param $date
     * @return array
     */
    public function getMonthinfoByDate($date)
    {
        $ret = array();
        $timestamp = strtotime($date);
        $mdays = date('t', $timestamp);
        return array(
            'month_start_day' => date('Y-m-1', $timestamp),
            'month_end_day' => date('Y-m-' . $mdays, $timestamp)
        );
    }

    /**
     * 获取指定日期之间的各个周
     * @param string $sdate 开始时间 2016-05-01
     * @param string $edate 结束时间 2017-05-01
     * @param $type 0 返回Y-n-j, 1返回 Y-m-d
     * @return array
     */
    public function getWeeks($sdate, $edate = '', $type = 0)
    {
        if (empty($edate)) {
            $edate = date("Y-m-d", time());
        }
        $range_arr = array();
        // 检查日期有效性
        $this->checkDate(array($sdate, $edate));
        // 计算各个周的起始时间
        do {
            $weekinfo = $this->getWeekinfoByDate($sdate);
            $end_day = $weekinfo['week_end_day'];
            $start = $this->substrDate($weekinfo['week_start_day'], $type);
            $end = $this->substrDate($weekinfo['week_end_day'], $type);
            $range = "{$start}-{$end}";
            $range_arr[] = $range;
            $sdate = date('Y-m-d', strtotime($sdate) + 7 * 86400);
        } while ($end_day < $edate);
        return $range_arr;
    }

    /**
     * 获取指定日期之间的各个月
     * @param string $sdate 开始时间 2016-05-01
     * @param string $edate 结束时间 2017-05-01
     * @param $type 0 返回Y-n-j, 1返回 Y-m-d
     * @return array
     */
    public function getMonths($sdate, $edate = '', $type = 0)
    {
        if (empty($edate)) {
            $edate = date("Y-m-d", time());
        }
        $range_arr = array();
        do {
            $monthinfo = $this->getMonthinfoByDate($sdate);
            $end_day = $monthinfo['month_end_day'];
            $start = $this->substrDate($monthinfo['month_start_day'], $type);
            $end = $this->substrDate($monthinfo['month_end_day'], $type);
            $range = "{$start}-{$end}";
            $range_arr[] = $range;
            $sdate = date('Y-m-d', strtotime($sdate . '+1 month'));
        } while ($end_day < $edate);
        return $range_arr;
    }

    /**
     * 获取指定日期之间的每天
     * @param string $sdate 开始时间 2016-05-01
     * @param string $edate 结束时间 2017-05-01
     * @param $type 0 返回Y-n-j, 1返回 Y-m-d
     * @return array
     */
    public function getDays($sdate, $edate = '', $type = 0)
    {
        if (empty($edate)) {
            $edate = date("Y-m-d", time());
        }
        $range_arr = array();
        // 检查日期有效性
        $this->checkDate(array($sdate, $edate));
        // 计算各个周的起始时间
        do {
            $dayinfo = $this->getDayinfoByDate($sdate);
            $end_day = $dayinfo['end_day'];
            $start = $this->substrDate($dayinfo['start_day'], $type);
            $range_arr[] = $start;
            $sdate = date('Y-m-d', strtotime($sdate) + 86400);
        } while ($end_day < $edate);
        return $range_arr;
    }

    /**
     * 截取日期中的月份和日
     * @param string $date
     * @param string $type 0 返回Y-n-j, 1返回 Y-m-d
     * @return string $date
     */
    public function substrDate($date, $type = '0')
    {
        if (!$date) return FALSE;
        return $type == 0 ? date('Y/n/j', strtotime($date)) : date('Y/m/d', strtotime($date));;
    }

    /**
     * 检查日期的有效性 YYYY-mm-dd
     * @param array $date_arr
     * @return boolean
     */
    public function checkDate($date_arr)
    {
        $invalid_date_arr = array();
        foreach ($date_arr as $row) {
            $timestamp = strtotime($row);
            $standard = date('Y-m-d', $timestamp);
            if ($standard != $row) $invalid_date_arr[] = $row;
        }
        if (!empty($invalid_date_arr)) {
            die("invalid date -> " . print_r($invalid_date_arr, TRUE));
        }
    }
}