<?php


class App
{
    static function resultSort($a, $b)
    {
        if ($a['total'] == $b['total']) {
            return 0;
        }
        return ($a['total'] < $b['total']) ? 1 : -1;
    }

    public static function getResultArray()
    {
        $carsJson = file_get_contents("data/data_cars.json");
        $cars = json_decode($carsJson, true);

        $attemptsJson = file_get_contents("data/data_attempts.json");
        $attempts = json_decode($attemptsJson, true);

        foreach ($attempts as $attemptValue) {
            foreach ($cars as $carValue) {
                if ($carValue['id'] == $attemptValue['id']) {
                    if (!isset($result[$carValue['id']]['name'])) {
                        $result[$carValue['id']]['name'] = $carValue['name'];
                        $result[$carValue['id']]['total'] = 0;
                    }
                    if (!isset($result[$carValue['id']]['city'])) {
                        $result[$carValue['id']]['city'] = $carValue['city'];
                    }
                    if (!isset($result[$carValue['id']]['car'])) {
                        $result[$carValue['id']]['car'] = $carValue['car'];
                    }
                    $result[$carValue['id']]['attempts'][] = $attemptValue['result'];
                    $result[$carValue['id']]['total'] += $attemptValue['result'];
                }
            }
        }

        uasort($result, 'self::resultSort');
//        echo '<pre style="color:red;">';
//        print_r($result);
//        echo '</pre>';
        return $result;
    }
    public static function getMaxAttempts($result)
    {
        $max = 0;
        foreach ($result as $key =>$value){
            $i = count($result[$key]['attempts']);
            if ($max < $i) {
                $max = $i;
            }
        }
        return $max ?? 0;
    }
}